<?php
include './config/config.php';
?>
<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];
}

$sql = "DELETE FROM tbl_product WHERE productID = $id";
        $qr = mysqli_query($conn, $sql);
        header("location: product.php");
?>