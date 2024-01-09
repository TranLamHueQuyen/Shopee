<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }
    // Xử lý khi submit form
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
                $sql = "INSERT INTO product (TITLE, PRICE, IMAGE, ID)
                        VALUES ('$title', '$price', '$target_file', '$member_id')";

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

    <form method="POST" enctype="multipart/form-data">
        <label for="title">Tiêu đề</label>
        <input type="text" name="title" required />

        <label for="price">Giá</label>
        <input type="number" name="price" required />

        <label for="image">Ảnh</label>
        <img src="<?php echo $row['IMAGE']; ?>" alt="" id="image" width="200" height="200" value="">
        <input type="file" name="image" id="imageFile" onchange="chooseFile(this)" accept="image/gif, image/jpeg, image/png" required />


        <button type="submit" name="submit">Đăng ký</button>
    </form>
