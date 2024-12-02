<?php
include "./views/header.php";
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
    require_once 'Donhang.php';

// Tạo đối tượng Donhang
    $donhang = new Donhang();

// Giả sử bạn có don_hang_id
    $don_hang_id = $_GET['don_hang_id'] ?? 0;

// Tính và lưu tổng tiền
    if ($don_hang_id) {
        $_SESSION['cart_total_price'] = $donhang->getTongTienByDonHangId($don_hang_id);
    } else {
        $_SESSION['cart_total_price'] = 0;
    }

    ?>
    <div class="container-fluid mt-5 mb-5">
        <!-- Danh sách sản phẩm trong giỏ hàng -->
            <!-- Thông tin đặt hàng -->
        <form class="col-12 col-lg-12 full-screen m-lr-auto m-b-50 mb-4" method="post" action="?act=themdonhang">
            <div class="border rounded p-5">
                <h2 class="mb-4 text-center">Thông tin đặt hàng</h2>

                <!-- Tên người nhận -->
                <div class="mb-3">
                    <label for="ho_ten_nguoi_nhan" class="form-label">Tên người nhận:</label>
                    <input type="text" class="form-control" value="<?= $_SESSION['name'] ?>" id="ho_ten_nguoi_nhan" name="ho_ten_nguoi_nhan"
                           placeholder="Nhập tên người nhận..." required>
                </div>

                <!-- Số điện thoại -->
                <div class="mb-3">
                    <label for="so_dien_thoai_nguoi_nhan" class="form-label">Số điện thoại:</label>
                    <input type="tel" class="form-control" value="<?= $_SESSION['so_dien_thoai'] ?>" id="so_dien_thoai_nguoi_nhan" name="so_dien_thoai_nguoi_nhan"
                           placeholder="Nhập số điện thoại..." pattern="[0-9]{10,11}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email_nguoi_nhan" class="form-label">Email:</label>
                    <input type="email" class="form-control" value="<?= $_SESSION['email'] ?>" id="email_nguoi_nhan" name="email_nguoi_nhan"
                           placeholder="Nhập email..." required>
                </div>

                <!-- Địa chỉ nhận hàng -->
                <div class="mb-3">
                    <label for="dia_chi_nhan_hang" class="form-label">Địa chỉ nhận hàng:</label>
                    <textarea class="form-control" id="dia_chi_nhan_hang" name="dia_chi_nhan_hang" rows="3"
                              placeholder="Nhập địa chỉ nhận hàng..." required><?= isset($_SESSION['dia_chi']) ? $_SESSION['dia_chi'] : '' ?></textarea>
                </div>

                <!-- Ghi chú -->
                <div class="mb-3">
                    <label for="ghi_chu" class="form-label">Ghi chú (nếu có):</label>
                    <textarea class="form-control" id="ghi_chu" name="ghi_chu" rows="3" placeholder="Nhập ghi chú về đơn hàng..."></textarea>
                </div>

                <!-- Phương thức thanh toán -->
                <div class="mb-3">
                    <label for="phuong_thuc_thanh_toan" class="form-label">Phương thức thanh toán:</label>
                    <div class="d-flex align-items-center">
                        <input type="radio" id="trang_thai_thanh_toan" name="trang_thai_thanh_toan" checked class="form-check-input">
                        <label for="trang_thai_thanh_toan" class="ms-2">Thanh toán khi nhận hàng</label>
                    </div>
                </div>

                <!-- Tổng tiền -->
                <div class="mb-3">
                    <p><strong>Tổng tiền đơn hàng: </strong><?= number_format($_SESSION['cart_total_price'], 0, ',', '.') ?> VNĐ</p>
                </div>

                <!-- Nút gửi đơn hàng -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Xác nhận đặt hàng</button>
                </div>
            </div>
        </form>


        <?php } ?>
    </div>



    <script>
        // function deleteSp(productId) {
        //     if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
        //         fetch("?act=xoaSP", {
        //             method: "POST",
        //             headers: {
        //                 "Content-Type": "application/x-www-form-urlencoded",
        //             },
        //             body: `action=remove&product_id=${productId}`,
        //         })
        //             .then((response) => response.json())
        //             .then((data) => {
        //                 if (data.success) {
        //                     document.getElementById(productId).closest("tr").remove();
        //                     const totalElement = document.querySelector(".fw-bold.text-success");
        //                     if (data.total_price) {
        //                         totalElement.textContent = `${new Intl.NumberFormat("vi-VN").format(data.total_price)} VNĐ`;
        //                     }
        //                     // Tải lại trang sau khi xóa
        //                 } else {
        //                     alert("Không thể xóa sản phẩm. Vui lòng thử lại.");
        //                 }
        //             })
        //
        //             .catch((error) => {
        //                 console.error("Error:", error);
        //                 // alert("Đã xảy ra lỗi. Vui lòng thử lại.");
        //                 location.reload();
        //             });
        //     }
        // }



    </script>


<?php
include "./views/footer.php";
?>