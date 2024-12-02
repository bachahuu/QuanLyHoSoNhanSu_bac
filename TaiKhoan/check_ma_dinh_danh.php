<?php
// Kết nối cơ sở dữ liệu
include '../Connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['MaDinhDanh'])) {
    $maDinhDanh = $_POST['MaDinhDanh'];

    $sql = "SELECT HoTen, Email, SoDienThoai, DiaChi FROM NhanSu WHERE MaDinhDanh = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $maDinhDanh);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy nhân sự với mã định danh này.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ.']);
}
?>
