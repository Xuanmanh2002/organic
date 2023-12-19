<?php
include './config/config.php';
?>

<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Tất cả sản phẩm</span>
                    </div>
                    <ul>
                        <li><a href="meats.php">Thịt tươi sống</a></li>
                        <li><a href="vegetables.php">Rau củ quả</a></li>
                        <li><a href="fruits.php">Hoa quả</a></li>
                        <li><a href="#">Sữa tươi</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#" method="post" class="hero__search__form" onsubmit="handleSearch(event)">
                            <input type="text" placeholder="Tìm kiếm sản phẩm?" name="txtsearch" class="hero__search__input">
                            <button type="submit" name="search" class="site-btn hero__search__button">TÌM KIẾM</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+84 364494459</h5>
                            <span>hỗ trợ 24/7 </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->


