<?php
include 'inc/header.php';
include 'inc/menu.php';
include './config/config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if (isset($_POST['sua'])) {
    $catName = $_POST["catName"];

    if ($catName == "") {
        echo "Vui lòng nhập vào tên danh mục! <br/>";
    }

    if ($catName != "") {
        $sql = "UPDATE tbl_category SET catName = '$catName' WHERE catID = $id";
        $qr = mysqli_query($conn, $sql);
        echo "<script>window.location.href = 'category.php';</script>";
        exit();
    }
}

$sql = "SELECT * FROM tbl_category WHERE catID = $id";
$qr = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($qr);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h2>Xác nhận sửa danh mục</h2>
    </div>
    <div class="container shadow p-5">
        <div class="row pb-2">
            <h2>Sửa danh mục</h2>
        </div>
        <form method="post">
            <div asp-validation-summary="All"></div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Tên thể loại:</label>
                    <input type="text" name="catName" class="form-control mb-3" value="<?php echo $row['catName']; ?>">
                    <span class="alert-danger"></span>
                </div>
            </div>
            <button type="submit" name="sua" class="btn btn-lg btn-primary p-2"><i class="bi bi-file-plus-fill"></i>Lưu</button>
            <a href="category.php" class="btn btn-lg btn-warning p-2">Quay lại</a>
        </form>
</main>
<?php
include 'inc/footer.php';
?>