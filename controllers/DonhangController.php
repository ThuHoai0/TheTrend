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
        // Khởi tạo session nếu chưa có
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Kiểm tra người dùng đã đăng nhập
        if (isset($_SESSION['iduser'])) {
            $userId = $_SESSION['iduser']; // ID người dùng từ session
    
            // Kiểm tra và lấy `don_hang_id` từ URL
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $don_hang_id = $_GET['id']; // Giá trị từ tham số `id` trên URL
    
                // Lấy thông tin đơn hàng từ model
                $orderDetails = $this->modelDonhang->getOrderDetailsByDonHangId($don_hang_id);
                // Kiểm tra nếu có dữ liệu đơn hàng
                if ($orderDetails) {
                    // Truyền dữ liệu sang giao diện
                    $don_hang = $orderDetails[0]; // Thông tin đơn hàng (dòng đầu tiên)
                    $san_pham = $orderDetails;   // Chi tiết sản phẩm
                    require_once './ctdonhang.php'; // Trang hiển thị chi tiết đơn hàng
                } else {
                    echo "Không tìm thấy đơn hàng với ID: " . htmlspecialchars($don_hang_id);
                }
            } else {
                echo "ID đơn hàng không hợp lệ.";
            }
        } else {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: ?act=dn');
            exit();
        }
    }
    

    // Hủy đơn hàng
//    public function huyDonHang() {
//        // Kiểm tra phương thức request
//        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            session_start();
//
//            // Kiểm tra người dùng đã đăng nhập chưa
//            if (isset($_SESSION['iduser'])) {
//                // Lấy ID đơn hàng từ request POST
//                $id = $_POST['id'];
//
//                // Kiểm tra ID có hợp lệ không
//                if (empty($id)) {
//                    $_SESSION['error'] = 'ID đơn hàng không hợp lệ!';
//                    header('Location: ?act=donhang');
//                    exit();
//                }
//
//                // Lấy thông tin đơn hàng từ Model
//                $order = $this->modelDonhang->getOrderById($id);
//
//                // Kiểm tra đơn hàng tồn tại và trạng thái cho phép hủy
//                if ($order && in_array($order['trang_thai_id'], [11, 12])) { // 11: Đã đặt hàng, 12: Đang xử lý
//                    // Thực hiện xóa đơn hàng
//                    $result = $this->modelDonhang->xoaDonHangTheoId($id);
//
//                    if ($result) {
//                        $_SESSION['message'] = 'Đơn hàng đã được hủy thành công!';
//                    } else {
//                        $_SESSION['error'] = 'Không thể hủy đơn hàng! Vui lòng thử lại.';
//                    }
//                } else {
//                    $_SESSION['error'] = 'Đơn hàng không tồn tại hoặc không thể hủy. Chỉ có thể hủy đơn hàng ở trạng thái "Đã đặt hàng" hoặc "Đang xử lý".';
//                }
//            } else {
//                $_SESSION['error'] = 'Vui lòng đăng nhập để thực hiện thao tác này!';
//            }
//
//            // Quay lại trang danh sách đơn hàng
//            header('Location: ?act=donhang');
//            exit();
//        }
//    }

    public function huyDonHang() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            // Kiểm tra người dùng đã đăng nhập chưa
            if (isset($_SESSION['iduser'])) {
                $id = $_POST['id'];

                // Kiểm tra ID có hợp lệ không
                if (empty($id)) {
                    $_SESSION['error'] = 'ID đơn hàng không hợp lệ!';
                    header('Location: ?act=donhang');
                    exit();
                }

                // Lấy thông tin đơn hàng
                $order = $this->modelDonhang->getOrderById($id);
                if (!$order) {
                    $_SESSION['error'] = 'Đơn hàng không tồn tại!';
                    header('Location: ?act=donhang');
                    exit();
                }

                // Gọi phương thức xóa đơn hàng trong model
                $result = $this->modelDonhang->xoaDonHangTheoId($id);

                if ($result) {
                    $_SESSION['message'] = 'Đơn hàng và chi tiết đơn hàng đã được xóa thành công!';
                } else {
                    $_SESSION['error'] = 'Không thể xóa đơn hàng này! Vui lòng thử lại.';
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

