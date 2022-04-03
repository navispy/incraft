function setupSigninHandlers() {
    $(".signin").click(function() {
        tryLogin();
    });

    $(".login-dialog .content-wrapper .input").click(function(event) {
        let className = event.currentTarget.className;
        $(`div[class='${className}'] input`).focus();
    });

    $(".login-dialog .cancel").click(function() {
        closeLogin();
    });

    $("span[class='login']").click(function() { // login/logout
        let userName = window.sessionStorage.getItem("userName");

        if (userName !== null) { //logout
            window.sessionStorage.removeItem("userName");
            $("span[class='login']").html("Вход");

            $(".login-commands-user").attr("src", "");
            $(".login-commands-user").css("visibility", "hidden");
            $(".profile-command").css("visibility", "hidden");

            let href = document.location.href;
            let lastPathSegment = href.substr(href.lastIndexOf('/') + 1);

            if (lastPathSegment !== "index.php") {
                window.location.assign("index.php");
            }
        } else { // login
            showLogin();
        }
    });

    $(".login-commands-user").click(function() { // show profile
        window.location.assign(`profile.php`);
    });

    $(".profile-command").click(function() { // show profile
        window.location.assign(`profile.php`);
    });

}

function showLogin() {
    $('html, body').animate({
        scrollTop: $(".header").offset().top
    }, 100);
    
    $(".login-wrapper").addClass("visible");
    $(".login-dialog").slideToggle("medium", function() {
        $(".login-wrapper .error-msg").remove();
        $('.name').focus();
        $('body').addClass("overflow-hidden");
    })
}

function closeLogin() {
    $(".login-dialog").slideToggle("medium", function() {
        $(".login-wrapper").removeClass("visible");
        $('body').removeClass("overflow-hidden");
    })
}

async function tryLogin() {
    var thereAreEmptyFields = checkForEmptyFields("login-dialog");
    if (thereAreEmptyFields) {
        var errMsg = "Заполните пожалуйста все поля";
        var html =
            `<div class="error-msg">
             <span>${errMsg}</span>
        </div>`;

        $(".login-dialog .content-subwrapper .error-msg").remove();
        $(html).insertBefore(".login-dialog .content-subwrapper .input-1");
        return;
    }

    var name = $(".login-dialog .name").val();
    var pass = $(".login-dialog .password").val();

    data = await checkLogin(name, pass)
        .catch(e => {
            let html =
                `<div class="error-msg">
             <span>${e.message}</span>
        </div>`;

            $(".login-dialog .content-subwrapper .error-msg").remove();
            $(html).insertBefore(".login-dialog .content-subwrapper .input-1");
        });

}
async function checkLogin(name, pass) {

    var params = {
        name: name,
        pass: pass,
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_login.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k, v]) => { return k + '=' + v }).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        throw new Error(data.message);
    }

    $("span[class='login']").html("Выход");

    let photoURL = data["photo"];
    photoURL = photoURL == "" ? "img/account.svg" : photoURL;

    $(".login-commands-user").attr("src", photoURL);
    $(".login-commands-user").css("visibility", "visible");
    $(".profile-command").css("visibility", "visible");
    
    closeLogin();

    let userID = data["userID"];

    window.sessionStorage.setItem("userID", userID);
    window.sessionStorage.setItem("userName", name);
    window.sessionStorage.setItem("userPhoto", photoURL);

    return data;
}