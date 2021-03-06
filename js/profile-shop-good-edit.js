var addedPhotos = [];
async function showGoodEdit(good) {
    $('html, body').animate({
        scrollTop: $(".header").offset().top
    }, 100);

    $(".shop-good-edit").addClass("visible");
    $(".shop-good-edit").removeClass("invisible");
    $(".good-edit-dialog").slideToggle("medium", function() {
        $('body').addClass("overflow-hidden");
    });

    let materials = await getMaterials();
    updateMaterialCombo(materials, ".cb-material");

    let name = good["Name"];
    let material = good["Material"];
    let price = good["Price"];
    let desc = good["Description"];
    let isAvailable = good["IsAvailable"] === "1";

    $(`.good-edit-dialog .input-class.name`).val(name);
    $(`.good-edit-dialog .input-class.price`).val(price);
    $(`.good-edit-dialog .input-class.description`).val(desc);
    $(`.good-edit-dialog .cb-material`).val(material);
    $(`.good-edit-dialog .is-available`).prop("checked", isAvailable);

    photoJSON = good["PhotoJSON"];
    try {
        photos = JSON.parse(photoJSON);
    } catch (e) {

    } finally {}

    photoNums = [];

    let i = 0;
    for (let obj of photos) {
        let num = i + 1;
        photoNums.push(num);
        i++;
    }

    updateGoodPhotos(photos);
}

function closeGoodEdit() {
    $(".good-edit-dialog").slideToggle("medium", function() {
        $(".shop-good-edit").addClass("invisible");
        $(".shop-good-edit").removeClass("visible");

        $('body').removeClass("overflow-hidden");
    })
}

async function saveGood() {
    var params = {
        shop: shop["ID"],
        good: JSON.stringify(good),
        schemaID: "incraft"
    }

    let url = `post_json_good_create.php`;
    if (good["ID"] !== undefined) {
        url = `post_json_good_update.php`;
    }

    let response = await fetch(url, {
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
        good["ID"] = data["good"]["ID"];
    }

    closeGoodEdit();
    showToast("?????????? ????????????????");
}

function processGoodPhotos(obj) {
    //console.log("update good photo");
    let files = $(".good-photo")[0].files;
    processFiles(files);
}

async function uploadPhoto(file) {
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
    return photo;
}


async function processFiles(droppedFiles) {
    //let progressPhoto = 0;
    //$(".progress-bar").val(progressPhoto);
    addedPhotos = [];
    let numPhotos = photos.length;
    let lastPhotoNum = numPhotos == 0 ? 0 : photoNums[numPhotos - 1];

    let i = 0;
    for (let file of droppedFiles) {
        let fileName = await uploadPhoto(file);
        photos.push(fileName); //photos are adding as well
        addedPhotos.push(fileName); //photos are adding as well
        photoNums.push(lastPhotoNum + i + 1);
    }

    good["PhotoJSON"] = JSON.stringify(photos);

    updateGoodPhotos(addedPhotos);
}

function updateGoodPhotos(addedPhotos) {
    let i = 0;
    let html = "";
    for (let photo of addedPhotos) {

        let item_html =
            `<div data-num="${i}" class="good-photo-item good-photo-item-${i}">
                <img src="${photo}" />
            </div>`;

        html += item_html;
    }

    $(`.stack-photo`).append(html);
}