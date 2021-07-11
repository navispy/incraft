$(document).ready(function () {
    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();

    restoreUser();
});