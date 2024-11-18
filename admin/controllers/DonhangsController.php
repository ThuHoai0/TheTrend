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
        $don_hang = $this->modelDonhang->getDetailData($id);
        require_once './views/donhang/chitiet.php';
    }
    public function edit()
    {
        $id = $_GET['id'];
        $don_hang = $this->modelDonhang->getDetailData($id);
        require_once './views/donhang/edit.php';
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $don_hang = $this->modelDonhang->getDetailData($id);
            $trang_thai_don_hang = $_POST['trang_thai'];
            $errors = [];
            if (empty($trang_thai_don_hang)) {
                $errors['$trang_thai_don_hang'] = "Trạng thái đơn hàng là bắt buộc";
            }elseif ($trang_thai_don_hang<$don_hang['trang_thai_id']){
                $errors['$trang_thai_don_hang'] = "Trạng thái đơn hàng không thể lùi lại";
            }
            if (empty($errors)) {
                $this->modelDonhang->updateData($id,$trang_thai_don_hang);
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