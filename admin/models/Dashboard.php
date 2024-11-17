<?php

class Dashboard 
{
    public $conn;

    // kết nối cơ sở dữ liệu
    public  function __construct()
    {
        $this->conn = connectDB();
    }



     public function layTongThuNhapHomNay() {

        try {
            //code...
            $ngayHienTai = date('Y-m-d'); // Lấy ngày hiện tại
            $sql = "SELECT SUM(tong_tien) AS tong_thu_nhap 
                    FROM don_hangs 
                    WHERE date(ngay_tao) = :ngay_hien_tai ";
            

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['ngay_hien_tai' => $ngayHienTai]);

            $ketQua = $stmt->fetch(); 
         
            return $ketQua['tong_thu_nhap'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
        } catch (PDOException $e) {
            //throw $th;
            echo 'Lỗi: '. $e->getMessage();
        }
        
    }


    public function demSoLuongDonHangHomNay() {
        try {
            
            $ngayHienTai = date('Y-m-d'); // Ngày hiện tại
            // echo $ngayHienTai;die;
            $sql = "SELECT COUNT(*) AS so_luong_don_hang FROM don_hangs WHERE DATE(ngay_tao) = :ngay_hien_tai";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['ngay_hien_tai' => $ngayHienTai]);
            $ketQua = $stmt->fetch();

            return $ketQua['so_luong_don_hang'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
            //code...
        } catch (PDOException $e) {
            //throw $th;
            echo 'Lỗi: '. $e->getMessage();

        }
    }
    public function demSoLuongKhachHang() {
        try {
            
            $sql = "SELECT COUNT(*) AS so_luong_khach_hang FROM nguoi_dungs";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();

            return $ketQua['so_luong_khach_hang'] ?? 0; // Trả về 0 nếu không có đơn hàng nào
            //code...
        } catch (PDOException $e) {
            //throw $th;
            echo 'Lỗi: '. $e->getMessage();

        }
    }
        
     public function thongKeTongDonHangCaNam() {
        try {
             
            $sql = "SELECT COUNT(*) AS tong_so_luong_don_hang FROM don_hangs ";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();
            return $ketQua['tong_so_luong_don_hang'] ?? 0;
                

        } catch (PDOException $e) {
            //throw $th;
            echo 'Lỗi: '. $e->getMessage();

        }

    }
    //  public function thongKeTongDonHangHoanTra() {
    //     try {
             
    //         $sql = "SELECT COUNT(*) AS tong_so_luong_don_hang 
    //         FROM don_hangs 
    //         WHERE trang_thai_id = 8";

    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         $ketQua = $stmt->fetch();
    //         return $ketQua['tong_so_luong_don_hang'] ?? 0;
    //     } catch (PDOException $e) {
    //         //throw $th;
    //         echo 'Lỗi: '. $e->getMessage();

    //     }

    // }
    public function thongKeTongTienCaNam() {
        try {
            $nam = date('Y'); 
            $sql = "SELECT SUM(tong_tien) AS tong_thu_nhap_nam
            FROM don_hangs";
            
                    

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $ketQua = $stmt->fetch();
            
            return $ketQua['tong_thu_nhap_nam'] ?? 0;
                

        } catch (PDOException $e) {
            //throw $th;
            echo 'Lỗi: '. $e->getMessage();

        }

    }
    public function thongKeHoanTien() {
        try {
            $nam = date('Y'); 
            $sql = "SELECT SUM(tong_tien) AS hoan_tien
            FROM don_hangs 
            WHERE YEAR(ngay_dat) = :nam ";
            
                    

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['nam' => $nam]);
            $ketQua = $stmt->fetch();
            
            return $ketQua['hoan_tien'] ?? 0;
                

        } catch (PDOException $e) {
            //throw $th;
            echo 'Lỗi: '. $e->getMessage();

        }

    }
    // public function thongKeSanPham() {
    //     try {
             
    //         $sql = "SELECT COUNT(*) AS tong_so_luong_san_pham 
    //                 FROM san_phams;
    //                 ";
            
                    

    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         $ketQua = $stmt->fetch();
            
    //         return $ketQua['tong_so_luong_san_pham'] ?? 0;
                

    //     } catch (PDOException $e) {
    //         //throw $th;
    //         echo 'Lỗi: '. $e->getMessage();

    //     }

    // }
    // public function thongKeDanhMuc() {
    //     try {
             
    //         $sql = "SELECT COUNT(*) AS tong_so_luong_danh_muc 
    //                 FROM danh_mucs;
    //                 ";
            
                    

    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         $ketQua = $stmt->fetch();
            
    //         return $ketQua['tong_so_luong_danh_muc'] ?? 0;
                

    //     } catch (PDOException $e) {
    //         //throw $th;
    //         echo 'Lỗi: '. $e->getMessage();

    //     }

    // }
    // huy ket noi csdl
    public function  __destruct()
    {
        $this->conn = null;
    }
}

