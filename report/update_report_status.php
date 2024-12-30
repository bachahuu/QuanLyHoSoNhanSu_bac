<?php
// Kết nối cơ sở dữ liệu
require_once 'Connect.php';

// Kiểm tra nếu có yêu cầu thay đổi trạng thái
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maBaoCao = $_POST['MaBaoCao'];
    $trangThai = $_POST['TrangThaiBaoCao'];

    // Cập nhật trạng thái báo cáo
    $sql = "UPDATE baocaothongke SET TrangThaiBaoCao = '$trangThai' WHERE MaBaoCao = '$maBaoCao'";
    if (mysqli_query($conn, $sql)) {
        // Thông báo thành công và chuyển về trang danh sách báo cáo
        echo "<script>alert('Cập nhật trạng thái thành công!'); window.location.href='BaoCaoThongKe_Index.php';</script>";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>
