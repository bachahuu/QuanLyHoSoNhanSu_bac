<?php
require_once './Connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $maNhanSu = $_POST['MaNhanSu'];
    $pb = $_POST['PhongBan'];
    $cv = $_POST['ChucVu'];
    $tgbd = $_POST['ThoiGianBatDau'];
    $tgkt = $_POST['ThoiGianKetThuc'];

    // Kiểm tra kết nối cơ sở dữ liệu
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Câu lệnh SQL để thêm mới
    $sql = "INSERT INTO lichsucongtac (MaNhanSu, PhongBan, ChucVu, ThoiGianBatDau, ThoiGianKetThuc) 
            VALUES ('$maNhanSu', '$pb', '$cv', '$tgbd', '$tgkt')";

    // Thực hiện câu lệnh SQL
    if (mysqli_query($conn, $sql)) {
        header("Location: lichsucongtac_Index.php?message=Thêm thành công");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    // Đóng kết nối
    mysqli_close($conn);
}
?>
