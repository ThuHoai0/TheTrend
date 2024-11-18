<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Chi Tiết Người Dùng | The Trend</title>
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
                            <h2 class="mb-sm-0">Chi Tiết Người Dùng</h2>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Chi Tiết Người Dùng</li>
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
                                        <h5 class="form-label">Tên Người Dùng</h5>
                                        <input type="text" class="form-control" value="<?= $nguoi_dung['ten'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Email</h5>
                                        <input type="text" class="form-control" value="<?= $nguoi_dung['email'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Số điện thoại</h5>
                                        <input type="text" class="form-control" value="<?= $nguoi_dung['so_dien_thoai'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Ngày sinh</h5>
                                        <input type="text" class="form-control" value="<?= $nguoi_dung['ngay_sinh'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Giới tính</h5>
                                        <?php if (isset($nguoi_dung['gioi_tinh'])): ?>
                                            <?php if ($nguoi_dung['gioi_tinh'] == 1): ?>
                                                <label style="margin-right: 15px">
                                                    <input disabled type="radio" name="gioi_tinh" value="1" checked> Nam<br>
                                                </label>
                                            <?php elseif ($nguoi_dung['gioi_tinh'] == 2): ?>
                                                <label style="margin-right: 15px">
                                                    <input disabled type="radio" name="gioi_tinh" value="2" checked> Nữ<br>
                                                </label>
                                            <?php elseif ($nguoi_dung['gioi_tinh'] == 0): ?>
                                                <label>
                                                    <input disabled type="radio" name="gioi_tinh" value="0" checked> Khác<br>
                                                </label>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Địa chỉ</h5>
                                        <textarea disabled type="text" class="form-control"><?= $nguoi_dung['dia_chi'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Ngày tạo</h5>
                                        <input type="datetime-local" class="form-control" value="<?= $nguoi_dung['ngay_tao'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Vai trò</h5>
                                        <select class="form-select" name="trang_thai" disabled>
                                            <option <?= ($nguoi_dung['vai_tro'] == 1) ? 'selected' : ''  ?> value="1">Khách hàng</option>
                                            <option <?= ($nguoi_dung['vai_tro'] == 2) ? 'selected' : ''  ?> value="2">Quản trị viên</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ForminputState" class="form-label">Trạng thái</label>
                                        <select class="form-select" name="trang_thai" disabled>
                                            <option <?= ($nguoi_dung['trang_thai'] == 1) ? 'selected' : ''  ?> value="1">Hoạt Động</option>
                                            <option <?= ($nguoi_dung['trang_thai'] == 0) ? 'selected' : ''  ?> value="0">Không Hoạt Động</option>
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
