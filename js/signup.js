function setupSignupHandlers() {
    $(".signup").click(function () {
        showSignup();
    });

    $(".register").click(function () {
        trySignup();
    });

    $(".signup-dialog .content-wrapper .input").click(function (event) {
        let className = event.currentTarget.className;
        $(`div[class='${className}'] input`).focus();
    });

    $(".signup-dialog .cancel").click(function () {
        closeSignup();
    });
}

function showSignup() {
    $(".login-wrapper").removeClass("visible");
    $(".login-dialog").hide();

    $(".signup-wrapper").addClass("visible");
    $(".signup-wrapper .error-msg").remove();
    $(".signup-dialog").slideToggle("medium");

    $('.name').focus();
}

function closeSignup() {
    $(".signup-dialog").slideToggle("medium", function () {
        $(".signup-wrapper").removeClass("visible");
        $('body').removeClass("overflow-hidden");
        //$('.name').focus();
    });
}

function email_credentials(name, email, pass, phone) {
    calcTime = new Date().getTime();
    //showLoader();
    $.ajax({
        url: "post_json_email_credentials.php",
        type: 'POST',
        dataType: 'json',
        data: {
            calcTime: calcTime,
            schemaID: "incraft",
            name: name,
            email: email,
            pass: pass,
            phone: phone
        },
        success: function (data) {
            if (data["status"] == "OK") {
            } else {
                alert(data["error"]);
            }
        },
        error: function (data) {
            alert("Ошибка при регистрации");
        },
    });
}

function trySignup() {

    var calcTime = new Date().getTime();
    var name = $(".signup-dialog .name").val();
    var pass = $(".signup-dialog .password").val();
    var email = $(".signup-dialog .email").val();
    var phone = $(".signup-dialog .phone").val();

    var thereAreEmptyFields = checkForEmptyFields("signup-dialog");
    if(thereAreEmptyFields) {
        var errMsg = "Заполните пожалуйста все поля";
        var html =
            `<div class="error-msg">
             <span>${errMsg}</span>
        </div>`;

        $(".signup-dialog .content-subwrapper .error-msg").remove();
        $(".signup-dialog .content-subwrapper").prepend(html);        
        return;
    }

    $.ajax({
        url: "post_json_signup.php",
        type: 'POST',
        dataType: 'json',
        data: {
            calcTime: calcTime,
            userName: name,
            userPass: pass,
            userEmail: email,
            userPhone: phone,
            schemaID: "incraft"
        },
        success: function (data) {

            if (data["calcTime"] == calcTime) {

                if (data["status"] == "OK") {
                    closeSignup();
                    email_credentials(name, email, pass, phone);
                } else if (data["status"] == "NOT OK") {
                    var errMsg = data["error"];
                    var html =
                        `<div class="error-msg">
                         <span>${errMsg}</span>
                    </div>`;

                    $(".signup-dialog .content-subwrapper .error-msg").remove();
                    $(".signup-dialog .content-subwrapper").prepend(html);
                }

            }
        },
        error: function (data) {
            alert("Error tryLogin()");
        },
    });
}