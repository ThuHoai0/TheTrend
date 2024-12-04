<?php

class Dashboard 
{
    public $conn;

    // kết nối cơ sở dữ liệu
    public  function __construct()
    {
        $this->conn = connectDB();
    }



    public function layTongThuNhapHomNay(): mixed {
        try {
            $sql = "SELECT SUM(tong_tien) AS tong_thu_nhap
                    FROM don_hangs
                    WHERE ngay_dat_hang >= CURDATE()
                      AND ngay_dat_hang < CURDATE() + INTERVAL 1 DAY;";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();
    
            return $ketQua['tong_thu_nhap'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
        } catch (PDOException $e) {
            // Log lỗi thay vì hiển thị trực tiếp (nếu cần)
            // echo 'Lỗi: ' . $e->getMessage();
        }
    }


    public function demSoLuongDonHangHomNay(): mixed {
        try {
            // Câu truy vấn sử dụng phạm vi thời gian để tránh dùng hàm DATE()
            $sql = "SELECT COUNT(*) AS so_luong_don_hang
                    FROM don_hangs
                    WHERE ngay_dat_hang >= CURDATE()
                      AND ngay_dat_hang < CURDATE() + INTERVAL 1 DAY;";
    
            // Chuẩn bị và thực thi truy vấn
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
    
            // Lấy kết quả
            $ketQua = $stmt->fetch();
    
            // Trả về số lượng đơn hàng, mặc định là 0 nếu không có đơn hàng
            return $ketQua['so_luong_don_hang'] ?? 0;
        } catch (PDOException $e) {
            // Xử lý lỗi, log lỗi nếu cần
            echo 'Lỗi: ' . $e->getMessage();
            return 0;
        }
    }
    
    public function demSoLuongKhachHang() {
        try {
            
                $sql = "SELECT COUNT(*) AS so_luong_khach_hang
                FROM nguoi_dungs
                WHERE trang_thai = 1 AND vai_tro = 1;

    ";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();

            return $ketQua['so_luong_khach_hang'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
            //code...
        } catch (PDOException $e) {
            //throw $th;
//            echo 'Lỗi: '. $e->getMessage();

        }
    }
        
    public function thongKeTongDonHangCaNam()
    {
        try {
            $namHienTai = date('Y'); // Lấy năm hiện tại
            $sql = "SELECT COUNT(*) AS tong_so_luong_don_hang
                    FROM don_hangs
                    WHERE YEAR(ngay_dat_hang) = :namHienTai"; // Sử dụng tham số trùng khớp
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['namHienTai' => $namHienTai]); // Tham số đúng tên
            $ketQua = $stmt->fetch();
    
            return $ketQua['tong_so_luong_don_hang'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
        } catch (PDOException $e) {
//            echo 'Lỗi: ' . $e->getMessage();
        }
    }
   
public function thongKeTongTienCaNam() {
    try {
        $nam = date('Y'); // Lấy năm hiện tại
        $sql = "SELECT SUM(tong_tien) AS tong_thu_nhap_nam
                FROM don_hangs
                WHERE YEAR(ngay_dat_hang) = :nam"; // Thêm điều kiện lọc theo năm

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['nam' => $nam]); // Truyền tham số năm
        $ketQua = $stmt->fetch();

        return $ketQua['tong_thu_nhap_nam'] ?? 0; // Trả về 0 nếu không có kết quả
    } catch (PDOException $e) {
//        echo 'Lỗi: ' . $e->getMessage();
    }
}

    public function thongKeSanPham() {
        try {
             
            $sql = "SELECT SUM(so_luong) AS tong_so_luong_san_pham 
                    FROM san_phams;
                    ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();
            
            return $ketQua['tong_so_luong_san_pham'] ?? 0;
                

        } catch (PDOException $e) {
            //throw $th;
//            echo 'Lỗi: '. $e->getMessage();

        }
    }  

    public function tongDonHang() {
        try {

            $sql = "SELECT COUNT(*) AS tong_so_luong_don_hang FROM don_hangs";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();

            return $ketQua['tong_so_luong_don_hang'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
            //code...
        } catch (PDOException $e) {
            //throw $th;
//            echo 'Lỗi: '. $e->getMessage();

        }
    }

    public function dangSuly() {
        try {

            $sql = "SELECT COUNT(*) AS don_dang_su_ly FROM don_hangs WHERE trang_thai_id= 12;";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();

            return $ketQua['don_dang_su_ly'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
            //code...
        } catch (PDOException $e) {
            //throw $th;
//            echo 'Lỗi: '. $e->getMessage();

        }
    }

    public function tongDonHangDaXacNhan() {
        try {

            $sql = "SELECT COUNT(*) AS tong_don_hang_da_xac_nhan FROM don_hangs WHERE trang_thai_id= 13;";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();

            return $ketQua['tong_don_hang_da_xac_nhan'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
            //code...
        } catch (PDOException $e) {
            //throw $th;
//            echo 'Lỗi: '. $e->getMessage();

        }
    }

 public function tongSoDonHangDangGiao() {
        try {

            $sql = "SELECT COUNT(*) AS tong_so_don_hang_dang_giao FROM don_hangs WHERE trang_thai_id= 14;";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();

            return $ketQua['tong_so_don_hang_dang_giao'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
            //code...
        } catch (PDOException $e) {
            //throw $th;
//            echo 'Lỗi: '. $e->getMessage();

        }
    }

    public function tongSoDonHangDaGiaoHang() {
        try {

            $sql = "SELECT COUNT(*) AS tong_so_don_hang_da_giao FROM don_hangs WHERE trang_thai_id= 15;";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();

            return $ketQua['tong_so_don_hang_da_giao'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
            //code...
        } catch (PDOException $e) {
            //throw $th;
//            echo 'Lỗi: '. $e->getMessage();

        }
    }

    public function tongSoDonHangDaHuy() {
        try {

            $sql = "SELECT COUNT(*) AS tong_so_don_hang_da_huy FROM don_hangs WHERE trang_thai_id= 16;";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();

            return $ketQua['tong_so_don_hang_da_huy'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
            //code...
        } catch (PDOException $e) {
            //throw $th;
//            echo 'Lỗi: '. $e->getMessage();

        }
    }

    public function getTopSanPhamBanChay($limit = 5) {
        try {
            $sql = "
                SELECT 
                    san_phams.ten_san_pham, 
                    SUM(chi_tiet_don_hangs.so_luong) AS tong_so_luong
                FROM 
                    chi_tiet_don_hangs
                INNER JOIN 
                    san_phams 
                ON 
                    chi_tiet_don_hangs.san_pham_id = san_phams.id
                GROUP BY 
                    san_phams.ten_san_pham
                ORDER BY 
                    tong_so_luong DESC
                LIMIT :limit;
            ";
    
            // Chuẩn bị truy vấn
            $stmt = $this->conn->prepare($sql);
    
            // Gắn giá trị cho tham số `:limit`
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    
            // Thực thi truy vấn
            $stmt->execute();
    
            // Lấy kết quả dưới dạng mảng kết hợp
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Xử lý lỗi
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }

    public function getTop5KhuyenMai() {
        $sql = "SELECT * FROM khuyen_mais ORDER BY phan_tram_giam DESC LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getKhachHangThanThiet() {
        $sql = "
            SELECT 
                nguoi_dungs.id, nguoi_dungs.ten, nguoi_dungs.email, 
                COUNT(don_hangs.id) AS so_don_hang, 
                SUM(don_hangs.tong_tien) AS tong_tien
            FROM nguoi_dungs
            JOIN don_hangs ON nguoi_dungs.id = don_hangs.nguoi_dung_id
            WHERE don_hangs.trang_thai_thanh_toan = 1 -- Chỉ lấy đơn hàng đã thanh toán
            GROUP BY nguoi_dungs.id
            ORDER BY tong_tien DESC
            LIMIT 5; -- Lấy top 5 khách hàng
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getKhacHangMoi() {
        $sql = "SELECT * FROM nguoi_dungs ORDER BY ngay_tao DESC LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSanPhamMois() {
        
        $sql = "SELECT ten_san_pham, ngay_tao,so_luong,gia FROM san_phams ORDER BY ngay_tao DESC LIMIT 5;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // huy ket noi csdl
    public function  __destruct()
    {
        $this->conn = null;
    }
}
