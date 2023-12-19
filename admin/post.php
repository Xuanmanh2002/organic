<?php
include 'inc/header.php';
include 'inc/menu.php';
include './config/config.php';
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h2>Danh sách bài viết</h2>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active">Bài viết</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <p>
        <a type="button" class="btn btn-success" href="addpost.php"><i class="bi bi-file-earmark-text me-1"></i>Thêm
            bài viết</a>
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
                                    <th class="col-1 text-center">Hình ảnh</th>
                                    <th class="col-1 text-center">Tiêu đề</th>
                                    <th class="col-1 text-center">Mô tả</th>
                                    <th class="col-1 text-center">Thời gian đăng</th>
                                    <th class="col-2 text-center">Nội dung</th>
                                    <th class="col-1 text-center">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM tbl_blog ORDER BY blogID DESC";
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
                                            <td class="text-center">
                                                <img src="<?php echo $row['blogImages']; ?>" style="max-width: 40px" class="img-fluid" />
                                            </td>
                                            <td class="text-primary">
                                                <span><?php echo substr($row['title'], 0, 50) . '...'; ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span><?php echo substr($row['description'], 0, 20) . '...'; ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span><?php echo date('d/m/Y', strtotime($row['create_date'])); ?></span>
                                            </td>
                                            <td class="text-center">
                                                <?php echo substr($row['blogContent'], 0, 50) . '...'; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="editpost.php?id=<?php echo $row['blogID']; ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
                                                <a onclick="return confirm(' Bạn có chắc chắn muốn xoá?')" href="deletepost.php?id=<?php echo $row['blogID']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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
</body>

</main><!-- End #main -->
</body>
<?php
include 'inc/footer.php';
?>