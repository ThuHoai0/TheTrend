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
        
        $tongDonHangCaNam = $this->modelDashboard->thongKeTongDonHangCaNam();
        $tongTienCaNam = $this->modelDashboard->thongKeTongTienCaNam();
        $tongSanPham = $this->modelDashboard-> thongKeSanPham();

        $tongDonHang = $this->modelDashboard-> tongDonHang();
        $dangSuLy = $this->modelDashboard-> dangSuLy();
        $tongDonHangDaXacNhan = $this->modelDashboard-> tongDonHangDaXacNhan();
        $tongSoDonHangDangGiao = $this->modelDashboard-> tongSoDonHangDangGiao();
        $tongSoDonHangDaGiaoHang = $this->modelDashboard-> tongSoDonHangDaGiaoHang();
        $tongSoDonHangDaHuy = $this->modelDashboard-> tongSoDonHangDaHuy();

       
        $topSanPham = $this->modelDashboard->getTopSanPhamBanChay(5);
        
        $khuyenMais = $this->modelDashboard->getTop5KhuyenMai();
        $khachHangs = $this->modelDashboard->getKhachHangThanThiet();

        $khacHangMois = $this->modelDashboard->getKhacHangMoi();
        $sanPhamMois = $this->modelDashboard->getSanPhamMois();

        require_once "./views/dashboard.php";

    }    
}