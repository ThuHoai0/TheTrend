<?php
// File: models/TinTucModel.php
class TinTucModel {
   
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }

    // Lấy tất cả các bài viết có trạng thái hiện (trang thái = 1)
    public function getDanhSachTinTuc() {
        $query = "SELECT * FROM tin_tucs WHERE trang_thai = 1 ORDER BY ngay_tao DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        // Kiểm tra nếu không có dữ liệu
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    // Lấy chi tiết bài viết theo ID
    public function getChiTietTinTuc($id) {
        $query = "SELECT * FROM tin_tucs WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


?>
