var goods = [];
var goods_top = [];
var goods_top_window = [0, 1, 2];

var goods_latest = [];

var shops_top = [];
var shops_top_window = [0, 1, 2];

var feedback_latest = [];
var feedback_latest_goods = [];
var feedback_latest_index = 0;

function checkForEmptyFields(dialog) {
    var thereAreEmptyFields = false;
    $(`.${dialog} input`).each(function(i, obj) {
        let objValue = $(obj).val();
        thereAreEmptyFields = thereAreEmptyFields || objValue.trim() == "";
    });

    return thereAreEmptyFields;
}

function restoreUser() {
    let userName = window.sessionStorage.getItem("userName");
    let userID = window.sessionStorage.getItem("userID");

    if (userName !== null) {
        $("span[class='login']").html("Выход");

        let photoURL = window.sessionStorage.getItem("userPhoto");
        photoURL = photoURL == "" ? "img/account.svg" : photoURL;

        $(".login-commands-user").attr("src", photoURL);
        $(".login-commands-user").css("visibility", "visible");
        $(".profile-command").css("visibility", "visible");
    }

    return userID;
}

function dateToString(str) {

    var d = str.substr(8, 2);
    var m = str.substr(5, 2);
    var y = str.substr(0, 4);

    var months = ["января", "февраля", "марта", "апреля", "мая", "июня",
        "июля", "августа", "сентября", "октября", "ноября", "декабря"
    ];

    var mmmm = months[m - 1];

    return d + " " + mmmm + " " + y;
}

function showToast(str) {
    $('html, body').animate({
        scrollTop: $(".header").offset().top
    }, 100);

    $(".toast-wrapper").addClass("visible");
    $('body').addClass("overflow-hidden");
    $('.toast span').html(str).fadeIn(1000).delay(1000).fadeOut('medium', function() {
        $(".toast-wrapper").removeClass("visible");
        $('body').removeClass("overflow-hidden");
    });
}

function showToastCustom(wrapperClass, message) {
    $('html, body').animate({
        scrollTop: $(".header").offset().top
    }, 100);

    $(`.${wrapperClass}`).addClass("visible");
    $('body').addClass("overflow-hidden");
    $('.toast-custom .message').html(message);;
}

async function search(toDisplay = true) {
    let filters = {};

    let min = $(".range .from").val();
    let max = $(".range .to").val();

    filters["Price"] = { "operator": "BETWEEN", "value1": parseInt(min), "value2": parseInt(max) };

    let material = $(".cb-material").val();

    if (parseInt(material) !== 0 && material !== null) {
        filters["Material"] = { "operator": "EQUAL", "value1": parseInt(material), "value2": "" };
    }

    let scope = $(".cb-scope").val();

    if (parseInt(scope) !== 0 && scope !== null) {
        filters["getScope(Shop)"] = { "operator": "EQUAL", "value1": parseInt(scope), "value2": "" };
    }

    let region_text = $(".cb-region option:selected").text();
    let region = $(".cb-region option:selected").val();

    if (region_text !== "Все" && region_text !== "Область") {
        filters["getRegion(Shop)"] = { "operator": "EQUAL", "value1": parseInt(region), "value2": "" };
    }

    let district_text = $(".cb-district option:selected").text();
    let district = $(".cb-district option:selected").val();

    if (district_text !== "Все" && district_text !== "Район") {
        filters["getDistrict(Shop)"] = { "operator": "EQUAL", "value1": parseInt(district), "value2": "" };
    }

    let availability = $(".cb-availability").val();

    if (parseInt(availability) !== -1) {
        filters["IsAvailable"] = { "operator": "EQUAL", "value1": parseInt(availability), "value2": "" };
    }

    var params = {
        filters: JSON.stringify(filters),
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_goods_search.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k, v]) => { return k + '=' + v }).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        throw new Error(data.message);
    }

    //alert(data["goods"].length);

    goods = data["goods"];
    $(".block.search").html(`<span>Найдено ${goods.length} предложений</span`);

    if (toDisplay) {
        showGoods(goods);
    }
}

function showGoods(goods) {

    let html = "";
    let num = 0;
    for (let good of goods) {
        let ID = good["ID"];
        let nameUnfixed = good["Name"];
        let name = nameUnfixed.substr(0, 15) + "...";
        let descUnfixed = good["Description"];
        let desc = descUnfixed.substr(0, 20) + "...";
        let shopName = good["ShopName"];
        let price = good["Price"];
        let priceText = price == 0 ? "цена договорная" : `${price} руб`;
        let photoJSON = good["PhotoJSON"];
        let photos = JSON.parse(photoJSON);
        let photo = photos[0];

        let item_html =
            `<div data-num="${num}" class="item item-${ID}">
            <img src="${photo}" />
            <div class="info">
                <div class="name-desc">
                    <span class="name">${name}</span>
                    <span class="desc">${desc}</span>
                </div>
                <div class="price">
                    <span class="shop-name">${shopName}</span>
                    <span class="value">${price} руб</span>
                </div>
            </div>
        </div>`;

        html += item_html;
        num++;
    }
    $(".catalog-content .container").html(html);

    //bind click event
    for (let good of goods) {
        let ID = good["ID"];

        $(`.item-${ID}`).bind('click', function(e) {
            let num = $(this).data("num");
            let good = goods[num];
            window.sessionStorage.setItem("good", JSON.stringify(good));
            window.location.assign("item.php");
        });
    }
}

function showTop10Goods() {

    let html = "";

    for (let index of goods_top_window) {
        let good = goods_top[index];
        let ID = good["ID"];
        let nameUnfixed = good["Name"];
        let name = nameUnfixed.substr(0, 15) + "...";
        let descUnfixed = good["Description"];
        let desc = descUnfixed.substr(0, 20) + "...";
        let shopName = good["ShopName"];
        let price = good["Price"];
        let priceText = price == 0 ? "цена договорная" : `${price} руб`;
        let photoJSON = good["PhotoJSON"];
        let photos = JSON.parse(photoJSON);
        let photo = photos[0];

        let item_html =
            `<div data-num="${index}" class="item item-${ID}">
            <img src="${photo}" />
            <div class="info">
                <div class="name-desc">
                    <span class="name">${name}</span>
                    <span class="desc">${desc}</span>
                </div>
                <div class="price">
                    <span class="shop-name">${shopName}</span>
                    <span class="value">${price} руб</span>
                </div>
            </div>
        </div>`;

        html += item_html;
    }
    $(".main .top-10 .container").html(html);

    //bind click event
    for (let index of goods_top_window) {
        let good = goods_top[index];
        let ID = good["ID"];

        $(`.item-${ID}`).bind('click', function(e) {
            let num = $(this).data("num");
            let good = goods[num];
            window.sessionStorage.setItem("good", JSON.stringify(good));
            window.location.assign("item.php");
        });
    }
}

function setComboByText(combo, text) {
    $(`.${combo} option:contains(${text})`).attr('selected', 'selected');
    let selIndex = $(`.${combo} option:contains(${text})`).index();
    $(`.${combo}`).prop("selectedIndex", selIndex);
}

function showBychowOnly() {
    if ($(".chk-00").is(":checked")) {

        let region = "Могилевская";

        setComboByText("cb-region", region);

        filterDistricts();

        let district = "Быховский";
        setComboByText("cb-district", district);
    }

    search();
}

function setupSearcHandlers() {
    $(".main-filter .price .slider").slider({
        range: true,
        min: 0,
        max: 10000,
        values: [0, 10000],
        slide: function(event, ui) {
            let a = ui.values[0];
            let b = ui.values[1];

            let prev_a = $(".range .from").val();
            let prev_b = $(".range .to").val();

            if (parseInt(prev_a) !== a) {
                $(".range .from").val(a);
                search();
            }

            if (parseInt(prev_b) != b) {
                $(".range .to").val(b);
                search();
            }
        }
    });

    let a = $(".main-filter .price .slider").slider("values", 0);
    let b = $(".main-filter .price .slider").slider("values", 1);

    $(".range .from").val(a);
    $(".range .to").val(b);

    $(".range .from").bind("input", function() {
        let min = $(".range .from").val();
        let max = $(".range .to").val();

        $(".main-filter .price .slider").slider("values", 0, parseInt(min));
        $(".main-filter .price .slider").slider("values", 1, parseInt(max));
        //$(".main-filter .price .slider").slider('refresh');

        search();
    });

    $('.range .to').bind("input", function() {
        let min = $(".range .from").val();
        let max = $(".range .to").val();

        $(".main-filter .price .slider").slider("values", 0, parseInt(min));
        $(".main-filter .price .slider").slider("values", 1, parseInt(max));
        //$(".main-filter .price .slider").slider('refresh');

        search();
    });

    $('.chk-00').click(function() {
        showBychowOnly();
    });

    $('.block.search').click(function() {
        //alert("display results");
    });

    $(".cb-region").on('change', function() {
        search();
        filterDistricts();
    });

    $(".cb-district").on('change', function() {
        search();
    });

    $(".cb-material").on('change', function() {
        search();
    });

    $(".cb-scope").on('change', function() {
        search();
    });

    $(".cb-availability").on('change', function() {
        search();
    });

}

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
        let num = district["ID"];

        html += `<option value="${num}">${name}</option>`;
    }

    $(".cb-district").html(html);
}

function updateRegionCombo(regions) {
    var html = "<option disabled selected>Область</option>";
    html += "<option value=0>Все</option>";

    for (var i = 0; i < regions.length; i++) {
        let region = regions[i];
        let name = region["region"];
        let num = region["ID"];

        html += `<option value="${num}">${name}</option>`;
    }

    $(".cb-region").html(html);

    html = "<option disbaled selected>Район</option>";
    $(".cb-district").html(html);
}

function updateMaterialCombo(recs, control) {
    var numRecs = recs.length;
    var html = `<option value=0>Любой (всего ${numRecs})</option>`;

    for (var i = 0; i < recs.length; i++) {
        let rec = recs[i];
        let name = rec["Name"];
        let num = rec["ID"];
        html += `<option value="${num}">${name}</option>`;
    }

    $(control).html(html);
}

function updateScopeCombo(recs) {
    var numRecs = recs.length;
    var html = `<option value=0>Любая (всего ${numRecs})</option>`;

    for (var i = 0; i < recs.length; i++) {
        let rec = recs[i];
        let name = rec["Name"];
        let num = rec["ID"];
        html += `<option value="${num}">${name}</option>`;
    }

    $(".cb-scope").html(html);
}

async function initUI(toFilter) {
    toFilter = toFilter == undefined ? true : toFilter;
    let calcTime = new Date().getTime();

    let params = {
        calcTime: calcTime,
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_catalogs.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k, v]) => { return k + '=' + v }).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        throw new Error(data.message);
    }

    regions = data["regions"];
    districts = data["districts"];
    materials = data["materials"];
    scope = data["scope"];

    updateRegionCombo(regions);
    updateMaterialCombo(materials, ".cb-material");
    updateScopeCombo(scope);

    return data;
}

async function getMaterials() {
    let calcTime = new Date().getTime();

    let params = {
        calcTime: calcTime,
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_catalogs.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k, v]) => { return k + '=' + v }).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        throw new Error(data.message);
    }

    let recs = data["materials"];

    return recs;
}

async function getTop10Goods() {
    let calcTime = new Date().getTime();

    let params = {
        calcTime: calcTime,
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_goods_top.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k, v]) => { return k + '=' + v }).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        throw new Error(data.message);
    }

    goods_top = data["goods"];
    goods_top_window = [0, 1, 2];

    showTop10Goods();
}

async function getTop10Shops() {
    let calcTime = new Date().getTime();

    let params = {
        calcTime: calcTime,
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_shops_top.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k, v]) => { return k + '=' + v }).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        throw new Error(data.message);
    }

    shops_top = data["shops"];
    shops_top_window = [0, 1, 2];

    showTop10Shops();
}

function showTop10Shops() {

    let html = "";

    for (let index of shops_top_window) {
        let shop = shops_top[index];
        let ID = shop["ID"];
        let nameUnfixed = shop["Name"];
        let name = nameUnfixed; //nameUnfixed.substr(0, 15) + "...";
        //let descUnfixed = shop["Description"];
        let desc = ""; //descUnfixed.substr(0, 20) + "...";
        let photo = shop["Photo"];

        let item_html =

            `<div data-num="${index}" class="item shop-${ID}">
            <img src="${photo}" />
            <div class="info">
                <div class="name-desc">
                    <span class="name">${name}</span>
                    <span class="desc">${desc}</span>
                </div>
            </div>
        </div>`;

        html += item_html;
    }
    $(".main .top-10-craftsmen .container").html(html);

    //bind click event
    for (let index of shops_top_window) {
        let shop = shops_top[index];
        let ID = shop["ID"];

        $(`.shop-${ID}`).bind('click', function(e) {
            let num = $(this).data("num");
            let shop = shops_top[num];
            console.log(num);
            //window.sessionStorage.setItem("good", JSON.stringify(good));
            //window.location.assign("item.php");
        });
    }
}

async function getLatestGoods() {
    let calcTime = new Date().getTime();

    let params = {
        calcTime: calcTime,
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_goods_latest.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k, v]) => { return k + '=' + v }).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        throw new Error(data.message);
    }

    goods_latest = data["goods"];

    showLatestGoods();
}

function showLatestGoods() {

    let html = "";
    let num = 0;
    for (let good of goods_latest) {
        let ID = good["ID"];
        let nameUnfixed = good["Name"];
        let name = nameUnfixed.substr(0, 15) + "...";
        let descUnfixed = good["Description"];
        let desc = descUnfixed.substr(0, 20) + "...";
        let shopName = good["ShopName"];
        let price = good["Price"];
        let priceText = price == 0 ? "цена договорная" : `${price} руб`;
        let photoJSON = good["PhotoJSON"];
        let photos = JSON.parse(photoJSON);
        let photo = photos[0];

        let item_html =
            `<div data-num="${num}" class="item item-latest-${ID}">
            <img src="${photo}" />
            <div class="info">
                <div class="name-desc">
                    <span class="name">${name}</span>
                    <span class="desc">${desc}</span>
                </div>
                <div class="price">
                    <span class="shop-name">${shopName}</span>
                    <span class="value">${price} руб</span>
                </div>
            </div>
        </div>`;

        html += item_html;
        num++;
    }
    $(".main .latest-works .container").html(html);

    //bind click event
    for (let good of goods_latest) {
        let ID = good["ID"];

        $(`.item-latest-${ID}`).bind('click', function(e) {
            let num = $(this).data("num");
            let good = goods_latest[num];
            window.sessionStorage.setItem("good", JSON.stringify(good));
            window.location.assign("item.php");
        });
    }
}

async function getLatestFeedback() {
    let calcTime = new Date().getTime();

    let params = {
        calcTime: calcTime,
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_feedback_latest.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k, v]) => { return k + '=' + v }).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        throw new Error(data.message);
    }

    feedback_latest = data["feedback"];
    feedback_latest_goods = data["goods"];
    feedback_latest_index = 0;

    showLatestFeedback();
}

function showLatestFeedback() {

    let feedback = feedback_latest[feedback_latest_index];
    let name = feedback["Name"];
    let comment = feedback["Comment"];
    let feeback_good = feedback_latest_goods[feedback_latest_index];
    
    let photoJSON = feeback_good["PhotoJSON"];
    let photos = JSON.parse(photoJSON);
    
    let photo = "";
    try {
        photo = photos[0];
    } catch (e) {

    }

    $(".latest-reviews .text-2").html(name);
    $(".latest-reviews .text-3").html(comment);
    $(".latest-reviews img").attr("src", photo);

    $(".latest-reviews img").data("num", feedback_latest_index);

    $(".latest-reviews img").bind('click', function(e) {
        let num = $(this).data("num");
        let feedback_good = feedback_latest_goods[num];
        window.sessionStorage.setItem("good", JSON.stringify(feedback_good));
        window.location.assign("item.php");
    });

}