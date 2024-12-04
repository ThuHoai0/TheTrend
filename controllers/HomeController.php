<?php
class HomeController
{
    public $modelHome;
    public function __construct() {
        $this->modelHome = new Home();
    }
    public function index()
    {
        // Thiết lập số lượng sản phẩm mỗi trang
        $limit = 16;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $ord = isset($_GET['ord']) ? (int)$_GET['ord'] : 1;

        // Tính toán offset
        $offset = ($page > 1) ? ($page - 1) * $limit : 0;

        // Lấy danh mục và sản phẩm
        $banners = $this->modelHome->getActiveBanners();
        $danh_mucs = $this->modelHome->getAllCategory();
        $san_phams = null;
        $total_products = 0;

        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $danh_muc_id = (int)$_GET['category'];
            $san_phams = $this->modelHome->getByCategory($danh_muc_id, $offset, $limit);
            $total_products = $this->modelHome->getTotalByCategory($danh_muc_id); // Tổng số sản phẩm theo danh mục
        } elseif (isset($_GET['search']) && !empty($_GET['search'])) {
            $san_phams = $this->modelHome->getBySearch($_GET['search']);
            $total_products = count($san_phams); // Tổng số sản phẩm tìm kiếm
        } else {
            $san_phams = $this->modelHome->getAllProduct($offset, $limit, $ord);
            $total_products = $this->modelHome->getTotalProducts(); // Tổng số sản phẩm
        }
        $top_products = $this->modelHome->getTopProduct();
        // Tính tổng số trang
        $total_pages = ceil($total_products / $limit);

        // Nếu trang hiện tại vượt quá tổng số trang, chuyển hướng về trang cuối
        if ($page > $total_pages) {
            header("Location: ?act=home&page=$total_pages");
            exit();
        }

        // Render giao diện
        require_once './views/main.php';
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
                echo "<script>alert('Đăng nhập thành công!');
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
        unset($_SESSION['cart']);
        header("Location: ?act=home");
        exit();
        echo "<script>alert('Đăng xuất thành công!');
                </script>";
    }

    public function dangky()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten = trim($_POST['ten']);
            $mat_khau = trim($_POST['mat_khau']);
            $email = trim($_POST['email']);

            // Validate tên đăng nhập
            if (empty($ten)) {
                echo "<script>alert('Tên đăng nhập không được để trống.'); window.location = '?act=dangky';</script>";
                exit();
            }
            if (strlen($ten) < 3 || strlen($ten) > 20) {
                echo "<script>alert('Tên đăng nhập phải có độ dài từ 3 đến 20 ký tự.'); window.location = '?act=dangky';</script>";
                exit();
            }
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $ten)) {
                echo "<script>alert('Tên đăng nhập chỉ được chứa chữ cái, số và dấu gạch dưới.'); window.location = '?act=dangky';</script>";
                exit();
            }

            // Validate mật khẩu
            if (empty($mat_khau)) {
                echo "<script>alert('Mật khẩu không được để trống.'); window.location = '?act=dangky';</script>";
                exit();
            }
            if (strlen($mat_khau) < 6 || strlen($mat_khau) > 50) {
                echo "<script>alert('Mật khẩu phải có độ dài từ 6 đến 50 ký tự.'); window.location = '?act=dangky';</script>";
                exit();
            }
            if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/', $mat_khau)) {
                echo "<script>alert('Mật khẩu phải bao gồm ít nhất 1 chữ hoa, 1 chữ thường và 1 số.'); window.location = '?act=dangky';</script>";
                exit();
            }
            if ($this->modelHome->checkEmailExists($email)) {
                echo "<script>alert('Email đã được sử dụng, vui lòng chọn email khác.'); window.location = '?act=dangky';</script>";
                exit();
            }

            // $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
            $_SESSION['iduser'] = $this->modelHome->dangky($ten, $mat_khau, $email);
            $_SESSION['vai_tro'] = 1; // 1 là người thường

            echo "<script>alert('Đăng ký thành công!'); window.location = '?act=home';</script>";
            exit();
        }
        require_once 'login/dky.php';
    }


    public function sanpham()
    {
        $offset = 16;
        $limit = 16;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $ord = isset($_GET['ord']) ? (int)$_GET['ord'] : 1;
// Tính toán offset
        $offset = ($page > 1) ? ($page - 1) * $limit : 0;

        if ($page) {
            $offset = ($page - 1) * $limit;
        }
        $danh_mucs = $this->modelHome->getAllCategory();
        $san_phams = null;


        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $danh_muc_id = (int)$_GET['category'];
            $san_phams = $this->modelHome->getByCategory($danh_muc_id, $offset, $limit);
            $total_products = $this->modelHome->getTotalByCategory($danh_muc_id); // Tổng số sản phẩm theo danh mục
        } elseif (isset($_GET['search']) && !empty($_GET['search'])) {
            $san_phams = $this->modelHome->getBySearch($_GET['search']);
            $total_products = count($san_phams); // Tổng số sản phẩm tìm kiếm
        } else {
            $san_phams = $this->modelHome->getAllProduct($offset, $limit, $ord);
            $total_products = $this->modelHome->getTotalProducts(); // Tổng số sản phẩm
        }

        // Tính tổng số trang
        $total_pages = ceil($total_products / $limit);

        // Nếu trang hiện tại vượt quá tổng số trang, chuyển hướng về trang cuối
        if ($page > $total_pages) {
            header("Location: ?act=sanpham&page=$total_pages");
            exit();
        }

        require_once './sanpham.php';
    }

    public function spyeuthich()
    {
        $san_pham_yeu_thich = $this->modelHome->listYeuThich();
        require_once './spyeuthich.php';
    }


}