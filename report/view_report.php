<?php
require_once '../Connect.php';

$maBaoCao = $_GET['id'];

$sql = "SELECT * FROM baocaothongke WHERE MaBaoCao = '$maBaoCao'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    echo "<h3>Báo cáo: {$row['LoaiBaoCao']}</h3>";
    echo "<p><strong>Ngày Báo Cáo:</strong> " . date("d/m/Y", strtotime($row['NgayBaoCao'])) . "</p>";
    echo "<p><strong>Nội Dung:</strong> {$row['NoiDung']}</p>";

    // Hiển thị file nếu có
    if ($row['FileBaoCao']) {
        echo "<p><strong>File Báo Cáo:</strong> <a href='./uploads/{$row['FileBaoCao']}' target='_blank'>{$row['FileBaoCao']}</a></p>";
    }
}
?>