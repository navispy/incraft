var calcTime;

var regions = [];
var districts = [];
var materials = [];
var scope = [];

function setupLocalHandlers() {
    $(".item").click(function() {
        window.location.assign(`item.php`);
    });

    $(".block.search").click(function() {
        let filterControls = {};
        filterControls["price-from"] = $('.range .from').val();
        filterControls["price-to"] = $('.range .to').val();
        filterControls["material"] = $(".cb-material option:selected").text();
        filterControls["scope"] = $(".cb-scope option:selected").text();
        filterControls["region"] = $(".cb-region option:selected").text();
        filterControls["district"] = $(".cb-district option:selected").text();
        filterControls["bychow-only"] = $(".chk-00").is(":checked");

        window.sessionStorage.setItem("filterControls", JSON.stringify(filterControls));
        window.location.assign(`catalog.php`);
    });
}

$(document).ready(function() {
    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();

    restoreUser();

    initUI();

    setupLocalHandlers();
    setupSearcHandlers();

    search(true);
})