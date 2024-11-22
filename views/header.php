<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/images/icons/favicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #admin {
            color: #000;
            font-size: 15px;
            font-family: "Times New Roman";
        }

        #admin1 {
            color: #000;
            font-size: 25px;
            font-family: "Times New Roman";
        }
    </style>
</head>

<body class="animsition">

    <!-- Header -->
    <header class="header-v4">
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->

            <div class="wrap-menu-desktop how-shadow1">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="#" class="logo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="150" height="50" viewBox="0 0 150 50">
                            <text x="50%" y="50%" text-anchor="middle" dominant-baseline="middle" font-family="Time New Roman" font-size="30" fill="#000">
                                The Trend
                            </text>
                        </svg>
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li>
                                <a href="http://localhost/TheTrend/?act=home">Trang Chủ</a>
                            </li>

                            <li>
                                <a href="sanpham.php">Sản Phẩm</a>
                            </li>
                            <li>
                                <a href="gioithieu.php">Khuyến mại</a>
                            </li>

                            <li>
                                <a href="tintuc.php">Tin Tức</a>
                            </li>



                            <li>
                                <a href="http://localhost/TheTrend/?act=lienhe">Liên Hệ</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart">
                            <a href="giohang.php"><i class="zmdi zmdi-shopping-cart"></i></a>
                        </div>

                        <div class="flex-c-m h-full p-lr-19">
                            <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11">
                                <?php if (!empty($_SESSION['iduser'])) { ?>
                                    <a id="admin" href="?act=dangxuat">Đăng xuất</a> |
                                    <?php if($_SESSION['vai_tro'] == 2) {
                                        ?>
                                        <a id="admin1" href="http://localhost/TheTrend/admin">Admin</a>
                                        <?php
                                    }?>
                                <?php } else { ?>
                                    <a href="?act=dangnhap"><i class="zmdi zmdi-account"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

    </header>

    <!-- Cart -->
<!--    <div class="wrap-header-cart js-panel-cart">-->
<!--        <div class="s-full js-hide-cart"></div>-->
<!---->
<!--        <div class="header-cart flex-col-l p-l-65 p-r-25">-->
<!--            <div class="header-cart-title flex-w flex-sb-m p-b-8">-->
<!--                <span class="mtext-103 cl2">-->
<!--                    Giỏ Hàng Của Tôi-->
<!--                </span>-->
<!---->
<!--                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">-->
<!--                    <i class="zmdi zmdi-close"></i>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="header-cart-content flex-w js-pscroll">-->
<!--                <ul class="header-cart-wrapitem w-full">-->
<!--                    <li class="header-cart-item flex-w flex-t m-b-12">-->
<!--                        <div class="header-cart-item-img">-->
<!--                            <img src="assets/images/item-cart-01.jpg" alt="IMG">-->
<!--                        </div>-->
<!---->
<!--                        <div class="header-cart-item-txt p-t-8">-->
<!--                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">-->
<!--                                White Shirt Pleat-->
<!--                            </a>-->
<!---->
<!--                            <span class="header-cart-item-info">-->
<!--                                1 x $19.00-->
<!--                            </span>-->
<!--                        </div>-->
<!--                    </li>-->
<!---->
<!--                    <li class="header-cart-item flex-w flex-t m-b-12">-->
<!--                        <div class="header-cart-item-img">-->
<!--                            <img src="assets/images/item-cart-02.jpg" alt="IMG">-->
<!--                        </div>-->
<!---->
<!--                        <div class="header-cart-item-txt p-t-8">-->
<!--                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">-->
<!--                                Converse All Star-->
<!--                            </a>-->
<!---->
<!--                            <span class="header-cart-item-info">-->
<!--                                1 x $39.00-->
<!--                            </span>-->
<!--                        </div>-->
<!--                    </li>-->
<!---->
<!--                    <li class="header-cart-item flex-w flex-t m-b-12">-->
<!--                        <div class="header-cart-item-img">-->
<!--                            <img src="assets/images/item-cart-03.jpg" alt="IMG">-->
<!--                        </div>-->
<!---->
<!--                        <div class="header-cart-item-txt p-t-8">-->
<!--                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">-->
<!--                                Nixon Porter Leather-->
<!--                            </a>-->
<!---->
<!--                            <span class="header-cart-item-info">-->
<!--                                1 x $17.00-->
<!--                            </span>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->
<!---->
<!--                <div class="w-full">-->
<!--                    <div class="header-cart-total w-full p-tb-40">-->
<!--                        Tổng Tiền: $75.00-->
<!--                    </div>-->
<!---->
<!--                    <div class="header-cart-buttons flex-w w-full">-->
<!--                        <a href="shoping-cart.html"-->
<!--                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">-->
<!--                            Giỏ Hàng-->
<!--                        </a>-->
<!---->
<!--                        <a href="shoping-cart.html"-->
<!--                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">-->
<!--                            Thanh Toán-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <!-- #region -->