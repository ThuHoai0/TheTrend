<?php

class Khuyenmai
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

    // danh sach khuyen mai
    public function getAll() {
        try {
            $sql = "SELECT * FROM `khuyen_mais`";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function postData($ten_khuyen_mai, $mo_ta, $phan_tram_giam, $ngay_bat_dau, $ngay_ket_thuc, $ngay_tao, $trang_thai) {
        try {
            $sql = "INSERT INTO `khuyen_mais`(`ten_khuyen_mai`, `mo_ta`, `phan_tram_giam`, `ngay_bat_dau`, `ngay_ket_thuc`, `ngay_tao`, `trang_thai`) VALUES (:ten_khuyen_mai, :mo_ta, :phan_tram_giam, :ngay_bat_dau, :ngay_ket_thuc, :trang_thai)";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':ten_khuyen_mai', $ten_khuyen_mai);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':phan_tram_giam', $phan_tram_giam);
            $stmt->bindParam(':ngay_bat_dau', $ngay_bat_dau);
            $stmt->bindParam(':ngay_ket_thuc', $ngay_ket_thuc);
            $stmt->bindParam(':ngay_tao', $ngay_tao);
            $stmt->bindParam(':trang_thai', $trang_thai);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

}