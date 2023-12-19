<?php
include './config/config.php';
session_start();

$addedToCart = false;


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['productID'])) {
    // Lấy thông tin sản phẩm từ CSDL dựa trên ID sản phẩm được truyền qua tham số URL
    $id = $_GET['productID'];
    $sID = session_id();
    $sql = "SELECT * FROM tbl_product WHERE productID = $id";
    $qr = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($qr);

    // Tạo một mảng chứa thông tin sản phẩm
    $product = array(
        'id' => $id,
        'sID' => $sID,
        'img' => $row['productImages'],
        'name' => $row['productName'],
        'price' => $row['price'],
        'quantity' => 1
    );

    // Kiểm tra xem giỏ hàng đã tồn tại trong session chưa
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        // Biến để kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
        $productExists = false;

        // Duyệt qua các sản phẩm trong giỏ hàng
        foreach ($_SESSION['cart'] as &$item) {
            // Kiểm tra xem sản phẩm có cùng ID với sản phẩm được thêm vào hay không
            if ($item['id'] == $product['id']) {
                // Nếu sản phẩm đã tồn tại, cập nhật số lượng sản phẩm
                $item['quantity'] += 1;
                $productExists = true;
                break;
            }
        }

        // Nếu sản phẩm chưa tồn tại, thêm sản phẩm vào giỏ hàng
        if (!$productExists) {
            $_SESSION['cart'][] = $product;
        }
    } else {
        // Nếu chưa tồn tại, tạo một giỏ hàng mới và thêm sản phẩm vào
        $_SESSION['cart'] = array($product);
    }
}

// Chuyển hướng người dùng về trang sản phẩm sau khi thêm vào giỏ hàng
header("Location: shop.php");
exit();
?>