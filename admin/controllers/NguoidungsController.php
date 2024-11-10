<?php

class NguoidungsController
{
    // ham ket noi den Model
    public $modelNguoidung;

    public function __construct()
    {
        $this->modelNguoidung = new Nguoidung();
    }

    // ham hien thi nguoi dung
    public function index()
    {
        // lay ra toan bo nguoi dùng
        $nguoi_dungs = $this->modelNguoidung->getAll();
        // var_dump($nguoi_dungs);

        // dua du lieu ra view
        require_once './views/nguoidung/list.php';
    }

    // ham hien thi form them nguoi dung public function create()
    public function create(){
        require_once './views/nguoidung/create.php';
    }

    // ham xu ly them vao CSDL
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set timezone to Vietnam
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            // lay ra du lieu
            $ten = $_POST['ten'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $ngay_tao = isset($_POST['ngay_tao']) ? $_POST['ngay_tao'] : date('Y-m-d H:i:s'); // Use current date & time in Vietnam
            $dia_chi = $_POST['dia_chi'];
            $vai_tro = $_POST['vai_tro'];
            $trang_thai = $_POST['trang_thai'];


            // validate
            $errors = [];
            if (empty($ten)) {
                $errors['ten'] = "Tên người dùng là bắt buộc";
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại là bắt buộc";
            } elseif (!is_numeric($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại phải là chữ số";
            } elseif (strlen($so_dien_thoai) !== 10) {
                $errors['so_dien_thoai'] = "Số điện thoại phải gồm 10 chữ số";
            }

            if (empty($email)) {
                $errors['email'] = "Email là bắt buộc";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không hợp lệ";
            }

            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = "Ngày sinh là bắt buộc";
            } elseif (new DateTime($ngay_sinh) > new DateTime()) {
                $errors['ngay_sinh'] = "Ngày sinh phải là ngày trong quá khứ";
            }

            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = "Giới tính là bắt buộc";
            }

            if (empty($dia_chi)) {
                $errors['dia_chi'] = "Địa chỉ là bắt buộc";
            } elseif (strlen($dia_chi) < 5) {
                $errors['dia_chi'] = "Địa chỉ phải có ít nhất 5 ký tự";
            } elseif (strlen($dia_chi) > 100) {
                $errors['dia_chi'] = "Địa chỉ không được vượt quá 100 ký tự";
            }
            
            // them du lieu
            if (empty($errors)) {
                // neu khong co loi thi them du lieu
                // them vao CSDL
                $this->modelNguoidung->postData($ten, $email, $so_dien_thoai, $ngay_sinh, $gioi_tinh, $dia_chi, $vai_tro, $trang_thai, $ngay_tao);
                unset($_SESSION['errors']);
                header('Location: ?act=nguoidung/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=nguoidung/create');
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
    
            if (empty($ten)) {
                $errors['ten'] = "Tên người dùng là bắt buộc";
            }
    
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại là bắt buộc";
            } elseif (!is_numeric($so_dien_thoai)) {
                $errors['so_dien_thoai'] = "Số điện thoại phải là chữ số";
            } elseif (strlen($so_dien_thoai) !== 10) {
                $errors['so_dien_thoai'] = "Số điện thoại phải gồm 10 chữ số";
            }
    
            if (empty($email)) {
                $errors['email'] = "Email là bắt buộc";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không hợp lệ";
            }
    
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = "Ngày sinh là bắt buộc";
            } elseif (new DateTime($ngay_sinh) > new DateTime()) {
                $errors['ngay_sinh'] = "Ngày sinh phải là ngày trong quá khứ";
            }
    
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = "Giới tính là bắt buộc";
            }
    
            if (empty($dia_chi)) {
                $errors['dia_chi'] = "Địa chỉ là bắt buộc";
            } elseif (strlen($dia_chi) < 5) {
                $errors['dia_chi'] = "Địa chỉ phải có ít nhất 5 ký tự";
            } elseif (strlen($dia_chi) > 100) {
                $errors['dia_chi'] = "Địa chỉ không được vượt quá 100 ký tự";
            }
            
            // Cập nhật dữ liệu nếu không có lỗi
            if (empty($errors)) {
                // Cập nhật vào CSDL
                $this->modelNguoidung->updateData($id, $ten, $email, $so_dien_thoai, $ngay_sinh, $gioi_tinh, $dia_chi, $vai_tro, $trang_thai);
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


