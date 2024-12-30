<?php
// Kết nối với cơ sở dữ liệu
require_once '../Connect.php';

// Lấy mã lương từ URL (thông qua phương thức GET)
$maLuong = $_GET['id']; // id là tham số gửi từ URL

// Truy vấn để lấy chi tiết của lương theo mã lương
$sql = "SELECT * FROM luong JOIN nhansu ON nhansu.MaNhanSu = luong.MaNhanSu WHERE MaLuong = '$maLuong'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {
    // Nếu tìm thấy thông tin chi tiết
    $maNhanSu = $row['MaNhanSu'];
    $mucLuongCoBan = $row['MucLuongCoBan'];
    $phuCap = $row['PhuCap'];
    $khauTru = $row['KhauTru'];
    $thueThuNhap = $row['ThueThuNhap'];
    $soNgayLamViec = $row['SoNgayLamViec'];
    $tongLuong = $row['TongLuong'];
    $thangLuong = $row['ThangLuong'];
} else {
    echo "Không tìm thấy thông tin lương.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Chi Tiết Lương</title>
</head>

<body>
    <div class="container mt-4">
        <h3 class="text-center">Chi Tiết Lương</h3>
        <table class="table table-bordered">
            <tr>
                <th>Mã Nhân Sự</th>
                <td><?php echo $maNhanSu; ?></td>
            </tr>
            <tr>
                <th>Mức Lương Cơ Bản</th>
                <td><?php echo number_format($mucLuongCoBan, 0, ',', '.'); ?> VND</td>
            </tr>
            <tr>
                <th>Phụ Cấp</th>
                <td><?php echo number_format($phuCap, 0, ',', '.'); ?> VND</td>
            </tr>
            <tr>
                <th>Khấu Trừ</th>
                <td><?php echo number_format($khauTru, 0, ',', '.'); ?> VND</td>
            </tr>
            <tr>
                <th>Thuế Thu Nhập</th>
                <td><?php echo number_format($thueThuNhap, 0, ',', '.'); ?> VND</td>
            </tr>
            <tr>
                <th>Số Ngày Làm Việc</th>
                <td><?php echo $soNgayLamViec; ?> ngày</td>
            </tr>
            <tr>
                <th>Tổng Lương</th>
                <td><?php echo number_format($tongLuong, 0, ',', '.'); ?> VND</td>
            </tr>
            <tr>
                <th>Tháng Lương</th>
                <td><?php echo date("m/Y", strtotime($thangLuong)); ?></td>
            </tr>
        </table>
        <a href="Luong_Index.php" class="btn btn-secondary">Quay lại</a>
    </div>
</body>

</html>