<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Chi Tiết Sản Phẩm  | The Trend</title>
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
                            <h1 class="mb-sm-0">Chi Tiết Sản Phẩm</h1>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Chi Tiết Sản Phẩm</li>
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
                            <br>
                            <h2 class="form-label" style="text-align: center">Chi Tiết Sản Phẩm</h2>
                                <form class="container-fluid mt-3 mb-3">
                                    <div class="mb-3">
                                        <h5 class="form-label">Tên sản phẩm</h5>
                                        <input type="text" class="form-control" value="<?= $san_pham['ten_san_pham'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Mô tả</h5>
                                        <textarea disabled type="text" class="form-control"><?= $san_pham['mo_ta'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Giá</h5>
                                        <input type="text" class="form-control" value="<?= $san_pham['gia'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Hình ảnh</h5>
                                        <img src="<?= './../admin/uploads/'.$san_pham['hinh_anh'] ?>" alt="" width="200px">
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Giá nhập</h5>
                                        <input type="text" class="form-control" value="<?= $san_pham['gia_nhap'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Số lượng</h5>
                                        <input type="text" class="form-control" value="<?= $san_pham['so_luong'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Danh mục</h5>
                                        <select class="form-select" name="danh_muc_id" disabled>
                                            <option> <?= $san_pham['ten_danh_muc'] ?></option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ForminputState" class="form-label">Trạng thái</label>
                                        <select class="form-select" name="trang_thai" disabled>
                                            <option <?= ($san_pham['trang_thai'] == 1) ? 'selected' : ''  ?> value="1">Hiển thị</option>
                                            <option <?= ($san_pham['trang_thai'] == 0) ? 'selected' : ''  ?> value="0">Không hiển thị</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="card">
                                <br>
                            <h2 class="form-label" style="text-align: center">Bình Luận</h2>
                                    <table class="table table-striped table-nowrap align-middle mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">Tên người dùng</th>
                                                    <th scope="col">Nội dung</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php foreach ($binh_luans as $i => $binh_luan) : ?>
                                                        <tr>
                                                            <td class="fw-medium"><?= $i+1 ?></td>
                                                            <td><?= $binh_luan['ten'] ?></td>
                                                            <td><?= $binh_luan['noi_dung'] ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                            </div>


                            <div class="card">
                                <br>
                                           <h2 class="form-label" style="text-align: center">Đánh Giá</h2>
                                    <table class="table table-striped table-nowrap align-middle mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Tên người dùng</th>
                                                    <th scope="col">Số sao</th>
                                                    <th scope="col">Nội dung</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php foreach ($danh_gias as $i => $danh_gia) : ?>
                                                        <tr>
                                                            <td><?= $danh_gia['ten_nguoi_dung'] ?></td>
                                                            <td><?= $danh_gia['so_sao'] ?></td>
                                                            <td><?= $danh_gia['noi_dung'] ?></td>

                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                    <div class="col-lg-12">
                                        <br>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-primary" onclick="history.back()">Trở Về</button>
                                        </div>
                                    </div>
                                </form>

                            </div>

<!--                            <div class="container mt-5">-->
<!--                                <div class="row">-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="mb-3">-->
<!--                                            <label for="tenSanPham" class="form-label">Tên sản phẩm</label>-->
<!--                                            <input type="text" class="form-control" value="--><?php //$san_pham['ten_san_pham'] ?><!--" readonly>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="mb-3">-->
<!--                                            <label for="moTa" class="form-label">Mô tả</label>-->
<!--                                            <textarea class="form-control" id="moTa" rows="2" readonly>--><?php //$san_pham['mo_ta'] ?><!--</textarea>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="mb-3">-->
<!--                                            <label for="gia" class="form-label">Giá</label>-->
<!--                                            <input type="text" class="form-control" id="gia" value="100.00" readonly>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="mb-3">-->
<!--                                            <label for="hinhAnh" class="form-label">Hình ảnh</label>-->
<!--                                            <div>-->
<!--                                                <img src="https://via.placeholder.com/150" alt="Product Image" class="img-thumbnail">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="mb-3">-->
<!--                                            <label for="giaNhap" class="form-label">Giá nhập</label>-->
<!--                                            <input type="text" class="form-control" id="giaNhap" value="10.00" readonly>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="mb-3">-->
<!--                                            <label for="soLuong" class="form-label">Số lượng</label>-->
<!--                                            <input type="text" class="form-control" id="soLuong" value="2" readonly>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="mb-3">-->
<!--                                            <label for="danhMuc" class="form-label">Danh mục</label>-->
<!--                                            <select class="form-select" id="danhMuc" disabled>-->
<!--                                                <option selected>Đồ trẻ em</option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                        <div class="mb-3">-->
<!--                                            <label for="trangThai" class="form-label">Trạng thái</label>-->
<!--                                            <select class="form-select" id="trangThai" disabled>-->
<!--                                                <option selected>Không hiển thị</option>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <br>-->
<!--                                <h3 class="section-title">Bình Luận</h3>-->
<!--                                <div class="table-responsive">-->
<!--                                    <table class="table table-bordered">-->
<!--                                        <thead>-->
<!--                                        <tr>-->
<!--                                            <th>Tên người dùng</th>-->
<!--                                            <th>Nội dung</th>-->
<!--                                        </tr>-->
<!--                                        </thead>-->
<!--                                        <tbody>-->
<!--                                        <tr>-->
<!--                                            <td>mai thi thoai thu</td>-->
<!--                                            <td>bình luận trong chi tiết sản phẩm</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td>co cai nit</td>-->
<!--                                            <td>bbbbbbbbbbbbbbbbbbb</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td>co cai nit</td>-->
<!--                                            <td>aaaaaaaaaaaaaaaaaaaaaaaaaaaa</td>-->
<!--                                        </tr>-->
<!--                                        </tbody>-->
<!--                                    </table>-->
<!--                                </div>-->
<!--                                <br>-->
<!--                                <h3 class="section-title">Đánh Giá</h3>-->
<!--                                <div class="table-responsive">-->
<!--                                    <table class="table table-bordered">-->
<!--                                        <thead>-->
<!--                                        <tr>-->
<!--                                            <th>Tên người dùng</th>-->
<!--                                            <th>Nội dung</th>-->
<!--                                        </tr>-->
<!--                                        </thead>-->
<!--                                        <tbody>-->
<!--                                        <tr>-->
<!--                                            <td>Nguyen Van A</td>-->
<!--                                            <td>ok</td>-->
<!--                                        </tr>-->
<!--                                        </tbody>-->
<!--                                    </table>-->
<!--                                </div>-->
<!---->
<!--                                <!-- Back Button -->-->
<!--                                <div class="text-end mt-4">-->
<!--                                    <button class="btn btn-primary">Trở Về</button>-->
<!--                                </div>-->
<!--                                <br>-->
<!--                            </div>-->


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
