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
//            var_dump($nguoi_dung);
//            die();
            include './thongtinnguoidung.php';
        } else {
            header('Location: dn.php'); // Chuyển hướng nếu chưa đăng nhập
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

        // Lấy thông tin người dùng từ database
        $nguoi_dung = $this->modelNguoidung->getUserById($id); // Phương thức này cần lấy thông tin user theo ID

        if (!$nguoi_dung) {
            echo "<script>alert('Người dùng không tồn tại.');</script>";
            return;
        }

        // Kiểm tra mật khẩu hiện tại
        if (!password_verify($mat_khau, $nguoi_dung['mat_khau'])) {
            echo "<script>alert('Mật khẩu hiện tại không chính xác.');</script>";
            return;
        }
        
        // Kiểm tra nếu mật khẩu mới giống mật khẩu hiện tại
        if (password_verify($new_password, $nguoi_dung['mat_khau'])) {
            echo "<script>alert('Mật khẩu mới không được giống mật khẩu hiện tại.');</script>";
            return;
        }

        // Cập nhật mật khẩu trong cơ sở dữ liệu
        // Mã hóa mật khẩu mới
        $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Cập nhật mật khẩu mới vào cơ sở dữ liệu
        $update_status = $this->modelNguoidung->updatePassword($id, $hashed_new_password);

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