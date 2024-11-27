<?php
class Yeuthich
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getDetailData($nguoiDungId) {
        try {
            $sql = "SELECT sp.id AS id_san_pham, sp.ten_san_pham, sp.gia, sp.hinh_anh,sp.so_luong,
                    u.id AS id_nguoi_dung, u.ten AS ten_nguoi_dung 
                    FROM san_pham_yeu_thichs spyt JOIN san_phams sp ON spyt.san_pham_id = sp.id JOIN nguoi_dungs u ON 
                    spyt.nguoi_dung_id = u.id WHERE spyt.nguoi_dung_id = 27";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $nguoiDungId);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function addYeuthich($sanPhamId, $nguoiDungId)
    {
        try {
            $sql = "INSERT INTO danh_gias (san_pham_id, nguoi_dung_id) 
                    VALUES (:san_pham_id, :nguoi_dung_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':san_pham_id', $sanPhamId, PDO::PARAM_INT);
            $stmt->bindParam(':nguoi_dung_id', $nguoiDungId, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}