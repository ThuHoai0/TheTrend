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
    
    
    public function updateUser($id, $email, $dia_chi, $so_dien_thoai, $gioi_tinh, $ngay_sinh = null)
{
    // Kiểm tra nếu không có ngày sinh, giữ nguyên giá trị cũ trong cơ sở dữ liệu
    $sql = "UPDATE nguoi_dungs
            SET email = ?, dia_chi = ?, so_dien_thoai = ?, gioi_tinh = ?" . 
            ($ngay_sinh ? ", ngay_sinh = ?" : "") . "
            WHERE id = ?";
    $stmt = $this->conn->prepare($sql);

    $params = [$email, $dia_chi, $so_dien_thoai, $gioi_tinh];
    if ($ngay_sinh) {
        $params[] = $ngay_sinh;
    }
    $params[] = $id;

    return $stmt->execute($params);
}

    public function updatePassword($id, $new_password)
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
        $stmt->bindParam(':mat_khau', $new_password, PDO::PARAM_STR);  // Không mã hóa mật khẩu

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
    // Lấy thông tin người dùng theo email
    public function getUserByEmail($email)
    {
        try {
            $sql = "SELECT * FROM nguoi_dungs WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(); // Trả về thông tin người dùng nếu tồn tại
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function updatePass($id, $new_password)
    {
        try {
            // Cập nhật mật khẩu mới (không mã hóa)
            $sql = "UPDATE nguoi_dungs SET mat_khau = :mat_khau WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':mat_khau', $new_password, PDO::PARAM_STR); // Lưu trực tiếp mật khẩu
            return $stmt->execute(); // Cập nhật mật khẩu mới
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

}