<?php
include 'inc/header.php';
include 'inc/menu.php';
include './config/config.php';
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h2>Danh sách đơn hàng</h2>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active">Đơn hàng</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body mt-4">
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th class="col-1 text-center">#</th>
                                    <th class="col-2 text-center">Tên khách hàng</th>
                                    <th class="col-2 text-center">Địa chỉ</th>
                                    <th class="col-2 text-center">Phương thức thanh toán</th>
                                    <th class="col-2 text-center">Tổng tiền</th>
                                    <th class="col-2 text-center">Trạng thái thanh toán</th>
                                    <th class="col-1 text-center">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM tbl_bill INNER JOIN tbl_customer ON tbl_bill.cusID = tbl_customer.cusID ORDER BY tbl_customer.cusID DESC";
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
                                                <?php echo $row['lastName']; ?> <?php echo $row['firstName']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['address']; ?>,<?php echo $row['city']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                switch ($row['pttt']) {
                                                    case 3:
                                                        echo "Shipcod";
                                                        break;
                                                    case 2:
                                                        echo "Thanh toán thẻ";
                                                        break;
                                                    case 1:
                                                        echo "Tiền mặt";
                                                        break;
                                                    default:
                                                        echo "Không xác định";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <span><?php echo $row['total']; ?> </span>vnđ
                                            </td>
                                            <td class="text-center">
                                                <span><?php echo $row['status']; ?></span>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($row['status'] == 'Chờ xử lý'): ?>
                                                    <a href="cart.php?id=<?php echo $row['billID']; ?>" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                                    <a href="editcart.php?id=<?php echo $row['billID']; ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                    <a onclick="return confirm(' Bạn có chắc chắn muốn xoá?')" href="deletecart.php?billID=<?php echo $row['billID']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                                <?php elseif ($row['status'] == 'Đã thanh toán'): ?>
                                                    <a href="cart.php?id=<?php echo $row['billID']; ?>" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                                    <a href="editcart.php?id=<?php echo $row['billID']; ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                                                <?php elseif ($row['status'] == 'Đã giao hàng'): ?>
                                                    <a href="cart.php?id=<?php echo $row['billID']; ?>" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                                    <a onclick="return confirm(' Bạn có chắc chắn muốn xoá?')" href="deletecart.php?billID=<?php echo $row['billID']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                                <?php endif; ?>
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
    function confirmDelete(cartID) {
        // Lấy đối tượng button Xóa trong modal
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        // Gán giá trị thuộc tính data-catid của button Xóa để sử dụng trong xử lý xóa
        confirmDeleteButton.setAttribute('data-catid', cartID);

        // Hiển thị modal xác nhận
        var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();
    }

    // Xử lý sự kiện khi button Xóa được nhấn trong modal
    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        var catID = this.getAttribute('data-catid');
        // Chuyển hướng tới trang xóa danh mục và truyền catID thông qua URL
        window.location.href = 'deletecart.php?id=' + cartID;
    });
</script>
