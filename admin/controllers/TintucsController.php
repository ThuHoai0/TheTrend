<?php

class TintucsController
{
    public $modelTintuc;
    public function __construct()
    {
        $this->modelTintuc = new Tintuc();
    }
    public function index()
    {
        $tin_tucs = null;
        if (isset($_GET['search'])) {
            $tin_tucs = $this->modelTintuc->getBySearch($_GET['search']);
        } else {
            $tin_tucs = $this->modelTintuc->getAll();
        }
        require_once './views/tintuc/list.php';
    }
    public function chitiet()
    {
        $id = $_GET['id'];
        $tin_tuc = $this->modelTintuc->getDetailData($id);
        require_once './views/tintuc/chitiet.php';
    }
    public function create(){
        require_once './views/tintuc/create.php';
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $tieu_de = $_POST['tieu_de'];
            $noi_dung = $_POST['noi_dung'];
            $ngay_tao = isset($_POST['ngay_tao']) ? $_POST['ngay_tao'] : date('Y-m-d H:i:s'); // Use current date & time in Vietnam
            $trang_thai = $_POST['trang_thai'];
            $errors = [];
            if (empty($tieu_de)) {
                $errors['tieu_de'] = "Tên tiêu đề là bắt buộc";
            }
            if (empty($errors)) {
                $this->modelTintuc->postData($tieu_de, $noi_dung, $ngay_tao, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=tintuc/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=tintuc/create');
                exit();
            }
        }
    }
    public function edit()
    {
        $id = $_GET['id'];
        $tin_tuc = $this->modelTintuc->getDetailData($id);
        require_once './views/tintuc/edit.php';
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $tieu_de = $_POST['tieu_de'];
            $noi_dung = $_POST['noi_dung'];
            $trang_thai = $_POST['trang_thai'];
            $errors = [];
            if (empty($tieu_de)) {
                $errors['tieu_de'] = "Tên tiêu đề là bắt buộc";
            }
            if (empty($errors)) {
                $this->modelTintuc->updateData($id, $tieu_de, $noi_dung, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=tintuc/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=tintuc/edit&id=' . $id);
                exit();
            }
        } else {
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelTintuc->deleteData($id);
            header('Location: ?act=tintuc/list');
            exit();
        }
    }
    public function search() {
        $keyword = isset($_GET['query']) ? $_GET['query'] : '';
        $results = $this->modelTintuc->searchTinTuc($keyword);
        header('Content-Type: application/json');
        echo json_encode($results);
    }
}


