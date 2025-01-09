-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 29, 2024 lúc 04:10 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlyhosonhansu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baocaothongke`
--

CREATE TABLE `baocaothongke` (
  `MaBaoCao` int(11) NOT NULL,
  `NgayBaoCao` date NOT NULL,
  `LoaiBaoCao` varchar(100) DEFAULT NULL,
  `NoiDung` text DEFAULT NULL,
  `FileBaoCao` varchar(255) DEFAULT NULL,
  `TrangThaiBaoCao` enum('Hoàn thành','Chờ duyệt','Từ chối') DEFAULT 'Chờ duyệt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `baocaothongke`
--

INSERT INTO `baocaothongke` (`MaBaoCao`, `NgayBaoCao`, `LoaiBaoCao`, `NoiDung`, `FileBaoCao`, `TrangThaiBaoCao`) VALUES
(1, '2024-01-31', 'Báo cáo tháng', 'Thống kê nhân sự trong tháng 1', 'thang1.xlsx', 'Chờ duyệt'),
(2, '2024-02-28', 'Báo cáo tháng', 'Thống kê nhân sự trong tháng 2', 'thang2.xlsx', 'Chờ duyệt'),
(3, '2024-03-31', 'Báo cáo quý', 'Thống kê nhân sự trong quý 1', 'quy1.xlsx', 'Chờ duyệt'),
(4, '2024-04-30', 'Báo cáo tháng', 'Thống kê nhân sự trong tháng 4', 'thang4.xlsx', 'Chờ duyệt'),
(5, '2024-05-31', 'Báo cáo tháng', 'Thống kê nhân sự trong tháng 5', 'thang5.xlsx', 'Chờ duyệt'),
(6, '2024-06-30', 'Báo cáo quý', 'Thống kê nhân sự trong quý 2', 'quy2.xlsx', 'Chờ duyệt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chucvu`
--

CREATE TABLE `chucvu` (
  `MaChucVu` int(11) NOT NULL,
  `TenChucVu` varchar(100) NOT NULL,
  `MoTa` text DEFAULT NULL,
  `QuyDinhChucVu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chucvu`
--

INSERT INTO `chucvu` (`MaChucVu`, `TenChucVu`, `MoTa`, `QuyDinhChucVu`) VALUES
(1, 'Giám đốc', 'Quản lý toàn bộ công ty', 'Yêu cầu tối thiểu 10 năm kinh nghiệm'),
(2, 'Phó Giám đốc', 'Hỗ trợ giám đốc', 'Yêu cầu tối thiểu 8 năm kinh nghiệm'),
(3, 'Trưởng phòng', 'Quản lý một phòng ban', 'Yêu cầu tối thiểu 5 năm kinh nghiệm'),
(4, 'Nhân viên Kỹ thuật', 'Thực hiện các công việc kỹ thuật', 'Không yêu cầu kinh nghiệm'),
(5, 'Nhân viên Kế toán', 'Quản lý tài chính và kế toán', 'Yêu cầu có bằng cấp liên quan'),
(6, 'Thực tập sinh', 'Hỗ trợ các công việc văn phòng', 'Không yêu cầu kinh nghiệm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `congviec`
--

CREATE TABLE `congviec` (
  `MaCongViec` int(11) NOT NULL,
  `MaNhanSu` int(11) NOT NULL,
  `MaChucVu` int(11) NOT NULL,
  `KhoaPhongBan` varchar(100) NOT NULL,
  `HeSoLuong` decimal(4,2) NOT NULL,
  `PhuCapChucVu` decimal(10,2) DEFAULT NULL,
  `SoGioLamViec` int(11) DEFAULT 40,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `congviec`
--

INSERT INTO `congviec` (`MaCongViec`, `MaNhanSu`, `MaChucVu`, `KhoaPhongBan`, `HeSoLuong`, `PhuCapChucVu`, `SoGioLamViec`, `NgayBatDau`, `NgayKetThuc`) VALUES
(1, 1, 1, 'Ban Điều Hành', 5.50, 2000000.00, 40, '2010-01-15', NULL),
(2, 2, 2, 'Ban Kế Toán', 4.00, 1500000.00, 40, '2012-03-01', NULL),
(3, 3, 3, 'Phòng Kỹ Thuật', 3.50, 1000000.00, 40, '2015-07-10', NULL),
(4, 4, 4, 'Phòng Nhân Sự', 3.00, 800000.00, 40, '2018-09-01', NULL),
(5, 5, 5, 'Phòng Tài Chính', 2.80, 700000.00, 40, '2020-05-01', NULL),
(6, 6, 6, 'Phòng Đào Tạo', 2.50, 500000.00, 40, '2021-10-15', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsucongtac`
--

CREATE TABLE `lichsucongtac` (
  `MaLichSu` int(11) NOT NULL,
  `MaNhanSu` int(11) NOT NULL,
  `PhongBan` varchar(100) DEFAULT NULL,
  `ChucVu` varchar(100) DEFAULT NULL,
  `ThoiGianBatDau` date DEFAULT NULL,
  `ThoiGianKetThuc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lichsucongtac`
--

INSERT INTO `lichsucongtac` (`MaLichSu`, `MaNhanSu`, `PhongBan`, `ChucVu`, `ThoiGianBatDau`, `ThoiGianKetThuc`) VALUES
(1, 1, 'Phòng Kinh doanh', 'Trưởng phòng', '2020-01-15', '2023-12-31'),
(3, 3, 'Phòng Tài chính', 'Phó phòng', '2018-05-01', '2022-08-31'),
(5, 5, 'Phòng Marketing', 'Trợ lý', '2019-11-01', NULL),
(10, 2, 'Phòng nhân sự', 'nhân viên', '2024-11-27', '2024-12-04'),
(13, 1, 'Phòng nhân sự', 'giám đốc', '2024-12-20', '2024-12-24'),
(15, 5, 'Phòng marketing', 'trưởng phòng', '2024-12-11', '2024-12-20'),
(19, 2, 'Phòng marketing', 'nhân viên', '2024-12-29', '0000-00-00'),
(20, 3, 'Phòng marketing', 'nhân viên', '2024-12-07', '0000-00-00'),
(21, 2, 'Phòng nhân sự', 'giám đốc', '2024-12-12', '2025-01-02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luong`
--

CREATE TABLE `luong` (
  `MaLuong` int(11) NOT NULL,
  `MaNhanSu` int(11) NOT NULL,
  `MucLuongCoBan` decimal(10,2) NOT NULL,
  `PhuCap` decimal(10,2) DEFAULT NULL,
  `KhauTru` decimal(10,2) DEFAULT NULL,
  `ThueThuNhap` decimal(10,2) DEFAULT NULL,
  `SoNgayLamViec` int(11) NOT NULL DEFAULT 26,
  `TongLuong` decimal(10,2) GENERATED ALWAYS AS (`MucLuongCoBan` / 26 * `SoNgayLamViec` + coalesce(`PhuCap`,0) - coalesce(`KhauTru`,0) - coalesce(`ThueThuNhap`,0)) STORED,
  `ThangLuong` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `luong`
--

INSERT INTO `luong` (`MaLuong`, `MaNhanSu`, `MucLuongCoBan`, `PhuCap`, `KhauTru`, `ThueThuNhap`, `SoNgayLamViec`, `ThangLuong`) VALUES
(1, 1, 20000000.00, 3000000.00, 2000000.00, 1500000.00, 26, '2024-01-31'),
(2, 2, 18000000.00, 2500000.00, 1500000.00, 1000000.00, 26, '2024-01-31'),
(3, 3, 15000000.00, 2000000.00, 1000000.00, 800000.00, 26, '2024-01-31'),
(4, 4, 12000000.00, 1000000.00, 500000.00, 400000.00, 26, '2024-01-31'),
(5, 5, 10000000.00, 800000.00, 300000.00, 200000.00, 26, '2024-01-31'),
(6, 6, 8000000.00, 500000.00, 200000.00, 100000.00, 26, '2024-01-31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nghiphep`
--

CREATE TABLE `nghiphep` (
  `MaNghiPhep` int(11) NOT NULL,
  `MaNhanSu` int(11) NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL,
  `LyDo` text DEFAULT NULL,
  `SoNgayPhep` int(11) NOT NULL,
  `SoNgayPhepConLai` int(11) DEFAULT 12,
  `TrangThai` enum('Đã duyệt','Chờ duyệt','Từ chối') DEFAULT 'Chờ duyệt',
  `GhiChu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nghiphep`
--

INSERT INTO `nghiphep` (`MaNghiPhep`, `MaNhanSu`, `NgayBatDau`, `NgayKetThuc`, `LyDo`, `SoNgayPhep`, `SoNgayPhepConLai`, `TrangThai`, `GhiChu`) VALUES
(1, 1, '2024-01-01', '2024-01-05', 'Đi du lịch', 5, 12, 'Chờ duyệt', NULL),
(2, 2, '2024-02-10', '2024-02-12', 'Thăm gia đình', 3, 12, 'Chờ duyệt', NULL),
(3, 3, '2024-03-15', '2024-03-18', 'Chăm sóc sức khỏe', 4, 12, 'Chờ duyệt', NULL),
(4, 4, '2024-04-01', '2024-04-03', 'Việc cá nhân', 3, 12, 'Chờ duyệt', NULL),
(5, 5, '2024-05-20', '2024-05-22', 'Học thêm kỹ năng', 3, 12, 'Chờ duyệt', NULL),
(6, 6, '2024-06-10', '2024-06-15', 'Tham gia hội thảo', 6, 12, 'Chờ duyệt', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `MaNguoiDung` int(11) NOT NULL,
  `TenDangNhap` varchar(50) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `HoTen` varchar(100) DEFAULT NULL,
  `SoDienThoai` varchar(20) DEFAULT NULL,
  `DiaChi` text DEFAULT NULL,
  `PhanQuyen` enum('Admin','User') NOT NULL DEFAULT 'User',
  `TrangThaiTaiKhoan` enum('Hoạt động','Bị khóa') DEFAULT 'Hoạt động',
  `NgayTao` date DEFAULT curdate(),
  `LanDangNhapCuoi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `MaNhanSu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`MaNguoiDung`, `TenDangNhap`, `MatKhau`, `Email`, `HoTen`, `SoDienThoai`, `DiaChi`, `PhanQuyen`, `TrangThaiTaiKhoan`, `NgayTao`, `LanDangNhapCuoi`, `MaNhanSu`) VALUES
(1, 'admin1', 'hashed_password1', 'admin1@example.com', 'Nguyễn Văn A', '0987654321', 'Hà Nội', 'Admin', 'Hoạt động', '2024-11-30', '2024-11-30 09:07:34', 1),
(3, 'user3', '$2y$10$buonWujsy8Jnl1lq4Q/rO.gGC71t2j/gwKhJ2wXnqraGgxWump.dK', 'levanc@example.com', 'Lê Văn C', '0901234567', 'Đà Nẵng', 'User', 'Hoạt động', '2024-11-30', '2024-12-27 15:38:51', 3),
(4, 'ke_toan1', '$2y$10$JhStyBhrD8uOVz7rnC2YPugm.3vj04lo7xoIbX1dpqLhgX52cz/yK', 'phamthid@example.com', 'Phạm Thị D', '0934567890', 'Hải Phòng', 'Kế Toán', 'Hoạt động', '2024-11-30', '2024-12-26 13:22:34', 4),
(5, 'user5', 'hashed_password5', 'user5@example.com', 'Vũ Minh E', '0945678901', 'Huế', 'User', 'Hoạt động', '2024-11-30', '2024-11-30 09:07:34', 5),
(6, 'user6', 'hashed_password6', 'user6@example.com', 'Hoàng Anh F', '0956789012', 'Cần Thơ', 'User', 'Hoạt động', '2024-11-30', '2024-11-30 09:07:34', 6),
(7, 'admin2', '$2y$10$TGn25KkCtuQp67c/xr/AO.z2U5Q6XWAKI2rEfU.CMaZ/N7DHC5XKG', '', '', '', '', 'Admin', 'Hoạt động', '2024-11-30', '2024-11-30 09:25:31', NULL),
(10, 'user', '$2y$10$vRssjSdSFZSkxRpZvOlBceyI6m4iu1wzjbNagUrSmIz0oqde9A8b6', 'nguyenvana@example.com', 'Nguyễn Văn A', '0987654321', 'Hà Nội', 'User', 'Hoạt động', '2024-11-30', '2024-12-27 15:45:45', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhansu`
--

CREATE TABLE `nhansu` (
  `MaNhanSu` int(11) NOT NULL,
  `MaDinhDanh` varchar(50) DEFAULT NULL,
  `HoTen` varchar(100) NOT NULL,
  `GioiTinh` enum('Nam','Nữ') NOT NULL,
  `NgaySinh` date DEFAULT NULL,
  `CMND_CCCD` varchar(20) DEFAULT NULL,
  `SoDienThoai` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `DiaChi` text DEFAULT NULL,
  `NgayVaoLam` date NOT NULL,
  `NgayNghiHuu` date DEFAULT NULL,
  `TinhTrangLamViec` enum('Đang làm','Đã nghỉ') DEFAULT 'Đang làm',
  `LoaiHopDong` varchar(50) DEFAULT NULL,
  `MaChucVu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhansu`
--

INSERT INTO `nhansu` (`MaNhanSu`, `MaDinhDanh`, `HoTen`, `GioiTinh`, `NgaySinh`, `CMND_CCCD`, `SoDienThoai`, `Email`, `DiaChi`, `NgayVaoLam`, `NgayNghiHuu`, `TinhTrangLamViec`, `LoaiHopDong`, `MaChucVu`) VALUES
(1, 'NV001', 'Nguyễn Văn A', 'Nam', '1985-02-20', '0123456789', '0987654321', 'nguyenvana@example.com', 'Hà Nội', '2010-01-15', '2035-01-15', 'Đang làm', 'Toàn thời gian', 2),
(2, 'NV002', 'Trần Thị B', 'Nữ', '1990-06-15', '9876543210', '0912345678', 'tranthib@example.com', 'TP. Hồ Chí Minh', '2012-03-01', NULL, 'Đang làm', NULL, 2),
(3, 'NV003', 'Lê Văn C', 'Nam', '1987-12-05', '1122334455', '0901234567', 'levanc@example.com', 'Đà Nẵng', '2015-07-10', NULL, 'Đang làm', NULL, 3),
(4, 'NV004', 'Phạm Thị D', 'Nữ', '1995-09-10', '2233445566', '0934567890', 'phamthid@example.com', 'Hải Phòng', '2018-09-01', NULL, 'Đang làm', NULL, 4),
(5, 'NV005', 'Vũ Minh E', 'Nam', '1998-04-25', '3344556677', '0945678901', 'vuminhe@example.com', 'Huế', '2020-05-01', NULL, 'Đang làm', NULL, 5),
(6, 'NV006', 'Hoàng Anh F', 'Nam', '2000-11-11', '4455667788', '0956789012', 'hoanganhf@example.com', 'Cần Thơ', '2021-10-15', NULL, 'Đang làm', NULL, 6);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baocaothongke`
--
ALTER TABLE `baocaothongke`
  ADD PRIMARY KEY (`MaBaoCao`);

--
-- Chỉ mục cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`MaChucVu`);

--
-- Chỉ mục cho bảng `congviec`
--
ALTER TABLE `congviec`
  ADD PRIMARY KEY (`MaCongViec`),
  ADD KEY `MaNhanSu` (`MaNhanSu`),
  ADD KEY `MaChucVu` (`MaChucVu`);

--
-- Chỉ mục cho bảng `lichsucongtac`
--
ALTER TABLE `lichsucongtac`
  ADD PRIMARY KEY (`MaLichSu`),
  ADD KEY `MaNhanSu` (`MaNhanSu`);

--
-- Chỉ mục cho bảng `luong`
--
ALTER TABLE `luong`
  ADD PRIMARY KEY (`MaLuong`),
  ADD KEY `MaNhanSu` (`MaNhanSu`);

--
-- Chỉ mục cho bảng `nghiphep`
--
ALTER TABLE `nghiphep`
  ADD PRIMARY KEY (`MaNghiPhep`),
  ADD KEY `MaNhanSu` (`MaNhanSu`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaNguoiDung`),
  ADD UNIQUE KEY `TenDangNhap` (`TenDangNhap`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `MaNhanSu` (`MaNhanSu`);

--
-- Chỉ mục cho bảng `nhansu`
--
ALTER TABLE `nhansu`
  ADD PRIMARY KEY (`MaNhanSu`),
  ADD UNIQUE KEY `CMND_CCCD` (`CMND_CCCD`),
  ADD KEY `MaChucVu` (`MaChucVu`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baocaothongke`
--
ALTER TABLE `baocaothongke`
  MODIFY `MaBaoCao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `MaChucVu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `congviec`
--
ALTER TABLE `congviec`
  MODIFY `MaCongViec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `lichsucongtac`
--
ALTER TABLE `lichsucongtac`
  MODIFY `MaLichSu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `luong`
--
ALTER TABLE `luong`
  MODIFY `MaLuong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nghiphep`
--
ALTER TABLE `nghiphep`
  MODIFY `MaNghiPhep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `MaNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `nhansu`
--
ALTER TABLE `nhansu`
  MODIFY `MaNhanSu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `congviec`
--
ALTER TABLE `congviec`
  ADD CONSTRAINT `congviec_ibfk_1` FOREIGN KEY (`MaNhanSu`) REFERENCES `nhansu` (`MaNhanSu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `congviec_ibfk_2` FOREIGN KEY (`MaChucVu`) REFERENCES `chucvu` (`MaChucVu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `lichsucongtac`
--
ALTER TABLE `lichsucongtac`
  ADD CONSTRAINT `lichsucongtac_ibfk_1` FOREIGN KEY (`MaNhanSu`) REFERENCES `nhansu` (`MaNhanSu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `luong`
--
ALTER TABLE `luong`
  ADD CONSTRAINT `luong_ibfk_1` FOREIGN KEY (`MaNhanSu`) REFERENCES `nhansu` (`MaNhanSu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nghiphep`
--
ALTER TABLE `nghiphep`
  ADD CONSTRAINT `nghiphep_ibfk_1` FOREIGN KEY (`MaNhanSu`) REFERENCES `nhansu` (`MaNhanSu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `nguoidung_ibfk_1` FOREIGN KEY (`MaNhanSu`) REFERENCES `nhansu` (`MaNhanSu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nhansu`
--
ALTER TABLE `nhansu`
  ADD CONSTRAINT `nhansu_ibfk_1` FOREIGN KEY (`MaChucVu`) REFERENCES `chucvu` (`MaChucVu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
