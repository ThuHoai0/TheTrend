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
    .voucher-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        margin-bottom: 20px;
    }
    .copy-btn {
        cursor: pointer;
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
    <div class="row">
        <?php if (!empty($khuyen_mais)) : ?>
            <?php foreach ($khuyen_mais as $index => $voucher) : ?>
                <div class="col-md-4">
                    <div class="voucher-card">
                        <h4><strong><?= htmlspecialchars($voucher['ten_khuyen_mai']) ?></strong></h4>
                        <p><strong>Mô tả:</strong> <?= htmlspecialchars($voucher['mo_ta']) ?></p>
                        <p><strong>Mã:</strong> 
                           <span id="voucher-code-<?= $index ?>"><?= htmlspecialchars($voucher['ma_khuyen_mai']) ?></span>
                        </p>
                        <p><strong>Hạn sử dụng:</strong> <?= htmlspecialchars($voucher['ngay_ket_thuc']) ?></p>
                        <button class="btn btn-primary copy-btn" onclick="copyVoucher(<?= $index ?>)">
                            Sao chép mã
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center">Hiện tại không có khuyến mãi nào.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    function copyVoucher(index) {
        const voucherId = `voucher-code-${index}`;
        const voucherCode = document.getElementById(voucherId).textContent;

        navigator.clipboard.writeText(voucherCode)
            .then(() => {
                alert("Đã sao chép mã: " + voucherCode);
            })
            .catch(err => {
                alert("Lỗi khi sao chép mã!");
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
