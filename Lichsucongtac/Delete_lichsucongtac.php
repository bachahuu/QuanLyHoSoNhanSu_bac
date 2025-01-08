<?php
    $maLichSu = $_GET['MaLichSu'];
        // Kiểm tra và lấy dữ liệu từ form
        $manhansu = isset($_GET['MaNhanSu']) ? $_GET['MaNhanSu'] : '';
    require_once '../Connect.php';

    $xoasql = "DELETE FROM lichsucongtac Where MaLichSu=$maLichSu";

    mysqli_query($conn,$xoasql);
    
    header('Location: Chitiet_lichsucongtac.php?MaNhanSu=' . $manhansu);
?>