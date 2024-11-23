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
        $tongDonHangDaDat = $this->modelDashboard-> tongDonHangDaDat();
        $tongSoDonHangDangGiao = $this->modelDashboard-> tongSoDonHangDangGiao();
        $tongSoDonHangDaHuy = $this->modelDashboard-> tongSoDonHangDaHuy();
        $tongSoDonHangDaHoanThanh = $this->modelDashboard-> tongSoDonHangDaHoanThanh();
        $tongSoDonHangDaDongGoi = $this->modelDashboard-> tongSoDonHangDaDongGoi();
        $dangSuLy = $this->modelDashboard-> dangSuLy();
        $tongSoDonHangHoanTra = $this->modelDashboard-> tongSoDonHangHoanTra();
        $tongSoDonHangDaThanhToan = $this->modelDashboard-> tongSoDonHangDaThanhToan();
        $topSanPham = $this->modelDashboard->getTopSanPhamBanChay(5);
        if (!empty($topSanPham)) {
            foreach ($topSanPham as $index => $sanPham) {
                echo ($index + 1) . '. ' . $sanPham['ten_san_pham'] . ' - ' . $sanPham['tong_so_luong'] . ' sản phẩm<br>';
            }
        } else {
            echo 'Không có sản phẩm nào được bán.';
        }
        $khuyenMais = $this->modelDashboard->getTop5KhuyenMai();
        $khachHangs = $this->modelDashboard->getKhachHangThanThiet();

        $khacHangMois = $this->modelDashboard->getKhacHangMoi();
        $sanPhamMois = $this->modelDashboard->getSanPhamMois();
        // $danhMuc = $this->modelDashboard-> thongKeDanhMuc();
        // var_dump($thuNhapNam);die;
        require_once "./views/dashboard.php";

    }    
}