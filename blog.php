<?php
include './inc/header.php';
include './inc/slider.php';
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Tin tức</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.php">Trang chủ</a>
                        <span>Tin tức</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Danh mục bài viết</h4>
                        <ul>
                            <?php
                            $sql = "SELECT c.catName, COUNT(b.blogID) AS postCount FROM tbl_category c LEFT JOIN tbl_blog b ON c.catID = b.catID GROUP BY c.catID";
                            $qr = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($qr)) {
                            ?>
                                <li><a href="#"><?php echo $row['catName'] ?>(<?php echo $row['postCount']; ?>)</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <?php
                        $sql = "SELECT * FROM tbl_blog ORDER BY blogID DESC";
                        $qr = mysqli_query($conn, $sql);
                        if ($qr) {
                            $totalPosts = mysqli_num_rows($qr); // Tổng số bài viết
                            $postsPerPage = 6; // Số bài viết trên mỗi trang
                            $totalPages = ceil($totalPosts / $postsPerPage); // Tổng số trang
                            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
                            $offset = ($currentPage - 1) * $postsPerPage; // Vị trí bắt đầu lấy dữ liệu

                            $sql = "SELECT * FROM tbl_blog ORDER BY blogID DESC LIMIT $offset, $postsPerPage";
                            $qr = mysqli_query($conn, $sql);
                            $i = 0;
                            while ($row = mysqli_fetch_array($qr)) {
                                $i++;
                        ?>

                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="admin/<?php echo $row['blogImages']; ?>" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i><?php echo date('d-m-Y', strtotime($row['create_date'])); ?></li>
                                        </ul>
                                        <h5><a href="blog-details.php?id=<?php echo $row['blogID']; ?>"><?php echo $row['title']; ?></a></h5>
                                        <p><?php echo $row['description']; ?> </p>
                                        <a href="blog-details.php?id=<?php echo $row['blogID']; ?>" class="blog__btn">ĐỌC THÊM <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="col-lg-12">
                        <div class="product__pagination blog__pagination">
                            <?php
                            for ($page = 1; $page <= $totalPages; $page++) {
                                $activeClass = ($page == $currentPage) ? "active" : "";
                                echo "<a href='?page=$page' class='$activeClass'>$page</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</section>
<!-- Blog Section End -->

<?php
include 'inc/footer.php';
?>


<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>



</body>

</html>