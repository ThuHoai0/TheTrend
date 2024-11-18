<?php

class NguoidungsController
{
    public $modelNguoidung;
    public function __construct()
    {
        $this->modelNguoidung = new Nguoidung();
    }
    public function index()
    {
        $nguoi_dungs = null;
        if (isset($_GET['search'])) {
            $nguoi_dungs = $this->modelNguoidung->getBySearch($_GET['search']);
        } else {
            $nguoi_dungs = $this->modelNguoidung->getAll();
        }
        require_once './views/nguoidung/list.php';
    }
    public function chitiet()
    {
        $id = $_GET['id'];
        $nguoi_dung = $this->modelNguoidung->getDetailData($id);
        require_once './views/nguoidung/chitiet.php';
    }
    public function edit()
    {
        $id = $_GET['id'];
        $nguoi_dung = $this->modelNguoidung->getDetailData($id);
        require_once './views/nguoidung/edit.php';
    }
    public function update()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $trang_thai = $_POST['trang_thai'];
            if (empty($errors)) {
                $this->modelNguoidung->updateData($id, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=nguoidung/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=nguoidung/edit&id=' . $id);
                exit();
            }
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['nguoidung_id'];
            $this->modelNguoidung->deleteData($id);
            header('Location: ?act=nguoidung/list');
            exit();
        }
    }
}


