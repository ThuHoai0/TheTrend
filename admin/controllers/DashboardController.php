<?php

class DashboardController {

    public $modelDashboard;

    public function __construct()
    {
        $this->modelDashboard = new Dashboard();
    }

    public function index() {
        $tongThuNhapNgay = $this->modelDashboard->layTongThuNhapHomNay();
        $soLuongDonHangHomNay = $this->modelDashboard->demSoLuongDonHangHomNay();
        $soLuongKhachHang = $this->modelDashboard->demSoLuongKhachHang();
        // $sanPham = $this->modelDashboard-> thongKeSanPham();
        // $danhMuc = $this->modelDashboard-> thongKeDanhMuc();
        // var_dump($thuNhapNam);die;

        require_once "./views/dashboard.php";

    }
}