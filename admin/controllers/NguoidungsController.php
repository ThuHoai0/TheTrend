<?php

class NguoidungsController
{
    // ham ket noi den Model
    public $modelNguoidung;

    public function __construct()
    {
        $this->modelNguoidung = new Nguoidung();
    }



    public function index()
    {
        $nguoi_dungs = null;

        if (isset($_GET['search'])) {
            $nguoi_dungs = $this->modelNguoidung->getBySearch($_GET['search']);
        } else {
            $nguoi_dungs = $this->modelNguoidung->getAll();
        }
        // dua du lieu ra view
        require_once './views/nguoidung/list.php';
    }

    public function chitiet()
    {
        $id = $_GET['id'];

        $nguoi_dung = $this->modelNguoidung->getDetailData($id);

        require_once './views/nguoidung/chitiet.php';
    }

    // ham hien thi form them nguoi dung public function create()
    public function create(){
        require_once './views/nguoidung/create.php';
    }


    // Ham hien thi form sua
    public function edit()
    {
        // lay id
        $id = $_GET['id'];
        // lay thong tin chi tiet cua danh muc
        $nguoi_dung = $this->modelNguoidung->getDetailData($id);

        // do du lieu ra form
        require_once './views/nguoidung/edit.php';
    }

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ID từ GET (để biết bản ghi nào cần cập nhật)
            $id = $_GET['id'];
            // Lấy dữ liệu từ POST
            $ten = $_POST['ten'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $dia_chi = $_POST['dia_chi'];
            $vai_tro = $_POST['vai_tro'];
            $trang_thai = $_POST['trang_thai'];
            // Validate dữ liệu
            $errors = [];
    
            // Cập nhật dữ liệu nếu không có lỗi
            if (empty($errors)) {
                // Cập nhật vào CSDL
                $this->modelNguoidung->updateData($id, $trang_thai);
                // Xóa session lỗi và chuyển hướng
                unset($_SESSION['errors']);
                header('Location: ?act=nguoidung/list');
                exit();
            } else {
                // Ghi lại lỗi vào session và chuyển hướng về form sửa
                $_SESSION['errors'] = $errors;
                header('Location: ?act=nguoidung/edit&id=' . $id);
                exit();
            }
        }
    }
    

//   Ham xoa du lieu trong CSDL
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['nguoidung_id'];
            $this->modelNguoidung->deleteData($id);
            header('Location: ?act=nguoidung/list');
            exit();
        }
    }

}


