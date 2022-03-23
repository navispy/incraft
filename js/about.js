const ACCOUNT_ACTIVE = 0;
const ACCOUNT_SUSPENDED = 1;

var userID;
var profile = {};
var shop = {};

$(document).ready(function() {

    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();

    restoreUser();
});