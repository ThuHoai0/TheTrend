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
        header("Location: ?act=home");
        exit();
        echo "<script>alert('Đăng xuất thành công!');
                </script>";
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
                echo "<script>alert('Tên đăng nhập không được để trống.');
                </script>";
            }
            if (strlen($name) < 3 || strlen($name) > 20) {
                header("Location: ?act=dangky");
                exit();
                echo "<script>alert('Tên đăng nhập phải có độ dài từ 3 đến 20 ký tự.');
                </script>";
            }
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
                header("Location: ?act=dangky");
                exit();
                echo "<script>alert('Tên đăng nhập chỉ được chứa chữ cái, số và dấu gạch dưới.');
                </script>";
            }

            // Validate mật khẩu
            if (empty($pass)) {
                header("Location: ?act=dangky");
                exit();
                echo "<script>alert('Mật khẩu không được để trống.');
                </script>";
            }
            if (strlen($pass) < 6 || strlen($pass) > 50) {
                header("Location: ?act=dangky");
                exit();
                echo "<script>alert('Mật khẩu phải có độ dài từ 6 đến 50 ký tự.');
                </script>";
            }
            if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/', $pass)) {
                header("Location: ?act=dangky");
                exit();
                echo "<script>alert('Mật khẩu phải bao gồm ít nhất 1 chữ hoa, 1 chữ thường và 1 số.');
                </script>";
            }
            if ($this->modelHome->checkEmailExists($email)) {
                header("Location: ?act=dangky");
                exit();
                echo "<script>alert('Email đã được sử dụng, vui lòng chọn email khác.');
                </script>";
            }
            $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
            $_SESSION['iduser'] = $this->modelHome->dangky($name, $hashed_pass, $email);
            $_SESSION['vai_tro'] = 1; // 1 là người thường
            header("Location: ?act=home");
            exit();
            echo "<script>alert('Đăng ký thành công!');
            </script>";
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

            // Lấy chi tiết sản phẩm
            $chi_tiet = $this->modelHome->getDetailData($id);

            if ($chi_tiet) {
                // Lấy ID danh mục của sản phẩm hiện tại
                $categoryId = $chi_tiet['danh_muc_id'];

                // Lấy danh sách sản phẩm liên quan
                $san_pham_lien_quan = $this->modelHome->getRelatedProducts($categoryId, $id);

                // Lấy top 2 hình ảnh của sản phẩm
                $hinh_anh_top2 = $this->modelHome->getTopProductImages($id);

                // Lưu ảnh gốc từ sản phẩm chi tiết
                $hinh_anh_goc = $chi_tiet['hinh_anh'];
            } else {
                echo "Không tìm thấy thông tin sản phẩm.";
                $chi_tiet = false;
                $san_pham_lien_quan = [];
                $hinh_anh_top2 = [];
                $hinh_anh_goc = 'default.jpg'; // Ảnh mặc định nếu không tìm thấy
            }
        } else {
            echo "ID sản phẩm không hợp lệ hoặc không được cung cấp.";
            $chi_tiet = false;
            $san_pham_lien_quan = [];
            $hinh_anh_top2 = [];
            $hinh_anh_goc = 'default.jpg'; // Ảnh mặc định nếu không có sản phẩm
        }

        // Gọi giao diện hiển thị
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