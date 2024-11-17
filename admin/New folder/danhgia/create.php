<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Thêm Liên Hệ  | The Trend</title>
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
                            <h2 class="mb-sm-0">Quản Lý Danh Sách Liên Hệ</h2>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Danh Sách Liên Hệ</li>
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
                                    <h3 class="card-title mb-0 flex-grow-1">Thêm Liên Hệ</h3>
                                </div><!-- end card header -->
                                <form class="container-fluid mt-3 mb-3" action="?act=lienhe/store" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <h5 class="form-label">Tên liên hệ</h5>
                                        <input type="text" class="form-control" placeholder="Nhập tên liên hệ..." name="ho_ten">
                                        <span class="text-danger">
                                            <?= !empty($_SESSION['errors']['ho_ten']) ? $_SESSION['errors']['ho_ten'] : '' ?>
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
                                        <h5 class="form-label">Số điện thoai</h5>
                                        <input type="text" class="form-control" placeholder="Nhập số điện thoại..." name="so_dien_thoai">
                                        <span class="text-danger">
                                            <?= !empty($_SESSION['errors']['so_dien_thoai']) ? $_SESSION['errors']['so_dien_thoai'] : '' ?>
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Nội dung</h5>
                                        <textarea type="text" class="form-control" placeholder="Nhập nội dung..." name="noi_dung"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ForminputState" class="form-label">Trạng thái</label>
                                        <select class="form-select" name="trang_thai">
                                            <option value="1">Đã liên hệ</option>
                                            <option value="0" selected>Chưa liên hệ</option>
                                        </select>
                                        <span class="text-danger">
                                            <?= !empty($_SESSION['errors']['trang_thai']) ? $_SESSION['errors']['trang_thai'] : '' ?>
                                        </span>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Thêm Liên hệ</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div> <!-- end .h-100-->

                    </div> <!-- end col -->
                </div>
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="card">

                                <form class="container-fluid mt-3 mb-3">
                                    <div class="mb-3">
                                        <h5 class="form-label">Tên Danh Mục</h5>
                                        <input type="text" class="form-control" value="<?= $danh_muc['ten_danh_muc'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Mô tả</h5>
                                        <textarea disabled type="text" class="form-control"><?= $danh_muc['mo_ta'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="form-label">Ngày Tạo</h5>
                                        <input type="datetime-local" class="form-control" value="<?= $danh_muc['ngay_tao'] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ForminputState" class="form-label">Trạng thái</label>
                                        <select class="form-select" name="trang_thai" disabled>
                                            <option <?= ($danh_muc['trang_thai'] == 1) ? 'selected' : ''  ?> value="1">Hiển thị</option>
                                            <option <?= ($danh_muc['trang_thai'] == 0) ? 'selected' : ''  ?> value="0">Không hiển thị</option>
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
                <!-- danh_gia -->
                <div class="row">


                    <div class="col">

                        <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <!-- Add Category Button aligned to the left -->
                                    <!-- <a href="?act=danhgia/create" class="btn btn-primary material-shadow-none">
                                        <i class="ri-add-circle-line align-middle me-1"></i> Thêm Liên Hệ
                                    </a> -->
                                    <h2 class="mb-sm-0">Chi Tiết Sản Phẩm</h2>
                                    <a href="">
                                        
                                    </a>
                                    <div class="d-flex align-items-center">

                                    </div>

                                </div><!-- end card header -->


                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-nowrap align-middle mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">ID sản phẩm</th>
                                                    <th scope="col">ID người dùng</th>
                                                    <th scope="col">Số sao</th>
                                                    <th scope="col">Nội dung</th>
                                                    <th scope="col">Ngày đánh giá</th>

                                                    <th scope="col" class="align-items-center">
                                                        Trạng thái
                                                        <!-- Dropdown Filter Button -->

                                                    </th>
                                                    <th scope="col">Thao tác</th>
                                                </tr>

                                                </thead>
                                                <tbody>

                                                <?php foreach ($danh_gias as $i => $danh_gia) : ?>
                                                    <tr>
                                                        <td class="fw-medium"><?= $i+1 ?></td>
                                                        <td><?= $danh_gia['san_pham_id'] ?></td>
                                                        <td><?= $danh_gia['nguoi_dung_id'] ?></td>
                                                        <td><?= $danh_gia['so_sao'] ?></td>
                                                        <td><?= $danh_gia['noi_dung'] ?></td>
                                                        <td><?= $danh_gia['ngay_danh_gia'] ?></td>
                                                        <td>
                                                            <?php
                                                            // Check the 'status' field instead of 'category_name'
                                                            if ($danh_gia['trang_thai'] == '1') { ?>
                                                                <span class="badge bg-success">Hiển thị</span>
                                                                <?php
                                                            } else { ?>
                                                                <span class="badge bg-danger">Không Hiển thị</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a href="?act=danhgia/edit&id=<?= $danh_gia['id'] ?>" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>

                                                                <form action="?act=danhgia/delete" method="POST"
                                                                      onsubmit="return confirm('Bạn có muốn xóa không?')">
                                                                    <input type="hidden" name="id" value="<?= $danh_gia['id'] ?>">
                                                                    <button type="submit" class="link-danger fs-15" style="border: none; background: none;">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div>
                    </div> <!-- end col -->
                    
                </div>
                <!-- end_danh_gia -->                
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
