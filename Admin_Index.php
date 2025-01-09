<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="./CSS/Admin_Style.css?v = <?php echo time(); ?>">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin</title>
    <style>
    /* Container bao quanh */
    .styled-container {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f9f9f9;
        /* Màu nền nhẹ */
        border: 4px solid #007bff;
        /* Viền màu xanh dương */
        border-radius: 20px;
        /* Bo góc cho viền */
        padding: 30px;
        /* Khoảng cách giữa viền và nội dung */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        /* Đổ bóng nhẹ */
        margin: 30px auto;
        /* Căn giữa và thêm khoảng cách */
        width: 80%;
        /* Chiều rộng bao phủ nội dung */
    }

    /* Chữ Xin Chào */
    .styled-greeting {
        font-family: 'Arial', sans-serif;
        /* Phông chữ đơn giản */
        font-size: 3rem;
        /* Kích thước chữ lớn */
        font-weight: bold;
        /* Chữ đậm */
        color: #007bff;
        /* Màu chữ xanh dương */
        text-transform: uppercase;
        /* Viết hoa toàn bộ */
        margin: 0;
        /* Xóa khoảng cách mặc định */
        text-align: center;
        /* Căn giữa chữ */
    }
    </style>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="./Img/vlogo.png" alt="" style="width: 190px; padding-left:23px;">
            </div>

            <!-- <span class="logo_name" style="color: orange;">UTT SCHOOL</span> -->
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="./TaiKhoan/TaiKhoan_Index.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Quản lý tài khoản</span>
                    </a></li>
                <li><a href="./NhanSu/NhanSu_Index.php">
                        <i class="uil uil-table"></i>
                        <span class="link-name">Quản lý nhân sự</span>
                    </a></li>
                <li><a href="./Thongtincongviec/ThongTinCongViec.php">
                        <i class="uil uil-book-reader"></i>
                        <span class="link-name">Quản lý công việc</span>
                    </a></li>
                <li><a href="./quanlychucvu/ChucVu.php">
                        <i class="uil uil-briefcase-alt"></i>
                        <span class="link-name">Quản lý Chức Vụ</span>
                    </a></li>
                <li><a href="./Nghiphep/Nghiphep_Admin_Index.php">
                        <i class="uil uil-file-info-alt"></i>
                        <span class="link-name">Quản lý nghỉ phép</span>
                    </a></li>
                <li><a href="./Luong/Luong_Index.php">
                        <i class="uil uil-subject"></i>
                        <span class="link-name">Quản lý lương</span>
                    </a></li>
                <li><a href="./Lichsucongtac/lichsucongtac_Index.php">
                        <i class="uil uil-book-open"></i>
                        <span class="link-name">Lịch sử công tác</span>
                    </a></li>
                <li><a href="./report/BaoCaoThongKe_Index.php">
                        <i class="uil uil-analytics"></i>
                        <span class="link-name">Báo cáo và thống kê</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="./Login/DangXuat.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Đăng xuất</span>
                    </a></li>


            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <img src="./Img/IMG_0190.JPG" alt="Avatar" style="margin-right: 50px;">


        </div>

        <div class="dash-content">
            <div class="styled-container">
                <h1 class="styled-greeting">XIN CHÀO!</h1>
            </div>
        </div>
    </section>

    <script src="./JS/Admin_Script.js?v = <?php echo time(); ?>"></script>
</body>

</html>