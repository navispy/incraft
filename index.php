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
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">

    <script src="js/jquery.min.js" type='text/javascript'></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>

    <script src="js/index.js" type="text/javascript"></script>
</head>

<body>

    <div class="wrapper">
        <div class="header">
            <a href="index.html" class="farmstead-logo-img">
                <img src="img/logo.svg" alt="ІnagroBy" />
            </a>
            <!--</div>-->

            <div clas="login">
                <h4 onclick="login()" id="inagro-user" class="sign-in__text" style="cursor:pointer; float:right;">ВОЙТИ</h4>
                <img onclick="login()" id="login-icon-login" src="../../assets/icons/header/lock.svg" alt="lock" class="sign-in__img" style="cursor:pointer; float:right;padding-left:4px;">
                <img onclick="logout()" id="login-icon-logout" src="../../assets/icons/header/exit.svg" alt="выйти" class="sign-in__img" style="visibility:hidden; cursor:pointer; float:right;padding-left:4px;">
            </div>
        </div>
        <div class="menu">
            <!-- Main Top Menu -->
            <nav>
                <div id="navbar">
                    <div id="logo" class="reverse">
                        <div class="mobile-btn" style="font-size:30px;cursor:pointer; font-weight:bold;" onclick="openNav()">&#9776;</div>
                    </div>
                    <div id="links">
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
            <!-- Mobile Menu -->
            <div id="mySidenav" class="sidenav">
                <a style="cursor:pointer;" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="index.htm;">Агроусадьбы</a>
                <a href="services-additional.php">Допуслуги</a>
                <a href="about.php">О нас</a>
                <!--<a href="">Владельцам агроусадеб</a>-->
                <a href="../blog/">Статьи</a>
                <!--<a href="profile.php">Личный кабинет</a>-->
                <a onclick="checkProfile()">Личный кабинет</a>
            </div>

        </div>
    </div>
</body>

</html>