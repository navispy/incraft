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
    <link rel="stylesheet" href="css/styles.css?version=37" type="text/css">
    <link rel="stylesheet" href="css/menu.css?version=37" type="text/css">
    <link rel="stylesheet" href="css/about.css?version=37" type="text/css">

    <script src="js/jquery.min.js" type='text/javascript'></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>

    <script src="js/about.js?version=37" type="text/javascript"></script>
    <script src="js/signup.js?version=37" type="text/javascript"></script>
    <script src="js/login.js?version=37" type="text/javascript"></script>
    <script src="js/password-restore.js?version=37" type="text/javascript"></script>
    <script src="js/password-change.js?version=37" type="text/javascript"></script>
    <script src="js/utils.js?version=37" type="text/javascript"></script>
</head>

<body>
    <div class="toast-wrapper-custom">
        <?php include 'toast-wrapper-custom.php'; ?>
    </div>

    <div class="toast-wrapper">
        <?php include 'toast-wrapper.php'; ?>
    </div>

    <div class="login-wrapper">
        <?php include 'login-wrapper.php'; ?>
    </div>
    <div class="signup-wrapper">
        <?php include 'signup-wrapper.php'; ?>
    </div>
    <div class="password-restore-wrapper">
        <?php include 'password-restore-wrapper.php'; ?>
    </div>
    <div class="password-change-wrapper">
        <?php include 'password-change-wrapper.php'; ?>
    </div>

    <div class="wrapper">
        <?php include 'header.php'; ?>
        <?php include 'menu.php'; ?>

        <div class="main">
            <div class="content">
                <div class="header-1">
                    О нас
                </div>
                <div class="text-1">
                    <p>Incraft.by - бесплатная площадка для ремесленников и ИП, позволяющая быстро находить клиентов и предлагать свои товары самым современным образом.</p>
                    <p>Благодаря этому ресурсу вы сможете быстро и уверенно развивать ваш бизнес и достигать новых высот в своем деле, посвящая больше времени развитию своих навыков, а не изучению методик продаж.</p>
                </div>
                <div class="header-2">
                    Как все рабоатет?
                </div>
                <div class="text-1">
                    <p>Инициатива «Быхов-инновационный» реализуется в рамках проекта «Поддержка экономического развития на местном уровне в Республике Беларусь», который финансируется Европейским союзом (ЕС) и реализуется Программой развития ООН (ПРООН) в партнерстве с Министерством экономики Республики Беларусь.</p>
                </div>
                <img class="about-image-1" src="img/about-01.png" />
                <div class="header-2">
                    Цель инициативы
                </div>
                <div class="text-1">
                    <p>Цель инициативы «Быхов инновационный»: создать благоприятные условия для развития Быховского района путем поддержки экономической инициативы населения, способствовать развитию бизнеса, стартапов и инновационных компаний.</p>
                </div>
                <div class="header-2">
                    Наши партнеры
                </div>
                <div class="our-partners">
                    <img src="img/UNDP.png" />
                    <img src="img/logo_bh 1.png" />
                    <img src="img/BFFPP 1.png" />
                    <img src="img/1200px-International_Atomic_Energy_Agency_Logo 1.png" />
                </div>


                <div class="contact-us">
                    <div class="header-3">
                        Напишите нам и мы свяжемся с Вами
                    </div>

                    <input placeholder="Ваше имя" class="input input-contact-name"></input>
                    <input placeholder="Ваш email" class="input input-contact-email"></input>
                    <textarea placeholder="Текст комментария" cols="40" row="20" class="input input-contact-comment"></textarea>
                    <div class="contact-comment-send">
                        <span>Отправить</span>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</body>

</html>