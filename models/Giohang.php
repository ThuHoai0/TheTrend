<?php
class Giohang
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }

    public function saveOrder($order_data)
    {
        // Kiểm tra và gán giá trị mặc định cho trang_thai_id nếu không có trong $order_data
        if (!isset($order_data['trang_thai_id']) || empty($order_data['trang_thai_id'])) {
            $order_data['trang_thai_id'] = 11; // Mặc định là 11 nếu không có giá trị
        }

        // Lấy nguoi_dung_id từ session
        $order_data['nguoi_dung_id'] = isset($_SESSION['iduser']) ? $_SESSION['iduser'] : null;

        // Tạo mã đơn hàng ngẫu nhiên 10 ký tự (chữ và số)
        $order_data['ma_don_hang'] = $this->generateOrderCode();

        // Chuẩn bị câu truy vấn SQL để lưu dữ liệu đơn hàng vào cơ sở dữ liệu
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

        // Chuẩn bị câu truy vấn SQL
        $stmt = $this->conn->prepare($sql);

        // Gắn các tham số vào câu truy vấn
        $stmt->bindParam(':san_pham_id', $order_data['san_pham_id'], PDO::PARAM_INT);
        $stmt->bindParam(':ma_don_hang', $order_data['ma_don_hang'], PDO::PARAM_STR); // Mã đơn hàng mới
        $stmt->bindParam(':nguoi_dung_id', $order_data['nguoi_dung_id'], PDO::PARAM_INT);
        $stmt->bindParam(':tong_tien', $order_data['tong_tien'], PDO::PARAM_STR);
        $stmt->bindParam(':trang_thai_id', $order_data['trang_thai_id'], PDO::PARAM_INT);
        $stmt->bindParam(':ngay_dat_hang', $order_data['ngay_dat_hang'], PDO::PARAM_STR);
        $stmt->bindParam(':phuong_thuc_thanh_toan', $order_data['phuong_thuc_thanh_toan'], PDO::PARAM_STR);
        $stmt->bindParam(':trang_thai_thanh_toan', $order_data['trang_thai_thanh_toan'], PDO::PARAM_STR);
        $stmt->bindParam(':ho_ten_nguoi_nhan', $order_data['ho_ten_nguoi_nhan'], PDO::PARAM_STR);
        $stmt->bindParam(':so_dien_thoai_nguoi_nhan', $order_data['so_dien_thoai_nguoi_nhan'], PDO::PARAM_STR);
        $stmt->bindParam(':email_nguoi_nhan', $order_data['email_nguoi_nhan'], PDO::PARAM_STR);
        $stmt->bindParam(':ghi_chu', $order_data['ghi_chu'], PDO::PARAM_STR);
        $stmt->bindParam(':dia_chi_nhan_hang', $order_data['dia_chi_nhan_hang'], PDO::PARAM_STR);

        // Thực thi câu truy vấn và xử lý lỗi
        try {
            if ($stmt->execute()) {
                // Lấy ID của đơn hàng vừa được thêm
                $order_id = $this->conn->lastInsertId();

                // Sau khi đơn hàng được thêm, thêm chi tiết đơn hàng vào bảng chi_tiet_don_hang
                $this->saveOrderDetails($order_id);
                return true;
            } else {
                // Xử lý lỗi
                $errorInfo = $stmt->errorInfo();
                throw new Exception("Lỗi khi tạo đơn hàng: " . $errorInfo[2]);
            }
        } catch (Exception $e) {
            // Ghi lại lỗi vào log
            error_log($e->getMessage());
            echo $e->getMessage();
            echo "Lỗi khi tạo đơn hàng. Vui lòng thử lại.";
        }
    }

// Hàm thêm chi tiết đơn hàng vào bảng chi_tiet_don_hang
    private function saveOrderDetails($order_id)
    {

        foreach ($_SESSION['cart'] as $key => $value) {
            $sql = "INSERT INTO chi_tiet_don_hangs (
            `don_hang_id`, 
            `san_pham_id`, 
            `so_luong`, 
            `don_gia`,
            `thanh_tien`
        ) VALUES (
            :don_hang_id, 
            :san_pham_id, 
            :so_luong, 
            :don_gia,
            :thanh_tien
        )";
            $gia_tien = (int) $value['product_price'] * (int) $value['quantity'];
            // Chuẩn bị câu truy vấn SQL để thêm chi tiết đơn hàng
            $stmt = $this->conn->prepare($sql);
            $this->updateProductQty($value);

            // Gắn các tham số vào câu truy vấn
            $stmt->bindParam(':don_hang_id', $order_id, PDO::PARAM_INT);
            $stmt->bindParam(':san_pham_id', $value['product_id']);
            $stmt->bindParam(':so_luong', $value['quantity'], PDO::PARAM_INT);
            $stmt->bindParam(':thanh_tien', $gia_tien, PDO::PARAM_STR);
            $stmt->bindParam(':don_gia', $value['product_price'], PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    private function updateProductQty($data)
    {
        $sqlProduct = "SELECT so_luong FROM san_phams WHERE id = :id";
        $stmt = $this->conn->prepare($sqlProduct);
        $stmt->bindParam(':id', $data['product_id']);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($product['so_luong'] > 0) {
            $quantity = (int)$product['so_luong'] - (int)$data['quantity'];
            $sql= "UPDATE san_phams SET so_luong = :so_luong WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':so_luong', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':id', $data['product_id']);
            $stmt->execute();
        }

    }

// Hàm tạo mã đơn hàng ngẫu nhiên 10 ký tự gồm số và chữ
    private function generateOrderCode() {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $order_code = '';
        for ($i = 0; $i < 10; $i++) {
            $order_code .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $order_code;
    }


}