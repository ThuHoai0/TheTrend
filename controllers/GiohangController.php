<?php
class GiohangController
{
    public $modelGiohang;

    public function __construct()
    {
        $this->modelGiohang = new Giohang();
    }

    public function giohang()
    {
        require_once './giohang.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Ho Chi Minh
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // Giả sử bạn đã nhận được dữ liệu từ form
            $ho_ten_nguoi_nhan = $_POST['ho_ten_nguoi_nhan'];
            $so_dien_thoai_nguoi_nhan = $_POST['so_dien_thoai_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $dia_chi_nhan_hang = $_POST['dia_chi_nhan_hang'];
            $ghi_chu = $_POST['ghi_chu'];
            $phuong_thuc_thanh_toan = $_POST['phuong_thuc_thanh_toan'];

            // Set total price from cart or session
            $total_price = $_POST['tong_tien']; // Lấy giá trị tổng tiền từ giỏ hàng hoặc session
            $order_status = '11';  // Bạn có thể thay đổi nếu cần
            $order_date = date('Y-m-d H:i:s');  // Lấy thời gian hiện tại

            // Kiểm tra và validate dữ liệu đầu vào
            $errors = [];
            if (empty($ho_ten_nguoi_nhan)) {
                $errors['ho_ten_nguoi_nhan'] = "Tên người nhận không được để trống";
            }
            if (empty($so_dien_thoai_nguoi_nhan) || !preg_match("/^[0-9]{10,11}$/", $so_dien_thoai_nguoi_nhan)) {
                $errors['so_dien_thoai_nguoi_nhan'] = "Số điện thoại không hợp lệ";
            }
            if (empty($email_nguoi_nhan) || !filter_var($email_nguoi_nhan, FILTER_VALIDATE_EMAIL)) {
                $errors['email_nguoi_nhan'] = "Email không hợp lệ";
            }
            if (empty($dia_chi_nhan_hang)) {
                $errors['dia_chi_nhan_hang'] = "Địa chỉ không được để trống";
            }

            // Determine payment status based on payment method
            $trang_thai_thanh_toan = 0; // Default payment status (can be changed)
            if ($phuong_thuc_thanh_toan == 1) {
                $trang_thai_thanh_toan = "1"; // Payment status for method 1
            } elseif ($phuong_thuc_thanh_toan == 2) {
                $trang_thai_thanh_toan = "2"; // Payment status for method 2
            }

            // Nếu không có lỗi, tiến hành lưu đơn hàng
            if (empty($errors)) {
                // Dữ liệu đơn hàng
                $order_data = [
                    'ho_ten_nguoi_nhan' => $ho_ten_nguoi_nhan,
                    'so_dien_thoai_nguoi_nhan' => $so_dien_thoai_nguoi_nhan,
                    'email_nguoi_nhan' => $email_nguoi_nhan,
                    'dia_chi_nhan_hang' => $dia_chi_nhan_hang,
                    'ghi_chu' => $ghi_chu,
                    'phuong_thuc_thanh_toan' => $phuong_thuc_thanh_toan,
                    'trang_thai_thanh_toan' => $trang_thai_thanh_toan,
                    'ngay_dat_hang' => $order_date, // Lưu ngày giờ tạo đơn
                    'tong_tien' => $total_price, // Tổng tiền đơn hàng
                    'trang_thai' => $order_status // Trạng thái đơn hàng
                ];
var_dump($order_data);
die();
                // Gọi phương thức lưu đơn hàng vào cơ sở dữ liệu (hãy thay đổi phần này nếu cần)
                $this->modelGiohang->saveOrder($order_data);

                // Xoá các lỗi trước đó (nếu có) và chuyển hướng đến trang thành công
                unset($_SESSION['errors']);
                header('Location: ?act=giohang');
                exit();
            } else {
                // Nếu có lỗi, lưu lỗi vào session và quay lại form để thông báo lỗi
                $_SESSION['errors'] = $errors;

                header('Location: ?act=giohang');
                exit();
            }
        }
    }



}