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


    public function updateData($id,$trang_thai_don_hang) {
        try {

            $sql = "UPDATE don_hangs SET trang_thai_id = :trang_thai_don_hang
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':id', $id);

            $stmt->bindParam(':trang_thai_don_hang', $trang_thai_don_hang);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die($e->getMessage());
            echo 'Error: ' .$e->getMessage();
        }
    }


    public function getDetailData($id) {
        try {
            $sql = "SELECT don_hangs.* ,nguoi_dungs.ten AS ten_nguoi_dung FROM 
            `don_hangs` INNER JOIN nguoi_dungs ON nguoi_dungs.id = don_hangs.nguoi_dung_id 
            WHERE don_hangs.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }


    public function __destruct() {
        $this->conn = null;
    }
}