<?php
require_once '../Connect.php';
//lay sid xuong 
if (isset($_GET['Sid'])) {
    $sid = $_GET['Sid'];
} else {
    die("Lỗi: Không tìm thấy 'Sid' trong yêu cầu.");
}

$sql_delete = "DELETE FROM chucvu WHERE MaChucVu = $sid ";
mysqli_query($conn,$sql_delete);
header("Location: ChucVu.php");

?>