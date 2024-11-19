<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/Home.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
//if (isset($_SESSION['iduser']) && isset($_SESSION['user'])) {
//    // Both sessions are set
//    echo $_SESSION['iduser'];
//    die;
//} else {
//    // One or both sessions are not set
//    echo "One or both sessions are not set.";
////    die;
//}
match ($act) {
    // Trang chủ
    '/'                 => (new HomeController())->index(),
    'home' => (new HomeController())->index(),
    'dangky' => (new HomeController())->dangky(),
    'dangnhap' => (new HomeController())->check(),
    'dangxuat' => (new HomeController())->dangxuat(),
};
