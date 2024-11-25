<?php
class GiohangController
{
    public $modelGiohang;

    public function __construct()
    {
        $this->modelGiohang = new Giohang();
    }

    public function giohang(){
        require_once './giohang.php';
    }

}