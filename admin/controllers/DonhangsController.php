<?php

class DonhangsController
{
    public $modelDonhang;
    public function __construct() {
        $this->modelDonhang = new Donhang();
    }
    public function index()
    {
        $don_hangs = null;

        if (isset($_GET['search'])) {
            $don_hangs = $this->modelDonhang->getBySearch($_GET['search']);
        } else {
            $don_hangs = $this->modelDonhang->getAll();
        }
        require_once './views/donhang/list.php';
    }
    public  function chitiet ()
    {
        $id = $_GET['id'];
    //    $don_hang = $this->modelDonhang->getDetailData($id);
        $don_hang = $this->modelDonhang->getOrderInfo($id); // Chứa thông tin chung
        $san_phams = $this->modelDonhang->getOrderProducts($id); // Chứa danh sách sản phẩm

//         var_dump($don_hang);
//         var_dump($san_phams);
//         die();
        require_once './views/donhang/chitiet.php';
    }
    public function edit()
    {
        // Lấy id từ URL
        $id = $_GET['id'];

        // Lấy chi tiết đơn hàng từ model
        $don_hang = $this->modelDonhang->getDetailData($id);

        // Kiểm tra nếu không tìm thấy đơn hàng
        if (!$don_hang) {
            echo "Không tìm thấy đơn hàng!";
            return;
        }

        // Truyền dữ liệu vào view
        require_once './views/donhang/edit.php';
    }

    // Phương thức update để xử lý việc cập nhật thông tin đơn hàng
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $trang_thai_don_hang = $_POST['trang_thai'];
            $don_hang = $this->modelDonhang->getDetailData($id);
            $errors = [];
            if (empty($trang_thai_don_hang)) {
                $errors['$trang_thai_don_hang'] = "Trạng thái đơn hàng là bắt buộc";
            }elseif ($trang_thai_don_hang<$don_hang['trang_thai_id']){
                $errors['$trang_thai_don_hang'] = "Trạng thái đơn hàng không thể lùi lại";
            }
            if (empty($errors)) {
                $this->modelDonhang->updateData($id, $trang_thai_don_hang);
                unset($_SESSION['errors']);
                header('Location: ?act=donhang/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=donhang/edit&id=' . $id);
                exit();
            }
        } else {
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelDonhang->deleteData($id);
            header('Location: ?act=donhang/list');
            exit();
        }
    }
}