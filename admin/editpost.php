<?php
include 'inc/header.php';
include 'inc/menu.php';
include './config/config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

if (isset($_POST['sua'])) {
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
            $sql = "UPDATE tbl_blog SET title = '$title',catID = '$catID', blogImages ='$file_path', description = '$description', create_date = '$day_formatted',blogContent = '$content'";
            $qr = mysqli_query($conn, $sql);
            if ($qr) {
                echo "<script>window.location.href = 'post.php';</script>";
                exit();
            } else {
                $errors[] = "Có lỗi khi sửa bài viết. Vui lòng thử lại!";
            }
        } else {
            $errors[] = "Vui lòng chọn hình ảnh bài viết!";
        }
    }
}
$sql = "SELECT * FROM tbl_blog WHERE blogID = $id";
$qr = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($qr);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h2>Xác nhận sửa bài viết</h2>
    </div>
    <div class="container shadow p-5">
        <div class="row pb-2">
            <h2>Sửa bài viết <span><?php echo $row['title']; ?></span></h2>
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
            <div asp-validation-summary="All"></div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Tiêu đề:</label>
                    <input type="text" name="title" class="form-control mb-3" value="<?php echo $row['title']; ?>">
                    <span class="alert-danger"></span>
                </div>
                <div class="form-group col-md-6">
                    <label>Hình ảnh:</label>
                    <?php if ($row['blogImages'] != '') { ?>
                        <img id="previewImage" src="<?php echo $row['blogImages']; ?>" alt="Hình ảnh bài viết" style="width: 200px;">
                    <?php } else { ?>
                        <img id="previewImage" src="" alt="Hình ảnh bài viết" style="display: none; width: 200px;">
                    <?php } ?>
                    <input type="file" name="blogImages" class="form-control mb-3" onchange="previewFile()">
                    <span class="alert-danger"></span>
                </div>
                <div class="form-group col-md-6">
                    <label>Mô tả:</label>
                    <input type="text" name="description" class="form-control mb-3" value="<?php echo $row['description']; ?>">
                    <span class="alert-danger"></span>
                </div>
                <div class="form-group col-md-6">
                    <label>Thể loại:</label>
                    <select class="form-control mb-3" name="catID">
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
                    <label>Ngày đăng bài:</label>
                    <?php
                    $day_formatted = date('Y-m-d');
                    ?>
                    <input type="date" name="create_date" class="form-control mb-3" value="<?php echo $day_formatted; ?>">
                    <span class="alert-danger"></span>
                </div>
                <div class="form-group col-md-6">
                    <label>Nội dung bài viết:</label>
                    <textarea name="blogContent" class="form-control mb-3" id="your_summernote"><?php echo $row['blogContent']; ?></textarea>
                </div>
            </div>
            <button type="submit" name="sua" class="btn btn-lg btn-primary p-2"><i class="bi bi-file-plus-fill"></i>Lưu</button>
            <a href="post.php" class="btn btn-lg btn-warning p-2">Quay lại</a>
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