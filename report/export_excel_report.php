<?php
// Kết nối cơ sở dữ liệu
require_once '../Connect.php';

// Lấy ID báo cáo từ URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Truy vấn dữ liệu của báo cáo từ CSDL
    $sql = "SELECT * FROM baocaothongke WHERE MaBaoCao = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Thiết lập tiêu đề cho file văn bản
        header('Content-Type: text/plain; charset=utf-8');
        header('Content-Disposition: attachment;filename="BaoCao_' . $row['MaBaoCao'] . '.txt"');
        header('Cache-Control: max-age=0');

        // Mở file tạm thời để ghi nội dung
        $output = fopen('php://output', 'w');

        // Viết BOM UTF-8 để đảm bảo không lỗi font chữ
        fprintf($output, "\xEF\xBB\xBF");

        // Bắt đầu viết nội dung báo cáo
        fwrite($output, "========================= BÁO CÁO =========================\n\n");
        fwrite($output, "MÃ BÁO CÁO      : " . $row['MaBaoCao'] . "\n");
        fwrite($output, "NGÀY BÁO CÁO    : " . date("d/m/Y", strtotime($row['NgayBaoCao'])) . "\n");
        fwrite($output, "LOẠI BÁO CÁO    : " . $row['LoaiBaoCao'] . "\n");
        fwrite($output, "----------------------------------------------------------\n\n");

        fwrite($output, "===================== NỘI DUNG CHI TIẾT ====================\n");
        fwrite($output, wordwrap($row['NoiDung'], 80, "\n", true) . "\n");
        fwrite($output, "----------------------------------------------------------\n\n");

        fwrite($output, "==================== THÔNG TIN THỰC HIỆN ===================\n");
        fwrite($output, "Người Thực Hiện : \n");
        fwrite($output, "Bộ Phận Liên Quan: \n");
        fwrite($output, "----------------------------------------------------------\n\n");

        fwrite($output, "========================== GHI CHÚ =========================\n");
        fwrite($output, "Ghi chú bổ sung  :\n");
        fwrite($output, "==========================================================\n");

        // Đóng file sau khi ghi
        fclose($output);
        exit;
    } else {
        echo "Báo cáo không tồn tại!";
        exit;
    }
} else {
    echo "Vui lòng cung cấp ID báo cáo!";
    exit;
}
?>