<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Thêm Người Dùng | The Trend</title>
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
                            <h2 class="mb-sm-0">Quản Lý Người Dùng</h2>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Danh Sách Người Dùng</li>
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
                                    <h3 class="card-title mb-0 flex-grow-1">Thêm Người Dùng</h3>
                                </div><!-- end card header -->
                                <form class="container-fluid mt-3 mb-3" action="?act=nguoidung/store" method="post">
                                    <div class="mb-3">
                                        <h5 class="form-label">Tên người dùng</h5>
                                        <input type="text" class="form-control" placeholder="Nhập tên người dùng..." name="ten">
                                        <span class="text-danger">
                                            <?= !empty($_SESSION['errors']['ten']) ? $_SESSION['errors']['ten'] : '' ?>
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Email</h5>
                                        <input type="text" class="form-control" placeholder="Nhập email..." name="email">
                                        <span class="text-danger">
                                            <?= !empty($_SESSION['errors']['email']) ? $_SESSION['errors']['email'] : '' ?>
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Số Điện Thoại</h5>
                                            <input type="tel" class="form-control" id="so_dien_thoai" name="so_dien_thoai">
                                        <span class="text-danger">
                                            <?= !empty($_SESSION['errors']['so_dien_thoai']) ? $_SESSION['errors']['so_dien_thoai'] : '' ?>
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Ngày Sinh</h5>
                                        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" >
                                        <span class="text-danger">
                                            <?= !empty($_SESSION['errors']['ngay_sinh']) ? $_SESSION['errors']['ngay_sinh'] : '' ?>
                                        </span>
                                    </div> 
                                    <div class="mb-3">
                                        <h5 class="form-label">Giới Tính</h5>
                                        <div style="display:flex" >
                                            <label style="margin-right: 15px; ">
                                                <input type="radio" name="gioi_tinh" value="1" > Nam<br>
                                            </label>
                                            <label style="margin-right: 15px;">
                                                <input type="radio" name="gioi_tinh" value="2" > Nữ<br>
                                            </label>
                                            <label >
                                                <input type="radio" name="gioi_tinh" value="0" > Khác<br>
                                            </label>
                                       </div>
                                       <span class="text-danger">
                                            <?= !empty($_SESSION['errors']['gioi_tinh']) ? $_SESSION['errors']['gioi_tinh'] : '' ?>
                                        </span>
                                    </div> 
                                    <div class="mb-3">
                                        <h5 class="form-label">Địa Chỉ</h5>
                                        <textarea id="dia_chi" class="form-control" name="dia_chi" rows="4" cols="50" ></textarea>
                                        <span class="text-danger">
                                            <?= !empty($_SESSION['errors']['dia_chi']) ? $_SESSION['errors']['dia_chi'] : '' ?>
                                        </span>
                                    </div> 
                                    <div class="mb-3">
                                    <label for="ForminputState" class="form-label">Vai Trò</label>
                                        <select class="form-select" name="vai_tro">
                                            <option value="0">Quản trị viên</option>
                                        </select>
                                    </div> 
                                    <div class="mb-3">
                                        <label for="ForminputState" class="form-label">Trạng thái</label>
                                        <select class="form-select" name="trang_thai" require>
                                            <option value="1">Hiển thị</option>
                                            <option value="0">Không hiển thị</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Thêm Người Dùng</button>
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
        <div class="spinner-border text-primary avatar-sm" vai_tro="status">
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
