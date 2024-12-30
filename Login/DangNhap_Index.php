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
        <div class="form-container sign-in">
            <form action="DangNhap.php" method="post">
                <h1 style="margin-bottom: 30px;">Đăng nhập</h1>
                <input type="text" placeholder="Mã người dùng" name="TenDangNhap" required>
                <input type="password" placeholder="Mật khẩu" name="MatKhau" required>
                <p style="margin-bottom: 0px; margin-top: -2px; margin-left: 180px">
                    <a href="QuenMatKhau_Index.php" class="forgot-password-link">Quên mật khẩu?</a>
                </p>
                <button>Đăng nhập</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Chào mừng Bạn!</h1>
                    <p>
                        Cao đẳng Đại Việt là một trong những cơ sở giáo dục hàng đầu tại khu vực này,
                        nổi bật với sự cam kết mang đến chất lượng giáo dục cao và môi trường
                        học tập thân thiện.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>