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
            font-family: 'Roboto', sans-serif;
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
    <div class="form-container">
    <form method="POST" action="?act=luuthongtin&id=<?= $_SESSION['iduser'] ?>">
    <!-- Username -->
    <div class="form-section">
        <label for="name" class="form-label">Tên Đăng Nhập</label>
        <input 
            type="text" 
            class="form-control" 
            id="name"
            name="name" 
            value="<?= $_SESSION['name'] ?>"
            readonly>
        <div class="form-text">Tên đăng nhập không thể thay đổi.</div>
    </div>

    <!-- Email -->
    <div class="form-section">
        <label for="email" class="form-label">Email</label>
        <input 
            type="email" 
            class="form-control" 
            id="email" 
            name="email" 
            value="<?= $_SESSION['email'] ?>" readonly>
    </div>

    <!-- Password -->
    <div class="form-section">
        <label for="mat_khau" class="form-label">Mật Khẩu</label>
        <input 
            type="password" 
            class="form-control" 
            id="mat_khau" 
            name="mat_khau" 
            value="<?= isset($nguoi_dung['mat_khau']) ? $nguoi_dung['mat_khau'] : '' ?>" readonly>
    </div>

    <!-- Address -->
    <div class="form-section">
        <label for="dia_chi" class="form-label">Địa chỉ</label>
        <input 
            type="text" 
            class="form-control" 
            id="dia_chi" 
            name="dia_chi" 
            value="<?= isset($nguoi_dung['dia_chi']) ? $nguoi_dung['dia_chi'] : '' ?>">
    </div>

    <!-- Phone Number -->
    <div class="form-section">
        <label for="so_dien_thoai" class="form-label">Số Điện Thoại</label>
        <input 
            type="tel" 
            class="form-control" 
            id="so_dien_thoai" 
            name="so_dien_thoai" 
            value="<?= isset($nguoi_dung['so_dien_thoai']) ? $nguoi_dung['so_dien_thoai'] : '' ?>" readonly>
    </div>

    <!-- Gender -->
    <div class="form-section">
        <label class="form-label">Giới Tính</label>
        <div>
            <div class="form-check form-check-inline">
                <input 
                    class="form-check-input" 
                    type="radio" 
                    name="gioi_tinh" 
                    value="1" 
                    <?= $nguoi_dung['gioi_tinh'] == 1 ? 'checked' : '' ?>>
                <label class="form-check-label">Nam</label>
            </div>
            <div class="form-check form-check-inline">
                <input 
                    class="form-check-input" 
                    type="radio" 
                    name="gioi_tinh" 
                    value="2" 
                    <?= $nguoi_dung['gioi_tinh'] == 2 ? 'checked' : '' ?>>
                <label class="form-check-label">Nữ</label>
            </div>
        </div>  
    </div>

    <!-- Birth Date -->
    <div class="form-section">
    <label for="ngay_sinh" class="form-label">Ngày sinh</label>
    <div class="row">
        <?php
        $ngay_sinh = isset($nguoi_dung['ngay_sinh']) && strtotime($nguoi_dung['ngay_sinh']) 
            ? strtotime($nguoi_dung['ngay_sinh']) 
            : null;
        ?>
        <div class="col-4">
            <select name="day" id="day" class="form-select" disabled>
                <option value="">Ngày</option>
                <?php for ($i = 1; $i <= 31; $i++): ?>
                    <option value="<?= $i ?>" <?= $ngay_sinh && intval(date('d', $ngay_sinh)) == $i ? 'selected' : '' ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-4">
            <select name="month" id="month" class="form-select" disabled>
                <option value="">Tháng</option>
                <?php for ($i = 1; $i <= 12; $i++): ?>
                    <option value="<?= $i ?>" <?= $ngay_sinh && intval(date('m', $ngay_sinh)) == $i ? 'selected' : '' ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-4">
            <select name="year" id="year" class="form-select" disabled>
                <option value="">Năm</option>
                <?php for ($i = date('Y'); $i >= 1900; $i--): ?>
                    <option value="<?= $i ?>" <?= $ngay_sinh && intval(date('Y', $ngay_sinh)) == $i ? 'selected' : '' ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
    </div>
    <input type="hidden" name="day" value="<?= $ngay_sinh ? intval(date('d', $ngay_sinh)) : '' ?>">
    <input type="hidden" name="month" value="<?= $ngay_sinh ? intval(date('m', $ngay_sinh)) : '' ?>">
    <input type="hidden" name="year" value="<?= $ngay_sinh ? intval(date('Y', $ngay_sinh)) : '' ?>">
</div>



    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary mt-3">Lưu Thông Tin</button>

    <!-- Back Button -->
    <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back()">Trở Về</button>
</form>


</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
