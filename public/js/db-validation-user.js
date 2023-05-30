
// Get the form element
var form = document.getElementById("new_user_form");


// Get the input elements
var input1 = document.getElementById("fname");
var input2 = document.getElementById("mname");
var input3 = document.getElementById("lname");
var input4 = document.getElementById("email");
var input5 = document.getElementById("password");
var input6 = document.getElementById("gender");
var input7 = document.getElementById("address");
var input8 = document.getElementById("role");

// Get the error message elements
var error_fname = document.getElementById("error_fname");
var error_mname = document.getElementById("error_mname");
var error_lname = document.getElementById("error_lname");
var error_email = document.getElementById("error_email");
var error_password = document.getElementById("error_password");
var error_gender = document.getElementById("error_gender");
var error_address = document.getElementById("error_address");
var error_role = document.getElementById("error_role");

// Add a submit event listener to the form
form.addEventListener("submit", function(event) {
  event.preventDefault(); // prevent the form from submitting

  // Reset the error messages
input1.addEventListener("keyup", function() {
  error_fname.innerHTML = ""; // reset the error message
    input1.style.borderColor = "";
});
input2.addEventListener("keyup", function() {
  error_mname.innerHTML = ""; // reset the error message
    input2.style.borderColor = "";
});

input3.addEventListener("keyup", function() {
  error_lname.innerHTML = ""; // reset the error message
    input3.style.borderColor = "";
});
input4.addEventListener("keyup", function() {
  error_email.innerHTML = ""; // reset the error message
  input4.style.borderColor = "";
});
input5.addEventListener("keyup", function() {
  error_password.innerHTML = ""; // reset the error message
  input5.style.borderColor = "";
});

input6.addEventListener("change", function() {
  error_gender.innerHTML = ""; // reset the error message
    input7.style.borderColor = "";
});
input7.addEventListener("keyup", function() {
  error_address.innerHTML = ""; // reset the error message
  input7.style.borderColor = "";
});

input8.addEventListener("change", function() {
  error_role.innerHTML = ""; // reset the error message
  input8.style.borderColor = "";
});

 // validate the input fields
 if (input1.value === "") {
  error_fname.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Firstname is required.</span>";
    input1.style.borderColor = "red";
  }
  if (input2.value === "") {
    error_mname.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Middlename is required.</span>";
      input2.style.borderColor = "red";
    }
  if (input3.value === "") {
    error_lname.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Lastname is required.</span>";
    input3.style.borderColor = "red";
  }
  if(input4.value === ""){
    error_email.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Email is required.</span>";
    input4.style.borderColor = "red";
  }

  if (input5.value === "") {
    error_password.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Password is required.</span>";
    input5.style.borderColor = "red";
  }
  if (input6.value === "") {
    error_gender.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Gender is required.</span>";
    input6.style.borderColor = "red";
  }
  if(input7.value === ""){
    error_address.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Address is required.</span>";
    input7.style.borderColor = "red";
  }

  if(input8.value === ""){
    error_role.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Role is required.</span>";
    input8.style.borderColor = "red";
  }
  
  
  const submit_btn = document.getElementById("create_user_button");
  submit_btn.onclick = function(){
    if (error_fname.innerHTML === "" && error_mname.innerHTML === "" && error_lname.innerHTML === "" && error_email.innerHTML === "" && error_password.innerHTML === "" && error_gender.innerHTML === "" && error_address.innerHTML === "" && error_role.innerHTML === "") {
        // this.innerHTML = "<div class='loader'></div>";
        form.submit();
        this.disabled = true;
        submit_btn.style.backgroundColor = "#5794ef";
    }
  }
});
