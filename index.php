<?php
session_start();
require_once './commons/env.php';
require_once './commons/function.php';
// controller
require_once './controllers/HomeController.php';
require_once './controllers/KhuyenmaiController.php';

// model
require_once './models/Home.php';
require_once './models/Khuyenmai.php';

$act = $_GET['act'] ?? '/';

if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    match ($act) {
        '/' => (new HomeController())->index(),
        'home' => (new HomeController())->index(),
        'dangky' => (new HomeController())->dangky(),
        'dangnhap' => (new HomeController())->check(),
        'dangxuat' => (new HomeController())->dangxuat(),
        'login' => (new HomeController())->formDangNhap(),
        'sanpham' => (new HomeController())->sanpham(),
        'chitietsanpham' => (new HomeController())->chitietsanpham(),

        'lienhe' => (new HomeController())->lienhe(),

        'khuyenmai' => (new KhuyenmaiController())->khuyenmai(),


        default => null, // Trường hợp không khớp
    };
}



?>