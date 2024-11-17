<?php

class Danhgia {
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }


    public function getAll() {
        try {
            // $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc FROM `san_phams` inner JOIN danh_mucs ON danh_mucs.id = san_phams.danh_muc_id WHERE san_phams.id = :id";
            
            // $sql ="SELECT danh_gias.*,san_phams.id,nguoi_dungs.id FROM `danh_gias` JOIN san_phams ON san_phams.id=danh_gias.san_pham_id JOIN nguoi_dungs ON nguoi_dungs.id=danh_gias.nguoi_dung_id WHERE danh_gias.id= :id;";

<<<<<<< Updated upstream
            $sql = "SELECT * FROM `danh_gias`";
=======
            
            $sql = "SELECT * FROM `danh_gias`";
            
>>>>>>> Stashed changes
            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function getBySearch($search) {
        // Chuẩn bị câu lệnh SQL với dấu phần trăm bao quanh biến tìm kiếm
        $sql = "SELECT * FROM danh_gias WHERE san_pham_id LIKE :search";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);

        // Thực hiện binding tham số (thêm % vào chuỗi tìm kiếm)
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);

        // Thực thi câu lệnh
        $stmt->execute();

        // Lấy tất cả kết quả dưới dạng mảng
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategory() {
        $sql = "SELECT * FROM danh_gias";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function postData($san_pham_id, $nguoi_dung_id, $so_sao, $noi_dung,$ngay_danh_gia,$trang_thai) {
        try {
            $sql = "INSERT INTO `danh_gias`(`san_pham_id`, `nguoi_dung_id`,`so_sao`, `noi_dung`, `ngay_danh_gia`,`trang_thai`) 
                    VALUES (:san_pham_id, :nguoi_dung_id, :so_sao, :noi_dung, :ngay_danh_gia, :trang_thai)";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':san_pham_id', $san_pham_id);
            $stmt->bindParam(':nguoi_dung_id', $nguoi_dung_id);
            $stmt->bindParam(':so_sao', $so_sao);
            $stmt->bindParam(':noi_dung', $noi_dung);
            $stmt->bindParam(':ngay_danh_gia', $ngay_danh_gia);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

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
    public function updateData($id,$trang_thai) {
        try {

            $sql = "UPDATE danh_gias SET trang_thai = :trang_thai
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':id', $id);
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
            $sql = "SELECT * FROM `danh_gias` WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    // huy ket noi CSDL
    public function __destruct() {
        $this->conn = null;
    }

}