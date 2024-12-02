<?php
// Kết nối tới cơ sở dữ liệu
require_once '../Connect.php'; // File connect.php chứa thông tin kết nối MySQL

// Kiểm tra nếu form được gửi đi (người dùng nhấn nút Thêm)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $tenDangNhap = $_POST['TenDangNhap'];
    $matKhau = $_POST['MatKhau'];
    $hoVaTen = $_POST['HoVaTen'];
    $email = $_POST['Email'];
    $sDT = $_POST['SoDienThoai'];
    $diaChi = $_POST['DiaChi'];
    $phanQuyen = $_POST['PhanQuyen'];
    $maDinhDanh = $_POST['MaDinhDanh'];

    // Kiểm tra nếu mã định danh hợp lệ
    $checkNhanSuSQL = "SELECT MaNhanSu FROM NhanSu WHERE MaDinhDanh = ?";
    $stmtNhanSu = $conn->prepare($checkNhanSuSQL);
    $stmtNhanSu->bind_param("s", $maDinhDanh);
    $stmtNhanSu->execute();
    $resultNhanSu = $stmtNhanSu->get_result();

    if ($resultNhanSu->num_rows === 0) {
        echo '<script>alert("Mã định danh không hợp lệ! Vui lòng kiểm tra lại."); window.history.back();</script>';
        exit();
    }

    // Kiểm tra nếu vai trò là Admin
    if ($phanQuyen === 'Admin') {
        // Kiểm tra số lượng tài khoản Admin
        $stmt_check_admin = $conn->prepare("SELECT COUNT(*) FROM NguoiDung WHERE PhanQuyen = 'Admin'");
        $stmt_check_admin->execute();
        $stmt_check_admin->bind_result($count_admin);
        $stmt_check_admin->fetch();
        $stmt_check_admin->close();

        if ($count_admin > 0) {
            echo "<script>
                    alert('Hệ thống chỉ cho phép một tài khoản Admin. Không thể thêm mới.');
                    window.location.href = 'TaiKhoan_Index.php';
                </script>";
            exit();
        }
    }
    // Lấy MaNhanSu từ kết quả
    $rowNhanSu = $resultNhanSu->fetch_assoc();
    $maNhanSu = $rowNhanSu['MaNhanSu'];

    // Kiểm tra nếu tên đăng nhập đã tồn tại
    $check_sql = "SELECT * FROM NguoiDung WHERE TenDangNhap = ?";
    $stmtCheck = $conn->prepare($check_sql);
    $stmtCheck->bind_param("s", $tenDangNhap);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        echo '<script>alert("Tên đăng nhập đã tồn tại!"); window.history.back();</script>';
    } else {
        // Mã hóa mật khẩu
        $matKhauMaHoa = password_hash($matKhau, PASSWORD_BCRYPT);

        // Câu lệnh SQL để chèn dữ liệu vào bảng NguoiDung
        $insert_sql = "INSERT INTO NguoiDung (TenDangNhap, MatKhau, Email, HoTen, SoDienThoai, DiaChi, PhanQuyen, MaNhanSu)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($insert_sql);
        $stmtInsert->bind_param(
            "sssssssi",
            $tenDangNhap,
            $matKhauMaHoa,
            $email,
            $hoVaTen,
            $sDT,
            $diaChi,
            $phanQuyen,
            $maNhanSu
        );

        // Thực thi câu lệnh SQL
        if ($stmtInsert->execute()) {
            echo '<script>alert("Thêm tài khoản người dùng thành công!"); window.location.href="TaiKhoan_Index.php";</script>';
        } else {
            echo '<script>alert("Lỗi: Không thể thêm tài khoản. Vui lòng thử lại."); window.history.back();</script>';
        }
    }

    // Đóng các kết nối
    $stmtNhanSu->close();
    $stmtCheck->close();
    $stmtInsert->close();
    $conn->close();
}
?>
