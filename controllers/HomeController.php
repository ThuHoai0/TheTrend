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
            $nguoiDungId = $_SESSION['iduser'] ?? null;

            // Lấy chi tiết sản phẩm
            $chi_tiet = $this->modelHome->getDetailData($id);

            if ($chi_tiet) {
                $categoryId = $chi_tiet['danh_muc_id'];
                $san_pham_lien_quan = $this->modelHome->getRelatedProducts($categoryId, $id);
                $hinh_anh_top2 = $this->modelHome->getTopProductImages($id);
                $hinh_anh_goc = $chi_tiet['hinh_anh'];

                // Lấy danh sách đánh giá
                $danh_gias = $this->modelHome->getDanhgiaBySanPhamId($id);

                // Kiểm tra người dùng đã mua hàng chưa
                $hasPurchased = false;
                if ($nguoiDungId) {
                    $hasPurchased = $this->modelHome->hasPurchased($id, $nguoiDungId);
                }
            } else {
                echo "Không tìm thấy thông tin sản phẩm.";
                $chi_tiet = false;
                $san_pham_lien_quan = [];
                $hinh_anh_top2 = [];
                $hinh_anh_goc = 'default.jpg';
                $danh_gias = [];
                $hasPurchased = false;
            }
        } else {
            echo "ID sản phẩm không hợp lệ hoặc không được cung cấp.";
            $chi_tiet = false;
            $san_pham_lien_quan = [];
            $hinh_anh_top2 = [];
            $hinh_anh_goc = 'default.jpg';
            $danh_gias = [];
            $hasPurchased = false;
        }

        require_once './chitietsanpham.php';
    }

    public function danhgia()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            // Thiết lập múi giờ
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // Lấy dữ liệu từ form và URL
            $sanPhamId = intval($_GET['id']); // ID sản phẩm
            $nguoiDungId = $_SESSION['iduser'] ?? null; // Lấy ID người dùng từ session (nếu đăng nhập)
            $soSao = $_POST['rating'] ?? null; // Số sao được chọn từ form
            $noiDung = $_POST['noi_dung'] ?? ''; // Nội dung đánh giá
            $ngayDanhGia = date('Y-m-d H:i:s'); // Ngày hiện tại
            $trangThai = 1; // Trạng thái hiển thị mặc định

            // Kiểm tra nếu người dùng đã đánh giá sản phẩm này
            if ($this->modelHome->checkExistingReview($sanPhamId, $nguoiDungId)) {
                $_SESSION['errors'] = ['Bạn chỉ được đánh giá sản phẩm này một lần.'];
                header('Location: ?act=chitietsanpham&id=' . $sanPhamId);
                exit();
            }

            // Kiểm tra lỗi
            $errors = [];
            if (empty($soSao) || !is_numeric($soSao) || $soSao < 1 || $soSao > 5) {
                $errors['rating'] = "Bạn phải chọn số sao hợp lệ (1 đến 5).";
            }
            if (empty($noiDung)) {
                $errors['noi_dung'] = "Nội dung đánh giá không được để trống.";
            }

            // Nếu có lỗi, lưu lỗi vào session và điều hướng quay lại
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=chitietsanpham&id=' . $sanPhamId);
                exit();
            }

            // Thêm đánh giá vào database
            $this->modelHome->addDanhgia($sanPhamId, $nguoiDungId, $soSao, $noiDung, $ngayDanhGia, $trangThai);

            // Lưu thông báo thành công
            $_SESSION['success'] = "Đánh giá của bạn đã được thêm thành công!";
            header('Location: ?act=chitietsanpham&id=' . $sanPhamId);
            exit();
        } else {
            // Điều hướng nếu không phải POST hoặc không có ID sản phẩm
            header('Location: ?act=home');
            exit();
        }
    }


    public function binhluan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['iduser'])) {
            // Lấy dữ liệu từ session
            $nguoiDungId = $_SESSION['iduser']; // ID người dùng từ session

            // Lấy dữ liệu từ form và URL
            $sanPhamId = $_GET['id'] ?? 0; // ID sản phẩm được truyền qua URL
            $noiDung = $_POST['noi_dung'] ?? ''; // Nội dung bình luận từ form

            // Kiểm tra dữ liệu
            $errors = [];
            if (empty($noiDung)) {
                $errors[] = "Nội dung bình luận không được để trống.";
            }
            if (empty($sanPhamId) || !is_numeric($sanPhamId)) {
                $errors[] = "ID sản phẩm không hợp lệ.";
            }

            // Nếu có lỗi, lưu lỗi vào session và điều hướng quay lại
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=chitietsanpham&id=' . $sanPhamId);
                exit();
            }
            // Thêm bình luận vào database
            $ngayBinhLuan = date('Y-m-d H:i:s');
            $trangThai = 1; // Trạng thái hiển thị mặc định

            $this->modelHome->addReview($sanPhamId, $nguoiDungId, $noiDung, $ngayBinhLuan, $trangThai);

            // Điều hướng sau khi thêm bình luận thành công
            $_SESSION['success'] = "Bình luận của bạn đã được thêm thành công!";

            header('Location: ?act=chitietsanpham&id=' . $sanPhamId);
            exit();
        } else {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: ?act=dangnhap');
            exit();
        }
    }


}