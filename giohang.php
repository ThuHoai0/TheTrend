<?php 
	include"./views/header.php";
?>
<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
            Trang Chủ
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Giỏ Hàng
        </span>
    </div>
</div>


<!-- Shoping Cart -->
    <form class="bg0 p-t-75 p-b-85" method="POST" action="checkout.php">
        <div class="container">
            <div class="row">
                <!-- Danh sách sản phẩm trong giỏ hàng -->
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Ảnh</th>
                                    <th class="column-2">Tên</th>
                                    <th class="column-3">Giá</th>
                                    <th class="column-4" style="text-align: center;">Số Lượng</th>
                                    <th class="column-5">Thành Tiền</th>
                                </tr>
                                <?php
                                $total_price = 0;
                                foreach ($_SESSION['cart'] as $item) {
                                    $subtotal = $item['product_price'] * $item['quantity'];
                                    $total_price += $subtotal;
                                    ?>
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="<?= htmlspecialchars($item['product_image']) ?>" alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2"><?= htmlspecialchars($item['product_name']) ?></td>
                                        <td class="column-3"><?= number_format($item['product_price'], 0, ',', '.') ?> VNĐ</td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                       name="quantity[<?= $item['product_id'] ?>]"
                                                       value="<?= $item['quantity'] ?>" min="1">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="column-5"><?= number_format($subtotal, 0, ',', '.') ?> VNĐ</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                       name="coupon" placeholder="Mã giảm giá">
                                <button type="submit" name="apply_coupon"
                                        class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Áp dụng
                                </button>
                            </div>

                            <button type="submit" name="update_cart"
                                    class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                Cập nhật
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Thông tin đặt hàng -->
                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">ĐẶT HÀNG</h4>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Địa chỉ:</span>
                            </div>

                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <textarea class="stext-111 cl6 p-t-2 border" name="address"
                                      placeholder="Nhập địa chỉ giao hàng..."></textarea>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Phương thức thanh toán:</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <div class="p-t-10">
                                    <label>
                                        <input type="radio" name="payment_method" value="chuyen_khoan" class="m-r-10">
                                        Chuyển khoản
                                    </label>
                                </div>
                                <div class="p-t-10">
                                    <label>
                                        <input type="radio" name="payment_method" value="nhan_hang" class="m-r-10">
                                        Thanh toán khi nhận hàng
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">Tổng tiền:</span>
                            </div>

                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2"><?= number_format($total_price, 0, ',', '.') ?> VNĐ</span>
                            </div>
                        </div>

                        <button type="submit" name="checkout"
                                class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Thanh Toán
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


<?php
	include "./views/footer.php";
?>