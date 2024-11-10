<?php

class BannersController
{
    // ham ket noi den Model
    public $modelBanner;

    public function __construct()
    {
        $this->modelBanner = new Banner();
    }

    // ham hien thi danh sach
    public function index()
    {
        // lay ra toan bo Banner
        $banners = $this->modelBanner->getAll();


        // dua du lieu ra view
        require_once './views/banner/list.php';
    }

    // ham hien thi form them Banner  public function create()
    public function create(){
        require_once './views/banner/create.php';
    }

    // ham xu ly them vao CSDL
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $duong_dan_hinh_anh = $_FILES['duong_dan_hinh_anh'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];

            $load_duong_dan_hinh_anh = uploadFile($duong_dan_hinh_anh);


// Validate mo_ta
            if (empty($mo_ta)) {
                $errors['mo_ta'] = "Nội dung là bắt buộc";
            }
            // them du lieu
            if (empty($errors)) {
                // neu khong co loi thi them du lieu
                // them vao CSDL
                $this->modelBanner->postData($load_duong_dan_hinh_anh,$mo_ta,$trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=banner/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=banner/create');
                exit();
            }
        }
    }



    // Ham hien thi form sua
    public function edit()
    {
        // lay id
        $id = $_GET['id'];
        // lay thong tin chi tiet cua Banner
        $banner = $this->modelBanner->getDetailData($id);

        // do du lieu ra form
        require_once './views/banner/edit.php';
    }

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay ra du lieu
            $id = $_GET['id'];
            $duong_dan_hinh_anh = $_FILES['duong_dan_hinh_anh'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];

            $load_duong_dan_hinh_anh = uploadFile($duong_dan_hinh_anh);

            // die($category_status);
            $errors = [];
            // Validate mo_ta
            if (empty($mo_ta)) {
                $errors['mo_ta'] = "Nội dung là bắt buộc";
            }

            // Cap nhat du lieu
            if (empty($errors)) {
                // Neu khong co loi thi them du lieu
                // Them vao CSDL
                $this->modelBanner->updateData($id,$load_duong_dan_hinh_anh,$mo_ta,$trang_thai);
                // unset($_SESSION['errors']);
                header('Location: ?act=banner/list');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=banner/edit&id=' . $id);
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
            $this->modelBanner->deleteData($id);
            header('Location: ?act=banner/list');
            exit();
        }
    }

}


