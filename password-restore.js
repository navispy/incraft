function setupPasswordRestoreHandlers() {
    $(".password-restore").click(function () {
        showPasswordRestore();
    });

    $(".restore").click(function () {
        tryPasswordRestore();
    });

    $(".password-restore-dialog .content-wrapper .input").click(function (event) {
        let className = event.currentTarget.className;
        $(`div[class='${className}'] input`).focus();
    });

    $(".password-restore-dialog .cancel").click(function () {
        closePasswordRestore();
    });
}

function showPasswordRestore() {
    $(".login-wrapper").removeClass("visible");
    $(".login-dialog").hide();

    $(".password-restore-wrapper").addClass("visible");
    $(".password-restore-wrapper .error-msg").remove();
    $(".password-restore-dialog").slideToggle("medium");

    $('.email').focus();
}

function emailPassword(name, email, pass) {
    calcTime = new Date().getTime();
    //showLoader();
    $.ajax({
        url: "post_json_email_password.php",
        type: 'POST',
        dataType: 'json',
        data: {
            calcTime: calcTime,
            schemaID: "incraft",
            name: name,
            email: email,
            pass: pass
        },
        success: function (data) {
            showToast("Пароль выслан на почту");
        },
        error: function (data) {
            showToast("Ошибка при отправке почты");
        },
    });
}

function tryPasswordRestore() {

    var thereAreEmptyFields = checkForEmptyFields("password-restore-dialog");
    if(thereAreEmptyFields) {
        var errMsg = "Заполните пожалуйста все поля";
        var html =
            `<div class="error-msg">
             <span>${errMsg}</span>
        </div>`;

        $(".password-restore-dialog .content-subwrapper .error-msg").remove();
        $(html).insertBefore(".password-restore-dialog .content-subwrapper .input-1");
        return;
    }

    var calcTime = new Date().getTime();
    var email = $(".password-restore-dialog .email").val();

    $.ajax({
        url: "post_json_password_restore.php",
        type: 'POST',
        dataType: 'json',
        data: {
            calcTime: calcTime,
            email: email,
            schemaID: "incraft"
        },
        success: function (data) {

            if (data["calcTime"] == calcTime) {
                if(data["status"] == false) {
                    var errMsg = data["error"];
                    var html =
                        `<div class="error-msg">
                         <span>${errMsg}</span>
                    </div>`;

                    $(".password-restore-dialog .content-subwrapper .error-msg").remove();
                    //$(".login-dialog .content-subwrapper").prepend(html);
                    $(html).insertBefore(".password-restore-dialog .content-subwrapper .input-1");
                } else {
                    closePasswordRestore();

                    let nameFixed = data["name"];
                    let emailFixed = data["email"];
                    let passFixed = data["pass"]; 
                    emailPassword(nameFixed, emailFixed, passFixed);
                }
            }
        },
        error: function (data) {
            alert("Error tryPasswordRestore()");
        },
    });
}

function closePasswordRestore() {
    $(".password-restore-dialog").slideToggle("medium", function () {
        $(".password-restore-wrapper").removeClass("visible");
        $('body').removeClass("overflow-hidden");
        //$('.name').focus();
    });
}