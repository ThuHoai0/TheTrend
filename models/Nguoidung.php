<?php

class Nguoidung
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

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

    public function updatePassword($id, $hashed_password)
    {
        try {
            // Xác định câu truy vấn SQL
            $sql = "UPDATE nguoi_dungs 
                    SET mat_khau = :mat_khau
                    WHERE id = :id";

            // Chuẩn bị câu truy vấn
            $stmt = $this->conn->prepare($sql);

            // Gán giá trị cho các tham số truy vấn
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':mat_khau', $hashed_password, PDO::PARAM_STR);

            // Thực thi truy vấn
            if ($stmt->execute()) {
                return true; // Trả về true nếu cập nhật thành công
            } else {
                return false; // Trả về false nếu có lỗi trong quá trình thực thi
            }
        } catch (PDOException $e) {
            // Ghi log lỗi để dễ dàng kiểm tra sau này
            error_log('Lỗi khi cập nhật mật khẩu: ' . $e->getMessage());
            return false;
        }
    }

}