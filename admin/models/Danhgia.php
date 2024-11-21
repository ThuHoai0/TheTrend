<?php

class Danhgia {
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }
    public function getAll() {
        try {
            $sql = "SELECT 
                        nd.ten AS ten_nguoi_dung,
                        sp.ten_san_pham,
                        dg.*
                    FROM 
                        danh_gias dg
                    JOIN 
                        nguoi_dungs nd ON dg.nguoi_dung_id = nd.id
                    JOIN 
                        san_phams sp ON dg.san_pham_id = sp.id;
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
    public function updateData($id, $trang_thai) {
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
            $sql = "SELECT dg.* ,san_phams.ten_san_pham AS ten_sp, nguoi_dungs.ten FROM 
            `danh_gias` AS dg
            JOIN san_phams ON san_phams.id = dg.san_pham_id
            JOIN nguoi_dungs ON nguoi_dungs.id = dg.nguoi_dung_id WHERE dg.san_pham_id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    // huy ket noi CSDL
    public function __destruct() {
        $this->conn = null;
    }

}