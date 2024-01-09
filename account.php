<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Account</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
    <?php
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'ql_banhang');
    // Lấy thông tin của user từ database
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE ID = '$id'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 1) {
        // Hiển thị thông tin của user ra form
        $row = mysqli_fetch_assoc($result);
        $name = $row['NAME'];
        $email = $row['EMAIL'];
        $pass = $row['PASSWORD'];
    } else {
        echo "Không tìm thấy thông tin người dùng";
    }
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $nationality = $_POST['nationality'];
        // Kiểm tra dữ liệu
        if (empty($name) || empty($email) || empty($password) || empty($address) || empty($nationality)) {
            echo "Vui lòng nhập đầy đủ thông tin!";
            exit;
        }
        $con = mysqli_connect('localhost', 'root', '', 'ql_banhang');
        $sql = "UPDATE user SET NAME = '$name', EMAIL = '$email', PASSWORD = '$password' WHERE ID = '$id'";
        if (mysqli_query($con, $sql)) {
            echo "Cập nhật thông tin thành công";
        } else {
            echo "Cập nhật thông tin thất bại: " . mysqli_error($conn);
        }
    }
    ?>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 clearfix">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="images/home/logo.png" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right clearfix">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Canada</a></li>
                                    <li><a href="">UK</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="">Canadian Dollar</a></li>
                                    <li><a href="">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php if (isset($_SESSION['id'])) { ?>
									<li><a href="account.php"><i class="fa fa-user"></i> Account</a></li>
									<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
									<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
									<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
									<li><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>
								<?php } else { ?>
									<li><a href=""><i class="fa fa-user"></i> Account</a></li>
									<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
									<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
									<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
									<li><a href="login_register.php"><i class="fa fa-lock"></i> Login</a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="index.html" class="active">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
                                        <li><a href="product-details.html">Product Details</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="login.html">Login</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
                                        <li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>
                                <li><a href="404.html">404</a></li>
                                <li><a href="contact-us.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <input type="text" placeholder="Search" />
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    <div style="float: left; width: 20%;">
        <h1 style="color: orange; margin-left: 70px">Account</h1>
        <ul style="margin-left: 30px; border: 1px solid black; height: 80px;">
            <li style="margin-top: 15px"><a style="color: black; " href="#">ACCOUNT</a></li>
            <li style="margin-top: 10px"><a style="color: black; " href="list_product.php">MY PRODUCT</a></li>
        </ul>
    </div>
    <div style="float: right; width: 70%; box-sizing: border-box;">
        <h1 style="font-size: large"> User update!</h1>
        <form method="POST" action="">
            <div id="mot" style="margin-bottom: 20px; box-sizing: border-box;">
                <input style="width: 500px; height: 40px" type="text" id="name" name="name"
                    value="<?php echo $row['NAME']; ?>" placeholder="Name...">
            </div>
            <div id="hai" style="margin-bottom: 20px; box-sizing: border-box;">
                <input style="width: 500px; height: 40px" type="email" id="email" name="email"
                    value="<?php echo $row['EMAIL']; ?>" placeholder="Email...">
            </div>
            <div id="ba" style="margin-bottom: 20px; box-sizing: border-box;">
                <input style="width: 500px; height: 40px" type="password" id="password"
                    value="<?php echo $row['PASSWORD']; ?>" name="password" placeholder="Password...">
            </div>
            <div id="bon" style="margin-bottom: 20px; box-sizing: border-box;">
                <input style="width: 500px; height: 40px" type="text" id="address" value="<?php echo "Da Nang" ?>"
                    name="address" placeholder="Address...">
            </div>
            <div id="nam" style="margin-bottom: 20px; box-sizing: border-box;">
                <input style="width: 500px; height: 40px" type="text" id="nationality" value="<?php echo "VietNam" ?>"
                    name="nationality" placeholder="Nationality...">
            </div>
            <!-- <div style="margin-bottom: 20px; box-sizing: border-box;">
                <form method="post" action="" enctype="multipart/form-data">
                    <input type="file" name="avatar" />
                </form>
            </div> -->
            <input type="submit" name="submit" value="UPDATE">
        </form>
    </div>
</body>
</html>