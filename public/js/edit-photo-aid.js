const addphotoBtn_aid = document.querySelector("#addphotoBtn_aid");
const editSigImg = document.querySelector("#edit_sig_img");

function addphoto_aid() {
  addphotoBtn_aid.click();
}

function readURL_aid(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      editSigImg.src = e.target.result;
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#addphotoBtn_aid").change(function() {
    readURL_aid(this);
});


