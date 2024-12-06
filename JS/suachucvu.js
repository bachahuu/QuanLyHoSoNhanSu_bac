$(document).on("click", ".btn-edit", function () {
  var maChucVu = $(this).data("mcv");
  var tenChucVu = $(this).data("ten");
  var moTa = $(this).data("mota");
  var quyDinh = $(this).data("quydinh");

  // Gán dữ liệu vào các trường trong modal
  $("#MaChucVu").val(maChucVu); // Gán MaChucVu vào input hidden
  $("#TenChucVu").val(tenChucVu); // Gán tên chức vụ vào trường
  $("#MoTa").val(moTa); // Gán mô tả vào trường
  $("#QuyDinhChucVu").val(quyDinh); // Gán quy định vào trường
});
