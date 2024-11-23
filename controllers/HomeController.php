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
                header("Location: ?act=home");
                exit();
//                echo "<script>alert('Đăng nhập thành công!');
//                </script>";
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
        header("Location: ?act=home");
        exit();
//        echo "<script>alert('Đăng xuất thành công!');
//                window.location.href = '?act=home';
//                </script>";
    }

    public function dangky()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['ten']);
            $pass = trim($_POST['mat_khau']);
            $email = trim($_POST['email']);

            // Validate tên đăng nhập
            if (empty($name)) {
                header("Location: ?act=dangky");
                exit();
//                echo "<script>alert('Tên đăng nhập không được để trống.');
//                window.location.href = '?act=dangky';
//                </script>";
//                return;
            }
            if (strlen($name) < 3 || strlen($name) > 20) {
                header("Location: ?act=dangky");
                exit();
//                echo "<script>alert('Tên đăng nhập phải có độ dài từ 3 đến 20 ký tự.');
//                window.location.href = '?act=dangky';
//                </script>";
//                return;
            }
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
                header("Location: ?act=dangky");
                exit();
//                echo "<script>alert('Tên đăng nhập chỉ được chứa chữ cái, số và dấu gạch dưới.');
//                window.location.href = '?act=dangky';
//                </script>";
//                return;
            }

            // Validate mật khẩu
            if (empty($pass)) {
                header("Location: ?act=dangky");
                exit();
//                echo "<script>alert('Mật khẩu không được để trống.');
//                window.location.href = '?act=dangky';
//                </script>";
//                return;
            }
            if (strlen($pass) < 6 || strlen($pass) > 50) {
                header("Location: ?act=dangky");
                exit();
//                echo "<script>alert('Mật khẩu phải có độ dài từ 6 đến 50 ký tự.');
//                window.location.href = '?act=dangky';
//                </script>";
//                return;
            }
            if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/', $pass)) {
                header("Location: ?act=dangky");
                exit();
//                echo "<script>alert('Mật khẩu phải bao gồm ít nhất 1 chữ hoa, 1 chữ thường và 1 số.');
//                window.location.href = '?act=dangky';
//                </script>";
//                return;
            }

            // Kiểm tra email đã tồn tại
            if ($this->modelHome->checkEmailExists($email)) {
                header("Location: ?act=dangky");
                exit();
//                echo "<script>alert('Email đã được sử dụng, vui lòng chọn email khác.');
//                window.location.href = '?act=dangky';
//                </script>";
//                return;
            }

            // Thêm người dùng mới
            $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
            $_SESSION['iduser'] = $this->modelHome->dangky($name, $hashed_pass, $email);
            $_SESSION['vai_tro'] = 1; // 1 là người thường
            header("Location: ?act=home");
            exit();
//            echo "<script>alert('Đăng ký thành công!');
//            window.location.href = '?act=home';
//            </script>";
        }
        require_once 'login/dky.php';
    }





    public function sanpham()
    {
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
        require_once './sanpham.php';
    }
    public function top8()
    {
        $top8 = $this->modelHome->getTop8Products();
        require_once './views/main.php';
    }
    public function chitietsanpham()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = intval($_GET['id']);
            $chi_tiet = $this->modelHome->getDetailData($id);
        } else {
            echo "ID sản phẩm không hợp lệ hoặc không được cung cấp.";
            $chi_tiet = false;
        }
            require_once './chitietsanpham.php';
    }
    public function lienhe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $ho_ten = $_POST['ho_ten'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $noi_dung = $_POST['noi_dung'];
            $this->modelHome->lienhe($email, $ho_ten, $so_dien_thoai,$noi_dung);
            echo "<script>alert('Gửi thành công!');
                window.location.href = '?act=lienhe';
                </script>";
        }
        require_once 'lienhe.php';
    }

}