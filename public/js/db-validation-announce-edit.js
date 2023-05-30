
// Get the form element
var edit_form = document.getElementById("edit_announcement_form");


// Get the input elements
var e_input1 = document.getElementById("edit_subject");
var e_input2 = document.getElementById("edit_description");
var e_input3 = document.getElementById("edit_date");


// Get the error message elements
var e_error_sub = document.getElementById("e_error_sub");
var e_error_des = document.getElementById("e_error_des");
var e_error_date = document.getElementById("e_error_date");



// Add a submit event listener to the form
edit_form.addEventListener("submit", function(event) {
  event.preventDefault(); // prevent the form from submitting

  // Reset the error messages
e_input1.addEventListener("keyup", function() {
    e_error_sub.innerHTML = ""; // reset the error message
    e_input1.style.borderColor = "";
});

e_input2.addEventListener("keyup", function() {
    e_error_des.innerHTML = ""; // reset the error message
    e_input2.style.borderColor = "";
});

e_input3.addEventListener("change", function() {
    e_error_date.innerHTML = ""; // reset the error message
    e_input3.style.borderColor = "";
});

 // validate the input fields
  if (e_input1.value === "") {
    e_error_sub.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Subject field is required.</span>";
    e_input1.style.borderColor = "red";
  }
  if (e_input2.value === "") {
    e_error_des.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Description field is required.</span>";
    e_input2.style.borderColor = "red";
  }
  if(e_input3.value === ""){
    e_error_date.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Date field is required.</span>";
    e_input3.style.borderColor = "red";
  }


  
  const submit_btn = document.getElementById("edit_announce_button");
  submit_btn.onclick = function(){
    if (e_error_sub.innerHTML === "" && e_error_des.innerHTML === "" && e_error_date.innerHTML === "") {
        // this.innerHTML = "<div class='loader'></div>";
        edit_form.submit();
        this.disabled = true;
        submit_btn.style.backgroundColor = "#5794ef";
    }
  }
});
