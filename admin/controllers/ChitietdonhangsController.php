<?php

class ChitietdonhangsController
{
    public $modelChitietdonhang;
    public function __construct() {
        $this->modelChitietdonhang = new Chitietdonhang();
    }
    public function index()
    {
        $chi_tiet_don_hangs = null;

        if (isset($_GET['search'])) {
            $chi_tiet_don_hangs = $this->modelChitietdonhang->getBySearch($_GET['search']);
        } else {
            $chi_tiet_don_hangs = $this->modelChitietdonhang->getAll();
        }
        require_once './views/chitietdonhang/list.php';
    }
    public  function chitiet ()
    {
        $id = $_GET['id'];
        $chi_tiet_don_hang = $this->modelChitietdonhang->getDetailData($id);
        require_once './views/chitietdonhang/chitiet.php';
    }
    // Ham xu ly cap nhat du lieu vao CSDL
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->modelChitietdonhang->deleteData($id);
            header('Location: ?act=chitietdonhang/list');
            exit();
        }
    }

}