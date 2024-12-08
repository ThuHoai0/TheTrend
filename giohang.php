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

if (isset($_SESSION['order_success']) && $_SESSION['order_success'] == true) {
    // Hiển thị thông báo đặt hàng thành công
    echo "<div class='alert alert-success text-center'>Đặt hàng thành công! Cảm ơn bạn đã mua hàng.</div>";

    // Sau khi hiển thị thông báo, bạn có thể reset lại session success
    unset($_SESSION['order_success']);
} elseif (isset($_SESSION['order_error'])) {
    // Hiển thị thông báo lỗi nếu có
    echo "<div class='alert alert-danger text-center'>{$_SESSION['order_error']}</div>";
    unset($_SESSION['order_error']);
}


// Check if the user is logged in
if (!isset($_SESSION['iduser'])) {
    // If not logged in, show login prompt
    echo "<p class='text-center text-warning' style='margin: 153px 0'>Vui lòng <a href='?act=dangnhap'>đăng nhập</a> để xem giỏ hàng.</p>";

} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['act']) && $_GET['act'] === 'removeFromCart') {
        header('Content-Type: application/json'); // Đảm bảo trả về JSON

        // Lấy dữ liệu từ client
        $input = json_decode(file_get_contents('php://input'), true);
        $productId = $input['productId'] ?? null;

        // Kiểm tra nếu sản phẩm tồn tại trong giỏ hàng
        if ($productId !== null && isset($_SESSION['cart'][$productId])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($_SESSION['cart'][$productId]);

            // Tính lại tổng tiền sau khi xóa sản phẩm
            $totalPrice = 0;
            foreach ($_SESSION['cart'] as $item) {
                $totalPrice += $item['product_price'] * $item['quantity'];
            }

            // Trả về kết quả JSON
            echo json_encode([
                'success' => true,
                'totalPrice' => $totalPrice,
                'cart' => $_SESSION['cart']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm trong giỏ hàng.'
            ]);
        }
        exit;
    }
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
                    <form action="?act=removeFromCart" method="POST" id="removeProductForm">
                        <input type="hidden" id="productId" name="productId" value="">
                    </form>
                    <form action="?act=updateCart" method="POST" id="cart-form">
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
                                        <tr id="product-<?= $item['product_id'] ?>">
                                            <td><img src="<?= $item['product_image'] ?>" alt="IMG" class="img-thumbnail" style="max-width: 80px;"></td>
                                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                                            <td id="price-<?= $item['product_id'] ?>"><?= number_format($item['product_price'], 0, ',', '.') ?> VNĐ</td>
                                            <td>
                                                <input type="number" name="quantity[<?= $item['product_id'] ?>]"
                                                       value="<?= $item['quantity'] ?>" class="form-control quantity-input"
                                                       id="quantity-<?= $item['product_id'] ?>"
                                                       data-product-id="<?= $item['product_id'] ?>"
                                                       min="1" max="<?= $item['total_products'] ?>" onkeydown="return false;"
                                                       onchange="numberOfProductsChange(this.value, <?= $item['product_id'] ?>)"/>
                                            </td>
                                            <td>
                        <span class="total-price" id="total-price-<?= $item['product_id'] ?>">
                            <?= number_format($subtotal, 0, ',', '.') ?> VNĐ
                        </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn-danger js-delete-btn"
                                                        name="delete_item[<?= $item['product_id'] ?>]"
                                                        value="1" onclick="deleteItem('<?= $item['product_id'] ?>')">
                                                    <i class="fas fa-trash"></i> <!-- Icon xóa -->
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tổng tiền -->
                        <div class="text-end">
                            <p><strong>Tổng Tiền: </strong><span id="total-price"><?= number_format($total_price, 0, ',', '.') ?> VNĐ</span></p>
                        </div>

                        <!-- Nút Thanh toán -->
                        <div class="cart-action-buttons">
                            <a href="?act=dathang" class="btn btn-secondary">Thanh Toán</a>
                        </div>
                    </form>

                    <!-- JavaScript để tự động tính toán thành tiền và tổng tiền -->
                    <script>
                        // Hàm xóa sản phẩm khỏi giỏ
                        function deleteItem(productId) {
                            const isConfirmed = confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?");
                            if (isConfirmed) {
                                document.getElementById('productId').value = productId;
                                document.getElementById('removeProductForm').submit();
                            }
                        }

                        const quantityInputs = document.querySelectorAll('.quantity-input');
                        quantityInputs.forEach(input => {
                            input.addEventListener('input', updateCart);
                        });

                        function updateCart() {
                            let totalPrice = 0;
                            const quantityInputs = document.querySelectorAll('.quantity-input');
                            quantityInputs.forEach(input => {
                                const productId = input.getAttribute('data-product-id');
                                const quantity = parseInt(input.value);
                                const price = parseInt(document.getElementById('price-' + productId).innerText.replace(/[^\d]/g, ''));
                                const subtotal = quantity * price;
                                document.getElementById('total-price-' + productId).innerText =
                                    new Intl.NumberFormat().format(subtotal) + ' VNĐ';
                                totalPrice += subtotal;
                            });

                            document.getElementById('total-price').innerText =
                                new Intl.NumberFormat().format(totalPrice) + ' VNĐ';
                        }
                        updateCart();

                        function numberOfProductsChange(value, productId) {
                            $.ajax({
                                url: "?act=updateProductQuantity",
                                method: 'POST',
                                data: {productQuantity: value, productId: productId},
                                success: function(response) {
                                    const data = JSON.parse(response);
                                    if (!data.status) {
                                        alert(data.message);
                                        window.location.reload();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error("Error: " + error);
                                }
                            });
                        }
                    </script>
                </div>
            </div>

        <?php } ?>
    </div>
    <?php
}
?>

<?php
	include "./views/footer.php";
?>