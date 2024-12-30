<?php
// Kết nối cơ sở dữ liệu
require_once '../Connect.php';

// Kiểm tra nếu có tham số 'id' trong URL, nghĩa là người dùng nhấn "Sửa"
if (isset($_GET['id'])) {
    $maLuong = $_GET['id']; // Mã lương từ URL

    // Truy vấn lấy thông tin lương của nhân sự
    $sql = "SELECT * FROM luong WHERE MaLuong = '$maLuong'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "Không tìm thấy dữ liệu.";
        exit;
    }

    // Lấy dữ liệu lương cũ
    $mucLuongCoBan = $row['MucLuongCoBan'];
    $phuCap = $row['PhuCap'];
    $khauTru = $row['KhauTru'];
    $thueThuNhap = $row['ThueThuNhap'];
    $tongLuong = $row['TongLuong'];
} else {
    echo "Không có mã lương để sửa.";
    exit;
}

// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $mucLuongCoBan = $_POST['MucLuongCoBan'];
    $phuCap = $_POST['PhuCap'];
    $khauTru = $_POST['KhauTru'];
    $thueThuNhap = $_POST['ThueThuNhap'];

    // Tính lại tổng lương
    $tongLuong = $mucLuongCoBan + $phuCap - $khauTru - $thueThuNhap;

    // Cập nhật vào cơ sở dữ liệu
    $update_sql = "UPDATE luong SET MucLuongCoBan = '$mucLuongCoBan', PhuCap = '$phuCap', KhauTru = '$khauTru', ThueThuNhap = '$thueThuNhap', TongLuong = '$tongLuong' WHERE MaLuong = '$maLuong'";
    if (mysqli_query($conn, $update_sql)) {
        // Chuyển hướng về trang danh sách lương sau khi cập nhật
        header("Location: Luong_Index.php");
        exit;
    } else {
        echo "Cập nhật thất bại: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Sửa Lương</title>
</head>

<body>
    <div class="container mt-4">
        <h3 class="text-center">Sửa Lương</h3>
        <form action="" method="POST">
            <div class="form-group">
                <label for="MucLuongCoBan">Mức Lương Cơ Bản:</label>
                <input type="number" class="form-control" id="MucLuongCoBan" name="MucLuongCoBan"
                    value="<?php echo $mucLuongCoBan; ?>" required>
            </div>
            <div class="form-group">
                <label for="PhuCap">Phụ Cấp:</label>
                <input type="number" class="form-control" id="PhuCap" name="PhuCap" value="<?php echo $phuCap; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="KhauTru">Khấu Trừ:</label>
                <input type="number" class="form-control" id="KhauTru" name="KhauTru" value="<?php echo $khauTru; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="ThueThuNhap">Thuế Thu Nhập:</label>
                <input type="number" class="form-control" id="ThueThuNhap" name="ThueThuNhap"
                    value="<?php echo $thueThuNhap; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="Luong_Index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>