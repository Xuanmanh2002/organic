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
                    <h2>Cửa hàng Ogani</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Trang chủ</a>
                        <span>Cửa hàng</span>
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
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Danh mục sản phẩm</h4>
                            <ul>
                                <?php
                                $sql = "SELECT * FROM tbl_category WHERE catID != 71";
                                $qr = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($qr)) {
                                ?>
                                    <li><a href="#"><?php echo $row['catName'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="row">
                        <?php
                        $results_per_page = 9; // Số lượng sản phẩm hiển thị trên mỗi trang
                        $sql = "SELECT COUNT(*) AS total FROM tbl_product";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $total_products = $row['total'];
                        $total_pages = ceil($total_products / $results_per_page); // Tính tổng số trang
                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại, nếu không được thiết lập, mặc định là trang 1

                        $start_index = ($current_page - 1) * $results_per_page; // Vị trí bắt đầu của sản phẩm trong CSDL

                        $sql = "SELECT * FROM tbl_product ORDER BY productID DESC LIMIT $start_index, $results_per_page";
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
        </form>
    </div>
</section>
<!-- Product Section End -->

<?php
include './inc/footer.php';
?>