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
    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $id = $_GET['id'];
            $don_hang = $this->modelDonhang->getDetailData($id);
//            $ten_nguoi_dung = $_POST['ten_nguoi_dung'];
//            $ngay_dat_hang = $_POST['ngay_dat_hang'];
//            $phuong_thuc_thanh_toan = $_POST['phuong_thuc_thanh_toan'];
//            $trang_thai_thanh_toan = $_POST['trang_thai_thanh_toan'];
//            $ho_ten_nguoi_nhan = $_POST['ho_ten_nguoi_nhan'];
//            $so_dien_thoai_nguoi_nhan = $_POST['so_dien_thoai_nguoi_nhan'];
//            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
//            $ghi_chu = $_POST['ghi_chu'];
//            $tong_tien = $_POST['tong_tien'];
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
            // Xử lý nếu phương thức không phải là POST
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