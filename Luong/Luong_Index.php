<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--======== CSS ======== -->
    <link rel="stylesheet" href="../CSS/Admin_Style.css?v = <?php echo time(); ?>">

    <!--===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>

    </style>

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
                <li><a href="../NhanSu/NhanSu_Index.php">
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
                <li><a href="../Nghiphep/Nghiphep_Admin_Index.php">
                        <i class="uil uil-file-info-alt"></i>
                        <span class="link-name">Quản lý nghỉ phép</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-subject"></i>
                        <span class="link-name">Quản lý lương</span>
                    </a></li>
                <li><a href="../Lichsucongtac/lichsucongtac_Index.php">
                        <i class="uil uil-book-open"></i>
                        <span class="link-name">Lịch sử công tác</span>
                    </a></li>
                <li><a href="../report/BaoCaoThongKe_Index.php">
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

            <img src="../Img/profile.jpg" alt="Avatar" style="margin-right: 50px;">
        </div>

        <div class="container mt-4">
            <h1 class="w-100 text-center " style="margin-top: 70px;">Quản Lý Lương</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã Nhân Sự</th>
                        <th>Tên Nhân Sự</th>
                        <th>Tổng Lương</th>
                        <th>Tháng Lương</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Kết nối cơ sở dữ liệu
                    require_once '../Connect.php';

                    // Truy vấn dữ liệu lương và nhân sự
                    $lietke_sql = "SELECT * FROM luong JOIN nhansu ON nhansu.MaNhanSu = luong.MaNhanSu";
                    $result = mysqli_query($conn, $lietke_sql);

                    // Kiểm tra và hiển thị dữ liệu
                    while ($r = mysqli_fetch_assoc($result)) { 
                    ?>
                    <tr>
                        <td><?php echo $r['MaNhanSu']; ?></td>
                        <td><?php echo $r['HoTen']; ?></td>
                        <td><?php echo number_format($r['TongLuong'], 0, ',', '.'); ?></td>
                        <td><?php echo date("m/Y", strtotime($r['ThangLuong'])); ?></td>
                        <td>
                            <!-- Các thao tác Sửa, Xóa, Xem chi tiết -->
                            <a href="edit_luong.php?id=<?php echo $r['MaLuong']; ?>"
                                class="btn btn-primary btn-sm">Sửa</a>
                            <a href="view_luong.php?id=<?php echo $r['MaLuong']; ?>" class="btn btn-info btn-sm">Xem chi
                                tiết</a>
                            <a href="history_luong.php?maNhanSu=<?php echo $r['MaNhanSu']; ?>"
                                class="btn btn-warning btn-sm">Xem lịch sử</a>
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="./JS/Admin_Script.js?v = <?php echo time(); ?>"></script>
</body>

</html>