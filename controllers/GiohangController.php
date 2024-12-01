<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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

            $noiDungEmail = "
            <h2>Thông tin đơn hàng</h2>
            <p><strong>Họ tên:</strong> $ho_ten_nguoi_nhan</p>
            <p><strong>Số điện thoại:</strong> $so_dien_thoai_nguoi_nhan</p>
            <p><strong>Email người nhận:</strong> $email_nguoi_nhan</p>
            <p><strong>Địa chỉ nhận hàng:</strong> $dia_chi_nhan_hang</p>
            <p><strong>Ghi chú:</strong> $ghi_chu</p>
            <p><strong>Tổng tiền:</strong> " . number_format($total_price, 0, '.', '.') . " VNĐ</p>
            <a href='http://localhost/TheTrend/?act=donhang' style='background-color: #4CAF50; color: white; padding: 10px 15px;'>Vui lòng bấm vào đây để kiểm tra lại đơn hàng</a>
            <p>Đây là email tự động vui lòng không trả lời email này</p>
            ";


        

        $mail = new PHPMailer(true);
        try {
        // Cấu hình gửi email
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server của Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'oduongo123@gmail.com'; // Email của bạn
        $mail->Password = 'gkbv rjnf fbef gvwg'; // Mật khẩu email
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Người gửi và người nhận
        $mail->setFrom('oduongo123@gmail.com', 'TheTrend');
        $mail->addAddress($email_nguoi_nhan, $ho_ten_nguoi_nhan); // Gửi đến email của người nhận
        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'ORDER CONFIRMATION';
        $mail->Body = $noiDungEmail;

        // Gửi email
        $mail->send();
        echo "<script>alert('Đơn hàng đã được gửi và email xác nhận đã được gửi!');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Có lỗi xảy ra khi gửi email: {$mail->ErrorInfo}');</script>";
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

                // Gọi phương thức lưu đơn hàng vào cơ sở dữ liệu
                $orderId = $this->modelGiohang->saveOrder($order_data);
//                var_dump($orderId);
//                die();
                // Kiểm tra kết quả lưu đơn hàng
                if ($orderId) {

                    // Nếu đơn hàng được lưu thành công, xoá giỏ hàng và thêm thông báo thành công vào session
                    unset($_SESSION['cart']); // Xóa giỏ hàng
                    $_SESSION['cart'] = []; // Đảm bảo giỏ hàng trống

                    $_SESSION['order_success'] = "Đặt hàng thành công! Cảm ơn bạn đã mua hàng."; // Thông báo thành công

                    // Chuyển hướng đến trang đơn hàng hoặc giỏ hàng
                    header('Location: ?act=donhang');
                    exit();
                    }
                } else {
                    // Nếu lưu đơn hàng thất bại, thông báo lỗi
                    $_SESSION['order_error'] = 'Đặt hàng thất bại, vui lòng thử lại.';
                    header('Location: ?act=donhang');
//                    $_SESSION['order_success'] = "Đặt hàng thành công! Cảm ơn bạn đã mua hàng."; // Thông báo thành công
//                    header('Location: ?act=donhang');
                    exit();
                }
            } else {
                // Nếu có lỗi, lưu lỗi vào session và quay lại form giỏ hàng
                $_SESSION['errors'] = $errors;
                header('Location: ?act=giohang');
                exit();
            }
        }
    }




