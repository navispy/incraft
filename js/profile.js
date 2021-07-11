$(document).ready(function () {
    alert("profile.js");
    
    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();

    restoreUser();
});