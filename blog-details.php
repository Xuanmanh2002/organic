<?php
include 'inc/header.php';
include 'inc/slider.php';
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sID = session_id();
}

?>

<!-- Blog Details Hero Begin -->
<section class="blog-details-hero set-bg" data-setbg="img/blog/details/details-hero.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog__details__hero__text">
                    <h2>Thông tin về bài viết</h2>
                    <ul>
                        <?php
                        $sql = "SELECT * FROM tbl_blog WHERE blogID = $id";
                        $qr = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($qr)) {
                        ?>
                            <li><?php echo date('d-m-Y', strtotime($row['create_date'])); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
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
                    <!-- <div class="blog__sidebar__item">
                        <h4>Tin tức gần đây</h4>
                        <div class="blog__sidebar__recent">
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="img/blog/sidebar/sr-1.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>09 Kinds Of Vegetables<br /> Protect The Liver</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="img/blog/sidebar/sr-2.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>Tips You To Balance<br /> Nutrition Meal Day</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="img/blog/sidebar/sr-3.jpg" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>4 Principles Help You Lose <br />Weight With Vegetables</h6>
                                    <span>MAR 05, 2019</span>
                                </div>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <?php
                $sql = "SELECT * FROM tbl_blog WHERE blogID = $id";
                $qr = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($qr)) {
                ?>
                    <div class="blog__details__text">
                        <img src="admin/<?php echo $row['blogImages']; ?>" alt="">
                        <p><?php echo $row['blogContent']; ?></p>
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <?php
                                        $categoryID = $row['catID'];
                                        $categorySql = "SELECT catName FROM tbl_category WHERE catID = $categoryID";
                                        $categoryQuery = mysqli_query($conn, $categorySql);
                                        $categoryRow = mysqli_fetch_array($categoryQuery);
                                        $categoryName = $categoryRow['catName'];
                                        ?>

                                        <li><span>Danh mục bài viết:</span><?php echo $categoryName; ?></li>

                                    </ul>
                                    <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

<!-- Related Blog Section Begin -->
<section class="related-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related-blog-title">
                    <h2>Những bài viết bạn có thể thích</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <?php
                $sql = "SELECT * FROM tbl_blog WHERE blogID = $id";
                $qr = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($qr)) {
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
                            <p><?php echo $row['description']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- Related Blog Section End -->

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