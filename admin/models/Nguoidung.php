<?php

class Nguoidung
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

    // danh sach danh muc
    public function getAll() {
        try {
            $sql = "SELECT * FROM `nguoi_dungs`";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    // them du lieu vao CSDL
    public function postData($ten, $email, $so_dien_thoai, $ngay_sinh, $gioi_tinh, $dia_chi, $vai_tro, $trang_thai, $ngay_tao) {
        try {
            $sql = "INSERT INTO `nguoi_dungs`(`ten`, `email`, `so_dien_thoai`, `ngay_sinh`, `dia_chi`, `vai_tro`, `ngay_tao`, `trang_thai`, `gioi_tinh`) VALUES (:ten, :email, :so_dien_thoai, :ngay_sinh, :dia_chi, :vai_tro, :ngay_tao, :trang_thai, :gioi_tinh)";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':ten', $ten);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':so_dien_thoai', $so_dien_thoai); 
            $stmt->bindParam(':ngay_sinh', $ngay_sinh);
            $stmt->bindParam(':dia_chi', $dia_chi);
            $stmt->bindParam(':vai_tro', $vai_tro);
            $stmt->bindParam(':ngay_tao', $ngay_tao);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->bindParam(':gioi_tinh', $gioi_tinh);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            die;
            echo 'Error: ' .$e->getMessage();
        }
    }

//    // cap nhat du lieu vao CSDL
public function updateData($id, $trang_thai) {

    try { 
        $sql = "UPDATE nguoi_dungs 
                SET trang_thai = :trang_thai
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        // Gán giá trị vào các tham số
        $stmt->bindParam(':id', $id);

        $stmt->bindParam(':trang_thai', $trang_thai);

         $stmt->execute(); 
            
        
    } catch (PDOException $e) {
        echo 'Lỗi khi cập nhật dữ liệu: ' . $e->getMessage();
        return false;
    }
}

// Phương thức lấy thông tin chi tiết
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


    // xoa du lieu trong CSDL
    public function deleteData($id) {
        try {
            $sql = "DELETE FROM `nguoi_dungs` WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    // huy ket noi CSDL
    public function __destruct() {
        $this->conn = null;
    }

    public function getBySearch($search) {
        // Chuẩn bị câu lệnh SQL với dấu phần trăm bao quanh biến tìm kiếm
        $sql = "SELECT * FROM nguoi_dungs WHERE ten LIKE :search";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);

        // Thực hiện binding tham số (thêm % vào chuỗi tìm kiếm)
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

        // Thực thi câu lệnh
        $stmt->execute();

        // Lấy tất cả kết quả dưới dạng mảng
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
