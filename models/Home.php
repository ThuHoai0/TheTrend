<?php

class Home
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getActiveBanners()
    {
        try {
            $sql = "SELECT * FROM banners WHERE trang_thai = 1 ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
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
                $_SESSION['so_dien_thoai'] = $user['so_dien_thoai'];
                $_SESSION['dia_chi'] = $user['dia_chi'];
                $_SESSION['vai_tro'] = $user['vai_tro'];
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function dangky($ten, $mat_khau, $email)
    {
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
            echo 'Error: ' . $e->getMessage();
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

    public function getAllCategory()
    {
        try {
            $sql = "SELECT * FROM `danh_mucs`";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getByCategory($danh_muc_id, $offset, $limit)
    {
        $sql = "SELECT * FROM san_phams WHERE danh_muc_id = :danh_muc_id LIMIT :offset, :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':danh_muc_id', $danh_muc_id, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProduct($offset, $limit, $ord)
    {
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

    public function getBySearch($search)
    {
        $sql = "SELECT * FROM san_phams WHERE ten_san_pham LIKE :search";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalProducts()
    {
        $sql = "SELECT COUNT(*) AS total FROM san_phams";
        $query = $this->conn->query($sql);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getTotalByCategory($danh_muc_id)
    {
        $sql = "SELECT COUNT(*) AS total FROM san_phams WHERE danh_muc_id = :danh_muc_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':danh_muc_id', $danh_muc_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function listYeuThich()
    {
        if (!empty($_SESSION['iduser'])) {
            $sql = "SELECT * FROM san_pham_yeu_thichs as yt JOIN san_phams as s 
    ON yt.san_pham_id = s.id 
         WHERE s.trang_thai = 1 AND yt.nguoi_dung_id = :nguoi_dung_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nguoi_dung_id', $_SESSION['iduser']);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getTopProduct()
    {
        $sql = "SELECT p.*, SUM(ct.so_luong) as tong_so_luong FROM chi_tiet_don_hangs as ct JOIN san_phams as p ON ct.san_pham_id = p.id GROUP BY san_pham_id ORDER BY tong_so_luong DESC LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}