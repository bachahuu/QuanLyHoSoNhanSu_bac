<?php
// Bao gồm file kết nối cơ sở dữ liệu
require_once '../Connect.php'; // Đảm bảo đường dẫn chính xác đến file Connect.php

// Kiểm tra nếu người dùng đã đăng nhập (kiểm tra tên đăng nhập)
session_start();
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
    $sqlNhanSu = "SELECT * FROM NhanSu WHERE MaNhanSu = ?";
    $stmtNhanSu = $conn->prepare($sqlNhanSu);
    $stmtNhanSu->bind_param("i", $maNhanSu);
    $stmtNhanSu->execute();
    $resultNhanSu = $stmtNhanSu->get_result();

    if ($resultNhanSu->num_rows > 0) {
        // Lấy dữ liệu nhân sự
        $dataNhanSu = $resultNhanSu->fetch_assoc();

        // Lấy thông tin chức vụ từ bảng ChucVu
        $maChucVu = $dataNhanSu['MaChucVu'];
        $sqlChucVu = "SELECT TenChucVu FROM ChucVu WHERE MaChucVu = ?";
        $stmtChucVu = $conn->prepare($sqlChucVu);
        $stmtChucVu->bind_param("i", $maChucVu);
        $stmtChucVu->execute();
        $resultChucVu = $stmtChucVu->get_result();

        if ($resultChucVu->num_rows > 0) {
            $dataChucVu = $resultChucVu->fetch_assoc();
            $tenChucVu = $dataChucVu['TenChucVu']; // Lấy tên chức vụ
        } else {
            $tenChucVu = 'Chưa xác định';
        }
    } else {
        // Nếu không tìm thấy nhân sự
        echo '<script>alert("Không tìm thấy thông tin nhân sự!"); window.location.href = "logout.php";</script>';
    }

} else {
    // Nếu không tìm thấy người dùng
    echo '<script>alert("Không tìm thấy tài khoản người dùng!"); window.location.href = "login.php";</script>';
}
?>




<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../CSS/Admin_Style.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">


    <title>Admin</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="http://utt.edu.vn/home/images/stories/logo-utt-border.png" alt="">
            </div>

            <span class="logo_name" style="color: orange;">UTT SCHOOL</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="../TaiKhoan/TaiKhoan_Index.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Quản lý tài khoản</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-table"></i>
                        <span class="link-name">Quản lý nhân sự</span>
                    </a></li>
                <li><a href="../Thongtincongviec/ThongTinCongViec.php">
                        <i class="uil uil-book-reader"></i>
                        <span class="link-name">Quản lý công việc</span>
                    </a></li>
                <li><a href="../quanlychucvu/ChucVu.php">
                        <i class="uil uil-briefcase-alt"></i>
                        <span class="link-name">Quản lý Chức Vụ</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-file-info-alt"></i>
                        <span class="link-name">Quản lý nghỉ phép</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-subject"></i>
                        <span class="link-name">Quản lý lương</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-book-open"></i>
                        <span class="link-name">Lịch sử công tác</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-analytics"></i>
                        <span class="link-name">Báo cáo và thống kê</span>
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

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Tìm kiếm...">
            </div>

            <img src="../Img/AVT.jpg" alt="Avatar" style="margin-right: 50px;">



        </div>

        <div class="dash-content">
            <div class="container mt-5">
                <div class="row">
                    <!-- Phần hình ảnh cá nhân -->
                    <div class="col-md-4 text-center">
                        <div class="card shadow">
                            <div class="card-body">
                                <img src="../Img/AVT.jpg" class="rounded-circle img-thumbnail mb-3" alt="Profile Image"
                                    style="width: 5cm; height: 5cm;">
                                <h4 class="card-title"><?= htmlspecialchars($dataNhanSu['HoTen']) ?></h4>
                                <p class="text-muted">Mã Định Danh:
                                    <strong><?= htmlspecialchars($dataNhanSu['MaDinhDanh']) ?></strong></p>
                                <p
                                    class="badge <?= $dataNhanSu['TinhTrangLamViec'] == 'Đang làm' ? 'bg-success' : 'bg-danger' ?>">
                                    <?= htmlspecialchars($dataNhanSu['TinhTrangLamViec']) ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Phần thông tin cá nhân -->
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5>Thông Tin Cá Nhân</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Họ và Tên:</strong> <?= htmlspecialchars($dataNhanSu['HoTen']) ?></p>
                                <p><strong>Giới Tính:</strong> <?= htmlspecialchars($dataNhanSu['GioiTinh']) ?></p>
                                <p><strong>Ngày Sinh:</strong> <?= htmlspecialchars($dataNhanSu['NgaySinh']) ?></p>
                                <p><strong>CMND/CCCD:</strong> <?= htmlspecialchars($dataNhanSu['CMND_CCCD']) ?></p>
                                <p><strong>Số Điện Thoại:</strong> <?= htmlspecialchars($dataNhanSu['SoDienThoai']) ?>
                                </p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($dataNhanSu['Email']) ?></p>
                                <p><strong>Địa Chỉ:</strong> <?= htmlspecialchars($dataNhanSu['DiaChi']) ?></p>
                                <p><strong>Ngày Vào Làm:</strong> <?= htmlspecialchars($dataNhanSu['NgayVaoLam']) ?></p>
                                <p><strong>Loại Hợp Đồng:</strong> <?= htmlspecialchars($dataNhanSu['LoaiHopDong']) ?>
                                </p>
                                <p><strong>Chức Vụ:</strong> <?= htmlspecialchars($tenChucVu) ?></p>
                            </div>
                        </div>

                        <!-- Thông tin tài khoản -->
                        <div class="card shadow mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h5>Thông Tin Tài Khoản</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Tên Đăng Nhập:</strong> <?= htmlspecialchars($data['TenDangNhap']) ?></p>
                                <p><strong>Vai Trò:</strong> <?= htmlspecialchars($data['PhanQuyen']) ?></p>
                                <p><strong>Trạng Thái Tài Khoản:</strong>
                                    <span
                                        class="badge <?= $data['TrangThaiTaiKhoan'] == 'Hoạt động' ? 'bg-success' : 'bg-danger' ?>">
                                        <?= htmlspecialchars($data['TrangThaiTaiKhoan']) ?>
                                    </span>
                                </p>
                                <p><strong>Lần Đăng Nhập Cuối:</strong>
                                    <?= htmlspecialchars($data['LanDangNhapCuoi']) ?></p>
                                <!-- Nút đổi mật khẩu và khóa tài khoản -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#changePasswordModal">
                                    Đổi Mật Khẩu
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#confirmModal">
                                    Khóa Tài Khoản
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Đổi Mật Khẩu -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content shadow-lg border-0 rounded-3">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="changePasswordModalLabel">Đổi Mật Khẩu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="DoiMatKhau.php" method="POST">
                            <div class="mb-4">
                                <label for="MatKhauCu" class="form-label">Mật khẩu cũ</label>
                                <input type="password" class="form-control shadow-sm" id="MatKhauCu" name="MatKhauCu"
                                    placeholder="Nhập mật khẩu cũ" required>
                            </div>
                            <div class="mb-4">
                                <label for="MatKhauMoi" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control shadow-sm" id="MatKhauMoi" name="MatKhauMoi"
                                    placeholder="Nhập mật khẩu mới" required>
                            </div>
                            <div class="mb-4">
                                <label for="XacNhanMatKhau" class="form-label">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control shadow-sm" id="XacNhanMatKhau"
                                    name="XacNhanMatKhau" placeholder="Xác nhận mật khẩu mới" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Đổi Mật Khẩu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="confirmModalLabel">Xác nhận khóa tài khoản</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc chắn muốn khóa tài khoản này? Hành động này không thể hoàn tác.
                    </div>
                    <div class="modal-footer" style="background-color: white;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <a href="KhoaTaikhoan.php" class="btn btn-danger">Xác nhận</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/Admin_Script.js"></script>
</body>

</html>