<?php
require_once 'models/TinTucModel.php';

class TinTucController {
    private $modelLienHe;

    public function __construct() {
        $this->modelLienHe = new TinTucModel();
    }

    // Hiển thị danh sách tin tức
    public function showDanhSachTinTuc() {
        $tinTucs = $this->modelLienHe->getDanhSachTinTuc();

        // Kiểm tra nếu không có dữ liệu
        if (!$tinTucs) {
            $tinTucs = []; // Trả về mảng rỗng để View không bị lỗi
        }

        require_once 'views/tin_tuc_danh_sach.php';
    }
    // Hiển thị chi tiết tin tức
    public function showChiTietTinTuc($id) {
        $tin_tucs = $this->modelLienHe->getChiTietTinTuc($id);
        require_once 'views/tin_tuc_chi_tiet.php';
    }
}

?>