<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Hồ Sơ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Nền và căn chỉnh */
        body {
            background: url('assets/images/slide-01.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #333;
        }

        /* Banner */
        .banner {
            text-align: center;
            background-color: rgba(0, 123, 255, 0.8);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin-bottom: -5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .banner h1 {
            font-size: 28px;
            font-weight: bold;
        }

        .banner p {
            font-size: 14px;
        }

        /* Form Container */
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 600px;
            width: 100%;
        }

        /* Form Inputs */
        .form-container label {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border-radius: 6px;
            font-size: 14px;
            padding: 10px;
        }

        /* Section Headers */
        .form-section {
            margin-bottom: 20px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        /* Gender and Date Inputs */
        .form-check-input {
            margin-right: 8px;
        }

        .row .form-select {
            font-size: 14px;
        }

        /* Button */
        .btn-primary {
            width: 100%;
            font-size: 16px;
            padding: 12px;
            border-radius: 6px;
            background-color: #007bff;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.03);
        }

        /* Link Styling */
        .btn-link {
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            padding-left: 10px;
        }

        .btn-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Banner -->
    <div class="">
        <h1 class="text-center">Quản Lý Hồ Sơ</h1>
        <p>Quản lý thông tin hồ sơ để bảo mật tài khoản của bạn</p>
    </div>

    <!-- Form Container -->
    <form method="POST" action="?act=doimatkhau&id=<?= $_SESSION['iduser']?>" class="form-container">
    <div class="form-section">
        <label for="mat_khau" class="form-label">Mật khẩu hiện tại</label>
        <input 
            type="text" 
            class="form-control" 
            id="mat_khau" 
            name="mat_khau" 
            placeholder="Nhập mật khẩu hiện tại" 
            required>
    </div>
    <div class="form-section">
        <label for="new_password" class="form-label">Mật khẩu mới</label>
        <input 
            type="text" 
            class="form-control" 
            id="new_password" 
            name="new_password" 
            placeholder="Nhập mật khẩu mới" 
            required>
    </div>
    <div class="form-section">
        <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
        <input 
            type="text" 
            class="form-control" 
            id="confirm_password" 
            name="confirm_password" 
            placeholder="Nhập lại mật khẩu mới" 
            required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Lưu Thông Tin</button>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
