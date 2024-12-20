<?php 
session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/DanhmucsController.php';
require_once 'controllers/SanphamsController.php';
require_once 'controllers/TintucsController.php';
require_once 'controllers/KhuyenmaisController.php';
require_once 'controllers/LienhesController.php';
require_once 'controllers/BannersController.php';
require_once 'controllers/TrangthaidonhangsController.php';
require_once 'controllers/NguoidungsController.php';
require_once 'controllers/DonhangsController.php';
require_once 'controllers/BinhluansController.php';
require_once 'controllers/HinhanhsanphamsController.php';
require_once 'controllers/DanhgiasController.php';
// Require toàn bộ file Models
require_once 'models/Dashboard.php';
require_once 'models/Danhmuc.php';
require_once 'models/Sanpham.php';
require_once 'models/Tintuc.php';
require_once 'models/Khuyenmai.php';
require_once 'models/Lienhe.php';
require_once 'models/Banner.php';
require_once 'models/Trangthaidonhang.php';
require_once 'models/Nguoidung.php';
require_once 'models/Donhang.php';
require_once 'models/Hinhanhsanpham.php';
require_once 'models/Binhluan.php';
require_once 'models/Danhgia.php';
// Route
$act = $_GET['act'] ?? '/';
match ($act) {
    // Dashboards
    '/' => (new DashboardController())->index(),
    'danhmuc/list' => (new DanhmucsController())->index(),
    'danhmuc/create' => (new DanhmucsController())->create(),
    'danhmuc/store' => (new DanhmucsController())->store(),
    'danhmuc/edit' => (new DanhmucsController())->edit(),
    'danhmuc/update' => (new DanhmucsController())->update(),
    'danhmuc/delete' => (new DanhmucsController())->delete(),
    'danhmuc/chitiet' => (new DanhmucsController())->chitiet(),

    // San pham
    'sanpham/list' => (new SanphamsController())->index(),
    'sanpham/create' => (new SanphamsController())->create(),
    'sanpham/store' => (new SanphamsController())->store(),
    'sanpham/edit' => (new SanphamsController())->edit(),
    'sanpham/update' => (new SanphamsController())->update(),
    'sanpham/delete' => (new SanphamsController())->delete(),
    'sanpham/chitiet' => (new SanphamsController())->chitiet(),

    // Khuyen mai
    'khuyenmai/list' => (new KhuyenmaisController())->index(),
    'khuyenmai/create' => (new KhuyenmaisController())->create(),
    'khuyenmai/store' => (new KhuyenmaisController())->store(),
    'khuyenmai/edit' => (new KhuyenmaisController())->edit(),
    'khuyenmai/update' => (new KhuyenmaisController())->update(),
    'khuyenmai/delete' => (new KhuyenmaisController())->delete(),
    'khuyenmai/chitiet' => (new KhuyenmaisController())->chitiet(),

    // Nguoi dung
    'nguoidung/list' => (new NguoidungsController())->index(),
    'nguoidung/edit' => (new NguoidungsController())->edit(),
    'nguoidung/update' => (new NguoidungsController())->update(),
    'nguoidung/delete' => (new NguoidungsController())->delete(),
    'nguoidung/chitiet' => (new NguoidungsController())->chitiet(),

    // Tin tuc
    'tintuc/list' => (new TintucsController())->index(),
    'tintuc/create' => (new TintucsController())->create(),
    'tintuc/store' => (new TintucsController())->store(),
    'tintuc/edit' => (new TintucsController())->edit(),
    'tintuc/update' => (new TintucsController())->update(),
    'tintuc/delete' => (new TintucsController())->delete(),
    'tintuc/chitiet' => (new TintucsController())->chitiet(),

    // Lien he
    'lienhe/list' => (new LienhesController())->index(),
    'lienhe/store' => (new LienhesController())->store(),
    'lienhe/create' => (new LienhesController())->create(),
    'lienhe/edit' => (new LienhesController())->edit(),
    'lienhe/update' => (new LienhesController())->update(),
    'lienhe/delete' => (new LienhesController())->delete(),
    'lienhe/chitiet' => (new LienhesController())->chitiet(),

    // Banner
    'banner/list' => (new BannersController())->index(),
    'banner/store' => (new BannersController())->store(),
    'banner/create' => (new BannersController())->create(),
    'banner/edit' => (new BannersController())->edit(),
    'banner/update' => (new BannersController())->update(),
    'banner/delete' => (new BannersController())->delete(),

    // Binh luan
    'binhluan/list' => (new BinhluansController())->index(),
    'binhluan/store' => (new BinhluansController())->store(),
    'binhluan/edit' => (new BinhluansController())->edit(),
    'binhluan/update' => (new BinhluansController())->update(),
    'binhluan/delete' => (new BinhluansController())->delete(),
    'binhluan/chitiet' => (new BinhluansController())->chitiet(),

    // Trang thai don hang
    'trangthaidonhang/list' => (new TrangthaidonhangsController())->index(),
    'trangthaidonhang/create' => (new TrangthaidonhangsController())->create(),
    'trangthaidonhang/store' => (new TrangthaidonhangsController())->store(),
    'trangthaidonhang/edit' => (new TrangthaidonhangsController())->edit(),
    'trangthaidonhang/update' => (new TrangthaidonhangsController())->update(),
    'trangthaidonhang/delete' => (new TrangthaidonhangsController())->delete(),

    // Don hang
    'donhang/list' => (new DonhangsController())->index(),
    'donhang/edit' => (new DonhangsController())->edit(),
    'donhang/update' => (new DonhangsController())->update(),
    'donhang/delete' => (new DonhangsController())->delete(),
    'donhang/chitiet' => (new DonhangsController())->chitiet(),

    'hinhanhsanpham/list' => (new HinhanhsanphamsController())->index(),
    'hinhanhsanpham/edit' => (new HinhanhsanphamsController())->edit(),
    'hinhanhsanpham/update' => (new HinhanhsanphamsController())->update(),

    // Danh gia
    'danhgia/list' => (new DanhgiasController())->index(),
    'danhgia/store' => (new DanhgiasController())->store(),
    'danhgia/edit' => (new DanhgiasController())->edit(),
    'danhgia/update' => (new DanhgiasController())->update(),
    'danhgia/delete' => (new DanhgiasController())->delete(),
};