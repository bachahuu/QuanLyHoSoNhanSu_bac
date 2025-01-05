<?php
require_once '../Connect.php';

if (isset($_GET['month']) && !empty($_GET['month'])) {
    $month = $_GET['month'];
    $sql = "SELECT nhansu.HoTen, luong.MaNhanSu, luong.MucLuongCoBan, luong.PhuCap, 
            luong.KhauTru, luong.ThueThuNhap, luong.TongLuong
            FROM luong
            JOIN nhansu ON nhansu.MaNhanSu = luong.MaNhanSu
            WHERE DATE_FORMAT(luong.ThangLuong, '%Y-%m') = ?";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $month);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) > 0) {
        // Thiết lập header cho file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="bao_cao_luong_' . $month . '.xlsx"');
        header('Cache-Control: max-age=0');

        // Tạo temporary file
        $tmpfile = tempnam(sys_get_temp_dir(), 'excel');
        $file = fopen($tmpfile, 'w');

        // Thêm BOM để fix lỗi tiếng Việt
        fwrite($file, chr(239) . chr(187) . chr(191));

        // Viết header
        $headers = array('Họ và Tên', 'Mã Nhân Sự', 'Mức Lương Cơ Bản', 'Phụ Cấp', 'Khấu Trừ', 'Thuế Thu Nhập', 'Tổng Lương');
        fputcsv($file, $headers, "\t");

        // Viết dữ liệu
        while ($row = $result->fetch_assoc()) {
            $line = array(
                $row['HoTen'],
                $row['MaNhanSu'],
                number_format($row['MucLuongCoBan'], 0, ',', '.'),
                number_format($row['PhuCap'], 0, ',', '.'),
                number_format($row['KhauTru'], 0, ',', '.'),
                number_format($row['ThueThuNhap'], 0, ',', '.'),
                number_format($row['TongLuong'], 0, ',', '.')
            );
            fputcsv($file, $line, "\t");
        }

        // Đóng file
        fclose($file);

        // Đọc nội dung file và gửi về client
        readfile($tmpfile);

        // Xóa file tạm
        unlink($tmpfile);
        
    } else {
        echo "Không có dữ liệu lương cho tháng $month.";
    }
} else {
    echo "Vui lòng chọn tháng.";
}
?>