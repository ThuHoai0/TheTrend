<?php
class DathangController
{
    public $modelDathang;

    public function __construct()
    {
        $this->modelDathang = new Dathang(); // Giả sử có một model Dathang để xử lý dữ liệu
    }

    public function dathang()
    {
        require_once './dathang.php';
    }

    // Hàm xử lý đặt hàng
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Ho Chi Minh
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // Lấy thông tin từ form
            $ho_ten_nguoi_nhan = $_POST['ho_ten_nguoi_nhan'];
            $so_dien_thoai_nguoi_nhan = $_POST['so_dien_thoai_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $dia_chi_nhan_hang = $_POST['dia_chi_nhan_hang'];
            $ghi_chu = $_POST['ghi_chu'];
            $phuong_thuc_thanh_toan = $_POST['phuong_thuc_thanh_toan'];

            // Lấy tổng tiền từ giỏ hàng hoặc session
            $total_price = $_POST['tong_tien']; // Có thể lấy từ session hoặc giỏ hàng

            // Gán trạng thái đơn hàng và thời gian đặt hàng
            $order_status = '11';  // Trạng thái mặc định
            $order_date = date('Y-m-d H:i:s');  // Lấy thời gian hiện tại

            // Kiểm tra và validate dữ liệu đầu vào
            $errors = [];
            if (empty($ho_ten_nguoi_nhan)) {
                $errors[] = "Họ tên người nhận không được để trống!";
            }
            if (empty($so_dien_thoai_nguoi_nhan)) {
                $errors[] = "Số điện thoại không được để trống!";
            }
            if (empty($email_nguoi_nhan)) {
                $errors[] = "Email người nhận không được để trống!";
            }
            if (empty($dia_chi_nhan_hang)) {
                $errors[] = "Địa chỉ nhận hàng không được để trống!";
            }

            // Nếu có lỗi, hiển thị thông báo
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                return;
            }

            // Lưu thông tin đơn hàng vào cơ sở dữ liệu
            $order_data = [
                'ho_ten_nguoi_nhan' => $ho_ten_nguoi_nhan,
                'so_dien_thoai_nguoi_nhan' => $so_dien_thoai_nguoi_nhan,
                'email_nguoi_nhan' => $email_nguoi_nhan,
                'dia_chi_nhan_hang' => $dia_chi_nhan_hang,
                'ghi_chu' => $ghi_chu,
                'phuong_thuc_thanh_toan' => $phuong_thuc_thanh_toan,
                'tong_tien' => $total_price,
                'trang_thai_id' => $order_status,
                'ngay_dat_hang' => $order_date
            ];

            // Gọi model Dathang để lưu thông tin vào cơ sở dữ liệu
            $this->modelDathang->saveOrder($order_data);
            // Redirect đến trang cảm ơn hoặc trang theo ý muốn
            header('Location: ?act=donhang&id=');  // Ví dụ, điều hướng đến trang cảm ơn
        }
    }


}
