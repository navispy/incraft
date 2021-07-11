function checkForEmptyFields(dialog) {
    var thereAreEmptyFields = false;
    $(`.${dialog} input`).each(function (i, obj) {
        let objValue = $(obj).val();
        thereAreEmptyFields = thereAreEmptyFields || objValue.trim() == "";
        console.log(objValue);
    });

    return thereAreEmptyFields;
}

function restoreUser() {
    let userName = window.sessionStorage.getItem("userName");
    if (userName !== null) {
        $("span[class='login']").html("Выход");
                    
        let photoURL = window.sessionStorage.getItem("userPhoto");
        photoURL = photoURL == "" ? "img/account.svg" : photoURL;

        $(".login-commands-user").attr("src", photoURL);
        $(".login-commands-user").css("visibility", "visible");
    }
}