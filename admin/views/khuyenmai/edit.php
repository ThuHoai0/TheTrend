<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />

    <title>Sửa Khuyến Mại | The Trend</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- CSS -->
    <?php
    require_once "views/layouts/libs_css.php";
    ?>

</head>

<body>

<!-- Begin page -->
<div id="layout-wrapper">

    <!-- HEADER -->
    <?php
    require_once "views/layouts/header.php";

    require_once "views/layouts/siderbar.php";
    ?>

    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">

                            <h4 class="mb-sm-0">Quản Lý Khuyến mại</h4>


                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Khuyến mại</li>

                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col">

                        <div class="h-100">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Cập Nhật Khuyến Mại</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <form class="container-fluid mt-3 mb-3" action="?act=khuyenmai/update&id=<?= $khuyen_mai['id'] ?>" method="POST">
                                            <div class="mb-3">
                                                <h5 class="form-label">Tên khuyến mại</h5>
                                                <input type="text" class="form-control" placeholder="Nhập tên khuyến mại..." name="ten_khuyen_mai" value="<?= $khuyen_mai['ten_khuyen_mai']?>">
                                                <span class="text-danger">
                                                    <?= !empty($_SESSION['errors']['ten_khuyen_mai']) ? $_SESSION['errors']['ten_khuyen_mai'] : '' ?>
                                                </span>

                                            </div>
                                            <div class="mb-3">
                                                <h5 class="form-label">Mã khuyến mại</h5>
                                                <input type="text" class="form-control" placeholder="Nhập tên khuyến mại..." name="ma_khuyen_mai" value="<?= $khuyen_mai['ma_khuyen_mai']?>">
                                                <span class="text-danger">
                                                <?= !empty($_SESSION['errors']['ma_khuyen_mai']) ? $_SESSION['errors']['ma_khuyen_mai'] : '' ?>
                                                 </span>
                                                
                                            </div>
                                            <div class="mb-3">
                                                <h5 class="form-label">Mô tả</h5>
                                                <textarea type="text" class="form-control" placeholder="Nhập mô tả..." name="mo_ta"><?= $khuyen_mai['mo_ta']?></textarea>

                                            </div>
                                            <div class="mb-3">
                                                <h5 class="form-label">Phần trăm giảm</h5>
                                                <input type="number" class="form-control" placeholder="Nhập phần trăm giảm..." name="phan_tram_giam" value="<?= $khuyen_mai['phan_tram_giam']?>">
                                                <span class="text-danger">
                                                <?= !empty($_SESSION['errors']['phan_tram_giam']) ? $_SESSION['errors']['phan_tram_giam'] : '' ?>
                                                </span>
                                            </div>
                                            <div class="mb-3">
                                                <h5 class="form-label">Ngày bắt đầu</h5>
                                                <input type="datetime-local" class="form-control" name="ngay_bat_dau" value="<?= $khuyen_mai['ngay_bat_dau']?>">
                                                <span class="text-danger">
                                                <?= !empty($_SESSION['errors']['ngay_bat_dau']) ? $_SESSION['errors']['ngay_bat_dau'] : '' ?>
                                                </span>
                                            </div>
                                            <div class="mb-3">
                                                <h5 class="form-label">Ngày kết thúc</h5>
                                                <input type="datetime-local" class="form-control" name="ngay_ket_thuc" value="<?= $khuyen_mai['ngay_ket_thuc']?>">
                                                <span class="text-danger">
                                                <?= !empty($_SESSION['errors']['ngay_ket_thuc']) ? $_SESSION['errors']['ngay_ket_thuc'] : '' ?>
                                                </span>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">Sửa khuyến mại</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div> <!-- end .h-100-->

                    </div> <!-- end col -->
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Velzon.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<div class="customizer-setting d-none d-md-block">
    <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
        <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
    </div>
</div>

<!-- JAVASCRIPT -->
<?php
require_once "views/layouts/libs_js.php";
?>

</body>

</html><?php

unset($_SESSION['errors']);