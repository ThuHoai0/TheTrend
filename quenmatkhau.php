<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('assets/images/slide-01.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #333;
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



        .row  {
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

    </style>
</head>
<body>

    <div class="text-center">
        <h1>Quên Mật Khẩu</h1>
        <p>Nhập email và mật khẩu mới để thay đổi mật khẩu của bạn.</p>
    </div>

    <!-- Form Container -->
<form method="POST" action="?act=quenmatkhau" class="form-container">
    <div class="form-section">
        <label for="email" class="form-label">Email của bạn</label>
        <input 
            type="text" 
            class="form-control" 
            id="email" 
            name="email" 
            placeholder="Nhập email của bạn" 
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
    <button type="submit" class="btn btn-primary mt-3">Cập Nhật Mật Khẩu</button>
</form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
