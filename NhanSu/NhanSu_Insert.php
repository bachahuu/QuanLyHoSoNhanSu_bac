<?php
    // Kết nối tới cơ sở dữ liệu
    require_once '../Connect.php'; // File connect.php chứa thông tin kết nối MySQL

    // Kiểm tra nếu form được gửi đi (người dùng nhấn nút Thêm)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $MaDinhDanh = $_POST['MaDinhDanh'];
        $HoTen = $_POST['HoTen'];
        $GioiTinh = $_POST['GioiTinh'];
        $NamSinh = $_POST['NamSinh'];
        $CMND_CCCD = $_POST['CMND_CCCD'];
        $SoDienThoai = $_POST['SoDienThoai'];
        $Email = $_POST['Email'];
        $DiaChi = $_POST['DiaChi'];
        $NgayVaoLam = $_POST['NgayVaoLam'];
        $NgayNghiHuu = $_POST['NgayNghiHuu']; // Sử dụng giá trị từ form
        $TinhTrangLamViec = $_POST['TinhTrangLamViec'];
        $LoaiHopDong = $_POST['LoaiHopDong'];
        $TenChucVu = $_POST['TenChucVu'];

        // Kiểm tra Mã định danh trùng
        $sql_check = "SELECT * FROM NhanSu WHERE MaDinhDanh = '$MaDinhDanh'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('Mã định danh này đã tồn tại! Vui lòng kiểm tra lại.'); window.history.back();</script>";
            exit();
        }

        // Kiểm tra CMND/CCCD trùng
        $sql_check = "SELECT * FROM NhanSu WHERE CMND_CCCD = '$CMND_CCCD'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('CMND/CCCD này đã tồn tại! Vui lòng kiểm tra lại.'); window.history.back();</script>";
            exit();
        }

        // Kiểm tra Email trùng
        $sql_check = "SELECT * FROM NhanSu WHERE Email = '$Email'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('Email này đã tồn tại! Vui lòng kiểm tra lại.'); window.history.back();</script>";
            exit();
        }

        // Thêm nhân sự vào cơ sở dữ liệu
        $sql_insert = "INSERT INTO NhanSu (MaDinhDanh,HoTen, GioiTinh, NgaySinh, CMND_CCCD, SoDienThoai, Email, DiaChi, NgayVaoLam, NgayNghiHuu, TinhTrangLamViec, LoaiHopDong, MaChucVu) 
        VALUES ('$MaDinhDanh','$HoTen', '$GioiTinh', '$NamSinh', '$CMND_CCCD', '$SoDienThoai', '$Email', '$DiaChi', '$NgayVaoLam', '$NgayNghiHuu', '$TinhTrangLamViec', '$LoaiHopDong', '$TenChucVu')";

        if (mysqli_query($conn, $sql_insert)) {
            echo "<script>alert('Thêm nhân sự thành công!'); window.location.href = 'NhanSu_Index.php';</script>";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }
?>
