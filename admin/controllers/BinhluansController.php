<?php

class BinhluansController
{
    public $modelBinhluan;
    public function __construct() {
        $this->modelBinhluan = new Binhluan();
    }
    public function index()
    {
        $binh_luans = null;
        if (isset($_GET['search'])) {
            $binh_luans = $this->modelBinhluan->getBySearch($_GET['search']);
        } else {
            $binh_luans = $this->modelBinhluan->getAll();
        }
        require_once './views/binhluan/list.php';
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
        }
    }

    public function chitiet()
    {
        $id = $_GET['id'];
        $binh_luan = $this->modelBinhluan->getDetailData($id);
        $sp = $this->modelBinhluan->getProduct();
        $us = $this->modelBinhluan->getUser();
        require_once './views/binhluan/chitiet.php';
    }
    public function edit()
    {
        $id = $_GET['id'];
        $binh_luan = $this->modelBinhluan->getDetailData($id);
        $sp = $this->modelBinhluan->getProduct();
        $us = $this->modelBinhluan->getUser();
        require_once './views/binhluan/edit.php';
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $trang_thai = $_POST['trang_thai'];

            $errors = [];
            if (empty($errors)) {
                $this->modelBinhluan->updateData($id, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=binhluan/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=binhluan/edit&id=' . $id);
                exit();
            }
        } else {
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $binh_luan_id = $_POST['id']; // ID của đánh giá
            
            // Lấy ID sản phẩm từ đánh giá trước khi xóa
            $san_pham_id = $this->modelBinhluan->getProductIdByBinhluanId($binh_luan_id);
            
            // Xóa đánh giá
            $this->modelBinhluan->deleteData($binh_luan_id);
            
            // Điều hướng về trang chi tiết sản phẩm
            if ($san_pham_id) {
                header('Location: ?act=sanpham/chitiet&id=' . $san_pham_id);
            } else {
                // Trường hợp không lấy được sản phẩm, điều hướng về danh sách sản phẩm hoặc trang lỗi
                header('Location: act=sanpham/list');
            }
            exit();
        }
    }
}