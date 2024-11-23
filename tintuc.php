<?php 
	require_once "./views/header.php";
?>
<!-- Title page -->

<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('assets/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Tin Tức
    </h2>
</section>


<!-- Content page -->
<section class="bg0 p-t-62 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-12 p-b-80">
                <div class="p-r-45 p-r-0-lg">
                    <!-- item blog -->
                    <?php 
                $images = ['assets/images/blog-05.jpg', 'assets/images/blog-06.jpg']; // Danh sách ảnh khác nhau
                foreach ($tinTucs as $index => $tinTucs): ?>
    <div class="p-b-63">
        <a href="?act=chitiettintuc&id=<?= $tinTucs['id'] ?>" class="hov-img0 how-pos5-parent">
            <img src="<?= $images[$index % count($images)] ?>" alt="IMG-BLOG">
        </a>

        <div class="p-t-32">
            <h4 class="p-b-15">
                <td><?= $tinTucs['tieu_de'] ?></td>
            </h4>

            <p class="stext-117 cl6">
            <?php
            $noi_dung = $tinTucs['noi_dung'];
            $cau = explode('.', $noi_dung); // Tách mô tả thành các câu
            $noi_dung_hien_thi = implode('. ', array_slice($cau, 0, 4)) . '.'; // Lấy 4 câu đầu và nối lại
            echo $noi_dung_hien_thi;
            ?>
            </p>

            <div class="flex-w flex-sb-m p-t-18">
                <span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10"></span>

                <a href="?act=chitiettintuc&id=<?= $tinTucs['id'] ?>" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                    Xem Chi Tiết
                    <i class="fa fa-long-arrow-right m-l-9"></i>
                </a>
            </div>
        </div>
    </div>
<?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>



<?php 
	require_once "./views/footer.php";
 ?>