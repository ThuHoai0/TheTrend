<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Danh Mục
                </h4>
                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Nữ
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Nam
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Giày
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Đồng Hồ
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Hỗ Trợ
                </h4>

                <ul>
                    <li class="p-b-10">
                        <p> Thông tin vận chuyển</p> 
                    </li>

                    <li class="p-b-10">
                        <p> Trả lại &amp; Trao đổi</p>
                    </li>

                    <li class="p-b-10">
                        <p> Điều khoản &amp; Điều kiện</p>   
                    </li>

                    <li class="p-b-10">
                        <p> Chính sách bảo mật</p>   
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Liên Lạc
                </h4>

                <p class="stext-107 cl7 size-201">
                    Cao Đẳng FPT POLYTECHNIC, Đường Trịnh Văn Bô, Quận Nam Từ Liêm, Hà Nội hoặc gọi cho chúng tôi
                    096 345 6879
                </p>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    BẢN TIN
                </h4>
                 <form>
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email"
                            placeholder="Gửi email">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            Gửi
                        </button>
                    </div>
                </form>
<!--                <form action="sendEmail.php" method="POST">-->
<!--                    <label for="email">Nhập email của bạn:</label>-->
<!--                    <input type="email" name="email" id="email" required>-->
<!--                    <button type="submit">Gửi tin nhắn</button>-->
<!--                </form>-->
            </div>
        </div>

            <p class="stext-107 cl6 txt-center">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>
                document.write(new Date().getFullYear());
                </script><a href="https://themewagon.com" target="_blank">COZASTORE</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

            </p>
        </div>
    </div>
</footer>




<!--===============================================================================================-->
<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/bootstrap/js/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/select2/select2.min.js"></script>
<script>
$(".js-select2").each(function() {
    $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
    });
})
</script>
<!--===============================================================================================-->
<script src="assets/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/slick/slick.min.js"></script>
<script src="assets/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/parallax100/parallax100.js"></script>
<script>
$('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="assets/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
$('.gallery-lb').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
            enabled: true
        },
        mainClass: 'mfp-fade'
    });
});
</script>
<!--===============================================================================================-->
<script src="assets/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script>
<script>
$('.js-addwish-b1').on('click', function(e) {
    e.preventDefault();
});

$('.js-addwish-b1').each(function() {
    var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
    $(this).on('click', function() {
        swal(nameProduct, "is added to wishlist !", "success");

        $(this).addClass('js-addedwish-b2');
        $(this).off('click');
    });
});

$('.js-addwish-detail').each(function() {
    var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

    $(this).on('click', function() {
        swal(nameProduct, "is added to wishlist !", "success");

        $(this).addClass('js-addedwish-detail');
        $(this).off('click');
    });
});

/*---------------------------------------------*/

//$('#add-to-cart').each(function() {
//    //    const session = "<?php ////= $_SESSION['iduser'] ?>////";
//    //console.log(session);

//});
$('#add-to-cart').submit(function (e) {
    e.preventDefault();
   var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
   const currentQty = $('[name="so_luong"]').val();
   const qty = $('[name="quantity"]').val();
   console.log(currentQty);
   if (parseInt(qty) > parseInt(currentQty)) {
       swal("Cảnh báo", "Số lượng nhập vào không được lớn hơn số lượng còn lại của sản phẩm", "error");
   } else {
       $.ajax({
           url: '?act=handleCartAjax',
           type: 'POST',
           data: {
               product_id: $('[name="product_id"]').val(),
               product_name: $('[name="product_name"]').val(),
               product_img: $('#img-product').attr('src'),
               product_price: $('[name="product_price"]').val(),
               quantity: qty,
           },
           dataType: 'json',
           success: function (response) {
               if (response.status === 'success') {
                   // alert(response.message);
                   swal(nameProduct, "is added to cart !", "success");
                   $('.cart-total-items').text(response.total_items);
               } else if (response.status === 'fix') {
                   swal(nameProduct, "Thêm vào giỏ hàng thất bại", "error");
               }
               else {
                   // alert(response.message);
               }
           },error: function(xhr, status, error) {
               console.error("Status: " + status);
               console.error("Error: " + error);
               console.error("Response Text: " + xhr.responseText);
           },
       });
   }


   // Additional logic here (e.g., AJAX request)
});
</script>
<!--===============================================================================================-->
<script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
$('.js-pscroll').each(function() {
    $(this).css('position', 'relative');
    $(this).css('overflow', 'hidden');
    var ps = new PerfectScrollbar(this, {
        wheelSpeed: 1,
        scrollingThreshold: 1000,
        wheelPropagation: false,
    });

    $(window).on('resize', function() {
        ps.update();
    })
});
</script>
<!--===============================================================================================-->
<script src="assets/js/main.js"></script>
<script>
    // Get the input and form elements
    const searchInput = document.getElementById('searchInput');

    // Check for 'search' parameter in the URL on page load
    window.addEventListener('load', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const searchQuery = urlParams.get('search');
        if (searchQuery) {
            searchInput.value = searchQuery;
        } else {
            fetchUserData();  // Call the function that loads the full list
        }
    });

    searchInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {  // Check if the key pressed is Enter
            event.preventDefault();  // Prevent the default form action (no immediate reload)
            const query = searchInput.value.trim();
            if (query) {
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('search', query);
                window.location.href = currentUrl.href;
            } else {
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.delete('search');
                window.location.href = currentUrl.href;  // Reload to show the full list
            }
        }
    });

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // $(document).on('click', '.js-addcart-detail', function (e) {
    //     e.preventDefault();
    //
    // });
</script>
<style>
    
</style>

</body>

</html>