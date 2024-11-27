<?php 
	require_once "./views/header.php";
?>
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
            Trang Chủ
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
           Sản phẩm yêu thích
        </span>
    </div>
    <h1>Sản phẩm yêu thích</h1>


    <?php if (!empty($yeu_thich)): ?>
        <div class="product-list">
            <?php foreach ($yeu_thich as $yt): ?>
                <div class="block2">
                <img src="<?= '././admin/uploads/'. $yeu_thich['hinh_anh'] ?? 'default.jpg'; ?>" alt="IMG-PRODUCT" style="width: 100%; height: 300px; object-fit: cover; object-position: center">                    
                    <a href="?act=chitietsanpham&id=<?= $yeu_thich['id']; ?>"
                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                        Xem thêm
                    </a>
                    <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l ">
                    <b class="stext-104 cl4 js-name-b2 p-b-6" style="font-size: 18px;font-family: 'Roboto', sans-serif !important;">
                        <?= htmlspecialchars($yeu_thich['ten_san_pham']); ?>
                    </b>
                    <span class="stext-105 cl3">
                <?= number_format($yeu_thich['gia'], 0, ',', '.'); ?> VNĐ
            </span>
                </div>

            </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Không có sản phẩm yêu thích nào.</p>
    <?php endif; ?>


<?php 
	require_once "./views/footer.php";
 ?>