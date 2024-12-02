<?php
    //lay du lieu id can xoa
    $maNguoiDung = $_GET['MaNguoiDung'];
    // echo $matheloai;
    //ket noi
    require_once '../Connect.php';

    //cau lenh sql
    $delete_sql = "DELETE FROM nguoidung WHERE MaNguoiDung = $maNguoiDung";

    mysqli_query($conn, $delete_sql);

    //tro ve trang list
    header("Location: TaiKhoan_Index.php");
?>