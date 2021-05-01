$(document).ready(function () {
    $(".main-filter .price .slider").slider({
        range: true,
        min: 0,
        max: 10000,
        values: [0, 10000],
        slide: function (event, ui) {

        }
    });
})
