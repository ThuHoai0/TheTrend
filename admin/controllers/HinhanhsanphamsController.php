<?php

class HinhanhsanphamsController
{
    // ham ket noi den Model
    public $modelHinhanhsanpham;

    public $modelDanhmuc;

    public function __construct()
    {
        $this->modelHinhanhsanpham = new Hinhanhsanpham();
        $this->modelDanhmuc = new Danhmuc();
    }

    // ham hien thi danh sach
    public function index()
    {
        $hinh_anh_san_phams = null;

        if (isset($_GET['search'])) {
            $hinh_anh_san_phams = $this->modelHinhanhsanpham->getBySearch($_GET['search']);
        } else {
            $hinh_anh_san_phams = $this->modelHinhanhsanpham->getAll();
        }
        require_once './views/hinhanhsanpham/list.php';
    }

    public function chitiet()
    {
        $id = $_GET['id'];

        $hinh_anh_san_pham = $this->modelHinhanhsanpham->getDetailData($id);

        require_once './views/hinhanhsanpham/chitiet.php';
    }

    // ham hien thi form them danh muc  public function create()
    public function create(){
        require_once './views/hinhanhsanpham/create.php';
    }

    // ham xu ly them vao CSDL
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Vietnam
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // lay ra du lieu
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $ngay_tao = isset($_POST['ngay_tao']) ? $_POST['ngay_tao'] : date('Y-m-d H:i:s'); // Use current date & time in Vietnam
            $trang_thai = $_POST['trang_thai'];

            // validate
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = "Tên danh mục là bắt buộc";
            }

            if (empty($trang_thai) && $trang_thai != 0) {
                $errors['trang_thai'] = "Trạng thái tạo là bắt buộc";
            }

            // them du lieu
            if (empty($errors)) {
                // neu khong co loi thi them du lieu
                // them vao CSDL
                $this->modelDanhmuc->postData($ten_danh_muc, $mo_ta, $ngay_tao, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=danhmuc/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=danhmuc/create');
                exit();
            }
        }
    }



    // Ham hien thi form sua
    public function edit()
    {
        // lay id
        $id = $_GET['id'];
        // lay thong tin chi tiet cua danh muc
        $hinh_anh_san_pham = $this->modelHinhanhsanpham->getDetailData($id);

        // do du lieu ra form
        require_once './views/hinhanhsanpham/edit.php';
    }

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay ra du lieu
            $id = $_GET['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];

            // die($category_status  );
            // validate
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = "Tên danh mục là bắt buộc";
            }

            // Cap nhat du lieu
            if (empty($errors)) {
                // Neu khong co loi thi them du lieu
                // Them vao CSDL
                $this->modelDanhmuc->updateData($id, $ten_danh_muc, $mo_ta, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=danhmuc/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=danhmuc/edit&id=' . $id);
                exit();
            }
        } else {

        }
    }

//   Ham xoa du lieu trong CSDL
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelHinhanhsanpham->deleteData($id);
            header('Location: ?act=hinhanhsanpham/list');
            exit();
        }
    }


}