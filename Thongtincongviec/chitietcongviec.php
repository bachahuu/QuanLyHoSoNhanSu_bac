<?php 
require_once '../Connect.php';
if(isset($_GET['macongviec'])){
    $macongviec = $_GET['macongviec'];
}else{
    echo 'khong tim thay ma tren ';
}
$sql_select = " SELECT nhansu.*, congviec.* , chucvu.* FROM congviec
JOIN nhansu ON nhansu.MaNhanSu = congviec.MaNhanSu
JOIN chucvu ON chucvu.MaChucVu = congviec.MaChucVu
WHERE congviec.MaCongViec = '$macongviec'";
$result_congviec = mysqli_query($conn,$sql_select);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Công Việc</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .card {
        margin: 10px auto;
        /* Tạo khoảng cách phía trên và dưới */
        padding: 20px;
        /* Thêm padding bên trong card */
    }
    </style>
</head>

<body>
    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="text-center">Chi Tiết Công Việc</h5>
            </div>
            <div class="card-body">
                <div class="row" style="justify-content: center;text-align:center;">
                    <div class="col-md-6">
                        <?php  
                        try{
                            if (mysqli_num_rows($result_congviec) > 0) {
                                $row = mysqli_fetch_assoc($result_congviec);
                            } else {
                                echo "Không tìm thấy nhân sự với mã định danh: $madinhdanh";
                            } 

                        }catch(Exception $e){
                            echo 'Error: ' . $e->getMessage();
                        }
                        ?>
                        <p><strong>Mã Định Danh:</strong> <?php echo $row['MaDinhDanh'] ?></p>
                        <p><strong>Họ Và Tên:</strong> <?php echo $row['HoTen'] ?></p>
                        <p><strong>Email:</strong> <?php echo $row['Email'] ?></p>
                        <p><strong>Chức Vụ:</strong> <?php echo $row['TenChucVu'] ?></p>
                        <p><strong>Khoa/Phòng Ban:</strong> <?php echo $row['KhoaPhongBan'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Số Giờ Làm Việc Theo Quy Định:</strong> <?php echo $row['SoGioLamViec'] ?> h</p>
                        <p><strong>Phụ Cấp Chức Vụ:</strong>
                            <?php echo number_format($row['PhuCapChucVu'], 0, ',', '.') ; ?> VND</p>
                        <p><strong>Ngày Bắt Đầu:</strong> <?php echo $row['NgayBatDau'] ?></p>
                        <p><strong>Ngày Kết Thúc:</strong> <?php echo $row['NgayKetThuc'] ?></p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button onclick="goBack()" class="btn btn-secondary">Quay Lại</button>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script>
    function goBack() {
        window.history.back(); // Quay lại trang trước đó
    }
    </script>

    <!-- Bootstrap 4 JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>