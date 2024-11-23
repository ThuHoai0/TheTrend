<?php
class TinTuc
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy danh sách tin tức
    public function get3TinTuc()
    {
        try {
            $sql = "SELECT * FROM `tin_tucs` ORDER BY id DESC LIMIT 2";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    // Lấy chi tiết tin tức theo ID
    public function getDetailData($id) {
        try {
            $sql = "SELECT * FROM `tin_tucs` WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

}