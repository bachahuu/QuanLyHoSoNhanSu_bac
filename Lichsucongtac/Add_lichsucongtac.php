<?php
require_once '../Connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $maNhanSu = $_POST['MaNhanSu'];
    $pb = $_POST['PhongBan'];
    $cv = $_POST['ChucVu'];
    $tgbd = $_POST['ThoiGianBatDau'];
    $tgkt = $_POST['ThoiGianKetThuc'];
// Kiểm tra nếu năm của ngày kết thúc nhỏ hơn năm của ngày bắt đầu
if ($tgbd && $tgkt) {
    $namBatDau = (int)date('Y', strtotime($tgbd));
    $namKetThuc = (int)date('Y', strtotime($tgkt));
    
    // So sánh ngày bắt đầu và ngày kết thúc
    if ($namKetThuc < $namBatDau) {
        echo "<script>alert('Năm của ngày kết thúc không được nhỏ hơn năm của ngày bắt đầu. Vui lòng nhập lại.'); window.history.back();</script>";
        exit; // Dừng thực hiện mã
    } elseif ($ngayBatDau === $ngayKetThuc) {
        echo "<script>alert('Ngày/tháng/năm bắt đầu và Ngày/tháng/năm kết thúc không được trùng nhau. Vui lòng nhập lại.'); window.history.back();</script>";
        exit; // Dừng thực hiện mã
    }
}

    // Kiểm tra kết nối cơ sở dữ liệu
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Câu lệnh SQL để thêm mới
    $sql = "INSERT INTO lichsucongtac (MaNhanSu, PhongBan, ChucVu, ThoiGianBatDau, ThoiGianKetThuc) 
            VALUES ('$maNhanSu', '$pb', '$cv', '$tgbd', '$tgkt')";

    // Thực hiện câu lệnh SQL
    if (mysqli_query($conn, $sql)) {
        header('Location: Chitiet_lichsucongtac.php?MaNhanSu=' . $maNhanSu);
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    // Đóng kết nối
    mysqli_close($conn);
}
?>