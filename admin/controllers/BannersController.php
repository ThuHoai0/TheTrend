<?php

class BannersController
{
    public $modelBanner;
    public function __construct()
    {
        $this->modelBanner = new Banner();
    }
    public function index()
    {
        $banners = $this->modelBanner->getAll();
        require_once './views/banner/list.php';
    }
    public function create(){
        require_once './views/banner/create.php';
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $duong_dan_hinh_anh = $_FILES['duong_dan_hinh_anh'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];
            $load_duong_dan_hinh_anh = upload($duong_dan_hinh_anh);
            $errors = [];
            if (empty($load_duong_dan_hinh_anh)) {
                $errors['duong_dan_hinh_anh'] = "Hình ảnh là bắt buộc";
            }
            // if (empty($mo_ta)) {
            //     $errors['mo_ta'] = "Vui lòng nhập mô tả";
            // }
            if (empty($errors)) {
                $this->modelBanner->postData($load_duong_dan_hinh_anh,$mo_ta,$trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=banner/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=banner/create');
                exit();
            }
        }
    }
    public function edit()
    {
        $id = $_GET['id'];
        $banner = $this->modelBanner->getDetailData($id);
        require_once './views/banner/edit.php';
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $duong_dan_hinh_anh = $_FILES['duong_dan_hinh_anh'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];
            $currentData = $this->modelBanner->getDetailData($id);
            if ($duong_dan_hinh_anh['error'] == UPLOAD_ERR_OK) {
                $load_hinh_anh = upload($duong_dan_hinh_anh);
            } else {
                $load_hinh_anh = $currentData['duong_dan_hinh_anh'];
            }
            if (empty($errors)) {
                $this->modelBanner->updateData($id,$load_hinh_anh,$mo_ta,$trang_thai);
                header('Location: ?act=banner/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=banner/edit&id=' . $id);
                exit();
            }
        } else {
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelBanner->deleteData($id);
            header('Location: ?act=banner/list');
            exit();
        }
    }
}


