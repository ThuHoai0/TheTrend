<?php
class Home
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

    public function check($ten, $mat_khau) {

        try {
            $sql = "SELECT * FROM nguoi_dungs WHERE ten = :ten and mat_khau = :mat_khau";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':ten', $ten);
            $stmt->bindParam(':mat_khau', $mat_khau);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            die;
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function dangky($ten, $mat_khau, $email) {
        try {
            $sql = "INSERT INTO nguoi_dungs (`ten`, `mat_khau`, `email`) VALUES (:ten, :mat_khau, :email)";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':ten', $ten);
            $stmt->bindParam(':mat_khau', $mat_khau);
            $stmt->bindParam(':email', $email);

            $stmt->execute();

            $user_id = $this->conn->lastInsertId();

            return $user_id;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            die;
            echo 'Error: ' .$e->getMessage();
        }
    }

}