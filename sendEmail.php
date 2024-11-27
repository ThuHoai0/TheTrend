<?php
// Kiểm tra nếu form được gửi đi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    // Nhập thông tin email
    $email = trim($_POST['email']);

    // Kiểm tra tính hợp lệ của email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email không hợp lệ.";
        exit();
    }

    // Nội dung email
    $subject = "Xác nhận email";
    $message = "Cảm ơn bạn đã nhập email. Đây là tin nhắn xác nhận!";
    $headers = "From: your-email@example.com";

    // Gửi email
    if (mail($email, $subject, $message, $headers)) {
        echo "Tin nhắn đã được gửi thành công!";
    } else {
        echo "Có lỗi xảy ra khi gửi tin nhắn.";
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}