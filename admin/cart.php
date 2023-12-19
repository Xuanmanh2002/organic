<?php
include 'inc/header.php';
include 'inc/menu.php';
include './config/config.php';
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sID = session_id();
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Quản lý đơn hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý đơn hàng</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <?php
                            $sql = "SELECT * FROM tbl_cart ORDER BY billID DESC LIMIT 1";
                            $qr = mysqli_query($conn, $sql);
                            if ($sql) {
                                $i = 0;
                                while ($row = mysqli_fetch_array($qr)) {
                                    $i++;
                                    echo '<h4 class="float-end font-size-15">Hoá đơn #' . $i . '</h4>';
                                }
                            }
                            ?>
                        </div>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <?php
                                    $sql = "SELECT * FROM tbl_bill INNER JOIN tbl_customer ON tbl_bill.cusID = tbl_customer.cusID WHERE tbl_bill.billID = $id";
                                    $qr = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($qr)) {
                                    ?>
                                        <h5 class="font-size-16 mb-3">Hóa đơn cho:</h5>
                                        <h5 class="font-size-15 mb-2"><?php echo $row['firstName'] ?>
                                            Họ tên khách hàng <?php echo $row['lastName'] ?></h5>
                                        <p class="mb-1">Địa chỉ:<?php echo $row['address'] ?>,<?php echo $row['city'] ?></p>
                                        <p class="mb-1">Email: <a class="__cf_email__"><?php echo $row['email'] ?></a></p>
                                        <p>SĐT: 0<?php echo $row['sdt'] ?></p>
                                        <p>Ghi chú: <?php echo $row['note'] ?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <h5 class="font-size-15">Tóm tắt đơn hàng</h5>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">Stt.</th>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th class="text-end" style="width: 120px;">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $sql = "SELECT * FROM tbl_cart WHERE billID = $id";
                                            $qr = mysqli_query($conn, $sql);
                                            if ($sql) {
                                                $i = 0;
                                                $cartItems = '';
                                                while ($row = mysqli_fetch_array($qr)) {
                                                    $i++;
                                                    $cartItems .= '
            <tr>
                <td>' . $i . '</td>
                <td>
                    <div>
                        <h5 class="text-truncate font-size-14 mb-1">' . $row['productName'] . '</h5>
                    </div>
                </td>
                <td>' . $row['price'] . 'vnd</td>
                <td>' . $row['quantity'] . '</td>
                <td class="text-end">' . $row['total'] . '</td>
            </tr>';
                                                }
                                                echo $cartItems;
                                            }
                                            ?>
                                        </tr>


                                        <tr>
                                            <?php
                                            $sql = "SELECT * FROM tbl_bill WHERE billID = $id";
                                            $qr = mysqli_query($conn, $sql);
                                            if ($sql) {
                                                $i = 0;
                                                while ($row = mysqli_fetch_array($qr)) {
                                                    $i++;
                                            ?>
                                                    <th scope="row" colspan="4" class="border-0 text-end">Tổng cộng tất cả sản
                                                        phẩm</th>
                                                    <td class="border-0 text-end">
                                                        <h4 class="m-0 fw-semibold"><?php echo $row['total']; ?>VNĐ
                                                        </h4>
                                                    </td>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="deletecart.php?billID=<?php echo $row['billID']; ?>" class="btn btn-warning"><i class="bi bi-trash">Xoá</i></a>
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</main><!-- End #main -->
<?php
include 'inc/footer.php';
?>