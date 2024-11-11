<?php

class Danhmuc
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

    // danh sach danh muc
    public function getAll() {
        try {
            $sql = "SELECT * FROM `danh_mucs`";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    function search($ten_danh_muc)
    {
        try {
            $sql = "SELECT * 
                    FROM danh_mucs 
                    WHERE ten_danh_muc LIKE '%ten_cua_san_pham%'";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    // them du lieu vao CSDL
    public function postData($ten_danh_muc, $mo_ta, $ngay_tao, $trang_thai) {
        try {
            $sql = "INSERT INTO `danh_mucs`(`ten_danh_muc`, `mo_ta`, `ngay_tao`, `trang_thai`) VALUES (:ten_danh_muc, :mo_ta, :ngay_tao, :trang_thai)";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':ten_danh_muc', $ten_danh_muc);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':ngay_tao', $ngay_tao);
            $stmt->bindParam(':trang_thai', $trang_thai);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

//    // cap nhat du lieu vao CSDL
    public function updateData($id, $ten_danh_muc, $mo_ta, $trang_thai) {
        try {

            $sql = "UPDATE danh_mucs SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta, trang_thai = :trang_thai WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':ten_danh_muc', $ten_danh_muc);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':trang_thai', $trang_thai);

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
            $sql = "SELECT * FROM `danh_mucs` WHERE id = :id";

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
            $sql = "DELETE FROM `danh_mucs` WHERE id = :id";

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
