
// Get the form element
var edit_form = document.getElementById("edit_user_form");


// Get the input elements
var edit_input1 = document.getElementById("edit_fname");
var edit_input2 = document.getElementById("edit_mname");
var edit_input3 = document.getElementById("edit_lname");
var edit_input4 = document.getElementById("edit_email");
var edit_input6 = document.getElementById("edit_gender");
var edit_input7 = document.getElementById("edit_address");
var edit_input8 = document.getElementById("edit_role");

// Get the error message elements
var edit_error_fname = document.getElementById("edit_error_fname");
var edit_error_mname = document.getElementById("edit_error_mname");
var edit_error_lname = document.getElementById("edit_error_lname");
var edit_error_email = document.getElementById("edit_error_email");
var edit_error_gender = document.getElementById("edit_error_gender");
var edit_error_address = document.getElementById("edit_error_address");
var edit_error_role = document.getElementById("edit_error_role");

// Add a submit event listener to the form
form.addEventListener("submit", function(event) {
  event.preventDefault(); // prevent the form from submitting

  // Reset the error messages
  edit_input1.addEventListener("keyup", function() {
    edit_error_fname.innerHTML = ""; // reset the error message
    edit_input1.style.borderColor = "";
});
edit_input2.addEventListener("keyup", function() {
  edit_error_mname.innerHTML = ""; // reset the error message
  edit_input2.style.borderColor = "";
});

edit_input3.addEventListener("keyup", function() {
  edit_error_lname.innerHTML = ""; // reset the error message
  edit_input3.style.borderColor = "";
});
input4.addEventListener("keyup", function() {
  error_email.innerHTML = ""; // reset the error message
  input4.style.borderColor = "";
});

edit_input6.addEventListener("change", function() {
  edit_error_gender.innerHTML = ""; // reset the error message
    edit_input7.style.borderColor = "";
});
edit_input7.addEventListener("keyup", function() {
  edit_error_address.innerHTML = ""; // reset the error message
  edit_input7.style.borderColor = "";
});

edit_input8.addEventListener("change", function() {
  edit_error_role.innerHTML = ""; // reset the error message
  edit_input8.style.borderColor = "";
});

 // validate the input fields
 if (edit_input1.value === "") {
  edit_error_fname.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Firstname is required.</span>";
  edit_input1.style.borderColor = "red";
  }
  if (edit_input2.value === "") {
    edit_error_mname.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Middlename is required.</span>";
    edit_input2.style.borderColor = "red";
    }
  if (edit_input3.value === "") {
    edit_error_lname.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Lastname is required.</span>";
    edit_input3.style.borderColor = "red";
  }
  if(edit_input4.value === ""){
    edit_error_email.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Email is required.</span>";
    edit_input4.style.borderColor = "red";
  }

  if (edit_input6.value === "") {
    edit_error_gender.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Gender is required.</span>";
    edit_input6.style.borderColor = "red";
  }
  if(edit_input7.value === ""){
    edit_error_address.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Address is required.</span>";
    edit_input7.style.borderColor = "red";
  }

  if(edit_input8.value === ""){
    edit_error_role.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Role is required.</span>";
    edit_input8.style.borderColor = "red";
  }
  
  
  const submit_btn_edit = document.getElementById("update_user_button");
  submit_btn.onclick = function(){
    if (error_fname.innerHTML === "" && error_mname.innerHTML === "" && error_lname.innerHTML === "" && error_email.innerHTML === "" && error_gender.innerHTML === "" && error_address.innerHTML === "" && error_role.innerHTML === "") {
        // this.innerHTML = "<div class='loader'></div>";
        edit_form.submit();
        this.disabled = true;
        submit_btn_edit.style.backgroundColor = "#5794ef";
    }
  }
});
