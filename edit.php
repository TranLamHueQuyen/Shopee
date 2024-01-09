<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }
    // Kết nối đến database
    $con = mysqli_connect('localhost', 'root', '', 'ql_banhang');
    if (!$con) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
    // Lấy thông tin sản phẩm cần sửa
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE ID_PRODUCT = $id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    if (isset($_POST['submit'])) {
        // Lấy dữ liệu từ form
        $title = $_POST['title'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $member_id = $_SESSION['id'];
        // Kiểm tra file ảnh
        if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $target_dir = "./upload/";
            $target_file = $target_dir . basename($image);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($imageFileType, $allowed_types)) {
                //move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                move_uploaded_file($_FILES['image']['tmp_name'], './upload/'.$_FILES['image']['name']);
                // Kết nối đến database
                $con = mysqli_connect('localhost', 'root', '', 'ql_banhang');

                // Kiểm tra kết nối
                if (!$con) {
                    die("Kết nối thất bại: " . mysqli_connect_error());
                }

                // Thêm sản phẩm vào database
                $sql = "UPDATE product SET TITLE='$title', PRICE='$price', IMAGE='$target_file' WHERE ID_PRODUCT = $id";
                if (mysqli_query($con, $sql)) {
                    header("Location: list_product.php");
                    exit();
                } else {
                    echo "Lỗi: " . mysqli_error($conn);
                }

                // Đóng kết nối
                mysqli_close($conn);
            } else {
                echo "Chỉ cho phép upload ảnh định dạng JPG, JPEG, PNG và GIF";
            }
        } else {
            echo "Lỗi: " . $_FILES['image']['error'];
        }
    }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script>
    function chooseFile(fileInput) {
        if (fileInput.files && fileInput.files[0]){ 
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0])
        }
    }
</script>
    <form method="POST" enctype="multipart/form-data" action="">
        <input type="hidden" name="id" value="<?php echo $row['ID_PRODUCT']; ?>">

        <label for="title">Tiêu đề</label>
        <input type="text" name="title" value="<?php echo $row['TITLE']; ?>" required />

        <label for="price">Giá</label>
        <input type="number" name="price" value="<?php echo $row['PRICE']; ?>" require />

        <label for="image">Ảnh</label>
        <img src="<?php echo $row['IMAGE']; ?>" alt="" id="image" width="200" height="200" value="">
        <input type="file" name="image" id="imageFile" onchange="chooseFile(this)" accept="image/gif, image/jpeg, image/png" required />

        <input type="submit" value="Submit" value="" name="submit">
    </form>  
</body>
</html>
