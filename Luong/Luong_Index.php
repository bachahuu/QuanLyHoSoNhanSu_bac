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
                <img src="../Img/vlogo.png" alt="" style="width: 190px; padding-left:23px;">
            </div>

            <!-- <span class="logo_name" style="color: orange;">UTT SCHOOL</span> -->
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


            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <img src="../Img/IMG_0190.JPG" alt="Avatar" style="margin-right: 50px;">
        </div>

        <div class="container mt-4">

            <h1 class="w-100 text-center " style="margin-top: 70px;">Quản Lý Lương</h1>
            <!-- Nút Thêm Lương -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSalaryModal">
                Thêm Lương
            </button>
            <!-- Form tìm kiếm -->
            <form method="GET" action="" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="search_name" class="form-control"
                            placeholder="Tìm kiếm theo Tên Nhân Sự"
                            value="<?php echo isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : ''; ?>">
                    </div>
                    <!-- <div class="col-md-4">
                        <input type="text" name="search_id" class="form-control" placeholder="Tìm kiếm theo Mã Định Danh"
                            value="<?php echo isset($_GET['search_id']) ? htmlspecialchars($_GET['search_id']) : ''; ?>">
                    </div> -->
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã Định Danh</th>
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
                    // Lấy dữ liệu tìm kiếm
                    $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
                    // Truy vấn dữ liệu lương và nhân sự
                    $lietke_sql = "SELECT * FROM luong  JOIN nhansu ON nhansu.MaNhanSu = luong.MaNhanSu";
                    // Thêm điều kiện tìm kiếm nếu có
                    if (!empty($search_name)) {
                        $lietke_sql .= " AND nhansu.HoTen LIKE '%" . mysqli_real_escape_string($conn, $search_name) . "%'";
                    }
                    $result = mysqli_query($conn, $lietke_sql);
                    // Kiểm tra và hiển thị dữ liệu
                    while ($r = mysqli_fetch_assoc($result)) { 
                    ?>
                    <tr>
                        <td><?php echo $r['MaDinhDanh']; ?></td>
                        <td><?php echo $r['HoTen']; ?></td>
                        <td><?php echo number_format($r['TongLuong'], 0, ',', '.'); ?></td>
                        <td><?php echo date("m/Y", strtotime($r['ThangLuong'])); ?></td>
                        <!-- Đảm bảo Tháng Lương hiển thị đúng -->
                        <td>
                            <a href="edit_luong.php?id=<?php echo $r['MaLuong']; ?>"
                                class="btn btn-primary btn-sm">Sửa</a>
                            <a href="view_luong.php?id=<?php echo $r['MaLuong']; ?>" class="btn btn-info btn-sm">Xem chi
                                tiết</a>
                            <a href="history_luong.php?maNhanSu=<?php echo $r['MaNhanSu']; ?>"
                                class="btn btn-warning btn-sm">Xem lịch sử</a>
                            <!-- Nút xóa -->
                            <a href="deleteluong.php?id=<?php echo $r['MaLuong']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Modal Thêm Lương -->
    <div class="modal fade" id="addSalaryModal" tabindex="-1" role="dialog" aria-labelledby="addSalaryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSalaryModalLabel">Thêm Lương</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="addluong.php">
                        <div class="form-group">
                            <label for="employeeName">Tên Nhân Sự</label>
                            <select name="MaNhanSu" id="employeeName" class="form-control" required>
                                <option value="">Chọn Nhân Sự</option>
                                <?php
                                // Lấy danh sách nhân sự từ cơ sở dữ liệu
                                require_once '../Connect.php';
                                $sql = "SELECT MaNhanSu, HoTen FROM nhansu";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['MaNhanSu'] . "'>" . $row['HoTen'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="salaryMonth">Tháng Lương</label>
                            <input type="date" name="ThangLuong" id="salaryMonth" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="MucLuongCoBan">Mức Lương Cơ Bản:</label>
                            <input type="number" class="form-control" id="MucLuongCoBan" name="MucLuongCoBan"
                                value="<?php echo $mucLuongCoBan; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="PhuCap">Phụ Cấp:</label>
                            <input type="number" class="form-control" id="PhuCap" name="PhuCap"
                                value="<?php echo $phuCap; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="KhauTru">Khấu Trừ:</label>
                            <input type="number" class="form-control" id="KhauTru" name="KhauTru"
                                value="<?php echo $khauTru; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="ThueThuNhap">Thuế Thu Nhập:</label>
                            <input type="number" class="form-control" id="ThueThuNhap" name="ThueThuNhap"
                                value="<?php echo $thueThuNhap; ?>" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu Lương</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../JS/Admin_Script.js?v = <?php echo time(); ?>"></script>
</body>

</html>