<?php
    require_once "./views/header.php";
?>

<style>
        .banner {
            background: url('https://via.placeholder.com/1920x400') no-repeat center;
            background-size: cover;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
        }

        /* Tiêu đề chính */
        .container h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Discount Card */
        .discount-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .discount-card:hover {
            transform: translateY(-5px);
        }

        .discount-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .discount-card .details {
            flex: 1;
            margin-left: 15px;
            color: #555;
        }

        .discount-card .details h4 {
            margin: 0 0 5px;
            font-size: 18px;
            color: #333;
        }

        .discount-card .details span {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }

        .discount-card .details p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        .save-button {
            background: #f60;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .save-button:hover {
            background: #d95400;
        }

        /* Khi không có khuyến mãi */
        .text-center {
            text-align: center;
            color: #777;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>

<!-- Title page -->
<section 
    class="bg-img1 txt-center p-lr-15 p-tb-92" 
    style="
        background-image: url('assets/images/banner5.png'); 
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat; 
        width: 100%; 
        height: 100vh;">
</section>

<!-- Voucher Section -->
<div class="container my-5">
    <h1>Ưu đãi giảm giá</h1>

    <!-- Second Style -->
    <?php if (!empty($khuyen_mais)) : ?>
        <?php foreach ($khuyen_mais as $index => $voucher) : ?>
            <div class="discount-card">
                <img src="https://everpro.id/wp-content/uploads/2022/12/whatsapp-image-2022-03-28-at-09-20220328092414.jpeg" alt="ZAGG Logo">
                <div class="details">
                    <h4><?= htmlspecialchars($voucher['ten_khuyen_mai']) ?></h4>
                    <p><?= htmlspecialchars($voucher['mo_ta']) ?> | HSD <?= htmlspecialchars($voucher['ngay_ket_thuc']) ?></p>
                </div>
                <!-- Nút Lưu chứa mã khuyến mãi trong thuộc tính data-voucher -->
                <button 
                    class="save-button" 
                    onclick="copyVoucher(this)" 
                    data-voucher="<?= htmlspecialchars($voucher['ma_khuyen_mai']) ?>">
                    Lưu
                </button>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p class="text-center">Hiện tại không có khuyến mãi nào.</p>
    <?php endif; ?>
</div>

<script>
    // Hàm sao chép mã khuyến mãi
    function copyVoucher(buttonElement) {
        const voucherCode = buttonElement.getAttribute("data-voucher"); // Lấy mã từ thuộc tính data-voucher

        // Sao chép nội dung vào clipboard
        navigator.clipboard.writeText(voucherCode)
            .then(() => {
                alert("Đã sao chép mã: " + voucherCode); // Hiển thị thông báo thành công
            })
            .catch(err => {
                alert("Lỗi khi sao chép mã!"); // Hiển thị thông báo lỗi nếu có
            });
    }
</script>

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<?php require_once "./views/footer.php"; ?>
