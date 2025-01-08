<?php
// Kết nối cơ sở dữ liệu
require_once '../Connect.php';

// Kiểm tra nếu tháng được gửi từ form
if (isset($_GET['month']) && !empty($_GET['month'])) {
    $month = $_GET['month']; // Dạng YYYY-MM

    // Truy vấn để lấy dữ liệu lương theo tháng
    $sql = "SELECT nhansu.HoTen, luong.MaNhanSu, luong.MucLuongCoBan, luong.PhuCap, luong.KhauTru, luong.ThueThuNhap, luong.TongLuong 
            FROM luong 
            JOIN nhansu ON nhansu.MaNhanSu = luong.MaNhanSu
            WHERE DATE_FORMAT(luong.ThangLuong, '%Y-%m') = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $month);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Tên file Excel
        $fileName = "bao_cao_luong_$month.xls";

        // Đặt header để xuất file Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Bắt đầu xuất dữ liệu
        echo "Họ và Tên\tMã Nhân Sự\tMức Lương Cơ Bản\tPhụ Cấp\tKhấu Trừ\tThuế Thu Nhập\tTổng Lương\n";

        while ($row = $result->fetch_assoc()) {
            echo "{$row['HoTen']}\t{$row['MaNhanSu']}\t" . number_format($row['MucLuongCoBan'], 0, ',', '.') . "\t" .
                 number_format($row['PhuCap'], 0, ',', '.') . "\t" . number_format($row['KhauTru'], 0, ',', '.') . "\t" .
                 number_format($row['ThueThuNhap'], 0, ',', '.') . "\t" . number_format($row['TongLuong'], 0, ',', '.') . "\n";
        }
    } else {
        echo "Không có dữ liệu lương cho tháng $month.";
    }
} else {
    echo "Vui lòng chọn tháng.";
}
?>