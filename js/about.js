const ACCOUNT_ACTIVE = 0;
const ACCOUNT_SUSPENDED = 1;

var userID;
var profile = {};
var shop = {};

function emailContactComment(name, email, text) {
    calcTime = new Date().getTime();
    //showLoader();
    $.ajax({
        url: "post_json_email_contact_comment.php",
        type: 'POST',
        dataType: 'json',
        data: {
            calcTime: calcTime,
            schemaID: "incraft",
            name: name,
            email: email,
            text: text
        },
        success: function(data) {
            showToast("Сообщение умепшно отправлено");
        },
        error: function(data) {
            showToast("Ошибка при отправке сообщения");
        },
    });
}

function setupHandlers() {

    $(".contact-comment-send").click(function() {
        let name = $(".input-contact-name").val();
        let email = $(".input-contact-email").val();
        let text = $(".input-contact-comment").val();
        emailContactComment(name, email, text)
    });

}

$(document).ready(function() {

    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();
    setupHandlers();

    restoreUser();
});