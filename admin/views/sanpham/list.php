<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>Danh Sách Sản Phẩm | The Trend</title>
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
                            <h2 class="mb-sm-0">Quản Lý Danh Sách Sản Phẩm</h2>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Danh Sách Sản Phẩm</li>
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
                                    <a href="?act=sanpham/create" class="btn btn-primary material-shadow-none">
                                        <i class="ri-add-circle-line align-middle me-1"></i> Thêm Sản Phẩm
                                    </a>

                                    <!-- Search and Button in a single row -->
                                    <div class="d-flex align-items-center">
                                        <form class="d-flex" role="search" method="get" id="searchForm">
                                            <input type="text" name="search" id="searchInput" placeholder="Tìm kiếm..." autocomplete="off" class="form-control me-2 flex-grow-1">
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
                                                    <th scope="col">Tên sản phẩm</th>
                                                    <th scope="col">Hình ảnh</th>
<!--                                                    <th scope="col">Mô tả</th>-->
                                                    <th scope="col">Số lượng</th>
                                                    <th scope="col">Giá bán</th>
<!--                                                    <th scope="col">Giá nhập</th>-->
<!--                                                    <th scope="col">Danh mục</th>-->

<!--                                                    <th scope="col" class="flex align-items-center">-->
<!--                                                        Ngày tạo-->
<!--                                                        <button class="btn btn-link p-0" type="button" id="statusFilter" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--                                                            <i class="ri-sort-asc" aria-hidden="true"></i>-->
<!--                                                        </button>-->
<!--                                                        <div class="dropdown ms-2">-->
<!--                                                            <ul class="dropdown-menu" aria-labelledby="statusFilter">-->
<!--                                                                <li><a class="dropdown-item" href="?filter=date_desc">Mới nhất</a></li>-->
<!--                                                                <li><a class="dropdown-item" href="?filter=date_asc">Cũ nhất</a></li>-->
<!--                                                            </ul>-->
<!--                                                        </div>-->
<!--                                                    </th>-->


                                                    <!-- Trạng thái with Sort Button -->
                                                    <th scope="col" class="align-items-center">
                                                        Trạng thái
                                                        <!-- Dropdown Filter Button -->
                                                        <button class="btn btn-link p-0" type="button" id="statusFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-filter-2-line" aria-hidden="true"></i>
                                                        </button>
                                                        <div class="dropdown ms-2">
                                                            <ul class="dropdown-menu" aria-labelledby="statusFilter">
                                                                <li><a class="dropdown-item" href="?filter=all">Mặc định</a></li>
                                                                <li><a class="dropdown-item" href="?filter=show">Hiển thị</a></li>
                                                                <li><a class="dropdown-item" href="?filter=hide">Không hiển thị</a></li>
                                                            </ul>
                                                        </div>
                                                    </th>
                                                    <th scope="col">Thao tác</th>
                                                </tr>

                                                </thead>
                                                <tbody>

                                                <?php foreach ($san_phams as $i => $san_pham) : ?>
                                                    <tr>
                                                        <td class="fw-medium"><?= $i+1 ?></td>
                                                        <td>
                                                            <a href="?act=sanpham/chitiet&id=<?= $san_pham['id'] ?>"><?= $san_pham['ten_san_pham'] ?></a>
                                                        </td>
                                                        <td><img src="<?= './../admin/uploads/'.$san_pham['hinh_anh'] ?>" alt="" width="150px"></td>
<!--                                                        <td>--><?php //= $san_pham['mo_ta'] ?><!--</td>-->
                                                        <td><?= $san_pham['so_luong'] ?></td>
                                                        <td><?= $san_pham['gia'] ?></td>
<!--                                                        <td>--><?php //= $san_pham['gia_nhap'] ?><!--</td>-->
<!--                                                        <td>--><?php //= $san_pham['ten_danh_muc'] ?><!--</td>-->
<!--                                                        <td>--><?php //= $san_pham['ngay_tao'] ?><!--</td>-->
                                                        <td>
                                                            <?php
                                                            // Check the 'status' field instead of 'category_name'
                                                            if ($san_pham['trang_thai'] == '1') { ?>
                                                                <span class="badge bg-success">Hiển Thị</span>
                                                                <?php
                                                            } else { ?>
                                                                <span class="badge bg-danger">Không Hiển Thị</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a href="?act=sanpham/edit&id=<?= $san_pham['id'] ?>" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>

                                                                <form action="?act=sanpham/delete" method="POST"
                                                                      onsubmit="return confirm('Bạn có muốn xóa không?')">
                                                                    <input type="hidden" name="id" value="<?= $san_pham['id'] ?>">
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


</body>

</html>