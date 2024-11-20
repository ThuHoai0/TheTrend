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
            $sql = "SELECT * FROM `khuyen_mais` ORDER BY `id` DESC";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function postData($ten_khuyen_mai, $mo_ta, $phan_tram_giam, $ngay_bat_dau, $ngay_ket_thuc, $ngay_tao, $trang_thai) {
        try {
            $sql = "INSERT INTO `khuyen_mais`(`ten_khuyen_mai`, `mo_ta`, `phan_tram_giam`, `ngay_bat_dau`, `ngay_ket_thuc`, `ngay_tao`, `trang_thai`) 
                    VALUES (:ten_khuyen_mai, :mo_ta, :phan_tram_giam, :ngay_bat_dau, :ngay_ket_thuc, :ngay_tao, :trang_thai)";


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
    // cap nhat du lieu vao CSDL
    public function updateData($id, $ten_khuyen_mai, $mo_ta, $phan_tram_giam, $ngay_bat_dau, $ngay_ket_thuc) {
        try {

            $sql = "UPDATE khuyen_mais SET ten_khuyen_mai = :ten_khuyen_mai, mo_ta = :mo_ta, phan_tram_giam = :phan_tram_giam, ngay_bat_dau = :ngay_bat_dau, ngay_ket_thuc = :ngay_ket_thuc  WHERE id = :id";


            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':ten_khuyen_mai', $ten_khuyen_mai);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':phan_tram_giam', $phan_tram_giam);
            $stmt->bindParam(':ngay_bat_dau', $ngay_bat_dau);
            $stmt->bindParam(':ngay_ket_thuc', $ngay_ket_thuc);

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
            $sql = "SELECT * FROM `khuyen_mais` WHERE id = :id";

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
            $sql = "DELETE FROM `khuyen_mais` WHERE id = :id";

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

    public function getBySearch($search) {
        // Chuẩn bị câu lệnh SQL với dấu phần trăm bao quanh biến tìm kiếm
        $sql = "SELECT * FROM khuyen_mais WHERE ten_khuyen_mai LIKE :search";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);

        // Thực hiện binding tham số (thêm % vào chuỗi tìm kiếm)
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

        // Thực thi câu lệnh
        $stmt->execute();

        // Lấy tất cả kết quả dưới dạng mảng
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}