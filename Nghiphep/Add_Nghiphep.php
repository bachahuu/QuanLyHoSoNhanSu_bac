<?php
require_once './Connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $maNhanSu = $_POST['MaNhanSu'];
    $lyDo = $_POST['LyDo'];
    $ngayBatDau = $_POST['NgayBatDau'];
    $ngayKetThuc = $_POST['NgayKetThuc'];

    // Kiểm tra kết nối cơ sở dữ liệu
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Thiết lập giá trị mặc định cho TrangThai là "Chờ duyệt"
    $trangThai = "Chờ duyệt";

    // Câu lệnh SQL để thêm mới
    $sql = "INSERT INTO nghiphep (MaNhanSu, NgayBatDau, NgayKetThuc, LyDo, TrangThai) 
            VALUES ('$maNhanSu', '$ngayBatDau', '$ngayKetThuc', '$lyDo', '$trangThai')";

    // Thực hiện câu lệnh SQL
    if (mysqli_query($conn, $sql)) {
        header("Location: Nghiphep_User_Index.php?message=Thêm thành công");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    // Đóng kết nối
    mysqli_close($conn);
}
?>
