<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Chi Tiết Sản Phẩm  | The Trend</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                            <h2 class="mb-sm-0">Chi Tiết Đơn Hàng</h2>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Chi Tiết Đơn Hàng</li>
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
                <div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                    <h4 style="color:#fff">Quản lý danh sách đơn hàng | <?= $don_hang['ma_don_hang'] ?></h4>
                    </div>
                    <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-success p-2">Đơn hàng: <?= $don_hang['ten_trang_thai'] ?>

                        </span>
                        <span class="badge bg-primary text-white p-2">Phương thức thanh toán: <?= $don_hang['phuong_thuc_thanh_toan'] ?></span>
                        <span class="badge bg-warning text-dark p-2">Trạng thái thanh toán:
                        <?php
                        // Check the 'status' field instead of 'category_name'
                        if ($don_hang['trang_thai_thanh_toan'] == '1') { ?>
                            <span class="badge bg-warning text-dark">Đã Thanh Toán </span>
                            <?php
                        } else { ?>
                            <span class="badge bg-warning text-dark">Chưa Thanh Toán</span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                        <h5>Thông tin người đặt </h5>
                        <p><strong>Tên:</strong><?= $don_hang['ten_nguoi_dung'] ?></p>
                        <p><strong>Email:</strong><?= $don_hang['email'] ?></p>
                        <p><strong>SĐT:</strong><?= $don_hang['so_dien_thoai'] ?></p>
                        </div>
                        <div class="col-md-6">
                        <h5>Thông tin người nhận</h5>
                        <p><strong>Tên:</strong> <?= $don_hang['ho_ten_nguoi_nhan'] ?></p>
                        <p><strong>Email:</strong> <?= $don_hang['email_nguoi_nhan'] ?></p>
                        <p><strong>SĐT:</strong> <?= $don_hang['so_dien_thoai_nguoi_nhan'] ?></p>
                        <p><strong>Địa chỉ:</strong> 147 Phường Canh gà</p>
                        </div>
                    </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="table-light">
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $tong_tien = 0; // Khởi tạo biến tổng tiền
                                if (isset($san_phams) && is_array($san_phams) && !empty($san_phams)) :
                                    ?>
                                    <?php foreach ($san_phams as $sp) : ?>
                                    <?php
                                    $thanh_tien = $sp['so_luong'] * $sp['don_gia']; // Tính thành tiền từng sản phẩm
                                    $tong_tien += $thanh_tien; // Cộng dồn vào tổng tiền
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($sp['ten_san_pham']) ?></td>
                                        <td><?= htmlspecialchars($sp['so_luong']) ?></td>
                                        <td><?= number_format($sp['don_gia'], 0, ',', '.') ?>đ</td>
                                        <td><?= number_format($thanh_tien, 0, ',', '.') ?>đ</td>
                                    </tr>
                                <?php endforeach; ?>

                                <?php else : ?>

                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>


                        <div class="d-flex justify-content-end mt-4">
                        <ul class="list-group w-50">
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <span>Tổng tiền:</span>
                            <strong class="text-danger"><?= number_format($tong_tien, 0, ',', '.') ?>đ</strong>
                        </li>
                        </ul>
                    </div> <br>
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="button" class="btn btn-primary" onclick="history.back()">Trở Về</button>
                            </div>
                        </div>
                    </div>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html><?php

unset($_SESSION['errors']);
