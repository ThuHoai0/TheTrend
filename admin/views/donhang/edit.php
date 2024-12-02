<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Quản lý Đơn hàng | The Trend</title>
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
                            <h4 class="mb-sm-0">Quản lý Đơn hàng</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Quản lý Đơn hàng</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Cập Nhật Đơn hàng</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                    <form id="updateForm" action="?act=donhang/update&id=<?= htmlspecialchars($don_hang['id'] ?? '') ?>" method="post">
                                        <div class="mb-3">
                                            <label for="citynameInput" class="form-label">Mã đơn hàng</label>
                                            <input type="text" class="form-control" name="ma_don_hang" value="<?= htmlspecialchars($don_hang['ma_don_hang'] ?? '') ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="citynameInput" class="form-label">Tên người dùng</label>
                                            <input type="text" class="form-control" name="ten_nguoi_dung" value="<?= htmlspecialchars($don_hang['ten_nguoi_dung'] ?? '') ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="citynameInput" class="form-label">Ngày đặt hàng</label>
                                            <input type="text" class="form-control" name="ngay_dat_hang" value="<?= htmlspecialchars($don_hang['ngay_dat_hang'] ?? '') ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="citynameInput" class="form-label">Phương thức thanh toán</label>
                                            <select class="form-select" name="phuong_thuc_thanh_toan" disabled>
                                                <option value="1" <?= isset($don_hang['phuong_thuc_thanh_toan']) && $don_hang['phuong_thuc_thanh_toan'] == 1 ? 'selected' : '' ?>>Chuyển khoản</option>
                                                <option value="0" <?= isset($don_hang['phuong_thuc_thanh_toan']) && $don_hang['phuong_thuc_thanh_toan'] == 0 ? 'selected' : '' ?>>Thanh toán khi nhận hàng</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="citynameInput" class="form-label">Trạng thái thanh toán</label>
                                            <select class="form-select" name="trang_thai_thanh_toan" disabled>
                                                <option value="1" <?= isset($don_hang['trang_thai_thanh_toan']) && $don_hang['trang_thai_thanh_toan'] == 1 ? 'selected' : '' ?>>Đã thanh toán</option>
                                                <option value="0" <?= isset($don_hang['trang_thai_thanh_toan']) && $don_hang['trang_thai_thanh_toan'] == 0 ? 'selected' : '' ?>>Chưa thanh toán</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="citynameInput" class="form-label">Họ tên người nhận</label>
                                            <input type="text" class="form-control" name="ho_ten_nguoi_nhan" value="<?= htmlspecialchars($don_hang['ho_ten_nguoi_nhan'] ?? '') ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="citynameInput" class="form-label">Số điện thoại người nhận</label>
                                            <input type="text" class="form-control" name="so_dien_thoai_nguoi_nhan" value="<?= htmlspecialchars($don_hang['so_dien_thoai_nguoi_nhan'] ?? '') ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="citynameInput" class="form-label">Email người nhận</label>
                                            <input type="text" class="form-control" name="email_nguoi_nhan" value="<?= htmlspecialchars($don_hang['email_nguoi_nhan'] ?? '') ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="citynameInput" class="form-label">Địa chỉ nhận hàng</label>
                                            <input type="text" class="form-control" name="dia_chi_nhan_hang" value="<?= htmlspecialchars($don_hang['dia_chi_nhan_hang'] ?? '') ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="citynameInput" class="form-label">Ghi chú</label>
                                            <textarea type="text" class="form-control" name="ghi_chu" disabled><?= htmlspecialchars($don_hang['ghi_chu'] ?? '') ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="citynameInput" class="form-label">Tổng tiền</label>
                                            <input type="text" class="form-control" name="tong_tien" value="<?= htmlspecialchars($don_hang['tong_tien'] ?? '') ?>" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Trạng thái đơn hàng</label>
                                            <select class="form-select" name="trang_thai">
                                                <option value="11" <?= isset($don_hang['trang_thai_id']) && $don_hang['trang_thai_id'] == 11 ? 'selected' : '' ?>>Chờ xử lý</option>
                                                <option value="12" <?= isset($don_hang['trang_thai_id']) && $don_hang['trang_thai_id'] == 12 ? 'selected' : '' ?>>Đã xác nhận</option>
                                                <option value="14" <?= isset($don_hang['trang_thai_id']) && $don_hang['trang_thai_id'] == 13 ? 'selected' : '' ?>>Đang giao hàng</option>
                                                <option value="15" <?= isset($don_hang['trang_thai_id']) && $don_hang['trang_thai_id'] == 14 ? 'selected' : '' ?>>Đã giao hàng</option>
                                                <option value="16" <?= isset($don_hang['trang_thai_id']) && $don_hang['trang_thai_id'] == 15 ? 'selected' : '' ?>>Giao hàng thành công</option>
                                                <option value="17" <?= isset($don_hang['trang_thai_id']) && $don_hang['trang_thai_id'] == 16 ? 'selected' : '' ?>>Giao hàng thất bại</option>
                                                <option value="17" <?= isset($don_hang['trang_thai_id']) && $don_hang['trang_thai_id'] == 17 ? 'selected' : '' ?>>Đã hủy</option>
                                            </select>
                                            <span class="text-danger">
                                                <?= htmlspecialchars($_SESSION['errors']['$trang_thai_don_hang'] ?? '') ?>
                                            </span>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Cập Đơn Hàng</button>
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
        console.log("Nút 'Cập Nhật Danh Mục' đã được nhấn.");

        const form = document.getElementById("updateForm");
        const formData = new FormData(form);

        // Kiểm tra giá trị của các trường trước khi gửi
        const categoryName = formData.get("category_name");
        const categoryStatus = formData.get("category_status");
        console.log("categoryName=>",categoryName);
        console.log("categoryStatus=>",categoryStatus);
        console.log("formData",formData)           
        if (!categoryName) {
            alert("Tên danh mục là bắt buộc.");
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
                    alert("Cập nhật danh mục thành công!");
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