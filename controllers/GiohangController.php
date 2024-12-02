<?php
class GiohangController
{
    public $modelGiohang;

    public function __construct()
    {
        $this->modelGiohang = new Giohang();
    }

    // Hàm xem giỏ hàng
    public function giohang()
    {
        require_once './giohang.php';
    }

    // Hàm thêm sản phẩm vào giỏ hàng
    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'];
            $so_luong = $_POST['so_luong'];

            // Gọi model Giohang để thêm sản phẩm vào giỏ hàng
            $this->modelGiohang->addToCart($san_pham_id, $so_luong);
            header('Location: /giohang');  // Điều hướng lại về giỏ hàng
        }
    }

    // Hàm xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ID sản phẩm từ form
            $san_pham_id = $_POST['san_pham_id'];

            // Gọi model Giohang để xóa sản phẩm khỏi giỏ hàng
            $this->modelGiohang->removeFromCart($san_pham_id);

            // Cập nhật giỏ hàng trong session (xóa sản phẩm khỏi giỏ hàng trong session)
            if (isset($_SESSION['cart'][$san_pham_id])) {
                unset($_SESSION['cart'][$san_pham_id]);
            }

            // Điều hướng lại về giỏ hàng
            header('Location: /giohang');
            exit();
        }
    }

}
