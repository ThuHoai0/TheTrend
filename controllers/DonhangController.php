<?php
class DonhangController {
    private $modelDonhang;

    public function __construct() {
        $this->modelDonhang = new Donhang();
    }

    public function listOrders() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (isset($_SESSION['iduser'])) {
            $userId = $_SESSION['iduser'];  // Lấy ID người dùng từ session
            // Gọi model để lấy danh sách đơn hàng
            $orders = $this->modelDonhang->getAllDH($userId);
            include './donhang.php';  // Bao gồm trang hiển thị danh sách đơn hàng
        } else {
            header('Location: login.php');  // Nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
            exit();
        }
    }
    
    // Kiểm tra xem người dùng đã đăng nhập chưa
    public function ctdonhang() {
        // Kiểm tra xem session đã được khởi tạo chưa, nếu chưa thì khởi tạo
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (isset($_SESSION['iduser'])) {
            $userId = $_SESSION['iduser']; // Lấy id người dùng từ session

            // Kiểm tra và lấy 'don_hang_id' từ URL
            if (isset($_GET['don_hang_id']) && !empty($_GET['don_hang_id'])) {
                $don_hang_id = $_GET['don_hang_id']; // Lấy giá trị từ tham số 'don_hang_id' trên URL

                // Gọi phương thức getOrderDetailsByDonHangId() từ model để lấy chi tiết đơn hàng
                $orderDetails = $this->modelDonhang->getOrderDetailsByDonHangId($don_hang_id);

                // Kiểm tra nếu có dữ liệu đơn hàng
                if ($orderDetails) {
                    // Nếu có đơn hàng, bao gồm trang hiển thị chi tiết đơn hàng
                    include './ctdonhang.php'; // Trang hiển thị chi tiết đơn hàng
                } else {
                    // Nếu không tìm thấy đơn hàng, thông báo lỗi
                    echo "Không tìm thấy đơn hàng với ID: " . htmlspecialchars($don_hang_id);
                }
            } else {
                // Nếu không có tham số 'don_hang_id' hợp lệ trong URL, thông báo lỗi
                echo "ID đơn hàng không hợp lệ.";
            }
        } else {
            // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: ?act=dn');
            exit();
        }
    }

    // Hủy đơn hàng
    public function huyDonHang() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            if (isset($_SESSION['iduser'])) {
                // Lấy id từ POST (thay vì ma_don_hang)
                $id = $_POST['id'];
    
                // Gọi phương thức xóa đơn hàng trong model, truyền vào id
                $result = $this->modelDonhang->xoaDonHangTheoId($id);
                
                if ($result) {
                    $_SESSION['message'] = 'Đơn hàng đã được xóa thành công!';
                } else {
                    $_SESSION['error'] = 'Không thể xóa đơn hàng này!';
                }
            } else {
                $_SESSION['error'] = 'Vui lòng đăng nhập để thực hiện thao tác này!';
            }
    
            // Quay lại trang danh sách đơn hàng
            header('Location: ?act=donhang');
            exit();
        }
    }    
}
