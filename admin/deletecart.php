<?php
include './config/config.php';
// Lấy billID từ yêu cầu POST hoặc GET
$billID = $_REQUEST['billID'];

// Xoá giỏ hàng dựa trên billID
$sql = "DELETE FROM tbl_cart WHERE billID = '$billID'";
$result = mysqli_query($conn, $sql);

// Xoá thông tin khách hàng dựa trên billID
$sql = "DELETE tbl_customer FROM tbl_customer
        INNER JOIN tbl_bill ON tbl_customer.cusID = tbl_bill.cusID
        WHERE tbl_bill.billID = '$billID'";
$result = mysqli_query($conn, $sql);

// Xoá hóa đơn dựa trên billID
$sql = "DELETE FROM tbl_bill WHERE billID = '$billID'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Xoá giỏ hàng thành công!";
    echo "<script>window.location.href = 'cartmanager.php';</script>";
    exit();
} else {
    echo "Lỗi khi xoá giỏ hàng: " . mysqli_error($conn);
}

// Đóng kết nối
mysqli_close($conn);
?>
