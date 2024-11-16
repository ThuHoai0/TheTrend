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
                        hinh.mo_ta AS image_description
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
        // Chuẩn bị câu lệnh SQL với dấu phần trăm bao quanh biến tìm kiếm
        $sql = "SELECT * FROM danh_mucs WHERE ten_danh_muc LIKE :search";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);

        // Thực hiện binding tham số (thêm % vào chuỗi tìm kiếm)
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

        // Thực thi câu lệnh
        $stmt->execute();

        // Lấy tất cả kết quả dưới dạng mảng
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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