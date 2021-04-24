<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INCRAFTBY</title>

    <link rel="stylesheet" href="css/styles.css?version=1" type="text/css">
    <link rel="stylesheet" href="css/menu.css?version=1" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">

    <script src="js/jquery.min.js" type='text/javascript'></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>

    <script src="js/index.js" type="text/javascript"></script>
</head>

<body>

    <div class="wrapper">
        <div class="header">
            <a href="index.html" class="logo">
                <img src="img/logo.svg" alt="ІnagroBy" />
            </a>

            <div class="login">
                <h4 onclick="login()" id="inagro-user" class="sign-in__text" style="cursor:pointer; float:right;">ВОЙТИ</h4>
            </div>
        </div>
        <div class="menu">
            <!-- Main Top Menu -->
            <nav>
                <div id="navbar">
                    <div id="navbar-logo" class="reverse">
                        <div class="mobile-btn" style="font-size:30px;cursor:pointer; font-weight:bold;" onclick="openNav()">&#9776;</div>
                    </div>
                    <div id="navbar-links">
                        <a href="index.html">Агроусадьбы</a>
                        <a href="services-additional.php">Допуслуги</a>
                        <a href="about.php">О нас</a>
                        <!--<a href="">Владельцам агроусадеб</a>-->
                        <a href="../blog/">Статьи</a>
                        <!--<a href="profile.php">Личный кабинет</a>-->
                        <a onclick="checkProfile()">Личный кабинет</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</body>

</html>