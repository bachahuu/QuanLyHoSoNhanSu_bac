<?php
if (isset($_GET['MaNghiPhep'])) {
    $maNghiPhep = $_GET['MaNghiPhep'];
    require_once '../Connect.php';

    $stmt = $conn->prepare("DELETE FROM nghiphep WHERE MaNghiPhep = ?");
    $stmt->bind_param("i", $maNghiPhep);

    if ($stmt->execute()) {
        header("Location: Nghiphep_User_Index.php?status=success");
    } else {
        header("Location: Nghiphep_User_Index.php?status=error");
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Mã nghỉ phép không hợp lệ.";
    exit;
}
?>
