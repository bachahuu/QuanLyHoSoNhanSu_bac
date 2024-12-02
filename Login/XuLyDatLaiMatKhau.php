<?php
require_once '../Connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['reset_user'])) {
        $tenDangNhap = $_SESSION['reset_user'];
        $matKhauMoi = trim($_POST['MatKhauMoi']);
        $nhapLaiMatKhau = trim($_POST['NhapLaiMatKhau']);

        if ($matKhauMoi === $nhapLaiMatKhau) {
            $hashed_password = password_hash($matKhauMoi, PASSWORD_BCRYPT);

            // Cập nhật mật khẩu trong cơ sở dữ liệu
            $sql = "UPDATE NguoiDung SET MatKhau = ? WHERE TenDangNhap = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $tenDangNhap);

            if (mysqli_stmt_execute($stmt)) {
                echo '<script>alert("Mật khẩu đã được cập nhật thành công!"); window.location.href="DangNhap_Index.php";</script>';
            } else {
                echo '<script>alert("Có lỗi xảy ra, vui lòng thử lại sau!"); window.history.back();</script>';
            }
        } else {
            echo '<script>alert("Mật khẩu xác nhận không khớp!"); window.history.back();</script>';
        }
    } else {
        echo '<script>alert("Yêu cầu không hợp lệ!"); window.location.href="QuenMatKhau_Index.php";</script>';
    }
    mysqli_close($conn);
}
?>
