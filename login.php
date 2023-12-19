<?php 
include './config/config.php';
if(isset($_POST['dangnhap'])){
    $username = $_POST['cusUser'];
    $password = $_POST['cusPass'];

    // Thực hiện truy vấn dữ liệu từ CSDL
    $query = "SELECT * FROM tbl_bill WHERE cusUser='$username' AND cusPass='$password'";
    // Thay 'users' bằng tên bảng chứa thông tin người dùng trong CSDL của bạn

    // Thực hiện truy vấn
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) == 1){
        // Đăng nhập thành công
        echo "Đăng nhập thành công!";
    } else {
        // Đăng nhập thất bại
        echo "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>ĐĂNG NHẬP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style1.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Đăng nhập</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="login.php" method="post">
					<input class="text" type="text" name="cusUser" placeholder="Tên tài khoản" required=""></br>
					<input class="text" type="password" name="cusPass" placeholder="Mật khẩu" required="">
					<div class="wthree-text">
						<div class="clear"> </div>
					</div>
					<input type="submit" name="dangnhap" value="ĐĂNG NHẬP">
				</form>
				<p>Bạn chưa có tài khoản? <a href="register.php"> Đăng ký ngay!</a></p>
			</div>
		</div>
		<!-- copyright -->
		<!-- //copyright -->
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>