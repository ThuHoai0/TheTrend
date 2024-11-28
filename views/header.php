<!DOCTYPE html>
<html lang="vie">

<head>
    <?php
    // Lấy giá trị của act từ URL (mặc định là 'home' nếu không có giá trị nào)
    $act = $_GET['act'] ?? 'home';

    // Thiết lập tiêu đề và nội dung giao diện dựa trên act
    switch ($act) {
        case 'sanpham':
            $title = 'Sản Phẩm';
            $view = 'views/sanpham.php';
            break;

        case 'chitietsanpham':
            $title = 'Chi Tiết Sản Phẩm';
            $view = 'views/chitietsanpham.php';
            break;

        case 'khuyenmai':
            $title = 'Khuyến Mại';
            $view = 'views/khuyenmai.php';
            break;

        case 'tintuc':
            $title = 'Tin Tức';
            $view = 'views/tintuc.php';
            break;

        case 'lienhe':
            $title = 'Liên Hệ';
            $view = 'views/lienhe.php';
            break;

        case 'home':
        default:
            $title = 'Trang Chủ';
            $view = 'views/home.php';
            break;
    }
    ?>
    <title><?= $title ?></title> <!-- Tiêu đề động -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            font-size: 15px;
            font-family: "Times New Roman";
        }
        /* Căn chỉnh chung cho dropdown */
        .dropdown {
                position: relative;
                display: inline-block;
                font-size: 14px; /* Giảm kích thước chữ */
            }

            /* Nội dung của menu dropdown (ẩn mặc định) */
            .dropdown-content {
                display: none;
                position: absolute;
                right: 0; /* Đẩy menu trượt sát biểu tượng */
                background-color: #ffffff;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                border: 1px solid #ddd;
                border-radius: 6px; /* Bo góc mềm mại */
                min-width: 120px; /* Giảm chiều rộng */
                padding: 5px 0; /* Thu nhỏ khoảng cách */
                z-index: 1;
            }

            /* Liên kết trong menu dropdown */
            .dropdown-content a {
                text-decoration: none;
                color: #333;
                padding: 6px 12px; /* Cách đều bên trong */
                display: block;
                font-size: 13px; /* Giảm kích thước chữ */
                border-radius: 4px; /* Bo góc nhỏ */
            }

            /* Hiệu ứng hover cho liên kết */
            .dropdown-content a:hover {
                background-color: #f0f0f0; /* Màu nền nhạt khi hover */
                color: #007bff; /* Màu chữ xanh đẹp hơn */
            }

            /* Hiển thị menu khi có lớp "show" */
            .dropdown-content.show {
                display: block;
            }
            body, html {
                font-family: 'Roboto', sans-serif !important;
                }

                /* Đảm bảo các thẻ văn bản cũng dùng Roboto */
            h1, h2, h3, h4, h5, h6, p, a, span, div, button, input, textarea {
                font-family: 'Roboto', sans-serif !important;
            }
            button, input, textarea {
                font-family: 'Roboto', sans-serif !important;
            }

            /* Tùy chỉnh icon */s
            .dropdown .icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 32px;
                height: 32px; /* Kích thước biểu tượng nhỏ hơn */
                border-radius: 50%; /* Làm icon tròn */
                background-color: #f8f9fa; /* Màu nền sáng nhẹ */
                color: #333; /* Màu biểu tượng */
                cursor: pointer;
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            /* Hiệu ứng hover cho icon */
            .dropdown .icon:hover {
                background-color: #007bff; /* Màu xanh khi hover */
                color: #fff; /* Màu biểu tượng đổi sang trắng */
            }

        .badge-new {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff0000; /* Màu nền đỏ */
            color: #fff; /* Màu chữ trắng */
            padding: 5px 10px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 12px; /* Bo góc */
            z-index: 10; /* Đảm bảo hiển thị phía trên hình ảnh */
            text-transform: uppercase; /* Viết hoa */
        }

        .badge {
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 12px;
            font-weight: bold;
        }
        /* Tạo khoảng cách giữa các ô trong bảng */
        .table-shopping-cart td,
        .table-shopping-cart th {
            padding: 10px; /* Tạo khoảng cách bên trong các ô */
        }

        /* Khoảng cách cho nút trong cột "Action" */
        .table-shopping-cart .btn {
            margin: 5px 0; /* Thêm khoảng cách dọc cho nút */
        }
        /* Khoảng cách giữa bảng giỏ hàng và form thông tin đặt hàng */
        .table-shopping-cart {
            margin-bottom: 30px; /* Tạo khoảng cách bên dưới bảng */
        }

        /* Tạo khoảng cách rõ ràng giữa các khối */
        .col-lg-8, .col-lg-4 {
            margin-bottom: 20px; /* Tạo khoảng cách giữa hai khối */
        }

        /* Padding bên trong bảng để nội dung không dính sát nhau */
        .table-shopping-cart td,
        .table-shopping-cart th {
            padding: 15px; /* Tăng khoảng cách bên trong ô bảng */
        }

        /* Tạo khoảng cách trong form thông tin đặt hàng */
        form .border {
            margin-top: 20px; /* Tạo khoảng cách trên cùng của form */
            padding: 20px; /* Tăng padding bên trong form */
        }

        /* Làm nổi bật các khối */
        form .border {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng mờ */
        }
        /* Căn chỉnh nút + và - bên cạnh ô nhập số lượng */
        .quantity-btn {
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 1;
            padding: 0;
            font-size: 16px;
        }

        /* Căn chỉnh ô nhập số lượng */
        form input[name="quantity"] {
            text-align: center;
            padding: 0;
            margin: 0;
            font-size: 14px;
        }
        .cart-icon {
            position: relative;
            display: inline-block;
            font-size: 24px;
            color: #333;
            transition: color 0.3s ease;
        }

        .cart-icon a {
            text-decoration: none;
            color: inherit;
        }

        .cart-icon a:hover {
            color: #ff5722; /* Add a hover effect */
        }

        .cart-icon i {
            font-size: 28px; /* Adjust icon size */
        }

        .cart-total-items {
            position: absolute;
            top: -10px; /* Position above the cart icon */
            right: -10px; /* Position to the right of the cart icon */
            background-color: #ff5722; /* Badge background color */
            color: #fff; /* Badge text color */
            font-size: 14px; /* Badge text size */
            font-weight: bold;
            border-radius: 50%; /* Circular badge */
            width: 24px;
            height: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .cart-total-items:empty {
            display: none; /* Hide badge if cart is empty */
        }

        .cart-icon:hover .cart-total-items {
            transform: scale(1.1); /* Slightly enlarge on hover */
            background-color: #ff7043; /* Change badge color on hover */
        }

        .cart-total-items {
            display: none; /* Hidden by default */
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #ff5722;
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, background-color 0.3s ease;
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
                    <a href="?act=home" class="logo">
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
                                <a href="?act=home">Trang Chủ</a>
                            </li>

                            <li>
                                <a href="?act=sanpham">Sản Phẩm</a>
                            </li>
                            <li>
                                <a href="?act=khuyenmai">Khuyến mại</a>
                            </li>

                            <li>
                                <a href="?act=tintuc">Tin Tức</a>
                            </li>

                            <li>
                                <a href="?act=lienhe">Liên Hệ</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
<!--    nut gio hang -->
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart position-relative">
                            <div class="cart-icon">
                                <a href="?act=giohang"><i class="zmdi zmdi-shopping-cart"></i></a>
                                <sup class="cart-total-items"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0' ?></sup>
                            </div>
                        </div>

                        <div class="flex-c-m h-full p-lr-19">
                            <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11">
                                <?php if (!empty($_SESSION['iduser'])) { ?>
                                    <a id="admin" href="?act=dangxuat">Đăng xuất</a> | 
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="icon" onclick="toggleDropdown('dropdown-menu')">
                                            <i class="fa-regular fa-user"></i>
                                        </a>
                                        <form action="?act=thongtinnguoidung" method="post">
                                        <div id="dropdown-menu" class="dropdown-content">
                                            <a href="?act=thongtinnguoidung&id=<?= $_SESSION['iduser']?>">Thông tin người dùng</a> 
                                            <a href="?act=donhang&id=<?= $_SESSION['iduser']?>">Đơn hàng</a>
                                            <a href="?act=suamatkhau&id=<?= $_SESSION['iduser']?>">Đổi mật khẩu</a>
                                            <a href="?act=quenmatkhau">Quên mật khẩu</a>
                                        </div>
                                        </form>
                                    </div>
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
 <script>
    // Hiển thị/ẩn dropdown khi nhấn vào icon
        function toggleDropdown(id) {
            const menu = document.getElementById(id);
            menu.classList.toggle("show");
        }

        // Ẩn dropdown khi nhấp ra ngoài
        window.onclick = function(event) {
            if (!event.target.matches('.icon, .icon *')) {
                const dropdowns = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    dropdowns[i].classList.remove('show');
                }
            }
        };
 </script>
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

