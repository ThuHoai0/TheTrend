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
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc 
                    FROM san_phams LEFT JOIN danh_mucs 
                    ON san_phams.danh_muc_id = danh_mucs.id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function getCategory() {
        $sql = "SELECT * FROM danh_mucs";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function postData($ten_san_pham, $mo_ta, $gia, $load_hinh_anh, $gia_nhap, $so_luong, $danh_muc_id, $trang_thai, $ngay_tao) {
        try {
            $sql = "INSERT INTO `san_phams`(`ten_san_pham`, `mo_ta`,`gia`, `hinh_anh`, `gia_nhap`, `so_luong`, `danh_muc_id`, `trang_thai`, `ngay_tao`) 
                    VALUES (:ten_san_pham, :mo_ta, :gia, :hinh_anh, :gia_nhap, :so_luong, :danh_muc_id, :trang_thai, :ngay_tao)";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':ten_san_pham', $ten_san_pham);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':gia', $gia);
            $stmt->bindParam(':hinh_anh', $load_hinh_anh);
            $stmt->bindParam(':gia_nhap', $gia_nhap);
            $stmt->bindParam(':so_luong', $so_luong);
            $stmt->bindParam(':danh_muc_id', $danh_muc_id);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->bindParam(':ngay_tao', $ngay_tao);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function deleteData($id) {
        try {
            $sql = "DELETE FROM `san_phams` WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    // lay thong tin chi tiet
    public function getDetailData($id) {
        try {
            $sql = "SELECT * FROM `san_phams` WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    public function updateData($id, $ten_san_pham, $mo_ta, $gia, $load_hinh_anh, $gia_nhap, $so_luong, $danh_muc_id, $trang_thai) {
        try {

            $sql = "UPDATE san_phams SET ten_san_pham = :ten_san_pham, mo_ta = :mo_ta, gia = :gia, 
                    hinh_anh = :hinh_anh, gia_nhap = :gia_nhap, so_luong = :so_luong, danh_muc_id = :danh_muc_id, trang_thai = :trang_thai
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':ten_san_pham', $ten_san_pham);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':gia', $gia);
            $stmt->bindParam(':hinh_anh', $load_hinh_anh);
            $stmt->bindParam(':gia_nhap', $gia_nhap);
            $stmt->bindParam(':so_luong', $so_luong);
            $stmt->bindParam(':danh_muc_id', $danh_muc_id);
            $stmt->bindParam(':trang_thai', $trang_thai);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
//            die($e->getMessage());
            echo 'Error: ' .$e->getMessage();
        }
    }


    // huy ket noi CSDL
    public function __destruct() {
        $this->conn = null;
    }

}