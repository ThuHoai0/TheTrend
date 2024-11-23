<?php
class KhuyenmaiController
{
    public $modelKhuyenmai;
    public function __construct() {
        $this->modelKhuyenmai = new khuyenmai();
    }

    // khuyến mãi
    public function khuyenmai() {
        // Lấy dữ liệu từ model
        $khuyen_mais = $this->modelKhuyenmai->getAllKM();
        // var_dump($khuyen_mais); die($khuyen_mais);
        // Gửi dữ liệu đến view
        require_once 'khuyenmai.php';
    }
}
