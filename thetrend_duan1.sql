-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2024 at 06:35 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thetrend_duan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bai_viets`
--

CREATE TABLE `bai_viets` (
  `id` int NOT NULL,
  `tieu_de` varchar(100) DEFAULT NULL,
  `noi_dung` text,
  `nguoi_dung_id` int DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `trang_thai` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int NOT NULL,
  `duong_dan_hinh_anh` varchar(255) DEFAULT NULL,
  `mo_ta` text,
  `trang_thai` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `duong_dan_hinh_anh`, `mo_ta`, `trang_thai`) VALUES
(3, '1732894514slide-02.jpg', 'thu hoai', 1),
(4, '17328945521732854319slide-03.jpg', 'hoai thu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `binh_luans`
--

CREATE TABLE `binh_luans` (
  `id` int NOT NULL,
  `san_pham_id` int DEFAULT NULL,
  `nguoi_dung_id` int DEFAULT NULL,
  `noi_dung` text,
  `ngay_binh_luan` datetime DEFAULT NULL,
  `trang_thai` tinyint DEFAULT NULL,
  `bieu_tuong` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `binh_luans`
--

INSERT INTO `binh_luans` (`id`, `san_pham_id`, `nguoi_dung_id`, `noi_dung`, `ngay_binh_luan`, `trang_thai`, `bieu_tuong`) VALUES
(7, 186, 30, 'tốt', '2024-12-06 19:26:57', 1, NULL),
(9, 189, 30, 'abc', '2024-12-08 09:33:21', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id` int NOT NULL,
  `don_hang_id` int DEFAULT NULL,
  `san_pham_id` int DEFAULT NULL,
  `so_luong` int DEFAULT NULL,
  `don_gia` decimal(15,2) DEFAULT NULL,
  `thanh_tien` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chi_tiet_don_hangs`
--

INSERT INTO `chi_tiet_don_hangs` (`id`, `don_hang_id`, `san_pham_id`, `so_luong`, `don_gia`, `thanh_tien`) VALUES
(115, 160, 194, 1, '500000.00', 500000),
(116, 160, 183, 3, '1000000.00', 3000000),
(117, 160, 182, 1, '150000.00', 150000),
(118, 161, 195, 2, '6000000.00', 12000000),
(119, 162, 188, 1, '750000.00', 750000),
(120, 162, 187, 1, '100000.00', 100000),
(121, 162, 189, 7, '220000.00', 1540000),
(122, 163, 197, 10, '45000.00', 450000),
(123, 164, 186, 1, '200000.00', 200000),
(124, 165, 186, 1, '200000.00', 200000),
(125, 165, 199, 1, '10000000.00', 10000000),
(126, 166, 189, 400, '220000.00', 88000000);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_san_phams`
--

CREATE TABLE `chi_tiet_san_phams` (
  `id` int NOT NULL,
  `san_pham_id` int DEFAULT NULL,
  `thuoc_tinh` varchar(100) DEFAULT NULL,
  `gia_tri` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danh_gias`
--

CREATE TABLE `danh_gias` (
  `id` int NOT NULL,
  `san_pham_id` int DEFAULT NULL,
  `nguoi_dung_id` int DEFAULT NULL,
  `so_sao` tinyint DEFAULT NULL,
  `noi_dung` text,
  `ngay_danh_gia` datetime DEFAULT NULL,
  `trang_thai` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` int NOT NULL,
  `ten_danh_muc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mo_ta` text,
  `trang_thai` tinyint DEFAULT NULL,
  `ngay_tao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten_danh_muc`, `mo_ta`, `trang_thai`, `ngay_tao`) VALUES
(38, 'Nữ', 'Thế giới thời trang cho phái đẹp, từ váy đầm duyên dáng, áo kiểu, quần jean, đến giày cao gót và phụ kiện hiện đại, phù hợp cho mọi dịp.', 1, '2024-11-20 13:09:16'),
(39, 'Nam', 'Bộ sưu tập quần áo và phụ kiện dành cho nam giới, từ phong cách lịch lãm đến cá tính, bao gồm áo sơ mi, quần jeans, áo thun, giày dép và nhiều sản phẩm khác.', 1, '2024-11-20 13:09:16'),
(40, 'Đồng hồ', 'Bộ sưu tập đồng hồ đa dạng phong cách, từ cổ điển, sang trọng đến thể thao, phù hợp cho cả nam, nữ và trẻ em, đảm bảo chất lượng và độ bền cao.', 1, '2024-11-20 13:09:16'),
(41, 'Túi xách', 'Túi xách thời trang cho mọi phong cách, bao gồm túi đeo vai, túi xách tay, túi đeo chéo, phù hợp cho đi làm, dạo phố hay dự tiệc.', 1, '2024-11-20 13:09:16'),
(42, 'Trẻ em', 'Quần áo và phụ kiện xinh xắn, đáng yêu dành cho bé trai và bé gái, với chất liệu an toàn, thoải mái, cùng thiết kế ngộ nghĩnh.', NULL, '2024-11-20 20:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` int NOT NULL,
  `san_pham_id` int DEFAULT NULL,
  `ma_don_hang` varchar(255) DEFAULT NULL,
  `nguoi_dung_id` int DEFAULT NULL,
  `tong_tien` decimal(15,2) DEFAULT NULL,
  `trang_thai_id` int DEFAULT NULL,
  `ngay_dat_hang` timestamp NULL DEFAULT NULL,
  `phuong_thuc_thanh_toan` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `trang_thai_thanh_toan` tinyint DEFAULT NULL,
  `ho_ten_nguoi_nhan` varchar(100) DEFAULT NULL,
  `so_dien_thoai_nguoi_nhan` varchar(15) DEFAULT NULL,
  `email_nguoi_nhan` varchar(100) DEFAULT NULL,
  `ghi_chu` text,
  `dia_chi_nhan_hang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `don_hangs`
--

INSERT INTO `don_hangs` (`id`, `san_pham_id`, `ma_don_hang`, `nguoi_dung_id`, `tong_tien`, `trang_thai_id`, `ngay_dat_hang`, `phuong_thuc_thanh_toan`, `trang_thai_thanh_toan`, `ho_ten_nguoi_nhan`, `so_dien_thoai_nguoi_nhan`, `email_nguoi_nhan`, `ghi_chu`, `dia_chi_nhan_hang`) VALUES
(160, NULL, '1EJ4jO9Daz', 30, '3650000.00', 16, '2024-12-06 14:36:43', '0', 0, 'thuhoai25', '0886812402', 'thumthph48377@fpt.edu.vn', '', 'Hà Nội'),
(161, NULL, 'vRuAvVkZHN', 30, '12000000.00', 16, '2024-12-06 17:12:28', '0', 0, 'thuhoai25', '0886812402', 'thumthph48377@fpt.edu.vn', '', 'Hà Nội'),
(162, NULL, 'osXLVuWBe5', 32, '2390000.00', 11, '2024-12-07 07:05:55', '0', 0, 'thuhoai02', '0886812402', 'maithihoaithu0@gmail.com', '', 'HN'),
(163, NULL, 'CYwwxUOsuf', 30, '450000.00', 18, '2024-12-07 11:31:45', '0', 0, 'thuhoai25', '0886812402', 'thumthph48377@fpt.edu.vn', 'aa', 'Hà Nội'),
(164, NULL, '7CU5ARoaWw', 30, '200000.00', 11, '2024-12-07 11:32:27', '0', 0, 'thuhoai25', '0886812402', 'thumthph48377@fpt.edu.vn', 'a', 'Hà Nội'),
(165, NULL, '3aq2Kv3y2D', 30, '10200000.00', 16, '2024-12-07 11:34:01', '0', 1, 'thuhoai25', '0886812402', 'thumthph48377@fpt.edu.vn', 'a', 'Hà Nội'),
(166, NULL, 'mkJFFpNcoL', 30, '88000000.00', 16, '2024-12-08 09:28:59', '0', 0, 'thuhoai25', '0886812402', 'thumthph48377@fpt.edu.vn', '', 'Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `gio_hangs`
--

CREATE TABLE `gio_hangs` (
  `id` int NOT NULL,
  `nguoi_dung_id` int DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `trang_thai` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hinh_anh_san_phams`
--

CREATE TABLE `hinh_anh_san_phams` (
  `id` int NOT NULL,
  `san_pham_id` int DEFAULT NULL,
  `duong_dan_hinh_anh` varchar(255) DEFAULT NULL,
  `mo_ta` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hinh_anh_san_phams`
--

INSERT INTO `hinh_anh_san_phams` (`id`, `san_pham_id`, `duong_dan_hinh_anh`, `mo_ta`) VALUES
(1, 176, '6744190e9d64b-2.jpg', NULL),
(2, 176, '6744190e9e271-3.jpg', NULL),
(3, 177, '67441a5745ce0-2.jpg', NULL),
(4, 177, '67441a5746810-3.jpg', NULL),
(5, 178, '67441b1a75e4c-5.jpg', NULL),
(6, 178, '67441b1a76719-6.jpg', NULL),
(7, 179, '67441bc699219-8.jpg', NULL),
(8, 179, '67441bc699bc1-9.jpg', NULL),
(9, 180, '1732517245g1.jpg', ''),
(10, 180, '67441d4fece3c-g3.jpg', NULL),
(11, 181, '67441e3736ebb-b.jpg', NULL),
(12, 181, '67441e3737998-c.jpg', NULL),
(13, 182, '67441ea4a3665-t2.jpg', NULL),
(14, 182, '67441ea4a3de1-t3.jpg', NULL),
(15, 183, '67441f0ea2107-t5.jpg', NULL),
(16, 183, '67441f0ea2b37-t6.jpg', NULL),
(17, 184, '67441f75b1ee5-y.jpg', NULL),
(18, 184, '67441f75b2858-z.jpg', NULL),
(19, 185, '67441ffb153e2-n1.jpg', NULL),
(20, 185, '67441ffb15f7e-n3.jpg', NULL),
(21, 186, '674420936cd42-2.jpg', NULL),
(22, 186, '674420936dec3-3.jpg', NULL),
(23, 187, '6744210220da5-5.jpg', NULL),
(24, 187, '6744210221530-6.jpg', NULL),
(25, 188, '67442178ca822-8.jpg', NULL),
(26, 188, '67442178cb373-9.jpg', NULL),
(27, 189, '6744220b0bed0-10.jpg', NULL),
(28, 189, '6744220b0c8c1-12.jpg', NULL),
(29, 190, '674422a12d628-01.jpg', NULL),
(30, 190, '674422a12e5fd-02.jpg', NULL),
(31, 191, '674423272b42c-99.jpg', NULL),
(32, 191, '674423272c31e-100.jpg', NULL),
(33, 192, '6744238fe61b7-95.jpg', NULL),
(34, 192, '6744238fe6c5a-97.jpg', NULL),
(35, 193, '67442411d3ede-92.jpg', NULL),
(36, 193, '67442411d4987-93.jpg', NULL),
(37, 194, '6744249d0d7c8-89.jpg', NULL),
(38, 194, '6744249d0e113-90.jpg', NULL),
(39, 195, '674424fd88d45-87.jpg', NULL),
(40, 195, '674424fd894bb-88.jpg', NULL),
(41, 196, '674426087be7b-83.jpg', NULL),
(42, 196, '674426087c989-84.jpg', NULL),
(43, 197, '6744266d5dabc-80.jpg', NULL),
(44, 197, '6744266d5e1b1-81.jpg', NULL),
(45, 198, '674426be85422-78.jpg', NULL),
(46, 198, '674426be85eee-79.jpg', NULL),
(47, 199, '6744271a767a5-75.jpg', NULL),
(48, 199, '6744271a77256-76.jpg', NULL),
(49, 200, '674427a1c3660-72.jpg', NULL),
(50, 200, '674427a1c3fac-73.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `khuyen_mais`
--

CREATE TABLE `khuyen_mais` (
  `id` int NOT NULL,
  `ten_khuyen_mai` varchar(100) DEFAULT NULL,
  `mo_ta` text,
  `phan_tram_giam` decimal(10,0) DEFAULT NULL,
  `ngay_bat_dau` datetime DEFAULT NULL,
  `ngay_ket_thuc` datetime DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `trang_thai` tinyint DEFAULT NULL,
  `ma_khuyen_mai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `khuyen_mais`
--

INSERT INTO `khuyen_mais` (`id`, `ten_khuyen_mai`, `mo_ta`, `phan_tram_giam`, `ngay_bat_dau`, `ngay_ket_thuc`, `ngay_tao`, `trang_thai`, `ma_khuyen_mai`) VALUES
(1, 'Black Friday', 'abc', '30', '2024-10-27 00:00:00', '2024-12-07 00:00:00', '2024-11-26 18:04:09', 0, 'BL853');

-- --------------------------------------------------------

--
-- Table structure for table `lien_hes`
--

CREATE TABLE `lien_hes` (
  `id` int NOT NULL,
  `ho_ten` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `noi_dung` text,
  `ngay_gui` datetime DEFAULT NULL,
  `trang_thai` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dungs`
--

CREATE TABLE `nguoi_dungs` (
  `id` int NOT NULL,
  `ten` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mat_khau` varchar(255) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(10) DEFAULT NULL,
  `gioi_tinh` tinyint DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `trang_thai` tinyint DEFAULT NULL,
  `vai_tro` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nguoi_dungs`
--

INSERT INTO `nguoi_dungs` (`id`, `ten`, `email`, `mat_khau`, `dia_chi`, `so_dien_thoai`, `gioi_tinh`, `ngay_sinh`, `ngay_tao`, `trang_thai`, `vai_tro`) VALUES
(30, 'thuhoai25', 'thumthph48377@fpt.edu.vn', '123Abcd', 'Hà Nội', '0886812402', 2, '2005-02-25', '2024-12-01 17:33:26', NULL, 2),
(31, 'duy29', 'nvd29@gmail.com', '123Abcd', NULL, NULL, NULL, NULL, '2024-12-02 00:00:00', 1, 1),
(32, 'thuhoai02', 'maithihoaithu0@gmail.com', '123Abcd', 'HN', '0886812402', 2, NULL, '1900-01-03 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `san_phams`
--

CREATE TABLE `san_phams` (
  `id` int NOT NULL,
  `ten_san_pham` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mo_ta` text,
  `gia` decimal(15,2) NOT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `gia_nhap` decimal(15,2) DEFAULT NULL,
  `so_luong` int NOT NULL,
  `danh_muc_id` int DEFAULT NULL,
  `trang_thai` tinyint DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `nguoi_dung_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `san_phams`
--

INSERT INTO `san_phams` (`id`, `ten_san_pham`, `mo_ta`, `gia`, `hinh_anh`, `gia_nhap`, `so_luong`, `danh_muc_id`, `trang_thai`, `ngay_tao`, `nguoi_dung_id`) VALUES
(176, 'Đầm công sở phong cách hiện đại', 'Chiếc đầm này mang đến phong cách chuyên nghiệp và sang trọng cho các quý cô văn phòng. Được thiết kế từ chất liệu vải cao cấp, sản phẩm không chỉ mang đến cảm giác thoải mái khi mặc mà còn giữ được phom dáng suốt cả ngày dài. Đường cắt may tỉ mỉ giúp tôn lên vóc dáng thanh lịch của người mặc. Sản phẩm có nhiều màu sắc và kích cỡ, phù hợp với nhiều phong cách thời trang khác nhau. Với chiếc đầm này, bạn có thể tự tin trong các cuộc họp quan trọng hay các sự kiện đặc biệt. Đây là một lựa chọn tuyệt vời để khẳng định phong cách thời trang cá nhân. Thêm vào đó, thiết kế hiện đại của đầm còn giúp bạn dễ dàng kết hợp với các loại phụ kiện như túi xách, giày cao gót hay trang sức. Hãy để chiếc đầm này trở thành người bạn đồng hành hoàn hảo trong môi trường công sở đầy năng động và thử thách.', '350000.00', '17325161101.jpg', '200000.00', 20, 38, 1, '2024-11-25 13:28:30', NULL),
(177, 'Áo sơ mi nữ thiết kế sang trọng', 'Áo sơ mi nữ thiết kế sang trọng là sự kết hợp hoàn hảo giữa phong cách hiện đại và vẻ đẹp thanh lịch, giúp tôn lên sự tự tin và quyến rũ của phái đẹp. Với chất liệu cao cấp, mềm mại và thoáng mát, sản phẩm mang đến cảm giác thoải mái suốt ngày dài. Kiểu dáng chuẩn form cùng đường may tinh tế che khuyết điểm hoàn hảo, phù hợp cho cả môi trường công sở lẫn những buổi gặp gỡ quan trọng. Chi tiết cách điệu nhẹ nhàng, tông màu nhã nhặn dễ dàng phối với nhiều trang phục, giúp bạn tạo nên phong cách chuyên nghiệp và thời thượng. Một item không thể thiếu trong tủ đồ của quý cô hiện đại.', '250000.00', '17325164391.jpg', '150000.00', 50, 38, 1, '2024-11-25 13:33:59', NULL),
(178, 'Quần jeans nữ thời trang', 'Quần jeans nữ thời trang mang đến sự kết hợp hoàn hảo giữa phong cách trẻ trung và vẻ đẹp hiện đại. Với chất liệu denim cao cấp, mềm mại và co giãn nhẹ, sản phẩm đảm bảo sự thoải mái tối đa trong từng chuyển động. Thiết kế ôm vừa vặn, tôn lên đường nét cơ thể, giúp bạn tự tin và năng động trong mọi hoàn cảnh. Các chi tiết phá cách như rách nhẹ, mài xước hay đường chỉ nổi bật tạo điểm nhấn độc đáo, dễ dàng phối hợp với áo thun, sơ mi hoặc blazer để biến hóa đa dạng phong cách. Quần jeans nữ - sự lựa chọn lý tưởng cho các cô nàng cá tính và yêu thời trang.', '500000.00', '17325166344.jpg', '350000.00', 88, 38, 1, '2024-11-25 13:37:14', NULL),
(179, 'Túi xách nữ thanh lịch', 'Túi xách nữ thanh lịch là phụ kiện hoàn hảo dành cho những quý cô yêu thích sự tinh tế và thời trang. Được làm từ chất liệu cao cấp, bền đẹp với thiết kế hiện đại, sản phẩm không chỉ tiện dụng mà còn giúp tôn lên phong cách sang trọng của bạn. Kích thước vừa vặn, phù hợp để mang theo mọi vật dụng cần thiết, từ điện thoại, ví tiền đến đồ trang điểm. Các chi tiết kim loại ánh vàng hoặc bạc được gia công tỉ mỉ, tạo điểm nhấn nổi bật và cuốn hút. Túi xách nữ thanh lịch dễ dàng kết hợp với nhiều trang phục, từ công sở thanh lịch đến dạo phố thời thượng, mang đến vẻ ngoài hoàn hảo trong mọi hoàn cảnh.', '450000.00', '17325168067.jpg', '100000.00', 250, 41, 1, '2024-11-25 13:40:06', NULL),
(180, 'Giày cao gót nữ hiện đại', 'Giày cao gót nữ hiện đại là biểu tượng của sự quyến rũ và phong cách thời thượng, dành riêng cho những quý cô tự tin và sành điệu. Với thiết kế tinh tế, ôm trọn đôi chân, sản phẩm mang lại dáng vẻ thanh thoát và tôn lên chiều cao lý tưởng. Chất liệu cao cấp, mềm mại và bền bỉ, kết hợp cùng phần đế chắc chắn, giúp bạn di chuyển thoải mái mà không lo đau chân. Kiểu dáng đa dạng, từ mũi nhọn thanh lịch đến quai dây cá tính, dễ dàng phối hợp với nhiều loại trang phục, từ váy dạ hội sang trọng đến quần jeans năng động. Giày cao gót nữ hiện đại là phụ kiện không thể thiếu để hoàn thiện phong cách của bạn trong mọi dịp đặc biệt.', '600000.00', '1732517199g2.jpg', '500000.00', 150, 38, 1, '2024-11-25 13:46:39', NULL),
(181, 'Váy babydoll', 'Váy babydoll là sự lựa chọn hoàn hảo cho những cô nàng yêu thích phong cách nữ tính và dễ thương. Với thiết kế dáng xòe nhẹ nhàng, mang lại cảm giác thoải mái và trẻ trung, váy babydoll giúp tôn lên vẻ đẹp ngọt ngào và đáng yêu. Chất liệu vải mềm mại, thoáng mát, phù hợp với mọi thời tiết, cùng những chi tiết như cổ bèo, tay phồng hoặc nơ thắt tạo điểm nhấn tinh tế. Dễ dàng phối hợp với giày thể thao năng động hay giày búp bê dịu dàng, chiếc váy này lý tưởng cho các buổi dạo phố, hẹn hò hoặc dã ngoại. Váy babydoll - item thời trang không thể thiếu trong tủ đồ của các nàng yêu sự ngọt ngào và thanh lịch.', '350000.00', '1732517431a.jpg', '100000.00', 350, 38, 1, '2024-11-25 13:50:31', NULL),
(182, 'Túi xách nữ dự tiệc', 'Túi xách nữ dự tiệc là phụ kiện không thể thiếu để hoàn thiện phong cách sang trọng và quyến rũ trong những buổi tiệc đặc biệt. Được thiết kế nhỏ gọn nhưng đủ sức chứa các vật dụng cần thiết như điện thoại, son môi và ví tiền, túi xách mang đến sự tiện lợi tối đa. Chất liệu cao cấp như da bóng, satin hoặc đính kèm pha lê, sequin lấp lánh tạo điểm nhấn nổi bật và thu hút ánh nhìn. Các chi tiết kim loại mạ vàng hoặc bạc cùng dây đeo tinh tế càng tăng thêm vẻ thanh lịch. Túi xách nữ dự tiệc dễ dàng kết hợp với váy dạ hội, đầm cocktail hoặc trang phục sang trọng, giúp bạn tỏa sáng và tự tin trong mọi sự kiện.', '150000.00', '1732517540t1.jpg', '50000.00', 1, 41, 1, '2024-11-25 13:52:20', NULL),
(183, 'Túi tote canvas thời trang', 'Túi tote canvas thời trang là sự kết hợp hoàn hảo giữa phong cách trẻ trung và sự tiện dụng trong cuộc sống hàng ngày. Với chất liệu canvas bền bỉ, nhẹ nhàng và thân thiện với môi trường, sản phẩm không chỉ giúp bạn mang theo mọi vật dụng cần thiết mà còn thể hiện cá tính riêng. Thiết kế rộng rãi với các ngăn tiện ích, phù hợp để đựng sách, laptop, hoặc đồ dùng cá nhân. Điểm nhấn từ họa tiết in độc đáo, màu sắc đa dạng, giúp túi tote dễ dàng phối hợp với nhiều phong cách thời trang khác nhau, từ năng động đến tối giản. Túi tote canvas là lựa chọn lý tưởng cho những buổi đi học, đi làm hay dạo phố, mang đến sự thoải mái và phong cách hiện đại.', '1000000.00', '1732517646t4.jpg', '500000.00', 37, 41, 1, '2024-11-25 13:54:06', NULL),
(184, 'Túi đeo chéo unisex thời trang', 'Túi đeo chéo unisex thời trang là phụ kiện hoàn hảo dành cho cả nam và nữ, mang đến sự tiện dụng và phong cách hiện đại. Với thiết kế gọn nhẹ nhưng vẫn đủ không gian để đựng các vật dụng cần thiết như điện thoại, ví tiền và đồ dùng cá nhân, túi phù hợp cho mọi hoạt động hàng ngày. Chất liệu cao cấp như vải canvas, da tổng hợp hoặc nylon chống thấm đảm bảo độ bền bỉ và dễ dàng bảo quản. Kiểu dáng tối giản với màu sắc trung tính hoặc họa tiết cá tính, túi đeo chéo unisex dễ dàng phối hợp với nhiều phong cách thời trang khác nhau, từ năng động đến bụi bặm. Lựa chọn hoàn hảo cho những ai yêu thích sự thoải mái và thời trang đa năng.', '450000.00', '1732517749x.jpg', '100000.00', 1000, 41, 1, '2024-11-25 13:55:49', NULL),
(185, 'Ví nam cao cấp', 'Ví nam cao cấp là phụ kiện thể hiện phong cách lịch lãm và đẳng cấp của phái mạnh. Được chế tác từ chất liệu da thật cao cấp, mềm mại và bền bỉ, sản phẩm mang lại sự sang trọng và cảm giác cầm nắm chắc chắn. Thiết kế tinh tế với các ngăn đựng tiện lợi, ví có thể chứa thẻ, tiền mặt và giấy tờ một cách gọn gàng, đáp ứng mọi nhu cầu sử dụng hàng ngày. Đường may tỉ mỉ cùng logo dập nổi hoặc khắc tinh tế tạo điểm nhấn nổi bật, phù hợp với những người yêu thích sự chỉn chu và phong cách. Ví nam cao cấp không chỉ là phụ kiện mà còn là món quà ý nghĩa dành cho những người đàn ông thành đạt và tinh tế.', '300000.00', '1732517883n2.jpg', '100000.00', 98, 41, 1, '2024-11-25 13:58:03', NULL),
(186, 'Áo thun nam thể thao', 'Áo thun nam thể thao là lựa chọn hoàn hảo cho những chàng trai yêu thích sự năng động và thoải mái. Được làm từ chất liệu co giãn, thoáng khí và thấm hút mồ hôi tốt, áo thun giúp bạn luôn cảm thấy dễ chịu trong mọi hoạt động. Thiết kế hiện đại với form dáng chuẩn, tôn lên vẻ khỏe khoắn và phong cách thể thao của người mặc. Các chi tiết như cổ tròn, cổ polo hoặc logo in nổi bật tạo điểm nhấn cá tính, dễ dàng phối hợp với quần short, quần jogger hoặc quần thể thao. Phù hợp cho các hoạt động tập gym, chạy bộ, hoặc dạo phố, áo thun nam thể thao không chỉ mang đến sự tiện ích mà còn thể hiện phong cách thời trang năng động.', '200000.00', '17325180351.jpg', '50000.00', 128, 39, 1, '2024-11-25 14:00:35', NULL),
(187, 'Áo sơ mi nam cổ điển', 'Áo sơ mi nam cổ điển là biểu tượng của phong cách lịch lãm và sự tinh tế vượt thời gian. Với thiết kế đơn giản nhưng không kém phần sang trọng, áo sơ mi cổ điển mang đến sự chỉnh chu và phù hợp cho mọi dịp, từ công sở đến các sự kiện quan trọng. Chất liệu vải cao cấp, mềm mại và thoáng mát, đảm bảo sự thoải mái tối đa trong suốt ngày dài. Đường may tỉ mỉ cùng form dáng chuẩn giúp tôn lên vẻ nam tính và chuyên nghiệp. Dễ dàng kết hợp với quần tây, vest hoặc quần jeans, áo sơ mi nam cổ điển là sự lựa chọn không thể thiếu trong tủ đồ của người đàn ông hiện đại.', '100000.00', '17325181464.jpg', '50000.00', 499, 39, 1, '2024-11-25 14:02:26', NULL),
(188, 'Quần kaki nam thanh lịch', 'Quần kaki nam thanh lịch là lựa chọn hoàn hảo cho phái mạnh yêu thích sự thoải mái và phong cách tinh tế. Với chất liệu kaki cao cấp, mềm mại và bền bỉ, sản phẩm mang lại cảm giác dễ chịu suốt cả ngày dài. Thiết kế dáng đứng hoặc slim-fit, tôn lên vẻ nam tính và chỉnh chu trong mọi hoàn cảnh. Đường may tỉ mỉ, màu sắc trung tính như đen, nâu, be dễ dàng phối hợp với nhiều kiểu trang phục, từ áo sơ mi lịch lãm đến áo thun năng động. Phù hợp cho cả đi làm, đi chơi hoặc dự sự kiện, quần kaki nam thanh lịch là item không thể thiếu trong tủ đồ của quý ông hiện đại.', '750000.00', '17325182647.jpg', '100000.00', 9, 39, 1, '2024-11-25 14:04:24', NULL),
(189, 'Giày thể thao nam phong cách', 'Giày thể thao nam phong cách là sự kết hợp hoàn hảo giữa thiết kế hiện đại và tính năng vượt trội, mang đến vẻ ngoài năng động và đầy cá tính. Với chất liệu cao cấp, đế giày êm ái và khả năng chống trơn trượt, sản phẩm đảm bảo sự thoải mái tối đa trong mọi hoạt động. Thiết kế thời thượng với các chi tiết độc đáo và phối màu ấn tượng, giày thể thao dễ dàng phối hợp với nhiều trang phục từ quần jeans, jogger đến shorts. Phù hợp cho cả luyện tập thể thao, đi chơi hay dạo phố, giày thể thao nam phong cách không chỉ giúp bạn thoải mái vận động mà còn thể hiện gu thời trang nổi bật.', '220000.00', '173251841111.jpg', '100000.00', 88, 39, 1, '2024-11-25 14:06:51', NULL),
(190, 'Balo nam thời trang', 'Balo nam thời trang là phụ kiện lý tưởng dành cho những chàng trai yêu thích sự tiện dụng và phong cách hiện đại. Được thiết kế từ chất liệu cao cấp như vải chống thấm hoặc da bền bỉ, balo đảm bảo độ bền lâu dài và dễ dàng bảo quản. Không gian rộng rãi với nhiều ngăn tiện ích giúp bạn đựng laptop, sách vở, và các vật dụng cá nhân một cách gọn gàng. Thiết kế đơn giản nhưng tinh tế, với các chi tiết như dây đeo êm ái, khóa kéo chắc chắn và logo nổi bật, balo nam thời trang phù hợp cho cả đi học, đi làm hoặc du lịch. Dễ dàng phối hợp với nhiều phong cách, balo là người bạn đồng hành không thể thiếu trong cuộc sống năng động hàng ngày.', '1500000.00', '17325185610.jpg', '650000.00', 345, 39, 1, '2024-11-25 14:09:21', NULL),
(191, 'Đồng hồ nam dây da cao cấp', 'Đồng hồ nam dây da cao cấp là biểu tượng của sự lịch lãm và phong cách đẳng cấp dành cho phái mạnh. Với thiết kế tinh tế, mặt đồng hồ được chế tác từ chất liệu chống xước, kết hợp cùng dây da thật mềm mại, mang lại cảm giác thoải mái và sang trọng khi đeo. Các chi tiết như kim chỉ, vạch giờ được gia công tỉ mỉ, tạo nên sự chính xác và nổi bật. Kiểu dáng cổ điển pha chút hiện đại, phù hợp cho mọi dịp, từ công sở đến các buổi tiệc trang trọng. Đồng hồ nam dây da cao cấp không chỉ là một phụ kiện thời trang mà còn là tuyên ngôn về phong cách và sự thành đạt của người đàn ông.', '5000000.00', '173251869598.jpg', '3500000.00', 10, 40, 1, '2024-11-25 14:11:35', NULL),
(192, 'Đồng hồ nữ thanh lịch', 'Đồng hồ nữ thanh lịch là phụ kiện hoàn hảo để tôn lên vẻ đẹp tinh tế và phong cách thời thượng của phái đẹp. Với thiết kế sang trọng, mặt đồng hồ nhỏ gọn, được chế tác từ chất liệu chống xước cao cấp, sản phẩm mang đến sự bền bỉ và quý phái. Dây đeo tinh tế bằng da hoặc kim loại với các chi tiết gia công tỉ mỉ, tạo điểm nhấn đầy cuốn hút. Đồng hồ nữ thanh lịch phù hợp với mọi dịp, từ công sở chuyên nghiệp đến những buổi gặp gỡ quan trọng. Đây không chỉ là công cụ quản lý thời gian mà còn là món phụ kiện giúp bạn thể hiện phong cách và đẳng cấp riêng.', '10000000.00', '173251879996.jpg', '5000000.00', 5, 40, 1, '2024-11-25 14:13:19', NULL),
(193, 'Đồng hồ thể thao đa năng', 'Đồng hồ thể thao đa năng là sự lựa chọn hoàn hảo cho những người yêu thích sự năng động và tiện ích trong cuộc sống hàng ngày. Với thiết kế mạnh mẽ, hiện đại, đồng hồ được trang bị nhiều tính năng vượt trội như đo nhịp tim, đếm bước chân, bấm giờ, và khả năng chống nước. Chất liệu cao cấp từ mặt kính chống xước và dây đeo bền bỉ đảm bảo độ bền lâu dài trong mọi hoạt động. Đồng hồ thể thao đa năng phù hợp cho các buổi tập luyện, dã ngoại hay thậm chí là sử dụng hàng ngày. Một phụ kiện không chỉ giúp bạn quản lý thời gian mà còn hỗ trợ theo dõi sức khỏe và nâng tầm phong cách thể thao của bạn.', '3500000.00', '173251892994.jpg', '550000.00', 49, 40, 1, '2024-11-25 14:15:29', NULL),
(194, 'Đồng hồ trẻ em thông minh', 'Đồng hồ trẻ em thông minh là thiết bị hiện đại, mang đến sự tiện lợi và an tâm cho cả bé và phụ huynh. Được thiết kế với kiểu dáng đáng yêu và màu sắc tươi sáng, sản phẩm phù hợp với sở thích của trẻ nhỏ. Tích hợp nhiều tính năng thông minh như định vị GPS, gọi điện, nhắn tin, và cảnh báo an toàn, đồng hồ giúp bố mẹ dễ dàng theo dõi và liên lạc với con mọi lúc, mọi nơi. Màn hình cảm ứng thân thiện, dễ sử dụng cùng chất liệu dây đeo mềm mại, không gây kích ứng da. Đồng hồ trẻ em thông minh không chỉ là món phụ kiện thời trang mà còn là người bạn đồng hành đáng tin cậy của trẻ trong cuộc sống hàng ngày.', '500000.00', '173251906991.jpg', '20000.00', 19, 40, 1, '2024-11-25 14:17:49', NULL),
(195, 'Smart Watch', 'Smartwatch là thiết bị công nghệ hiện đại kết hợp hoàn hảo giữa tính năng thông minh và phong cách thời trang. Với thiết kế tinh tế, màn hình cảm ứng sắc nét và khả năng tùy chỉnh mặt đồng hồ, smartwatch mang đến sự tiện lợi và cá tính riêng. Sản phẩm tích hợp nhiều tính năng đa dạng như đo nhịp tim, theo dõi giấc ngủ, đếm bước chân, thông báo cuộc gọi và tin nhắn, cùng khả năng đồng bộ với điện thoại thông minh. Chất liệu cao cấp, dây đeo bền bỉ và chống nước hiệu quả, smartwatch phù hợp cho cả luyện tập thể thao, làm việc và giải trí. Đây không chỉ là một thiết bị công nghệ mà còn là phụ kiện thời trang không thể thiếu trong cuộc sống hiện đại.', '6000000.00', '173251916586.jpg', '600000.00', 6998, 40, 1, '2024-11-25 14:19:25', NULL),
(196, 'Áo thun trẻ em', 'Áo thun trẻ em là lựa chọn lý tưởng dành cho các bé, mang lại sự thoải mái và phong cách đáng yêu trong mọi hoạt động hàng ngày. Với chất liệu cotton cao cấp, mềm mại và thấm hút mồ hôi tốt, áo thun giúp bé luôn dễ chịu, ngay cả khi vận động nhiều. Thiết kế đa dạng với màu sắc tươi sáng, hình in ngộ nghĩnh và đáng yêu, phù hợp với sở thích của trẻ nhỏ. Form dáng thoải mái, đường may tỉ mỉ, an toàn cho làn da nhạy cảm của bé. Áo thun trẻ em dễ dàng phối hợp với quần short, quần jeans hoặc chân váy, là lựa chọn hoàn hảo cho bé khi đi học, đi chơi hoặc tham gia các hoạt động ngoài trời.', '50000.00', '173251943285.jpg', '10000.00', 1, 42, 1, '2024-11-25 14:23:52', NULL),
(197, 'Quần short trẻ em', 'Quần short trẻ em là trang phục không thể thiếu, mang đến sự thoải mái và năng động cho các bé trong mọi hoạt động. Được làm từ chất liệu cotton hoặc denim cao cấp, mềm mại và thoáng khí, sản phẩm đảm bảo sự dễ chịu ngay cả khi bé vui chơi cả ngày dài. Thiết kế đa dạng với form dáng vừa vặn, lưng thun co giãn giúp bé dễ dàng mặc vào và vận động thoải mái. Màu sắc tươi sáng, họa tiết đáng yêu hoặc phong cách tối giản phù hợp với mọi sở thích của trẻ nhỏ. Quần short trẻ em dễ dàng phối hợp với áo thun, áo sơ mi hay áo tank top, là lựa chọn hoàn hảo cho bé khi đi học, đi chơi hoặc tham gia các hoạt động ngoài trời.', '45000.00', '173251953382.jpg', '30000.00', 0, 42, 1, '2024-11-25 14:25:33', NULL),
(198, 'Giày thể thao trẻ em', 'Giày thể thao trẻ em là sự lựa chọn hoàn hảo dành cho các bé yêu thích sự năng động và thoải mái. Với thiết kế hiện đại, màu sắc tươi sáng và đáng yêu, sản phẩm không chỉ giúp bé nổi bật mà còn hỗ trợ tốt trong mọi hoạt động vui chơi. Chất liệu cao cấp, thoáng khí, kết hợp với đế giày êm ái và chống trơn trượt, đảm bảo an toàn và sự dễ chịu tối đa khi bé di chuyển. Thiết kế dây thun hoặc dán tiện lợi, giúp bé dễ dàng mang vào và tháo ra. Giày thể thao trẻ em phù hợp để kết hợp với nhiều trang phục khác nhau, từ quần jeans, quần short đến váy, mang đến vẻ ngoài năng động và khỏe khoắn cho bé trong mọi hoàn cảnh.', '700000.00', '173251961477.jpg', '100000.00', 45, 42, 1, '2024-11-25 14:26:54', NULL),
(199, 'Balo hoạt hình đáng yêu', 'Balo hoạt hình đáng yêu là món phụ kiện hoàn hảo dành cho các bé, mang đến sự tiện dụng và vẻ ngoài ngộ nghĩnh, dễ thương. Với thiết kế lấy cảm hứng từ các nhân vật hoạt hình yêu thích, màu sắc tươi sáng và họa tiết nổi bật, balo chắc chắn sẽ khiến các bé mê mẩn. Chất liệu cao cấp, nhẹ nhàng và bền bỉ, đảm bảo an toàn cho bé khi sử dụng hàng ngày. Ngăn chứa rộng rãi và dây đeo êm ái, dễ dàng điều chỉnh, giúp bé mang theo sách vở, đồ chơi hay đồ dùng cá nhân một cách gọn gàng. Balo hoạt hình đáng yêu không chỉ là vật dụng hữu ích mà còn là người bạn đồng hành lý tưởng của bé trong mỗi ngày đến trường hay các chuyến dã ngoại.', '10000000.00', '173251970674.jpg', '8000000.00', 899, 42, 1, '2024-11-25 14:28:26', NULL),
(200, 'Mũ trẻ em chống nắng', 'Mũ trẻ em chống nắng là phụ kiện không thể thiếu để bảo vệ làn da nhạy cảm của bé khỏi tác hại của ánh nắng mặt trời. Được làm từ chất liệu cao cấp, thoáng mát và nhẹ nhàng, mũ mang lại sự thoải mái tối đa cho bé khi vui chơi ngoài trời. Thiết kế đáng yêu với các họa tiết ngộ nghĩnh, màu sắc tươi sáng cùng kiểu dáng đa dạng như mũ vành rộng, mũ lưỡi trai hoặc mũ tai bèo, phù hợp với sở thích của bé. Mũ được trang bị thêm dây cột cố định hoặc thun co giãn, giúp giữ mũ chắc chắn ngay cả khi bé vận động nhiều. Mũ trẻ em chống nắng không chỉ bảo vệ sức khỏe mà còn là phụ kiện thời trang đáng yêu, giúp bé luôn nổi bật và an toàn trong mọi hoạt động.', '50000.00', '173251984171.jpg', '15000.00', 1, 42, 1, '2024-11-25 14:30:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `san_pham_yeu_thichs`
--

CREATE TABLE `san_pham_yeu_thichs` (
  `id` int NOT NULL,
  `nguoi_dung_id` int DEFAULT NULL,
  `san_pham_id` int DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `san_pham_yeu_thichs`
--

INSERT INTO `san_pham_yeu_thichs` (`id`, `nguoi_dung_id`, `san_pham_id`, `ngay_tao`) VALUES
(8, 32, 196, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tin_tucs`
--

CREATE TABLE `tin_tucs` (
  `id` int NOT NULL,
  `tieu_de` varchar(100) DEFAULT NULL,
  `noi_dung` text,
  `ngay_tao` datetime DEFAULT NULL,
  `trang_thai` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tin_tucs`
--

INSERT INTO `tin_tucs` (`id`, `tieu_de`, `noi_dung`, `ngay_tao`, `trang_thai`) VALUES
(10, 'Bùng Nổ Ưu Đãi Cuối Năm - Săn Ngay BST Mới', '\r\nBùng Nổ Ưu Đãi Cuối Năm - Săn Ngay BST Mới\r\n\r\nChào đón năm mới với bộ sưu tập thời trang cực kỳ hot! Hãy nhanh tay săn ngay những món đồ yêu thích từ BST mới với ưu đãi hấp dẫn chỉ có dịp cuối năm. Đây là cơ hội tuyệt vời để làm mới tủ đồ của bạn với những thiết kế sang trọng, hiện đại và đầy phong cách. Đừng bỏ lỡ cơ hội sở hữu những sản phẩm chất lượng, giá cả ưu đãi để khởi động năm mới đầy may mắn và thịnh vượng!', '2024-12-07 02:48:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_don_hangs`
--

CREATE TABLE `trang_thai_don_hangs` (
  `id` int NOT NULL,
  `ten_trang_thai` varchar(50) DEFAULT NULL,
  `mo_ta` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trang_thai_don_hangs`
--

INSERT INTO `trang_thai_don_hangs` (`id`, `ten_trang_thai`, `mo_ta`) VALUES
(11, 'Đã đặt hàng', 'Đơn hàng đã được đặt bởi khách hàng'),
(13, 'Đã xác nhận', NULL),
(14, 'Đang giao hàng', 'Đơn hàng đang được vận chuyển đến khách hàng'),
(15, 'Đã giao hàng', 'Đơn hàng đã được giao thành công đến khách hàng'),
(16, 'Đơn hàng thành công', NULL),
(17, 'Đơn hàng thất bại', NULL),
(18, 'Đã hủy', 'Đơn hàng đã bị hủy do khách hàng yêu cầu hoặc lỗi hệ thống');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bai_viets`
--
ALTER TABLE `bai_viets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_pham_id` (`san_pham_id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`);

--
-- Indexes for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `don_hang_id` (`don_hang_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `chi_tiet_san_phams`
--
ALTER TABLE `chi_tiet_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `danh_gias`
--
ALTER TABLE `danh_gias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_pham_id` (`san_pham_id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`);

--
-- Indexes for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`),
  ADD KEY `trang_thai_id` (`trang_thai_id`),
  ADD KEY `fk_san_pham_id` (`san_pham_id`);

--
-- Indexes for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`);

--
-- Indexes for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `khuyen_mais`
--
ALTER TABLE `khuyen_mais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lien_hes`
--
ALTER TABLE `lien_hes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nguoi_dungs`
--
ALTER TABLE `nguoi_dungs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danh_muc_id` (`danh_muc_id`);

--
-- Indexes for table `san_pham_yeu_thichs`
--
ALTER TABLE `san_pham_yeu_thichs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `tin_tucs`
--
ALTER TABLE `tin_tucs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bai_viets`
--
ALTER TABLE `bai_viets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `binh_luans`
--
ALTER TABLE `binh_luans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `chi_tiet_san_phams`
--
ALTER TABLE `chi_tiet_san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `danh_gias`
--
ALTER TABLE `danh_gias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `khuyen_mais`
--
ALTER TABLE `khuyen_mais`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lien_hes`
--
ALTER TABLE `lien_hes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nguoi_dungs`
--
ALTER TABLE `nguoi_dungs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `san_pham_yeu_thichs`
--
ALTER TABLE `san_pham_yeu_thichs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tin_tucs`
--
ALTER TABLE `tin_tucs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bai_viets`
--
ALTER TABLE `bai_viets`
  ADD CONSTRAINT `bai_viets_ibfk_1` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dungs` (`id`);

--
-- Constraints for table `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD CONSTRAINT `binh_luans_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `binh_luans_ibfk_2` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dungs` (`id`);

--
-- Constraints for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD CONSTRAINT `chi_tiet_don_hangs_ibfk_1` FOREIGN KEY (`don_hang_id`) REFERENCES `don_hangs` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hangs_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`);

--
-- Constraints for table `chi_tiet_san_phams`
--
ALTER TABLE `chi_tiet_san_phams`
  ADD CONSTRAINT `chi_tiet_san_phams_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`);

--
-- Constraints for table `danh_gias`
--
ALTER TABLE `danh_gias`
  ADD CONSTRAINT `danh_gias_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `danh_gias_ibfk_2` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dungs` (`id`);

--
-- Constraints for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD CONSTRAINT `don_hangs_ibfk_1` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dungs` (`id`),
  ADD CONSTRAINT `don_hangs_ibfk_2` FOREIGN KEY (`trang_thai_id`) REFERENCES `trang_thai_don_hangs` (`id`),
  ADD CONSTRAINT `fk_san_pham_id` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD CONSTRAINT `gio_hangs_ibfk_1` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dungs` (`id`);

--
-- Constraints for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  ADD CONSTRAINT `hinh_anh_san_phams_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`);

--
-- Constraints for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD CONSTRAINT `san_phams_ibfk_1` FOREIGN KEY (`danh_muc_id`) REFERENCES `danh_mucs` (`id`);

--
-- Constraints for table `san_pham_yeu_thichs`
--
ALTER TABLE `san_pham_yeu_thichs`
  ADD CONSTRAINT `san_pham_yeu_thichs_ibfk_1` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `nguoi_dungs` (`id`),
  ADD CONSTRAINT `san_pham_yeu_thichs_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
