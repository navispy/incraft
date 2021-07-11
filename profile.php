<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INCRAFTBY</title>

    <link rel="stylesheet" href="css/fonts.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/styles.css?version=3" type="text/css">
    <link rel="stylesheet" href="css/profile.css?version=3" type="text/css">
    <link rel="stylesheet" href="css/menu.css?version=3" type="text/css">

    <script src="js/jquery.min.js" type='text/javascript'></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>

    <script src="js/profile.js?version=1d" type="text/javascript"></script>
    <script src="js/signup.js?version=1d" type="text/javascript"></script>
    <script src="js/login.js?version=1d" type="text/javascript"></script>
    <script src="js/password-restore.js?version=1d" type="text/javascript"></script>

    <script src="js/utils.js?version=1c" type="text/javascript"></script>
</head>

<body>
    <div class="login-wrapper">
        <?php include 'login-wrapper.php'; ?>
    </div>
    <div class="signup-wrapper">
        <?php include 'signup-wrapper.php'; ?>
    </div>
    <div class="password-restore-wrapper">
        <?php include 'password-restore-wrapper.php'; ?>
    </div>
    <div class="wrapper">
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>

        <div class="main">

        </div>

        <?php include 'footer.php'; ?>
    </div>
</body>

</html>