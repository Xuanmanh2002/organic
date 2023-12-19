<?php
include 'inc/header.php';
include 'inc/slider.php';
if (isset($_POST['them_contact'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    if ($name != "" && $email != "" && $message != "") {
        $sql = "INSERT INTO tbl_contact(name, email, message) VALUES('$name','$email','$message')";
        $qr = mysqli_query($conn, $sql);
        echo "<script>window.location.href = 'contact.php';</script>";
        exit;
    }
}
?>


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Liên hệ chúng tôi</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.php">Trang chủ</a>
                        <span>Liên hệ chúng tôi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>SDT</h4>
                    <p>+0364494459</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Đường</h4>
                    <p>Thăng Long, Vinh, Nghệ An</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_clock_alt"></span>
                    <h4>Giờ mở cửa</h4>
                    <p>10:00 sáng đến 23:00</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Email</h4>
                    <p>manh8t@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3778.752669679411!2d105.66305137486415!3d18.719888082412787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3139d1e7ef952145%3A0xf6b3bdb7c8d63ee!2sC%C3%B4ng%20Ty%20Tnhh%20General%20Vi%E1%BB%87t%20Nam!5e0!3m2!1sen!2sbd!4v1684152205749!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>Việt Nam</h4>
            <ul>
                <li>SDT: +84364493359</li>
                <li>Đường: 164, Thăng Long, tp Vinh, Nghệ An</li>
            </ul>
        </div>
    </div>
</div>
<!-- Map End -->

<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Để lại tin nhắn</h2>
                </div>
            </div>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input type="text" name="name" placeholder="Tên khách hàng">
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="col-lg-12 text-center">
                    <textarea name="message" placeholder="Nhập tin nhắn của bạn"></textarea>
                    <button type="submit" name="them_contact" class="site-btn">GỬI LỜI PHẢN HỒI</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Contact Form End -->

<?php
include 'inc/footer.php';
?>