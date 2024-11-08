<?php

class SanphamsController
{
    public $modelSanpham;
    public function __construct() {
        $this->modelSanpham = new Sanpham();
    }

    public function index() {
        $san_phams = $this->modelSanpham->getAll();
        // var_dump($san_phams);
        require_once './views/sanpham/list.php';
    }


}