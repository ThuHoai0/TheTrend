<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="views/login/dn.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<div class="wrapper">
    <form action="?act=dangnhap" method="post">
        <h1>Đăng Nhập</h1>
        <div class="input-box">
            <input type="text" placeholder="Username" required name="email">
            <box-icon type='solid' name='email'></box-icon>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" required name="mat_khau">
            <box-icon type='solid' name='lock-alt'></box-icon>
        </div>

        <div class="remember-forgot">

            <a href="#">Quên Mật Khẩu</a>
        </div>

        <button type="submit" class="btn">
            <a" href="index.php">Đăng Nhập</a>
        </button>

        <div class="register-link">
            <p>Bạn chưa có tài khoản?<a href="?act=dangky">Đăng Ký</a></p>
        </div>
    </form>
</div>
</body>

</html>