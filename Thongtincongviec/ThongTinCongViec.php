<?php
require_once '../Connect.php';
$search_term = '';
if (isset($_POST['search_term'])) {
    $search_term = mysqli_real_escape_string($conn, $_POST['search_term']);
}
$sql_congviec = "SELECT chucvu.* , nhansu.* , congviec.*  FROM congviec
JOIN nhansu ON nhansu.MaNhanSu = congviec.MaNhanSu
JOIN chucvu ON chucvu.MaChucVu = congviec.MaChucVu
WHERE chucvu.TenChucVu LIKE '%$search_term%' 
               OR nhansu.HoTen LIKE '%$search_term%' 
               OR congviec.KhoaPhongBan LIKE '%$search_term%'  ";
$result_congviec = mysqli_query($conn,$sql_congviec);
$i = 1; // Khởi tạo STT
$sql_chucvu = "SELECT * FROM chucvu " ;
$result_chucvu = mysqli_query($conn, $sql_chucvu);
?>
<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../CSS/Admin_Style.css?v = <?php echo time(); ?>">


    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .table td,
    .table th {
        text-align: center;
        vertical-align: middle;
    }

    button.uil {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        color: inherit;
        /* Sử dụng màu hiện tại */
        font-size: 1.5rem;
        /* Hoặc kích thước bạn muốn */
        line-height: 1;
        /* Căn chỉnh biểu tượng */
    }

    button.uil:hover {
        color: orange;
        /* Màu hover giống với icon cũ */
    }
    </style>
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
                <li><a href="./NguoiDung/index_NguoiDung.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Quản lý tài khoản</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-table"></i>
                        <span class="link-name">Quản lý nhân sự</span>
                    </a></li>
                <li><a href="#">
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
                <li><a href="./Login/DangXuat.php">
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
                <form action="ThongTinCongViec.php" method="post">
                    <i class="uil uil-search"></i>
                    <input type="text" name="search_term" placeholder="Tìm kiếm ..." required>
                    <button class="uil uil-search" type="submit"></button>
                </form>
            </div>

            <img src="./Img/profile.jpg" alt="Avatar" style="margin-right: 50px;">
        </div>
        <div class="dash-content">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="w-100 text-center ">Danh Sách Công Việc</h1>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAdd"
                        style="margin-right: 20px;">Thêm</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>STT</th>
                                <th>Họ Và Tên</th>
                                <th>Chức Vụ</th>
                                <th>Phụ cấp chức vụ</th>
                                <th>Hệ Số Lương</th>
                                <th>Khoa/Phòng Ban</th>
                                <th>Ngày Bắt Đầu</th>
                                <th>Ngày Kết Thúc</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody id="job-data">
                            <?php 
    if ($result_congviec && mysqli_num_rows($result_congviec) > 0) {
        while ($row = mysqli_fetch_assoc($result_congviec)) { ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?php echo $row['HoTen'] ?></td>
                                <td><?php echo $row['TenChucVu'] ?></td>
                                <td><?php echo number_format($row['PhuCapChucVu'], 0, ',', '.') . ' VND'; ?></td>
                                <td><?php echo $row['HeSoLuong'] ?></td>
                                <td><?php echo $row['KhoaPhongBan'] ?></td>
                                <td><?php echo $row['NgayBatDau'] ?></td>
                                <td><?php echo $row['NgayKetThuc'] ?></td>
                                <td
                                    style="display: flex; justify-content: center; align-items: center; gap: 10px; height: 100%;">
                                    <form action="edit.php.php" method="post">
                                        <button type="button" class="btn btn-primary btn-edit" data-toggle="modal"
                                            data-target="#myModalEdit" data-machucvu="<?= $row['MaChucVu']; ?>"
                                            data-mcv="<?= $row['MaCongViec']; ?>" data-ten="<?= $row['HoTen']; ?>"
                                            data-tcv="<?= $row['TenChucVu']; ?>"
                                            data-phucap="<?=$row['PhuCapChucVu']; ?>"
                                            data-hesoluong="<?=$row['HeSoLuong']; ?>"
                                            data-khoaphongban="<?= $row['KhoaPhongBan']; ?>"
                                            data-ngaybatdau="<?= $row['NgayBatDau']; ?>"
                                            data-ngayketthuc="<?= $row['NgayKetThuc']; ?>"
                                            data-manhansu="<?= $row['MaNhanSu']; ?>">
                                            Sửa
                                        </button>
                                    </form>
                                    <a href="chitietcongviec.php?macongviec=<?php echo $row['MaCongViec'] ?>"
                                        class="btn btn-success" style="margin-right: 5px;margin-left:5px;"> chi
                                        tiết </a>
                                    <button type="button" class="btn btn-danger "
                                        onclick="if(confirm('Bạn có chắc muốn xóa chức này?')) { window.location.href = 'delete_job.php?Sid=<?= $row['MaCongViec'] ?>'; }">
                                        Xóa
                                    </button>

                                </td>
                            </tr>
                            <?php }
    } else { ?>
                            <tr>
                                <td colspan="9" class="text-center">Không có công việc nào trong danh sách.</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Thêm Công Việc -->
    <div id="myModalAdd" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Quản Lý Thông Tin Công Việc</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="themcongviec.php" method="post" id="insertForm">
                    <div class="row g-3">
                        <!-- Họ và Tên -->
                        <div class="col-md-6">
                            <label for="madinhdanh" class="form-label">Mã Định Danh</label>
                            <input type="text" id="madinhdanh" name="madinhdanh" class="form-control"
                                placeholder="Ví Dụ : NV...">
                        </div>
                        <div class="col-md-6">
                            <label for="TenChucVu">Tên Chức Vụ</label>
                            <select id="TenChucVu" name="machucvu" class="form-control">
                                <?php 
            while($r = mysqli_fetch_assoc($result_chucvu)) {
                echo '<option value="' . $r['MaChucVu'] . '">' . $r['TenChucVu'] . '</option>';
            }
            ?>
                            </select>
                        </div>

                        <!-- Khoa/Phòng Ban -->
                        <div class="col-md-6">
                            <label for="department" class="form-label">Khoa/Phòng Ban</label>
                            <select id="department" class="form-control" name="khoa/phongban">
                                <option selected disabled>Chọn khoa/phòng ban</option>
                                <option value="Ban Kế Toán">Ban Kế Toán</option>
                                <option value="Phòng Kỹ Thuật">Phòng Kỹ Thuật</option>
                                <option value="Phòng Nhân Sự">Phòng Nhân Sự</option>
                                <option value="Phòng Tài Chính">Phòng Tài Chính</option>
                                <option value="Phòng Đào Tạo">Phòng Đào Tạo</option>
                            </select>
                        </div>
                        <!-- hệ số lương -->
                        <div class="col-md-6">
                            <label for="position" class="form-label">Số giờ làm</label>
                            <input type="number" name="sogiolam" id="position" class="form-control" placeholder="0.0"
                                step="0.1" min="0">
                        </div>
                        <!-- hệ số lương -->
                        <div class="col-md-6">
                            <label for="position" class="form-label">Hệ số lương</label>
                            <input type="number" id="position" name="hesoluong" class="form-control" placeholder="0.0"
                                step="0.1" min="0">
                        </div>
                        <!-- phụ cấp chức vụ -->
                        <div class="col-md-6">
                            <label for="position" class="form-label">Phụ cấp chức vụ</label>
                            <input type="number" id="position" name="phucapchucvu" class="form-control"
                                placeholder="0.0" step="0.1" min="0">
                        </div>
                        <!-- Ngày Bắt Đầu Làm Việc -->
                        <div class="col-md-6">
                            <label for="startDate" class="form-label">Ngày Bắt Đầu Làm Việc</label>
                            <input type="date" id="startDate" name="startDate" class="form-control">
                        </div>
                        <!-- Ngày kết thúc -->
                        <div class="col-md-6">
                            <label for="startDate" class="form-label">Ngày kết thúc Làm Việc</label>
                            <input type="date" id="endDate" name="endDate" class="form-control">
                        </div>
                        <!-- Loại Hợp Đồng -->
                        <!-- <div class="col-md-6">
                        <label for="contractType" class="form-label">Vị Trí Công Tác</label>
                        <select id="contractType" class="form-select">
                            <option selected disabled>Ví dụ: Giảng viên, Trưởng phòng</option>
                            <option value="ChinhThuc">Chính Thức</option>
                            <option value="ThoiVu">Thời Vụ</option>
                            <option value="ThucTap">Thực Tập</option>
                        </select>
                    </div> -->
                        <!-- Học Hàm -->
                        <!-- <div class="col-md-6">
                        <label for="academicTitle" class="form-label">Học Hàm</label>
                        <select id="academicTitle" class="form-select">
                            <option selected disabled>Chọn học hàm</option>
                            <option value="PGS">Phó Giáo Sư</option>
                            <option value="GS">Giáo Sư</option>
                        </select>
                    </div> -->
                        <!-- Học Vị -->
                        <!-- <div class="col-md-6">
                        <label for="degree" class="form-label">Học Vị</label>
                        <select id="degree" class="form-select">
                            <option selected disabled>Chọn học vị</option>
                            <option value="ThacSi">Thạc Sĩ</option>
                            <option value="TienSi">Tiến Sĩ</option>
                        </select>
                    </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cập Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Sửa Chức Vụ -->
    <div id="myModalEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Sửa Thông Tin</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="edit.php" method="post" id="updateForm">
                        <input type="hidden" name="MaCongViec" id="ma"> <!-- Hidden field for MaCongViec -->
                        <!-- Hidden field lưu MaChucVu (giữ giá trị chức vụ cũ) -->
                        <input type="flex" id="MaChucVuCu" name="MaChucVuCu" value="">
                        <input type="flex" id="MaNhanSu" name="MaNhanSu" value="">
                        <div class="form-group">
                            <label for="HoTen">Họ Và Tên</label>
                            <input type="text" class="form-control" name="HoTen" id="HoTen" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="TenChucVu">Tên Chức Vụ</label>
                            <input type="text" class="form-control" name="TenChucVu" id="tenchucvu" required>
                        </div> -->
                        <!-- <input type="hidden" id="MaChucVu" name="MaChucVu" value=""> -->
                        <div class="form-group">
                            <label for="TenChucVu">Tên Chức Vụ</label>
                            <select id="tenchucvu" name="MaChucVuMoi" class="form-control">
                                <?php 
            while($r = mysqli_fetch_assoc($result_chucvu)) {
                echo '<option value="' . $r['MaChucVu'] . '">' . $r['TenChucVu'] . '</option>';
            }
            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="PhuCapChucVu">Phụ Cấp</label>
                            <input type="number" class="form-control" name="PhuCapChucVu" id="PhuCapChucVu" rows="3"
                                step="0.1" min="0" required></input>
                        </div>
                        <div class="form-group">
                            <label for="HeSoLuong">Hệ Số Lương </label>
                            <input type="number" class="form-control" name="HeSoLuong" id="HeSoLuong" rows="3"
                                step="0.1" min="0" required></input>
                        </div>
                        <div class="form-group">
                            <label for="KhoaPhongBan">Khoa/Phòng Ban </label>
                            <input type="text" class="form-control" name="KhoaPhongBan" id="KhoaPhongBan" rows="3"
                                required></input>
                        </div>
                        <div class="form-group">
                            <label for="NgayBatDau">Ngày Bắt Đầu </label>
                            <input type="text" class="form-control" name="NgayBatDau" id="NgayBatDau" rows="3"
                                required></input>
                        </div>
                        <div class="form-group">
                            <label for="NgayKetThuc">Ngày Kết Thúc </label>
                            <input type="text" class="form-control" name="NgayKetThuc" id="NgayKetThuc" rows="3"
                                required></input>
                        </div>
                        <button type="submit" class="btn btn-success">Cập Nhật</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap 4 JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/Admin_Script.js?v = <?php echo time(); ?>"></script>
    <script>
    $(document).on('click', '.btn-edit', function() {
        // Lấy dữ liệu từ nút "Sửa"
        var macongviec = $(this).data('mcv'); // Mã công việc
        var machucvu = $(this).data('machucvu'); // Mã chức vụ cũ
        var ten = $(this).data('ten'); // Họ và tên
        var tenchucvu = $(this).data('tcv'); // Tên chức vụ
        var phucap = $(this).data('phucap'); // Phụ cấp
        var hesoluong = $(this).data('hesoluong'); // Hệ số lương
        var khoaphongban = $(this).data('khoaphongban'); // Khoa/Phòng ban
        var ngaybatdau = $(this).data('ngaybatdau'); // Ngày bắt đầu
        var ngayketthuc = $(this).data('ngayketthuc'); // Ngày kết thúc
        var manhansu = $(this).data('manhansu'); //ma 

        // Gán dữ liệu vào các input của form
        $('#ma').val(macongviec);
        $('#MaChucVuCu').val(machucvu); // Gán mã chức vụ cũ vào hidden field
        $('#HoTen').val(ten);
        $('#PhuCapChucVu').val(phucap);
        $('#HeSoLuong').val(hesoluong);
        $('#KhoaPhongBan').val(khoaphongban);
        $('#NgayBatDau').val(ngaybatdau);
        $('#NgayKetThuc').val(ngayketthuc);
        $('#MaNhanSu').val(manhansu);
        $('#MaChucVuMoi').val(machucvu); // Dựa vào value, không phải text
        // Gán giá trị cho dropdown chức vụ
        $('#tenchucvu option').each(function() {
            if ($(this).text() === tenchucvu) {
                $(this).prop('selected', true);
            }
        });
    });
    </script>
    <!-- Bootstrap 4 JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>