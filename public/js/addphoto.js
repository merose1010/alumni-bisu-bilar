// CHANGE CHOOSE FILE BUTTON IN ADD

const addphotoBtn = document.querySelector("#addphotoBtn")
const addphotImg = document.querySelector("img")

function addPhoto() {
    addphotoBtn.click();
}


// PREVIEW IMAGE 

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#change-img-add').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }

}

$("#addphotoBtn").change(function(){
    readURL(this);
});
