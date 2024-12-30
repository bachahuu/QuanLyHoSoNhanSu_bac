<?php
// Kết nối cơ sở dữ liệu
require_once '../Connect.php';

// Lấy mã nhân sự từ URL
$maNhanSu = isset($_GET['maNhanSu']) ? $_GET['maNhanSu'] : '';

$history_result = null; // Khởi tạo biến

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy khoảng thời gian từ form
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

   // Truy vấn lịch sử lương trong khoảng thời gian
$history_sql = "SELECT * FROM luong 
WHERE MaNhanSu = '$maNhanSu' 
AND DATE_FORMAT(ThangLuong, '%Y-%m') BETWEEN '$startDate' AND '$endDate' 
ORDER BY ThangLuong DESC";
$history_result = mysqli_query($conn, $history_sql); // Gán giá trị truy vấn vào biến

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Lịch sử lương</title>
</head>

<body>
    <div class="container mt-4">
        <h3 class="text-center">Xem Lịch Sử Lương</h3>

        <!-- Form nhập khoảng thời gian -->
        <form action="history_luong.php?maNhanSu=<?php echo $maNhanSu; ?>" method="POST">
            <div class="form-group">
                <label for="startDate">Ngày bắt đầu:</label>
                <input type="month" class="form-control" id="startDate" name="startDate" required>
            </div>
            <div class="form-group">
                <label for="endDate">Ngày kết thúc:</label>
                <input type="month" class="form-control" id="endDate" name="endDate" required>
            </div>
            <button type="submit" class="btn btn-success">Tìm kiếm</button>
            <a href="Luong_Index.php" class="btn btn-secondary">Quay lại</a>
        </form>

        <!-- Hiển thị lịch sử lương -->
        <?php if ($history_result && mysqli_num_rows($history_result) > 0): ?>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Tháng Lương</th>
                    <th>Mức Lương Cơ Bản</th>
                    <th>Phụ Cấp</th>
                    <th>Khấu Trừ</th>
                    <th>Thuế Thu Nhập</th>
                    <th>Tổng Lương</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($history_result)): ?>
                <tr>
                    <td><?php echo date("m/Y", strtotime($row['ThangLuong'])); ?></td>
                    <td><?php echo number_format($row['MucLuongCoBan'], 0, ',', '.'); ?> VND</td>
                    <td><?php echo number_format($row['PhuCap'], 0, ',', '.'); ?> VND</td>
                    <td><?php echo number_format($row['KhauTru'], 0, ',', '.'); ?> VND</td>
                    <td><?php echo number_format($row['ThueThuNhap'], 0, ',', '.'); ?> VND</td>
                    <td><?php echo number_format($row['TongLuong'], 0, ',', '.'); ?> VND</td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p class="alert alert-warning">Không có lịch sử lương trong khoảng thời gian này.</p>
        <?php endif; ?>
    </div>
</body>

</html>