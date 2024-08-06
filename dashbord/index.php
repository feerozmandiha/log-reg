<?php
include_once "../assets/controller/methods.php";
if (!isset($_SESSION['token'])) {
    header('location: ../index.php');die;
}

if (isset($_GET['logout'])) {
    logout();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>panel</title>
</head>
<body>
    <h1>Welcome to your Panel!</h1>
    <hr>
    <p> Username: <?php echo $_SESSION['username'];?></p>
    <a href='<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?logout';?>'>
        <button>خروج</button>

    </a>
</body>
</html>
