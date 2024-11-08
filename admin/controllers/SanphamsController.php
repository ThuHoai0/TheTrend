<?php

class SanphamsController
{
    public $modelSanpham;
    public function __construct() {
        $this->modelSanpham = new Sanpham();
    }

    public function index() {
        $san_phams = $this->modelSanpham->getAll();
         //var_dump($san_phams);
        require_once './views/sanpham/list.php';
    }

    public function create(){
        require_once './views/sanpham/create.php';
    }

    // ham xu ly them vao CSDL
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Vietnam
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // lay ra du lieu
            $ten_san_pham = $_POST['ten_san_pham'];
            $mo_ta = $_POST['mo_ta'];
            $gia = $_POST['gia'];
            $hinh_anh = $_POST['hinh_anh'];
            $gia_nhap = $_POST['gia_nhap'];
            $so_luong = $_POST['so_luong'];
            $danh_muc_id = $_POST['danh_muc_id'];
            $trang_thai = $_POST['trang_thai'];
            $ngay_tao = isset($_POST['ngay_tao']) ? $_POST['ngay_tao'] : date('Y-m-d H:i:s'); // Use current date & time in Vietnam

            // validate
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_danh_muc'] = "Tên danh mục là bắt buộc";
            }
            if (empty($trang_thai) && $trang_thai != 0) {
                $errors['trang_thai'] = "Trạng thái tạo là bắt buộc";
            }

            // them du lieu
            if (empty($errors)) {
                $this->modelSanpham->postData($ten_san_pham, $mo_ta, $gia, $hinh_anh, $gia_nhap, $so_luong, $danh_muc_id, $trang_thai, $ngay_tao);
                unset($_SESSION['errors']);
                header('Location: ?act=sanpham/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=sanpham/create');
                exit();
            }
        }
    }

    public function edit()
    {
        // lay id
        $id = $_GET['id'];
        // lay thong tin chi tiet cua danh muc
        $san_pham = $this->modelSanpham->getDetailData($id);

        // do du lieu ra form
        require_once './views/sanpham/edit.php';
    }

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay ra du lieu
            $id = $_GET['id'];
            $ten_san_pham = $_POST['ten_san_pham'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];
            $hinh_anh = $_POST['hinh_anh'];
            $so_luong = $_POST['so_luong'];
            $gia = $_POST['gia'];
            $danh_muc_id = $_POST['danh_muc_id'];
            $gia_nhap = $_POST['gia_nhap'];

            // die($category_status  );
            // validate
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_danh_muc'] = "Tên danh mục là bắt buộc";
            }

            // Cap nhat du lieu
            if (empty($errors)) {
                // Neu khong co loi thi them du lieu
                // Them vao CSDL
                $this->modelSanpham->updateData($id, $ten_san_pham, $mo_ta, $hinh_anh, $trang_thai, $so_luong, $gia, $gia_nhap, $danh_muc_id);
                unset($_SESSION['errors']);
                header('Location: ?act=sanpham/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=sanpham/edit&id=' . $id);
                exit();
            }
        } else {

        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelSanpham->deleteData($id);
            header('Location: ?act=sanpham/list');
            exit();
        }
    }

}