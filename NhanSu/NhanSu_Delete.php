<?php
    //lay du lieu id can xoa
    $maNhanSu = $_GET['MaNhanSu'];
    // echo $matheloai;
    //ket noi
    require_once '../Connect.php';

    //cau lenh sql
    $delete_sql = "DELETE FROM NhanSu WHERE MaNhanSu = $maNhanSu";

    mysqli_query($conn, $delete_sql);

    //tro ve trang list
    header("Location: NhanSu_Index.php");
?>