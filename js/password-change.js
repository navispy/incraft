function setupPasswordRestoreHandlers() {
    $(".password-change").click(function () {
        showPasswordChange();
    });

    $(".change").click(function () {
        tryPasswordChange(profile);
    });

    $(".password-change-dialog .content-wrapper .input").click(function (event) {
        let className = event.currentTarget.className;
        $(`div[class='${className}'] input`).focus();
    });

    $(".password-change-dialog .cancel").click(function () {
        closePasswordChange();
    });
}

function showPasswordChange() {
    $(".password-change-wrapper").addClass("visible");
    $(".password-change-dialog").slideToggle("medium", function () {
        $(".password-change-wrapper .error-msg").remove();
        $('.passwordname').focus();
        $('body').addClass("overflow-hidden");
    })
}


async function tryPasswordChange(profile) {
    let password = $(".password-change-dialog .password").val(); // new password
    profile["Password"] = password;
    var params = {
        profile: JSON.stringify(profile),
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_profile_update.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k,v])=>{return k+'='+v}).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        throw new Error(data.message);
    }

    closePasswordChange("Пароль изменен");
}

function closePasswordChange(str) {
    $(".password-change-dialog").slideToggle("medium", function () {
        $(".password-change-wrapper").removeClass("visible");
        $('body').removeClass("overflow-hidden");

        if(str !== undefined) {
            showToast(str);
        }
    });
}