function setupSigninHandlers() {
    $(".signin").click(function () {
        tryLogin();
    });

    $(".login-dialog .content-wrapper .input").click(function (event) {
        let className = event.currentTarget.className;
        $(`div[class='${className}'] input`).focus();
    });

    $(".login-dialog .cancel").click(function () {
        closeLogin();
    });

    $("span[class='login']").click(function () { // login/logout
        let userName = window.sessionStorage.getItem("userName");

        if(userName !== null) { //logout
            window.sessionStorage.removeItem("userName");
            $("span[class='login']").html("Вход");

            $(".login-commands-user").attr("src", "");
            $(".login-commands-user").css("visibility", "hidden");    
        } else { // login
            showLogin();
        }
    });

    $(".login-commands-user").click(function () { // show profile
        window.location.assign(`profile.php`);
    });
}

function showLogin() {
    $(".login-wrapper").addClass("visible");
    $(".login-dialog").slideToggle("medium");

    $(".login-wrapper .error-msg").remove();

    $('.name').focus();
    $('body').addClass("overflow-hidden");
}

function closeLogin() {
    $(".login-dialog").slideToggle("medium", function () {
        $(".login-wrapper").removeClass("visible");
        $('body').removeClass("overflow-hidden");
    });
}

function tryLogin() {
    var thereAreEmptyFields = checkForEmptyFields("login-dialog");
    if(thereAreEmptyFields) {
        var errMsg = "Заполните пожалуйста все поля";
        var html =
            `<div class="error-msg">
             <span>${errMsg}</span>
        </div>`;

        $(".login-dialog .content-subwrapper .error-msg").remove();
        $(html).insertBefore(".login-dialog .content-subwrapper .input-1");      
        return;
    }

    var calcTime = new Date().getTime();
    var name = $(".login-dialog .name").val();
    var pass = $(".login-dialog .password").val();

    $.ajax({
        url: "post_json_login.php",
        type: 'POST',
        dataType: 'json',
        data: {
            calcTime: calcTime,
            name: name,
            pass: pass,
            schemaID: "incraft"
        },
        success: function (data) {

            if (data["calcTime"] == calcTime) {
                if(data["credentialsOK"] == false) {
                    var errMsg = "Неправильный логин/пароль";//data["error"];
                    var html =
                        `<div class="error-msg">
                         <span>${errMsg}</span>
                    </div>`;

                    $(".login-dialog .content-subwrapper .error-msg").remove();
                    //$(".login-dialog .content-subwrapper").prepend(html);
                    $(html).insertBefore(".login-dialog .content-subwrapper .input-1");
                } else {
                    $("span[class='login']").html("Выход");
                    
                    let photoURL = data["photo"];
                    photoURL = photoURL == "" ? "img/account.svg" : photoURL;

                    $(".login-commands-user").attr("src", photoURL);
                    $(".login-commands-user").css("visibility", "visible");
                    closeLogin();

                    window.sessionStorage.setItem("userName", name);
                    window.sessionStorage.setItem("userPhoto", photoURL);
                }
            }
        },
        error: function (data) {
            alert("Error tryLogin()");
        },
    });
}