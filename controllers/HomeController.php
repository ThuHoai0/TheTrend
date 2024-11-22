<?php
class HomeController
{
    public $modelHome;
    public function __construct() {
        $this->modelHome = new Home();
    }

    public function index() {
        require_once 'views/home.php';
    }
    public function lienHe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $noi_dung = $_POST['noi_dung'];
            $this->modelHome->lienhe($email, $ho_ten, $so_dien_thoai,$noi_dung);
        }
        require_once 'lienhe.php';
    }
}