
<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }
    // Kết nối đến database
    $con = mysqli_connect('localhost', 'root', '', 'ql_banhang');
    // Kiểm tra kết nối
    if (!$con) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
    // Xóa sản phẩm
    $id = $_GET['id'];
    $sql = "DELETE FROM product WHERE ID_PRODUCT = $id";
    if (mysqli_query($con, $sql)) {
        header("Location: list_product.php");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($con);
    }
    // Đóng kết nối
    mysqli_close($con);
?>
