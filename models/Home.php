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
            $sql = "SELECT * FROM nguoi_dungs WHERE email = :email AND mat_khau = :mat_khau";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':email', $ten);
            $stmt->bindParam(':mat_khau', $mat_khau);

            $stmt->execute();

            $user = $stmt->fetch();

            if ($user) {
                $_SESSION['iduser'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['ten'];
                $_SESSION['vai_tro'] = $user['vai_tro'];

                return $user;
            }
            return false;

        } catch (PDOException $e) {

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

            $_SESSION['name'] = $ten;

            return $user_id;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            die;
            echo 'Error: ' .$e->getMessage();
        }
    }

}