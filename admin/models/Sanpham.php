<?php

class Sanpham {
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

    // danh sach danh muc
    public function getAll() {
        try {
            $sql = "SELECT * FROM `san_phams`";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
}