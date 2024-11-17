<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Chi Tiết Khuyến Mại  | The Trend</title>
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
                            <h2 class="mb-sm-0">Chi Tiết Khuyến Mại</h2>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Chi Tiết Khuyến Mại</li>
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

                                <form class="container-fluid mt-3 mb-3">
                                    <div class="mb-3">
                                        <h5 class="form-label">Tên Khuyến Mại</h5>
                                        <input type="text" class="form-control" value="<?= $khuyen_mai['ten_khuyen_mai'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Mô tả</h5>
                                        <textarea disabled type="text" class="form-control"><?= $khuyen_mai['mo_ta'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Phần trăm giảm </h5>
                                        <input type="text" class="form-control" value="<?= $khuyen_mai['phan_tram_giam'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Ngày bắt đầu</h5>
                                        <input type="datetime-local" class="form-control" value="<?= $khuyen_mai['ngay_bat_dau'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Ngày kết thúc</h5>
                                        <input type="datetime-local" class="form-control" value="<?= $khuyen_mai['ngay_ket_thuc'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Ngày tạo</h5>
                                        <input type="datetime-local" class="form-control" value="<?= $khuyen_mai['ngay_tao'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ForminputState" class="form-label">Trạng thái</label>
                                        <select class="form-select" name="trang_thai" disabled>
                                            <option <?= ($khuyen_mai['trang_thai'] == 1) ? 'selected' : ''  ?> value="1">Sắp diễn ra</option>
                                            <option <?= ($khuyen_mai['trang_thai'] == 2) ? 'selected' : ''  ?> value="0">Đang diễn ra</option>
                                            <option <?= ($khuyen_mai['trang_thai'] == 0) ? 'selected' : ''  ?> value="0">Kết thúc</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="button" class="btn btn-primary" onclick="history.back()">Trở Về</button>
                                        </div>
                                    </div>
                                </form>

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