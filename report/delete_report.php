<?php
require_once '../Connect.php';  // Kết nối với CSDL

// Kiểm tra nếu có id báo cáo cần xóa
if (isset($_GET['id'])) {
    $maBaoCao = $_GET['id'];  // Lấy mã báo cáo từ tham số URL

    // Câu lệnh SQL để xóa báo cáo
    $sql = "DELETE FROM baocaothongke WHERE MaBaoCao = '$maBaoCao'";

    // Thực hiện câu lệnh SQL và kiểm tra kết quả
    if (mysqli_query($conn, $sql)) {
        // Nếu xóa thành công, chuyển hướng về trang danh sách báo cáo
        echo "<script>alert('Báo cáo đã được xóa thành công!'); window.location.href='BaoCaoThongKe_Index.php';</script>";
    } else {
        // Nếu có lỗi trong quá trình xóa
        echo "Lỗi: " . mysqli_error($conn);
    }
} else {
    echo "Không có mã báo cáo để xóa.";
}
?>