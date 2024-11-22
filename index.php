<?php
session_start();
require_once './commons/env.php';
require_once './commons/function.php';
// controller
require_once './controllers/HomeController.php';


require_once 'controllers/TinTucController.php';
$controller = new TinTucController($db);

$controller = new TinTucController($db);

if ($_GET['act'] === 'danh_sach_tin_tuc') {
    $controller->showDanhSachTinTuc();
} else {
    $controller->showDanhSachTinTuc(); // Mặc định hiển thị danh sách tin tức
}


// model
require_once './models/Home.php';
require_once './models/LienHe.php';

$act = $_GET['act'] ?? '/';

if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    match ($act) {
//        '/' => (new HomeController())->index(),
        'home' => (new HomeController())->index(),
        'dangky' => (new HomeController())->dangky(),
        'dangnhap' => (new HomeController())->check(),
        'dangxuat' => (new HomeController())->dangxuat(),
        'login' => (new HomeController())->formDangNhap(),


        'views/tin_tuc_danh_sach.php' => (new TinTucController())->showDanhSachTinTuc(),
        'views/tin_tuc_chi_tiet.php' => (new TinTucController())->showChiTietTinTuc($id),

        'sanpham' => (new HomeController()) -> sanpham(),
        'yeuthich' => (new HomeController()) -> top8(),
        'chitietsanpham' => (new HomeController()) -> chitietsanpham(),
        'lienhe' => (new HomeController()) -> lienhe(),


        default => null, // Trường hợp không khớp

    };
}



?>