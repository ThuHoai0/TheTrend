<?php
class GiohangController
{
    public $modelGiohang;

    public function __construct()
    {
        $this->modelGiohang = new Giohang();
    }

    public function giohang(){
        require_once './giohang.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Ho Chi Minh
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // Get form data
            $ho_ten_nguoi_nhan = $_POST['ho_ten_nguoi_nhan'];
            $so_dien_thoai_nguoi_nhan = $_POST['so_dien_thoai_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $dia_chi_nhan_hang = $_POST['dia_chi_nhan_hang'];
            $ghi_chu = $_POST['ghi_chu'];
            $payment_method = $_POST['payment_method'];
            $total_price = isset($total_price) ? $total_price : 0; // You can calculate this or get it from the session
            $order_status = 'pending';  // Assuming the default status is 'pending'
            $order_date = date('Y-m-d H:i:s');  // The current date and time
            $user_id = $_SESSION['user_id'];  // Assuming the user is logged in and their ID is stored in the session
            $product_id = $_POST['product_id']; // If this is a single product, otherwise handle multiple items in the order

            // Validate form inputs
            $errors = [];

//            if (empty($ho_ten_nguoi_nhan)) {
//                $errors['ho_ten_nguoi_nhan'] = "Tên người nhận là bắt buộc";
//            }
//
//            if (empty($so_dien_thoai_nguoi_nhan)) {
//                $errors['so_dien_thoai_nguoi_nhan'] = "Số điện thoại là bắt buộc";
//            } elseif (!preg_match('/^[0-9]{10,11}$/', $so_dien_thoai_nguoi_nhan)) {
//                $errors['so_dien_thoai_nguoi_nhan'] = "Số điện thoại không hợp lệ";
//            }
//
//            if (empty($email_nguoi_nhan)) {
//                $errors['email_nguoi_nhan'] = "Email là bắt buộc";
//            } elseif (!filter_var($email_nguoi_nhan, FILTER_VALIDATE_EMAIL)) {
//                $errors['email_nguoi_nhan'] = "Email không hợp lệ";
//            }
//
//            if (empty($dia_chi_nhan_hang)) {
//                $errors['dia_chi_nhan_hang'] = "Địa chỉ giao hàng là bắt buộc";
//            }
//
//            if (empty($payment_method)) {
//                $errors['payment_method'] = "Phương thức thanh toán là bắt buộc";
//            }

            // If there are no errors, process the order
            if (empty($errors)) {
                // Insert the order data into the database (assuming a method to save the order is available)
                $order_data = [
                    'ho_ten_nguoi_nhan' => $ho_ten_nguoi_nhan,
                    'so_dien_thoai_nguoi_nhan' => $so_dien_thoai_nguoi_nhan,
                    'email_nguoi_nhan' => $email_nguoi_nhan,
                    'dia_chi_nhan_hang' => $dia_chi_nhan_hang,
                    'ghi_chu' => $ghi_chu,
                    'payment_method' => $payment_method,
                    'ngay_tao' => date('Y-m-d H:i:s') // Save the current date and time
                ];

                // Call a method to save order data to the database (you can adapt this part based on your model)
                $this->modelGiohang->saveOrder($order_data);

                // Optionally, send an email or perform additional actions (like sending a confirmation message)

                // Redirect to a success page or show confirmation
                unset($_SESSION['errors']); // Clear previous errors if any
                header('Location: ?act=order/success');
                exit();
            } else {
                // If errors exist, store them in the session and redirect back to the form
                $_SESSION['errors'] = $errors;
                header('Location: ?act=order/create');
                exit();
            }
        }
    }


}