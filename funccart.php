<?php

function taogiohang($productID, $sID, $productName, $price, $quantity, $productImages, $total, $billID)
{
    $conn = ketnoidb();

    $sql = "INSERT INTO tbl_cart (productID, sID, productName, price, quantity, productImages, total, billID)
                 VALUES ('$productID','$sID','$productName','$price','$quantity','$productImages','$total','$billID')";
    $conn->exec($sql);
    $conn = null;
}

function taonguoimuahang($firstName, $lastName, $address, $city, $sdt, $email, $note)
{
    $conn = ketnoidb();

    $sql = "INSERT INTO tbl_customer (firstName,lastName,address,city,sdt,email,note)
                 VALUES ('$firstName','$lastName','$address','$city','$sdt','$email','$note')";
    $conn->exec($sql);
    $last_id = $conn->lastInsertId();
    $conn = null;
    return $last_id;
}

function taodonhang($pttt, $total,  $status, $cusID)
{
    $conn = ketnoidb();

    $sql = "INSERT INTO tbl_bill (pttt, total,  status, cusID)
                 VALUES ('$pttt', '$total', ' $status', '$cusID')";
    $conn->exec($sql);
    $last_id = $conn->lastInsertId();
    $conn = null;
    return $last_id;
}

function ketnoidb()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "organic";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function showtotal()
{
    $total = calculateTotal();
?>
    <ul>
        <li>Tổng cộng <span><?php echo number_format($total, 3); ?>vnd</span></li>
    </ul>
    <?php
}

function showgiohang()
{
    if (!empty($_SESSION['cart'])) {
    ?>
        <!-- Shoping Cart Section Begin -->
        <section class="shoping-cart spad">
            <div class="container">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__table">
                                <table>
                                    <!-- Đặt id cho phần tử chứa nội dung giỏ hàng -->
                                    <thead id="cartContent">
                                        <tr>
                                            <th class="shoping__product">Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng cộng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($_SESSION['cart'] as $key => $item) {
                                            $id = $item['id'];
                                            $img = $item['img'];
                                            $name = $item['name'];
                                            $price = $item['price'];
                                            $quantity = $item['quantity'];
                                            $total = bcadd($price, '0', 3) * $quantity;
                                        ?>
                                            <tr>
                                                <td class="shoping__cart__item">
                                                    <img src="./admin/<?php echo $img; ?>" style="max-width: 40px" class="img-fluid">
                                                    <h5><?php echo $name; ?></h5>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    <?php echo $price; ?>vnd
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                        <input type="text" min="1" value="<?php echo $quantity; ?>">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    <?php echo number_format($total, 3); ?>vnd
                                                </td>
                                                <td class="shoping__cart__item__close">
                                                    <a href="removecart.php?productID=<?php echo $id; ?>"><span class="icon_trash"></span></a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__btns">
                                <a href="shop.php" class="primary-btn cart-btn">TIẾP TỤC MUA HÀNG</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6">
                            <div class="shoping__checkout">
                                <h5>Tổng số giỏ hàng</h5>
                                <?php showtotal(); ?>
                                <a href="checkout.php?sID=<?php echo session_id() ?>" class="primary-btn">TIẾN HÀNH KIỂM TRA VÀ THANH TOÁN</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Shoping Cart Section End -->
    <?php
    } else {
    ?>
        <section class="shoping-cart spad">
            <div class="container">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="shoping__product">Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng cộng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5" class="text-center">Không có sản phẩm trong giỏ hàng</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__btns">
                                <a href="shop.php" class="primary-btn cart-btn">TIẾP TỤC MUA HÀNG</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6">
                            <div class="shoping__checkout">
                                <h5>Tổng số giỏ hàng</h5>
                                <?php showtotal(); ?>
                                <a href="checkout.php?sID=<?php echo session_id() ?>" class="primary-btn">TIẾN HÀNH KIỂM TRA VÀ THANH TOÁN</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    <?php
    }
}

function updateCartQuantity($newQuantity, $productID)
{
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $productID) {
                $_SESSION['cart'][$key]['quantity'] = $newQuantity;
                break;
            }
        }
    }
}


function showbill()
{
    $subtotal = calculateTotal();
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            $name = $item['name'];
            $price = $item['price'];
            $quantity = $item['quantity'];
            $total = $price * $quantity;
            $subtotal = calculateTotal();

            // Hiển thị thông tin sản phẩm trong giỏ hàng
            echo "<ul>";
            echo "<li>" . substr($name, 0, 20) . "<span>" . number_format($total, 3) . "vnd</span></li>";
            echo "</ul>";
        }
    }
    ?>
    <div class="checkout__order__total">Tổng cộng <span><?php echo number_format($subtotal, 3); ?>vnd</span></div>
    <div class="checkout__input__checkbox"></div>
<?php
}

function calculateTotal()
{
    $total = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $quantity = intval($product['quantity']);
            $price = floatval($product['price']);
            $subtotal = $price * $quantity;
            $total += $subtotal;
        }
    }
    return $total;
}


?>