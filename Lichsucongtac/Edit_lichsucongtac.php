<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kết nối đến cơ sở dữ liệu
    require_once '../Connect.php';
    
    // Kiểm tra và lấy dữ liệu từ form
    $manhansu = isset($_POST['MaNhanSu']) ? $_POST['MaNhanSu'] : '';
    $malichsu = isset($_POST['malichsu']) ? $_POST['malichsu'] : '';
    $phongban = $_POST['PhongBan'];
    $chucvu = $_POST['ChucVu'];
    $thoiGianBatDau = $_POST['ThoiGianBatDau'];
    $thoiGianKetThuc = $_POST['ThoiGianKetThuc'];
    
    // Tạo câu truy vấn
    $sql = "
        UPDATE lichsucongtac 
        SET ChucVu = '$chucvu', ThoiGianBatDau = '$thoiGianBatDau', ThoiGianKetThuc = '$thoiGianKetThuc', PhongBan = '$phongban'
        WHERE MaLichSu = '$malichsu' AND MaNhanSu = '$manhansu'
    ";
    
    // Thực thi câu lệnh
    if (mysqli_query($conn, $sql)) {
        // Quay lại trang chi tiết lịch sử công tác với MaNhanSu = 3
        header('Location: Chitiet_lichsucongtac.php?MaNhanSu=' . $manhansu);
        exit(); // Đảm bảo không có mã nào được thực thi sau khi chuyển hướng
    } else {
        echo "Lỗi khi cập nhật: " . mysqli_error($conn);
    }
    
    // Đóng kết nối
    mysqli_close($conn);
}
?>