<?php

class DanhgiasController
{
    public $modelDanhgia;
    public function __construct() {
        $this->modelDanhgia = new Danhgia();
    }

    public function index() {
        $san_phams = $this->modelDanhgia->getAll();
        require_once './views/danhgia/list.php';
    }


    // ham xu ly them vao CSDL
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Vietnam
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // lay ra du lieu
            $san_pham_id = $_POST['san_pham_id'];
            $nguoi_dung_id = $_POST['nguoi_dung_id'];
            $so_sao = $_POST['so_sao'];
            $noi_dung = $_POST['noi_dung'];
            $trang_thai = $_POST['trang_thai'];
            $ngay_danh_gia = isset($_POST['ngay_danh_gia']) ? $_POST['ngay_danh_gia'] : date('Y-m-d H:i:s'); 


            // validate
            $errors = [];
            if (empty($san_pham_id)) {
                $errors['san_pham_id'] = "ID sản phẩm là bắt buộc";
            }
            if (empty($nguoi_dung_id)) {
                $errors['nguoi_dung_id'] = "ID người dùng là bắt buộc";
            }
            if (empty($so_sao)) {
                $errors['so_sao'] = "Xin vui lòng nhập số sao";
            }
            if (empty($noi_dung)) {
                $errors['noi_dung'] = "Xin vui lòng nhập nội dung";
            }

            // them du lieu
            if (empty($errors)) {
                $this->modelDanhgia->postData($san_pham_id, $nguoi_dung_id, $so_sao, $noi_dung,$trang_thai, $ngay_danh_gia);
                unset($_SESSION['errors']);
                header('Location: ?act=danhgia/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=danhgia/create');
                exit();
            }
        }
    }

    public function edit()
    {
        // lay id
        $id = $_GET['id'];
        // lay thong tin chi tiet cua danh muc
        $danh_gia = $this->modelDanhgia->getDetailData($id);

        // do du lieu ra form
        require_once './views/danhgia/edit.php';
    }

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $id = $_GET['id'];
            $san_pham_id = $_POST['san_pham_id'];
            $nguoi_dung_id = $_POST['nguoi_dung_id'];
            $so_sao = $_POST['so_sao'];
            $noi_dung = $_POST['noi_dung'];
            $trang_thai = $_POST['trang_thai'];
            $ngay_danh_gia = $_POST['ngay_danh_gia'];




            // validate
            $errors = [];
            if (empty($san_pham_id)) {
                $errors['san_phan_id'] = "ID sản phẩm là bắt buộc";
            }
            if (empty($nguoi_dung_id)) {
                $errors['nguoi_dung_id'] = "ID người dùng  là bắt buộc";
            }
            if (empty($so_sao)) {
                $errors['so_sao'] = "Xin vui lòng nhập số sao";
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = "Số lượng là bắt buộc";
            } elseif (!is_numeric($so_luong) || $so_luong < 0) {
                $errors['so_luong'] = "Số lượng phải là số không âm";
            }

            // Cập nhật dữ liệu nếu không có lỗi
            if (empty($errors)) {
                $this->modelDanhgia->updateData($id,$san_pham_id, $nguoi_dung_id, $so_sao, $noi_dung,$trang_thai, $ngay_danh_gia);
                unset($_SESSION['errors']);
                header('Location: ?act=danhgia/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=danhgia/edit&id=' . $id);
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
            $this->modelDanhgia->deleteData($id);
            header('Location: ?act=danhgia/list');
            exit();
        }
    }

}