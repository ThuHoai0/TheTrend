<?php
class Khuyenmai
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }

    // khuyến mãi
    public function getAllKM() {
        try {
            $sql = "SELECT * FROM `khuyen_mais` ORDER BY `id` DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }
}