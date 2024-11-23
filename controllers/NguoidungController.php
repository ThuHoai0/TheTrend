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
    // Kiểm tra nếu session đã lưu 'user_id'
    if (isset($_SESSION['iduser'])) {
        $id = $_SESSION['iduser'];
        
        // Lấy thông tin người dùng từ model bằng id lấy từ session
        $nguoi_dung = $this->modelNguoidung->getDetailData($id);
        
        // Yêu cầu hiển thị thông tin người dùng
        require_once 'thongtinnguoidung.php';
    } else {
        // Nếu không có session 'user_id', có thể chuyển hướng về trang login
        header('Location: dn.php');
        exit();
    }
}


public function update()
{
    // Kiểm tra nếu session đã lưu 'iduser'
    if (isset($_SESSION['iduser'])) {
        // Lấy ID người dùng từ session
        $id = $_SESSION['iduser'];

        // Kiểm tra nếu form được submit bằng phương thức POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy thông tin từ form
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            $dia_chi = $_POST['dia_chi'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $ngay_sinh = $_POST['ngay_sinh'];

            // Bạn có thể thêm kiểm tra dữ liệu đầu vào (validation) ở đây nếu cần

            // Gọi phương thức cập nhật dữ liệu từ model
            $this->modelNguoidung->updateData($id, $email, $mat_khau, $dia_chi, $so_dien_thoai, $gioi_tinh, $ngay_sinh);

            // Sau khi cập nhật thành công, chuyển hướng về trang thông tin người dùng hoặc trang khác
            header('Location: ?act=thongtinnguoidung&id=' . $id);
            exit();
        } else {
            // Nếu không phải là POST, hiển thị form chỉnh sửa
            header('Location: ?act=thongtinnguoidung/edit&id=' . $id);
            exit();
        }
    } else {
        // Nếu không có session 'iduser', chuyển hướng về trang đăng nhập
        header('Location: dn.php');
        exit();
    }
}

}