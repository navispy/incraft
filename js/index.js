var calcTime;

var regions = [];
var districts = [];
var materials = [];
var scope = [];

$(document).ready(function() {
    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();

    restoreUser();

    $(".item").click(function() {
        window.location.assign(`item.php`);
    });

    initUI();

    setupSearcHandlers();

    search(true);
})