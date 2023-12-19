<?php
include './config/config.php';
include 'funccart.php';
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sID = session_id();
}

// Kiểm tra xem có thông báo đặt hàng thành công không
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo '<div class="success-message">Đặt hàng thành công!</div>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>Hoá đơn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin-top: 20px;
            color: #484b51;
        }

        .text-secondary-d1 {
            color: #728299 !important;
        }

        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }

        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
        }

        .brc-default-l1 {
            border-color: #dce9f0 !important;
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -.25rem !important;
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -.25rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .text-grey-m2 {
            color: #888a8d !important;
        }

        .text-success-m2 {
            color: #86bd68 !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-110 {
            font-size: 110% !important;
        }

        .text-blue {
            color: #478fcc !important;
        }

        .pb-25,
        .py-25 {
            padding-bottom: .75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: .75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, .92) !important;
        }

        .bgc-default-l4,
        .bgc-h-default-l4:hover {
            background-color: #f3f8fa !important;
        }

        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }

        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120% !important;
        }

        .text-primary-m1 {
            color: #4087d4 !important;
        }

        .text-danger-m1 {
            color: #dd4949 !important;
        }

        .text-blue-m2 {
            color: #68a3d5 !important;
        }

        .text-150 {
            font-size: 150% !important;
        }

        .text-60 {
            font-size: 60% !important;
        }

        .text-grey-m1 {
            color: #7b7d81 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }
    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Hoá đơn
                <small class="page-info">
                    <?php
                    $sql = "SELECT * FROM tbl_cart WHERE billID=$id";
                    $qr = mysqli_query($conn, $sql);
                    if ($sql) {
                        $i = 0;
                        while ($row = mysqli_fetch_array($qr)) {
                            $i++;
                    ?>
                            <i class="fa fa-angle-double-right text-80"></i>
                            ID: <?php echo $i; ?>

                    <?php
                        }
                    }
                    ?>
                </small>
            </h1>

        </div>
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM tbl_bill INNER JOIN tbl_customer ON tbl_bill.cusID = tbl_customer.cusID WHERE tbl_bill.billID = $id";
                        $qr = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($qr)) {
                        ?>
                            <div class="col-sm-6">
                                <div>
                                    <span class="text-sm text-grey-m2 align-middle">Họ tên khách hàng:</span>
                                    <span class="text-600 text-110 text-blue align-middle"><?php echo $row['lastName'] ?> <?php echo $row['firstName'] ?></span>
                                </div>
                                <div class="text-grey-m2">
                                    <div class="my-1">
                                        Địa chỉ:<?php echo $row['address'] ?>, <?php echo $row['city'] ?>
                                    </div>
                                    <div class="my-1">SĐT<i class="fa fa-phone fa-flip-horizontal text-secondary"></i>: <b class="text-600">0<?php echo $row['sdt'] ?></b></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="d-none d-sm-block col-1">#</div>
                            <div class="col-9 col-sm-5">Tên sản phẩm</div>
                            <div class="d-none d-sm-block col-4 col-sm-2">Số lượng</div>
                            <div class="d-none d-sm-block col-sm-2">Price</div>
                            <div class="col-2">Tổng</div>
                        </div>
                        <div class="text-95 text-secondary-d3">
                            <?php
                            $sql = "SELECT * FROM tbl_cart WHERE billID = $id";
                            $qr = mysqli_query($conn, $sql);
                            if ($sql) {
                                $i = 0;
                                while ($row = mysqli_fetch_array($qr)) {
                                    $i++;
                            ?>
                                    <div class="row mb-2 mb-sm-0 py-25">
                                        <div class="d-none d-sm-block col-1"> <?php echo $i; ?> </div>
                                        <div class="col-9 col-sm-5"><?php echo $row['productName']; ?></div>
                                        <div class="d-none d-sm-block col-2"><?php echo $row['quantity']; ?></div>
                                        <div class="d-none d-sm-block col-2 text-95"><?php echo $row['price']; ?>VNĐ</div>
                                        <div class="col-2 text-secondary-d2"><?php echo $row['total']; ?>VNĐ</div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="row border-b-2 brc-default-l2"></div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            </div>
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <?php
                                $sql = "SELECT * FROM tbl_bill WHERE billID = $id";
                                $qr = mysqli_query($conn, $sql);
                                if ($sql) {
                                    $i = 0;
                                    while ($row = mysqli_fetch_array($qr)) {
                                        $i++;
                                ?>
                                        <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                            <div class="col-7 text-right">
                                                Tổng cộng
                                            </div>
                                            <div class="col-5">
                                                <span class="text-150 text-success-d3 opacity-2"><?php echo $row['total']; ?>VNĐ</span>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <hr />
                        <div>
                            <span class="text-secondary-d1 text-105">Cảm ơn khách hàng đã ghé thăm</span>
                            <a href="index.php" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Tiếp tục mua hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>