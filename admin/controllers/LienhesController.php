<?php

class LienhesController
{
    public $modelLienhe;
    public function __construct()
    {
        $this->modelLienhe = new Lienhe();
    }
    public function index()
    {
        $lien_hes = null;
        if (isset($_GET['search'])) {
            $lien_hes = $this->modelLienhe->getBySearch($_GET['search']);
        } else {
            $lien_hes = $this->modelLienhe->getAll();
        }
        require_once './views/lienhe/list.php';
    }
    public function chitiet()
    {
        $id = $_GET['id'];
        $lien_he = $this->modelLienhe->getDetailData($id);
        require_once './views/lienhe/chitiet.php';
    }
    public function create(){
        require_once './views/lienhe/create.php';
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $trang_thai = $_POST['trang_thai'];
            $noi_dung = $_POST['noi_dung'];
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Tên người liên hệ là bắt buộc";
            }
            if (empty($email)) {
                $errors['email'] = "Email là bắt buộc";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Định dạng email không hợp lệ";
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại là bắt buộc";
            } elseif (!preg_match("/^[0-9]{10,11}$/", $so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại phải là 10-11 chữ số";
            }
            if (empty($errors)) {
                $this->modelLienhe->postData($ho_ten,$email,$so_dien_thoai,$noi_dung,$trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=lienhe/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=lienhe/create');
                exit();
            }
        }
    }
    public function edit()
    {
        $id = $_GET['id'];
        $lien_he = $this->modelLienhe->getDetailData($id);
        require_once './views/lienhe/edit.php';
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $trang_thai = $_POST['trang_thai'];
            $errors = [];
            if (empty($errors)) {
                $this->modelLienhe->updateData($id,$trang_thai);
                header('Location: ?act=lienhe/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=lienhe/edit&id=' . $id);
                exit();
            }
        } else {
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelLienhe->deleteData($id);
            header('Location: ?act=lienhe/list');
            exit();
        }
    }
}


