<?php
// Kết nối cơ sở dữ liệu
require_once '../Connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $MaNhanSu = $_POST['MaNhanSu'];
    $mucLuongCoBan = $_POST['MucLuongCoBan'];
    $phuCap = $_POST['PhuCap'];
    $khauTru = $_POST['KhauTru'];
    $thueThuNhap = $_POST['ThueThuNhap'];
    $thangluong = $_POST['ThangLuong'];
    $thangluong = date('Y-m-d', strtotime($thangluong)); // Chuyển về định dạng yyyy-mm-dd

    // Tính tổng lương
    $tongLuong = $mucLuongCoBan + $phuCap - $khauTru - $thueThuNhap;

    // Kiểm tra dữ liệu đầu vào
    if (empty($MaNhanSu) || empty($mucLuongCoBan) || empty($phuCap) || empty($khauTru) || empty($thueThuNhap) || empty($thangluong)) {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin!'); window.history.back();</script>";
        exit();
    }

    // Chuẩn bị câu lệnh SQL để tránh SQL Injection
    $sql = "INSERT INTO luong (MaNhanSu, MucLuongCoBan, PhuCap, KhauTru, ThueThuNhap, TongLuong, ThangLuong) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Gắn tham số vào câu lệnh
        mysqli_stmt_bind_param($stmt, "iiiiiii", $MaNhanSu, $mucLuongCoBan, $phuCap, $khauTru, $thueThuNhap, $tongLuong, $thangluong);
        
        // Thực thi câu lệnh SQL
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Thêm lương thành công!'); window.location.href = 'Luong_Index.php';</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra khi thêm lương!'); window.history.back();</script>";
        }

        // Đóng statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Lỗi kết nối cơ sở dữ liệu!'); window.history.back();</script>";
    }
}
?>