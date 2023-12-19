<?php
include 'inc/header.php';
include 'inc/slider.php';
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Organi Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.php">Trang chủ</a>
                        <span>Hoa quả</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Mới nhất</h4>
                            <div class="latest-product__slider owl-carousel">
                                <?php
                                $sql = "SELECT * FROM tbl_product WHERE type = 'Nổi bật'";
                                $qr = mysqli_query($conn, $sql);
                                if ($qr) {
                                    $productCount = mysqli_num_rows($qr);
                                    $productPerSlide = 3; // Số sản phẩm trên mỗi slide
                                    $slideCount = ceil($productCount / $productPerSlide); // Tổng số slide

                                    $currentSlide = 0;
                                    while ($row = mysqli_fetch_array($qr)) {
                                        if ($currentSlide % $productPerSlide === 0) {
                                            echo '<div class="latest-prdouct__slider__item">';
                                        }
                                ?>
                                        <a href="shop-details.php?id=<?php echo $row['productID']; ?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="./admin/<?php echo $row['productImages']; ?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?php echo $row['productName']; ?></h6>
                                                <span><?php echo $row['price']; ?>vnđ</span>
                                            </div>
                                        </a>
                                <?php
                                        $currentSlide++;
                                        if ($currentSlide % $productPerSlide === 0 || $currentSlide === $productCount) {
                                            echo '</div>'; // Kết thúc slide
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="row">
                    <?php
                    $results_per_page = 9; // Số lượng sản phẩm hiển thị trên mỗi trang
                    $sql = "SELECT COUNT(*) AS total FROM tbl_product WHERE catID = 58";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $total_products = $row['total'];
                    $total_pages = ceil($total_products / $results_per_page); // Tính tổng số trang
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại, nếu không được thiết lập, mặc định là trang 1

                    $start_index = ($current_page - 1) * $results_per_page; // Vị trí bắt đầu của sản phẩm trong CSDL

                    $sql = "SELECT * FROM tbl_product WHERE catID = 58 ORDER BY productID DESC LIMIT $start_index, $results_per_page";
                    $qr = mysqli_query($conn, $sql);
                    if ($qr) {
                        $i = 0;
                        while ($row = mysqli_fetch_array($qr)) {
                            $i++;
                    ?>

                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg">
                                        <a href="shop-details.php?id=<?php echo $row['productID']; ?>"><img src="./admin/<?php echo $row['productImages']; ?>"></a>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="addcart.php?productID=<?php echo $row['productID']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
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
                <div class="product__pagination">
                    <?php
                    // Hiển thị các liên kết phân trang
                    for ($page = 1; $page <= $total_pages; $page++) {
                        echo '<a href="?page=' . $page . '">' . $page . '</a>';
                    }
                    ?>
                    <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
</section>
<!-- Product Section End -->

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