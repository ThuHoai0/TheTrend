<?php 
session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/DanhmucsController.php';
require_once 'controllers/TintucsController.php';
//require_once 'controllers/ProductController.php';

// Require toàn bộ file Models
require_once 'models/Danhmuc.php';
require_once 'models/Tintuc.php';
//require_once 'models/Product.php';

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
//    'products' => (new ProductController())->index(),
//    'form_add_product' => (new ProductController())->create(),
//    'add_product' => (new ProductController())->add(),
//    'form_edit_product' => (new ProductController())->edit(),
//    'update_product' => (new ProductController())->update(),
//    'delete_product' => (new ProductController())->delete(),

    'tintuc/list' => (new TintucsController())->index(),
    'tintuc/create' => (new TintucsController())->create(),
    'tintuc/store' => (new TintucsController())->store(),
    'tintuc/edit' => (new TintucsController())->edit(),
    'tintuc/update' => (new TintucsController())->update(),
    'tintuc/delete' => (new TintucsController())->delete(),
};