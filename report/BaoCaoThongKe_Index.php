<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Admin_Style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Báo cáo và Thống kê</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../Img/vlogo.png" alt="" style="width: 190px; padding-left:23px;">
            </div>
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
                <li><a href="../Luong/Luong_Index.php">
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
            <img src="../Img/IMG_0190.jpg" alt="Avatar" style="margin-right: 50px;">
        </div>

        <!-- Form tạo báo cáo nhân sự -->
        <div class="container mt-4">
            <h3 class="text-center">Tạo Báo Cáo Nhân Sự</h3>
            <form action="create_report.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="LoaiBaoCao">Loại Báo Cáo:</label>
                    <input type="text" class="form-control" id="LoaiBaoCao" name="LoaiBaoCao" required>
                </div>

                <div class="form-group">
                    <label for="NoiDung">Nội Dung Báo Cáo:</label>
                    <textarea class="form-control" id="NoiDung" name="NoiDung" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Cập Nhật Báo Cáo</button>
            </form>
        </div>

        <!-- Form xuất báo cáo lương -->
        <div class="container mt-4">
            <h3 class="text-center">Xuất Báo Cáo Lương Tổng</h3>
            <form action="export_total_salary.php" method="GET">
                <div class="form-group">
                    <label for="month">Chọn Tháng/Năm:</label>
                    <input type="month" class="form-control" id="month" name="month" required>
                </div>
                <button type="submit" class="btn btn-success">Xuất Lương</button>
            </form>
        </div>

        <!-- Danh sách báo cáo -->
        <div class="container mt-4">
            <h4>Danh Sách Báo Cáo</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã Báo Cáo</th>
                        <th>Ngày Báo Cáo</th>
                        <th>Loại Báo Cáo</th>
                        <th>Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Kết nối cơ sở dữ liệu
                    require_once '../Connect.php';

                    $sql = "SELECT * FROM baocaothongke ORDER BY NgayBaoCao DESC";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['MaBaoCao']}</td>
                                <td>" . date("d/m/Y", strtotime($row['NgayBaoCao'])) . "</td>
                                <td>{$row['LoaiBaoCao']}</td>
                                <td>
                                    <a href='view_report.php?id={$row['MaBaoCao']}' class='btn btn-info btn-sm'>Xem</a>
                                    <a href='export_excel_report.php?id={$row['MaBaoCao']}' class='btn btn-success btn-sm'>Xuất Note</a>
                                    <a href='delete_report.php?id={$row['MaBaoCao']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa báo cáo này?\")'>Xóa</a>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="../JS/Admin_Script.js?v=<?php echo time(); ?>"></script>
</body>

</html>