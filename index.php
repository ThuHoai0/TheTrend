<?php
session_start();
require_once './commons/env.php';
require_once './commons/function.php';
// controller
require_once './controllers/HomeController.php';
require_once './controllers/GiohangController.php';
require_once './controllers/DathangController.php';
require_once './controllers/ChitietsanphamController.php';
require_once './controllers/KhuyenmaiController.php';
require_once './controllers/NguoidungController.php';
require_once './controllers/LienheController.php';
require_once './controllers/TinTucController.php';
require_once './controllers/DonhangController.php';
require_once './controllers/YeuthichController.php';
// model
require_once './models/Home.php';
require_once './models/Giohang.php';
require_once './models/Dathang.php';
require_once './models/Chitietsanpham.php';
require_once './models/Khuyenmai.php';
require_once './models/Nguoidung.php';
require_once './models/Lienhe.php';
require_once './models/TinTuc.php';
require_once './models/Donhang.php';
require_once './models/Yeuthich.php';
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
        'sanpham' => (new HomeController()) -> sanpham(),
        'spyeuthich' => (new HomeController()) -> spyeuthich(),

        'giohang' => (new GiohangController()) -> giohang(),
        'updateProductQuantity' => (new GiohangController()) -> updateProductQuantity(),
        'removeFromCart' => (new GiohangController()) -> removeFromCart(),
        'themdonhang' => (new GiohangController()) ->store(),
        'dathang' => (new DathangController()) -> dathang(),


        'chitietsanpham' => (new ChitietsanphamController()) -> chitietsanpham(),
        'danhgia' => (new ChitietsanphamController()) -> danhgia(),
        'binhluan' => (new ChitietsanphamController()) -> binhluan(),
        'handleCartAjax' => (new ChitietsanphamController()) -> handleCartAjax(),
        'xoaSP' => (new ChitietsanphamController()) -> xoaSP(),
        'updateCart' => (new ChitietsanphamController()) -> updateCart(),

        'lienhe' => (new LienheController()) -> lienhe(),

        'tintuc' => (new TintucController()) -> dstintuc(),
        'chitiettintuc' => (new TintucController()) -> chitiet(),

        'khuyenmai' => (new KhuyenmaiController())->khuyenmai(),

        'thongtinnguoidung' => (new NguoidungController())->showEditForm(),
        'luuthongtin' => (new NguoidungController())->editUser(),
        'suamatkhau' => (new NguoidungController())->edit(),
        'doimatkhau' => (new NguoidungController())->update(),

        'quenmatkhau' => (new NguoidungController())->forgotPassword(),

        'donhang' => (new DonhangController())->listOrders(),
        'ctdonhang' => (new DonhangController())->ctdonhang(),
        'huydonhang' => (new DonhangController())->huyDonHang(),
        'dalayhang' => (new DonhangController())->thayDoiTrangThaiDonHang(),

        'addyeuthich' => (new YeuthichController())->addYeuthich(),






        default => null, // Trường hợp không khớp
    };
}



?>