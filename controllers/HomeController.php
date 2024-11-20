<?php
class HomeController
{
    public $modelHome;
    public function __construct() {
        $this->modelHome = new Home();
    }

    public function index() {
        require_once 'index.php';
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
//                window.location.href = '?act=home';
                window.location.href = '?act=index';
                </script>";
            } else {
                echo "<script>alert('Đăng nhập thành công!');
//                window.location.href = '?act=home';
                window.location.href = '?act=index';
                
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
                window.location.href = '?action=home';
                </script>";
    }

    public function dangky()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['ten'];
            $pass = $_POST['mat_khau'];
            $email = $_POST['email'];
//            $this->modelHome->dangky($name, $pass, $email);
            $_SESSION['iduser'] = $this->modelHome->dangky($name, $pass, $email);
            $_SESSION['vai_tro'] = 1; // 1 là người thường
            echo "<script>alert('Đăng ký thành công!');
                window.location.href = '?act=home';
                </script>";
        }
        require_once 'login/dky.php';
    }
    public function danhmuc() {
        $danh_mucs = $this->modelHome->getAllCategory();
        if (!$danh_mucs) {
            $danh_mucs = []; // Đặt giá trị mặc định là mảng rỗng
        }
        require_once './views/main.php';
    }
}