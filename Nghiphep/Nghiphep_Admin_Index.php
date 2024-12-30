<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nghỉ Phép</title>

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
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .days-left {
        font-size: 16px;
        margin-bottom: 20px;
    }

    .btn {
        padding: 10px 15px;
        margin: 5px 0;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        display: inline-block;
        text-decoration: none;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th,
    table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .status-pending {
        color: orange;
        font-weight: bold;
    }

    .status-approved {
        color: green;
        font-weight: bold;
    }
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
                <li><a href="#">
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

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Tìm kiếm...">
            </div>

            <img src="./Img/profile.jpg" alt="Avatar" style="margin-right: 50px;">



        </div>


        <!-- Bảng danh sách đơn nghỉ phép -->
        <div class="container">
            <div class="dash-content">
                <h1 style="justify-content: center; text-align: center;">Quản lý nghỉ phép</h1>
                <table class="table table-striped">
                    <thead class=" thead-dark">
                        <tr>
                            <th>Tên nhân sự</th>
                            <th>Lý do nghỉ phép</th>
                            <th>Ngày bắt đầu nghỉ</th>
                            <th>Ngày kết thúc nghỉ</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead class="thead-light">
                    <tbody>
                        <?php
                require_once '../Connect.php';
                $list_sql = "
                    SELECT 
                        nghiphep.NgayBatDau,
                        nghiphep.LyDo,
                        nghiphep.NgayKetThuc,
                        nghiphep.SoNgayPhep,
                        nghiphep.TrangThai,
                        nhansu.HoTen,
                        nghiphep.MaNhanSu
                    FROM nghiphep
                    JOIN nhansu ON nghiphep.MaNhanSu = nhansu.MaNhanSu
                ";
                $result = mysqli_query($conn, $list_sql);
                while ($r = mysqli_fetch_array($result)) {
                ?>
                        <tr>
                            <td><?php echo $r['HoTen']; ?></td>
                            <td><?php echo $r['LyDo']; ?></td>
                            <td><?php echo $r['NgayBatDau']; ?></td>
                            <td><?php echo $r['NgayKetThuc']; ?></td>
                            <td><?php echo $r['SoNgayPhep']; ?></td>
                            <td>
                                <form class="form-inline" method="POST" action="Nghiphep_Update.php">
                                    <select class="form-control" name="TrangThai">
                                        <option value="Đã duyệt"
                                            <?php echo $r['TrangThai'] == 'Đã duyệt' ? 'selected' : ''; ?>>Đã duyệt
                                        </option>
                                        <option value="Từ chối"
                                            <?php echo $r['TrangThai'] == 'Từ chối' ? 'selected' : ''; ?>>Từ chối
                                        </option>
                                        <option value="Chờ duyệt"
                                            <?php echo $r['TrangThai'] == 'Chờ duyệt' ? 'selected' : ''; ?>>Chờ duyệt
                                        </option>
                                    </select>
                            <td>
                                <input type="hidden" name="MaNhanSu" value="<?php echo $r['MaNhanSu']; ?>">
                                <input type="hidden" name="NgayBatDau" value="<?php echo $r['NgayBatDau']; ?>">
                                <button type="submit" class="btn btn-info ml-2">Lưu</button>
                            </td>
                            </form>
                            </td>
                        </tr>
                        <?php
                }
                ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <script src="./JS/Admin_Script.js?v = <?php echo time(); ?>"></script>

</body>

</html>