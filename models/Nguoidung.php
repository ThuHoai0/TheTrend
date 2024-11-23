<?php

class Nguoidung
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }
 

    public function updateData($id, $email, $mat_khau, $dia_chi, $so_dien_thoai, $gioi_tinh, $ngay_sinh)
    {
        try {
            $sql = "UPDATE nguoi_dung SET email = :email, mat_khau = :mat_khau, dia_chi = :dia_chi, so_dien_thoai = :so_dien_thoai, gioi_tinh = :gioi_tinh, ngay_sinh = :ngay_sinh WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mat_khau', $mat_khau);
            $stmt->bindParam(':dia_chi', $dia_chi);
            $stmt->bindParam(':so_dien_thoai', $so_dien_thoai);
            $stmt->bindParam(':gioi_tinh', $gioi_tinh);
            $stmt->bindParam(':ngay_sinh', $ngay_sinh);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Lỗi khi cập nhật: ' . $e->getMessage();
            return false;
        }
    }
    




    public function getDetailData($id) {
        try {
            $sql = "SELECT * FROM nguoi_dungs WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về dạng mảng kết hợp để dễ dàng lấy dữ liệu
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Lỗi khi lấy dữ liệu chi tiết: ' . $e->getMessage();
            return false;
        }
    }
}