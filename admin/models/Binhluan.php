<?php

class Binhluan {
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function getAll() {
        try {
            $sql = "SELECT bl.*, san_phams.ten_san_pham AS ten_sp , nguoi_dungs.ten FROM `binh_luans` AS bl
            JOIN san_phams ON san_phams.id = bl.san_pham_id
            JOIN nguoi_dungs ON nguoi_dungs.id = bl.nguoi_dung_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    public function getBySearch($search) {
        $sql = "SELECT * FROM binh_luans WHERE san_pham_id LIKE :search";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProduct() {
        $sql = "SELECT * FROM san_phams";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUser() {
        $sql = "SELECT * FROM nguoi_dungs";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteData($id) {
        try {
            $sql = "DELETE FROM `binh_luans` WHERE id = :id";
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

            $sql = "SELECT bl.* ,san_phams.ten_san_pham AS ten_sp, nguoi_dungs.ten FROM 
            `binh_luans` AS bl
            JOIN san_phams ON san_phams.id = bl.san_pham_id
            JOIN nguoi_dungs ON nguoi_dungs.id = bl.nguoi_dung_id WHERE bl.san_pham_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    public function updateData($id, $trang_thai) {
        try {
            $sql = "UPDATE binh_luans SET  trang_thai = :trang_thai
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function getProductIdByBinhluanId($binh_luan_id)
        {
            $sql = "SELECT san_pham_id FROM binh_luans WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $binh_luan_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['san_pham_id'] ?? null;
        }

    public function __destruct() {
        $this->conn = null;
    }
}