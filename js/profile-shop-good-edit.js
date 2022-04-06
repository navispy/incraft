async function showGoodEdit(good) {
    $('html, body').animate({
        scrollTop: $(".header").offset().top
    }, 100);

    $(".shop-good-edit").addClass("visible");
    $(".shop-good-edit").removeClass("invisible");
    $(".good-edit-dialog").slideToggle("medium", function () {
        $('body').addClass("overflow-hidden");
    });

    let materials = await getMaterials();
    updateMaterialCombo(materials, ".cb-material");

    photoJSON = good["PhotoJSON"];
    try {
        photos = JSON.parse(photoJSON);
    } catch (e) {

    } finally {
        photos = [];
    }

    photoNums = [];

    let i = 0;
    for (let obj of photos) {
        let num = i + 1;
        photoNums.push(num);
        i++;
    }
}

function closeGoodEdit() {
    $(".good-edit-dialog").slideToggle("medium", function () {
        $(".shop-good-edit").addClass("invisible");
        $(".shop-good-edit").removeClass("visible");

        $('body').removeClass("overflow-hidden");
    })
}

async function saveGood() {
    if(good["ID"] !== undefined) {

    } else {

        var params = {
            shop: shop["ID"],
            good: JSON.stringify(good),
            schemaID: "incraft"
        }
    
        let response = await fetch(`post_json_good_create.php`, {
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
        showToast("Товар сохранен");
    }
}

function updateGoodPhoto(obj) {
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

    let numPhotos = photos.length;
    let lastPhotoNum = numPhotos == 0 ? 0 : photoNums[numPhotos - 1];

    let i = 0;
    let html = "";
    for (let file of droppedFiles) {
        let fileName = await uploadPhoto(file);
        photos.push(fileName); //photos are adding as well
        photoNums.push(lastPhotoNum + i + 1);
        i++;

        let item_html =
            `<div data-num="${i}" class="good-photo-item good-photo-item-${i}">
                <img src="${fileName}" />
            </div>`;

        html += item_html;
    }

    good["PhotoJSON"] = JSON.stringify(photos);
    $(`.stack-photo`).append(html);
}