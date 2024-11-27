<?php require_once "./views/header.php"; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<body>
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 50px">
            <div class="col">
                <div class="h-100">
                    <div class="card" style="padding-bottom: 50px">
                        <div class="container mt-5">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h4 style="color:#fff">Quản lý danh sách đơn hàng | DH123456</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <span class="badge bg-success p-2">Đơn hàng: Đang xử lý</span>
                                        <span class="badge bg-primary text-white p-2">Phương thức thanh toán: Thanh toán khi nhận hàng</span>
                                        <span class="badge bg-warning text-dark p-2">Trạng thái thanh toán: Chưa Thanh Toán</span>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h5>Thông tin người đặt </h5>
                                            <p><strong>Tên:</strong> Nguyễn Văn A</p>
                                            <p><strong>Email:</strong> example@example.com</p>
                                            <p><strong>SĐT:</strong> 0123456789</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Thông tin người nhận</h5>
                                            <p><strong>Tên:</strong> Lê Thị B</p>
                                            <p><strong>Email:</strong> receiver@example.com</p>
                                            <p><strong>SĐT:</strong> 0987654321</p>
                                            <p><strong>Địa chỉ:</strong> 123 Đường ABC, Quận 1, TP.HCM</p>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead class="table-light">
                                            <tr>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Sản phẩm 1</td>
                                                <td>2</td>
                                                <td>200,000đ</td>
                                                <td>400,000đ</td>
                                            </tr>
                                            <tr>
                                                <td>Sản phẩm 2</td>
                                                <td>1</td>
                                                <td>150,000đ</td>
                                                <td>150,000đ</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4">
                                        <ul class="list-group w-50">
                                            <li class="list-group-item d-flex justify-content-between bg-light">
                                                <span>Tổng tiền:</span>
                                                <strong class="text-danger">550,000đ</strong>
                                            </li>
                                        </ul>
                                    </div>
                                    <br>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="button" class="btn btn-primary" onclick="history.back()">Trở Về</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card -->
                    </div> <!-- end card -->
                </div> <!-- end .h-100-->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

<!-- Link đến Bootstrap JS và Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
<?php require_once "./views/footer.php"; ?>

