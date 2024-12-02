<?php
class Giohang
{
    public $conn;

    // Constructor để kết nối cơ sở dữ liệu
    public function __construct() {
        $this->conn = connectDB();
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
            if ($productId !== null && isset($_SESSION['cart'][$productId])) {
                // Xóa sản phẩm khỏi session giỏ hàng
                unset($_SESSION['cart'][$productId]);
                // Trả về phản hồi thành công
                echo json_encode(['success' => true]);
            } else {
                // Trả về phản hồi lỗi
                echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm.']);
            }
            exit;
        }
    }

}
