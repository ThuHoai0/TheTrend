<?php

class LienhesController
{
    // ham ket noi den Model
    public $modelLienhe;

    public function __construct()
    {
        $this->modelLienhe = new Lienhe();
    }

    // ham hien thi danh sach
    public function index()
    {
        // lay ra toan bo lien he
        $lien_hes = $this->modelLienhe->getAll();


        // dua du lieu ra view
        require_once './views/lienhe/list.php';
    }

    // ham hien thi form them lien he  public function create()
    public function create(){
        require_once './views/lienhe/create.php';
    }

    // ham xu ly them vao CSDL
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Vietnam
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // lay ra du lieu
            $ten_lien_he = $_POST['ten_lien_he'];
            $mo_ta = $_POST['mo_ta'];
            $ngay_tao = isset($_POST['ngay_tao']) ? $_POST['ngay_tao'] : date('Y-m-d H:i:s'); // Use current date & time in Vietnam

            // validate
            $errors = [];
            if (empty($ten_lien_he)) {
                $errors['ten_lien_he'] = "Tên người liên hệ là bắt buộc";
            }


            // them du lieu
            if (empty($errors)) {
                // neu khong co loi thi them du lieu
                // them vao CSDL
                $this->modelLienhe->postData($ten_lien_he, $mo_ta, $ngay_tao);
                unset($_SESSION['errors']);
                header('Location: ?act=lienhe/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=lienhe/create');
                exit();
            }
        }
    }



    // Ham hien thi form sua
    public function edit()
    {
        // lay id
        $id = $_GET['id'];
        // lay thong tin chi tiet cua lien he
        $lien_he = $this->modelLienhe->getDetailData($id);

        // do du lieu ra form
        require_once './views/lienhe/edit.php';
    }

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay ra du lieu
            $id = $_GET['id'];
            $ten_lien_he = $_POST['ten_lien_he'];
            $mo_ta = $_POST['mo_ta'];


            // die($category_status  );
            // validate
            $errors = [];
            if (empty($ten_lien_he)) {
                $errors['ten_lien_he'] = "Tên người liên hệ là bắt buộc";
            }

            // Cap nhat du lieu
            if (empty($errors)) {
                // Neu khong co loi thi them du lieu
                // Them vao CSDL
                $this->modelLienhe->updateData($id,$ten_lien_he, $mo_ta,);
                unset($_SESSION['errors']);
                header('Location: ?act=lienhe/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=lienhe/edit&id=' . $id);
                exit();
            }
        } else {

        }
    }

//   Ham xoa du lieu trong CSDL
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['lienhe_id'];
            $this->modelLienhe->deleteData($id);
            header('Location: ?act=lienhe/list');
            exit();
        }
    }

}


