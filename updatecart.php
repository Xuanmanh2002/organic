<?php
session_start();

if (isset($_POST['quantity']) && isset($_POST['productId'])) {
    $quantity = $_POST['quantity'];
    $productId = $_POST['productId'];

    // Update the quantity of the product in the cart
    if (!empty($_SESSION['cart']) && isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] = $quantity;
    }
}
?>
