<?php
class Giohang
{
    public $conn;

    // Constructor để kết nối cơ sở dữ liệu
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

    private function generateOrderCode() {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $order_code = '';
        for ($i = 0; $i < 10; $i++) {
            $order_code .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $order_code;
    }

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

    // Hàm để thêm sản phẩm vào giỏ hàng
    public function addToCart($product_id, $quantity)
    {
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $sql = "SELECT * FROM gio_hangs WHERE nguoi_dung_id = :nguoi_dung_id AND san_pham_id = :san_pham_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':nguoi_dung_id' => $_SESSION['iduser'], ':san_pham_id' => $product_id]);

        // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
        if ($stmt->rowCount() > 0) {
            $sql_update = "UPDATE gio_hangs SET so_luong = so_luong + :so_luong WHERE nguoi_dung_id = :nguoi_dung_id AND san_pham_id = :san_pham_id";
            $stmt_update = $this->conn->prepare($sql_update);
            $stmt_update->execute([':so_luong' => $quantity, ':nguoi_dung_id' => $_SESSION['iduser'], ':san_pham_id' => $product_id]);
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
            $sql_insert = "INSERT INTO gio_hangs (san_pham_id, nguoi_dung_id, so_luong) VALUES (:san_pham_id, :nguoi_dung_id, :so_luong)";
            $stmt_insert = $this->conn->prepare($sql_insert);
            $stmt_insert->execute([':san_pham_id' => $product_id, ':nguoi_dung_id' => $_SESSION['iduser'], ':so_luong' => $quantity]);
        }
    }

    // Hàm để lấy thông tin giỏ hàng
    public function getCart()
    {
        $sql = "SELECT * FROM gio_hangs WHERE nguoi_dung_id = :nguoi_dung_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':nguoi_dung_id' => $_SESSION['iduser']]);
        return $stmt->fetchAll();
    }

    // Hàm để xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($product_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['act'] === 'removeFromCart') {
            $input = json_decode(file_get_contents('php://input'), true);
            $productId = $input['productId'] ?? null;
            if ($product_id !== null && isset($_SESSION['cart'][$product_id])) {
                // Xóa sản phẩm khỏi session giỏ hàng
                unset($_SESSION['cart'][$product_id]);
                // Trả về phản hồi thành công
                header('Location: ./?act=giohang');
//                echo json_encode(['success' => true]);
            } else {
                // Trả về phản hồi lỗi
                header('Location: ./?act=giohang');
//                echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm.']);
            }
            exit;
        }
    }

    public function getProductById($productId)
    {
        try {
            $sql = "SELECT * 
                FROM san_phams 
                WHERE id = :productId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}
