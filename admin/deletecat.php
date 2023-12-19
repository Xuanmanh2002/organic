<?php
include './config/config.php';
?>
<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];
}

$sql = "DELETE FROM tbl_category WHERE catID = $id";
        $qr = mysqli_query($conn, $sql);
        header("location: category.php");
?>