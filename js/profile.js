const ACCOUNT_ACTIVE = 0;
const ACCOUNT_SUSPENDED = 1;

var userID;
var profile = {};
var shop = {};

function updateCmdAccountStatus(status) {
    let accountCmdText = "";
    let statusNext; //as we toggle status
    switch (status) {
        case ACCOUNT_SUSPENDED:
            accountCmdText = "Возобновить действие аккаунта";
            statusNext = ACCOUNT_ACTIVE;
            break;
        case ACCOUNT_ACTIVE:
            accountCmdText = "Приостановить действие аккаунта";
            statusNext = ACCOUNT_SUSPENDED;
            break;
        default:
            break;
    }

    $(".cmd-account-status.suspend-account span").html(accountCmdText);
    $(".cmd-account-status").data("value", statusNext);
    console.log(accountCmdText);
}

async function getUserProfile(userID) {

    let response = await fetch(`get_json_user_profile.php?userID=${userID}`)
        .catch(e => {
            console.log('Error: ' + e.message);
        });

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }

    let profile = await response.json();
    return profile;
}

async function showProfile(userID) {
    profile = await getUserProfile(userID)
        .catch(e => {
            console.log('There has been a problem with your fetch operation: ' + e.message);
        });

    let name = profile["Name"];
    let dateRegisteredUnfixed = profile["DateRegistered"];
    let dateRegistered = dateToString(dateRegisteredUnfixed);
    let email = profile["Email"];
    let phone = profile["Phone"];
    let photo = profile["Photo"];
    photo = photo == "" ? "img/account.svg" : photo;

    let visibility = profile["Visibility"];
    let receiveMsgFromVisitors = profile["ReceiveMsgFromVisitors"];
    let receiveMsgFromSystem = profile["ReceiveMsgFromSystem"];
    let receiveMsgFromFavouriteShops = profile["ReceiveMsgFromFavouriteShops"];
    let receiveNewOrderNotifications = profile["ReceiveNewOrderNotifications"];

    $(".input-name").val(name);
    $(".date-registered span").html(`На портале с  ${dateRegistered}`);
    $(".input-email").val(email);
    $(".input-phone").val(phone);
    $(`input[name='visibility-option'][value='${visibility}']`).prop('checked', true);

    $(".rcv-msg-from-visitors").prop("checked", receiveMsgFromVisitors);
    $(".rcv-msg-from-system").prop("checked", receiveMsgFromSystem);
    $(".rcv-msg-from-favourite-shops").prop("checked", receiveMsgFromFavouriteShops);
    $(".rcv-new-order-notifications").prop("checked", receiveNewOrderNotifications);

    $(".photo").attr("src", photo);

    let accountStatus = profile["AccountStatus"];
    updateCmdAccountStatus(accountStatus);

    if (profile["Shops"].length > 0) {
        $('.page-1-no-shops').hide();
        $('.page-1-has-shops').show();
        showShops();
    } else {
        $('.page-1-has-shops').hide();
        $('.page-1-no-shops').show();
    }

    $(".cmd-publish").css("visibility", "hidden");
    console.log(profile);
}

function showShops() {
    let shops = profile["Shops"];
    let html = "";

    let num = 0;
    for (let shop of shops) {

        html +=
            `<div class="item" onclick="editShop(${num})">
                <img src="${shop["Photo"]}" />
                <div class="info">
                    <div class="name-desc">
                        <span class="name">${shop["Name"]}</span>
                        <span class="desc"></span>
                    </div>
                </div>
            </div>`;
        num++;
    }

    $(".page-1-has-shops .container").html(html);
}

function editShop(num) {
    let shops = profile["Shops"];
    shop = shops[num];

    let shopName = shop["Name"];
    let phone = shop["Phone"];

    let region = shop["Region"];
    let district = shop["District"];
    let address = shop["Address"];

    let photo = shop["Photo"];

    $(".page-1-shop-edit").css("display", "flex");
    $(".input-shop-name").val(shopName);
    $(".input-shop-address").val(address);
    $(".input-shop-phone").val(phone);

    $(".tabs-1-wrapper .page-1-has-shops").hide();
    //$(".tabs-1-wrapper .page-1-shop-edit").show();

    $(".cmd-publish").css("visibility", "visible");

    $(".icon-edit").each(function () {
        let control = $(this).data("control");
        $(`.${control}`).attr("readonly", true);
        $(`.${control}`).removeClass("input-border");
    });

    $(".photo-content").attr("src", photo);
}

async function updateAvatar(obj) {
    let file = $(obj)[0].files[0];
    let field = $(obj).data("field");

    let myFormData = new FormData();
    myFormData.append('file', file);
    myFormData.append('schemaID', "incraft");

    let response = await fetch(`post_json_upload_file.php`, {
        method: "POST",
        //headers: {
        //    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        //},
        body: myFormData
    });

    let data = await response.json();

    if (!response.ok) {
        throw new Error(data.message);
    }

    let photo = `files/${file.name}?ver=` + new Date().getTime();
    profile[field] = photo;
    $(".photo").attr("src", photo);
}

async function updatePhoto(obj) {
    let file = $(obj)[0].files[0];
    let field = $(obj).data("field");

    let myFormData = new FormData();
    myFormData.append('file', file);
    myFormData.append('schemaID', "incraft");

    let response = await fetch(`post_json_upload_file.php`, {
        method: "POST",
        //headers: {
        //    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        //},
        body: myFormData
    });

    let data = await response.json();

    if (!response.ok) {
        throw new Error(data.message);
    }

    let photo = `files/${file.name}?ver=` + new Date().getTime();
    shop[field] = photo;
    $(".photo-content").attr("src", photo);
}

async function saveShop() {

    var params = {
        shop: JSON.stringify(shop),
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_shop_create.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k, v]) => { return k + '=' + v }).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        showToast(data.message);
        throw new Error(data.message);
    } else {

        shop["ID"] = data["shop"]["ID"];

        let message = "<p>Поздравляем с успешным созданием магазина. Добавьте товары для успешного начала работы.</p><p>После добавления товаров необходимо опубликовать магазин. Магазины без товаров не отображаются в поиске.</p>";
        showToastCustom("toast-wrapper-custom", message);

        $(`.toast-custom .command-close`).bind('click', function (e) {
            $(".toast-wrapper-custom").removeClass("visible");
            $('body').removeClass("overflow-hidden");
        });

        $(`.toast-custom .content .button`).bind('click', function (e) {
            $(".toast-wrapper-custom").removeClass("visible");
            $('body').removeClass("overflow-hidden");
            editFirstShop();
        });
    }
}

function editFirstShop() {
    $(".tabs-1-wrapper .page-1").css("display", "block");
    $(".tabs-1-wrapper .page-2").css("display", "none");

    $(".page-1-no-shops").hide();
    $(".page-1-shop-edit").css("display", "flex");

    profile["Shops"] = [shop];
    editShop(0);
}

async function saveProfile() {
    var params = {
        profile: JSON.stringify(profile),
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_profile_update.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k, v]) => { return k + '=' + v }).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        showToast(data.message);
        throw new Error(data.message);
    }

    //revert back input controls to read only state
    $(".icon-edit").each(function () {
        let control = $(this).data("control");
        $(`.${control}`).attr("readonly", true);
        $(`.${control}`).removeClass("input-border");
    });

    showToast("Профиль обновлен");
}

function createShop(shop) {
    $(".tabs-1-wrapper .page-1").css("display", "none");
    $(".tabs-1-wrapper .page-2").css("display", "flex");

    $(".icon-edit").each(function () {
        let control = $(this).data("control");
        $(`.${control}`).attr("readonly", false);
        //$(`.${control}`).removeClass("input-border");
    });
}

function setupHandlers() {

    $(".icon-edit").click(function () {
        let control = $(this).data("control");
        $(`.${control}`).attr("readonly", false);
        $(`.${control}`).addClass("input-border");
        $(`.${control}`).focus();
    });

    $(".tabs-3 .data .input").on("input", function () {
        let field = $(this).data("field");
        let newValue = $(this).val();
        profile[field] = newValue;
    });

    $("input[name='visibility-option']").change(function (event) {
        let field = $(this).data("field");
        let newValue = $(this).val();
        profile[field] = parseInt(newValue);
    });

    $(".rcv-msg").change(function () {
        let field = $(this).data("field");
        let newValue = $(this).prop("checked");
        profile[field] = newValue;
    });

    $(".cmd-account-status").click(function () {
        let field = $(this).data("field");
        let newValue = $(this).data("value");
        profile[field] = newValue;

        updateCmdAccountStatus(newValue);
    });

    $(".button-edit").click(function () { // select an avatar
        $(".new-avatar").click();
    });

    $(".new-avatar").on("input", function () { //upload an avatar
        updateAvatar(this);
    });

    $(".tabs-3 .save-button").click(function () {
        saveProfile();
    });

    // create a shop handlers
    $(".tabs-1-wrapper .save-button").click(function () {
        saveShop();
    });

    $(".cmd-shop-create").click(function () {
        shop = { UserID: userID };
        createShop(shop);
    });

    $(".tabs-1-wrapper .page-2 .input").on("input", function () {
        let field = $(this).data("field");
        let newValue = $(this).val();
        shop[field] = newValue;
    });

    $(".tabs-1-wrapper .page-1-shop-edit .input").on("input", function () {
        let field = $(this).data("field");
        let newValue = $(this).val();
        shop[field] = newValue;
    });

    $("input[name='category']").change(function (event) {
        let field = $(this).data("field");
        let newValue = $(this).val();
        shop[field] = parseInt(newValue);
    });

    $(".shop-data").change(function () {
        let field = $(this).data("field");
        let newValue = $(this).prop("checked");
        shop[field] = newValue;
    });

    $(".cmd-publish").click(function (event) {
        publishShop();
    });

    $(".button-edit-photo").click(function () { // select an avatar
        $(".new-photo").click();
    });

    $(".new-photo").on("input", function () { //upload an avatar
        updatePhoto(this);
    });

    $(".goods-edit-command-add").click(function() { // login/logout
        showGoodEdit();
    });

    $(".good-edit-dialog .cancel").click(function() {
        closeGoodEdit();
    });

    $(".good-edit-dialog .content-wrapper .input.input-1").click(function(event) {
        let className = event.currentTarget.className;
        $(`div[class='${className}'] input`).focus();
    });

    $(".good-edit-dialog .content-wrapper .input.input-3").click(function(event) {
        let className = event.currentTarget.className;
        $(`div[class='${className}'] input`).focus();
    });

    $(".good-edit-dialog .content-wrapper .input.input-2").click(function(event) {
        let className = event.currentTarget.className;
        $(`div[class='${className}'] select`).focus();
    });

    $(".good-edit-dialog .content-wrapper .input.input-4").click(function(event) {
        let className = event.currentTarget.className;
        $(`div[class='${className}'] textarea`).focus();
    });

    $(".upload-photo-button").click(function () { // select a photo
        $(".good-photo").click();
    });

    $(".good-photo").on("input", function () { //upload a photo
        updateGoodPhoto(this);
    });

}

async function publishShop() {
    shop["IsPublished"] = "1";

    var params = {
        shop: JSON.stringify(shop),
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_shop_update.php`, {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: Object.entries(params).map(([k, v]) => { return k + '=' + v }).join('&')
    });

    let data = await response.json();

    if (!response.ok) {
        showToast(data.message);
        throw new Error(data.message);
    } else {
        let message = "Магазин опубликован";
        showToast(message);

        $(".tabs-1-wrapper .page-1-shop-edit").hide();
        $(".tabs-1-wrapper .page-1-has-shops").show();
        $(".cmd-publish").css("visibility", "hidden");

        showShops();
    }
}

$(document).ready(function () {

    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();
    setupHandlers();

    userID = restoreUser();
    //showProfile("hello");
    showProfile(userID);

    $(".tabs").tabs({
        active: 2,
        activate: function (event, ui) {
            let act = $(".tabs").tabs("option", "active");
            if (act == 0 && $(".page-1-shop-edit").css("display") == "flex") {
                $(".cmd-publish").css("visibility", "visible");
            } else if (act == 1 || act == 2) {
                $(".cmd-publish").css("visibility", "hidden");
            }
        }
    });
});