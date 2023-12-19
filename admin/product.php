<?php
include 'inc/header.php';
include 'inc/menu.php';
include './config/config.php';
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h2>Danh sách sản phẩm</h2>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


        <p>
            <a type="button" class="btn btn-success" href="addproduct.php"><i class="bi bi-file-earmark-text me-1"></i>Thêm
                sản phẩm</a>
        </p>
    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body mt-4">
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th class="col-1 text-center">#</th>
                                    <th class="col-2 text-center">Tên thực phẩm</th>
                                    <th class="col-2 text-center">Hình ảnh</th>
                                    <th class="col-2 text-center">Giá</th>
                                    <th class="col-2 text-center">Kiểu sản phẩm</th>
                                    <th class="col-2 text-center">Nội dung sản phẩm</th>
                                    <th class="col-1 text-center">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM tbl_product ORDER BY productID DESC";
                                $qr = mysqli_query($conn, $sql);
                                if ($sql) {
                                    $i = 0;
                                    while ($row = mysqli_fetch_array($qr)) {
                                        $i++;
                                ?>

                                        <tr>
                                            <th class="text-center" scope="row">
                                                <?php echo $i; ?>
                                            </th>
                                            <td class="text-primary">
                                                <?php echo $row['productName']; ?>
                                            </td>
                                            <td class="text-center">
                                                <img src="<?php echo $row['productImages']; ?>" style="max-width: 40px" class="img-fluid" />
                                            </td>
                                            <td class="text-center">
                                                <span><?php echo $row['price']; ?></span>vnđ
                                            </td>
                                            <td class="text-center">
                                                <span><?php echo $row['type']; ?></span>
                                            </td>
                                            <td class="text-center">
                                                <?php echo substr($row['description'], 0, 50) . '...'; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="editproduct.php?id=<?php echo $row['productID']; ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
                                                <a onclick="return confirm(' Bạn có chắc chắn muốn xoá?')" href="deleteproduct.php?id=<?php echo $row['productID']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<!-- Modal -->
<div class="d-flex align-items-center justify-content-center">
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Bạn có chắc chắn muốn xóa danh mục <span id="catName"></span>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteButton">Xóa</button>
        </div>
      </div>
    </div>
  </div>
</div>
</body>

</main><!-- End #main -->
</body>
<?php
include 'inc/footer.php';
?>
<script>
  function confirmDelete(catID) {
    // Lấy đối tượng button Xóa trong modal
    var confirmDeleteButton = document.getElementById('confirmDeleteButton');

    // Gán giá trị thuộc tính data-catid của button Xóa để sử dụng trong xử lý xóa
    confirmDeleteButton.setAttribute('data-catid', catID);

    // Hiển thị modal xác nhận
    var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    modal.show();
  }

  // Xử lý sự kiện khi button Xóa được nhấn trong modal
  document.getElementById('confirmDeleteButton').addEventListener('click', function() {
    var catID = this.getAttribute('data-catid');
    // Chuyển hướng tới trang xóa danh mục và truyền catID thông qua URL
    window.location.href = 'deletecat.php?id=' + catID;
  });
</script>