<?php

class DonhangsController
{
    public $modelDonhang;
    public function __construct() {
        $this->modelDonhang = new Donhang();
    }

    public function index()
    {
        $don_hangs = null;

        if (isset($_GET['search'])) {
            $don_hangs = $this->modelDonhang->getBySearch($_GET['search']);
        } else {
            $don_hangs = $this->modelDonhang->getAll();
        }

        // dua du lieu ra view
        require_once './views/donhang/list.php';
    }


    public function edit()
    {
        // lay id
        $id = $_GET['id'];
        // lay thong tin chi tiet cua danh muc
        $san_pham = $this->modelSanpham->getDetailData($id);

        $sp = $this->modelSanpham->getCategory();

        // do du lieu ra form
        require_once './views/sanpham/edit.php';
    }


    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelDonhang->deleteData($id);
            header('Location: ?act=donhang/list');
            exit();
        }
    }
}