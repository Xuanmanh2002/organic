<?php
include 'inc/header.php';
include 'inc/menu.php';
include './config/config.php';

if (isset($_POST['add'])) {
    $title = $_POST["title"];
    $description = $_POST['description'];
    $content = $_POST["blogContent"];
    $catID = $_POST["catID"];


    $errors = [];

    if ($title == "") {
        $errors[] = "Vui lòng nhập vào tiêu đề!";
    }
    if ($description == "") {
        $errors[] = "Vui lòng nhập miêu tả!";
    }
    if ($content == "") {
        $errors[] = "Vui lòng nhập nội dung!";
    }

    // Lấy ngày hiện tại
    $day_formatted = date('Y-m-d');

    if (isset($_FILES['blogImages'])) {
        $file_name = $_FILES['blogImages']['name'];
        $file_tmp = $_FILES['blogImages']['tmp_name'];
        $file_path = "uploads/post/" . $file_name;

        // Tải lên tệp vào thư mục tải lên
        move_uploaded_file($file_tmp, $file_path);


        if ($title != "" && $file_path != "" && $content != "" && $description != "" && $catID != "") {
            $sql = "INSERT INTO tbl_blog (title,catID,blogImages,description,create_date,blogContent) VALUES ('$title', '$catID', '$file_path', '$description', '$day_formatted', '$content')";
            $qr = mysqli_query($conn, $sql);
            if ($qr) {
                echo "<script>window.location.href = 'post.php';</script>";
                exit();
            } else {
                $errors[] = "Có lỗi khi thêm bài viết. Vui lòng thử lại!";
            }
        } else {
            $errors[] = "Vui lòng chọn hình ảnh bài viết!";
        }
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h2>Xác nhận thêm bài viết</h2>
    </div>
    <div class="container shadow p-5">
        <div class="row pb-2">
            <h2>Thêm mới bài viết</h2>
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
                    <label>Tiêu đề:</label>
                    <input type="text" name="title" class="form-control mb-3">
                    <span class="alert-danger"></span>
                </div>
                <div class="form-group col-md-6">
                    <label>Hình ảnh:</label>
                    <input type="file" name="blogImages" class="form-control mb-3" onchange="previewImage(event)">
                    <img id="preview" src="" alt="Hình ảnh bài viết" style="display: none; width: 200px;">
                </div>

                <div class="form-group col-md-6">
                    <label>Mô tả:</label>
                    <input type="text" name="description" class="form-control mb-3">
                    <span class="alert-danger"></span>
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
                    <label>Ngày đăng bài:</label>
                    <?php
                    $day_formatted = date('Y-m-d');
                    ?>
                    <input type="date" name="create_date" class="form-control mb-3" value="<?php echo $day_formatted; ?>">
                    <span class="alert-danger"></span>
                </div>
                <div class="form-group col-md-6">
                    <label>Nội dung bài viết:</label>
                    <textarea name="blogContent" class="form-control mb-3" id="your_summernote"></textarea>
                </div>
            </div>
            <button type="submit" name="add" class="btn btn-lg btn-primary p-2"><i class="bi bi-file-plus-fill"></i>Lưu</button>
            <a href="post.php" class="btn btn-lg btn-warning p-2">Quay lại</a>
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
