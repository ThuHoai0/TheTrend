<?php
class Donhang {
    private $conn;

    public function __construct() {
        $this->conn = connectDB(); // Hàm kết nối cơ sở dữ liệu
    }

    // Lấy tất cả các đơn hàng (ngoại trừ trạng thái "Đã hủy")
    public function getAllDH() {
        try {
            $sql = "
                SELECT 
                    dh.id AS don_hang_id, 
                    dh.ma_don_hang, 
                    dh.ngay_dat_hang, 
                    dh.tong_tien, 
                    dh.phuong_thuc_thanh_toan, 
                    dh.trang_thai_thanh_toan, 
                    dh.ho_ten_nguoi_nhan, 
                    dh.so_dien_thoai_nguoi_nhan, 
                    dh.email_nguoi_nhan, 
                    dh.dia_chi_nhan_hang, 
                    dh.ghi_chu, 
                    ttdh.ten_trang_thai AS trang_thai_don_hang 
                FROM don_hangs dh
                LEFT JOIN trang_thai_don_hangs ttdh 
                ON dh.trang_thai_id = ttdh.id
                WHERE dh.trang_thai_id != 16  -- Lọc bỏ đơn hàng có trạng thái 'Đã hủy'
                ORDER BY dh.id DESC
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }

    // Tính tổng tiền của một đơn hàng
    public function getTongTienByDonHangId($don_hang_id) {
        try {
            $sql = "SELECT SUM(ctdh.so_luong * ctdh.don_gia) AS tong_tien
                FROM chi_tiet_don_hangs ctdh
                WHERE ctdh.don_hang_id = :don_hang_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':don_hang_id', $don_hang_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['tong_tien'] ?? 0; // Trả về 0 nếu không có giá trị
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return 0;
        }
    }

    public function getOrderDetailsByDonHangId($donHangId) {
        try {
            // SQL để lấy chi tiết đơn hàng theo don_hang_id
            $sql = "
                SELECT 
                    dh.id AS don_hang_id,
                    dh.ma_don_hang, 
                    dh.ngay_dat_hang, 
                    dh.phuong_thuc_thanh_toan,
                    dh.trang_thai_thanh_toan,
                    ttdh.ten_trang_thai AS trang_thai_don_hang,
                    sp.ten_san_pham, 
                    sp.hinh_anh, 
                    ctdh.so_luong, 
                    ctdh.don_gia, 
                    (ctdh.so_luong * ctdh.don_gia) AS thanh_tien
                FROM don_hangs dh
                JOIN chi_tiet_don_hangs ctdh ON dh.id = ctdh.don_hang_id
                JOIN san_phams sp ON ctdh.san_pham_id = sp.id
                LEFT JOIN trang_thai_don_hangs ttdh ON dh.trang_thai_id = ttdh.id
                WHERE dh.id = :donHangId
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':donHangId', $donHangId, PDO::PARAM_INT);
            $stmt->execute();

            // Trả về chi tiết của đơn hàng
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }


}
?>
