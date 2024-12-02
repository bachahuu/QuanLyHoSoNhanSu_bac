<?php
require_once '../Connect.php';

$search_term = '';
if (isset($_POST['search_term'])) {
    $search_term = mysqli_real_escape_string($conn, $_POST['search_term']);
}

$sql_search = "SELECT * FROM chucvu 
               WHERE TenChucVu LIKE '%$search_term%'" ;
$result_search = mysqli_query($conn, $sql_search);
$i = 1;
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
                <li><a href="../Thongtincongviec/ThongTinCongViec.php">
                        <i class="uil uil-book-reader"></i>
                        <span class="link-name">Quản lý công việc</span>
                    </a></li>
                <li><a href="#">
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
                <form action="chucvu.php" method="post">
                    <i class="uil uil-search"></i>
                    <input type="text" name="search_term" placeholder="Tìm kiếm chức vụ..." required>
                    <button class="uil uil-search" type="submit"></button>
                </form>
            </div>
            <img src="../Img/profile.jpg" alt="Avatar" style="margin-right: 50px;">
        </div>
        <div class="dash-content">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="w-100 text-center ">Danh Sách Chức Vụ</h1>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAdd"
                        style="margin-right: 20px;">Thêm</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>STT</th>
                                <th>Tên chức vụ</th>
                                <th>Mô tả </th>
                                <th>Quy định chức vụ</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody id="job-data">
                            <?php 
    if ($result_search && mysqli_num_rows($result_search) > 0) {
        while ($row = mysqli_fetch_assoc($result_search)) { ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?php echo $row['TenChucVu'] ?></td>
                                <td><?php echo $row['MoTa'] ?></td>
                                <td><?php echo $row['QuyDinhChucVu'] ?></td>
                                <td
                                    style="display: flex; justify-content: center; align-items: center; gap: 10px; height: 100%;">
                                    <form action="sua_chucvu.php" method="post">
                                        <button type="button" class="btn btn-primary btn-edit" data-toggle="modal"
                                            data-target="#myModalEdit" data-mcv="<?= $row['MaChucVu']; ?>"
                                            data-ten="<?= $row['TenChucVu']; ?>" data-mota="<?= $row['MoTa']; ?>"
                                            data-quydinh="<?= $row['QuyDinhChucVu']; ?>">
                                            Sửa
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-danger "
                                        onclick="if(confirm('Bạn có chắc muốn xóa chức này?')) { window.location.href = 'delete_chucvu.php?Sid=<?= $row['MaChucVu'] ?>'; }">
                                        Xóa
                                    </button>
                                </td>

                            </tr>
                            <?php }
    } else { ?>
                            <tr>
                                <td colspan="7" class="text-center">Không có Chức Vụ nào trong danh sách.</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Thêm Chức Vụ -->
    <div id="myModalAdd" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm Chức Vụ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="them_chucvu.php" method="post" id="insertForm">
                    <div class="modal-body">
                        <input type="hidden" name="MaChucVu" id="MaChucVu"> <!-- Hidden field for MaChucVu -->
                        <div class="form-group">
                            <label for="TenChucVu">Tên Chức Vụ</label>
                            <input type="text" class="form-control" name="TenChucVu" id="TenChucVu" required>
                        </div>
                        <div class="form-group">
                            <label for="MoTa">Mô Tả</label>
                            <textarea class="form-control" name="MoTa" id="MoTa" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="QuyDinhChucVu">Quy Định Chức Vụ</label>
                            <textarea class="form-control" name="QuyDinhChucVu" id="QuyDinhChucVu" rows="3"
                                required></textarea>
                        </div>
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
                    <h4 class="modal-title">Sửa Chức Vụ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="sua_chucvu.php" method="post" id="updateForm">
                        <input type="hidden" name="MaChucVu" id="ma"> <!-- Hidden field for MaChucVu -->
                        <div class="form-group">
                            <label for="TenChucVu">Tên Chức Vụ</label>
                            <input type="text" class="form-control" name="TenChucVu" id="tenchucvu" required>
                        </div>
                        <div class="form-group">
                            <label for="MoTa">Mô Tả</label>
                            <textarea class="form-control" name="MoTa" id="mota" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="QuyDinhChucVu">Quy Định Chức Vụ</label>
                            <textarea class="form-control" name="QuyDinhChucVu" id="quydinh" rows="3"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Cập Nhật</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/Admin_Script.js?v = <?php echo time(); ?>"></script>
    <script>
    $(document).on('click', '.btn-edit', function() {
        var maChucVu = $(this).data('mcv');
        var tenChucVu = $(this).data('ten');
        var moTa = $(this).data('mota');
        var quyDinh = $(this).data('quydinh');

        // Gán dữ liệu vào các trường trong modal sửa
        $('#ma').val(maChucVu); // Gán MaChucVu vào input hidden
        $('#tenchucvu').val(tenChucVu); // Gán tên chức vụ vào trường
        $('#mota').val(moTa); // Gán mô tả vào trường
        $('#quydinh').val(quyDinh); // Gán quy định vào trường
    });
    </script>
    <!-- Bootstrap 4 JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>