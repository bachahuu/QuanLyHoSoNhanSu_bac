<?php
// Kết nối cơ sở dữ liệu
include '../Connect.php'; // File này chứa kết nối đến database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $maNhanSu = $_POST["MaNhanSu"];
    $hoTen = $_POST["HoTen"];
    $gioiTinh = $_POST["GioiTinh"];
    $namSinh = $_POST["NamSinh"];
    $cmndCccd = $_POST["CMND_CCCD"];
    $soDienThoai = $_POST["SoDienThoai"];
    $email = $_POST["Email"];
    $diaChi = $_POST["DiaChi"];
    $ngayVaoLam = $_POST["NgayVaoLam"];
    $ngayNghiHuu = $_POST["NgayNghiHuu"];
    $tinhTrangLamViec = $_POST["TinhTrangLamViec"];
    $loaiHopDong = $_POST["LoaiHopDong"];
    $tenChucVu = $_POST["TenChucVu"];

    // Kiểm tra dữ liệu hợp lệ (nếu cần)

    // Câu lệnh SQL để cập nhật
    $sql = "UPDATE NhanSu 
            SET 
                HoTen = ?, 
                GioiTinh = ?, 
                NgaySinh = ?, 
                CMND_CCCD = ?, 
                SoDienThoai = ?, 
                Email = ?, 
                DiaChi = ?, 
                NgayVaoLam = ?, 
                NgayNghiHuu = ?, 
                TinhTrangLamViec = ?, 
                LoaiHopDong = ?, 
                MaChucVu = ?
            WHERE MaNhanSu = ?";

    // Chuẩn bị và thực thi câu lệnh
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssssi",
        $hoTen,
        $gioiTinh,
        $namSinh,
        $cmndCccd,
        $soDienThoai,
        $email,
        $diaChi,
        $ngayVaoLam,
        $ngayNghiHuu,
        $tinhTrangLamViec,
        $loaiHopDong,
        $tenChucVu,
        $maNhanSu
    );

    // Kiểm tra kết quả
    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật nhân sự thành công!'); window.location.href = 'NhanSu_Index.php';</script>";
    } else {
        echo "<script>alert('Cập nhật nhân sự thất bại!'); window.location.href = 'NhanSu_Index.php';</script>";
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
} else {
    // Nếu không phải phương thức POST, chuyển hướng về danh sách
    header("Location: NhanSu_Index.php");
    exit();
}
?>
