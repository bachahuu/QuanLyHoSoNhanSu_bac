<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Lịch sử công tác</title>

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
        margin-top: 65px;
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;
    }

    .main-body {
        padding: 15px;
    }

    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }

    .h-100 {
        height: 100% !important;
    }

    .shadow-none {
        box-shadow: none !important;
    }
    </style>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../Img/vlogo.png" alt="" style="width: 190px; padding-left:23px;">
            </div>

            <!-- <span class="logo_name" style="color: orange;">Cao đẳng Đại Việt</span> -->
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

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Tìm kiếm...">
            </div>

            <img src="./Img/profile.jpg" alt="Avatar" style="margin-right: 50px;">
        </div>

        <tbody>
            <?php
                require_once '../Connect.php';

                // Kiểm tra nếu giá trị MaLichSu tồn tại trong URL
                if (isset($_GET['MaNhanSu'])) {
                    $maNhanSu = $_GET['MaNhanSu'];

                    // Tránh SQL Injection
                $maNhanSu = mysqli_real_escape_string($conn, $maNhanSu);
                    $list_sql = "SELECT 
                                nhansu.HoTen, 
                                lichsucongtac.MaNhanSu, 
                                lichsucongtac.ChucVu, 
                                lichsucongtac.PhongBan, 
                                lichsucongtac.ThoiGianBatDau
                            FROM lichsucongtac 
                            JOIN nhansu ON lichsucongtac.MaNhanSu = nhansu.MaNhanSu
                            WHERE lichsucongtac.MaNhanSu = '$maNhanSu'
                            ORDER BY lichsucongtac.ThoiGianBatDau DESC
                            LIMIT 1"; 

                $result = mysqli_query($conn, $list_sql);

                if (!$result) {
                    die("SQL Error: " . mysqli_error($conn)); // Kiểm tra lỗi truy vấn
                }
            } else {
                echo "Không nhận được mã lịch sử từ URL.";
            }

                while ($r = mysqli_fetch_array($result)) {
                ?>
            <script src="./JS/Admin_Script.js?v = <?php echo time(); ?>"></script>
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://png.pngtree.com/png-clipart/20210613/original/pngtree-white-silhouette-avatar-png-image_6404680.jpg"
                                    alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4><?php echo $r['HoTen']; ?></h4>
                                    <p class="text-secondary mb-1"><?php echo $r['PhongBan']; ?></p>
                                    <p class="text-muted font-size-sm"><?php echo $r['ChucVu']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

                <div class="col-md-8">
                    <div class="col-sm-12">
                        <button class="btn btn-primary " style="margin-bottom: 10px" data-toggle="modal"
                            data-target="#addsql">Thêm</button>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class=" thead-dark">
                                    <tr>
                                        <th>Phòng ban</th>
                                        <th>Chức vụ </th>
                                        <th>Thời Gian Bắt Đầu </th>
                                        <th>Thời Gian Kết Thúc</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead class="thead-light">
                                <tbody>

                                    <?php
                require_once '../Connect.php';

                // Kiểm tra nếu giá trị MaLichSu tồn tại trong URL
                if (isset($_GET['MaNhanSu'])) {
                    $maNhanSu = $_GET['MaNhanSu'];

                    // Tránh SQL Injection
                $maNhanSu = mysqli_real_escape_string($conn, $maNhanSu);
                    $list_sql = "SELECT 
                                nhansu.HoTen, 
                                lichsucongtac.MaLichSu,
                                lichsucongtac.MaNhanSu, 
                                lichsucongtac.ChucVu, 
                                lichsucongtac.PhongBan, 
                                lichsucongtac.ThoiGianBatDau, 
                                lichsucongtac.ThoiGianKetThuc
                                -- CONCAT(
                                -- DATE_FORMAT(lichsucongtac.ThoiGianBatDau, '%d-%m-%Y'), ' đến ', 
                                -- IFNULL(DATE_FORMAT(lichsucongtac.ThoiGianKetThuc, '%d-%m-%Y'), '...')
                                -- ) AS ThoiGianLam
                            FROM lichsucongtac 
                            JOIN nhansu ON lichsucongtac.MaNhanSu = nhansu.MaNhanSu
                            WHERE lichsucongtac.MaNhanSu = '$maNhanSu'"; 
                $result = mysqli_query($conn, $list_sql);

                if (!$result) {
                    die("SQL Error: " . mysqli_error($conn)); // Kiểm tra lỗi truy vấn
                }
            } else {
                echo "Không nhận được mã lịch sử từ URL.";
            }

                while ($r = mysqli_fetch_array($result)) {
                ?>
                                    <tr>

                                        <td><?php echo $r['PhongBan']; ?></td>
                                        <td><?php echo $r['ChucVu']; ?></td>
                                        <td><?php echo $r['ThoiGianBatDau']; ?></td>
                                        <td><?php echo $r['ThoiGianKetThuc']; ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- <a class="btn btn-success " href="Edit_lichsucongtac.php">Sửa</a> -->
                                                    <!-- tôi sửa -->
                                                    <a class="btn btn-success" href="#" data-toggle="modal"
                                                        data-target="#updatesql"
                                                        data-malichsu="<?php echo $r['MaLichSu']; ?>"
                                                        data-phongban="<?php echo $r['PhongBan']; ?>"
                                                        data-chucvu="<?php echo $r['ChucVu']; ?>"
                                                        data-thoigianbatdau="<?php echo $r['ThoiGianBatDau']; ?>"
                                                        data-thoigianketthuc="<?php echo $r['ThoiGianKetThuc']; ?>">
                                                        Sửa
                                                    </a>
                                                    <a onclick="return confirm('Bạn có muốn xóa không ? ')"
                                                        class="btn btn-danger"
                                                        href="Delete_lichsucongtac.php?MaLichSu=<?php echo $r['MaLichSu']; ?>&MaNhanSu=<?php echo $r['MaNhanSu']; ?>">
                                                        Xóa
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                 }
                 ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </tbody>
        </table>

        <div class="modal fade" id="addsql" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family: Helvetica Neue">Thêm
                            lịch sử công tác</h1>
                    </div>
                    <div class="modal-body">
                        <form action="./Add_lichsucongtac.php" method="POST">
                            <input type="hidden" name="MaNhanSu" value="<?php echo $maNhanSu; ?>">
                            <?php
                $maNhanSu = isset($_GET['MaNhanSu']) ? $_GET['MaNhanSu'] : '';

                require_once '../Connect.php';
                if (!empty($maNhanSu)) {
                    $sql = "SELECT nhansu.Hoten,
                                    nhansu.MaNhanSu,
                                    lichsucongtac.MaNhanSu 
                                    FROM lichsucongtac 
                                    Join nhansu on nhansu.MaNhanSu=lichsucongtac.MaNhanSu 
                                    WHERE lichsucongtac.MaNhanSu = '$maNhanSu'";
                    $result = mysqli_query($conn, $sql);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $tenNhanSu = $row['Hoten'];
                    }
                }
                ?>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Tên nhân sự:</label>
                                <input type="text" id="manhansu" class="form-control" value="<?php echo $tenNhanSu; ?>"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Phòng ban:</label>
                                <input type="text" id="PhongBan" class="form-control" name="PhongBan">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Chức vụ:</label>
                                <input type="text" id="ChucVu" class="form-control" name="ChucVu">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Ngày bắt đầu:</label>
                                <input type="date" id="ThoiGianBatDau" class="form-control" name="ThoiGianBatDau">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Ngày kết thúc:</label>
                                <input type="date" id="ThoiGianKetThuc" class="form-control" name="ThoiGianKetThuc">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                <button class="btn btn-success" type="submit">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- sửa lịch sử công tác -->
        <div class="modal fade" id="updatesql" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family: Helvetica Neue">Update
                            lịch sử công tác</h1>
                    </div>
                    <div class="modal-body">
                        <form action="Edit_lichsucongtac.php" method="POST">

                            <?php
                $maNhanSu = isset($_GET['MaNhanSu']) ? $_GET['MaNhanSu'] : '';

                require_once '../Connect.php';
                if (!empty($maNhanSu)) {
                    $sql = "SELECT nhansu.Hoten,
                                    nhansu.MaNhanSu,
                                    lichsucongtac.MaNhanSu ,
                                    lichsucongtac.MaLichSu
                                    FROM lichsucongtac 
                                    Join nhansu on nhansu.MaNhanSu=lichsucongtac.MaNhanSu 
                                    WHERE lichsucongtac.MaNhanSu = '$maNhanSu'";
                    $result = mysqli_query($conn, $sql);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $tenNhanSu = $row['Hoten'];
                        $malichsu = $row['MaLichSu'];
                    }
                }
                ?>
                            <input type="flex" name="MaNhanSu" value="<?php echo $maNhanSu; ?>">
                            <input type="flex" id="malichsu" name="malichsu">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Tên nhân sự:</label>
                                <input type="text" id="manhansu" class="form-control" name='manhansu'
                                    value="<?php echo $tenNhanSu; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Phòng ban:</label>
                                <input type="text" id="PhongBan" class="form-control" name="PhongBan">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Chức vụ:</label>
                                <input type="text" id="ChucVu" class="form-control" name="ChucVu">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Ngày bắt đầu:</label>
                                <input type="date" id="ThoiGianBatDau" class="form-control" name="ThoiGianBatDau">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Ngày kết thúc:</label>
                                <input type="date" id="ThoiGianKetThuc" class="form-control" name="ThoiGianKetThuc">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                                <button class="btn btn-success" type="submit">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
    $('#updatesql').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút được nhấn
        var phongBan = button.data('phongban');
        var chucVu = button.data('chucvu');
        var thoiGianBatDau = button.data('thoigianbatdau');
        var ThoiGianKetThuc = button.data('thoigianketthuc');
        var malichsu = button.data('malichsu');

        // Cập nhật các trường trong modal
        var modal = $(this);
        modal.find('#PhongBan').val(phongBan);
        modal.find('#ChucVu').val(chucVu);
        modal.find('#ThoiGianBatDau').val(thoiGianBatDau);
        modal.find('#ThoiGianKetThuc').val(ThoiGianKetThuc);
        modal.find('#malichsu').val(malichsu);
    });
    </script>
</body>

</html>