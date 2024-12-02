<?php
class Dathang {
    private $conn;

    public function __construct() {
        $this->conn = connectDB(); // Kết nối cơ sở dữ liệu
    }

    // Lưu thông tin đơn hàng vào cơ sở dữ liệu
    public function saveOrder($order_data) {
        try {
            // Khởi tạo đối tượng Donhang để lấy tổng tiền
            $donhang = new Donhang();
            $tong_tien = $donhang->getTongTienByDonHangId($order_data['don_hang_id']); // Lấy tổng tiền từ Donhang

            // Cập nhật tổng tiền vào mảng dữ liệu đơn hàng
            $order_data['tong_tien'] = $tong_tien;

            // Lưu thông tin đơn hàng vào cơ sở dữ liệu
            $sql = "
                INSERT INTO don_hangs (
                    ho_ten_nguoi_nhan, 
                    so_dien_thoai_nguoi_nhan, 
                    email_nguoi_nhan, 
                    dia_chi_nhan_hang, 
                    ghi_chu, 
                    phuong_thuc_thanh_toan, 
                    tong_tien, 
                    trang_thai_id, 
                    ngay_dat_hang
                ) VALUES (
                    :ho_ten_nguoi_nhan, 
                    :so_dien_thoai_nguoi_nhan, 
                    :email_nguoi_nhan, 
                    :dia_chi_nhan_hang, 
                    :ghi_chu, 
                    :phuong_thuc_thanh_toan, 
                    :tong_tien, 
                    :trang_thai_id, 
                    :ngay_dat_hang
                )
            ";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten_nguoi_nhan' => $order_data['ho_ten_nguoi_nhan'],
                ':so_dien_thoai_nguoi_nhan' => $order_data['so_dien_thoai_nguoi_nhan'],
                ':email_nguoi_nhan' => $order_data['email_nguoi_nhan'],
                ':dia_chi_nhan_hang' => $order_data['dia_chi_nhan_hang'],
                ':ghi_chu' => $order_data['ghi_chu'],
                ':phuong_thuc_thanh_toan' => $order_data['phuong_thuc_thanh_toan'],
                ':tong_tien' => $order_data['tong_tien'],
                ':trang_thai_id' => $order_data['trang_thai_id'],
                ':ngay_dat_hang' => $order_data['ngay_dat_hang']
            ]);

            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
}
?>
