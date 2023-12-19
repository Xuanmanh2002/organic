<?php
include 'inc/header.php';
include './config/config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sID = session_id();
}

if (isset($_POST["addcart"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM tbl_product WHERE productID = $id";
    $qr = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($qr);

    if ($row) {
        // Lấy thông tin sản phẩm
        $productID = $id; // id sản phẩm
        $productName = $row['productName']; // tên sản phẩm
        $price = $row['price']; // giá sản phẩm
        $quantity = $_POST['quantity']; // số lượng

        // Khởi tạo session nếu chưa tồn tại
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra xem session giỏ hàng đã tồn tại chưa
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array(); // Khởi tạo một mảng trống để lưu trữ giỏ hàng
        }

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
        $cartIndex = -1; // Chỉ số của sản phẩm trong giỏ hàng
        foreach ($_SESSION['cart'] as $index => $product) {
            if ($product['id'] == $productID) {
                $cartIndex = $index;
                break;
            }
        }

        if ($cartIndex >= 0) {
            // Sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng
            $_SESSION['cart'][$cartIndex]['quantity'] += $quantity;
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $product = array(
                'id' => $id,
                'img' => $row['productImages'],
                'name' => $productName,
                'price' => $price,
                'quantity' => $quantity
            );

            $_SESSION['cart'][] = $product;
        }

        // Chuyển hướng người dùng đến trang giỏ hàng
        header("Location: shop.php");
        exit();
    }
}
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <div class="breadcrumb__option">
                        <a href="./index.html">Trang chủ</a>
                        <a href="">Sản phẩm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <form action="" method="post">
        <div class="container">
            <div class="row">
                <?php
                $sql = "SELECT * FROM tbl_product WHERE productID = $id";
                $qr = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($qr)) {
                ?>
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__pic">
                            <div class="product__details__pic__item">
                                <img src="./admin/<?php echo $row['productImages']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__text">
                            <h3><?php echo $row['productName'] ?></h3>
                            <div class="product__details__price"><span><?php echo $row['price']; ?></span>vnđ</div>
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="quantity" value="1" min="1">
                                    </div>
                                </div>
                            </div>
                            <button name="addcart" class="primary-btn">Thêm vào giỏ hàng</button>
                            <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                            <ul>
                                <li><b>Tình trạng mặt hàng</b> <span>Còn trong kho</span></li>
                                <li><b>Vận chuyển</b> <span>01 ngày vận chuyển.<samp> Freeship ngay hôm nay</samp></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Nội dung</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Thông tin sản phẩm</h6>
                                        <p><?php echo $row['description'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </form>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            // Thực hiện truy vấn lấy 4 sản phẩm liên quan từ cơ sở dữ liệu
            $sql = "SELECT * FROM tbl_product WHERE productID <> $id LIMIT 4";
            $qr = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($qr)) {
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg">
                            <img src="./admin/<?php echo $row['productImages']; ?>">
                            <ul class="product__item__pic__hover">
                                <li><a href="addcart.php?productID=<?php echo $row['productID']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#"><?php echo $row['productName']; ?></a></h6>
                            <h5><?php echo $row['price']; ?></h5>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- Related Product Section End -->
<?php
include 'inc/footer.php';
?>