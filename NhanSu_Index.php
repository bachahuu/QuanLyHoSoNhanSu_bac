<?php
session_start();
require_once 'Connect.php';// Kết nối database

$hoTenNhanSu = "";
if (isset($_SESSION['MaNguoiDung'])) {
    $maNguoiDung = $_SESSION['MaNguoiDung'];
    $sql = "SELECT NhanSu.HoTen 
            FROM NhanSu
            INNER JOIN NguoiDung ON NhanSu.MaNhanSu = NguoiDung.MaNhanSu
            WHERE NguoiDung.MaNguoiDung = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $maNguoiDung);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $hoTenNhanSu = $row['HoTen'];
    }
    $stmt->close();
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
    <link rel="stylesheet" href="./CSS/Admin_Style.css?v = <?php echo time(); ?>">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin</title>
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
                <li><a href="./ThongTinNhanSu/ThongTinCaNhan_Index.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Thông tin cá nhân</span>
                    </a></li>
                <li><a href="./Lichsucongtac/lichsucongtac_user.php">
                        <i class="uil uil-table"></i>
                        <span class="link-name">Lịch sử công tác</span>
                    </a></li>
                <li><a href="./Nghiphep/Nghiphep_User_Index.php">
                        <i class="uil uil-book-reader"></i>
                        <span class="link-name">Nghỉ phép</span>
                    </a></li>
                <li><a href="./Luong/view_user.php">
                        <i class="uil uil-file-info-alt"></i>
                        <span class="link-name">Lương</span>
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

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Tìm kiếm...">
            </div>

            <div class="top">
                <i class="uil uil-bars sidebar-toggle"></i>

                <div class="search-box">
                    <i class="uil uil-search"></i>
                    <input type="text" placeholder="Tìm kiếm...">
                </div>

                <span style="margin-right: -220px; font-size: 18px; font-weight: bold;">
                    <?php echo htmlspecialchars($hoTenNhanSu); ?>
                </span>
                <img src="./Img/profile.jpg" alt="Avatar" style="margin-right: 50px;">
            </div>


            <img src="./Img/AVT.jpg" alt="Avatar" style="margin-right: 50px;">
        </div>

        <div class="dash-content">

        </div>
    </section>

    <script src="./JS/Admin_Script.js?v = <?php echo time(); ?>"></script>
</body>

</html>