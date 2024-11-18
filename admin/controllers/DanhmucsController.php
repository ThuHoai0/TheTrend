<?php

class DanhmucsController
{
    public $modelDanhmuc;
    public function __construct()
    {
        $this->modelDanhmuc = new Danhmuc();
    }
    public function index()
    {
        $danh_mucs = null;
        if (isset($_GET['search'])) {
            $danh_mucs = $this->modelDanhmuc->getBySearch($_GET['search']);
        } else {
            $danh_mucs = $this->modelDanhmuc->getAll();
        }
        require_once './views/danhmuc/list.php';
    }
    public function chitiet()
    {
        $id = $_GET['id'];
        $danh_muc = $this->modelDanhmuc->getDetailData($id);
        require_once './views/danhmuc/chitiet.php';
    }
    public function create(){
        require_once './views/danhmuc/create.php';
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $ngay_tao = isset($_POST['ngay_tao']) ? $_POST['ngay_tao'] : date('Y-m-d H:i:s'); // Use current date & time in Vietnam
            $trang_thai = $_POST['trang_thai'];
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = "Tên danh mục là bắt buộc";
            }
            if (empty($trang_thai) && $trang_thai != 0) {
                $errors['trang_thai'] = "Trạng thái tạo là bắt buộc";
            }
            if (empty($errors)) {
                $this->modelDanhmuc->postData($ten_danh_muc, $mo_ta, $ngay_tao, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=danhmuc/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=danhmuc/create');
                exit();
            }
        }
    }
    public function edit()
    {
        $id = $_GET['id'];
        $danh_muc = $this->modelDanhmuc->getDetailData($id);
        require_once './views/danhmuc/edit.php';
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = "Tên danh mục là bắt buộc";
            }
            if (empty($errors)) {
                $this->modelDanhmuc->updateData($id, $ten_danh_muc, $mo_ta, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=danhmuc/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=danhmuc/edit&id=' . $id);
                exit();
            }
        } else {

        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelDanhmuc->deleteData($id);
            header('Location: ?act=danhmuc/list');
            exit();
        }
    }
}


