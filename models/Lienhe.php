<?php

class Lienhe
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

   
    // them du lieu vao CSDL
    public function postData($ho_ten, $email, $so_dien_thoai, $noi_dung) {
        try {
            // Câu lệnh SQL đã sửa
            $sql = "INSERT INTO `lien_hes`(`ho_ten`, `email`, `so_dien_thoai`, `noi_dung`, `ngay_gui`) 
                    VALUES (:ho_ten, :email, :so_dien_thoai, :noi_dung, NOW())";
    
            $stmt = $this->conn->prepare($sql);
    
            // Gắn giá trị vào các tham số
            $stmt->bindParam(':ho_ten', $ho_ten);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':so_dien_thoai', $so_dien_thoai);
            $stmt->bindParam(':noi_dung', $noi_dung);
    
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    

    // huy ket noi CSDL
    public function __destruct() {
        $this->conn = null;
    }

  

}
