<?php
class HomeController
{
    public $modelHome;
    public function __construct() {
        $this->modelHome = new Home();
    }

    public function index() {
        require_once 'views/home.php';
    }

    public function check()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten = $_POST['ten'];
            $mat_khau = $_POST['mat_khau'];
            $check = $this->modelHome->check($ten, $mat_khau);

            if (empty($check)) {
                echo "<script>alert('Sai tài khoản hoặc mật khẩu!')
                window.location.href = '?act=home';
                </script>";
            } else {
                echo "<script>alert('Đăng nhập thành công!');
                window.location.href = '?act=home';
                </script>";
                $_SESSION['iduser'] = $check['0']['id'];
                $_SESSION['user'] = $check['0']['vai_tro']; // 2 là admin
            }
        }
        require_once 'views/login/dn.php';
    }
    public function dangxuat()
    {
        unset($_SESSION['iduser']);
        unset($_SESSION['user']);
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
            $_SESSION['user'] = 1; // 1 là người thường
            echo "<script>alert('Đăng ký thành công!');
                window.location.href = '?act=home';
                </script>";
        }
        require_once 'views/login/dky.php';
    }
}