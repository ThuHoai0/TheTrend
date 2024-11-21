<?php
class HomeController
{
    public $modelHome;
    public function __construct() {
        $this->modelHome = new Home();
    }
    public function index() {
        $offset = 16;
        $limit = 16;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $ord = isset($_GET['ord']) ? (int)$_GET['ord'] : 1;

        if ($page) {
            $offset = ($page - 1) * $limit;
        }
        $danh_mucs = $this->modelHome->getAllCategory();
        $san_phams = null;
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $danh_muc_id = (int)$_GET['category'];
            $san_phams = $this->modelHome->getByCategory($danh_muc_id, $offset, $limit);
        } elseif (isset($_GET['search']) && !empty($_GET['search'])) {
            $san_phams = $this->modelHome->getBySearch($_GET['search']);
        } else {
            $san_phams = $this->modelHome->getAllProduct($offset, $limit, $ord);
        }
        require_once './views/main.php';
        require_once 'sanpham.php';
    }
    public function formDangNhap() {
        require_once 'login/dn.php';
    }
    public function check()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            $check = $this->modelHome->check($ten, $mat_khau);
            if (empty($check)) {
                echo "<script>alert('Sai tài khoản hoặc mật khẩu!')
                window.location.href = '?act=dangnhap';
                </script>";
            } else {
                echo "<script>alert('Đăng nhập thành công!');
                window.location.href = '?act=home';
                </script>";
            }
        }
        require_once 'login/dn.php';
    }
    public function dangxuat()
    {
        unset($_SESSION['iduser']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['vai_tro']);
        echo "<script>alert('Đăng xuất thành công!');
                window.location.href = '?act=home';
                </script>";
    }

    public function dangky()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['ten'];
            $pass = $_POST['mat_khau'];
            $email = $_POST['email'];
            $_SESSION['iduser'] = $this->modelHome->dangky($name, $pass, $email);
            $_SESSION['vai_tro'] = 1; // 1 là người thường
            echo "<script>alert('Đăng ký thành công!');
                window.location.href = '?act=home';
                </script>";
        }
        require_once 'login/dky.php';
    }
}