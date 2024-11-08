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

// Require toàn bộ file Models
require_once 'models/Danhmuc.php';
require_once 'models/Sanpham.php';
require_once 'models/Tintuc.php';

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



    'tintuc/list' => (new TintucsController())->index(),
    'tintuc/create' => (new TintucsController())->create(),
    'tintuc/store' => (new TintucsController())->store(),
    'tintuc/edit' => (new TintucsController())->edit(),
    'tintuc/update' => (new TintucsController())->update(),
    'tintuc/delete' => (new TintucsController())->delete(),
};