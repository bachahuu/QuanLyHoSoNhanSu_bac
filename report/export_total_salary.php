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
        // Tên file CSV
        $fileName = "bao_cao_luong_$month.csv";

        // Đặt header để xuất file CSV
        header("Content-Type: text/csv; charset=UTF-8");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Thêm BOM để hiển thị đúng phông chữ trong Excel
        echo "\xEF\xBB\xBF";

        // Mở output stream
        $output = fopen('php://output', 'w');

        // Thêm tiêu đề báo cáo
        fputcsv($output, ["Báo cáo lương tháng $month"]);
        fputcsv($output, []); // Dòng trống

        // Tiêu đề cột
        fputcsv($output, [
            'Họ và Tên',
            'Mã Nhân Sự',
            'Mức Lương Cơ Bản (VNĐ)',
            'Phụ Cấp (VNĐ)',
            'Khấu Trừ (VNĐ)',
            'Thuế Thu Nhập (VNĐ)',
            'Tổng Lương (VNĐ)'
        ]);

        // Xuất dữ liệu từng dòng
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, [
                $row['HoTen'],
                $row['MaNhanSu'],
                $row['MucLuongCoBan'], // Không định dạng số
                $row['PhuCap'],
                $row['KhauTru'],
                $row['ThueThuNhap'],
                $row['TongLuong']
            ]);
        }

        fclose($output);
    } else {
        echo "Không có dữ liệu lương cho tháng $month.";
    }
} else {
    echo "Vui lòng chọn tháng.";
}
?>