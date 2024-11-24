<?php

class NguoidungController
{
    public $modelNguoidung;
    public function __construct()
    {
        $this->modelNguoidung = new Nguoidung();
    }

    public function edit()
    {
        // Khởi động session nếu chưa có
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra nếu session đã lưu 'iduser'
        if (isset($_SESSION['iduser'])) {
            $id = $_SESSION['iduser'];

            // Lấy thông tin người dùng từ model bằng id lấy từ session
            $nguoi_dung = $this->modelNguoidung->getDetail($id);

            if ($nguoi_dung) {
                // Yêu cầu hiển thị thông tin người dùng
                require_once 'thongtinnguoidung.php';
            } else {
                // Xử lý khi không tìm thấy thông tin người dùng
                echo 'Không tìm thấy thông tin người dùng.';
            }
        } else {
            // Nếu không có session 'iduser', chuyển hướng về trang login
            header('Location: dn.php');
            exit();
        }
    }
    public function showEditForm()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['iduser'])) {
            $id = $_SESSION['iduser'];
            $nguoi_dung = $this->modelNguoidung->getUserById($id);
//            var_dump($nguoi_dung);
//            die();
            include './thongtinnguoidung.php';
        } else {
            header('Location: dn.php'); // Chuyển hướng nếu chưa đăng nhập
            exit();
        }
    }

    // Phương thức cập nhật thông tin người dùng
    public function update()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['iduser']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['iduser'];

            // Lấy dữ liệu từ form và thực hiện validation
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $mat_khau = $_POST['mat_khau'];
            $dia_chi = htmlspecialchars(trim($_POST['dia_chi']));
            $so_dien_thoai = preg_replace('/[^0-9]/', '', $_POST['so_dien_thoai']);
            $gioi_tinh = in_array($_POST['gioi_tinh'], ['Nam', 'Nữ', 'Khác']) ? $_POST['gioi_tinh'] : null;


            // Xử lý ngày sinh
            $day = $_POST['day'] ?? null;
            $month = $_POST['month'] ?? null;
            $year = $_POST['year'] ?? null;
            $ngay_sinh = ($day && $month && $year) ? "$year-$month-$day" : null;

            // Kiểm tra dữ liệu hợp lệ
            if ($email && $mat_khau && $dia_chi && $so_dien_thoai && $gioi_tinh && $ngay_sinh) {
                // Mã hóa mật khẩu trước khi lưu
                $hashed_password = password_hash($mat_khau, PASSWORD_BCRYPT);

                // Cập nhật dữ liệu
                $success = $this->modelNguoidung->updateUser($id, $email, $hashed_password, $dia_chi, $so_dien_thoai, $gioi_tinh, $ngay_sinh);

                if ($success) {
                    header('Location: ?act=thongtinnguoidung&id=' . $id);
                } else {
                    echo "Cập nhật thất bại. Vui lòng thử lại.";
                }
            } else {
                echo "Dữ liệu không hợp lệ. Vui lòng kiểm tra lại.";
            }
        } else {
            header('Location: dn.php'); // Chuyển hướng nếu chưa đăng nhập hoặc không phải POST
            exit();
        }
    }


}