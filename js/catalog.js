var calcTime;

var regions = [];
var districts = [];
var materials = [];
var scope = [];

function setupLocalHandlers() {
    $(".item").click(function () {
        window.location.assign(`item.php`);
    });
}

function restoreFilters() {
    let filterControlsJSON = window.sessionStorage.getItem("filterControls");

    if(filterControlsJSON == null) {
        return;
    }

    let filterControls = JSON.parse(filterControlsJSON);
    let priceFromUnfixed = filterControls["price-from"];
    let priceToUnfixed = filterControls["price-to"];
    let material = filterControls["material"];
    let scope = filterControls["scope"];
    let region = filterControls["region"];
    let district = filterControls["district"];
    let bychowOnly = filterControls["bychow-only"];

    let priceFrom = parseInt(priceFromUnfixed);
    let priceTo = parseInt(priceToUnfixed);

    $('.range .from').val(priceFrom);
    $('.range .to').val(priceTo);

    $('.chk-00').prop("checked", bychowOnly);

    setComboByText("cb-material", material);
    setComboByText("cb-scope", scope);
    setComboByText("cb-region", region);
    filterDistricts();
    setComboByText("cb-district", district);
}


$(document).ready(function () {
    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();

    restoreUser();

    initUI().then(function () {
        setupLocalHandlers();
        setupSearchHandlers();

        try {
            restoreFilters();
        } catch (e) {
            console.log(e);
        }
        search(true);
    });
})