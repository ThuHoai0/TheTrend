<?php 
	include"./views/header.php";
?>

    <style>
        .text-end {
            display: flex;
            justify-content: flex-end; /* Căn phải nội dung trong div */
            margin-bottom: 1rem; /* Điều chỉnh khoảng cách dưới */
        }
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Container */
        .container-fluid {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        /* Table Styles */
        .table-shopping-cart {
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-shopping-cart thead {
            background-color: #f1f1f1;
        }

        .table-shopping-cart th {
            font-weight: 600;
            color: #555;
            text-align: center;
            padding: 10px;
        }

        .table-shopping-cart td {
            padding: 10px;
            vertical-align: middle;
        }

        .table-shopping-cart tr:hover {
            background-color: #fafafa;
        }

        .table-shopping-cart .form-control {
            width: 70px;
            margin: 0 auto;
        }

        .table-shopping-cart .btn-danger {
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 50%;
        }

        .table-shopping-cart .js-delete-btn i {
            color: #fff;
        }

        /* Price Section */
        .table-shopping-cart .text-success {
            font-size: 1.2em;
            font-weight: 600;
            color: #28a745;
        }

        .text-center {
            text-align: center;
        }

        /* Cart Action Buttons */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Discount Code Section */
        #discountCode {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1rem;
            width: 300px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }

        /* Order Info Section */
        .border {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 30px;
            background-color: #fff;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            width: 100%;
        }

        textarea.form-control {
            height: 100px;
            resize: none;
        }

        /* Radio Button Styles */
        .form-check-input {
            width: 20px;
            height: 20px;
        }

        .form-check-label {
            font-size: 1rem;
            color: #333;
        }

        /* Payment Section */
        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Checkout Button */
        .btn-success.w-100 {
            background-color: #28a745;
            border-color: #28a745;
            padding: 15px;
            font-size: 1.1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-success.w-100:hover {
            background-color: #218838;
            border-color: #218838;
        }


    </style>
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
<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['iduser'])) {
    // If not logged in, show login prompt
    echo "<p class='text-center text-warning' style='margin: 153px 0'>Vui lòng <a href='?act=dangnhap'>đăng nhập</a> để xem giỏ hàng.</p>";
} else {
    ?>
    <div class="container-fluid mt-5 mb-5">
        <!-- Danh sách sản phẩm trong giỏ hàng -->
        <?php
        // Kiểm tra nếu giỏ hàng trống
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo "<p class='text-center text-danger' style='margin: 153px 0'>Giỏ hàng của bạn đang trống!</p>";
        } else {
            ?>
            <div class="col-12 col-lg-12 full-screen m-lr-auto m-b-50 mb-4">
                <div class="m-l-25 m-r--38 m-lr-0-xl pr-5">
                    <form action="?act=updateCart" method="POST">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart table table-bordered text-center align-middle mb-4 table-striped shadow-sm rounded">
                                <thead class="table-light">
                                <tr>
                                    <th class="text-center">Ảnh</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Số Lượng</th>
                                    <th class="text-center">Thành Tiền</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $total_price = 0;
                                $unique_products = []; // Mảng lưu các sản phẩm duy nhất

                                // Lặp qua giỏ hàng
                                foreach ($_SESSION['cart'] as $key => $item) {
                                    // Tính tổng tiền cho từng sản phẩm
                                    $subtotal = $item['product_price'] * $item['quantity'];
                                    $total_price += $subtotal;

                                    // Kiểm tra nếu sản phẩm đã được tính trong giỏ hàng
                                    if (!isset($unique_products[$item['product_id']])) {
                                        $unique_products[$item['product_id']] = $item;
                                        ?>
                                        <tr>
                                            <td><img src="<?= htmlspecialchars($item['product_image']) ?>" alt="IMG" class="img-thumbnail" style="max-width: 80px;"></td>
                                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                                            <td><?= number_format($item['product_price'], 0, ',', '.') ?> VNĐ</td>
                                            <td>
                                                <input type="number" name="quantity[<?= $item['product_id'] ?>]" value="<?= $item['quantity'] ?>" min="1" max="99" class="form-control text-center">
                                            </td>
                                            <td><?= number_format($subtotal, 0, ',', '.') ?> VNĐ</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm js-delete-btn" onclick="deleteSp(<?= $item['product_id'] ?>)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                // Cập nhật số sản phẩm trong giỏ
                                $_SESSION['unique_products_count'] = count($unique_products);
                                ?>
                                </tbody>

                                <!-- Hiển thị số sản phẩm trong giỏ -->
                                <div class="cart-count">
                                    Tổng số sản phẩm: <span id="cart-item-count"><?= count($unique_products) ?></span>
                                </div>

                                <tfoot>
                                <tr class="text-center">
                                    <td colspan="3" class="fw-bold">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col-md-8">
                                                <input type="text" id="discountCode" name="discountCode" class="form-control" placeholder="Nhập mã ở đây">
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-success w-100">Áp dụng mã</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="2" class="fw-bold pt-4">Tổng tiền:</td>
                                    <td colspan="2" class="text-success fw-bold pt-4">
                                        <?= number_format($total_price, 0, ',', '.') ?> VNĐ
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="text-end mb-3 pr-5">
                                <button type="submit" class="btn btn-primary">Cập nhật giỏ hàng</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <hr>
            <!-- Thông tin đặt hàng -->
            <form class="col-12 col-lg-12 full-screen m-lr-auto m-b-50 mb-4" method="post" action="?act=themdonhang">
                <div class="border rounded p-5">
                    <h2 class="mb-4 text-center">Thông tin đặt hàng</h2>

                    <!-- Tên người nhận -->
                    <div class="mb-3">
                        <label for="ho_ten_nguoi_nhan" class="form-label">Tên người nhận:</label>
                        <input type="text" class="form-control" id="ho_ten_nguoi_nhan" name="ho_ten_nguoi_nhan"
                               placeholder="Nhập tên người nhận..." required>
                    </div>

                    <!-- Số điện thoại -->
                    <div class="mb-3">
                        <label for="so_dien_thoai_nguoi_nhan" class="form-label">Số điện thoại:</label>
                        <input type="tel" class="form-control" id="so_dien_thoai_nguoi_nhan" name="so_dien_thoai_nguoi_nhan"
                               placeholder="Nhập số điện thoại..." pattern="[0-9]{10,11}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email_nguoi_nhan" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email_nguoi_nhan" name="email_nguoi_nhan"
                               placeholder="Nhập email..." required>
                    </div>

                    <!-- Địa chỉ -->
                    <div class="mb-3">
                        <label for="dia_chi_nhan_hang" class="form-label">Địa chỉ:</label>
                        <textarea class="form-control" id="dia_chi_nhan_hang" name="dia_chi_nhan_hang" rows="3"
                                  placeholder="Nhập địa chỉ giao hàng..." required></textarea>
                    </div>

                    <!-- Ghi chú -->
                    <div class="mb-3">
                        <label for="ghi_chu" class="form-label">Ghi chú:</label>
                        <textarea class="form-control" id="ghi_chu" name="ghi_chu" rows="3"
                                  placeholder="Nhập ghi chú (nếu có)..."></textarea>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <div class="mb-4 ">
                        <label class="form-label">Phương thức thanh toán:</label>
                        <div class="form-check pl-5">
                            <input class="form-check-input" type="radio" name="phuong_thuc_thanh_toan" id="bankTransfer"
                                   value="1" required>
                            <label class="form-check-label" for="bankTransfer">Chuyển khoản</label>
                        </div>
                        <div class="form-check pl-5">
                            <input class="form-check-input" type="radio" name="phuong_thuc_thanh_toan" id="cashOnDelivery"
                                   value="0">
                            <label class="form-check-label" for="cashOnDelivery">Thanh toán khi nhận hàng</label>
                        </div>
                    </div>

                    <!-- Tổng tiền hiển thị -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Tổng tiền:</span>
                            <span >
                                <input type="hidden" class="text-success fw-bold" id="totalPrice" name="tong_tien" value="<?= $total_price ?>">
                                <?= isset($total_price) && $total_price > 0 ? number_format($total_price, 0, ',', '.') . ' VNĐ' : '0 VNĐ' ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Nút xác nhận đặt hàng -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success w-100">Đặt hàng</button>
                </div>
            </form>

        <?php } ?>
    </div>


    <?php
}
?>


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
                            document.getElementById(productId).closest("tr").remove();
                            const totalElement = document.querySelector(".fw-bold.text-success");
                            if (data.total_price) {
                                totalElement.textContent = `${new Intl.NumberFormat("vi-VN").format(data.total_price)} VNĐ`;
                            }
                            // Tải lại trang sau khi xóa
                        } else {
                            alert("Không thể xóa sản phẩm. Vui lòng thử lại.");
                        }
                    })

                .catch((error) => {
                    console.error("Error:", error);
                    alert("Đã xảy ra lỗi. Vui lòng thử lại.");
                    location.reload();
                });
            }
        }



    </script>


<?php
	include "./views/footer.php";
?>