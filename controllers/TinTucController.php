<?php
require_once 'models/Tintuc.php';

class TintucController
{
    public $ModelTintuc;

    public function __construct()
    {
        $this->ModelTintuc = new TinTuc();
    }

    // Hiển thị danh sách tin tức
    public function dstintuc()
    {
        $tinTucs = $this->ModelTintuc->get3TinTuc();
       
        require_once './tintuc.php';
    }

    // Hiển thị chi tiết tin tức
    public function chitiet()
    {
        $id = $_GET['id'];

        $chi_tiet = $this->ModelTintuc->getDetailData($id);
        // var_dump($chi_tiet);
        // die();
        require_once './chitiettintuc.php';
    }
}