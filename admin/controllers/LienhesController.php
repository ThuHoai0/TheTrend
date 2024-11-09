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
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $trang_thai = $_POST['trang_thai'];
            $noi_dung = $_POST['noi_dung'];
            // validate
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Tên người liên hệ là bắt buộc";
            }
            // Kiểm tra email
            if (empty($email)) {
                $errors['email'] = "Email là bắt buộc";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Định dạng email không hợp lệ";
            }

            // Kiểm tra số điện thoại
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại là bắt buộc";
            } elseif (!preg_match("/^[0-9]{10,11}$/", $so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại phải là 10-11 chữ số";
            }
            // them du lieu
            if (empty($errors)) {
                // neu khong co loi thi them du lieu
                // them vao CSDL
                $this->modelLienhe->postData($ho_ten,$email,$so_dien_thoai,$noi_dung,$trang_thai);
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
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $noi_dung = $_POST['noi_dung'];
            $trang_thai = $_POST['trang_thai'];


            // die($category_status  );
            // validate
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = "Tên người liên hệ là bắt buộc";
            }
            // Kiểm tra email
            if (empty($email)) {
                $errors['email'] = "Email là bắt buộc";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Định dạng email không hợp lệ";
            }

// Kiểm tra số điện thoại
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại là bắt buộc";
            } elseif (!preg_match("/^[0-9]{10,11}$/", $so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại phải là 10-11 chữ số";
            }

            // Cap nhat du lieu
            if (empty($errors)) {
                // Neu khong co loi thi them du lieu
                // Them vao CSDL
                $this->modelLienhe->updateData($id,$ho_ten,$email,$so_dien_thoai,$noi_dung,$trang_thai);
                // unset($_SESSION['errors']);
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
            $id = $_POST['id'];
            $this->modelLienhe->deleteData($id);
            header('Location: ?act=lienhe/list');
            exit();
        }
    }

}


