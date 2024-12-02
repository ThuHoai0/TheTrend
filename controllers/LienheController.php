<?php

class LienheController
{
    public $modelLienhe;
    public function __construct()
    {
        $this->modelLienhe = new Lienhe();
    }

    public function lienhe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // var_dump(123);
            // die;
            $email = $_POST['email'];
            $ho_ten = $_POST['ho_ten'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $noi_dung = $_POST['noi_dung'];
            $this->modelLienhe->postData($email, $ho_ten, $so_dien_thoai,$noi_dung);
            echo "<script>alert('Gửi thành công!');
                window.location.href = '?act=lienhe';
                </script>";
        }
        require_once 'lienhe.php';
    }


   
   
    public function store()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ho_ten = $_POST['ho_ten'];
        $email = $_POST['email'];
        $so_dien_thoai = $_POST['so_dien_thoai'];
        $noi_dung = $_POST['noi_dung'];
        $errors = [];
        
        // Kiểm tra các trường thông tin
        if (empty($ho_ten)) {
            $errors['ho_ten'] = "Tên người liên hệ là bắt buộc";
        }
        if (empty($email)) {
            $errors['email'] = "Email là bắt buộc";
        } 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Định dạng email không hợp lệ";
        }
        if (empty($so_dien_thoai)) {
            $errors['so_dien_thoai'] = "Số điện thoại là bắt buộc";
        } elseif (!preg_match("/^[0-9]{10,11}$/", $so_dien_thoai)) {
            $errors['so_dien_thoai'] = "Số điện thoại phải là 10-11 chữ số";
        }

        // Nếu không có lỗi, lưu dữ liệu và thông báo thành công
        if (empty($errors)) {
            $this->modelLienhe->postData($ho_ten, $email, $so_dien_thoai, $noi_dung);
            unset($_SESSION['errors']);
            $_SESSION['success'] = "Gửi thông tin thành công!"; // Thêm thông báo thành công
            header('Location: ?act=lienhe'); // Chuyển hướng về trang liên hệ
            exit();
        } else {
            // Nếu có lỗi, lưu lỗi vào session
            $_SESSION['errors'] = $errors;
            header('Location: ?act=lienhe'); // Chuyển hướng về trang liên hệ
            exit();
        }
    }
}

 
   
    
}




