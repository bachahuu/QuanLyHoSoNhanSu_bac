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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Admin</title>
    <style>
    * {
        font-family: "Ubuntu", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
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

        <div class="dash-content" style="margin-top: 20px;">
            <div class="container" style="text-align: center;">
                <h1 style="font-family: 'Times New Roman', Times, serif;"><b>Quản Lý Người Dùng</b></h1>

                <div class="input-group mb-3" style="margin-top: 50px; width: 400px;">
                    <form action="TaiKhoan_Index.php" method="get" style="display: flex; width: 100%;">
                        <input type="search" class="form-control" placeholder="Tìm kiếm tài khoản" name="searchTerm">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" style="width: 100px;">Tìm Kiếm</button>
                        </div>
                    </form>
                </div>

                <br>
                <table class="table" style="margin: -15px 0 0 -10px; width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tên đăng nhập</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Phân quyền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once '../Connect.php';

                            $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';
                            if ($searchTerm) {
                                $list_sql = "SELECT * FROM NguoiDung 
                                            WHERE TenDangNhap LIKE '%$searchTerm%' 
                                            OR PhanQuyen LIKE '%$searchTerm%'
                                            ORDER BY PhanQuyen, TenDangNhap";
                            } else {
                                $list_sql = "SELECT * FROM NguoiDung
                                            JOIN NhanSu ON NguoiDung.MaNhanSu = NhanSu.MaNhanSu 
                                            ORDER BY PhanQuyen, TenDangNhap";
                            }

                            $result = mysqli_query($conn, $list_sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["TenDangNhap"]); ?></td>
                            <td><?php echo htmlspecialchars($row["HoTen"]); ?></td>
                            <td><?php echo htmlspecialchars($row["Email"]); ?></td>
                            <td><?php echo htmlspecialchars($row["PhanQuyen"]); ?></td>
                            <td><?php echo htmlspecialchars($row["TrangThaiTaiKhoan"]); ?></td>
                            <td>
                                <button type="button" class="btn btn-info btn-detail"
                                    data-MaNguoiDung="<?php echo $row["MaNguoiDung"]; ?>"
                                    data-TenDangNhap="<?php echo htmlspecialchars($row["TenDangNhap"]); ?>"
                                    data-HoTen="<?php echo htmlspecialchars($row["HoTen"]); ?>"
                                    data-Email="<?php echo htmlspecialchars($row["Email"]); ?>"
                                    data-SoDienThoai="<?php echo htmlspecialchars($row["SoDienThoai"]); ?>"
                                    data-DiaChi="<?php echo htmlspecialchars($row["DiaChi"]); ?>"
                                    data-PhanQuyen="<?php echo htmlspecialchars($row["PhanQuyen"]); ?>"
                                    data-TrangThai="<?php echo htmlspecialchars($row["TrangThaiTaiKhoan"]); ?>"
                                    data-MaDinhDanh="<?php echo htmlspecialchars($row["MaDinhDanh"]); ?>"
                                    data-toggle="modal" data-target="#detailModal">
                                    Xem Chi Tiết
                                </button>
                                <button type="button" class="btn btn-success btn-update"
                                    data-MaNguoiDung="<?php echo $row["MaNguoiDung"]; ?>"
                                    data-TenDangNhap="<?php echo htmlspecialchars($row["TenDangNhap"]); ?>"
                                    data-HoTen="<?php echo htmlspecialchars($row["HoTen"]); ?>"
                                    data-Email="<?php echo htmlspecialchars($row["Email"]); ?>"
                                    data-SoDienThoai="<?php echo htmlspecialchars($row["SoDienThoai"]); ?>"
                                    data-DiaChi="<?php echo htmlspecialchars($row["DiaChi"]); ?>"
                                    data-PhanQuyen="<?php echo htmlspecialchars($row["PhanQuyen"]); ?>"
                                    data-TrangThai="<?php echo htmlspecialchars($row["TrangThaiTaiKhoan"]); ?>"
                                    data-MaDinhDanh="<?php echo htmlspecialchars($row["MaDinhDanh"]); ?>"
                                    data-toggle="modal" data-target="#updateModal">
                                    Cập Nhật
                                </button>

                                <a onclick="return confirm('Bạn có muốn xóa tài khoản này không?')"
                                    href="TaiKhoan_Delete.php?MaNguoiDung=<?php echo $row["MaNguoiDung"]; ?>"
                                    class="btn btn-danger">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td colspan="9"><button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#myModal">Thêm</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal chi tiết -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Chi Tiết Tài Khoản</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><b>Tên đăng nhập:</b> <span id="detailTenDangNhap"></span></p>
                        <p><b>Họ tên:</b> <span id="detailHoTen"></span></p>
                        <p><b>Email:</b> <span id="detailEmail"></span></p>
                        <p><b>Số điện thoại:</b> <span id="detailSoDienThoai"></span></p>
                        <p><b>Địa chỉ:</b> <span id="detailDiaChi"></span></p>
                        <p><b>Phân quyền:</b> <span id="detailPhanQuyen"></span></p>
                        <p><b>Trạng thái:</b> <span id="detailTrangThai"></span></p>
                        <p><b>Mã định danh:</b> <span id="detailMaDinhDanh"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Xử lý sự kiện click vào nút "Xem Chi Tiết"
            const detailButtons = document.querySelectorAll(".btn-detail");
            detailButtons.forEach(button => {
                button.addEventListener("click", function() {
                    // Lấy dữ liệu từ thuộc tính data-*
                    const tenDangNhap = this.getAttribute("data-TenDangNhap");
                    const hoTen = this.getAttribute("data-HoTen");
                    const email = this.getAttribute("data-Email");
                    const soDienThoai = this.getAttribute("data-SoDienThoai");
                    const diaChi = this.getAttribute("data-DiaChi");
                    const PhanQuyen = this.getAttribute("data-PhanQuyen");
                    const trangThai = this.getAttribute("data-TrangThai");
                    const maDinhDanh = this.getAttribute("data-MaDinhDanh");

                    // Cập nhật thông tin vào modal
                    document.getElementById("detailTenDangNhap").textContent = tenDangNhap;
                    document.getElementById("detailHoTen").textContent = hoTen;
                    document.getElementById("detailEmail").textContent = email;
                    document.getElementById("detailSoDienThoai").textContent = soDienThoai;
                    document.getElementById("detailDiaChi").textContent = diaChi;
                    document.getElementById("detailPhanQuyen").textContent = PhanQuyen;
                    document.getElementById("detailTrangThai").textContent = trangThai;
                    document.getElementById("detailMaDinhDanh").textContent = maDinhDanh;
                });
            });
        });
        </script>




        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="font-family: 'Times New Roman', Times, serif;">Thêm tài khoản
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form action="TaiKhoan_Insert.php" method="post">
                            <div class="form-group">
                                <label for="TenDangNhap">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="TenDangNhap" name="TenDangNhap" required>
                            </div>
                            <div class="form-group">
                                <label for="MatKhau">Mật khẩu</label>
                                <input type="text" class="form-control" id="MatKhau" name="MatKhau" required>
                            </div>
                            <div class="form-group">
                                <label for="MaDinhDanh">Mã định danh</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="MaDinhDanh" name="MaDinhDanh" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" id="checkMaDinhDanh">Kiểm
                                            tra</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="HoVaTen">Họ và tên</label>
                                <input type="text" class="form-control" id="HoVaTen" name="HoVaTen" readonly>
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" id="Email" name="Email" readonly>
                            </div>
                            <div class="form-group">
                                <label for="SoDienThoai">Số điện thoại</label>
                                <input type="text" class="form-control" id="SoDienThoai" name="SoDienThoai" readonly>
                            </div>
                            <div class="form-group">
                                <label for="DiaChi">Địa chỉ</label>
                                <input type="text" class="form-control" id="DiaChi" name="DiaChi" readonly>
                            </div>
                            <div class="form-group">
                                <label for="PhanQuyen">Phân quyền</label>
                                <select class="form-control" id="PhanQuyen" name="PhanQuyen" required>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                    <option value="khac">Khác</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Thêm</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <script>
        // AJAX kiểm tra mã định danh
        document.getElementById("checkMaDinhDanh").addEventListener("click", function() {
            const maDinhDanh = document.getElementById("MaDinhDanh").value;

            if (!maDinhDanh.trim()) {
                alert("Vui lòng nhập mã định danh.");
                return;
            }

            fetch("check_ma_dinh_danh.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `MaDinhDanh=${encodeURIComponent(maDinhDanh)}`,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        document.getElementById("HoVaTen").value = data.data.HoTen || "";
                        document.getElementById("Email").value = data.data.Email || "";
                        document.getElementById("SoDienThoai").value = data.data.SoDienThoai || "";
                        document.getElementById("DiaChi").value = data.data.DiaChi || "";
                    } else {
                        alert(data.message);
                        document.getElementById("HoVaTen").value = "";
                        document.getElementById("Email").value = "";
                        document.getElementById("SoDienThoai").value = "";
                        document.getElementById("DiaChi").value = "";
                    }
                })
                .catch(error => {
                    console.error("Lỗi:", error);
                    alert("Có lỗi xảy ra khi kiểm tra mã định danh.");
                });
        });
        </script>


        <div class="modal" id="updateModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="font-family: 'Times New Roman', Times, serif;">Sửa Thông tin tài
                            khoản</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="TaiKhoan_Update.php" method="post">
                            <!-- Hidden field for ID -->
                            <input type="hidden" name="MaNguoiDung" id="update_MaNguoiDung">

                            <!-- Tên đăng nhập -->
                            <div class="form-group">
                                <label for="update_TenDangNhap">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="update_TenDangNhap" name="TenDangNhap"
                                    readonly>
                            </div>

                            <!-- Họ và tên -->
                            <div class="form-group">
                                <label for="update_HoTen">Họ và tên</label>
                                <input type="text" class="form-control" id="update_HoTen" name="HoTen" readonly>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="update_Email">Email</label>
                                <input type="email" class="form-control" id="update_Email" name="Email" readonly>
                            </div>

                            <!-- Số điện thoại -->
                            <div class="form-group">
                                <label for="update_SoDienThoai">Số điện thoại</label>
                                <input type="text" class="form-control" id="update_SoDienThoai" name="SoDienThoai"
                                    readonly>
                            </div>

                            <!-- Địa chỉ -->
                            <div class="form-group">
                                <label for="update_DiaChi">Địa chỉ</label>
                                <input type="text" class="form-control" id="update_DiaChi" name="DiaChi" required>
                            </div>

                            <div class="form-group">
                                <label for="update_MatKhau">Mật khẩu mới (để trống nếu không thay đổi)</label>
                                <input type="password" class="form-control" id="update_MatKhau" name="MatKhau">
                            </div>

                            <!-- Vai trò -->
                            <div class="form-group">
                                <label for="update_PhanQuyen">Phân quyền</label>
                                <select class="form-control" id="update_PhanQuyen" name="PhanQuyen" required>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                    <option value="khac">Khác</option>
                                </select>
                            </div>

                            <!-- Trạng thái -->
                            <div class="form-group">
                                <label for="update_TrangThai">Trạng thái</label>
                                <select class="form-control" id="update_TrangThai" name="TrangThai">
                                    <option value="Hoạt động">Hoạt động</option>
                                    <option value="Bị khóa">Bị khóa</option>
                                </select>
                            </div>

                            <!-- Buttons -->
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                style="margin-left: 275px;">Đóng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các nút "Cập Nhật"
            const updateButtons = document.querySelectorAll('.btn-update');

            updateButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Lấy giá trị từ các thuộc tính data-
                    const maNguoiDung = this.getAttribute('data-MaNguoiDung');
                    const tenDangNhap = this.getAttribute('data-TenDangNhap');
                    const hoTen = this.getAttribute('data-HoTen');
                    const email = this.getAttribute('data-Email');
                    const soDienThoai = this.getAttribute('data-SoDienThoai');
                    const diaChi = this.getAttribute('data-DiaChi');
                    const phanQuyen = this.getAttribute('data-PhanQuyen');
                    const trangThai = this.getAttribute('data-TrangThai');

                    // Điền giá trị vào các trường trong modal
                    document.getElementById('update_MaNguoiDung').value = maNguoiDung;
                    document.getElementById('update_TenDangNhap').value = tenDangNhap;
                    document.getElementById('update_HoTen').value = hoTen;
                    document.getElementById('update_Email').value = email;
                    document.getElementById('update_SoDienThoai').value = soDienThoai;
                    document.getElementById('update_DiaChi').value = diaChi;
                    document.getElementById('update_PhanQuyen').value = phanQuyen;
                    document.getElementById('update_TrangThai').value = trangThai;
                });
            });
        });
        </script>


        </div>
    </section>

    <script src="../JS/Admin_Script.js?v = <?php echo time(); ?>"></script>
</body>

</html>