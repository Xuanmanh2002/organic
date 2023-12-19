<?php
include 'inc/header.php';
include 'inc/menu.php';
include './config/config.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Lời phản hồi từ phía khách hàng</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item active">Phản hồi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <?php
            $sql = "SELECT * FROM tbl_contact ORDER BY conID DESC";
            $qr = mysqli_query($conn, $sql);
            if ($qr) {
                while ($row = mysqli_fetch_array($qr)) {
            ?>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">TÊN KHÁCH HÀNG: <?php echo $row['name']; ?> </h5>
                                <h6 class="card-title">EMAIL: <?php echo $row['email']; ?> </h6>
                                <textarea><?php echo $row['message']; ?></textarea><br>

                                <!-- Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                                    Xoá
                                </button>
                                <div class="modal fade" id="basicModal" tabindex="-1">
                                    <form method="post" action="deletecontact.php?id=<?php echo $row['conID']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="card-title">TÊN KHÁCH HÀNG: <?php echo $row['name']; ?> </h5>
                                                    <h6 class="card-title">EMAIL: <?php echo $row['email']; ?> </h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo $row['message']; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="conID" value="<?php echo $row['id']; ?>">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Xoá</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- End Modal -->
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            </form>
        </div>
    </section>

</main><!-- End #main -->
<?php
include 'inc/footer.php';
?>