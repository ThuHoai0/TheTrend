<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Cập Nhật Banner | The Trend</title>
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
                            <h4 class="mb-sm-0">Quản Lý Danh Sách Banner</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Danh Sách Banner</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Cập Nhật Banner</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <form id="updateForm" action="?act=banner/update&id=<?= $banner['id'] ?>" method="post" enctype="multipart/form-data">
<!--                                            <input type="hidden" name="id" value="--><?php //= $danh_muc['id'] ?><!--">-->
                                            <div class="mb-3">
                                                <h5 class="form-label">Hình ảnh</h5>
                                                <input type="hidden" class="form-control" name="img" value="<?= $banner['duong_dan_hinh_anh']?>">
                                                <input type="file" class="form-control" name="duong_dan_hinh_anh">
                                            </div>
                                            <div class="mb-3">
                                                <label for="citynameInput" class="form-label">Mô tả</label>
                                                <input type="text" class="form-control" placeholder="Nhập mô tả..." name="mo_ta" value="<?= $banner['mo_ta'] ?>">
                                                <span class="text-danger">
                                                    <?= !empty($_SESSION['errors']['mo_ta']) ? $_SESSION['errors']['mo_ta'] : '' ?>
                                                </span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ForminputState" class="form-label">Trạng thái</label>
                                                <select class="form-select" name="trang_thai">
                                                    <option value="1" <?= $banner['trang_thai'] == 1 ? 'selected' : '' ?> >Hiển thị</option>
                                                    <option value="0" <?= $banner['trang_thai'] == 0 ? 'selected' : '' ?> >Không hiển thị</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">Cập Nhật Banner</button>
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