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
            $duong_dan_hinh_anh = $_FILES['duong_dan_hinh_anh'];
            $mo_ta = $_POST['mo_ta'];
            $load_hinh_anh = upload($duong_dan_hinh_anh);

            $anh_hien_tai = $this->modelHinhanhsanpham->getDetailData($id);
//var_dump($anh_hien_tai);
//die;
            if ($duong_dan_hinh_anh['error'] === UPLOAD_ERR_NO_FILE) {
                $load_hinh_anh = $anh_hien_tai['duong_dan_hinh_anh'];
            }

//            var_dump($load_hinh_anh);
//            die();


            $errors = [];
            if (empty($errors)) {
                $this->modelHinhanhsanpham->updateData($id, $load_hinh_anh, $mo_ta);
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