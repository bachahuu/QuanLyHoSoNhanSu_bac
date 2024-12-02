<?php 
require_once '../Connect.php';
$chucvu = $_POST['TenChucVu'];
$MOTA = $_POST['MoTa'];
$QUYDINH = $_POST['QuyDinhChucVu'];
$sql_insert = "INSERT INTO chucvu(TenChucVu,MoTa,QuyDinhChucVu) VALUES ('$chucvu','$MOTA','$QUYDINH')";
// echo $sql_insert ; exit;
if (mysqli_query($conn,$sql_insert)) {
    echo "thêm thành công!";
    header("Location: ChucVu.php"); // Chuyển hướng về danh sách chức vụ
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
?>