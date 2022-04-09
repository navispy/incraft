var calcTime;

var regions = [];
var districts = [];
var materials = [];
var scope = [];

function setupLocalHandlers() {
    $(".holidays .container").click(function() {
        let url = $(this).data("url");
        window.location.assign(url);
    });

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

    $(".cmd-img-left.goods-top").click(function() {
        let num = 0;
        for (index of goods_top_window) {
            index = index + 1;
            index = index === 10 ? 0 : index;;
            goods_top_window[num] = index;
            num++;
        }
        showTop10Goods();
    });

    $(".cmd-img-right.goods-top").click(function() {
        let num = 0;
        for (index of goods_top_window) {
            index = index - 1;
            index = index === -1 ? 9 : index;;
            goods_top_window[num] = index;
            num++;
        }
        showTop10Goods();
    });

    $(".cmd-img-left.shops-top").click(function() {
        let num = 0;
        for (index of shops_top_window) {
            index = index + 1;
            index = index === 10 ? 0 : index;;
            shops_top_window[num] = index;
            num++;
        }
        showTop10Shops();
    });

    $(".cmd-img-right.shops-top").click(function() {
        let num = 0;
        for (index of shops_top_window) {
            index = index - 1;
            index = index === -1 ? 9 : index;;
            shops_top_window[num] = index;
            num++;
        }
        showTop10Shops();
    });

    $(".cmd-img-left.feedback-latest").click(function() {
        feedback_latest_index++;
        feedback_latest_index = feedback_latest_index === feedback_latest.length ? 0 : feedback_latest_index;;
        
        showLatestFeedback();
    });

    $(".cmd-img-right.feedback-latest").click(function() {
        feedback_latest_index--;
        feedback_latest_index = feedback_latest_index === -1 ? feedback_latest.length - 1 : feedback_latest_index;;

        showLatestFeedback();
    });
}

$(document).ready(function() {
    setupSignupHandlers();
    setupSigninHandlers();
    setupPasswordRestoreHandlers();

    restoreUser();

    initUI();

    setupLocalHandlers();
    setupSearchHandlers();

    search(true);
    getTop10Goods();
    getTop10Shops();
    getLatestGoods();
    getLatestFeedback();
})