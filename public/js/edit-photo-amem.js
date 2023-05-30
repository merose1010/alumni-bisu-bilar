

const addphotoBtn_amem = document.querySelector("#addphotoBtn_amem");
const editSigImg_amem = document.querySelector("#edit_mem_sig_img");

function addphoto_amem() {
    addphotoBtn_amem.click();
}

function readURL_amem(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        editSigImg_amem.src = e.target.result;
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#addphotoBtn_amem").change(function() {
    readURL_amem(this);
});

