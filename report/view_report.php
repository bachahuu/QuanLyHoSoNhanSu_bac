<?php
require_once '../Connect.php';

$maBaoCao = $_GET['id'];

$sql = "SELECT * FROM baocaothongke WHERE MaBaoCao = '$maBaoCao'";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Báo Cáo</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
        color: #333333;
        margin-bottom: 20px;
        text-align: center;
    }

    p {
        color: #555555;
        line-height: 1.6;
        margin: 10px 0;
    }

    .report-section {
        margin-bottom: 20px;
    }

    .report-section strong {
        color: #000000;
    }

    .file-link {
        color: #0066cc;
        text-decoration: none;
        font-weight: bold;
    }

    .file-link:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <h3>Báo Cáo: <?= htmlspecialchars($row['LoaiBaoCao'], ENT_QUOTES, 'UTF-8') ?></h3>
        <div class="report-section">
            <p><strong>Ngày Báo Cáo:</strong> <?= date("d/m/Y", strtotime($row['NgayBaoCao'])) ?></p>
        </div>
        <div class="report-section">
            <p><strong>Nội Dung:</strong></p>
            <p><?= nl2br(htmlspecialchars($row['NoiDung'], ENT_QUOTES, 'UTF-8')) ?></p>
        </div>
    </div>
</body>

</html>
<?php
} else {
    echo "<p>Không tìm thấy báo cáo.</p>";
}
?>