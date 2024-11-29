<?php
class Donhang {
    private $conn;

    public function __construct() {
        $this->conn = connectDB(); // Hàm kết nối cơ sở dữ liệu
    }

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
                ORDER BY dh.id DESC  -- Sắp xếp theo ID đơn hàng mới nhất
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về tất cả đơn hàng còn lại
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }

    // Lấy chi tiết đơn hàng
    public function getOrderDetailsByDonHangId($don_hang_id) {
        try {
            // SQL để lấy chi tiết đơn hàng theo don_hang_id và thông tin người dùng
            $sql = "
                SELECT 
                    dh.ho_ten_nguoi_nhan,
                    dh.email_nguoi_nhan,
                    dh.so_dien_thoai_nguoi_nhan,
                    dh.dia_chi_nhan_hang,
                    dh.id AS don_hang_id,
                    dh.ma_don_hang, 
                    dh.ngay_dat_hang, 
                    dh.phuong_thuc_thanh_toan,
                    dh.trang_thai_thanh_toan,
                    dh.ghi_chu,
                    ttdh.ten_trang_thai AS trang_thai_don_hang,
                    sp.ten_san_pham, 
                    sp.hinh_anh, 
                    ctdh.so_luong, 
                    ctdh.don_gia, 
                    (ctdh.so_luong * ctdh.don_gia) AS thanh_tien,
                    nd.ten AS ten_nguoi_dat,
                    nd.email AS email_nguoi_dat,
                    nd.so_dien_thoai AS sdt_nguoi_dat
                FROM don_hangs dh
                JOIN nguoi_dungs nd ON dh.nguoi_dung_id = nd.id
                JOIN chi_tiet_don_hangs ctdh ON dh.id = ctdh.don_hang_id
                JOIN san_phams sp ON ctdh.san_pham_id = sp.id
                LEFT JOIN trang_thai_don_hangs ttdh ON dh.trang_thai_id = ttdh.id
                WHERE dh.id = :donHangId
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':donHangId', $don_hang_id, PDO::PARAM_INT); // Đảm bảo bind đúng biến
            $stmt->execute();
    
            // Kiểm tra và trả về kết quả
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }
    
    

        // Phương thức lấy thông tin đơn hàng theo ma_don_hang
        public function getOrderById($id) {
            try {
                // Lấy thông tin đơn hàng theo ID
                $sql = "SELECT * FROM don_hangs WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin đơn hàng
            } catch (PDOException $e) {
                echo 'Lỗi: ' . $e->getMessage();
                return null; // Trả về null nếu có lỗi
            }
        }
        
        // Phương thức xóa đơn hàng theo ma_don_hang chỉ nếu trạng thái là "Đã đặt hàng" hoặc "Đang xử lý"
        public function xoaChiTietDonHangTheoDonHangId($don_hang_id) {
            try {
                $sql = "DELETE FROM chi_tiet_don_hangs WHERE don_hang_id = :don_hang_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':don_hang_id', $don_hang_id, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                echo 'Lỗi: ' . $e->getMessage();
                return false;
            }
        }        
        public function xoaDonHangTheoId($id) {
            try {
                // Xóa dữ liệu liên quan trong chi_tiet_don_hangs trước
                $this->xoaChiTietDonHangTheoDonHangId($id);
        
                // Xóa đơn hàng
                $sql = "DELETE FROM don_hangs WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log('Lỗi SQL: ' . $e->getMessage());
                return false;
            }
        }
        
    }
