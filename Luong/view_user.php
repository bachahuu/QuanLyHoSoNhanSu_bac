<?php
// Bắt đầu session
session_start();

// Kết nối với cơ sở dữ liệu
require_once '../Connect.php';

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['TenDangNhap'])) {
    echo '<script>alert("Vui lòng đăng nhập!"); window.location.href = "login.php";</script>';
    exit;
}

// Lấy tên đăng nhập từ session
$tenDangNhap = $_SESSION['TenDangNhap'];

// Lấy thông tin người dùng từ bảng NguoiDung
$sqlNguoiDung = "SELECT * FROM NguoiDung WHERE TenDangNhap = ?";
$stmtNguoiDung = $conn->prepare($sqlNguoiDung);
$stmtNguoiDung->bind_param("s", $tenDangNhap);
$stmtNguoiDung->execute();
$resultNguoiDung = $stmtNguoiDung->get_result();

if ($resultNguoiDung->num_rows > 0) {
    // Lấy dữ liệu người dùng
    $data = $resultNguoiDung->fetch_assoc();

    // Lấy thông tin nhân sự từ bảng NhanSu dựa vào MaNhanSu
    $maNhanSu = $data['MaNhanSu'];
} else {
    echo '<script>alert("Không tìm thấy tài khoản người dùng!"); window.location.href = "login.php";</script>';
    exit;
}

// Kiểm tra nếu có tham số tháng được chọn từ URL (GET)
$thangLuong = isset($_GET['thangLuong']) ? $_GET['thangLuong'] : '';  // Để trống nếu không có tháng nào được chọn

// Truy vấn để lấy tất cả các tháng lương có trong hệ thống cho nhân viên này
$sql_thangLuong = "SELECT DISTINCT DATE_FORMAT(ThangLuong, '%Y-%m') AS ThangLuong FROM luong WHERE MaNhanSu = ?";
$stmtThangLuong = $conn->prepare($sql_thangLuong);
$stmtThangLuong->bind_param("i", $maNhanSu);
$stmtThangLuong->execute();
$result_thangLuong = $stmtThangLuong->get_result();

// Nếu tháng được chọn, truy vấn lương cho tháng đó
if ($thangLuong) {
    // Truy vấn để lấy chi tiết lương theo mã nhân sự và tháng lương
    $sql = "SELECT * FROM luong WHERE MaNhanSu = ? AND DATE_FORMAT(ThangLuong, '%Y-%m') = ?";
    $stmtLuong = $conn->prepare($sql);
    $stmtLuong->bind_param("is", $maNhanSu, $thangLuong);
    $stmtLuong->execute();
    $result = $stmtLuong->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Nếu tìm thấy thông tin chi tiết
        $mucLuongCoBan = $row['MucLuongCoBan'];
        $phuCap = $row['PhuCap'];
        $khauTru = $row['KhauTru'];
        $thueThuNhap = $row['ThueThuNhap'];
        $soNgayLamViec = $row['SoNgayLamViec'];
        $tongLuong = $row['TongLuong'];
        $thangLuong = $row['ThangLuong'];
    } else {
        echo '<p>Không tìm thấy thông tin lương cho tháng được chọn.</p>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <title>Chi Tiết Lương</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../CSS/Admin_Style.css?v = <?php echo time(); ?>">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <!-- Sidebar -->
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../Img/vlogo.png" alt="" style="width: 190px; padding-left:23px;">
            </div>

            <!-- <span class="logo_name" style="color: orange;">UTT SCHOOL</span> -->
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="../ThongTinNhanSu/ThongTinCaNhan_Index.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Thông tin cá nhân</span>
                    </a></li>
                <li><a href="../Lichsucongtac/lichsucongtac_user.php">
                        <i class="uil uil-table"></i>
                        <span class="link-name">Lịch sử công tác</span>
                    </a></li>
                <li><a href="../Nghiphep/Nghiphep_User_Index.php">
                        <i class="uil uil-book-reader"></i>
                        <span class="link-name">Nghỉ phép</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-file-info-alt"></i>
                        <span class="link-name">Lương</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="../Login/DangXuat.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Đăng xuất</span>
                    </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Chế độ</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <img src="../Img/AVT.jpg" alt="Avatar" style="margin-right: 50px;">
        </div>

        <div class="dash-content">
            <div class="container mt-5">
                <h3 class="text-center">Chi Tiết Lương</h3>

                <!-- Form chọn tháng -->
                <form method="GET" action="">
                    <div class="form-group">
                        <label for="thangLuong">Chọn Tháng Lương</label>
                        <select name="thangLuong" id="thangLuong" class="form-control" onchange="this.form.submit()"
                            style="height: auto;">
                            <option value="">Chọn tháng</option>
                            <?php
                            // Hiển thị các tháng đã có trong cơ sở dữ liệu
                            while ($row_thang = $result_thangLuong->fetch_assoc()) {
                                $thang = $row_thang['ThangLuong'];
                                $selected = ($thang == $thangLuong) ? 'selected' : '';
                                echo "<option value='$thang' $selected>$thang</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>

                <!-- Bảng thông tin lương -->
                <?php if ($thangLuong && isset($row)): ?>
                <table class="table table-bordered mt-4">
                    <tr>
                        <th>Mức Lương Cơ Bản</th>
                        <td><?php echo number_format($mucLuongCoBan, 0, ',', '.'); ?> VND</td>
                    </tr>
                    <tr>
                        <th>Phụ Cấp</th>
                        <td><?php echo number_format($phuCap, 0, ',', '.'); ?> VND</td>
                    </tr>
                    <tr>
                        <th>Khấu Trừ</th>
                        <td><?php echo number_format($khauTru, 0, ',', '.'); ?> VND</td>
                    </tr>
                    <tr>
                        <th>Thuế Thu Nhập</th>
                        <td><?php echo number_format($thueThuNhap, 0, ',', '.'); ?> VND</td>
                    </tr>
                    <tr>
                        <th>Số Ngày Làm Việc</th>
                        <td><?php echo $soNgayLamViec; ?> ngày</td>
                    </tr>
                    <tr>
                        <th>Tổng Lương</th>
                        <td><?php echo number_format($tongLuong, 0, ',', '.'); ?> VND</td>
                    </tr>
                    <tr>
                        <th>Tháng Lương</th>
                        <td><?php echo date("m/Y", strtotime($thangLuong)); ?></td>
                    </tr>
                </table>
                <?php else: ?>
                <p class="text-center mt-4">Chọn tháng để xem thông tin lương.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>