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
                    <?php foreach ($tinTucs as $tinTucs): ?>
                    <div class="p-b-63">
                        <a href="?act=chitiettintuc&id=" class="hov-img0 how-pos5-parent">
                            <!-- <img src="assets/images/blog-04.jpg" alt="IMG-BLOG"> -->

                            <div class="flex-col-c-m size-123 bg9 how-pos5">
                                <span class="ltext-107 cl2 txt-center">
                                    22
                                </span>

                                <span class="stext-109 cl3 txt-center">
                                    Jan 2018
                                </span>
                            </div>
                        </a>

                        <div class="p-t-32">
                            <h4 class="p-b-15">
                                <td> <?= $tinTucs['tieu_de'] ?></td> 

                                </a>
                            </h4>

                            <p class="stext-117 cl6">
                                    <td><?= $tinTucs['noi_dung'] ?></td>
                                
                            </p>
                            <div class="flex-w flex-sb-m p-t-18">
                                <span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">

                                </span>

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