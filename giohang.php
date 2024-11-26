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
    <div class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row ">
                <!-- Danh sách sản phẩm trong giỏ hàng -->
                <div class="col-lg-8 col-xl-7 m-lr-auto m-b-50 mb-4">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <?php
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                            echo "<p class='text-center text-danger'>Giỏ hàng của bạn đang trống!</p>";
                        } else {
                            ?>
                            <form action="?act=updateCart" method="POST">
                                <div class="wrap-table-shopping-cart">
                                    <table class="table-shopping-cart table table-bordered text-center align-middle mb-4">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Ảnh</th>
                                            <th>Tên</th>
                                            <th>Giá</th>
                                            <th>Số Lượng</th>
                                            <th>Thành Tiền</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $total_price = 0;
                                        foreach ($_SESSION['cart'] as $key => $item) {
                                            $subtotal = $item['product_price'] * $item['quantity'];
                                            $total_price += $subtotal;
                                            ?>
                                            <tr>
                                                <td>
                                                    <img src="<?= htmlspecialchars($item['product_image']) ?>" alt="IMG"
                                                         class="img-thumbnail" style="max-width: 80px;">
                                                </td>
                                                <td><?= htmlspecialchars($item['product_name']) ?></td>
                                                <td><?= number_format($item['product_price'], 0, ',', '.') ?> VNĐ</td>
                                                <td>
                                                    <input type="number" name="quantity[<?= $item['product_id'] ?>]"
                                                           value="<?= $item['quantity'] ?>" min="1" max="99"
                                                           class="form-control text-center">
                                                </td>
                                                <td><?= number_format($subtotal, 0, ',', '.') ?> VNĐ</td>
                                                <td>
                                                    <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm js-delete-btn"
                                                            onclick="deleteSp(<?= $item['product_id'] ?>)"
                                                    >
                                                        Xóa
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end fw-bold">Tổng tiền:</td>
                                            <td colspan="2" class="text-success fw-bold">
                                                <?= number_format($total_price, 0, ',', '.') ?> VNĐ
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Cập nhật giỏ hàng</button>
                                </div>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>


                <!--                 Thông tin đặt hàng-->
                <div class="col-lg-4 col-xl-5 m-lr-auto  mt-4">
                    <div class="border rounded p-4">
                        <h4 class="mb-4">Thông tin đặt hàng</h4>

                        <!-- Tên người nhận -->
                        <div class="mb-3">
                            <label for="recipientName" class="form-label">Tên người nhận:</label>
                            <input type="text" class="form-control" id="recipientName" name="recipient_name"
                                   placeholder="Nhập tên người nhận..." required>
                        </div>

                        <!-- Số điện thoại -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại:</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                   placeholder="Nhập số điện thoại..." pattern="[0-9]{10,11}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="Nhập email..." required>
                        </div>

                        <!-- Địa chỉ -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ:</label>
                            <textarea class="form-control" id="address" name="address" rows="3"
                                      placeholder="Nhập địa chỉ giao hàng..." required></textarea>
                        </div>

                        <!-- Ghi chú -->
                        <div class="mb-3">
                            <label for="note" class="form-label">Ghi chú:</label>
                            <textarea class="form-control" id="note" name="note" rows="3"
                                      placeholder="Nhập ghi chú (nếu có)..."></textarea>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <div class="mb-4">
                            <label class="form-label">Phương thức thanh toán:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="bankTransfer"
                                       value="chuyen_khoan" required>
                                <label class="form-check-label" for="bankTransfer">Chuyển khoản</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="cashOnDelivery"
                                       value="nhan_hang">
                                <label class="form-check-label" for="cashOnDelivery">Thanh toán khi nhận hàng</label>
                            </div>
                        </div>

                        <!-- Tổng tiền hiển thị -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Tổng tiền:</span>
                                <span class="text-success fw-bold"><?= number_format($total_price, 0, ',', '.') ?> VNĐ</span>
                            </div>
                        </div>

                        <!-- Nút Thanh Toán -->
                        <button type="submit" name="checkout" class="btn btn-success w-100">
                            Thanh Toán
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function deleteSp(productId) {
            if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                fetch("?act=xoaSP", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `action=remove&product_id=${productId}`,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            // Remove the deleted row
                            document.getElementById(productId).closest("tr").remove();

                            // Update the total price dynamically
                            const totalElement = document.querySelector(".fw-bold.text-success");
                            if (data.total_price) {
                                totalElement.textContent = `${new Intl.NumberFormat("vi-VN").format(data.total_price)} VNĐ`;
                            }
                        } else {
                            alert("Không thể xóa sản phẩm. Vui lòng thử lại.");
                        }
                    })

                    // .catch((error) => {
                    //     console.error("Error:", error);
                    //     alert("Đã xảy ra lỗi. Vui lòng thử lại.");
                    // });
            }
        }

    </script>


<?php
	include "./views/footer.php";
?>