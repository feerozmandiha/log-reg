<?php
include_once 'assets/controller/methods.php';
if(isset($_POST['signup_btn'])){
    $data = $_POST['frm'];
    signup($data);
}
if(isset($_POST['login_btn'])){
    $data = $_POST['frm'];
    login($data);
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>صفحه ثبت نام یا ورود</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php \Academy01\Semej\Semej::alert();?>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
					<label for="chk" aria-hidden="true">ثبت نام</label>
					<input type="text" name="frm[username]" placeholder="نام کاربری" required="">
					<input type="email" name="frm[email]" placeholder="ایمیل" required="">
					<input type="password" name="frm[password]" placeholder="رمز عبور" required="">
					<input type="password" name="frm[passwordcnfirm]" placeholder="تکرار رمز عبور" required="">
                    <input type="submit" value="ثبت نام" name="signup_btn">
				</form>
			</div>

			<div class="login">
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
					<label for="chk" aria-hidden="true">ورود</label>
					<input type="email" name="frm[email]" placeholder="ایمیل" required="">
					<input type="password" name="frm[password]" placeholder="رمز عبور" required="">
					<input type="submit" value="ورود" name="login_btn">
				</form>
			</div>
	</div>
</body>
</html>