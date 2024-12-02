<?php
require_once '../Connect.php'; // Kết nối cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenDangNhap = trim($_POST['tendangnhap']);
    $email = trim($_POST['Email']);

    // Kiểm tra tên đăng nhập và email trong cơ sở dữ liệu
    $sql = "SELECT * FROM NguoiDung WHERE TenDangNhap = ? AND Email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $tenDangNhap, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Nếu thông tin đúng, chuyển hướng đến trang nhập lại mật khẩu
        session_start();
        $_SESSION['reset_user'] = $tenDangNhap; // Lưu thông tin tên đăng nhập vào session
        header("Location: XuLyDatLaiMatKhau_Index.php");
        exit();
    } else {
        // Nếu thông tin không đúng, thông báo lỗi
        echo '<script>alert("Tên đăng nhập hoặc email không chính xác!"); window.history.back();</script>';
    }
    mysqli_close($conn);
}
?>
