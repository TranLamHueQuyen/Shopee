<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>List_Prodcuct</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }
    $con = mysqli_connect('localhost', 'root', '', 'ql_banhang');
    if (!$con) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM product WHERE ID = $id";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $html = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['id_product'] = $row['ID_PRODUCT'];
            $html .= '
                <tr>' .
                '<td class="cart_product">' .
                '<p class="cart_total_price" style="color: #104E8B; font-size: 15px; margin-top: 10px">' . $row['ID_PRODUCT'] . '</p>' .
                '</td>' .
                '<td class="cart_description">' .
                "<h4><a>" . $row['TITLE'] . "</a></h4>" .
                '</td>' .
                '<td class="cart_price">' .
                "<p>" . "$" . $row['PRICE'] . "</p>" .
                '</td>' .
                '<td class="cart_total">' .
                "<img style='width: 100px; height: 50px' src='" . $row['IMAGE'] . "' alt='" . "' />" .
                '</td>' .
                '<td class="cart_quantity">' .
                '<a class="cart_quantity_edit" href="edit.php?id=' . $row['ID_PRODUCT'] . '">EDIT</a>' .
                '</td>' .
                '<td class="cart_delete">' .
                '<a class="cart_quantity_delete" href="delete.php?id=' . $row['ID_PRODUCT'] . '"><i class="fa fa-times" style="color: #104E8B"></i></a>' .
                '</td>' .
                '</tr>';
        }
    } else {
        echo "Không có sản phẩm nào";
    }

    // Đóng kết nối
    mysqli_close($con);
    ?>
    <header><!--header-->
        <div class="header-top"><!--header-top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +123456789</a></li>
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
        </div><!--/header-top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
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
                                    <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                    <li><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>
                                <?php } else { ?>
                                    <li><a href=""><i class="fa fa-user"></i> Account</a></li>
                                    <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
                                    <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                    <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
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
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="index.php">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
                                        <li><a href="product-details.html">Product Details</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="cart.html">Cart</a></li>
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
                            <form action="">
                                <input type="text" placeholder="Search" />
                            </form>
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
    <div style="float: right; width: 70%; box-sizing: border-box; margin-right: 30px; margin-top: 30px;">
        <div class="table-responsive cart_info" style="border: 1px solid #DDDDDD;">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu" style="background-color: orange">
                        <td class="image">ID</td>
                        <td class="description">NAME</td>
                        <td class="price">PRICE</td>
                        <td class="tt">IMAGE</td>
                        <td class="quantity">ACTION</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    echo $html;
                    ?>
                </tbody>
            </table>
        </div>
        <a href="add.php"><button id="button">Thêm sản phẩm</button></a>
    </div>
</body>

</html>