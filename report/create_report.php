<?php
require_once '../Connect.php';

// Kiểm tra và xử lý form tạo báo cáo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loaiBaoCao = $_POST['LoaiBaoCao'];
    $noiDung = $_POST['NoiDung'];
    $trangThai = $_POST['TrangThaiBaoCao']; // Lấy trạng thái từ form

    // Xử lý file đính kèm nếu có
    if (isset($_FILES['FileBaoCao']) && $_FILES['FileBaoCao']['error'] == 0) {
        $file = $_FILES['FileBaoCao'];
        $filePath = 'uploads/' . basename($file['name']);
        move_uploaded_file($file['tmp_name'], $filePath);
    } else {
        $filePath = null;
    }

    // Sử dụng NOW() của MySQL để lưu ngày tháng hiện tại
    $sql = "INSERT INTO baocaothongke (LoaiBaoCao, NoiDung, TrangThaiBaoCao, FileBaoCao, NgayBaoCao) 
            VALUES ('$loaiBaoCao', '$noiDung', '$trangThai', '$filePath', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Báo cáo đã được tạo thành công!'); window.location.href='BaoCaoThongKe_Index.php';</script>";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>