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
    <link rel="stylesheet" href="css/styles.css?version=9" type="text/css">
    <link rel="stylesheet" href="css/custom-checkbox.css?version=9" type="text/css">
    <link rel="stylesheet" href="css/custom-radio.css?version=9" type="text/css">
    <link rel="stylesheet" href="css/profile.css?version=10" type="text/css">
    <link rel="stylesheet" href="css/menu.css?version=9" type="text/css">

    <script src="js/jquery.min.js" type='text/javascript'></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>

    <script src="js/profile.js?version=1m" type="text/javascript"></script>
    <script src="js/signup.js?version=1m" type="text/javascript"></script>
    <script src="js/login.js?version=1m" type="text/javascript"></script>
    <script src="js/password-restore.js?version=1m" type="text/javascript"></script>
    <script src="js/password-change.js?version=1m" type="text/javascript"></script>
    <script src="js/utils.js?version=1m" type="text/javascript"></script>
</head>

<body>
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

            <div class="tabs">
                <ul>
                    <li><a href="#tabs-1">Управление магазинами</a></li>
                    <li><a href="#tabs-2-wrapper">История просмотров</a></li>
                    <li><a href="#tabs-3-wrapper">Профиль</a></li>
                </ul>

                <div id="tabs-1" class="tabs-1">
                </div>

                <div id="tabs-2-wrapper" class="tabs-2-wrapper">
                </div>

                <div id="tabs-3-wrapper" class="tabs-3-wrapper">                
                    <div id="tabs-3" class="tabs-3">
                        <input class="new-avatar" type="file" accept="image/*" data-field="Photo"/>
                        <div class="photo-wrapper">
                            <img class="photo">
                            <div class="button-edit">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.4 15.2999L16.8 4.8999L19.6 7.6999L9.2 18.0999L5.5 19.0999L6.4 15.2999Z" fill="white"/>
                                    <path d="M16.8 6.3L18.2 7.7L8.69995 17.2L6.89995 17.7L7.29995 15.8L16.8 6.3ZM16.8 3.5L5.49995 14.8L4.19995 20.6L9.69995 19L21 7.7L16.8 3.5Z" fill="black"/>
                                    <path d="M14 7L17.5 10.5" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                    <path d="M6.19995 14.7998L9.69995 18.2998" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                    <path d="M5.5 15.5V19.5L9.5 18.5L5.5 15.5Z" fill="black"/>
                                </svg>
                            </div>
                        </div>

                        <div class="data">
                            
                            <div class="name-wrapper">
                                <input class="input input-name" readonly data-field="Name"></input>
                                <div class="icon-edit name-edit-btn" data-control="input-name">
                                    <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.4 12.2999L12.8 1.8999L15.6 4.6999L5.2 15.0999L1.5 16.0999L2.4 12.2999Z" fill="white"/>
                                        <path d="M12.8 3.3L14.2 4.7L4.69995 14.2L2.89995 14.7L3.29995 12.8L12.8 3.3ZM12.8 0.5L1.49995 11.8L0.199951 17.6L5.69995 16L17 4.7L12.8 0.5Z" fill="black"/>
                                        <path d="M10 4L13.5 7.5" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                        <path d="M2.19995 11.7998L5.69995 15.2998" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                        <path d="M1.5 12.5V16.5L5.5 15.5L1.5 12.5Z" fill="black"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="date-registered">
                                <span></span>
                            </div>

                            <div class="email-wrapper">
                                <span>Электронная почта</span>
                                <div></div>
                                <input class="input input-email" readonly data-field="Email"></input>
                                <div class="icon-edit email-edit-btn" data-control="input-email">
                                    <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.4 12.2999L12.8 1.8999L15.6 4.6999L5.2 15.0999L1.5 16.0999L2.4 12.2999Z" fill="white"/>
                                        <path d="M12.8 3.3L14.2 4.7L4.69995 14.2L2.89995 14.7L3.29995 12.8L12.8 3.3ZM12.8 0.5L1.49995 11.8L0.199951 17.6L5.69995 16L17 4.7L12.8 0.5Z" fill="black"/>
                                        <path d="M10 4L13.5 7.5" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                        <path d="M2.19995 11.7998L5.69995 15.2998" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                        <path d="M1.5 12.5V16.5L5.5 15.5L1.5 12.5Z" fill="black"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="phone-wrapper">
                                <span>Телефон</span>
                                <div></div>
                                <input class="input input-phone" readonly data-field="Phone"></input>
                                <div class="icon-edit phone-edit-btn" data-control="input-phone">
                                    <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.4 12.2999L12.8 1.8999L15.6 4.6999L5.2 15.0999L1.5 16.0999L2.4 12.2999Z" fill="white"/>
                                        <path d="M12.8 3.3L14.2 4.7L4.69995 14.2L2.89995 14.7L3.29995 12.8L12.8 3.3ZM12.8 0.5L1.49995 11.8L0.199951 17.6L5.69995 16L17 4.7L12.8 0.5Z" fill="black"/>
                                        <path d="M10 4L13.5 7.5" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                        <path d="M2.19995 11.7998L5.69995 15.2998" stroke="black" stroke-width="2" stroke-miterlimit="10"/>
                                        <path d="M1.5 12.5V16.5L5.5 15.5L1.5 12.5Z" fill="black"/>
                                    </svg>
                                </div>

                            </div>
                            
                            <div class="visibility-wrapper">
                                <span class="caption">Кому показывать контакты</span>
                                <div class="options">
                                    <label class="container-radio">
                                        <span>Всем</span>
                                        <input type="radio" name="visibility-option" value="1" data-field="Visibility"/>
                                        <span class="checkmark-radio"></span>
                                    </label>
                                    <label class="container-radio">
                                        <span>Никому</span>
                                        <input type="radio" name="visibility-option" value="0" data-field="Visibility"/>
                                        <span class="checkmark-radio"></span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="white-list-wrapper">
                                <span class="caption">От кого получать письма</span>
                                <div class="options">
                                    <label class="container">
                                        <span>Сообщения от посетителей</span>
                                        <input class="rcv-msg rcv-msg-from-visitors" type="checkbox" data-field="ReceiveMsgFromVisitors"/>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">
                                        <span>Сообщения от системы</span>
                                        <input class="rcv-msg rcv-msg-from-system" type="checkbox" data-field="ReceiveMsgFromSystem"/>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">
                                        <span>Сообщения от избранных магазинов</span>
                                        <input class="rcv-msg rcv-msg-from-favourite-shops" type="checkbox" data-field="ReceiveMsgFromFavouriteShops"/>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">
                                        <span>Сообщения о новых заказах в Ваших магазинах</span>
                                        <input class="rcv-msg rcv-new-order-notifications" type="checkbox" data-field="ReceiveNewOrderNotifications"/>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div>

                            <div class="save-button">
                                <span>Применить и сохранить</span>
                            </div>

                        </div>

                        <div class="commands-wrapper"> <!-- right pabel -->
                            <div class="group"> <!-- colored box -->
                                <div class="cmd-account-status suspend-account" data-field="AccountStatus" data-value="1">
                                    <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.6 7.7H6.4L1.5 1H11.5L6.6 7.7Z" stroke="black" stroke-miterlimit="10"/>
                                        <path d="M6.4 7.2998H6.6L11.5 13.9998H1.5L6.4 7.2998Z" stroke="black" stroke-miterlimit="10"/>
                                    </svg>
                                    <span>Приостановить действие аккаунта</span>
                                </div>

                                <div class="cmd-account-status delete-account" data-field="AccountStatus" data-value="2">
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.4001 0.600098L0.600098 10.4001" stroke="black" stroke-miterlimit="10"/>
                                        <path d="M10.4001 10.4001L0.600098 0.600098" stroke="black" stroke-miterlimit="10"/>
                                    </svg>
                                    <span>Удалить аккаунт</span>
                                </div>
                            </div>

                            <div class="password-change">
                                <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.1 1C7.1 1 8 1.8 8 2.9V5H3V2.9C3 1.9 3.8 1 4.9 1H6.1ZM6.1 0H4.8C3.3 0 2 1.3 2 2.9V6H9V2.9C9 1.3 7.7 0 6.1 0Z" fill="black"/>
                                    <path d="M10 6V13H1V6H10ZM10.4 5H0.6C0.3 5 0 5.3 0 5.6V13.3C0 13.7 0.3 14 0.6 14H10.3C10.7 14 10.9 13.7 10.9 13.4V5.7C11 5.3 10.7 5 10.4 5Z" fill="black"/>
                                </svg>
                                <span>Сменить пароль</span>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                

            </div>

        </div>

        <?php include 'footer.php'; ?>
    </div>
</body>

</html>