<?php
require_once '../Connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maChucVu = $_POST['MaChucVu'];
    $tenChucVu = $_POST['TenChucVu'];
    $moTa = $_POST['MoTa'];
    $quyDinh = $_POST['QuyDinhChucVu'];

    // Cập nhật dữ liệu vào cơ sở dữ liệu
    $sql_update = "UPDATE chucvu SET TenChucVu='$tenChucVu', MoTa='$moTa', QuyDinhChucVu='$quyDinh' WHERE MaChucVu='$maChucVu'";
    if (mysqli_query($conn, $sql_update)) {
        echo "Cập nhật thành công!";
        header("Location: ChucVu.php"); // Chuyển hướng về danh sách chức vụ
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>