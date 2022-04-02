var good = {};

$(document).ready(function () {
    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();
    
    setupLocalHandlers();

    restoreUser();

    let goodJSON = window.sessionStorage.getItem("good");
    good = JSON.parse(goodJSON);

    showGood(good);
});

function setupLocalHandlers() {
    $(".price .qty").bind("input", function() {
        let priceUnfixed = good["Price"];
        let price = parseFloat(priceUnfixed);
        let qty = $(this).val();
        let cost = price * qty;

        $(".order .total").html(`<span>${cost} руб</span>`);
    });

    $(".order .button").bind("click", function() {
        showToast("Заказ успешно размещен");
    });

}

function showGood(good) {
    let photo = good["Photo1"];
    let price = good["Price"];
    let isAvailableUnfixed = good["IsAvailable"];
    let isAvailable = parseInt(isAvailableUnfixed) === 1;

    $(".item-photo-00").attr("src", photo);
    $(".item-photo-01").attr("src", photo);
    $(".item-photo-02").attr("src", photo);
    $(".item-photo-03").attr("src", photo);
    $(".item-photo-04").attr("src", photo);

    $(".order .total").html(`<span>${price} руб</span>`);

    let strIsAvailble = isAvailable ? "В наличии" : "Нет в наличии";
    let availabilityColor = isAvailable ? "#19B829" : "#FF0000";

    $('.order .instock-span').html(strIsAvailble);
    $('.order .instock-span').css("color", availabilityColor);
    $('.order .instock-svg path').css("fill", availabilityColor);
    $('.order .instock-svg line').css("stroke", availabilityColor);
    //$('.order .instock-svg').css("visibility", isAvailable ? "visible" : "hidden");
}