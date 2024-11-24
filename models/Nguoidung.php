<?php

class Nguoidung
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }


    public function updateUser($id, $email, $mat_khau, $dia_chi, $so_dien_thoai, $gioi_tinh, $ngay_sinh)
    {
        try {
            $sql = "UPDATE nguoi_dung 
                    SET email = :email, 
                        mat_khau = :mat_khau, 
                        dia_chi = :dia_chi, 
                        so_dien_thoai = :so_dien_thoai, 
                        gioi_tinh = :gioi_tinh, 
                        ngay_sinh = :ngay_sinh 
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':mat_khau', $mat_khau, PDO::PARAM_STR);
            $stmt->bindParam(':dia_chi', $dia_chi, PDO::PARAM_STR);
            $stmt->bindParam(':so_dien_thoai', $so_dien_thoai, PDO::PARAM_STR);
            $stmt->bindParam(':gioi_tinh', $gioi_tinh, PDO::PARAM_STR);
            $stmt->bindParam(':ngay_sinh', $ngay_sinh, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Lỗi cập nhật người dùng: ' . $e->getMessage());
            return false;
        }
    }

    // Phương thức lấy thông tin chi tiết người dùng
    public function getUserById($id)
    {
        try {
            $sql = "SELECT * FROM nguoi_dungs WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Lỗi lấy thông tin người dùng: ' . $e->getMessage());
            return false;
        }
    }
}