<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../CSS/DangNhap_Style.css?v = <?php echo time(); ?>">
    <title>Login</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container forgot-password">
            <form action="XuLyDatLaiMatKhau.php" method="post">
                <h1>Quên mật khẩu</h1>
                <p style="margin-bottom: 10px;">Vui lòng nhập mật khẩu mới</p>
                <input type="password" name="MatKhauMoi" placeholder="Mật khẩu mới" required>
                <input type="password" placeholder="Nhập lại mật khẩu" name="NhapLaiMatKhau" required>
                <button>Xác nhận</button>
                <p>
                    <a href="DangNhap_Index.php" id="back-to-login">Quay lại đăng nhập?</a>
                </p>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Chào mừng Bạn!</h1>
                    <p>
                       Đại học Công nghê Giao thông vận tải là một trong những cơ sở giáo dục hàng đầu tại khu vực này,
                       nổi bật với sự cam kết mang đến chất lượng giáo dục cao và môi trường
                       học tập thân thiện.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>