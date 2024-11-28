<?php
require_once './views/header.php';
?>

<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                SẢN PHẨM YÊU THÍCH
            </h3>
        </div>

        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <!-- Tất cả sản phẩm -->
                <a href="?act=home"
                   class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 <?= !isset($_GET['category']) ? 'how-active1' : '' ?>"
                   data-filter="*">
                    Tất cả sản phẩm
                </a>

<!--                 Danh mục sản phẩm-->
<!--                --><?php //foreach ($danh_mucs as $danh_muc): ?>
<!--                    <a href="?act=home&category=--><?php //= htmlspecialchars($danh_muc['id']) ?><!--"-->
<!--                       class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 --><?php //= (isset($_GET['category']) && $_GET['category'] == $danh_muc['id']) ? 'how-active1' : '' ?><!--"-->
<!--                       data-filter=".--><?php //= htmlspecialchars($danh_muc['ten_danh_muc']) ?><!--">-->
<!--                        --><?php //= htmlspecialchars($danh_muc['ten_danh_muc']) ?>
<!--                    </a>-->
<!--                --><?php //endforeach; ?>
            </div>


            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Lọc
                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Tìm Kiếm
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <div class="bor8 dis-flex p-l-15">
                    <form role="search" method="get" id="searchForm">
                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text"
                               placeholder="Tìm Kiếm" id="searchInput" name="search">
                    </form>
                </div>
            </div>

            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Lọc
                        </div>
                        <ul>
                            <li class="p-b-6">
                                <a href="?act=home&page=<?= $page ?>&ord=0" class="filter-link stext-106 trans-04">
                                    Giá: Cao đến thấp
                                </a>
                            </li>
                            <li class="p-b-6">
                                <a href="?act=home&page=<?= $page ?>&ord=1" class="filter-link stext-106 trans-04">
                                    Giá: Thấp đến cao
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- sanpham -->
        <div class="row isotope-grid">

            <?php foreach ($san_pham_yeu_thich as $index => $san_pham): ?>
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0 position-relative">
                            <img src="<?= '././admin/uploads/'. $san_pham['hinh_anh'] ?? 'default.jpg'; ?>" alt="IMG-PRODUCT" style="width: 100%; height: 300px; object-fit: cover; object-position: center">

                            <?php if ($index < 3): ?>
                                <!-- Nhãn NEW -->
                                <span class="badge-new">NEW</span>
                            <?php endif; ?>

                            <a href="?act=chitietsanpham&id=<?= $san_pham['id']; ?>"
                               class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                Xem thêm
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <b class="stext-104 cl4 js-name-b2 p-b-6" style="font-size: 18px;font-family: 'Roboto', sans-serif !important;">
                                    <?= htmlspecialchars($san_pham['ten_san_pham']); ?>
                                </b>
                                <span class="stext-105 cl3">
                            <?= number_format($san_pham['gia'], 0, ',', '.'); ?> VNĐ
                        </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="?act=addyeuthich&id<?= $san_pham['id']; ?>" >
                                    <img class="icon-heart1" src="assets/images/icons/icon-heart-01.png" alt="ICON">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        <!-- hetsanpham -->
        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <a href="?act=home&page=<?= $page - 1 ?>">
                <i class="fa-solid fa-arrow-left mr-4"> </i>
            </a>
            <a href="?act=home&page=<?= $page + 1 ?>">
                <i class="fa-solid fa-arrow-right ml-4"> </i>
            </a>
        </div>
    </div>
</section>

<?php
require_once './views/footer.php';
?>
