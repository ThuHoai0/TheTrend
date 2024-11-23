<?php
class Home
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function check($ten, $mat_khau) {
        try {
            $sql = "SELECT * FROM nguoi_dungs WHERE email = :email AND mat_khau = :mat_khau";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $ten);
            $stmt->bindParam(':mat_khau', $mat_khau);
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user) {
                $_SESSION['iduser'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['ten'];
                $_SESSION['vai_tro'] = $user['vai_tro'];
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    public function dangky($ten, $mat_khau, $email) {
        try {
            $sql = "INSERT INTO nguoi_dungs (`ten`, `mat_khau`, `email`) VALUES (:ten, :mat_khau, :email)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':ten', $ten);
            $stmt->bindParam(':mat_khau', $mat_khau);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user_id = $this->conn->lastInsertId();
            $_SESSION['name'] = $ten;
            return $user_id;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    public function checkEmailExists($email)
    {
        $sql = "SELECT * FROM nguoi_dungs WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function getAllCategory() {
        try {
            $sql = "SELECT * FROM `danh_mucs`";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    public function getByCategory($danh_muc_id, $offset, $limit) {
        $sql = "SELECT * FROM san_phams WHERE danh_muc_id = :danh_muc_id LIMIT :offset, :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':danh_muc_id', $danh_muc_id, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllProduct($offset, $limit, $ord) {
        try {
            $orderDirection = ($ord === 1) ? 'ASC' : 'DESC'; // Xác định thứ tự sắp xếp
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc 
                FROM san_phams 
                LEFT JOIN danh_mucs 
                ON san_phams.danh_muc_id = danh_mucs.id 
                WHERE san_phams.trang_thai = 1
                ORDER BY san_phams.gia $orderDirection 
                LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getBySearch($search) {
        $sql = "SELECT * FROM san_phams WHERE ten_san_pham LIKE :search";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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



}