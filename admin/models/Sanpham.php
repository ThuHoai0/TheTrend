<?php
class Sanpham {
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function getAll() {
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc 
                    FROM san_phams LEFT JOIN danh_mucs 
                    ON san_phams.danh_muc_id = danh_mucs.id ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    public function getBySearch($search) {
        $sql = "SELECT * FROM san_phams WHERE ten_san_pham LIKE :search";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCategory() {
        $sql = "SELECT * FROM danh_mucs";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function postData($ten_san_pham, $mo_ta, $gia, $load_hinh_anh, $gia_nhap, $so_luong, $danh_muc_id, $trang_thai, $ngay_tao, $anh) {
        try {
            $sql = "INSERT INTO `san_phams`(`ten_san_pham`, `mo_ta`,`gia`, `gia_nhap`, `so_luong`, `danh_muc_id`, `trang_thai`, `ngay_tao`, `hinh_anh`) 
                    VALUES (:ten_san_pham, :mo_ta, :gia, :gia_nhap, :so_luong, :danh_muc_id, :trang_thai, :ngay_tao, :hinh_anh)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ten_san_pham', $ten_san_pham);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':gia', $gia);
            $stmt->bindParam(':gia_nhap', $gia_nhap);
            $stmt->bindParam(':so_luong', $so_luong);
            $stmt->bindParam(':danh_muc_id', $danh_muc_id);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->bindParam(':ngay_tao', $ngay_tao);
            $stmt->bindParam(':hinh_anh', $anh);
            $stmt->execute();
            $lastInsertId = $this->conn->lastInsertId();
            foreach ($load_hinh_anh as $key => $value) {
                $sql = "INSERT INTO `hinh_anh_san_phams`(`san_pham_id`, `duong_dan_hinh_anh`) VALUES (:san_pham_id, :duong_dan_hinh_anh)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':san_pham_id', $lastInsertId);
                $stmt->bindParam(':duong_dan_hinh_anh', $value[0]);
                $stmt->execute();
            }
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
    public function getDetailData($id) {
        try {
            $sql = "SELECT 
                        san_phams.*, 
                        danh_mucs.ten_danh_muc, 
                        danh_gias.so_sao, 
                        danh_gias.noi_dung AS noi_dung_danh_gia, 
                        danh_gias.ngay_danh_gia, 
                        danh_gias.trang_thai AS trang_thai_danh_gia,
                        nguoi_dungs.ten AS ten_nd,
                        binh_luans.noi_dung AS noi_dung_binh_luan,
                        binh_luans.ngay_binh_luan, 
                        binh_luans.trang_thai AS trang_thai_binh_luan
                    FROM 
                        san_phams
                    JOIN 
                        danh_mucs 
                        ON danh_mucs.id = san_phams.danh_muc_id
                    LEFT JOIN 
                        danh_gias 
                        ON danh_gias.san_pham_id = san_phams.id
                    LEFT JOIN 
                        binh_luans 
                        ON binh_luans.san_pham_id = san_phams.id
                    LEFT JOIN 
                        nguoi_dungs 
                        ON nguoi_dungs.id = san_phams.nguoi_dung_id
                    WHERE 
                        san_phams.id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    public function updateData($id, $ten_san_pham, $mo_ta,$gia, $gia_nhap, $so_luong, $danh_muc_id, $trang_thai) {
        try {

            $sql = "UPDATE san_phams SET ten_san_pham = :ten_san_pham, mo_ta = :mo_ta, gia = :gia, 
                    gia_nhap = :gia_nhap, so_luong = :so_luong, danh_muc_id = :danh_muc_id, trang_thai = :trang_thai
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':ten_san_pham', $ten_san_pham);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':gia', $gia);
            $stmt->bindParam(':gia_nhap', $gia_nhap);
            $stmt->bindParam(':so_luong', $so_luong);
            $stmt->bindParam(':danh_muc_id', $danh_muc_id);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    public function __destruct() {
        $this->conn = null;
    }
}