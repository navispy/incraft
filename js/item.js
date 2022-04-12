var good = {};
var goodShop = {};
var order = {};

async function getShop(ID) {

    var params = {
        ID: ID,
        schemaID: "incraft"
    }

    let response = await fetch(`post_json_shop.php`, {
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

    goodShop = data["shop"];
}

$(document).ready(function () {
    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();

    setupLocalHandlers();

    restoreUser();

    let goodJSON = window.sessionStorage.getItem("good");
    good = JSON.parse(goodJSON);
    let shopID = good["Shop"];

    getShop(shopID).then(function () {
        showGood(good);
    });
});

function setupLocalHandlers() {
    $(".price .qty").bind("input", function () {
        let priceUnfixed = good["Price"];
        let price = parseFloat(priceUnfixed);
        let qty = $(this).val();
        let cost = price * qty;

        $(".order .total").html(`<span>${cost} руб</span>`);
    });

    $(".order .button").bind("click", function () {
        editOrderDetails();
    });

    $(".order-details-dialog .cancel").bind("click", function () {
        closeOrderDetails();
    });

    $(".order .contact .phone").bind("click", function () {
        let phone = goodShop["Phone"];
        phone = phone === "" ? "телефон не указан" : phone;
        $(".order .contact .phone span").html(phone);
    });

    $("input[name='payment-methods']").change(function (event) {
        let paymentMethod = $(this).val();
        let displayMode = paymentMethod == "PaymentMethod_04" ? "flex" : "none";
        $(".order-details-dialog .options-credit-cards").css("display", displayMode);
    });
}

function editOrderDetails() {
    $('html, body').animate({
        scrollTop: $(".header").offset().top
    }, 100);

    $(".order-details-wrapper").addClass("visible");
    $(".order-details-dialog").slideToggle("medium", function () {
        $('body').addClass("overflow-hidden");
    });

    let paymentMethods = {};

    paymentMethods["PaymentMethod_01"] = goodShop["PaymentMethod_01"] === "1" ? "PaymentMethod_01" : "";
    paymentMethods["PaymentMethod_02"] = goodShop["PaymentMethod_02"] === "1" ? "PaymentMethod_02" : "";
    paymentMethods["PaymentMethod_03"] = goodShop["PaymentMethod_03"] === "1" ? "PaymentMethod_03" : "";
    paymentMethods["PaymentMethod_04"] = goodShop["PaymentMethod_04"] === "1" ? "PaymentMethod_04" : "";
    paymentMethods["PaymentMethod_05"] = goodShop["PaymentMethod_05"] === "1" ? "PaymentMethod_05" : "";
    paymentMethods["PaymentMethod_06"] = goodShop["PaymentMethod_06"] === "1" ? "PaymentMethod_06" : "";
    paymentMethods["PaymentMethod_07"] = goodShop["PaymentMethod_07"] === "1" ? "PaymentMethod_07" : "";

    for(let control in paymentMethods) {
        let displayMode = paymentMethods[control] === "" ? "none" : "flex";
        $(`.payment-wrapper .${control}`).css("display", displayMode);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    let deliveryOptions = {};

    deliveryOptions["DeliveryOption_01"] = goodShop["DeliveryOption_01"] === "1" ? "DeliveryOption_01" : "";
    deliveryOptions["DeliveryOption_02"] = goodShop["DeliveryOption_02"] === "1" ? "DeliveryOption_02" : "";
    deliveryOptions["DeliveryOption_03"] = goodShop["DeliveryOption_03"] === "1" ? "DeliveryOption_03" : "";
    deliveryOptions["DeliveryOption_04"] = goodShop["DeliveryOption_04"] === "1" ? "DeliveryOption_04" : "";
    deliveryOptions["DeliveryOption_05"] = goodShop["DeliveryOption_05"] === "1" ? "DeliveryOption_05" : "";
    deliveryOptions["DeliveryOption_06"] = goodShop["DeliveryOption_06"] === "1" ? "DeliveryOption_06" : "";
    deliveryOptions["DeliveryOption_07"] = goodShop["DeliveryOption_07"] === "1" ? "DeliveryOption_07" : "";
    deliveryOptions["DeliveryOption_08"] = goodShop["DeliveryOption_08"] === "1" ? "DeliveryOption_08" : "";

    for(let control in deliveryOptions) {
        let displayMode = deliveryOptions[control] === "" ? "none" : "flex";
        $(`.delivery .${control}`).css("display", displayMode);
    }

}

function closeOrderDetails() {
    $(".order-details-dialog").slideToggle("medium", function () {
        $(".order-details-wrapper").removeClass("visible");
        $('body').removeClass("overflow-hidden");
    })
}

function showGood(good) {
    let name = good["Name"];
    let desc = good["Description"];
    let shop = goodShop["Name"];

    let photoJSON = good["PhotoJSON"];
    let photos = JSON.parse(photoJSON);

    let photo = "files/no-image-icon.png";
    try {
        photo = photos[0]; //good["Photo1"];
    } catch(e) {

    }

    let price = good["Price"];
    let isAvailableUnfixed = good["IsAvailable"];
    let isAvailable = parseInt(isAvailableUnfixed) === 1;

    $(".item-photo-00").attr("src", photo);
    $(".item-photo-01").attr("src", photo);
    $(".item-photo-02").attr("src", photo);
    $(".item-photo-03").attr("src", photo);
    $(".item-photo-04").attr("src", photo);

    $(".order .total").html(`<span>${price} руб</span>`);
    $(`.order .desc span`).html(desc);

    $(".main .info .photo span").html(name);
    $(`.description .text span`).html(desc);
    $(`.feedback .shop-name`).html(shop);


    let strIsAvailble = isAvailable ? "В наличии" : "Нет в наличии";
    let availabilityColor = isAvailable ? "#19B829" : "#FF0000";

    $('.order .instock-span').html(strIsAvailble);
    $('.order .instock-span').css("color", availabilityColor);
    $('.order .instock-svg path').css("fill", availabilityColor);
    $('.order .instock-svg line').css("stroke", availabilityColor);

    //$('.order .instock-svg').css("visibility", isAvailable ? "visible" : "hidden");
}