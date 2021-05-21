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

function toggleLogin() {
    $(".login-wrapper").toggleClass("visible");
    $(".login-dialog").slideToggle("medium");

    if ($(".login-wrapper").hasClass("visible")) {
        $('.name').focus();
    }
    $('body').toggleClass("overflow-hidden");
}

function closeLogin() {
    $(".login-dialog").slideToggle("medium", function () {
        $(".login-wrapper").removeClass("visible");
        $('body').removeClass("overflow-hidden");
    });
}

function showSignup() {
    $(".login-wrapper").removeClass("visible");
    $(".login-dialog").hide();

    $(".signup-wrapper").addClass("visible");
    $(".signup-dialog").slideToggle("medium");

    $('.name').focus();
}

function closeSignup() {
    $(".signup-dialog").slideToggle("medium", function () {
        $(".signup-wrapper").removeClass("visible");
        $('.name').focus();
    });
}

function tryLogin() {
    var calcTime = new Date().getTime();

    alert(calcTime);
    return;

    $.ajax({
        url: "post_json_login.php",
        type: 'POST',
        dataType: 'json',
        data: {
            calcTime: calcTime,
            schemaID: "incraft"

        },
        success: function (data) {

            if (data["calcTime"] == calcTimeG) {

            }
        },
        error: function (data) {
            alert("Error tryLogin()");
        },
    });
}

function trySignup() {

    var calcTime = new Date().getTime();
    var name = $(".signup-dialog .name").val();
    var pass = $(".signup-dialog .password").val();
    var email = $(".signup-dialog .email").val();
    var phone = $(".signup-dialog .phone").val();

    $.ajax({
        url: "post_json_signup.php",
        type: 'POST',
        dataType: 'json',
        data: {
            calcTime: calcTime,
            userName: name,
            userPass: pass,
            userEmail: email,
            userPhone: phone,
            schemaID: "incraft"
        },
        success: function (data) {

            if (data["calcTime"] == calcTime) {
                closeSignup();
            }
        },
        error: function (data) {
            alert("Error tryLogin()");
        },
    });
}


$(document).ready(function () {
    $(".signin").click(function () {
        tryLogin();
    });

    $(".signup").click(function () {
        showSignup();
    });

    $(".register").click(function () {
        trySignup();
    });

    $(".login-dialog .content-wrapper .input").click(function (event) {
        let className = event.currentTarget.className;
        $(`div[class='${className}'] input`).focus();
    });

    $(".signup-dialog .content-wrapper .input").click(function (event) {
        let className = event.currentTarget.className;
        $(`div[class='${className}'] input`).focus();
    });

    $(".login-dialog .cancel").click(function () {
        closeLogin();
    });

    $(".signup-dialog .cancel").click(function () {
        closeSignup();
    });


    $("span[class='login']").click(function () {
        toggleLogin();
    });

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
