<?php
    $maLichSu = $_GET['MaLichSu'];
    require_once '../Connect.php';

    $xoasql = "DELETE FROM lichsucongtac Where MaLichSu=$maLichSu";

    mysqli_query($conn,$xoasql);
    
    header("Location: lichsucongtac_Index.php");
?>