<?php
// Kết nối cơ sở dữ liệu
require_once '../Connect.php';

// Kiểm tra nếu có tham số 'id' được gửi
if (isset($_GET['id'])) {
    $maLuong = $_GET['id'];

    // Chuẩn bị câu lệnh xóa
    $sql = "DELETE FROM luong WHERE MaLuong = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Gắn tham số vào câu lệnh
        mysqli_stmt_bind_param($stmt, "i", $maLuong);

        // Thực thi câu lệnh SQL
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Xóa lương thành công!'); window.location.href = 'Luong_Index.php';</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra khi xóa!'); window.history.back();</script>";
        }

        // Đóng statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Lỗi kết nối cơ sở dữ liệu!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Không có ID để xóa!'); window.history.back();</script>";
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>