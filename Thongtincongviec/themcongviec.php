<?php 

require_once '../Connect.php';
// Lấy dữ liệu từ form
$madinhdanh = isset($_POST['madinhdanh']) ? $_POST['madinhdanh'] : null; // Mã nhansu
$machucvu = isset($_POST['machucvu']) ? $_POST['machucvu'] : null; // Mã công việc
// $hoTen = isset($_POST['HoTen']) ? $_POST['HoTen'] : null; // Họ và tên
$phuCap = isset($_POST['phucapchucvu']) ? $_POST['phucapchucvu'] : null; // Phụ cấp
$heSoLuong = isset($_POST['hesoluong']) ? $_POST['hesoluong'] : null; // Hệ số lương
$khoaPhongBan = isset($_POST['khoa/phongban']) ? $_POST['khoa/phongban'] : null; // Khoa/Phòng ban
$ngayBatDau = isset($_POST['startDate']) ? $_POST['startDate'] : null; // Ngày bắt đầu
$ngayKetThuc = isset($_POST['endDate']) ? $_POST['endDate'] : null; // Ngày kết thúc
$sogiolam = isset($_POST['sogiolam']) ? $_POST['sogiolam'] : null;
// Kiểm tra nếu năm của ngày kết thúc nhỏ hơn năm của ngày bắt đầu
if ($ngayBatDau && $ngayKetThuc) {
    $namBatDau = (int)date('Y', strtotime($ngayBatDau));
    $namKetThuc = (int)date('Y', strtotime($ngayKetThuc));
    
    // So sánh ngày bắt đầu và ngày kết thúc
    if ($namKetThuc < $namBatDau) {
        echo "<script>alert('Năm của ngày kết thúc không được nhỏ hơn năm của ngày bắt đầu. Vui lòng nhập lại.'); window.history.back();</script>";
        exit; // Dừng thực hiện mã
    } elseif ($ngayBatDau === $ngayKetThuc) {
        echo "<script>alert('Ngày bắt đầu và ngày kết thúc không được trùng nhau. Vui lòng nhập lại.'); window.history.back();</script>";
        exit; // Dừng thực hiện mã
    }
}

$sql_select = "SELECT MaNhanSu FROM nhansu WHERE MaDinhDanh = '$madinhdanh' ";
// Thực thi truy vấn
$result = mysqli_query($conn, $sql_select);
// Kiểm tra kết quả và lấy dữ liệu
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $maNhanSu = $row['MaNhanSu'];
    // echo "Mã nhân sự: " . $maNhanSu;
} else {
    echo "Không tìm thấy nhân sự với mã định danh: $madinhdanh";
}
$sql_insert = "INSERT INTO congviec(MaNhanSu,MaChucVu,KhoaPhongBan,HeSoLuong,PhuCapChucVu,SoGioLamViec,NgayBatDau,NgayKetThuc) VALUES ('$maNhanSu','$machucvu','$khoaPhongBan','$heSoLuong','$phuCap','$sogiolam','$ngayBatDau','$ngayKetThuc')";
// echo $sql_insert ; exit;
if (mysqli_query($conn,$sql_insert)) {
    echo "thêm thành công!";
    header("Location: ThongTinCongViec.php"); // Chuyển hướng về danh sách chức vụ
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
?>