<?php

class HinhanhsanphamsController
{
    // ham ket noi den Model
    public $modelHinhanhsanpham;

    public function __construct()
    {
        $this->modelHinhanhsanpham = new Hinhanhsanpham();
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
            $ten_san_pham = $_POST['ten_san_pham'];
            $duong_dan_hinh_anh = $_FILES['duong_dan_hinh_anh'];
            $mo_ta = $_POST['mo_ta'];

            // Lấy dữ liệu hiện tại để dùng khi không có hình ảnh mới
            $currentData = $this->modelHinhanhsanpham->getDetailData($id);
            if ($duong_dan_hinh_anh['error'] == UPLOAD_ERR_OK) {
                // Có ảnh mới, thực hiện tải lên
                $load_hinh_anh = upload($duong_dan_hinh_anh);
            } else {
                // Không có ảnh mới, giữ nguyên ảnh cũ
                $load_hinh_anh = $currentData['duong_dan_hinh_anh'];
            }


            // validate
            $errors = [];
//            if (empty($ten_danh_muc)) {
//                $errors['ten_danh_muc'] = "Tên danh mục là bắt buộc";
//            }

            // Cap nhat du lieu
            if (empty($errors)) {
                // Neu khong co loi thi them du lieu
                // Them vao CSDL
                $this->modelHinhanhsanpham->updateData($id, $ten_san_pham, $load_hinh_anh, $mo_ta);
                unset($_SESSION['errors']);
                header('Location: ?act=hinhanhsanpham/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=hinhanhsanpham/edit&id=' . $id);
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