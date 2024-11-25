<?php
class GiohangController
{
    public $modelGiohang;

    public function __construct()
    {
        $this->modelGiohang = new Giohang();
    }

    public function giohang(){
        require_once './giohang.php';
    }
//    public function addToCart() {
//        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            // Lấy dữ liệu từ form
//            $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
//            $product_name = isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : '';
//            $product_price = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0;
//            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
//
//            // Kiểm tra dữ liệu hợp lệ
//            if ($product_id > 0 && $quantity > 0) {
//                // Lưu vào session hoặc xử lý logic thêm giỏ hàng
//                session_start();
//                if (!isset($_SESSION['cart'])) {
//                    $_SESSION['cart'] = [];
//                }
//                $_SESSION['cart'][] = [
//                    'product_id' => $product_id,
//                    'product_name' => $product_name,
//                    'product_price' => $product_price,
//                    'quantity' => $quantity,
//                ];
//
//                // Redirect lại trang chi tiết sản phẩm hoặc giỏ hàng
//                header("Location: chitietsanpham.php?id=" . $product_id);
//                exit();
//            } else {
//                echo "Dữ liệu không hợp lệ!";
//            }
//        }
//    }
}