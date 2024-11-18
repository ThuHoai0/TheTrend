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
        $sql = "SELECT * FROM chi_tiet_don_hangs WHERE don_hang_id LIKE :search";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->execute();
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
    public function getDetailData($id) {
        try {
            $sql = "SELECT ctdh.* ,don_hangs.ma_don_hang AS ma_dh, san_phams.ten_san_pham FROM 
            `chi_tiet_don_hangs` AS ctdh
            JOIN don_hangs ON don_hangs.id = ctdh.don_hang_id
            JOIN san_phams ON san_phams.id = ctdh.san_pham_id WHERE ctdh.id = :id";
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