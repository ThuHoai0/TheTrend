<?php

class Banner
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

    // danh sach người liên hệ
    public function getAll() {
        try {
            $sql = "SELECT * FROM `banners`";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    // them du lieu vao CSDL
    public function postData($duong_dan_hinh_anh,$mo_ta,$trang_thai) {


        try {
            $sql = "INSERT INTO `banners`(`duong_dan_hinh_anh`, `mo_ta`, `trang_thai`) VALUES (:duong_dan_hinh_anh, :mo_ta, :trang_thai)";
            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':duong_dan_hinh_anh', $duong_dan_hinh_anh);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->execute();

        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

//    // cap nhat du lieu vao CSDL
    public function updateData($id,$load_duong_dan_hinh_anh,$mo_ta,$trang_thai) {
        try {

            $sql = "UPDATE banners SET duong_dan_hinh_anh = :duong_dan_hinh_anh, mo_ta = :mo_ta, trang_thai = :trang_thai WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so         
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':duong_dan_hinh_anh', $load_duong_dan_hinh_anh);
            $stmt->bindParam(':mo_ta', $mo_ta);
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
            $sql = "SELECT * FROM `banners` WHERE id = :id";

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
            $sql = "DELETE FROM `banners` WHERE id = :id";

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
