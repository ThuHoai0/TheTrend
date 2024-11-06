<?php

class DanhmucsController
{
    // ham ket noi den Model
    public $modelDanhmuc;

    public function __construct()
    {
        $this->modelDanhmuc = new Danhmuc();
    }

    // ham hien thi danh sach
    public function index()
    {
        // lay ra toan bo danh muc
        $danh_mucs = $this->modelDanhmuc->getAll();
        // var_dump($danh_mucs);

        // dua du lieu ra view
        require_once './views/danhmuc/list.php';
    }

    // ham hien thi form them danh muc  public function create()
    public function create(){
        require_once './views/danhmuc/create.php';
    }

    // ham xu ly them vao CSDL
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay ra du lieu
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $ngay_tao = $_POST['ngay_tao'];
            $trang_thai = $_POST['trang_thai'];

            // validate
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = "Tên danh mục là bắt buộc";
            }
            if (empty($ngay_tao)) {
                $errors['ngay_tao'] = "Ngày tạo là bắt buộc";
            }
            if (empty($trang_thai)) {
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
        } else {

        }
    }

    // Ham hien thi form sua
    public function edit()
    {
        // lay id
        $id = $_GET['danhmuc_id'];
        // lay thong tin chi tiet cua danh muc
        $danh_muc = $this->modelDanhmuc->getDetailData($id);

        // do du lieu ra form
        require_once './views/danhmuc/edit.php';
    }

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay ra du lieu
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $ngay_tao = $_POST['ngay_tao'];
            $trang_thai = $_POST['trang_thai'];

            // die($category_status  );
            // validate
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = "Tên danh mục là bắt buộc";
            }
            if (empty($ngay_tao)) {
                $errors['ngay_tao'] = "Ngày tạo là bắt buộc";
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = "Trạng thái tạo là bắt buộc";
            }

            // Cap nhat du lieu
            if (empty($errors)) {
                // Neu khong co loi thi them du lieu
                // Them vao CSDL
                $this->modelDanhmuc->updateData($id, $ten_danh_muc, $mo_ta, $ngay_tao, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=danhmuc/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=danhmuc/edit/' . $id);
                exit();
            }
        } else {

        }
    }

//   Ham xoa du lieu trong CSDL
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['danhmuc_id'];
            $this->modelDanhmuc->deleteData($id);
            header('Location: ?act=danhmuc/list');
            exit();
        }
    }

    public function search() {
        // Lấy từ khóa từ yêu cầu AJAX
        $keyword = isset($_GET['query']) ? $_GET['query'] : '';

        // Lấy kết quả từ model
        $results = $this->modelDanhmuc->searchDanhMuc($keyword);

        // Trả về kết quả dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($results);
    }

}


