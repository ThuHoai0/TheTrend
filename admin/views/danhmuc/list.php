<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>Danh Mục Sản Phẩm | The Trend</title>
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
                            <h2 class="mb-sm-0">Quản Lý Danh Mục Sản Phẩm</h2>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Danh Mục Sản Phẩm</li>
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
                                    <a href="?act=danhmuc/create" class="btn btn-primary material-shadow-none">
                                        <i class="ri-add-circle-line align-middle me-1"></i> Thêm Danh Mục
                                    </a>

                                    <!-- Search Form and Select aligned to the right -->
                                    <form class="d-flex" role="search" method="get" id="searchForm">
                                        <input type="text" name="search" id="searchInput" placeholder="Tìm kiếm..." autocomplete="off" class="form-control me-2 flex-grow-1">
                                    </form>
                                </div><!-- end card header -->


                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="table-responsive" id="search-results">
                                            <table class="table table-striped table-nowrap align-middle mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">Tên danh mục</th>
                                                    <th scope="col" class="align-items-center">
                                                        Trạng thái

                                                    </th>
                                                    <th scope="col">Thao tác</th>
                                                </tr>

                                                </thead>
                                                <tbody id="tableBody">

                                                <?php foreach ($danh_mucs as $i => $danh_muc) : ?>
                                                    <tr>
                                                        <td class="fw-medium"><?= $i+1 ?></td>
                                                        <td>
                                                            <a href="?act=danhmuc/chitiet&id=<?= $danh_muc['id'] ?>"><?= $danh_muc['ten_danh_muc'] ?></a>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            // Check the 'status' field instead of 'category_name'
                                                            if ($danh_muc['trang_thai'] == '1') { ?>
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
                                                                <a href="?act=danhmuc/edit&id=<?= $danh_muc['id'] ?>" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>

                                                                <form action="?act=danhmuc/delete" method="POST"
                                                                      onsubmit="return confirm('Bạn có muốn xóa không?')">
                                                                    <input type="hidden" name="id" value="<?= $danh_muc['id'] ?>">
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
    // Get the input and form elements
    const searchInput = document.getElementById('searchInput');

    // Check for 'search' parameter in the URL on page load
    window.addEventListener('load', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const searchQuery = urlParams.get('search');

        // If there's a search query, set it in the input field
        if (searchQuery) {
            searchInput.value = searchQuery;
            // Load the search results, e.g., searchUsers(searchQuery);
        } else {
            // If there's no search query, load the full list
            // fetchUserData();  // Call the function that loads the full list
        }
    });

    // Listen for the Enter key press in the input field
    searchInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {  // Check if the key pressed is Enter
            event.preventDefault();  // Prevent the default form action (no immediate reload)

            // Get the value from the input field
            const query = searchInput.value.trim();

            // Check if the input field has a value
            if (query) {
                // Update the URL with the search parameter and reload the page
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('search', query);
                window.location.href = currentUrl.href;
            } else {
                // If the input is empty, clear the search parameter and reload the full list
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.delete('search');
                window.location.href = currentUrl.href;  // Reload to show the full list
            }
        }
    });
</script>





</body>

</html>