<?php
 class KhuyenmaisController {
     public $modelKhuyenmai;
     public function __construct()
     {
         $this->modelKhuyenmai = new Khuyenmai();
     }
     public function index()
     {
         $khuyen_mais = null;
         if (isset($_GET['search'])) {
             $khuyen_mais = $this->modelKhuyenmai->getBySearch($_GET['search']);
         } else {
             $khuyen_mais = $this->modelKhuyenmai->getAll();
         }
         require_once './views/khuyenmai/list.php';
     }
     public function create() {
         require_once './views/khuyenmai/create.php';
     }
     public function store()
     {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             date_default_timezone_set('Asia/Ho_Chi_Minh');
             $ten_khuyen_mai = $_POST['ten_khuyen_mai'];
             $ma_khuyen_mai = $_POST['ma_khuyen_mai'];
             $mo_ta = $_POST['mo_ta'];
             $phan_tram_giam = $_POST['phan_tram_giam'];
             $ngay_bat_dau = $_POST['ngay_bat_dau'];
             $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
             $ngay_tao = isset($_POST['ngay_tao']) ? $_POST['ngay_tao'] : date('Y-m-d H:i:s'); // Use current date & time in Vietnam
             $today = new DateTime();
             if ($today < $ngay_bat_dau) {
                 $trang_thai = 1;
             } elseif ($today >= $ngay_bat_dau && $today <= $ngay_ket_thuc) {
                 $trang_thai = 2;
             } else {
                 $trang_thai = 0;
             }
             $errors = [];
             if (empty($ten_khuyen_mai)) {
                 $errors['ten_khuyen_mai'] = "Tên khuyến mại là bắt buộc";
             }
             if (empty($ma_khuyen_mai)) {
                $errors['ma_khuyen_mai'] = "Tên khuyến mại là bắt buộc";
            }
             if (empty($phan_tram_giam)) {
                 $errors['phan_tram_giam'] = "Phần trăm giảm giá là bắt buộc";
             } elseif (!is_numeric($phan_tram_giam) || $phan_tram_giam < 0 || $phan_tram_giam > 100) {
                 $errors['phan_tram_giam'] = "Phần trăm giảm giá phải là một số từ 0 đến 100";
             }
             if (empty($ngay_bat_dau)) {
                 $errors['ngay_bat_dau'] = "Ngày bắt đầu là bắt buộc";
             } elseif (!DateTime::createFromFormat('Y-m-d', $ngay_bat_dau)) {
                 $errors['ngay_bat_dau'] = "Ngày bắt đầu không hợp lệ (định dạng phải là YYYY-MM-DD)";
             }
             if (empty($ngay_ket_thuc)) {
                 $errors['ngay_ket_thuc'] = "Ngày kết thúc là bắt buộc";
             } elseif (!DateTime::createFromFormat('Y-m-d', $ngay_ket_thuc)) {
                 $errors['ngay_ket_thuc'] = "Ngày kết thúc không hợp lệ (định dạng phải là YYYY-MM-DD)";
             } else {
                 $ngay_bat_dau_dt = new DateTime($ngay_bat_dau);
                 $ngay_ket_thuc_dt = new DateTime($ngay_ket_thuc);

                 if ($ngay_ket_thuc_dt < $ngay_bat_dau_dt) {
                     $errors['ngay_ket_thuc'] = "Ngày kết thúc phải sau ngày bắt đầu";
                 }
             }
             if (empty($errors)) {
                 $this->modelKhuyenmai->postData($ten_khuyen_mai, $ma_khuyen_mai, $mo_ta, $phan_tram_giam, $ngay_bat_dau, $ngay_ket_thuc, $ngay_tao, $trang_thai);
                 unset($_SESSION['errors']);
                 header('Location: ?act=khuyenmai/list');
                 exit();
             } else {
                 $_SESSION['errors'] = $errors;
                 header('Location: ?act=khuyenmai/create');
                 exit();
             }
         }
     }
     public function chitiet()
     {
         $id = $_GET['id'];
         $khuyen_mai = $this->modelKhuyenmai->getDetailData($id);
         require_once './views/khuyenmai/chitiet.php';
     }
     public function edit()
     {
         $id = $_GET['id'];
         $khuyen_mai = $this->modelKhuyenmai->getDetailData($id);
         require_once './views/khuyenmai/edit.php';
     }
     public function update()
     {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             // lay ra du lieu
             $id = $_GET['id'];
             $ten_khuyen_mai = $_POST['ten_khuyen_mai'];
             $ma_khuyen_mai = $_POST['ma_khuyen_mai'];
             $mo_ta = $_POST['mo_ta'];
             $phan_tram_giam = $_POST['phan_tram_giam'];
             $ngay_bat_dau = $_POST['ngay_bat_dau'];
             $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
             $errors = [];
             if (empty($ten_khuyen_mai)) {
                 $errors['ten_khuyen_mai'] = "Tên khuyến mại là bắt buộc";
             }
             if (empty($phan_tram_giam)) {
                 $errors['phan_tram_giam'] = "Phần trăm giảm giá là bắt buộc";
             } elseif (!is_numeric($phan_tram_giam) || $phan_tram_giam < 0 || $phan_tram_giam > 100) {
                 $errors['phan_tram_giam'] = "Phần trăm giảm giá phải là một số từ 0 đến 100";
             }
             if (empty($ngay_bat_dau)) {
                 $errors['ngay_bat_dau'] = "Ngày bắt đầu là bắt buộc";
             }
             if (empty($ngay_ket_thuc)) {
                 $errors['ngay_ket_thuc'] = "Ngày kết thúc là bắt buộc";
             } else {
                 $ngay_bat_dau_dt = new DateTime($ngay_bat_dau);
                 $ngay_ket_thuc_dt = new DateTime($ngay_ket_thuc);
                 if ($ngay_ket_thuc_dt < $ngay_bat_dau_dt) {
                     $errors['ngay_ket_thuc'] = "Ngày kết thúc phải sau ngày bắt đầu";
                 }
             }
             if (empty($errors)) {
                 $this->modelKhuyenmai->updateData($id, $ten_khuyen_mai, $ma_khuyen_mai, $mo_ta, $phan_tram_giam, $ngay_bat_dau, $ngay_ket_thuc);
                 unset($_SESSION['errors']);
                 header('Location: ?act=khuyenmai/list');
                 exit();
             } else {
                 $_SESSION['errors'] = $errors;
                 header('Location: ?act=khuyenmai/edit&id=' . $id);
                 exit();
             }
         } else {
         }
     }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelKhuyenmai->deleteData($id);
            header('Location: ?act=khuyenmai/list');
            exit();
        }
    }
 }