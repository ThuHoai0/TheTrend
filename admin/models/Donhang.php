<?php

class Donhang
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function getAll() {
        try {
            $sql = "SELECT don_hangs.*, nguoi_dungs.ten AS ten_nguoi_dung, trang_thai_don_hangs.ten_trang_thai FROM 
            `don_hangs` INNER JOIN nguoi_dungs ON nguoi_dungs.id = don_hangs.nguoi_dung_id
            			INNER JOIN trang_thai_don_hangs ON trang_thai_don_hangs.id = don_hangs.trang_thai_id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function getBySearch($search) {
        // Chuẩn bị câu lệnh SQL với dấu phần trăm bao quanh biến tìm kiếm
        $sql = "SELECT * FROM don_hangs WHERE nguoi_dung_id LIKE :search";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);

        // Thực hiện binding tham số (thêm % vào chuỗi tìm kiếm)
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

        // Thực thi câu lệnh
        $stmt->execute();

        // Lấy tất cả kết quả dưới dạng mảng
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteData($id) {
        try {
            $sql = "DELETE FROM `don_hangs` WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }


    public function getDetailData($id) {
        try {
            $sql = "SELECT dhs.*,
                        nguoi_dungs.ten AS ten_nguoi_dung,
                        dhs.dia_chi_nhan_hang,
                        san_phams.ten_san_pham,
                        chi_tiet_don_hangs.so_luong,
                        chi_tiet_don_hangs.don_gia,
                        nguoi_dungs.email,
                        nguoi_dungs.so_dien_thoai,
                        trang_thai_don_hangs.ten_trang_thai
                    FROM
                        `don_hangs` AS dhs
                    LEFT JOIN chi_tiet_don_hangs ON chi_tiet_don_hangs.don_hang_id = dhs.id
                    LEFT JOIN san_phams ON san_phams.id = chi_tiet_don_hangs.san_pham_id
                    LEFT JOIN nguoi_dungs ON nguoi_dungs.id = dhs.nguoi_dung_id
                    LEFT JOIN trang_thai_don_hangs ON trang_thai_don_hangs.id = dhs.trang_thai_id
                    WHERE dhs.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về dữ liệu chi tiết của đơn hàng
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    // Cập nhật thông tin đơn hàng
    public function updateData($id, $trang_thai_don_hang) {
        try {
            $sql = "UPDATE don_hangs SET
                        trang_thai_id = :trang_thai_don_hang
                    WHERE id = :id";
            
            // Chuẩn bị câu lệnh SQL
            $stmt = $this->conn->prepare($sql);
    
            // Bind dữ liệu từ các tham số vào câu SQL
            $stmt->bindParam(':trang_thai_don_hang', $trang_thai_don_hang);
            $stmt->bindParam(':id', $id); // Tham số id
    
            // Thực thi câu lệnh SQL và trả về kết quả
            return $stmt->execute();
        } catch (PDOException $e) {
            // Nếu có lỗi trong quá trình thực thi câu lệnh, hiển thị thông báo lỗi
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }public function updateData1($id, $trang_thai_don_hang) {
        try {
            $sql = "UPDATE don_hangs SET
                        trang_thai_thanh_toan = :trang_thai_don_hang
                    WHERE id = :id";

            // Chuẩn bị câu lệnh SQL
            $stmt = $this->conn->prepare($sql);

            // Bind dữ liệu từ các tham số vào câu SQL
            $stmt->bindParam(':trang_thai_don_hang', $trang_thai_don_hang);
            $stmt->bindParam(':id', $id); // Tham số id

            // Thực thi câu lệnh SQL và trả về kết quả
            return $stmt->execute();
        } catch (PDOException $e) {
            // Nếu có lỗi trong quá trình thực thi câu lệnh, hiển thị thông báo lỗi
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    
    
    public function getOrderInfo($id) {
        try {
            $sql = "SELECT dhs.ma_don_hang,
               dhs.phuong_thuc_thanh_toan,
               dhs.trang_thai_thanh_toan,
               dhs.dia_chi_nhan_hang,
               dhs.ngay_dat_hang,
               dhs.ghi_chu,
               dhs.tong_tien,
               dhs.trang_thai_id,
               nguoi_dungs.ten AS ten_nguoi_dung,
               nguoi_dungs.email,
               nguoi_dungs.so_dien_thoai,
               dhs.ho_ten_nguoi_nhan,
               dhs.so_dien_thoai_nguoi_nhan,
               dhs.email_nguoi_nhan,
               trang_thai_don_hangs.ten_trang_thai
        FROM `don_hangs` AS dhs
        LEFT JOIN nguoi_dungs ON nguoi_dungs.id = dhs.nguoi_dung_id
        LEFT JOIN trang_thai_don_hangs ON trang_thai_don_hangs.id = dhs.trang_thai_id
        WHERE dhs.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về một dòng thông tin đơn hàng
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getOrderProducts($id) {
        try {
            $sql = "SELECT san_phams.ten_san_pham,
                       chi_tiet_don_hangs.so_luong,
                       chi_tiet_don_hangs.don_gia
                FROM `chi_tiet_don_hangs`
                LEFT JOIN san_phams ON san_phams.id = chi_tiet_don_hangs.san_pham_id
                WHERE chi_tiet_don_hangs.don_hang_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách sản phẩm
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }







    public function __destruct() {
        $this->conn = null;
    }
}