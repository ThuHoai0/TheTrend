<?php
class YeuthichController
{
    public $modelYeuthich;

    public function __construct()
    {
        $this->modelYeuthich = new Yeuthich();
    }

    public function getDetailData(){
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = intval($_GET['id']);
            $nguoiDungId = $_SESSION['iduser'] ?? null;

            $yeu_thich = $this->modelYeuthich->getDetailData($id);

        }
        
        require_once './yeuthich.php';
    }

    public function addYeuthich()
{

    if (isset($_GET['id'])) {
        // Thiết lập múi giờ
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        // Lấy dữ liệu từ URL và session
        $sanPhamId = intval($_GET['id']); // ID sản phẩm
        $nguoiDungId = $_SESSION['iduser'] ?? null; // ID người dùng từ session (nếu đã đăng nhập)

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!$nguoiDungId) {
            $_SESSION['errors'] = ['Bạn cần đăng nhập để thêm sản phẩm vào danh sách yêu thích.'];
            header('Location: ?act=login');
            exit();
        }


        // Kiểm tra nếu sản phẩm đã nằm trong danh sách yêu thích


        // Thêm sản phẩm vào danh sách yêu thích
        $this->modelYeuthich->addYeuthich($sanPhamId, $nguoiDungId);

        // Lưu thông báo thành công
        $_SESSION['success'] = "Sản phẩm đã được thêm vào danh sách yêu thích!";
        header('Location: ?act=home');
        exit();
    } else {
        // Điều hướng nếu không phải POST hoặc không có ID sản phẩm
        header('Location: ?act=home');
        exit();
    }
}
}

