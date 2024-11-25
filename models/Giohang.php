<?php
session_start();
class Giohang
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }

    public function addToCart() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $quantity = (int)$_POST['quantity'];

            // Khởi tạo giỏ hàng nếu chưa có
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
            if (isset($_SESSION['cart'][$product_id])) {
                // Cập nhật số lượng nếu sản phẩm đã có
                $_SESSION['cart'][$product_id]['quantity'] += $quantity;
            } else {
                // Thêm sản phẩm mới vào giỏ hàng
                $_SESSION['cart'][$product_id] = [
                    'name' => $product_name,
                    'price' => $product_price,
                    'quantity' => $quantity
                ];
            }

            // Tính tổng số lượng sản phẩm trong giỏ hàng
            $_SESSION['cart_total'] = array_sum(array_column($_SESSION['cart'], 'quantity'));

            // Chuyển hướng hoặc hiển thị thông báo
            header("Location: giohang.php");
            exit();
        }

    }
}