<?php require_once "./views/header.php"; ?>
    <title>Danh sách đơn hàng</title>
<body>
    <!-- Thêm Font Awesome cho icon -->
    <div class="container mt-5">
    <h2 class="text-center mb-4 text-dark">Danh sách đơn hàng của bạn</h2>

    <!-- Hiển thị thông báo -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Card chứa bảng -->
    <div class="card shadow-lg border-0 rounded">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái thanh toán</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $index => $order):?>
                        
                            <tr class="table-row">
                                <td><?= $index + 1 ?></td>
                                <td><?= $order['ma_don_hang']; ?></td>
                                <td><?= date('d/m/Y', strtotime($order['ngay_dat_hang'])) ?></td>
                                <td>
                                    <?= $order['phuong_thuc_thanh_toan'] == 1 ? 'Chuyển khoản' : 'Thanh toán khi nhận hàng' ?>
                                </td>
                                <td>
                                    <!-- Trạng thái thanh toán -->
                                    <span class="badge <?= $order['trang_thai_thanh_toan'] == 1 ? 'badge-paid' : 'badge-unpaid' ?>">
                                        <?= $order['trang_thai_thanh_toan'] == 1 ? '<i class="fas fa-check-circle"></i> Đã thanh toán' : 'Chưa thanh toán' ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    // Kiểm tra trạng thái đơn hàng
                                        $trang_thai_don_hang = [
                                            11 => "Đã đặt hàng",
                                            12 => "Đang xử lý",
                                            13 => "Đã xác nhận",
                                            14 => "Đang giao hàng",
                                            15 => "Đã giao hàng",
                                            16 => "Đã hủy",
                                            17 => "Hoàn đơn"
                                        ];
                                        echo "" . (isset($order['trang_thai_don_hang']) ? $order['trang_thai_don_hang'] : "Không xác định");
                                    ?>
                                </td>
                              <td>
                                <!-- Nút "Xem chi tiết" -->
                                <a href="?act=ctdonhang&id=<?= isset($order['don_hang_id']) ? $order['don_hang_id'] : '' ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> Xem chi tiết
                                </a>
                                <?php 
                                // Kiểm tra trạng thái đơn hàng là "Đã đặt hàng" (11) hoặc "Đang xử lý" (12)
                                if ($order['trang_thai_don_hang'] == $trang_thai_don_hang[11] || $order['trang_thai_don_hang'] == $trang_thai_don_hang[12]): 
                                ?>
                                    <!-- Form hủy đơn hàng -->
                                    <form action="?act=huydonhang" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                        <input type="hidden" name="id" value="<?= $order['don_hang_id'] ?>"/>
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Hủy
                                        </button>
                                    </form>
                                <?php endif ?>
                            </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Không có đơn hàng nào</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Thêm hiệu ứng hover cho bảng -->
<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa; /* Màu nền sáng khi hover */
        transform: scale(1.02); /* Hiệu ứng phóng to nhẹ */
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    /* Các style cho badge thanh toán */
    .badge-paid {
        background-color: #28a745; /* Màu xanh lá cây */
        color: white;
        padding: 8px 12px;
        font-size: 14px;
        border-radius: 12px;
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.4); /* Ánh sáng nhẹ xung quanh */
    }

    .badge-unpaid {
        background-color: #ffc107; /* Màu vàng */
        color: white;
        padding: 8px 12px;
        font-size: 14px;
        border-radius: 12px;
        box-shadow: 0 0 5px rgba(255, 193, 7, 0.4); /* Ánh sáng nhẹ xung quanh */
    }

    .badge-paid:hover {
        background-color: #218838; /* Thay đổi màu khi hover */
        cursor: pointer;
        transform: scale(1.05); /* Hiệu ứng zoom khi hover */
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    /* Button xem chi tiết và hủy */
    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }

    .card {
        background-color: #f8f9fa;
    }
</style>

<!-- Thêm thư viện Font Awesome cho icon -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</div>
</body>
<?php require_once "./views/footer.php"; ?>
