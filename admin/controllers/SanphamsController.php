<?php

class SanphamsController
{
    public $modelSanpham;
    public $modelAnhphu;
    public function __construct() {
        $this->modelSanpham = new Sanpham();
        $this->modelAnhphu = new Hinhanhsanpham();
        $this->modelBinhluan = new Binhluan();
        $this->modelDanhgia = new Danhgia();
    }
    public function index()
    {
        $san_phams = null;
        if (isset($_GET['search'])) {
            $san_phams = $this->modelSanpham->getBySearch($_GET['search']);
        } else {
            $san_phams = $this->modelSanpham->getAll();
        }
        require_once './views/sanpham/list.php';
    }
    public function create(){
        $sp = $this->modelSanpham->getCategory();
        require_once './views/sanpham/create.php';
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ten_san_pham = $_POST['ten_san_pham'];
            $mo_ta = $_POST['mo_ta'];
            $gia = $_POST['gia'];
            $hinh_anh = $_FILES['hinh_anh'];
            $gia_nhap = $_POST['gia_nhap'];
            $so_luong = $_POST['so_luong'];
            $danh_muc_id = $_POST['danh_muc_id'];
            $trang_thai = $_POST['trang_thai'];
            $ngay_tao = isset($_POST['ngay_tao']) ? $_POST['ngay_tao'] : date('Y-m-d H:i:s');
            $load_hinh_anh = uploadFile($hinh_anh);
            $img= $_FILES['anh'];
            $anh= upload($img);
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = "Tên sản phẩm là bắt buộc";
            }
            if (empty($gia)) {
                $errors['gia'] = "Giá sản phẩm là bắt buộc";
            } elseif (!is_numeric($gia) || $gia <= 0) {
                $errors['gia'] = "Giá sản phẩm phải là số dương";
            }
            if (empty($gia_nhap)) {
                $errors['gia_nhap'] = "Giá nhập là bắt buộc";
            } elseif (!is_numeric($gia_nhap) || $gia_nhap <= 0) {
                $errors['gia_nhap'] = "Giá nhập phải là số dương";
            }
            if (isset($gia) && isset($gia_nhap) && $gia < $gia_nhap) {
                $errors['gia_vs_gia_nhap'] = "Giá bán phải lớn hơn giá nhập";
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = "Số lượng là bắt buộc";
            } elseif (!is_numeric($so_luong) || $so_luong < 0) {
                $errors['so_luong'] = "Số lượng phải là số không âm";
            }
            if (empty($errors)) {
                $this->modelSanpham->postData($ten_san_pham, $mo_ta, $gia, $load_hinh_anh, $gia_nhap, $so_luong, $danh_muc_id, $trang_thai, $ngay_tao,$anh);
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

    public function chitiet(){
        $id = $_GET['id'];
        $danh_gia = $this->modelDanhgia->getDetailData($id);
        $binh_luan = $this->modelBinhluan->getDetailData($id);
        $san_phams = $this->modelSanpham->getAll();
        $san_pham = $this->modelSanpham->getDetailData($id);
        $sp = $this->modelSanpham->getCategory();
        require_once './views/sanpham/chitiet.php';
    }
    public function edit()
    {
        $id = $_GET['id'];
        $san_pham = $this->modelSanpham->getDetailData($id);
        $sp = $this->modelSanpham->getCategory();
        require_once './views/sanpham/edit.php';
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $ten_san_pham = $_POST['ten_san_pham'];
            $mo_ta = $_POST['mo_ta'];
            $gia = $_POST['gia'];
            $gia_nhap = $_POST['gia_nhap'];
            $so_luong = $_POST['so_luong'];
            $danh_muc_id = $_POST['danh_muc_id'];
            $trang_thai = $_POST['trang_thai'];
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = "Tên sản phẩm là bắt buộc";
            }
            if (empty($gia)) {
                $errors['gia'] = "Giá sản phẩm là bắt buộc";
            } elseif (!is_numeric($gia) || $gia <= 0) {
                $errors['gia'] = "Giá sản phẩm phải là số dương";
            }
            if (empty($gia_nhap)) {
                $errors['gia_nhap'] = "Giá nhập là bắt buộc";
            } elseif (!is_numeric($gia_nhap) || $gia_nhap <= 0) {
                $errors['gia_nhap'] = "Giá nhập phải là số dương";
            }
            if (isset($gia) && isset($gia_nhap) && $gia < $gia_nhap) {
                $errors['gia_vs_gia_nhap'] = "Giá bán phải lớn hơn giá nhập";
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = "Số lượng là bắt buộc";
            } elseif (!is_numeric($so_luong) || $so_luong < 0) {
                $errors['so_luong'] = "Số lượng phải là số không âm";
            }
            if (empty($errors)) {
                $this->modelSanpham->updateData($id, $ten_san_pham, $mo_ta, $gia, $gia_nhap, $so_luong, $danh_muc_id, $trang_thai);
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
            $this->modelAnhphu->deleteData1($id);
            $this->modelSanpham->deleteData($id);
            header('Location: ?act=sanpham/list');
            exit();
        }
    }
}