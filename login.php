<?php
    session_start();
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        if (empty($email) || empty($password)) {
            echo "Please fill in all fields.";
        } else {
            $con = mysqli_connect('localhost', 'root', '', 'ql_banhang');
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM user WHERE EMAIL='$email' AND PASSWORD='$password'";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) == 1) {
                // Lưu id vào session và chuyển hướng đến trang list_product.php
                $row = mysqli_fetch_assoc($result);
                $_SESSION['id'] = $row['ID'];
                header("Location: account.php");
                exit();
            } else {
                echo "Email hoặc mật khẩu không đúng";
            }
        }
        // Đóng kết nối
        mysqli_close($con);
    }
?>
