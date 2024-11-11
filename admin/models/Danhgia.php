<?php

class Danhgia
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

    // danh sach danh gia
    public function getAll() {
        try {
            $sql = "SELECT * FROM `danh_gias`";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    // them du lieu vao CSDL
    public function postData($san_pham_id, $nguoi_dung_id, $so_sao, $noi_dung,$trang_thai, $ngay_danh_gia) {


        try {
            $sql = "INSERT INTO `danh_gias`(`ho_ten`, `email`, `so_dien_thoai`,`noi_dung`, `trang_thai`) VALUES (:ho_ten, :email, :so_dien_thoai,:noi_dung, :trang_thai)";
            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':ho_ten', $ho_ten);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':so_dien_thoai', $so_dien_thoai);
            $stmt->bindParam(':noi_dung', $noi_dung);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->execute();

        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

//    // cap nhat du lieu vao CSDL
    public function updateData($id,$trang_thai) {
        try {

            $sql = "UPDATE danh_gias SET trang_thai = :trang_thai WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':trang_thai', $trang_thai);



            $stmt->execute();

            return true;
        } catch (PDOException $e) {
           die($e->getMessage());
            // echo 'Error: ' .$e->getMessage();
        }
    }

    // lay thong tin chi tiet
    public function getDetailData($id) {
        try {
            $sql = "SELECT * FROM `danh_gias` WHERE id = :id";

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
            $sql = "DELETE FROM `danh_gias` WHERE id = :id";

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
