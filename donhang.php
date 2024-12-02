<?php require_once "./views/header.php"; ?>
    <title>Danh sách đơn hàng</title>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4 text-dark">Danh sách đơn hàng của bạn</h2>

        <!-- Hiển thị thông báo -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_SESSION['message']); ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); ?></div>
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
                            <?php foreach ($orders as $index => $order): ?>
                                <tr class="table-row">
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($order['ma_don_hang']); ?></td>
                                    <td><?= date('d/m/Y', strtotime($order['ngay_dat_hang'])); ?></td>
                                    <td>
                                        <?= $order['phuong_thuc_thanh_toan'] == 1 ? 'Chuyển khoản' : 'Thanh toán khi nhận hàng'; ?>
                                    </td>
                                    <td>
                                        <span class="badge <?= $order['trang_thai_thanh_toan'] == 1 ? 'badge-paid' : 'badge-unpaid'; ?>">
                                            <?= $order['trang_thai_thanh_toan'] == 1 ? '<i class="fas fa-check-circle"></i> Đã thanh toán' : 'Chưa thanh toán'; ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($order['trang_thai_don_hang']); ?></td>
                                    <td>
                                        <a href="?act=ctdonhang&id=<?= htmlspecialchars($order['don_hang_id']); ?>" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i> Xem chi tiết
                                        </a>
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

    <!-- CSS giữ nguyên hiệu ứng và thiết kế -->
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

        /* Nút thao tác */
        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        .card {
            background-color: #f8f9fa;
        }
    </style>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
<?php require_once "./views/footer.php"; ?>
