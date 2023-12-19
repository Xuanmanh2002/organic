<?php
include './config/config.php';
if(isset($_GET["id"])){
    $id = $_GET["id"];
}
    
   $sql = "DELETE FROM tbl_contact WHERE conID = '$id'";
   $qr = mysqli_query($conn, $sql);
        header("location: contact.php");

?>
