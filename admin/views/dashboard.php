<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<head>

    <meta charset="utf-8" />
    <title>Dashboard | The Trend</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- CSS -->
    <?php
    require_once "layouts/libs_css.php";
    ?>
</head>
<?php
if (!isset($_SESSION['iduser'])) {
    header("location:/TheTrend/?act=dangnhap");
    exit;
}
if (isset($_SESSION['iduser']) &&  (isset($_SESSION['vai_tro']) && ($_SESSION['vai_tro'] != 2))) {
    header("location:/TheTrend/?act=dangnhap");
    exit;
}
?>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- HEADER -->
        <?php
        require_once "layouts/header.php";

        require_once "layouts/siderbar.php";
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

                    <div class="row">
                        <div class="col">

                            <div class="h-100">
                                <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                                <h4 class="fs-16 mb-1">Chào bạn, <?= $_SESSION['name']?>!</h4>
                                            </div>
                                        </div><!-- end card header -->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->

                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Số Đơn Hàng Cả Năm</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <h5 class="text-success fs-14 mb-0">
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $tongDonHangCaNam; ?>">0</span> Đơn Hàng</h4>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                                            <i class="bx bx-dollar-circle text-success"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-4 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Thu Nhập Cả Năm</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <h5 class="text-danger fs-14 mb-0">
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?php echo $tongTienCaNam; ?>">0</span> VNĐ</h4>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                                            <i class="bx bx-shopping-bag text-info"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-4 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Số Lượng Khách Hàng</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <h5 class="text-success fs-14 mb-0">
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?= $soLuongKhachHang ?>">0</span> Người Dùng</h4>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                            <i class="bx bx-user-circle text-warning"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
                                </div> <!-- end row-->

                                
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header border-0 align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Doanh thu</h4>
                                            </div><!-- end card header -->

                                            <div class="card-header p-0 border-0 bg-light-subtle">
                                            <div class="row g-0 text-center">
                                                    <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?php echo $tongThuNhapNgay; ?> ">0</span> VNĐ</h5>
                                                            <p class="text-muted mb-0">Tổng Thu Nhập Ngày Hôm Nay</p>
                                                        </div>
                                                    </div>
                                                
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?php echo $soLuongDonHangHomNay; ?>"></span> Đơn Hàng</h5>
                                                            <p class="text-muted mb-0">Đơn Hàng Hôm Nay</p>

                                                        </div>
                                                    </div>

                                                    <!--end col-->
                                                    <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?php echo $tongSanPham; ?>">0</span> Sản Phẩm</h5>
                                                            <p class="text-muted mb-0">Tổng Số Lượng Sản Phẩm</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div><!-- end card header -->
                                            <div class="card">
                                                <div class="card-header border-0 align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Thống Kê Số Lương Đơn Hàng</h4>
                                            </div>
                                            <div class="card-header p-0 border-0 bg-light-subtle">
                                                <div class="row g-0 text-center">
                                                    <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?php echo $tongDonHang; ?>">0</span></h5>
                                                            <p class="text-muted mb-0">Tổng đơn hàng</p>
                                                        </div>
                                                        </div>
                                                            <!--end col-->
                                                            <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?php echo $dangSuLy; ?>">0</span></h5>
                                                            <p class="text-muted mb-0">Số đơn hàng đang sử lý</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->

                                                    <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?php echo $tongDonHangDaXacNhan; ?>">0</span></h5>
                                                            <p class="text-muted mb-0">Số đơn hàng đã xác nhận</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->

                                                    </div>
                                                </div>

                                            <div class="card-header p-0 border-0 bg-light-subtle">
                                                <div class="row g-0 text-center">
                                                    <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?php echo $tongSoDonHangDangGiao; ?>">0</span></h5>
                                                            <p class="text-muted mb-0">Số đơn hàng đang giao</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?php echo  $tongSoDonHangDaGiaoHang; ?>">0</span></h5>
                                                            <p class="text-muted mb-0">Số đơn hàng đã giao</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-4">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1"><span class="counter-value" data-target="<?php echo  $tongSoDonHangDaHuy; ?>">0</span></h5>
                                                            <p class="text-muted mb-0">Số đơn hàng đã hủy</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                           
                                                </div>
                                            </div>

                                            <div class="card-body p-0 pb-2">
                                                <div class="w-100">
                                                <!-- <div id="customer_impression_charts" data-colors='["--vz-primary", "--vz-success", "--vz-danger"]' data-colors-minimal='["--vz-light", "--vz-primary", "--vz-info"]' data-colors-saas='["--vz-success", "--vz-info", "--vz-danger"]' data-colors-modern='["--vz-warning", "--vz-primary", "--vz-success"]' data-colors-interactive='["--vz-info", "--vz-primary", "--vz-danger"]' data-colors-creative='["--vz-warning", "--vz-primary", "--vz-danger"]' data-colors-corporate='["--vz-light", "--vz-primary", "--vz-secondary"]' data-colors-galaxy='["--vz-secondary", "--vz-primary", "--vz-primary-rgb, 0.50"]' data-colors-classic='["--vz-light", "--vz-primary", "--vz-secondary"]' data-colors-vintage='["--vz-success", "--vz-primary", "--vz-secondary"]' class="apex-charts" dir="ltr"></div>  -->
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
                                </div>

                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Top 5 sản phẩm bán chạy</h4>
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="table-responsive table-card">
                                                    <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>Tên Sản Phẩm</th>
                                                                <th>Tổng Số Lượng Bán</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($topSanPham as $index => $sanPham): ?>
                                                                <tr>
                                                                    <td><?= $index + 1 ?></td>
                                                                    <td><?= htmlspecialchars($sanPham['ten_san_pham']) ?></td>
                                                                    <td><?= htmlspecialchars($sanPham['tong_so_luong']) ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="card card-height-100">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Khuyến mại</h4>2
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="table-responsive table-card">
                                                    <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Tên Khuyến Mãi</th>
                                                                <th>Phần Trăm Giảm</th>
                                                                <th>Ngày Bắt Đầu</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($khuyenMais as $km): ?>
                                                                <tr>
                                                                    <td><?= htmlspecialchars($km['ten_khuyen_mai']) ?></td>
                                                                    <td><?= htmlspecialchars($km['phan_tram_giam']) ?>%</td>
                                                                    <td><?= htmlspecialchars($km['ngay_bat_dau']) ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table><!-- end table -->
                                                </div>
                                            </div> <!-- .card-body-->
                                        </div> <!-- .card-->
                                    </div> <!-- .col-->
                                </div> <!-- end row-->

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Khách hàng thân thiết</h4>
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="table-responsive table-card">
                                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>Tên Người Dùng</th>
                                                                <th>Email</th>
                                                                <th>Số Đơn Hàng</th>
                                                                <th>Tổng Tiền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                
                                                            <?php $stt = 1; // Khởi tạo số thứ tự 
                                                            foreach ($khachHangs as $kh): ?>
                                                                <tr>
                                                                    <td><?= $stt++ ?></td> <!-- Hiển thị số thứ tự và tăng dần -->
                                                                    <td><?= htmlspecialchars($kh['ten']) ?></td>
                                                                    <td><?= htmlspecialchars($kh['email']) ?></td>
                                                                    <td><?= htmlspecialchars($kh['so_don_hang']) ?></td>
                                                                    <td><?= number_format($kh['tong_tien']) ?> VND</td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table><!-- end table -->
                                                </div>
                                            </div>
                                        </div> <!-- .card-->
                                    </div> <!-- .col-->
                                </div> <!-- end row-->

                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Người Dùng Mới</h4>
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="table-responsive table-card">
                                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>Tên Người Dùng</th>
                                                                <th>Email</th>
                                                                <th>Ngày Tạo</th>
                                                                <th>Giới Tính</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                
                                                            <?php $stt = 1; // Khởi tạo số thứ tự 
                                                            foreach ($khacHangMois as $khm): ?>
                                                                <tr>
                                                                    <td><?= $stt++ ?></td> <!-- Hiển thị số thứ tự và tăng dần -->
                                                                    <td><?= ($khm['ten']) ?></td>
                                                                    <td><?= ($khm['email']) ?></td>
                                                                    <td><?= ($khm['ngay_tao']) ?></td>
                                                                    <td>
                                                            <?php
                                                            // Check the 'status' field instead of 'category_name'
                                                            if ($khm['gioi_tinh'] == '1') { ?>
                                                                <span class="badge bg-success">Nam</span>
                                                                <?php
                                                            } else { ?>
                                                                <span class="badge bg-danger">Nữ</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table><!-- end table -->
                                                </div>
                                            </div>
                                        </div> <!-- .card-->
                                    </div> <!-- .col-->
                                    <div class="col-xl-6">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Sản Phẩm Mới</h4>
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="table-responsive table-card">
                                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>Tên Sản Phẩm</th>
                                                                <th>Số Lượng</th>
                                                                <th>Giá</th>
                                                                <th>Ngày Tạo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                
                                                            <?php $stt = 1; // Khởi tạo số thứ tự 
                                                            foreach ($sanPhamMois as $spm): ?>
                                                                <tr>
                                                                    <td><?= $stt++ ?></td> <!-- Hiển thị số thứ tự và tăng dần -->
                                                                    <td><?= ($spm['ten_san_pham']) ?></td>
                                                                    <td><?= ($spm['so_luong']) ?></td>
                                                                    <td><?= number_format($spm['gia']) ?> VND</td>
                                                                    <td><?= ($spm['ngay_tao']) ?> </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table><!-- end table -->
                                                </div>
                                            </div>
                                        </div> <!-- .card-->
                                    </div> <!-- .col-->
                                </div> <!-- end row-->

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
    require_once "layouts/libs_js.php";
    ?>
    <!-- Chart code -->
</body>

</html>