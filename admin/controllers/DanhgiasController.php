<?php

class DanhgiasController
{
    public $modelDanhgia;
    public function __construct() {
        $this->modelDanhgia = new Danhgia();
    }
    public function index()
    {
        $danh_gias = null;

        if (isset($_GET['search'])) {
            $danh_gias = $this->modelDanhgia->getBySearch($_GET['search']);
        } else {
            $danh_gias = $this->modelDanhgia->getAll();
        }

        // dua du lieu ra view
        require_once './views/danhgia/list.php';
    }
    public function create(){
        $sp = $this->modelDanhgia->getCategory();
        require_once './views/danhgia/create.php';
    }

    // ham xu ly them vao CSDL
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Vietnam
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // lay ra du lieu
            $san_pham_id = $_POST['san_pham_id'];
            $nguoi_dung_id = $_POST['nguoi_dung_id'];
            $so_sao = $_POST['so_sao'];
            $noi_dung = $_POST['noi_dung'];
            $trang_thai = $_POST['trang_thai'];
            $ngay_danh_gia = isset($_POST['ngay_danh_gia']) ? $_POST['ngay_danh_gia'] : date('Y-m-d H:i:s'); 

            $errors = [];
            if (empty($san_pham_id)) {
                $errors['san_pham_id'] = "Tên sản phẩm là bắt buộc";
            }
            if (empty($nguoi_dung_id)) {
                $errors['nguoi_dung_id'] = "Giá sản phẩm là bắt buộc";
            }
            if (empty($so_sao)) {
                $errors['so_sao'] = "Giá nhập là bắt buộc";
            }
            if (empty($noi_dung)) {
                $errors['noi_dung'] = "Giá nhập là bắt buộc";
            }
            if (empty($errors)) {
                $this->modelDanhgia->postData($san_pham_id, $nguoi_dung_id, $so_sao, $noi_dung,$ngay_danh_gia,$trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=danhgia/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=danhgia/create');
                exit();
            }
        }
    }
    public function edit()
    {
        // lay id
        $id = $_GET['id'];
        // lay thong tin chi tiet cua danh muc
        $danh_gia = $this->modelDanhgia->getDetailData($id);

        $sp = $this->modelDanhgia->getCategory();

        // do du lieu ra form
        require_once './views/danhgia/edit.php';
    }
    

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $id = $_GET['id'];
            $trang_thai = $_POST['trang_thai'];
            $danh_gia_id = $_POST['id'];
            $san_pham_id = $this->modelDanhgia->getProductIdByDanhgiaId($danh_gia_id);
            $errors = [];
            
            // Cập nhật dữ liệu nếu không có lỗi
            if (empty($errors)) {
                $this->modelDanhgia->updateData($id, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=sanpham/chitiet&id=' .$san_pham_id);
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=danhgia/edit&id=' . $id);
                exit();
            }
        } else {
            // Xử lý nếu phương thức không phải là POST
        }
    }


    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $danh_gia_id = $_POST['id']; // ID của đánh giá
            
            // Lấy ID sản phẩm từ đánh giá trước khi xóa
            $san_pham_id = $this->modelDanhgia->getProductIdByDanhgiaId($danh_gia_id);
            
            // Xóa đánh giá
            $this->modelDanhgia->deleteData($danh_gia_id);
            
            // Điều hướng về trang chi tiết sản phẩm
            if ($san_pham_id) {
                header('Location: ?act=sanpham/chitiet&id=' . $san_pham_id);
            } else {
                // Trường hợp không lấy được sản phẩm, điều hướng về danh sách sản phẩm hoặc trang lỗi
                header('Location: act=sanpham/list');
            }
            exit();
        }
    }
}