<?php
class Chitietsanpham
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
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
    public function getRelatedProducts($categoryId, $productId) {
        try {
            $sql = "SELECT 
                        san_phams.* 
                    FROM 
                        san_phams
                    WHERE 
                        san_phams.danh_muc_id = :categoryId 
                        AND san_phams.id != :productId
                    ORDER BY 
                        RAND() -- Sắp xếp ngẫu nhiên
                    LIMIT 4";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách sản phẩm liên quan
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
// them binh luan
    public function addReview($sanPhamId, $nguoiDungId, $noiDung, $ngayBinhLuan, $trangThai)
    {
        try {
            $sql = "INSERT INTO binh_luans (san_pham_id, nguoi_dung_id, noi_dung, ngay_binh_luan, trang_thai) 
                VALUES (:san_pham_id, :nguoi_dung_id, :noi_dung, :ngay_binh_luan, :trang_thai)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':san_pham_id', $sanPhamId, PDO::PARAM_INT);
            $stmt->bindParam(':nguoi_dung_id', $nguoiDungId, PDO::PARAM_INT);
            $stmt->bindParam(':noi_dung', $noiDung, PDO::PARAM_STR);
            $stmt->bindParam(':ngay_binh_luan', $ngayBinhLuan, PDO::PARAM_STR);
            $stmt->bindParam(':trang_thai', $trangThai, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showbinhluan($sanPhamId)
    {
        try {
            $sql = "SELECT binh_luans.noi_dung, binh_luans.ngay_binh_luan, nguoi_dungs.ten AS ten_nguoi_dung 
                FROM binh_luans 
                LEFT JOIN nguoi_dungs ON binh_luans.nguoi_dung_id = nguoi_dungs.id 
                WHERE binh_luans.san_pham_id = :san_pham_id AND binh_luans.trang_thai = 1 
                ORDER BY binh_luans.ngay_binh_luan DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':san_pham_id', $sanPhamId, PDO::PARAM_INT);
            $stmt->execute();

            // Trả về danh sách bình luận
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Xử lý lỗi
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function addDanhgia($sanPhamId, $nguoiDungId, $soSao, $noiDung, $ngayDanhGia, $trangThai)
    {
        try {
            $sql = "INSERT INTO danh_gias (san_pham_id, nguoi_dung_id, so_sao, noi_dung, ngay_danh_gia, trang_thai) 
                    VALUES (:san_pham_id, :nguoi_dung_id, :so_sao, :noi_dung, :ngay_danh_gia, :trang_thai)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':san_pham_id', $sanPhamId, PDO::PARAM_INT);
            $stmt->bindParam(':nguoi_dung_id', $nguoiDungId, PDO::PARAM_INT);
            $stmt->bindParam(':so_sao', $soSao, PDO::PARAM_INT);
            $stmt->bindParam(':noi_dung', $noiDung, PDO::PARAM_STR);
            $stmt->bindParam(':ngay_danh_gia', $ngayDanhGia, PDO::PARAM_STR);
            $stmt->bindParam(':trang_thai', $trangThai, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function getDanhgiaBySanPhamId($sanPhamId)
    {
        try {
            $sql = "SELECT danh_gias.*, nguoi_dungs.ten AS ten_nguoi_dung 
                FROM danh_gias
                LEFT JOIN nguoi_dungs ON danh_gias.nguoi_dung_id = nguoi_dungs.id
                WHERE danh_gias.san_pham_id = :san_pham_id AND danh_gias.trang_thai = 1
                ORDER BY danh_gias.ngay_danh_gia DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':san_pham_id', $sanPhamId, PDO::PARAM_INT);
            $stmt->execute();

            // Trả về danh sách đánh giá
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Xử lý lỗi nếu xảy ra
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function checkExistingReview($sanPhamId, $nguoiDungId)
    {
        try {
            // Kiểm tra xem người dùng đã đánh giá sản phẩm này chưa
            $sql = "SELECT COUNT(*) as count FROM danh_gias 
                WHERE san_pham_id = :san_pham_id AND nguoi_dung_id = :nguoi_dung_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':san_pham_id', $sanPhamId, PDO::PARAM_INT);
            $stmt->bindParam(':nguoi_dung_id', $nguoiDungId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0; // Trả về true nếu đã có đánh giá
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }


    public function getTopProductImages($productId)
    {
        try {
            $sql = "SELECT duong_dan_hinh_anh 
                FROM hinh_anh_san_phams 
                WHERE san_pham_id = :productId
                LIMIT 2"; // Chỉ lấy 2 hình ảnh
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách đường dẫn 2 hình ảnh
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


//    public function hasPurchased($sanPhamId, $nguoiDungId)
//    {
//        try {
//            $sql = "SELECT COUNT(*) as count
//                FROM don_hangs
//                INNER JOIN chi_tiet_don_hangs ON don_hangs.id = chi_tiet_don_hangs.don_hang_id
//                WHERE don_hangs.nguoi_dung_id = :nguoi_dung_id AND chi_tiet_don_hangs.san_pham_id = :san_pham_id AND don_hangs.trang_thai = 'completed'";
//            $stmt = $this->conn->prepare($sql);
//            $stmt->bindParam(':nguoi_dung_id', $nguoiDungId, PDO::PARAM_INT);
//            $stmt->bindParam(':san_pham_id', $sanPhamId, PDO::PARAM_INT);
//            $stmt->execute();
//            $result = $stmt->fetch(PDO::FETCH_ASSOC);
//            return $result['count'] > 0; // Trả về true nếu đã mua
//        } catch (PDOException $e) {
//            echo 'Error: ' . $e->getMessage();
//            return false;
//        }
//    }


}