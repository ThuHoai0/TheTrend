<?php

class Chitietdonhang
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function getAll() {
        try {
            $sql = "SELECT ctdh.*, don_hangs.ma_don_hang AS ma_dh, san_phams.ten_san_pham FROM 
            `chi_tiet_don_hangs` AS ctdh
            INNER JOIN don_hangs ON don_hangs.id = ctdh.don_hang_id
            INNER JOIN san_phams ON san_phams.id = ctdh.san_pham_id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function getBySearch($search) {
        // Chuẩn bị câu lệnh SQL với dấu phần trăm bao quanh biến tìm kiếm
        $sql = "SELECT * FROM chi_tiet_don_hangs WHERE don_hang_id LIKE :search";

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
            $sql = "DELETE FROM `chi_tiet_don_hangs` WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }


    public function updateData($id, $don_hang_id, $san_pham_id, $so_luong, $gia) {
        try {

            $sql = "UPDATE chi_tiet_don_hangs SET don_hang_id = :don_hang_id, san_pham_id = :san_pham_id, so_luong = :so_luong, gia = :gia
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':don_hang_id', $don_hang_id);
            $stmt->bindParam(':san_pham_id', $san_pham_id);
            $stmt->bindParam(':so_luong', $so_luong);
            $stmt->bindParam(':gia', $gia);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die($e->getMessage());
            echo 'Error: ' .$e->getMessage();
        }
    }


    public function getDetailData($id) {
        try {
            $sql = "SELECT ctdh.* ,don_hangs.ma_don_hang AS ma_dh FROM 
            `chi_tiet_don_hangs` AS ctdh
            INNER JOIN don_hangs ON don_hangs.id = ctdh.don_hang_id WHERE ctdh.id = :id";
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