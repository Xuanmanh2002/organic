<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        // Lắng nghe sự kiện khi checkbox thay đổi
        var paymentCheckbox = document.getElementById('payment');
        var paypalCheckbox = document.getElementById('paypal');
        var shipcodCheckbox = document.getElementById('shipcod');

        paymentCheckbox.addEventListener('change', function() {
            if (this.checked) {
                paypalCheckbox.checked = false;
                shipcodCheckbox.checked = false;
            }
        });

        paypalCheckbox.addEventListener('change', function() {
            if (this.checked) {
                paymentCheckbox.checked = false;
                shipcodCheckbox.checked = false;
            }
        });

        shipcodCheckbox.addEventListener('change', function() {
            if (this.checked) {
                paymentCheckbox.checked = false;
                paypalCheckbox.checked = false;
            }
        });
    });
</script>
<?php
include 'inc/header.php';
include 'inc/slider.php';
include 'funccart.php';

// Kiểm tra nếu có sự kiện "Thêm vào giỏ hàng" và các trường thông tin khách hàng được điền đầy đủ
if (isset($_POST['dathang']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['sdt']) && !empty($_POST['email'])) {
    // Lấy thông tin từ khách hàng
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $note = $_POST['note'];
    $total = calculateTotal(); // Hàm calculateTotal() tính tổng giá trị đơn hàng
    if (isset($_POST['payment'])) {
        $pttt = 1; // Gán giá trị 1 cho thanh toán tiền mặt
    } elseif (isset($_POST['paypal'])) {
        $pttt = 2; // Gán giá trị 2 cho thanh toán thẻ
    } elseif (isset($_POST['shipcod'])) {
        $pttt = 3; // Gán giá trị 3 cho shipcod
    }
    $status = 'Chờ xử lý';


    // Gọi hàm taonguoimuahang để tạo người mua hàng
    $cusID = taonguoimuahang($firstName, $lastName, $address, $city, $sdt, $email, $note);

    // Lấy thông tin từ đơn đặt hàng
    $billID = taodonhang($pttt, $total,  $status, $cusID); // Thêm biến $billID để lưu lại mã hóa đơn

    // Thêm tất cả sản phẩm vào giỏ hàng
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $productID = $item['id'];
            $sID = $item['sID'];
            $productName = $item['name']; // Sửa chỉ số hoặc tên cột tương ứng
            $price = $item['price']; // Sửa chỉ số hoặc tên cột tương ứng
            $quantity = $item['quantity']; // Sửa chỉ số hoặc tên cột tương ứng
            $productImages = $item['img']; // Sửa chỉ số hoặc tên cột tương ứng
            $total = $price * $quantity;
            taogiohang($productID, $sID, $productName, $price, $quantity, $productImages, $total, $billID);
        }
    }

    // Xóa giỏ hàng sau khi tạo đơn hàng thành công
    unset($_SESSION['cart']);
 
    // Chuyển hướng người dùng đến trang hoàn thành đơn hàng
    echo "<script>window.location.href='bill.php?id=" . $billID . "&success=true';</script>";
    exit();
}

?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thủ tục thanh toán</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.php">Trang chủ</a>
                        <span>Thủ tục thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Chi tiết thanh toán</h4>
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Tên<span>*</span></p>
                                    <input name="firstName" type="text" placeholder="nhập tên">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ<span>*</span></p>
                                    <input name="lastName" type="text" placeholder="nhập tên">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Đường<span>*</span></p>
                            <input name="address" type="text" placeholder="Địa chỉ đường phố" class="checkout__input__add">
                        </div>
                        <div class="checkout__input">
                            <p>Thành phố<span>*</span></p>
                            <input name="city" type="text">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>SDT<span>*</span></p>
                                    <input name="sdt" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input name="email" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú<span>*</span></p>
                            <textarea name="note" type="text" class="form-control mb-3"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn đặt hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm<span>Tổng cộng</span></div>
                            <?php showbill(); ?>
                            <div class="checkout__input__checkbox">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Thanh toán tiền mặt
                                    <input type="checkbox" id="payment" name="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Thanh toán thẻ
                                    <input type="checkbox" id="paypal" name="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="shipcod">
                                    Shipcod
                                    <input type="checkbox" id="shipcod" name="shipcod">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <button type="submit" name="dathang" class="site-btn">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<?php
include 'inc/footer.php';
?>