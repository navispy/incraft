function checkForEmptyFields(dialog) {
    var thereAreEmptyFields = false;
    $(`.${dialog} input`).each(function(i, obj) {
        let objValue = $(obj).val();
        thereAreEmptyFields = thereAreEmptyFields || objValue.trim() == "";
    });

    return thereAreEmptyFields;
}

function restoreUser() {
    let userName = window.sessionStorage.getItem("userName");
    let userID = window.sessionStorage.getItem("userID");

    if (userName !== null) {
        $("span[class='login']").html("Выход");

        let photoURL = window.sessionStorage.getItem("userPhoto");
        photoURL = photoURL == "" ? "img/account.svg" : photoURL;

        $(".login-commands-user").attr("src", photoURL);
        $(".login-commands-user").css("visibility", "visible");
        $(".profile-command").css("visibility", "visible");
    }

    return userID;
}

function dateToString(str) {

    var d = str.substr(8, 2);
    var m = str.substr(5, 2);
    var y = str.substr(0, 4);

    var months = ["января", "февраля", "марта", "апреля", "мая", "июня",
        "июля", "августа", "сентября", "октября", "ноября", "декабря"
    ];

    var mmmm = months[m - 1];

    return d + " " + mmmm + " " + y;
}

function showToast(str) {
    $('html, body').animate({
        scrollTop: $(".header").offset().top
    }, 100);

    $(".toast-wrapper").addClass("visible");
    $('body').addClass("overflow-hidden");
    $('.toast span').html(str).fadeIn(1000).delay(1000).fadeOut('medium', function() {
        $(".toast-wrapper").removeClass("visible");
        $('body').removeClass("overflow-hidden");
    });
}

function showToastCustom(wrapperClass, message) {
    $('html, body').animate({
        scrollTop: $(".header").offset().top
    }, 100);

    $(`.${wrapperClass}`).addClass("visible");
    $('body').addClass("overflow-hidden");
    $('.toast-custom .message').html(message);;
}