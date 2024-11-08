<?php

class Lienhe
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

    // danh sach người liên hệ
    public function getAll() {
        try {
            $sql = "SELECT * FROM `lien_hes`";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    // them du lieu vao CSDL
    public function postData($ten_lien_he, $mo_ta, $ngay_tao) {
        try {
            $sql = "INSERT INTO `lien_hes`(`ten_lien_he,`, `mo_ta`, `ngay_tao`,) VALUES (:ten_lien_he, :mo_ta, :ngay_tao)";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':ten_lien_he,', $ten_lien_he,);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':ngay_tao', $ngay_tao);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

//    // cap nhat du lieu vao CSDL
    public function updateData($id, $ten_lien_he, $mo_ta) {
        try {

            $sql = "UPDATE lien_hes SET ten_lien_he = :ten_lien_he, mo_ta = :mo_ta WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':ten_lien_he', $ten_lien_he);
            $stmt->bindParam(':mo_ta', $mo_ta);


            $stmt->execute();

            return true;
        } catch (PDOException $e) {
//            die($e->getMessage());
            echo 'Error: ' .$e->getMessage();
        }
    }

    // lay thong tin chi tiet
    public function getDetailData($id) {
        try {
            $sql = "SELECT * FROM `lien_hes` WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    // xoa du lieu trong CSDL
    public function deleteData($id) {
        try {
            $sql = "DELETE FROM `lien_hes` WHERE id = :id";

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

}
