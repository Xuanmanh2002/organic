<?php
include 'inc/header.php';
include 'inc/menu.php';
include './config/config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if (isset($_POST['sua'])) {
    $status = $_POST["status"];

    if ($status == "") {
        echo "Vui lòng nhập trạng thái! <br/>";
    }

    if ($status != "") {
        $sql = "UPDATE tbl_bill SET status = '$status' WHERE billID = $id";
        $qr = mysqli_query($conn, $sql);
        echo "<script>window.location.href = 'cartmanager.php';</script>";
        exit();
    }
}

$sql = "SELECT * FROM tbl_bill WHERE billID = $id";
$qr = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($qr);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h2>Xác nhận sửa trạng thái thanh toán</h2>
    </div>
    <div class="container shadow p-5">
        <div class="row pb-2">
            <h2>Sửa trạng thái thanh toán</h2>
        </div>
        <form method="post">
            <div asp-validation-summary="All"></div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Trạng thái thanh toán:</label>
                    <select name="status" class="form-control mb-3">
                        <option value="Chờ xử lý" <?php if ($row['status'] == 'Chờ xử lý') echo 'selected="selected"'; ?>>Chờ xử lý</option>
                        <option value="Đã thanh toán" <?php if ($row['status'] == 'Đã thanh toán') echo 'selected="selected"'; ?>>Đã thanh toán</option>
                        <option value="Đã giao hàng" <?php if ($row['status'] == 'Đã giao hàng') echo 'selected="selected"'; ?>>Đã giao hàng</option>
                    </select>
                    <span class="alert-danger"></span>
                </div>

            </div>
            <button type="submit" name="sua" class="btn btn-lg btn-primary p-2"><i class="bi bi-file-plus-fill"></i>Lưu</button>
            <a href="cartmanager.php" class="btn btn-lg btn-warning p-2">Quay lại</a>
        </form>
</main>
<?php
include 'inc/footer.php';
?>