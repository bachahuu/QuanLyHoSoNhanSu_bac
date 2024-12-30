<?php
require_once '../Connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maNhanSu = $_POST['MaNhanSu'];
    $ngayBatDau = $_POST['NgayBatDau'];
    $trangThai = $_POST['TrangThai'];

    // Cập nhật trạng thái trong cơ sở dữ liệu
    $update_sql = "
        UPDATE nghiphep 
        SET TrangThai = ? 
        WHERE MaNhanSu = ? AND NgayBatDau = ?
    ";

    $stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($stmt, 'sss', $trangThai, $maNhanSu, $ngayBatDau);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Cập nhật trạng thái thành công!'); window.location.href = 'Nghiphep_Index.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra: " . mysqli_error($conn) . "'); window.location.href = 'Nghiphep_Index.php';</script>";
    }
}
?>
