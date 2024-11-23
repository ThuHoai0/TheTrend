<?php 
	require_once "./views/header.php";
?>      

<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="http://localhost/TheTrend/?act=home" class="stext-109 cl8 hov-cl1 trans-04">
            Trang Chủ
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="?act=tintuc" class="stext-109 cl8 hov-cl1 trans-04">
            Tin Tức
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            <?= $chi_tiet['tieu_de'] ?>
        </span>
    </div>
</div>


<!-- Content page -->
<section class="bg0 p-t-52 p-b-20">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="p-r-45 p-r-0-lg">
                    <!--  -->
                    <div class="wrap-pic-w how-pos5-parent">
                        <img src="images/blog-04.jpg" alt="IMG-BLOG">

                        <!-- <div class="flex-col-c-m size-123 bg9 how-pos5">
                            <span class="ltext-107 cl2 txt-center">
                                22
                            </span>

                            <span class="stext-109 cl3 txt-center">
                                Jan 2018
                            </span>
                        </div> -->
                    </div>

                    <div class="p-t-32">
                        

                        <h4 class="ltext-109 cl2 p-b-28">
                            <?= $chi_tiet['tieu_de'] ?>
                        </h4>

                        <p class="stext-117 cl6 p-b-26">
                            <?= $chi_tiet['noi_dung'] ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php 
	require_once "./views/footer.php";
?>