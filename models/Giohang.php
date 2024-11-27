<?php
class Giohang
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }

    public function saveOrder($order_data) {
        // Prepare the SQL query to insert the order data into the database
        $sql = "INSERT INTO don_hangs (
                    `san_pham_id`, 
                    `ma_don_hang`, 
                    `nguoi_dung_id`, 
                    `tong_tien`, 
                    `trang_thai_id`, 
                    `ngay_dat_hang`, 
                    `phuong_thuc_thanh_toan`, 
                    `trang_thai_thanh_toan`, 
                    `ho_ten_nguoi_nhan`, 
                    `so_dien_thoai_nguoi_nhan`, 
                    `email_nguoi_nhan`, 
                    `ghi_chu`, 
                    `dia_chi_nhan_hang`
                ) VALUES (
                    :san_pham_id, 
                    :ma_don_hang, 
                    :nguoi_dung_id, 
                    :tong_tien, 
                    :trang_thai_id, 
                    :ngay_dat_hang, 
                    :phuong_thuc_thanh_toan, 
                    :trang_thai_thanh_toan, 
                    :ho_ten_nguoi_nhan, 
                    :so_dien_thoai_nguoi_nhan, 
                    :email_nguoi_nhan, 
                    :ghi_chu, 
                    :dia_chi_nhan_hang
                )";

// Prepare the SQL statement
        $stmt = $this->conn->prepare($sql);

// Bind the parameters
        $stmt->bindParam(':san_pham_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':ma_don_hang', $order_code, PDO::PARAM_STR); // If you have a unique order code, generate or get it here
        $stmt->bindParam(':nguoi_dung_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':tong_tien', $total_price, PDO::PARAM_STR);
        $stmt->bindParam(':trang_thai_id', $order_status, PDO::PARAM_STR); // 'pending' or based on your business logic
        $stmt->bindParam(':ngay_dat_hang', $order_date, PDO::PARAM_STR);
        $stmt->bindParam(':phuong_thuc_thanh_toan', $payment_method, PDO::PARAM_STR);
        $stmt->bindParam(':trang_thai_thanh_toan', $payment_status, PDO::PARAM_STR); // 'pending', 'paid', etc.
        $stmt->bindParam(':ho_ten_nguoi_nhan', $ho_ten_nguoi_nhan, PDO::PARAM_STR);
        $stmt->bindParam(':so_dien_thoai_nguoi_nhan', $so_dien_thoai_nguoi_nhan, PDO::PARAM_STR);
        $stmt->bindParam(':email_nguoi_nhan', $email_nguoi_nhan, PDO::PARAM_STR);
        $stmt->bindParam(':ghi_chu', $ghi_chu, PDO::PARAM_STR);
        $stmt->bindParam(':dia_chi_nhan_hang', $dia_chi_nhan_hang, PDO::PARAM_STR);

// Execute the query and handle errors
        if ($stmt->execute()) {
            // Order was successfully inserted
            $order_id = $this->conn->lastInsertId();  // Get the ID of the last inserted order (if needed)
            echo "Order placed successfully. Order ID: " . $order_id;
        } else {
            // Handle error
            echo "Error placing the order. Please try again.";
        }
    }

}