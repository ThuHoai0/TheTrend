<!-- ctdonhang.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Chi Tiết Đơn Hàng</h2>
        <form action="#" method="POST" class="shadow-lg p-4 rounded">
            <?php foreach ($orderDetails as $order): ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="maDonHang" class="form-label">Mã đơn hàng</label>
                        <input type="text" id="maDonHang" name="ma_don_hang" class="form-control" value="<?= $order['ma_don_hang'] ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="ngayDatHang" class="form-label">Ngày đặt hàng</label>
                        <input type="text" id="ngayDatHang" name="ngay_dat_hang" class="form-control" value="<?= $order['ngay_dat_hang'] ?>" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phuongThucThanhToan" class="form-label">Phương thức thanh toán</label>
                        <select id="phuongThucThanhToan" name="phuong_thuc_thanh_toan" class="form-select" disabled>
                            <option value="1" <?= $order['phuong_thuc_thanh_toan'] == 1 ? 'selected' : '' ?>>Chuyển khoản</option>
                            <option value="0" <?= $order['phuong_thuc_thanh_toan'] == 0 ? 'selected' : '' ?>>Thanh toán khi nhận hàng</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="trangThaiThanhToan" class="form-label">Trạng thái thanh toán</label>
                        <select id="trangThaiThanhToan" name="trang_thai_thanh_toan" class="form-select" disabled>
                            <option value="1" <?= $order['trang_thai_thanh_toan'] == 1 ? 'selected' : '' ?>>Đã Thanh Toán</option>
                            <option value="0" <?= $order['trang_thai_thanh_toan'] == 0 ? 'selected' : '' ?>>Chưa Thanh Toán</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="hoTenNguoiNhan" class="form-label">Họ tên người nhận</label>
                        <input type="text" id="hoTenNguoiNhan" name="ho_ten_nguoi_nhan" class="form-control" value="<?= $order['ho_ten_nguoi_nhan'] ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="soDienThoai" class="form-label">Số điện thoại người nhận</label>
                        <input type="text" id="soDienThoai" name="so_dien_thoai_nguoi_nhan" class="form-control" value="<?= $order['so_dien_thoai_nguoi_nhan'] ?>" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="emailNguoiNhan" class="form-label">Email người nhận</label>
                        <input type="email" id="emailNguoiNhan" name="email_nguoi_nhan" class="form-control" value="<?= $order['email_nguoi_nhan'] ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="diaChiNhanHang" class="form-label">Địa chỉ nhận hàng</label>
                        <input type="text" id="diaChiNhanHang" name="dia_chi_nhan_hang" class="form-control" value="<?= $order['dia_chi_nhan_hang'] ?>" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="ghiChu" class="form-label">Ghi chú</label>
                    <textarea id="ghiChu" name="ghi_chu" class="form-control" rows="3" readonly><?= $order['ghi_chu'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="tongTien" class="form-label">Tổng tiền</label>
                    <input type="text" id="tongTien" name="tong_tien" class="form-control" value="<?= number_format($order['tong_tien'], 0, ',', '.') ?> VND" readonly>
                </div>
                <div class="mb-3">
                    <label for="trangThaiDonHang" class="form-label">Trạng thái đơn hàng</label>
                    <select id="trangThaiDonHang" name="trang_thai" class="form-select">
                        <option value="12" <?= $order['trang_thai_don_hang'] == 12 ? 'selected' : '' ?>>Đang xử lý</option>
                        <option value="13" <?= $order['trang_thai_don_hang'] == 13 ? 'selected' : '' ?>>Đã xác nhận</option>
                        <option value="14" <?= $order['trang_thai_don_hang'] == 14 ? 'selected' : '' ?>>Đang giao hàng</option>
                        <option value="15" <?= $order['trang_thai_don_hang'] == 15 ? 'selected' : '' ?>>Đã giao hàng</option>
                        <option value="16" <?= $order['trang_thai_don_hang'] == 16 ? 'selected' : '' ?>>Đã hủy</option>
                    </select>
                </div>
            <?php endforeach; ?>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Cập nhật đơn hàng</button>
            </div>
        </form>
    </div>
</body>
</html>
