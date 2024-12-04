<?php

class NguoidungController
{
    public $modelNguoidung;
    public function __construct()
    {
        $this->modelNguoidung = new Nguoidung();
    }

    public function showEditForm()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['iduser'])) {
            $id = $_SESSION['iduser'];
            $nguoi_dung = $this->modelNguoidung->getUserById($id);
            include './thongtinnguoidung.php';
        } else {
            header('Location: dn.php'); // Chuyển hướng nếu chưa đăng nhập
            exit();
        }
    }

    public function editUser()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (isset($_SESSION['iduser'])) {
            $id = $_SESSION['iduser'];

            // Lấy thông tin người dùng từ database
            $nguoi_dung = $this->modelNguoidung->getUserById($id);
            if (!$nguoi_dung) {
                echo "<script>alert('Người dùng không tồn tại.');</script>";
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Lấy dữ liệu từ form
                $email = trim($_POST['email']);
                $dia_chi = trim($_POST['dia_chi']);
                $so_dien_thoai = trim($_POST['so_dien_thoai']);
                $gioi_tinh = isset($_POST['gioi_tinh']) ? intval($_POST['gioi_tinh']) : null;
                $day = isset($_POST['day']) ? intval($_POST['day']) : null;
                $month = isset($_POST['month']) ? intval($_POST['month']) : null;
                $year = isset($_POST['year']) ? intval($_POST['year']) : null;

                $ngay_sinh = sprintf('%04d-%02d-%02d', $year, $month, $day);


                // Kiểm tra dữ liệu hợp lệ
                if (empty($email) || empty($dia_chi) || empty($so_dien_thoai) || is_null($gioi_tinh) || empty($ngay_sinh)) {
                    echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
                    return;
                }

                // Gọi phương thức cập nhật trong model
                $is_updated = $this->modelNguoidung->updateUser($id, $email, $dia_chi, $so_dien_thoai, $gioi_tinh, $ngay_sinh);

                if ($is_updated) {
                    // Lấy lại dữ liệu mới để hiển thị
                    $nguoi_dung = $this->modelNguoidung->getUserById($id);
                    echo "<script>alert('Cập nhật thông tin thành công.'); window.location.href='?act=home';</script>";
                    exit();
                } else {
                    echo "<script>alert('Cập nhật thông tin không thành công. Vui lòng thử lại.');</script>";
                }
            }

            // Hiển thị dữ liệu cũ nếu chưa cập nhật thành công
            return $nguoi_dung;
        } else {
            echo "<script>alert('Bạn cần đăng nhập trước khi thực hiện thao tác này.'); window.location.href='dn.php';</script>";
            exit();
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $nguoi_dung = $this->modelNguoidung->getUserById($id);
        require_once 'suamatkhau.php';
    }

    // Phương thức cập nhật thông tin người dùng
    public function update()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (isset($_SESSION['iduser']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['iduser'];

            // Lấy dữ liệu từ form
            $mat_khau = trim($_POST['mat_khau']);
            $new_password = trim($_POST['new_password']);
            $confirm_password = trim($_POST['confirm_password']);

            // Kiểm tra dữ liệu hợp lệ
            if (empty($mat_khau) || empty($new_password) || empty($confirm_password)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
                return;
            }

            if ($new_password !== $confirm_password) {
                echo "<script>alert('Mật khẩu mới và xác nhận mật khẩu không khớp.');</script>";
                return;
            }

                if ($this->modelNguoidung->updatePass($id, $new_password))
                {
                    header('Location: ?act=home&');

            if (!$nguoi_dung) {
                echo "<script>alert('Người dùng không tồn tại.');</script>";
                return;
            }

            // Kiểm tra mật khẩu hiện tại
            if ($mat_khau !== $nguoi_dung['mat_khau']) {
                echo "<script>alert('Mật khẩu hiện tại không chính xác.');</script>";
                return;
            }

            // Kiểm tra nếu mật khẩu mới giống mật khẩu hiện tại
            if ($new_password === $nguoi_dung['mat_khau']) {
                echo "<script>alert('Mật khẩu mới không được giống mật khẩu hiện tại.');</script>";
                return;
            }

            // Không mã hóa mật khẩu mới, chỉ lưu trực tiếp vào cơ sở dữ liệu
            $update_status = $this->modelNguoidung->updatePassword($id, $new_password);

            if ($update_status) {
                echo "<script>alert('Đổi mật khẩu thành công.'); window.location.href='?act=home';</script>";
                exit();
            } else {
                echo "<script>alert('Cập nhật mật khẩu không thành công. Vui lòng thử lại.');</script>";
                return;
            }
        } else {
            echo "<script>alert('Bạn cần đăng nhập trước khi thực hiện thao tác này.'); window.location.href='dn.php';</script>";
            exit();
        }
    }
}

    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $email = $_POST['email'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // Kiểm tra nếu email và mật khẩu mới không rỗng
            if (empty($email) || empty($new_password) || empty($confirm_password)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
                return;
            }

            // Kiểm tra nếu mật khẩu mới và mật khẩu xác nhận trùng khớp
            if ($new_password !== $confirm_password) {
                echo "<script>alert('Mật khẩu mới và xác nhận mật khẩu không khớp.');</script>";
                return;
            }

            // Kiểm tra nếu email tồn tại trong cơ sở dữ liệu
            $nguoi_dung = $this->modelNguoidung->getUserByEmail($email); // Phương thức này sẽ lấy thông tin người dùng từ database theo email

            if (!$nguoi_dung) {
                echo "<script>alert('Email không tồn tại trong hệ thống.');</script>";
                return;
            }

            // Cập nhật mật khẩu mới trong cơ sở dữ liệu (không mã hóa)
            $updateStatus = $this->modelNguoidung->updatePass($nguoi_dung['id'], $new_password);

            if ($updateStatus) {
                echo "<script>alert('Mật khẩu đã được thay đổi thành công.'); window.location.href='?act=home';</script>";
                exit();
            } else {
                echo "<script>alert('Cập nhật mật khẩu không thành công. Vui lòng thử lại.');</script>";
                return;
            }
        }

        require_once 'quenmatkhau.php'; // Hiển thị form quên mật khẩu
    }


}
