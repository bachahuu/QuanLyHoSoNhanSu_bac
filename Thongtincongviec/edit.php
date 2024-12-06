<?php
// Kết nối cơ sở dữ liệu
include('../Connect.php'); // File kết nối đến database

// Lấy dữ liệu từ form
$manhansu = isset($_POST['MaNhanSu']) ? $_POST['MaNhanSu'] : null; // Mã nhansu
$maCongViec = isset($_POST['MaCongViec']) ? $_POST['MaCongViec'] : null; // Mã công việc
$maChucVuCu = isset($_POST['MaChucVuCu']) ? $_POST['MaChucVuCu'] : null; // Mã chức vụ cũ
$maChucVuMoi = isset($_POST['MaChucVuMoi']) ? $_POST['MaChucVuMoi'] : null; // Mã chức vụ mới
// $hoTen = isset($_POST['HoTen']) ? $_POST['HoTen'] : null; // Họ và tên
$phuCap = isset($_POST['PhuCapChucVu']) ? $_POST['PhuCapChucVu'] : null; // Phụ cấp
$heSoLuong = isset($_POST['HeSoLuong']) ? $_POST['HeSoLuong'] : null; // Hệ số lương
$khoaPhongBan = isset($_POST['KhoaPhongBan']) ? $_POST['KhoaPhongBan'] : null; // Khoa/Phòng ban
$ngayBatDau = isset($_POST['NgayBatDau']) ? $_POST['NgayBatDau'] : null; // Ngày bắt đầu
$ngayKetThuc = isset($_POST['NgayKetThuc']) ? $_POST['NgayKetThuc'] : null; // Ngày kết thúc

// Kiểm tra nếu chức vụ thay đổi
if ($maChucVuCu !== $maChucVuMoi) {
    // Cập nhật chức vụ trong bảng nhân sự
      $sqlUpdateNhanSu = "UPDATE nhansu SET MaChucVu = '$maChucVuMoi' WHERE MaNhanSu = '$manhansu'";
      if (mysqli_query($conn, $sqlUpdateNhanSu)) {
          echo "Chức vụ trong bảng nhân sự đã được cập nhật thành công!<br>";
      } else {
          echo "Lỗi khi cập nhật chức vụ trong bảng nhân sự: " . mysqli_error($conn) . "<br>";
      }
    // Cập nhật chức vụ trong bảng công việc
    $sqlUpdateChucVu = "
        UPDATE congviec 
        SET 
            MaChucVu = '$maChucVuMoi',
            PhuCapChucVu = '$phuCap',
            HeSoLuong = '$heSoLuong',
            KhoaPhongBan = '$khoaPhongBan',
            NgayBatDau = '$ngayBatDau',
            NgayKetThuc = '$ngayKetThuc'
        WHERE MaCongViec = '$maCongViec'
    ";
    if (mysqli_query($conn, $sqlUpdateChucVu)) {
        echo "Chức vụ đã được cập nhật thành công!";
        header("Location: ThongTinCongViec.php");
    } else {
        echo "Lỗi khi cập nhật chức vụ: " . mysqli_error($conn);
    }
      
} else {
    // Nếu không thay đổi chức vụ, chỉ cập nhật các thông tin khác
    $sqlUpdateInfo = "
        UPDATE congviec 
        SET 
            PhuCapChucVu = '$phuCap',
            HeSoLuong = '$heSoLuong',
            KhoaPhongBan = '$khoaPhongBan',
            NgayBatDau = '$ngayBatDau',
            NgayKetThuc = '$ngayKetThuc'        
        WHERE MaCongViec = '$maCongViec'
    ";

    if (mysqli_query($conn, $sqlUpdateInfo)) {
        echo "Thông tin công việc đã được cập nhật thành công!";
        header("Location: ThongTinCongViec.php");
    } else {
        echo "Lỗi khi cập nhật thông tin: " . mysqli_error($conn);
    }
}

// Đóng kết nối
mysqli_close($conn);
?>