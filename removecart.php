<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['productID'])) {
    $productID = $_GET['productID'];

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        // Duyệt qua các sản phẩm trong giỏ hàng
        foreach ($_SESSION['cart'] as $key => $item) {
            // Kiểm tra xem sản phẩm có cùng ID với sản phẩm cần xóa hay không
            if ($item['id'] == $productID) {
                // Xóa sản phẩm khỏi giỏ hàng
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }
}

// Chuyển hướng người dùng về trang giỏ hàng sau khi xóa sản phẩm
header("Location: cart.php");
exit();
?>