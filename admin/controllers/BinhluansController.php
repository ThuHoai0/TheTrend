<?php

class BinhluansController
{
    public $modelBinhluan;
    public function __construct() {
        $this->modelBinhluan = new Binhluan();
    }

    public function index()
    {
        $binh_luans = null;

        if (isset($_GET['search'])) {
            $binh_luans = $this->modelBinhluan->getBySearch($_GET['search']);
        } else {
            $binh_luans = $this->modelBinhluan->getAll();
        }
        
        // dua du lieu ra view
        require_once './views/binhluan/list.php';
    }

    // ham xu ly them vao CSDL
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Vietnam
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // lay ra du lieu
            $san_pham_id = $_POST['ten_sp'];
            $nguoi_dung_id = $_POST['ten'];
            $noi_dung = $_POST['noi_dung'];
            $ngay_binh_luan = isset($_POST['ngay_binh_luan']) ? $_POST['ngay_binh_luan'] : date('Y-m-d H:i:s'); 
            $trang_thai = $_POST['trang_thai'];
            $bieu_tuong = $_POST['bieu_tuong'];
            
            // validate
            $errors = [];

            // them du lieu
        }
    }

    public function chitiet()
    {
        $id = $_GET['id'];

        $binh_luan = $this->modelBinhluan->getDetailData($id);

        $sp = $this->modelBinhluan->getProduct();

        $us = $this->modelBinhluan->getUser();

        require_once './views/binhluan/chitiet.php';
    }
    public function edit()
    {
        // lay id
        $id = $_GET['id'];
        // lay thong tin chi tiet cua danh muc
        $binh_luan = $this->modelBinhluan->getDetailData($id);

        $sp = $this->modelBinhluan->getProduct();

        $us = $this->modelBinhluan->getUser();

        // do du lieu ra form
        require_once './views/binhluan/edit.php';
    }

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $id = $_GET['id'];
            // $san_pham_id = $_POST['san_pham_id'];
            // $nguoi_dung_id = $_POST['nguoi_dung_id'];
            // $noi_dung = $_POST['noi_dung'];
            $trang_thai = $_POST['trang_thai'];

            // Lấy dữ liệu hiện tại để dùng khi không có hình ảnh mới
            $currentData = $this->modelBinhluan->getDetailData($id);

            // Validate dữ liệu
            $errors = [];

            // Cập nhật dữ liệu nếu không có lỗi
            if (empty($errors)) {
                $this->modelBinhluan->updateData($id, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=binhluan/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=binhluan/edit&id=' . $id);
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
            $this->modelBinhluan->deleteData($id);
            header('Location: ?act=binhluan/list');
            exit();
        }
    }

}