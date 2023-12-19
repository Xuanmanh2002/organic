<?php
include 'inc/header.php';
include 'inc/menu.php';
include './config/config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if (isset($_POST['sua'])) {
    $proName = $_POST["productName"];
    $catID = $_POST["catID"];
    $price = $_POST["price"];
    // $content = $_POST["description"];

    if ($proName == "") {
        echo "Vui lòng nhập vào tên sản phẩm! <br/>";
    }
    if ($price == "") {
        echo "Vui lòng nhập giá tiền! <br/>";
    }
    // if ($content == "") {
    //     echo "Vui lòng nhập nội dung! <br/>";
    // }

    if (isset($_FILES['productImages'])) {
        $file_name = $_FILES['productImages']['name'];
        $file_tmp = $_FILES['productImages']['tmp_name'];
        $file_path = "uploads/product/" . $file_name;

        // tải lên tệp vào thư mục tải lên
        move_uploaded_file($file_tmp, $file_path);

        // if ($proName != "" && $proImages != "" && $catID != "" && $price != "" && $content != "") {
        $sql = "UPDATE tbl_product SET productName = '$proName', productImages = '$file_path', price = '$price', description = '$content' WHERE productID = $id";
    } else {
        $description = $row['description'];
        if (isset($_POST["description"])) {
            $description = $_POST["description"];
        }
        $sql = "UPDATE tbl_product SET productName = '$proName', price = '$price', description = '$description' WHERE productID = $id";
    }
    $qr = mysqli_query($conn, $sql);
    echo "<script>window.location.href = 'product.php';</script>";
    exit();
}

$sql = "SELECT * FROM tbl_product WHERE productID = $id";
$qr = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($qr);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h2>Xác nhận sửa sản phẩm</h2>
    </div>
    <div class="container shadow p-5">
        <div class="row pb-2">
            <h2>Sửa sản phẩm <span><?php echo $row['productName']; ?></span></h2>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div asp-validation-summary="All"></div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Tên sản phẩm:</label>
                    <input type="text" name="productName" class="form-control mb-3" value="<?php echo $row['productName']; ?>">
                    <span class="alert-danger"></span>
                </div>
                <div class="form-group col-md-6">
                    <label>Hình ảnh:</label>
                    <?php if ($row['productImages'] != '') { ?>
                        <img id="previewImage" src="<?php echo $row['productImages']; ?>" alt="Hình ảnh sản phẩm" style="width: 200px;">
                    <?php } else { ?>
                        <img id="previewImage" src="" alt="Hình ảnh sản phẩm" style="display: none; width: 200px;">
                    <?php } ?>
                    <input type="file" name="productImages" class="form-control mb-3" onchange="previewFile()">
                    <span class="alert-danger"></span>
                </div>
                <div class="form-group col-md-6">
                    <label>Thể loại:</label>
                    <select class="form-control" name="catID" value="<?php $row['catID'] ?>">
                        <option>-- Lựa chọn thể loại --</option>
                        <?php
                        $sql_categories = "SELECT * FROM tbl_category"; // Truy vấn danh sách các thể loại từ CSDL
                        $result_categories = mysqli_query($conn, $sql_categories);
                        while ($category = mysqli_fetch_array($result_categories)) {
                            $selected = ($category['catID'] == $row['catID']) ? 'selected' : ''; // Kiểm tra xem thể loại hiện tại có được chọn trước đó không
                            echo '<option value="' . $category['catID'] . '" ' . $selected . '>' . $category['catName'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Giá:</label>
                    <input type="text" name="price" class="form-control mb-3" value="<?php echo $row['price']; ?>">
                    <span class="alert-danger"></span>
                </div>
                <div class="form-group col-md-6">
                    <label>Kiểu sản phẩm:</label>
                    <select class="form-control mb-3" name="type">
                        <?php
                        $selectedType = $row['type'];
                        $otherType = ($selectedType == 'Bình thường') ? 'Nổi bật' : 'Bình thường';
                        ?>
                        <option value="<?php echo $selectedType; ?>" selected><?php echo $selectedType; ?></option>
                        <option value="<?php echo $otherType; ?>"><?php echo $otherType; ?></option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Nội dung:</label>
                    <textarea name="description" class="form-control mb-3" id="your_summernote"><?php echo $row['description']; ?></textarea>
                </div>
            </div>
            <button type="submit" name="sua" class="btn btn-lg btn-primary p-2"><i class="bi bi-file-plus-fill"></i>Lưu</button>
            <a href="product.php" class="btn btn-lg btn-warning p-2">Quay lại</a>
        </form>
</main>
<?php
include 'inc/footer.php';
?>
<script>
    function previewFile() {
        var preview = document.getElementById('previewImage');
        var file = document.querySelector('input[name=blogImages]').files[0];
        var reader = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
            preview.style.display = "block";
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>