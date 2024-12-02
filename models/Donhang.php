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

    public function getOrderDetailsByDonHangId($don_hang_id) {
        try {
            // SQL để lấy chi tiết đơn hàng kết hợp thông tin người dùng
            $sql = "
                SELECT 
                    dh.id AS don_hang_id,
                    dh.ma_don_hang, 
                    dh.ngay_dat_hang, 
                    dh.phuong_thuc_thanh_toan,
                    dh.trang_thai_thanh_toan,
                    dh.ho_ten_nguoi_nhan,
                    dh.email_nguoi_nhan,
                    dh.so_dien_thoai_nguoi_nhan,
                    dh.dia_chi_nhan_hang,
                    ttdh.ten_trang_thai AS trang_thai_don_hang,
                    sp.ten_san_pham, 
                    sp.hinh_anh, 
                    ctdh.so_luong, 
                    ctdh.don_gia, 
                    (ctdh.so_luong * ctdh.don_gia) AS thanh_tien,
                    
                    -- Thông tin người đặt hàng
                    nd.ten AS ten_nguoi_dat,
                    nd.email AS email_nguoi_dat,
                    nd.so_dien_thoai AS sdt_nguoi_dat,
                    dh.ghi_chu AS ghi_chu
    
                FROM don_hangs dh
                JOIN chi_tiet_don_hangs ctdh ON dh.id = ctdh.don_hang_id
                JOIN san_phams sp ON ctdh.san_pham_id = sp.id
                LEFT JOIN trang_thai_don_hangs ttdh ON dh.trang_thai_id = ttdh.id
                LEFT JOIN nguoi_dungs nd ON dh.nguoi_dung_id = nd.id -- JOIN bảng nguoi_dungs
    
                WHERE dh.id = :donHangId
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':donHangId', $don_hang_id, PDO::PARAM_INT);
            $stmt->execute();

            // Trả về chi tiết của đơn hàng
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }


    // Xóa đơn hàng theo ID nếu thỏa mãn điều kiện
    // Phương thức lấy đơn hàng theo id
    public function getOrderById($id) {
        try {
            $sql = "SELECT * FROM don_hangs WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin đơn hàng
        } catch (PDOException $e) {
            return null; // Trả về null nếu có lỗi
        }
    }

    // Phương thức xóa đơn hàng theo id
    public function xoaDonHangTheoId($id) {
        try {
            // Bắt đầu giao dịch
            $this->conn->beginTransaction();
    
            // Lấy danh sách chi tiết đơn hàng để xử lý trả sản phẩm
            $sqlGetChiTiet = "SELECT san_pham_id, so_luong FROM chi_tiet_don_hangs WHERE don_hang_id = :id";
            $stmtGetChiTiet = $this->conn->prepare($sqlGetChiTiet);
            $stmtGetChiTiet->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtGetChiTiet->execute();
            $chiTietDonHang = $stmtGetChiTiet->fetchAll(PDO::FETCH_ASSOC);
    
            // Trả lại sản phẩm vào kho
            foreach ($chiTietDonHang as $chiTiet) {
                $sqlUpdateKho = "UPDATE san_phams SET so_luong = so_luong + :so_luong WHERE id = :san_pham_id";
                $stmtUpdateKho = $this->conn->prepare($sqlUpdateKho);
                $stmtUpdateKho->bindParam(':so_luong', $chiTiet['so_luong'], PDO::PARAM_INT);
                $stmtUpdateKho->bindParam(':san_pham_id', $chiTiet['san_pham_id'], PDO::PARAM_INT);
                $stmtUpdateKho->execute();
    
                // Kiểm tra nếu không thể cập nhật kho
                if ($stmtUpdateKho->rowCount() <= 0) {
                    throw new Exception("Không thể trả sản phẩm vào kho.");
                }
            }
    
            // Xóa chi tiết đơn hàng
            $sqlChiTiet = "DELETE FROM chi_tiet_don_hangs WHERE don_hang_id = :id";
            $stmtChiTiet = $this->conn->prepare($sqlChiTiet);
            $stmtChiTiet->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtChiTiet->execute();
    
            // Kiểm tra nếu có lỗi trong việc xóa chi tiết đơn hàng
            if ($stmtChiTiet->rowCount() <= 0) {
                throw new Exception("Không thể xóa chi tiết đơn hàng.");
            }
    
            // Xóa đơn hàng chính
            $sqlDonHang = "DELETE FROM don_hangs WHERE id = :id";
            $stmtDonHang = $this->conn->prepare($sqlDonHang);
            $stmtDonHang->bindParam(':id', $id, PDO::PARAM_INT);
            $stmtDonHang->execute();
    
            // Kiểm tra nếu có lỗi trong việc xóa đơn hàng
            if ($stmtDonHang->rowCount() <= 0) {
                throw new Exception("Không thể xóa đơn hàng.");
            }
    
            // Commit giao dịch
            $this->conn->commit();
            return true;
    
        } catch (Exception $e) {
            // Rollback nếu có lỗi
            $this->conn->rollBack();
            echo 'Lỗi: ' . $e->getMessage();
            return false; // Trả về false nếu có lỗi
        }
    }

    public function capNhatTrangThaiDonHang($don_hang_id, $trang_thai_moi) {
        try {
            // Kiểm tra xem đơn hàng có tồn tại hay không
            $sqlCheck = "SELECT id FROM don_hangs WHERE id = :don_hang_id";
            $stmtCheck = $this->conn->prepare($sqlCheck);
            $stmtCheck->bindParam(':don_hang_id', $don_hang_id, PDO::PARAM_INT);
            $stmtCheck->execute();

            // Nếu không tìm thấy đơn hàng
            if ($stmtCheck->rowCount() === 0) {
                return [
                    'success' => false,
                    'message' => 'Đơn hàng không tồn tại.'
                ];
            }

            // Cập nhật trạng thái đơn hàng với tên trạng thái thay vì ID
            $sqlUpdate = "UPDATE don_hangs SET trang_thai_id = :trang_thai_id WHERE id = :don_hang_id"; // Chỉnh sửa theo tên cột trang_thai
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':trang_thai', $trang_thai_moi, PDO::PARAM_STR); // Đảm bảo bind đúng kiểu dữ liệu là string
            $stmtUpdate->bindParam(':don_hang_id', $don_hang_id, PDO::PARAM_INT);
            $stmtUpdate->execute();

            // Kiểm tra xem có thực sự cập nhật không
            if ($stmtUpdate->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Cập nhật trạng thái đơn hàng thành công.'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Không có thay đổi trạng thái nào được thực hiện.'
                ];
            }
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ];
        }
    }


//    public function layTenTrangThai($trang_thai_id) {
//        try {
//            // Lấy tên trạng thái từ bảng trang_thai
//            $sql = "SELECT ten_trang_thai FROM trang_thai WHERE id = :trang_thai_id";
//            $stmt = $this->conn->prepare($sql);
//            $stmt->bindParam(':trang_thai_id', $trang_thai_id, PDO::PARAM_INT);
//            $stmt->execute();
//
//            // Kiểm tra kết quả và trả về tên trạng thái
//            if ($stmt->rowCount() > 0) {
//                $row = $stmt->fetch(PDO::FETCH_ASSOC);
//                return $row['ten_trang_thai']; // Trả về tên trạng thái
//            } else {
//                return null; // Nếu không tìm thấy trạng thái
//            }
//        } catch (PDOException $e) {
//            return null; // Nếu có lỗi
//        }
//    }







}

