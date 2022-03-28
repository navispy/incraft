var calcTime;

var regions = [];
var districts = [];
var materials = [];
var scope = [];

function filterDistricts() {
    let region = $(".cb-region option:selected").text();

    var html = "<option disabled selected>Район</option>";
    html += "<option>Все</option>";

    if (region == "Все" || region == "Область") {
        $(".cb-district").html(html);
        return;
    }

    let regionDistricts = districts[region];

    for (var i = 0; i < regionDistricts.length; i++) {
        let district = regionDistricts[i];
        let name = district["district"];
        let num = i + 1;

        html += `<option value="${num}">${name}</option>`;
    }

    $(".cb-district").html(html);
}

function updateRegionCombo(regions) {
    var html = "<option disabled selected>Область</option>";
    html += "<option>Все</option>";

    for (var i = 0; i < regions.length; i++) {
        let region = regions[i];
        let name = region["region"];
        let num = region["num"];

        html += `<option value="${num}">${name}</option>`;
    }

    $(".cb-region").html(html);

    html = "<option disbaled selected>Район</option>";
    $(".cb-district").html(html);
}

function updateMaterialCombo(recs) {
    var numRecs = recs.length;
    var html = `<option>Любой (всего ${numRecs})</option>`;

    for (var i = 0; i < recs.length; i++) {
        let rec = recs[i];
        let name = rec["Name"];
        let num = i + 1;
        html += `<option value="${num}">${name}</option>`;
    }

    $(".cb-material").html(html);
}

function updateScopeCombo(recs) {
    var numRecs = recs.length;
    var html = `<option>Любая (всего ${numRecs})</option>`;

    for (var i = 0; i < recs.length; i++) {
        let rec = recs[i];
        let name = rec["Name"];
        let num = i + 1;
        html += `<option value="${num}">${name}</option>`;
    }

    $(".cb-scope").html(html);
}

function initUI(toFilter) {
    toFilter = toFilter == undefined ? true : toFilter;
    var calcTime = new Date().getTime();

    $.ajax({
        url: "post_json_catalogs.php",
        type: 'POST',
        dataType: 'json',
        data: {
            calcTime: calcTime,
            schemaID: "incraft"
        },
        success: function (data) {

            if (data["calcTime"] == calcTime) {
                regions = data["regions"];
                districts = data["districts"];
                materials = data["materials"];
                scope = data["scope"];

                updateRegionCombo(regions);
                updateMaterialCombo(materials);
                updateScopeCombo(scope);
            }
        },
        error: function (data) {
            alert("Error initUI()");
        },
    });

}

$(document).ready(function () {
    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();

    restoreUser();

    $(".item").click(function () {
        window.location.assign(`item.php`);
    });

    $(".main-filter .price .slider").slider({
        range: true,
        min: 0,
        max: 10000,
        values: [0, 10000],
        slide: function (event, ui) {

        }
    });

    initUI();

    $(".cb-region").on('change', function () {
        filterDistricts();
    });

})
