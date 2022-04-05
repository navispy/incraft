async function showGoodEdit() {
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

    photoJSON = "";//shop["PhotoJSON"];
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
    $(".good-edit-dialog").slideToggle("medium", function() {
        $(".shop-good-edit").addClass("invisible");
        $(".shop-good-edit").removeClass("visible");

        $('body').removeClass("overflow-hidden");
    })
}

function updateGoodPhoto(obj) {
    console.log("update good photo");
    let files = $("#new-photo")[0].files;
    processFiles(files);
}

function processFiles(droppedFiles) {
    let progressPhoto = 0;
    $(".progress-bar").val(progressPhoto);

    let numFiles = droppedFiles.length;
    let step = 1.00 / parseFloat(numFiles) * 100;

    let numPhotos = photos.length;
    let lastPhotoNum = numPhotos == 0 ? 0 : photoNums[numPhotos - 1];

    let imgHash = {};

    let i = 0;
    for (let file of droppedFiles) {
        uploadPhoto(file, lastPhotoNum + i, undefined, step, ".progress-bar", 200, 148, imgHash);
        i++;
    }

    i = 0;
    for (let file of droppedFiles) {
        let fileName = file.name;
        photos.push(fileName); //photos are adding as well
        photoNums.push(lastPhotoNum + i + 1);
        i++;
    }

}