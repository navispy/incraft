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
            <a href="index.php" class="logo">
                <img src="img/logo.svg" alt="ІnagroBy" />
            </a>

            <div class="login">
                <div class="login-commands">
                    <img class="login-commands-user" src="img/user01.png">
                    <span>Выход</h4>
                </div>

                <div class="login-notifications">
                    <svg class="login-notifications-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.4 17.5H5L6 8.1C6.3 5.3 9.2 3.2 12.7 3.2C16.2 3.2 19.2 5.4 19.4 8.1L20.4 17.5Z" fill="white" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M14.9999 20.3C14.9999 21.4 13.9999 22.2 12.6999 22.2C11.3999 22.2 10.3999 21.3 10.3999 20.3" fill="white" />
                        <path d="M14.9999 20.3C14.9999 21.4 13.9999 22.2 12.6999 22.2C11.3999 22.2 10.3999 21.3 10.3999 20.3" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M12.7 2V3.2" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" />
                    </svg>
                    <div class="login-notifications-counter">
                        <span class="login-notifications-counter-span">43</span>
                    </div>
                </div>

                <div class="login-shop">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 9H2L5 4H19L22 9Z" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M4 22V9H20V22" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M13 13H8V21H13V13Z" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                    </svg>

                    <span>Магазин</span>
                </div>
            </div>
        </div>
        <div class="menu">
            <!-- Main Top Menu -->
            <nav>
                <div id="navbar">
                    <div id="navbar-logo" class="reverse">
                        <div class="mobile-btn" onclick="openNav()">&#9776;</div>
                    </div>
                    <div id="navbar-links">
                        <a href="index.php">Катало</a>
                        <a href="services-additional.php">Допуслуги</a>
                        <a href="about.php">О нас</a>
                        <a href="../blog/">Ремесленникам</a>
                        <a onclick="checkProfile()">Статьи</a>
                        <a onclick="checkProfile()">Личный кабинет</a>
                    </div>
                </div>
            </nav>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</body>

</html>