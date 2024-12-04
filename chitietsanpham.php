<?php 
	include"./views/header.php";
?>
<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Trang chủ
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
            <?= $chi_tiet['ten_danh_muc'] ?>
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            <?= $chi_tiet['ten_san_pham'] ?>
        </span>
    </div>
</div>


<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        <div class="slick3 gallery-lb">


                            <!-- Hiển thị ảnh gốc -->
                            <div class="item-slick3" data-thumb="<?= '././admin/uploads/' . $hinh_anh_goc; ?>">
                                <div class="wrap-pic-w pos-relative">
                                    <img id="img-product" src="<?= '././admin/uploads/' . $hinh_anh_goc; ?>" alt="IMG-PRODUCT" style="width: 100%; height: 500px; object-fit: cover; object-position: center">
                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                       href="<?= '././admin/uploads/' . $hinh_anh_goc; ?>">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Hiển thị top 2 ảnh -->
                            <?php if (!empty($hinh_anh_top2)): ?>
                                <?php foreach ($hinh_anh_top2 as $hinh): ?>
                                    <div class="item-slick3" data-thumb="<?= '././admin/uploads/' . $hinh['duong_dan_hinh_anh']; ?>">
                                        <div class="wrap-pic-w pos-relative">
                                            <img name="product_img" src="<?= '././admin/uploads/' . $hinh['duong_dan_hinh_anh']; ?>" alt="IMG-PRODUCT" style="width: 100%; height: 500px; object-fit: cover; object-position: center">
                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                               href="<?= '././admin/uploads/' . $hinh['duong_dan_hinh_anh']; ?>">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Không có hình ảnh bổ sung cho sản phẩm này.</p>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        <?= ucwords($chi_tiet['ten_san_pham']) ?>
                    </h4>
                    <span class="mtext-106 cl2">
                        Giá tiền: <?= $chi_tiet['gia'] * 10 ?> VNĐ
                    </span>

                    <p class="stext-102 cl3 p-t-23">
                        Mô tả:
                        <?php
                        $mo_ta = $chi_tiet['mo_ta'];
                        $cau = explode('.', $mo_ta); // Tách mô tả thành các câu
                        $mo_ta_hien_thi = implode('. ', array_slice($cau, 0, 2)) . '.'; // Lấy 2 câu đầu và nối lại
                        echo $mo_ta_hien_thi;
                        ?>
                    </p>


                    <p class="stext-102 cl3 p-t-23">
                        Số lượng: <?= $chi_tiet['so_luong'] ?>
                    </p>

                    <!--  -->
                    <div class="p-t-33">



                        <div class="flex-w flex-r-m p-b-10">
                            <?php if (!empty($_SESSION['iduser'])) { ?>
                            <form class="size-204 flex-w flex-m respon6-next" id="add-to-cart">
                                <?php
                                    if ($chi_tiet['so_luong'] == 0) {
                                    } else {
                                        ?>
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>
                                            <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity" value="1" min="1">
                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>
                                <input type="hidden" name="so_luong" value="<?= $chi_tiet['so_luong'] ?>">
                                <input type="hidden" name="product_id" value="<?= $chi_tiet['id'] ?>"> <!-- ID sản phẩm -->
                                <input type="hidden" name="product_name" value="<?= htmlspecialchars($chi_tiet['ten_san_pham']) ?>"> <!-- Tên sản phẩm -->
                                <input type="hidden" name="product_price" value="<?= $chi_tiet['gia'] ?>"> <!-- Giá sản phẩm -->

                                <?php
                                    if ($chi_tiet['so_luong'] == 0) {
                                        ?>
                                        <p class="text-danger">Sản phẩm đã hết hàng</p>
                                            <?php
                                    } else {
                                        ?>
                                        <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                            Thêm vào giỏ hàng
                                        </button>
                                <?php
                                    }
                                    ?>


                            </form>
                            <?php } else { ?>
                                <a href="http://localhost/TheTrend/?act=dangnhap" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Vui long dang nhap
                                </a>
                            <?php } ?>
                        </div>
                    </div>

                    <!--  -->
                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Giới thiệu sản phẩm</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#binhluan" role="tab">Bình luận</a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                <?= $chi_tiet['mo_ta'] ?>
                            </p>
                        </div>
                    </div>

                    <!-- - -->
                    <div class="tab-pane fade" id="binhluan" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <div class="p-b-30 m-lr-15-sm">
                                    <!-- Review -->
                                    <?php
                                    // Mảng chứa URL của 10 ảnh đại diện ngẫu nhiên
                                    $avatar_urls = [
                                        "https://i.pinimg.com/736x/e1/95/04/e195040207a2745da3daa76bd89bce66.jpg",
                                        "https://i.pinimg.com/736x/9c/ad/ef/9cadef762d49d7b12f666fde5f5bd245.jpg",
                                        "https://i.pinimg.com/736x/b5/ba/a5/b5baa53327e504f6f3c2b1e719299a5a.jpg",
                                        "https://i.pinimg.com/736x/7f/ac/c1/7facc1caff33bd07fdb88dae4f9a1082.jpg",
                                        "https://i.pinimg.com/736x/f8/57/92/f857926b3e0abee0a02d4867038c7960.jpg",
                                        "https://i.pinimg.com/736x/c9/03/8f/c9038ffb9fec4de75d3f8db2f77d0d00.jpg",
                                        "https://i.pinimg.com/736x/da/c5/09/dac5097f3cc18d95e4581ab91580282e.jpg",
                                        "https://i.pinimg.com/736x/bb/f9/1d/bbf91d985e6d545feacf5052bf96ae79.jpg",
                                        "https://i.pinimg.com/736x/9f/8c/a7/9f8ca751b4b5b1fd77bd32e71d640e39.jpg",
                                        "https://i.pinimg.com/736x/33/ba/f4/33baf4bccb7c5106fe86cbfd70a3afef.jpg"
                                    ];
                                    ?>

                                    <?php if (!empty($binh_luan)): ?>
                                        <?php foreach ($binh_luan as $comment): ?>
                                            <div class="flex-w flex-t p-b-68">
                                                <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                    <!-- Chọn ảnh đại diện ngẫu nhiên -->
                                                    <img src="<?= $avatar_urls[array_rand($avatar_urls)]; ?>" alt="AVATAR">
                                                </div>

                                                <div class="size-207">
                                                    <div class="flex-w flex-sb-m p-b-17">
                                                        <!-- Hiển thị tên người dùng -->
                                                        <span class="mtext-107 cl2 p-r-20">
                                                            <?= htmlspecialchars($comment['ten_nguoi_dung']); ?>
                                                        </span>
                                                        <!-- Hiển thị ngày bình luận -->
                                                        <span class="stext-102 cl3">
                                                            <?= htmlspecialchars($comment['ngay_binh_luan']); ?>
                                                        </span>
                                                    </div>
                                                    <!-- Hiển thị nội dung bình luận -->
                                                    <p class="stext-102 cl6">
                                                        <?= htmlspecialchars($comment['noi_dung']); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <!-- Nếu không có bình luận -->
                                        <p class="text-danger text-center">Chưa có bình luận nào cho sản phẩm này.</p>
                                    <?php endif; ?>




                                    <!-- Add review -->
                                    <?php if (isset($_SESSION['iduser'])): ?>
                                        <!-- Nếu người dùng đã đăng nhập -->
                                        <form class="w-full mt-5" action="?act=binhluan&id=<?= $chi_tiet['id']; ?>" method="post">
                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3 mt-3" for="noi_dung">Viết bình luận</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="noi_dung" name="noi_dung" required></textarea>
                                                </div>
                                            </div>
                                            <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">Gửi</button>
                                        </form>
                                    <?php else: ?>
                                        <!-- Nếu người dùng chưa đăng nhập -->
                                        <p class="mt-4">
                                            Bạn cần <a href="?act=dangnhap" class="font-weight-bold">đăng nhập</a> để bình luận.
                                        </p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- - -->
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <div class="p-b-30 m-lr-15-sm">
                                    <!-- Review -->
                                    <?php if (!empty($danh_gias) && is_array($danh_gias)): ?>
                                        <?php
                                        $danh_gia = $danh_gias[0];
                                        ?>
                                        <div class="flex-w flex-t p-b-68">
                                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                <img src="https://via.placeholder.com/100" alt="AVATAR">
                                            </div>
                                            <div class="size-207">
                                                <div class="flex-w flex-sb-m p-b-17">
                                                    <span class="mtext-107 cl2 p-r-20">
                                                        <?= htmlspecialchars($_SESSION['name']); ?>
                                                    </span>
                                                    <span class="fs-18 cl11">
                                                        <?= str_repeat('<i class="zmdi zmdi-star"></i>', intval($danh_gia['so_sao'])); ?>
                                                        <?= str_repeat('<i class="zmdi zmdi-star-outline"></i>', 5 - intval($danh_gia['so_sao'])); ?>
                                                    </span>
                                                </div>
                                                <p class="stext-102 cl6">
                                                    <?= htmlspecialchars($danh_gia['noi_dung']); ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

    <script>
        document.querySelectorAll('.item-rating').forEach(function (star) {
            star.addEventListener('click', function () {
                const ratingValue = this.getAttribute('data-value');
                document.getElementById('rating').value = ratingValue;

                // Thay đổi màu sắc các sao đã chọn
                document.querySelectorAll('.item-rating').forEach(function (item) {
                    item.classList.remove('zmdi-star');
                    item.classList.add('zmdi-star-outline');
                });
                for (let i = 0; i < ratingValue; i++) {
                    document.querySelectorAll('.item-rating')[i].classList.remove('zmdi-star-outline');
                    document.querySelectorAll('.item-rating')[i].classList.add('zmdi-star');
                }
            });
        });

    </script>

<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">
        <div class="p-b-45">
            <h3 class="ltext-106 cl5 txt-center">
                Sản phẩm liên quan
            </h3>
        </div>

        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">
                <?php foreach ($san_pham_lien_quan as $san_pham): ?>
                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="<?= '././admin/uploads/'. $san_pham['hinh_anh'] ?>" alt="<?= $san_pham['ten_san_pham'] ?>" style="width: 100%; height: 300px; object-fit: cover; object-position: center">
                                <a href="?act=chitietsanpham&id=<?= $san_pham['id']; ?>"
                                   class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                    Xem Thêm
                                </a>
                            </div>
                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        <?= $san_pham['ten_san_pham'] ?>
                                    </a>
                                    <span class="stext-105 cl3">
                                        <?= number_format($san_pham['gia'], 0, ',', '.') ?> VND
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>
<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<!-- Modal1 -->
<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal1"></div>

    <div class="container">
        <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
            <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                <img src="images/icons/icon-close.png" alt="CLOSE">
            </button>

            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="images/product-detail-01.jpg">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="images/product-detail-01.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="item-slick3" data-thumb="images/product-detail-02.jpg">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="images/product-detail-02.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="item-slick3" data-thumb="images/product-detail-03.jpg">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="images/product-detail-03.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            Lightweight Jacket
                        </h4>

                        <span class="mtext-106 cl2">
                            $58.79
                        </span>

                        <p class="stext-102 cl3 p-t-23">
                            Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare
                            feugiat.
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Size
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="time">
                                            <option>Choose an option</option>
                                            <option>Size S</option>
                                            <option>Size M</option>
                                            <option>Size L</option>
                                            <option>Size XL</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Color
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2" name="time">
                                            <option>Choose an option</option>
                                            <option>Red</option>
                                            <option>Blue</option>
                                            <option>White</option>
                                            <option>Grey</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number"
                                            name="num-product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <button
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                    data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>

        //$(document).ready(function () {
        //    $('#add-to-cart').submit(function (e) {
        //        e.preventDefault();  // Prevent default form submission
        //        const session = "<?php //= $_SESSION['iduser'] ?>//";  // PHP session variable
        //        console.log(session);
        //        // Additional logic here (e.g., AJAX request)
        //    });
        //
        //});

        function themVao1(e) {
            e.preventDefault();


        }
    </script>

<?php include "./views/footer.php";?>