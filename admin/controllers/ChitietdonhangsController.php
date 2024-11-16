<?php

class ChitietdonhangsController
{
    // ham ket noi den Model
    public $modelChitietdonhang;

    public function __construct()
    {
        $this->modelChitietdonhang = new Chitietdonhang();
    }

    // ham hien thi danh sach
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

}


