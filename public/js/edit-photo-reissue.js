

const addphotoBtn_reissue = document.querySelector("#addphotoBtn_reissue");
const editSigImg_reissue = document.querySelector("#edit_r_sig_img");

function addphoto_reissue() {
    addphotoBtn_reissue.click();
}

function readURL_reissue(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        editSigImg_reissue.src = e.target.result;
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#addphotoBtn_reissue").change(function() {
    readURL_reissue(this);
});

