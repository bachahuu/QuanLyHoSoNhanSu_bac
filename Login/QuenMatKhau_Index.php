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
            <form action="QuenMatKhau.php" method="post">
                <h1>Quên mật khẩu</h1>
                <p style="margin-top:2px">Vui lòng nhập tên đăng nhập và email</p>
                <p style="margin:-18px 0 10px 10px;">để lấy lại mật khẩu của bạn</p>
                <input type="text" name="tendangnhap" placeholder="Tên đăng nhập" required>
                <input type="email" placeholder="Email" name="Email" required>
                <button>Gửi yêu cầu</button>
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