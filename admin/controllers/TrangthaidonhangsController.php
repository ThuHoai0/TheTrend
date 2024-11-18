<?php

class TrangthaidonhangsController
{
    public $modelTrangthaidonhang;
    public function __construct()
    {
        $this->modelTrangthaidonhang = new Trangthaidonhang();
    }
    public function index()
    {
        $trang_thai_don_hangs = null;
        if (isset($_GET['search'])) {
            $trang_thai_don_hangs = $this->modelTrangthaidonhang->getBySearch($_GET['search']);
        } else {
            $trang_thai_don_hangs = $this->modelTrangthaidonhang->getAll();
        }
        require_once './views/trangthaidonhang/list.php';
    }
    public function create(){
        require_once './views/trangthaidonhang/create.php';
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ten_trang_thai = $_POST['ten_trang_thai'];
            $mo_ta = $_POST['mo_ta'];
            $errors = [];
            if (empty($ten_trang_thai)) {
                $errors['ten_trang_thai'] = "Tên trạng thái là bắt buộc";
            }
            if (empty($errors)) {
                $this->modelTrangthaidonhang->postData($ten_trang_thai, $mo_ta);
                unset($_SESSION['errors']);
                header('Location: ?act=trangthaidonhang/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=trangthaidonhang/create');
                exit();
            }
        }
    }
    public function edit()
    {
        $id = $_GET['id'];
        $trang_thai_don_hang = $this->modelTrangthaidonhang->getDetailData($id);
        require_once './views/trangthaidonhang/edit.php';
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $ten_trang_thai = $_POST['ten_trang_thai'];
            $mo_ta = $_POST['mo_ta'];
            $errors = [];
            if (empty($ten_trang_thai)) {
                $errors['ten_trang_thai'] = "Tên trạng thái là bắt buộc";
            }
            if (empty($errors)) {
                $this->modelTrangthaidonhang->updateData($id, $ten_trang_thai, $mo_ta);
                unset($_SESSION['errors']);
                header('Location: ?act=trangthaidonhang/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=trangthaidonhang/edit&id=' . $id);
                exit();
            }
        } else {
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelTrangthaidonhang->deleteData($id);
            header('Location: ?act=trangthaidonhang/list');
            exit();
        }
    }
}


