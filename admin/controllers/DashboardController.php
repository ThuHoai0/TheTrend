<?php

class DashboardController {
    public $modelDashboard;
    public function __construct()
    {
        $this->modelDashboard = new Dashboard();
    }
    public function index() {

        $tongDonHangCaNam = $this->modelDashboard->thongKeTongDonHangCaNam();
        $tongTienCaNam = $this->modelDashboard->thongKeTongTienCaNam();
        $soLuongKhachHang = $this->modelDashboard->demSoLuongKhachHang();

        $tongThuNhapNgay = $this->modelDashboard->layTongThuNhapHomNay();
        $soLuongDonHangHomNay = $this->modelDashboard->demSoLuongDonHangHomNay();
        $tongSanPham = $this->modelDashboard-> thongKeSanPham();

        $tongDonHang = $this->modelDashboard-> tongDonHang();
        $thanhcong = $this->modelDashboard-> thanhcong();
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