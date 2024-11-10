<?php

class TrangthaidonhangsController
{
    // ham ket noi den Model
    public $modelTrangthaidonhang;

    public function __construct()
    {
        $this->modelTrangthaidonhang = new Trangthaidonhang();
    }

    // ham hien thi danh sach
    public function index()
    {
        // lay ra toan bo danh muc
        $trang_thai_don_hangs = $this->modelTrangthaidonhang->getAll();
        // var_dump($danh_mucs);

        // dua du lieu ra view
        require_once './views/trangthaidonhang/list.php';
    }

    // ham hien thi form them danh muc  public function create()
    public function create(){
        require_once './views/trangthaidonhang/create.php';
    }

    // ham xu ly them vao CSDL
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Vietnam
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // lay ra du lieu
            $ten_trang_thai = $_POST['ten_trang_thai'];
            $mo_ta = $_POST['mo_ta'];

            // validate
            $errors = [];
            if (empty($ten_trang_thai)) {
                $errors['ten_trang_thai'] = "Tên trạng thái là bắt buộc";
            }

            // them du lieu
            if (empty($errors)) {
                // neu khong co loi thi them du lieu
                // them vao CSDL
                $this->modelTrangthaidonhang->postData($ten_trang_thai, $mo_ta);
                unset($_SESSION['errors']);
                header('Location: ?act=trangthaidonhang/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=trangthaidonhang/create');
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
        $trang_thai_don_hang = $this->modelTrangthaidonhang->getDetailData($id);

        // do du lieu ra form
        require_once './views/trangthaidonhang/edit.php';
    }

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay ra du lieu
            $id = $_GET['id'];
            $ten_trang_thai = $_POST['ten_trang_thai'];
            $mo_ta = $_POST['mo_ta'];

            // die($category_status  );
            // validate
            $errors = [];
            if (empty($ten_trang_thai)) {
                $errors['ten_trang_thai'] = "Tên trạng thái là bắt buộc";
            }

            // Cap nhat du lieu
            if (empty($errors)) {
                // Neu khong co loi thi them du lieu
                // Them vao CSDL
                $this->modelTrangthaidonhang->updateData($id, $ten_trang_thai, $mo_ta);
                unset($_SESSION['errors']);
                header('Location: ?act=trangthaidonhang/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=trangthaidonhang/edit&id=' . $id);
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
            $this->modelTrangthaidonhang->deleteData($id);
            header('Location: ?act=trangthaidonhang/list');
            exit();
        }
    }

}


