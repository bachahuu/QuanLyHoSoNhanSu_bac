<?php
// Bao gồm file kết nối cơ sở dữ liệu
require_once '../Connect.php';
session_start();

// Kiểm tra người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['TenDangNhap'])) {
    echo '<script>alert("Vui lòng đăng nhập!"); window.location.href = "login.php";</script>';
    exit;
}

// Lấy tên đăng nhập từ session
$tenDangNhap = $_SESSION['TenDangNhap'];

// Cập nhật mật khẩu mới vào cơ sở dữ liệu
$trangThaiTaiKhoan = 'Bị khóa';
$sqlCapNhatTrangThai = "UPDATE NguoiDung SET TrangThaiTaiKhoan = '$trangThaiTaiKhoan' WHERE TenDangNhap = ?";
$chuoiCapNhat = $conn->prepare($sqlCapNhatTrangThai);
$chuoiCapNhat->bind_param("s", $tenDangNhap);

if ($chuoiCapNhat->execute()) {
    echo '<script>alert("Tài khoản khóa thành công!"); window.location.href = "ThongTinCaNhan_Index.php";</script>';
} else {
    echo '<script>alert("Có lỗi xảy ra. Vui lòng thử lại!"); window.history.back();</script>';
}

$chuoiCapNhat->close();
$conn->close();
?>
