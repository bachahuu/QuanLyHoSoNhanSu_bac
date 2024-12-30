<?php
require_once '../Connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form và làm sạch
    $tenDangNhap = trim($_POST['TenDangNhap']);
    $matKhau = trim($_POST['MatKhau']);

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare("SELECT MaNguoiDung, MatKhau, PhanQuyen, TrangThaiTaiKhoan FROM NguoiDung WHERE TenDangNhap = ?");
    $stmt->bind_param("s", $tenDangNhap);

    // Thực thi câu lệnh SQL
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($maNguoiDung, $matKhauMaHoa, $phanQuyen, $trangThaiTaiKhoan);
        $stmt->fetch();

        // Kiểm tra trạng thái tài khoản
        if ($trangThaiTaiKhoan !== 'Hoạt động') {
            echo "<script>
                    alert('Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.');
                    window.location.href = 'Dangnhap_Index.php';
                </script>";
            exit();
        }

        // Kiểm tra mật khẩu
        if (password_verify($matKhau, $matKhauMaHoa)) {
            // Đăng nhập thành công
            session_start();
            $_SESSION['MaNguoiDung'] = $maNguoiDung;
            $_SESSION['TenDangNhap'] = $tenDangNhap;
            $_SESSION['PhanQuyen'] = $phanQuyen;

            // Phân quyền dựa trên vai trò
            if ($phanQuyen == 'Admin') {
                echo "<script>
                        alert('Đăng nhập thành công với vai trò Quản trị viên.');
                        window.location.href = '../Admin_Index.php';
                    </script>";
            } elseif ($phanQuyen == 'Kế Toán') {
                echo "<script>
                        alert('Đăng nhập thành công với vai trò Kế Toán.');
                        window.location.href = '../KeToan_Index.php';
                    </script>";
            } else {
                echo "<script>
                        alert('Đăng nhập thành công.');
                        window.location.href = '../ThongTinNhanSu/ThongTinCaNhan_Index.php';
                    </script>";
            }
        } else {
            echo "<script>
                    alert('Sai mật khẩu. Vui lòng thử lại.');
                    window.location.href = 'Dangnhap_Index.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Không tìm thấy tài khoản. Vui lòng kiểm tra lại tên đăng nhập.');
                window.location.href = 'Dangnhap_Index.php';
            </script>";
    }

    // Đóng statement và connection
    $stmt->close();
    $conn->close();
}
?>