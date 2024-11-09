<?php 
session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/DanhmucsController.php';
<<<<<<< Updated upstream
require_once 'controllers/SanphamsController.php';
require_once 'controllers/TintucsController.php';
require_once 'controllers/KhuyenmaisController.php';
require_once 'controllers/LienhesController.php';

// Require toàn bộ file Models
require_once 'models/Danhmuc.php';
require_once 'models/Sanpham.php';
require_once 'models/Tintuc.php';
require_once 'models/Khuyenmai.php';
require_once 'models/Lienhe.php';
=======
require_once 'controllers/NguoidungsController.php';
//require_once 'controllers/ProductController.php';

// Require toàn bộ file Models
require_once 'models/Danhmuc.php';
//require_once 'models/Product.php';
require_once 'models/Nguoidung.php';
>>>>>>> Stashed changes

// Route
$act = $_GET['act'] ?? '/';
// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Dashboards
    '/' => (new DashboardController())->index(),

    // Quan ly danh muc san pham
    'danhmuc/list' => (new DanhmucsController())->index(),
    'danhmuc/create' => (new DanhmucsController())->create(),
    'danhmuc/store' => (new DanhmucsController())->store(),
    'danhmuc/edit' => (new DanhmucsController())->edit(),
    'danhmuc/update' => (new DanhmucsController())->update(),
    'danhmuc/delete' => (new DanhmucsController())->delete(),

    // Quan ly san pham
    'sanpham/list' => (new SanphamsController())->index(),
    'sanpham/create' => (new SanphamsController())->create(),
    'sanpham/store' => (new SanphamsController())->store(),
    'sanpham/edit' => (new SanphamsController())->edit(),
    'sanpham/update' => (new SanphamsController())->update(),
    'sanpham/delete' => (new SanphamsController())->delete(),

    // Khuyen mai
    'khuyenmai/list' => (new KhuyenmaisController())->index(),
    'khuyenmai/create' => (new KhuyenmaisController())->create(),
    'khuyenmai/store' => (new KhuyenmaisController())->store(),

// Quan ly người dùng
    'nguoidung/list' => (new NguoidungsController())->index(),
    'nguoidung/create' => (new NguoidungsController())->create(),
    'nguoidung/store' => (new NguoidungsController())->store(),
    'nguoidung/edit' => (new NguoidungsController())->edit(),
    'nguoidung/update' => (new NguoidungsController())->update(),
    'nguoidung/delete' => (new NguoidungsController())->delete(),


    'tintuc/list' => (new TintucsController())->index(),
    'tintuc/create' => (new TintucsController())->create(),
    'tintuc/store' => (new TintucsController())->store(),
    'tintuc/edit' => (new TintucsController())->edit(),
    'tintuc/update' => (new TintucsController())->update(),
    'tintuc/delete' => (new TintucsController())->delete(),

    //lienhe
    'lienhe/list' => (new LienhesController())->index(),
    'lienhe/store' => (new LienhesController())->store(),
    'lienhe/create' => (new LienhesController())->create(),
    'lienhe/edit' => (new LienhesController())->edit(),
    'lienhe/update' => (new LienhesController())->update(),
    'lienhe/delete' => (new LienhesController())->delete(),
};