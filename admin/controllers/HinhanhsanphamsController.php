<?php

class HinhanhsanphamsController
{
    public $modelHinhanhsanpham;
    public function __construct()
    {
        $this->modelHinhanhsanpham = new Hinhanhsanpham();
    }
    public function index()
    {
        $hinh_anh_san_phams = null;
        if (isset($_GET['search'])) {
            $hinh_anh_san_phams = $this->modelHinhanhsanpham->getBySearch($_GET['search']);
        } else {
            $hinh_anh_san_phams = $this->modelHinhanhsanpham->getAll();
        }
        require_once './views/hinhanhsanpham/list.php';
    }
    public function chitiet()
    {
        $id = $_GET['id'];
        $hinh_anh_san_pham = $this->modelHinhanhsanpham->getDetailData($id);
        require_once './views/hinhanhsanpham/chitiet.php';
    }
    public function edit()
    {
        $id = $_GET['id'];
        $hinh_anh_san_pham = $this->modelHinhanhsanpham->getDetailData($id);
        require_once './views/hinhanhsanpham/edit.php';
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $ten_san_pham = $_POST['ten_san_pham'];
            $duong_dan_hinh_anh = $_FILES['duong_dan_hinh_anh'];
            $mo_ta = $_POST['mo_ta'];
            $currentData = $this->modelHinhanhsanpham->getDetailData($id);
            if ($duong_dan_hinh_anh['error'] == UPLOAD_ERR_OK) {
                $load_hinh_anh = upload($duong_dan_hinh_anh);
            } else {
                $load_hinh_anh = $currentData['duong_dan_hinh_anh'];
            }
            $errors = [];
            if (empty($errors)) {
                $this->modelHinhanhsanpham->updateData($id, $ten_san_pham, $load_hinh_anh, $mo_ta);
                unset($_SESSION['errors']);
                header('Location: ?act=hinhanhsanpham/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=hinhanhsanpham/edit&id=' . $id);
                exit();
            }
        } else {
        }
    }
}