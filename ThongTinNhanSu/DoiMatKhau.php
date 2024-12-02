<?php
// Bao gồm file kết nối cơ sở dữ liệu
require_once '../Connect.php';
session_start();

// Kiểm tra người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['TenDangNhap'])) {
    echo '<script>alert("Vui lòng đăng nhập!"); window.location.href = "login.php";</script>';
    exit;
}

// Lấy thông tin từ form
$matKhauCu = trim($_POST['MatKhauCu']);
$matKhauMoi = trim($_POST['MatKhauMoi']);
$xacNhanMatKhau = trim($_POST['XacNhanMatKhau']);

// Kiểm tra xem mật khẩu mới và xác nhận mật khẩu có khớp không
if ($matKhauMoi !== $xacNhanMatKhau) {
    echo '<script>alert("Xác nhận mật khẩu không khớp!"); window.history.back();</script>';
    exit;
}

// Lấy tên đăng nhập từ session
$tenDangNhap = $_SESSION['TenDangNhap'];

// Lấy mật khẩu hiện tại từ cơ sở dữ liệu
$sqlLayMatKhau = "SELECT MatKhau FROM NguoiDung WHERE TenDangNhap = ?";
$chuoiChuanBi = $conn->prepare($sqlLayMatKhau);
$chuoiChuanBi->bind_param("s", $tenDangNhap);
$chuoiChuanBi->execute();
$chuoiChuanBi->bind_result($matKhauMaHoa);
$chuoiChuanBi->fetch();
$chuoiChuanBi->close();

// Kiểm tra mật khẩu cũ
if (!password_verify($matKhauCu, $matKhauMaHoa)) {
    echo '<script>alert("Mật khẩu cũ không chính xác!"); window.history.back();</script>';
    exit;
}

// Hash mật khẩu mới
$matKhauMoiMaHoa = password_hash($matKhauMoi, PASSWORD_BCRYPT);

// Cập nhật mật khẩu mới vào cơ sở dữ liệu
$sqlCapNhatMatKhau = "UPDATE NguoiDung SET MatKhau = ? WHERE TenDangNhap = ?";
$chuoiCapNhat = $conn->prepare($sqlCapNhatMatKhau);
$chuoiCapNhat->bind_param("ss", $matKhauMoiMaHoa, $tenDangNhap);

if ($chuoiCapNhat->execute()) {
    echo '<script>alert("Đổi mật khẩu thành công!"); window.location.href = "ThongTinCaNhan_Index.php";</script>';
} else {
    echo '<script>alert("Có lỗi xảy ra. Vui lòng thử lại!"); window.history.back();</script>';
}

$chuoiCapNhat->close();
$conn->close();
?>
