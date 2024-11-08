<?php
 class KhuyenmaisController {
     public $modelKhuyenmai;

     public function __construct()
     {
         $this->modelKhuyenmai = new Khuyenmai();
     }

     public function index()
     {
         // lay ra toan bo danh muc
         $khuyen_mais = $this->modelKhuyenmai->getAll();
         // var_dump($khuyen_mais);

         // dua du lieu ra view
         require_once './views/khuyenmai/list.php';
     }

     public function create() {
         require_once './views/khuyenmai/create.php';
     }

//     public function store()
//     {
//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             // Set timezone to Vietnam
//             date_default_timezone_set('Asia/Ho_Chi_Minh');
//
//             // lay ra du lieu
//             $ten_khuyen_mai = $_POST['ten_khuyen_mai'];
//             $mo_ta = $_POST['mo_ta'];
//             $phan_tram_giam = $_POST['phan_tram_giam'];
//             $ngay_bat_dau = $_POST['ngay_bat_dau'];
//             $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
//             $ngay_tao = isset($_POST['ngay_tao']) ? $_POST['ngay_tao'] : date('Y-m-d H:i:s'); // Use current date & time in Vietnam
//             $trang_thai = $_POST['trang_thai'];
//
//             // validate
//             $errors = [];
//             if (empty($ten_khuyen_mai)) {
//                 $errors['ten_khuyen_mai'] = "Tên khuyến mại là bắt buộc";
//             }
//             if (empty($phan_tram_giam)) {
//                $errors['phan_tram_giam'] = "Phần trăm giảm là bắt buộc";
//             }
//             if (empty($ngay_bat_dau)) {
//                 $errors['ngay_bat_dau'] = "Ngày bắt đầu là bắt buộc";
//             }
//             if (empty($ngay_ket_thuc)) {
//                 $errors['ngay_ket_thuc'] = "Ngày kết thúc là bắt buộc";
//             }
//              if (empty($trang_thai)) {
//                 $errors['trang_thai'] = "Trạng thái tạo là bắt buộc";
//             }
//
//             // them du lieu
//             if (empty($errors)) {
//                 // neu khong co loi thi them du lieu
//                 // them vao CSDL
//                 $this->modelKhuyenmai->postData($ten_khuyen_mai, $mo_ta, $phan_tram_giam, $ngay_bat_dau, $ngay_ket_thuc, $ngay_tao,$trang_thai);
//                 unset($_SESSION['errors']);
//                 header('Location: ?act=khuyenmai/list');
//                 exit();
//             } else {
//                 $_SESSION['errors'] = $errors;
//                 header('Location: ?act=khuyenmai/create');
//                 exit();
//             }
//         }
//     }
 }