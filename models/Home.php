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

            // gan gia tri vao cac tham so
            $stmt->bindParam(':ten', $ten);
            $stmt->bindParam(':mat_khau', $mat_khau);
            $stmt->bindParam(':email', $email);

            $stmt->execute();

            $user_id = $this->conn->lastInsertId();

            $_SESSION['name'] = $ten;

            return $user_id;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            die;
            echo 'Error: ' .$e->getMessage();
        }
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
            // Xác định thứ tự sắp xếp (cao -> thấp hoặc thấp -> cao)
            $orderDirection = ($ord === 1) ? 'ASC' : 'DESC';

            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc 
                FROM san_phams 
                LEFT JOIN danh_mucs 
                ON san_phams.danh_muc_id = danh_mucs.id 
                ORDER BY san_phams.gia $orderDirection 
                LIMIT :limit OFFSET :offset";

            $stmt = $this->conn->prepare($sql);

            // Bind các tham số vào câu SQL
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

            $stmt->execute();

            // Lấy kết quả
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getBySearch($search) {
        $sql = "SELECT * FROM san_phams WHERE ten_san_pham LIKE :search";
//        die('túi');
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTop8Products() {
        try {
            $sql = "SELECT sp.id, sp.ten_san_pham, sp.gia, sp.hinh_anh, COUNT(dh.san_pham_id) AS luot_mua
                FROM san_phams sp
                JOIN don_hangs dh ON sp.id = dh.san_pham_id
                GROUP BY sp.id, sp.ten_san_pham, sp.gia, sp.hinh_anh
                ORDER BY luot_mua DESC
                LIMIT 8";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function getDetailData($id)
    {
        try {
            $sql = "SELECT ten_san_pham, mo_ta, gia, hinh_anh, so_luong FROM `san_phams`
            WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function lienhe($email, $ho_ten, $so_dien_thoai,$noi_dung) {
        try {
            $sql = "INSERT INTO lien_hes (`ho_ten`, `email`, `so_dien_thoai`, `noi_dung`) VALUES (:ho_ten, :email, :so_dien_thoai, :noi_dung)";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':ho_ten', $ho_ten);
            $stmt->bindParam(':so_dien_thoai', $so_dien_thoai);
            $stmt->bindParam(':noi_dung', $noi_dung);

            $stmt->execute();


        }
        catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    


    
}