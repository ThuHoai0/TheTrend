<?php

class ChitietdonhangsController
{
    public $modelChitietdonhang;
    public function __construct() {
        $this->modelChitietdonhang = new Chitietdonhang();
    }
    public function index()
    {
        $chi_tiet_don_hangs = null;

        if (isset($_GET['search'])) {
            $chi_tiet_don_hangs = $this->modelChitietdonhang->getBySearch($_GET['search']);
        } else {
            $chi_tiet_don_hangs = $this->modelChitietdonhang->getAll();
        }
        require_once './views/chitietdonhang/list.php';
    }
    public  function chitiet ()
    {
        $id = $_GET['id'];
        $chi_tiet_don_hang = $this->modelChitietdonhang->getDetailData($id);
        require_once './views/chitietdonhang/chitiet.php';
    }
    public function edit()
    {
        $id = $_GET['id'];
        $chi_tiet_don_hang = $this->modelChitietdonhang->getDetailData($id);
        require_once './views/chitietdonhang/edit.php';
    }
    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $id = $_GET['id'];
            $chi_tiet_don_hang = $this->modelChitietdonhang->getDetailData($id);

            $don_hang_id = $_POST['don_hang_id'];
            $san_pham_id = $_POST['san_pham_id'];
            $so_luong = $_POST['so_luong'];
            $gia = $_POST['don_gia'];

            $errors = [];

            if (empty($errors)) {
                $this->modelDonhang->updateData($id,$don_hang_id, $san_pham_id , $so_luong, $gia);
                unset($_SESSION['errors']);
                header('Location: ?act=chitietdonhang/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=chitietdonhang/edit&id=' . $id);
                exit();
            }
        } else {
            // Xử lý nếu phương thức không phải là POST
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelChitietdonhang->deleteData($id);
            header('Location: ?act=chitietdonhang/list');
            exit();
        }
    }

}