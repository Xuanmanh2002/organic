<?php
include 'inc/header.php';
include 'inc/slider.php';
?>

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php
                $sql = "SELECT * FROM tbl_product ";
                $qr = mysqli_query($conn, $sql);
                if ($qr) {
                    $i = 0;
                    while ($row = mysqli_fetch_array($qr)) {
                        $i++;
                ?>
                        <div class="col-lg-3">
                            <div class="categories__item set-bg">
                                <img src="./admin/<?php echo $row['productImages']; ?>">
                                <?php
                                if (isset($row['catID'])) {
                                    $categoryID = $row['catID'];
                                    $sql_category = "SELECT * FROM tbl_category WHERE catID = $categoryID";
                                    $qr_category = mysqli_query($conn, $sql_category);
                                    if ($qr_category && mysqli_num_rows($qr_category) > 0) {
                                        $category = mysqli_fetch_assoc($qr_category);
                                ?>
                                        <h5><a href="shop-details.php?id=<?php echo $row['productID']; ?>"><?php echo $category['catName']; ?></a></h5>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->
<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">Tất cả</li>
                        <?php
                        $sql = "SELECT * FROM tbl_category WHERE catID != 71";
                        $qr = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($qr)) {
                        ?>
                            <li data-filter=".category-<?php echo $row['catID']; ?>"><?php echo $row['catName'] ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php
            $sql = "SELECT * FROM tbl_product WHERE type = 'Nổi bật'";
            $qr = mysqli_query($conn, $sql);
            if ($qr) {
                $i = 0;
                while ($row = mysqli_fetch_array($qr)) {
                    $i++;
            ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix category-<?php echo $row['catID']; ?>">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg">
                                <a href="shop-details.php?id=<?php echo $row['productID']; ?>"><img src="./admin/<?php echo $row['productImages']; ?>"></a>
                                <ul class="featured__item__pic__hover">
                                    <li><a href="addcart.php?productID=<?php echo $row['productID']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#"><?php echo $row['productName']; ?></a></h6>
                                <h5><span><?php echo $row['price']; ?></span>vnđ</h5>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- Featured Section End -->

<!-- Blog Section Begin -->
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>Tin tức</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $sql = "SELECT * FROM tbl_blog ORDER BY blogID DESC";
            $qr = mysqli_query($conn, $sql);
            if ($sql) {
                $i = 0;
                while ($row = mysqli_fetch_array($qr)) {
                    $i++;
            ?>
                    <div class="col-lg-4 col-md-4 col-sm-6">
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
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
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