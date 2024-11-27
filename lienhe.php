<?php 
	include "./views/header.php";
?>

<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']); // Xóa thông báo sau khi hiển thị
}

if (isset($_SESSION['errors'])) {
    echo '<div class="alert alert-danger" role="alert">';
    foreach ($_SESSION['errors'] as $error) {
        echo '<p>' . $error . '</p>';
    }
    echo '</div>';
    unset($_SESSION['errors']); // Xóa lỗi sau khi hiển thị
}
?>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('assets/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Liên Hệ
    </h2>
</section>

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="row">
            <!-- Form Liên Hệ -->
            <div class="col-md-8">
                <h4 class="mtext-105 cl2 txt-center p-b-30">Gửi thắc mắc cho chúng tôi</h4>
                <form action="?act=lienhe" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email của bạn</label>
                        <input class="form-control" type="text" name="email" placeholder="Email của bạn" require >
                    </div>
                    <div class="mb-3">
                        <label for="ho_ten" class="form-label">Họ và tên của bạn</label>
                        <input class="form-control" type="text" name="ho_ten" placeholder="Họ và tên của bạn" >
                    </div>
                    <div class="mb-3">
                        <label for="so_dien_thoai" class="form-label">Số điện thoại của bạn</label>
                        <input class="form-control" type="number" name="so_dien_thoai" placeholder="Số điện thoại của bạn" >
                    </div>
                    <div class="mb-3">
                        <label for="noi_dung" class="form-label">Thắc mắc của bạn</label>
                        <textarea class="form-control" name="noi_dung" rows="4" placeholder="Nhập nội dung thắc mắc của bạn" ></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-dark" type="submit">Gửi cho chúng tôi</button>
                    </div>
                </form>
            </div>

            <!-- Thông Tin Liên Hệ -->
            <div class="col-md-4">
                <div class="p-4 border rounded">
                    <h5 class="mb-4">Thông Tin Liên Hệ</h5>
                    <div class="mb-3">
                        <h6><i class="fas fa-map-marker-alt"></i> Địa chỉ</h6> 
                        <p class="mt-2">Cao Đẳng FPT POLYTECHNIC, Đường Trịnh Văn Bô, Quận Nam Từ Liêm, Hà Nội</p>
                    </div> 
                    <div class="mb-3">
                        <h6><i class="fas fa-phone-alt"></i> Hotline</h6>
                        <p class="mt-2"><a href="tel:+18001236789" class="text-decoration-none">096 345 6879</a></p>
                    </div> 
                    <div>
                        <h6><i class="fas fa-envelope"></i> Email</h6>
                        <p class="mt-2"><a href="mailto:contact@example.com" class="text-decoration-none">contact@example.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map -->
<div class="map mt-4">
    <div id="google_map" class="size-303" data-map-x="40.691446" data-map-y="-73.886787" data-pin="assets/images/icons/pin.png"
        data-scrollwheel="0" data-draggable="1" data-zoom="11"></div>
</div>

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<?php include "./views/footer.php"; ?>
