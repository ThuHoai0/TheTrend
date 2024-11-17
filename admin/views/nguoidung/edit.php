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
                            <h4 class="mb-sm-0">Quản Lý Người DÙng</h4>

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
                                    <h4 class="card-title mb-0 flex-grow-1">Cập Nhật Người Dùng</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <form id="updateForm" action="?act=nguoidung/update&id=<?= $nguoi_dung['id'] ?>" method="post">
<!--                                            <input type="hidden" name="id" value="--><?php //= $nguoi_dung['id'] ?><!--">-->

                                            <div class="mb-3">
                                                <label for="citynameInput" class="form-label">Tên người dùng</label>
                                                <input disabled type="text" class="form-control" placeholder="Nhập tên người dùng..." name="ten"  value="<?= isset($nguoi_dung['ten']) ? $nguoi_dung['ten'] : '' ?>" required>


                                            </div>
                                            <div class="mb-3">
                                                <label for="citynameInput" class="form-label">Email</label>
                                                <input disabled type="email" class="form-control" placeholder="Nhập email..." name="email" value="<?= isset($nguoi_dung['email']) ? $nguoi_dung['email'] : '' ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <h5 class="form-label">Số Điện Thoại</h5>
                                                    <input disabled type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" value="<?= isset($nguoi_dung['so_dien_thoai']) ? $nguoi_dung['so_dien_thoai'] : '' ?>" >

                                            </div>
                                            <div class="mb-3">
                                                <h5 class="form-label">Ngày Sinh</h5>
                                                <input disabled type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" value="<?= isset($nguoi_dung['ngay_sinh']) ? $nguoi_dung['ngay_sinh'] : '' ?>">

                                            </div>  
                                            <div class="mb-3">
                                                <h5 class="form-label">Giới Tính</h5>
                                                <div style="display:flex;" >
                                                    <label style="margin-right: 15px">
                                                        <input disabled type="radio" name="gioi_tinh" value="1" <?= isset($nguoi_dung['gioi_tinh']) && $nguoi_dung['gioi_tinh'] == 1 ? 'checked' : '' ?>> Nam<br>
                                                    </label>
                                                    <label style="margin-right: 15px">
                                                        <input disabled type="radio" name="gioi_tinh" value="2" <?= isset($nguoi_dung['gioi_tinh']) && $nguoi_dung['gioi_tinh'] == 2 ? 'checked' : '' ?>> Nữ<br>
                                                    </label>
                                                    <label for="">
                                                        <input disabled type="radio" name="gioi_tinh" value="0" <?= isset($nguoi_dung['gioi_tinh']) && $nguoi_dung['gioi_tinh'] == 0 ? 'checked' : '' ?>> Khác<br>
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="mb-3">
                                                <h5 class="form-label">Địa Chỉ</h5>
                                                <textarea disabled id="dia_chi" class="form-control" name="dia_chi" rows="4" cols="50" required><?= isset($nguoi_dung['dia_chi']) ? $nguoi_dung['dia_chi'] : '' ?></textarea>

                                            </div>  
                                            <div class="mb-3">
                                                <label for="ForminputState" class="form-label">Vai Trò</label>
                                                    <select disabled id="form-select" class="form-control" name="vai_tro" required>
                                                        <option <?= ($nguoi_dung['vai_tro'] == 1) ? 'selected' : ''  ?>  value="1">Khách hàng</option>
                                                        <option <?= ($nguoi_dung['vai_tro'] == 2) ? 'selected' : ''  ?>  value="2">Quản Trị Viên</option>
                                                    </select>
                                                </div> 
                                            <div class="mb-3">
                                                <label for="ForminputState" class="form-label">Trạng thái</label>
                                                <select class="form-select" name="trang_thai">
                                                    <option value="1" <?= $nguoi_dung['trang_thai'] == 1 ? 'selected' : '' ?> >Hiển thị</option>
                                                    <option value="0" <?= $nguoi_dung['trang_thai'] == 0 ? 'selected' : '' ?> >Không hiển thị</option>
                                                </select>
                                                <span class="text-danger">
                                                    <?= !empty($_SESSION['errors']['trang_thai']) ? $_SESSION['errors']['trang_thai'] : '' ?>
                                                </span>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">Cập Nhật Người Dùng</button>
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

<script>
    function submitForm() {
        console.log("Nút 'Cập Nhật Người Dùng' đã được nhấn.");

        const form = document.getElementById("updateForm");
        const formData = new FormData(form);

        // Kiểm tra giá trị của các trường trước khi gửi
        const categoryName = formData.get("category_name");
        const categoryStatus = formData.get("category_status");
        console.log("categoryName=>",categoryName);
        console.log("categoryStatus=>",categoryStatus);
        console.log("formData",formData)
        if (!categoryName) {
            alert("Tên người dùng là bắt buộc.");
            return;
        }

        if (!categoryStatus) {
            alert("Trạng thái là bắt buộc.");
            return;
        }

        // Gửi dữ liệu bằng AJAX (fetch)
        fetch("?act=update_category", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // In kết quả trả về từ server ra console
                console.log("Phản hồi từ server:", data);

                // Thông báo thành công hoặc cập nhật giao diện
                if (data.success) {
                    alert("Cập nhật người dùng thành công!");
                } else {
                    alert("Cập nhật không thành công. Vui lòng thử lại.");
                }
            })
            .catch(error => {
                console.error("Lỗi:", error);
            });
    }
</script>
</body>

</html><?php

unset($_SESSION['errors']);