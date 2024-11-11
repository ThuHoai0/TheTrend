<?php

class TintucsController
{
    // ham ket noi den Model
    public $modelTintuc;

    public function __construct()
    {
        $this->modelTintuc = new Tintuc();
    }

    // ham hien thi danh sach


    public function index()
    {
        $tin_tucs = null;

        if (isset($_GET['search'])) {
            $tin_tucs = $this->modelTintuc->getBySearch($_GET['search']);
        } else {
            $tin_tucs = $this->modelTintuc->getAll();
        }



        // dua du lieu ra view
        require_once './views/tintuc/list.php';
    }

    // ham hien thi form them danh muc  public function create()
    public function create(){
        require_once './views/tintuc/create.php';
    }

    // ham xu ly them vao CSDL
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Vietnam
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // lay ra du lieu
            $tieu_de = $_POST['tieu_de'];
            $noi_dung = $_POST['noi_dung'];
            $ngay_tao = isset($_POST['ngay_tao']) ? $_POST['ngay_tao'] : date('Y-m-d H:i:s'); // Use current date & time in Vietnam
            $trang_thai = $_POST['trang_thai'];

            // validate
            $errors = [];
            if (empty($tieu_de)) {
                $errors['tieu_de'] = "Tên tiêu đề là bắt buộc";
            }

            // them du lieu
            if (empty($errors)) {
                // neu khong co loi thi them du lieu
                // them vao CSDL
                $this->modelTintuc->postData($tieu_de, $noi_dung, $ngay_tao, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=tintuc/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=tintuc/create');
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
        $tin_tuc = $this->modelTintuc->getDetailData($id);

        // do du lieu ra form
        require_once './views/tintuc/edit.php';
    }

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay ra du lieu
            $id = $_GET['id'];
            $tieu_de = $_POST['tieu_de'];
            $noi_dung = $_POST['noi_dung'];
            $trang_thai = $_POST['trang_thai'];

            // die($category_status  );
            // validate
            $errors = [];
            if (empty($tieu_de)) {
                $errors['tieu_de'] = "Tên tiêu đề là bắt buộc";
            }

            // Cap nhat du lieu
            if (empty($errors)) {
                // Neu khong co loi thi them du lieu
                // Them vao CSDL
                $this->modelTintuc->updateData($id, $tieu_de, $noi_dung, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=tintuc/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=tintuc/edit&id=' . $id);
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
            $this->modelTintuc->deleteData($id);
            header('Location: ?act=tintuc/list');
            exit();
        }
    }

    public function search() {
        // Lấy từ khóa từ yêu cầu AJAX
        $keyword = isset($_GET['query']) ? $_GET['query'] : '';

        // Lấy kết quả từ model
        $results = $this->modelTintuc->searchTinTuc($keyword);

        // Trả về kết quả dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($results);
    }

}


