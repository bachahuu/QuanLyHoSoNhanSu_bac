<?php
// Kết nối cơ sở dữ liệu
require_once '../Connect.php';

// Lấy ID báo cáo từ URL
$id = $_GET['id'];

// Truy vấn dữ liệu của báo cáo từ CSDL
$sql = "SELECT * FROM baocaothongke WHERE MaBaoCao = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kiểm tra nếu báo cáo tồn tại
if ($row) {
    // Thiết lập tiêu đề cho tệp CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment;filename="BaoCao_' . $row['MaBaoCao'] . '.csv"');
    header('Cache-Control: max-age=0');

    // Mở file CSV cho việc ghi
    $output = fopen('php://output', 'w');

    // Viết BOM UTF-8 để đảm bảo Excel có thể nhận diện đúng phông chữ
    fprintf($output, "\xEF\xBB\xBF");

    // Viết tên cột vào file CSV
    fputcsv($output, ['Mã Báo Cáo', 'Ngày Báo Cáo', 'Loại Báo Cáo', 'Trạng Thái', 'Nội Dung Báo Cáo']);

    // Viết dữ liệu báo cáo vào file CSV và đảm bảo mã hóa đúng
    fputcsv($output, [
        mb_convert_encoding($row['MaBaoCao'], 'UTF-8', 'auto'),
        mb_convert_encoding(date("d/m/Y", strtotime($row['NgayBaoCao'])), 'UTF-8', 'auto'),
        mb_convert_encoding($row['LoaiBaoCao'], 'UTF-8', 'auto'),
        mb_convert_encoding($row['TrangThaiBaoCao'], 'UTF-8', 'auto'),
        mb_convert_encoding($row['NoiDung'], 'UTF-8', 'auto')  // Xuất nội dung báo cáo
    ]);

    // Đóng file CSV
    fclose($output);
    exit;
} else {
    echo "Báo cáo không tồn tại!";
    exit;
}
?>