<?php require_once "./views/header.php"; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="styles.css" rel="stylesheet"> <!-- Thêm đường dẫn tới file CSS của bạn -->
<style>
    /* styles.css */
    body {
        background-color: #f8f9fa; /* Nền sáng */
        color: #333; /* Màu chữ mặc định */
    }

    /* Xóa gạch chân cho các liên kết */
    a {
        text-decoration: none !important;
    }

    /* Thêm kiểu cho các tiêu đề và phần tử trong card */
    .card-header {
        background-color: #007bff;
        color: white;
    }

    .card-body h5 {
        font-size: 1.25rem;
        font-weight: 600;
    }

    .table th, .table td {
        padding: 0.75rem;
        text-align: center;
    }

    /* Định dạng badge */
    .badge {
        padding: 0.5rem 1rem;
    }

    /* Các nút và danh sách */
    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    /* Thêm các kiểu cho button "Trở Về" */
    .text-end {
        text-align: right;
    }

    /* Kiểu danh sách tổng tiền */
    .list-group-item {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
    }

</style>
<body>
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 50px">
            <div class="col">
                <div class="h-100">
                    <div class="card" style="padding-bottom: 50px">
                        <div class="container mt-5">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Quản lý danh sách đơn hàng | <?= htmlspecialchars($don_hang['ma_don_hang']) ?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <span class="badge bg-success">Đơn hàng: <?= htmlspecialchars($don_hang['trang_thai_don_hang']) ?></span>
                                        <span class="badge bg-primary text-white">
                                            Phương thức thanh toán: 
                                            <?= $don_hang['phuong_thuc_thanh_toan'] == 1 ? 'Chuyển khoản' : 'Thanh toán khi nhận hàng' ?>
                                        </span>
                                        <span class="badge bg-warning text-dark">
                                            Trạng thái thanh toán: 
                                            <?= $don_hang['trang_thai_thanh_toan'] == 1 ? 'Đã thanh toán' : 'Chưa thanh toán' ?>
                                        </span>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h5>Thông tin người đặt </h5>
                                            <p><strong>Tên:</strong> <?= htmlspecialchars($don_hang['ten_nguoi_dat']) ?></p>
                                            <p><strong>Email:</strong> <?= htmlspecialchars($don_hang['email_nguoi_dat']) ?></p>
                                            <p><strong>SĐT:</strong> <?= htmlspecialchars($don_hang['sdt_nguoi_dat']) ?></p>
                                            <p><strong>Ghi chú:</strong> <?= htmlspecialchars($don_hang['ghi_chu']) ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Thông tin người nhận</h5>
                                            <p><strong>Tên:</strong> <?= htmlspecialchars($don_hang['ho_ten_nguoi_nhan']) ?></p>
                                            <p><strong>Email:</strong> <?= htmlspecialchars($don_hang['email_nguoi_nhan']) ?></p>
                                            <p><strong>SĐT:</strong> <?= htmlspecialchars($don_hang['so_dien_thoai_nguoi_nhan']) ?></p>
                                            <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($don_hang['dia_chi_nhan_hang']) ?></p>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                            <tr>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($san_pham as $sp): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($sp['ten_san_pham']) ?></td>
                                                <td><?= htmlspecialchars($sp['so_luong']) ?></td>
                                                <td><?= number_format($sp['don_gia'], 0, ',', '.') ?>đ</td>
                                                <td><?= number_format($sp['thanh_tien'], 0, ',', '.') ?>đ</td>
                                            </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4">
                                        <ul class="list-group w-50">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Tổng tiền:</span>
                                                <strong class="text-danger">
                                                    <?= number_format(array_sum(array_column($san_pham, 'thanh_tien')), 0, ',', '.') ?>đ
                                                </strong>
                                            </li>
                                        </ul>
                                    </div>
                                    <br>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <?php
                                            if ($don_hang['trang_thai_don_hang'] === 'Đã giao hàng'):
                                            ?>
                                            <button type="button" class="btn btn-primary" onclick="">Đã nhận hàng</button>
                                            <?php
                                            endif;
                                            ?>
                                            <button type="button" class="btn btn-primary" onclick="history.back()">Trở Về</button>
                                        </div>
                                        <?php if ($don_hang['trang_thai_don_hang'] === 'Đã đặt hàng'): ?>
                                            <form action="?act=huydonhang" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($don_hang['don_hang_id']) ?>" />
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Hủy
                                                </button>
                                            </form>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
<?php require_once "./views/footer.php"; ?>