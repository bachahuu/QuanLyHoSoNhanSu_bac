<?php
require_once '../Connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $maNguoiDung = $_POST['MaNguoiDung'];
    $hoTen = $_POST['HoTen'];
    $email = $_POST['Email'];
    $soDienThoai = $_POST['SoDienThoai'];
    $diaChi = $_POST['DiaChi'];
    $phanQuyen = $_POST['PhanQuyen'];
    $trangThai = $_POST['TrangThai'];
    $matKhau = $_POST['MatKhau'];

    // Lấy tên đăng nhập hiện tại từ cơ sở dữ liệu để đảm bảo không chỉnh sửa
    $current_sql = "SELECT TenDangNhap, MatKhau FROM NguoiDung WHERE MaNguoiDung = '$maNguoiDung'";
    $current_result = mysqli_query($conn, $current_sql);
    $current_row = mysqli_fetch_assoc($current_result);

    if (!$current_row) {
        echo '<script>alert("Không tìm thấy người dùng!"); window.history.back();</script>';
        exit;
    }

    $tenDangNhap = $current_row['TenDangNhap']; // Giữ nguyên tên đăng nhập
    $hashed_password = $current_row['MatKhau']; // Mặc định giữ nguyên mật khẩu cũ

    // Nếu mật khẩu mới được cung cấp, mã hóa lại mật khẩu
    if (!empty($matKhau)) {
        $hashed_password = password_hash($matKhau, PASSWORD_BCRYPT);
    }

    // Câu lệnh SQL để cập nhật dữ liệu
    $update_sql = "
        UPDATE NguoiDung 
        SET 
            HoTen = '$hoTen',
            Email = '$email',
            SoDienThoai = '$soDienThoai',
            DiaChi = '$diaChi',
            MatKhau = '$hashed_password',
            PhanQuyen = '$phanQuyen',
            TrangThaiTaiKhoan = '$trangThai'
        WHERE MaNguoiDung = '$maNguoiDung'";

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $update_sql)) {
        echo '<script>alert("Sửa tài khoản người dùng thành công!"); window.location.href = "TaiKhoan_Index.php";</script>';
    } else {
        echo "Error: " . $update_sql . "<br>" . mysqli_error($conn);
    }

    // Đóng kết nối
    mysqli_close($conn);
}
?>
