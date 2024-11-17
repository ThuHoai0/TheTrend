<?php

class Hinhanhsanpham
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function getAll() {
        try {
            $sql = "SELECT 
                        sp.id AS product_id,
                        sp.ten_san_pham AS product_name,
                        sp.mo_ta AS product_description,
                        sp.gia AS price,
                        sp.hinh_anh AS main_image,
                        hinh.duong_dan_hinh_anh AS additional_image,
                        hinh.mo_ta AS image_description,
                        hinh.id as image_id
                    FROM 
                        san_phams sp
                    INNER JOIN 
                        hinh_anh_san_phams hinh
                    ON 
                        sp.id = hinh.san_pham_id;
                    ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    public function getBySearch($search) {
        $sql = "SELECT * FROM hinh_anh_san_phams WHERE san_pham_id LIKE :search";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // them du lieu vao CSDL
//    public function postData($ten_san_pham, $hinh_anh, $mo_ta, $trang_thai) {
//        try {
//            $sql = "INSERT INTO `hinh_anh_san_phams`(`ten_san_pham`, `hinh_anh`, `mo_ta`, `trang_thai`) VALUES (:ten_san_pham, :hinh_anh, :mo_ta, :trang_thai)";
//
//            $stmt = $this->conn->prepare($sql);
//
//            // gan gia tri vao cac tham so
//            $stmt->bindParam(':ten_san_pham', $ten_san_pham);
//            $stmt->bindParam(':hinh_anh', $hinh_anh);
//            $stmt->bindParam(':mo_ta', $mo_ta);
//            $stmt->bindParam(':trang_thai', $trang_thai);
//
//            $stmt->execute();
//
//            return true;
//        } catch (PDOException $e) {
//            echo 'Error: ' .$e->getMessage();
//        }
//    }

//    // cap nhat du lieu vao CSDL
    public function updateData($id, $ten_san_pham, $load_hinh_anh, $mo_ta) {
        try {

            $sql = "UPDATE hinh_anh_san_phams SET ten_san_pham = :ten_san_pham, duong_dan_hinh_anh = :duong_dan_hinh_anh, mo_ta = :mo_ta WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':ten_san_pham', $ten_san_pham);
            $stmt->bindParam(':duong_dan_hinh_anh', $load_hinh_anh);
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
            $sql = "SELECT hinh_anh_san_phams.*, san_phams.trang_thai, san_phams.ten_san_pham 
                    FROM `hinh_anh_san_phams` INNER JOIN san_phams 
                        ON san_phams.id = hinh_anh_san_phams.san_pham_id 
                    WHERE hinh_anh_san_phams.id = :id";

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
            $sql = "DELETE FROM `hinh_anh_san_phams` WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function deleteData1($id) {
        try {
            $sql = "DELETE FROM `hinh_anh_san_phams` WHERE san_pham_id = :id";

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