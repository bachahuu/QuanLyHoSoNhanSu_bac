<?php
session_start(); // Bắt đầu phiên làm việc session

require_once '../Connect.php'; // Đảm bảo đường dẫn chính xác đến file Connect.php

// Khởi tạo giá trị mặc định cho biến
$tenNhanSu = ""; 

// Kiểm tra nếu tên đăng nhập đã được lưu trong session
if (isset($_SESSION['TenDangNhap'])) {
    $tenDangNhap = $_SESSION['TenDangNhap']; // Lấy tên đăng nhập từ session

    // Truy vấn để lấy MaNhanSu từ tên đăng nhập
    $sqlGetMaNhanSu = "SELECT MaNhanSu FROM NguoiDung WHERE TenDangNhap = ?";
    $stmt = $conn->prepare($sqlGetMaNhanSu);
    $stmt->bind_param("s", $tenDangNhap);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra nếu tên đăng nhập hợp lệ và lấy MaNhanSu
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $maNhanSu = $row['MaNhanSu']; // Lấy MaNhanSu từ kết quả truy vấn
    } else {
        echo "Tên đăng nhập không hợp lệ.";
        exit;
    }

    // Truy vấn để lấy lịch sử công tác của nhân sự
    $sqlnghiphep = "SELECT * FROM nghiphep WHERE MaNhanSu = ?";
    $stmt = $conn->prepare($sqlnghiphep);
    $stmt->bind_param("i", $maNhanSu);
    $stmt->execute();
    $resultnghi = $stmt->get_result();

    // Truy vấn để lấy thông tin tên nhân sự
    $sqlGetNhanSu = "SELECT HoTen FROM NhanSu WHERE MaNhanSu = ?";
    $stmt = $conn->prepare($sqlGetNhanSu);
    $stmt->bind_param("i", $maNhanSu);
    $stmt->execute();
    $resultNhanSu = $stmt->get_result();

    if ($resultNhanSu->num_rows > 0) {
        $rowNhanSu = $resultNhanSu->fetch_assoc();
        $tenNhanSu = $rowNhanSu['HoTen'];
    }
} else {
    echo "Bạn chưa đăng nhập!";
    exit;
}
?>


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
                <li><a href="#">
                        <i class="uil uil-book-reader"></i>
                        <span class="link-name">Nghỉ phép</span>
                    </a></li>
                <li><a href="../Luong/view_user.php">
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

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Tìm kiếm...">
            </div>

            <img src="./Img/profile.jpg" alt="Avatar" style="margin-right: 50px;">
        </div>

        <!-- Bảng danh sách đơn nghỉ phép -->
        <div class="container">
            <div class="dash-content">
                <div class="col-md-8">
                    <div class="col-sm-12">
                        <button class="btn btn-primary " style="margin-bottom: 10px" data-toggle="modal"
                            data-target="#addsql">Thêm</button>
                    </div>

                    <!-- Nếu có kết quả lịch sử công tác, hiển thị chúng -->
                    <?php if ($resultnghi->num_rows > 0): ?>
                    <div class="timeline">
                        <?php while ($row = $resultnghi->fetch_assoc()): ?>
                        <div class="timeline-item mb-4">
                            <div class="timeline-icon bg-info text-white">
                                <i class="uil uil-briefcase"></i>
                            </div>
                            <div class="timeline-content">
                                <h5 class="fw-bold"><?php echo htmlspecialchars($row['TrangThai']); ?></h5>
                                <small class="text-secondary">
                                    Ngày bắt đầu: <span
                                        class="fw-bold"><?php echo htmlspecialchars($row['NgayBatDau']); ?></span>
                                </small></p>
                                <small class="text-secondary">
                                    Ngày kết thúc : <span
                                        class="fw-bold"><?php echo htmlspecialchars($row['NgayKetThuc']); ?></span>
                                </small>
                                <p class="mb-1 text-muted"><?php echo htmlspecialchars($row['LyDo']); ?></p>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php else: ?>
                    <p>Không có lịch sử công tác nào được tìm thấy.</p>
                    <?php endif; ?>

                </div>

                <div class="modal fade" id="addsql" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family: Helvetica Neue">
                                    Thêm đơn nghỉ phép</h1>
                            </div>
                            <div class="modal-body">
                                <form action="Add_Nghiphep.php" method="POST">
                                    <input type="hidden" name="MaNhanSu" value="<?php echo $maNhanSu; ?>">
                                    <?php
                $maNhanSu = isset($_GET['MaNhanSu']) ? $_GET['MaNhanSu'] : '';

                require_once '../Connect.php';
                if (!empty($maNhanSu)) {
                    $sql = "SELECT nhansu.Hoten,
                                    nhansu.MaNhanSu,
                                    nghiphep.MaNhanSu 
                                    FROM nghiphep
                                    Join nhansu on nhansu.MaNhanSu=nghiphep.MaNhanSu 
                                    WHERE nghiphep.MaNhanSu = '$maNhanSu'";
                    $result = mysqli_query($conn, $sql);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $tenNhanSu = $row['Hoten'];
                    }
                }
                ?>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Tên nhân sự:</label>
                                        <input type="text" id="manhansu" class="form-control"
                                            value="<?php echo htmlspecialchars($tenNhanSu); ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Ngày bắt đầu:</label>
                                        <input type="date" id="NgayBatDau" class="form-control" name="NgayBatDau">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Ngày kết thúc:</label>
                                        <input type="date" id="NgayKetThuc" class="form-control" name="NgayKetThuc">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Lý do:</label>
                                        <input type="text" id="ChucVu" class="form-control" name="LyDo">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Thoát</button>
                                        <p></p>
                                        <button class="btn btn-success" type="submit">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src="../JS/Admin_Script.js?v = <?php echo time(); ?>"></script>

</body>

</html>