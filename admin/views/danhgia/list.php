<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>Danh Sách Liên Hệ | The Trend</title>
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
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <!-- Add Category Button aligned to the left -->
<<<<<<< Updated upstream
                                    <a href="?act=lienhe/create" class="btn btn-primary material-shadow-none">
                                        <i class="ri-add-circle-line align-middle me-1"></i> Thêm Liên Hệ
                                    </a>
                                    <div class="d-flex align-items-center">
                                        <form class="d-flex" role="search">
                                            <input class="form-control me-1" type="search" placeholder="Tìm kiếm..." aria-label="Search">
=======
                                    <!-- <a href="?act=danhgia/create" class="btn btn-primary material-shadow-none">
                                        <i class="ri-add-circle-line align-middle me-1"></i> Thêm Liên Hệ
                                    </a> -->
                                    <a href="">
                                        
                                    </a>
                                    <div class="d-flex align-items-center">

                                        <form class="d-flex" role="search" method="get" id="searchForm">
                                            <input type="text" name="search" id="searchInput" placeholder="Tìm kiếm..." autocomplete="off" class="form-control me-2 flex-grow-1">
>>>>>>> Stashed changes
                                        </form>
                                    </div>

                                </div><!-- end card header -->


                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-nowrap align-middle mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">STT</th>
<<<<<<< Updated upstream
                                                    <th scope="col">Tên liên hệ</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Số điện thoại</th>
                                                    <th scope="col">Nội dung</th>

                                                    <!-- Ngày tạo with Sort Button -->


                                                    <!-- Trạng thái with Sort Button -->
=======
                                                    <th scope="col">ID sản phẩm</th>
                                                    <th scope="col">ID người dùng</th>
                                                    <th scope="col">Số sao</th>
                                                    <th scope="col">Nội dung</th>
                                                    <th scope="col">Ngày đánh giá</th>

>>>>>>> Stashed changes
                                                    <th scope="col" class="align-items-center">
                                                        Trạng thái
                                                        <!-- Dropdown Filter Button -->

                                                    </th>
                                                    <th scope="col">Thao tác</th>
                                                </tr>

                                                </thead>
                                                <tbody>

<<<<<<< Updated upstream
                                                <?php foreach ($lien_hes as $i => $lien_he) : ?>
                                                    <tr>
                                                        <td class="fw-medium"><?= $i+1 ?></td>
                                                        <td><?= $lien_he['ho_ten'] ?></td>
                                                        <td><?= $lien_he['email'] ?></td>
                                                        <td><?= $lien_he['so_dien_thoai'] ?></td>
                                                        <td><?= $lien_he['noi_dung'] ?></td>
                                
                                                        <td>
                                                            <?php
                                                            // Check the 'status' field instead of 'category_name'
                                                            if ($lien_he['trang_thai'] == '1') { ?>
                                                                <span class="badge bg-success">Đã liên hệ</span>
                                                                <?php
                                                            } else { ?>
                                                                <span class="badge bg-danger">Chưa liên hệ</span>
=======
                                                <?php foreach ($danh_gias as $i => $danh_gia) : ?>
                                                    <tr>
                                                        <td class="fw-medium"><?= $i+1 ?></td>
                                                        <td><?= $danh_gia['san_pham_id '] ?></td>
                                                        <td><?= $danh_gia['nguoi_dung_id '] ?></td>
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
>>>>>>> Stashed changes
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
<<<<<<< Updated upstream
                                                                <a href="?act=lienhe/edit&id=<?= $lien_he['id'] ?>" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>

                                                                <form action="?act=lienhe/delete" method="POST"
                                                                      onsubmit="return confirm('Bạn có muốn xóa không?')">
                                                                    <input type="hidden" name="id" value="<?= $lien_he['id'] ?>">
=======
                                                                <a href="?act=danhgia/edit&id=<?= $danh_gia['id'] ?>" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>

                                                                <form action="?act=danhgia/delete" method="POST"
                                                                      onsubmit="return confirm('Bạn có muốn xóa không?')">
                                                                    <input type="hidden" name="id" value="<?= $danh_gia['id'] ?>">
>>>>>>> Stashed changes
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
                            </div><!-- end card -->

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

<<<<<<< Updated upstream
=======
<script>
    // Lấy phần tử input
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    // Bắt sự kiện khi nhấn phím Enter trong input
    searchInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {  // Kiểm tra xem phím nhấn có phải là Enter không
            event.preventDefault();  // Ngừng hành động mặc định của form (không reload ngay lập tức)

            // Lấy giá trị trong ô input
            const query = searchInput.value.trim();

            // Kiểm tra nếu có giá trị trong ô input
            if (query) {
                // Cập nhật URL với tham số search và giá trị của input
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('search', query);  // Thêm giá trị vào query string mà không mã hóa

                // Đổi URL của trang hiện tại mà không reload
                window.location.href = currentUrl.href;  // Reload trang với URL mới
            }
        }
    });
</script>


>>>>>>> Stashed changes
</body>

</html>