<?php
include './config/config.php';
?>
<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];
}

$sql = "DELETE FROM tbl_blog WHERE blogID = $id";
        $qr = mysqli_query($conn, $sql);
        header("location: post.php");
?>