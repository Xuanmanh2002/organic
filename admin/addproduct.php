<?php
include 'inc/header.php';
include 'inc/menu.php';
include './config/config.php';

if (isset($_POST['them'])) {
    $proName = $_POST["productName"];
    $catID = $_POST["catID"];
    $price = $_POST["price"];
    $content = $_POST["description"];
    $type = $_POST["type"];

    $errors = [];

    if ($proName == "") {
        $errors[] = "Vui lòng nhập vào tên sản phẩm!";
    }
    if ($price == "") {
        $errors[] = "Vui lòng nhập giá tiền!";
    }
    if ($content == "") {
        $errors[] = "Vui lòng nhập nội dung!";
    }
    if ($type == "") {
        $errors[] = "Vui lòng chọn kiểu sản phẩm!";
    }

    if (isset($_FILES['productImages'])) {
        $file_name = $_FILES['productImages']['name'];
        $file_tmp = $_FILES['productImages']['tmp_name'];
        $file_path = "uploads/product/" . $file_name;

        // tải lên tệp vào thư mục tải lên
        move_uploaded_file($file_tmp, $file_path);

        if ($proName != "" && $file_path != "" && $catID != "" && $price != "" && $content != "" && $type != "") {
            $sql = "INSERT INTO tbl_product(productName, productImages, catID, type, price, description) VALUES('$proName', '$file_path', '$catID', '$type', '$price', '$content')";
        } else {
            $sql = "INSERT INTO tbl_product(productName, catID, type, price, description) VALUES('$proName', '$catID', '$type', '$price', '$content')";
        }
        $qr = mysqli_query($conn, $sql);
        if ($qr) {
            echo "<script>window.location.href = 'product.php';</script>";
            exit();
        } else {
            $errors[] = "Có lỗi khi thêm sản phẩm. Vui lòng thử lại!";
        }
    } else {
        $errors[] = "Vui lòng chọn hình ảnh sản phẩm!";
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h2>Xác nhận thêm sản phẩm</h2>
    </div>
    <div class="container shadow p-5">
        <div class="row pb-2">
            <h2>Thêm mới sản phẩm</h2>
        </div>
        <form method="post" enctype="multipart/form-data">
            <?php
            if (!empty($errors)) {
                echo '<div class="alert alert-danger" role="alert">';
                foreach ($errors as $error) {
                    echo $error . "<br/>";
                }
                echo '</div>';
            }
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Tên sản phẩm:</label>
                    <input type="text" name="productName" class="form-control mb-3">
                </div>
                <div class="form-group col-md-6">
                    <label>Hình ảnh:</label>
                    <input type="file" name="productImages" class="form-control mb-3" onchange="previewImage(event)">
                    <img id="preview" src="" alt="Hình ảnh sản phẩm" style="display: none; width: 200px;">
                </div>

                <div class="form-group col-md-6">
                    <label>Thể loại:</label>
                    <select class="form-control mb-3" name="catID">
                        <option value="">-- Lựa chọn thể loại --</option>
                        <?php
                        if (isset($_GET["id"])) {
                            $id = $_GET["id"];
                        }

                        $sql = "SELECT * FROM tbl_category";
                        $qr = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($qr)) {
                            $categoryID = $row['catID'];
                            $categoryName = $row['catName'];
                            echo "<option value='$categoryID'>$categoryName</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Giá:</label>
                    <input type="text" name="price" class="form-control mb-3">
                </div>
                <div class="form-group col-md-6">
                    <label>Kiểu sản phẩm:</label>
                    <select class="form-control mb-3" name="type">
                        <option value="">-- Lựa chọn kiểu --</option>
                        <option value="Bình thường">Bình thường</option>
                        <option value="Nổi bật">Nổi bật</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Nội dung sản phẩm:</label>
                    <textarea name="description" class="form-control mb-3" id="your_summernote"></textarea>
                </div>
            </div>
            <button type="submit" name="them" class="btn btn-lg btn-primary p-2"><i class="bi bi-file-plus-fill"></i>Lưu</button>
            <a href="product.php" class="btn btn-lg btn-warning p-2">Quay lại</a>
        </form>
    </div>
</main>
<?php
include 'inc/footer.php';
?>
<script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "";
            preview.style.display = "none";
        }
    }
</script>
