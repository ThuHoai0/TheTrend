<?php
class ChitietsanphamController
{
    public $modelChitietsanpham;
    public function __construct() {
        $this->modelChitietsanpham = new Chitietsanpham();
    }
    public function chitietsanpham()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = intval($_GET['id']);
            $nguoiDungId = $_SESSION['iduser'] ?? null;

            // Lấy chi tiết sản phẩm
            $chi_tiet = $this->modelChitietsanpham->getDetailData($id);

            if ($chi_tiet) {
                $categoryId = $chi_tiet['danh_muc_id'];
                $san_pham_lien_quan = $this->modelChitietsanpham->getRelatedProducts($categoryId, $id);
                $hinh_anh_top2 = $this->modelChitietsanpham->getTopProductImages($id);
                $hinh_anh_goc = $chi_tiet['hinh_anh'];

                // Lấy danh sách đánh giá
                $danh_gias = $this->modelChitietsanpham->getDanhgiaBySanPhamId($id);

                // Lấy danh sách bình luận
                $binh_luan = $this->modelChitietsanpham->showbinhluan($id);

                // Kiểm tra người dùng đã mua hàng chưa
//                $hasPurchased = false;
//                if ($nguoiDungId) {
//                    $hasPurchased = $this->modelHome->hasPurchased($id, $nguoiDungId);
//                }
            } else {
                echo "Không tìm thấy thông tin sản phẩm.";
                $chi_tiet = false;
                $san_pham_lien_quan = [];
                $hinh_anh_top2 = [];
                $hinh_anh_goc = 'default.jpg';
                $danh_gias = [];
                $binh_luan = [];
                $hasPurchased = false;
            }
        } else {
            echo "ID sản phẩm không hợp lệ hoặc không được cung cấp.";
            $chi_tiet = false;
            $san_pham_lien_quan = [];
            $hinh_anh_top2 = [];
            $hinh_anh_goc = 'default.jpg';
            $danh_gias = [];
            $binh_luan = [];
            $hasPurchased = false;
        }
        require_once './chitietsanpham.php';
    }


    public function danhgia()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            // Thiết lập múi giờ
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // Lấy dữ liệu từ form và URL
            $sanPhamId = intval($_GET['id']); // ID sản phẩm
            $nguoiDungId = $_SESSION['iduser'] ?? null; // Lấy ID người dùng từ session (nếu đăng nhập)
            $soSao = $_POST['rating'] ?? null; // Số sao được chọn từ form
            $noiDung = $_POST['noi_dung'] ?? ''; // Nội dung đánh giá
            $ngayDanhGia = date('Y-m-d H:i:s'); // Ngày hiện tại
            $trangThai = 1; // Trạng thái hiển thị mặc định

            // Kiểm tra nếu người dùng đã đánh giá sản phẩm này
            if ($this->modelChitietsanpham->checkExistingReview($sanPhamId, $nguoiDungId)) {
                $_SESSION['errors'] = ['Bạn chỉ được đánh giá sản phẩm này một lần.'];
                header('Location: ?act=chitietsanpham&id=' . $sanPhamId);
                exit();
            }

            // Kiểm tra lỗi
            $errors = [];
            if (empty($soSao) || !is_numeric($soSao) || $soSao < 1 || $soSao > 5) {
                $errors['rating'] = "Bạn phải chọn số sao hợp lệ (1 đến 5).";
            }
            if (empty($noiDung)) {
                $errors['noi_dung'] = "Nội dung đánh giá không được để trống.";
            }

            // Nếu có lỗi, lưu lỗi vào session và điều hướng quay lại
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=chitietsanpham&id=' . $sanPhamId);
                exit();
            }

            // Thêm đánh giá vào database
            $this->modelChitietsanpham->addDanhgia($sanPhamId, $nguoiDungId, $soSao, $noiDung, $ngayDanhGia, $trangThai);

            // Lưu thông báo thành công
            $_SESSION['success'] = "Đánh giá của bạn đã được thêm thành công!";
            header('Location: ?act=chitietsanpham&id=' . $sanPhamId);
            exit();
        } else {
            // Điều hướng nếu không phải POST hoặc không có ID sản phẩm
            header('Location: ?act=home');
            exit();
        }
    }


    public function binhluan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['iduser'])) {
            // Lấy dữ liệu từ session
            $nguoiDungId = $_SESSION['iduser']; // ID người dùng từ session

            // Lấy dữ liệu từ form và URL
            $sanPhamId = $_GET['id'] ?? 0; // ID sản phẩm được truyền qua URL
            $noiDung = $_POST['noi_dung'] ?? ''; // Nội dung bình luận từ form

            // Kiểm tra dữ liệu
            $errors = [];
            if (empty($noiDung)) {
                $errors[] = "Nội dung bình luận không được để trống.";
            }
            if (empty($sanPhamId) || !is_numeric($sanPhamId)) {
                $errors[] = "ID sản phẩm không hợp lệ.";
            }

            // Nếu có lỗi, lưu lỗi vào session và điều hướng quay lại
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=chitietsanpham&id=' . $sanPhamId);
                exit();
            }
            // Thêm bình luận vào database
            $ngayBinhLuan = date('Y-m-d H:i:s');
            $trangThai = 1; // Trạng thái hiển thị mặc định

            $this->modelChitietsanpham->addReview($sanPhamId, $nguoiDungId, $noiDung, $ngayBinhLuan, $trangThai);

            // Điều hướng sau khi thêm bình luận thành công
            $_SESSION['success'] = "Bình luận của bạn đã được thêm thành công!";

            header('Location: ?act=chitietsanpham&id=' . $sanPhamId);
            exit();
        } else {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: ?act=dangnhap');
            exit();
        }
    }

    public function handleCartAjax() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['product_id'];
            $spajax = $this->modelChitietsanpham->sanphamajax($id);
            if(isset($_SESSION['cart'])){
                foreach ($_SESSION['cart'] as $item) {
                    if ($item['product_id'] == $id && $item['quantity'] >= $spajax['so_luong']) {
                        echo json_encode([
                            'status' => 'fix',
                        ]);
                        die;
                    }
                }

            }







            $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
            $product_name = isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : '';
            $product_price = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0;
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
            $product_image = $_POST['product_img'];
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            if ($product_id > 0 && $quantity > 0) {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                $product_found = false;
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['product_id'] == $product_id) {
                        $item['quantity'] += $quantity; // Tăng số lượng sản phẩm
                        $product_found = true;
                        break;
                    }
                }
                if (!$product_found) {
                    $_SESSION['cart'][] = [
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'product_price' => $product_price,
                        'quantity' => $quantity,
                        'product_image' => $product_image,
                    ];
                }

                // Tính tổng số lượng sản phẩm trong giỏ hàng
                $total_items = count($_SESSION['cart']);

                echo json_encode([
                    'status' => 'success',
                    'total_items' => $total_items,
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
            ]);
        }
        exit();
    }

    public function xoaSP()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'remove') {
            $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
            if ($product_id > 0 && isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $item) {
                    if ($item['product_id'] == $product_id) {
                        unset($_SESSION['cart'][$key]);
                        break;
                    }
                }
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
        }
        // Quay lại trang giỏ hàng
        header("Location: ?act=giohang");
        exit();
    }

//    public function getCartCount() {
//        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//            session_start(); // Đảm bảo session được khởi tạo
//
//            // Kiểm tra giỏ hàng đã có chưa
//            $unique_products = [];
//
//            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
//                foreach ($_SESSION['cart'] as $item) {
//                    $product_id = $item['product_id'];
//
//                    // Nếu sản phẩm chưa có trong giỏ hàng, thêm vào
//                    if (!isset($unique_products[$product_id])) {
//                        $unique_products[$product_id] = $item;
//                    } else {
//                        // Nếu đã có, cộng thêm số lượng vào
//                        $unique_products[$product_id]['quantity'] += $item['quantity'];
//                    }
//                }
//            }
//
//            // Trả về mảng sản phẩm duy nhất
//            echo json_encode([
//                'success' => true,
//                'unique_products' => array_values($unique_products) // Lấy giá trị của mảng sản phẩm duy nhất
//            ]);
//        } else {
//            echo json_encode(['success' => false]);
//        }
//        exit();
//    }


    public function updateCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
            foreach ($_POST['quantity'] as $product_id => $quantity) {
                $product_id = intval($product_id);
                $quantity = intval($quantity);
                if ($quantity > 0 && isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as &$item) {
                        if ($item['product_id'] == $product_id) {
                            $item['quantity'] = $quantity; // Update quantity
                            break;
                        }
                    }
                }
            }
        }
        // Redirect back to the cart page
        header("Location: ?act=giohang");
        exit();
    }





}