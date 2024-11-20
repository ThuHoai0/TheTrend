<?php
session_start();
require_once './commons/env.php';
require_once './commons/function.php';
// controller
require_once './controllers/HomeController.php';

// model
require_once './models/Home.php';

$act = $_GET['act'] ?? '/';

require_once "./views/header.php";
require_once "./views/main.php";
require_once "./views/footer.php";

if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    match ($act) {
//        'sanphamct' => require_once "../views/chitietsanpham.php",
        '/'                 => (new HomeController())->index(),
        'home' => (new HomeController())->index(),
        'dangky' => (new HomeController())->dangky(),
        'dangnhap' => (new HomeController())->check(),
        'dangxuat' => (new HomeController())->dangxuat(),
        'login' => (new HomeController())->formDangNhap(),
        'danhmuc' => (new HomeController())->danhmuc(),





        default => null, // Trường hợp không khớp
    };
}



?>