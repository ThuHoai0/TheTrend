<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <!-- Thêm Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Thêm icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            /* Đặt hình ảnh làm nền */
            background: url('assets/images/slide-04.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .wrapper {
            background: rgba(255, 255, 255, 0.85); /* Nền trắng trong suốt */
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .input-box {
            position: relative;
        }
        .input-box input {
            padding-left: 40px;
        }
        .input-box box-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #6c757d;
        }
    </style>
</head>

<body>
<div class="wrapper">
    <form action="?act=dangnhap" method="POST">
        <h1 class="text-center mb-4">Đăng Nhập</h1>

        <!-- Input cho Email -->
        <div class="mb-3 input-box">
            <input type="text" class="form-control" placeholder="Email" required name="email">
            <box-icon type='solid' name='email'></box-icon>
        </div>

        <!-- Input cho Password -->
        <div class="mb-3 input-box">
            <input type="password" class="form-control" placeholder="Mật Khẩu" required name="mat_khau">
            <box-icon type='solid' name='lock-alt'></box-icon>
        </div>

        <!-- Link Quên mật khẩu -->
        <div class="d-flex justify-content-end mb-3">
            <a href="#" class="text-decoration-none">Quên mật khẩu?</a>
        </div>

        <!-- Nút Đăng Nhập -->
        <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>

        <!-- Link Đăng Ký -->
        <div class="text-center mt-3">
            <p>Bạn chưa có tài khoản? <a href="?act=dangky" class="text-decoration-none">Đăng Ký</a></p>
        </div>
    </form>
</div>

<!-- Thêm Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
