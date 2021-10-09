const ACCOUNT_ACTIVE = 0;
const ACCOUNT_SUSPENDED = 1;

var profile;

function updateCmdAccountStatus (status) {
    let accountCmdText = "";
    let statusNext; //as we toggle status
    switch(status) {
        case ACCOUNT_SUSPENDED:
            accountCmdText = "Возобновить действие аккаунта";
            statusNext = ACCOUNT_ACTIVE;
            break;
        case ACCOUNT_ACTIVE:
            accountCmdText = "Приостановит действие аккаунта";
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

    console.log(profile);
}

async function updateAvatar(obj) {
    let file = $(obj)[0].files[0];
    let field = $(obj).data("field");

    let myFormData = new FormData();
    myFormData.append('file', file);
    myFormData.append('schemaID', "incraft");

    let response = await fetch(`post_json_upload_avatar.php`, {
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
        body: Object.entries(params).map(([k,v])=>{return k+'='+v}).join('&')
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
 
     $("input[name='visibility-option']").change(function(event) {
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
 
     $(".save-button").click(function () {
         saveProfile();
     });

     $(".cmd-shop-create").click(function() {
        $(".tabs-1-wrapper .page-1").css("display", "none");
        $(".tabs-1-wrapper .page-2").css("display", "flex");
     });
}

$(document).ready(function () {

    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();
    setupHandlers();

    let userID = restoreUser();
    //showProfile("hello");
    showProfile(userID);

    $(".tabs").tabs({
        active: 2,
        activate: function (event, ui) {
        }
    });
});