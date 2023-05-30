
// Get the form element
var form = document.getElementById("announcement_form");


// Get the input elements
var input1 = document.getElementById("subject");
var input2 = document.getElementById("description");
var input3 = document.getElementById("date");

// Get the error message elements
var error_sub = document.getElementById("error_sub");
var error_des = document.getElementById("error_des");
var error_date = document.getElementById("error_date");

// Add a submit event listener to the form
form.addEventListener("submit", function(event) {
  event.preventDefault(); // prevent the form from submitting

  // Reset the error messages
input1.addEventListener("keyup", function() {
    error_sub.innerHTML = ""; // reset the error message
    input1.style.borderColor = "";
});

input2.addEventListener("keyup", function() {
    error_des.innerHTML = ""; // reset the error message
    input2.style.borderColor = "";
});

input3.addEventListener("change", function() {
    error_date.innerHTML = ""; // reset the error message
    input3.style.borderColor = "";
});

 // validate the input fields
 if (input1.value === "") {
    error_sub.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Subject field is required.</span>";
    input1.style.borderColor = "red";
  }
  if (input2.value === "") {
    error_des.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Description field is required.</span>";
    input2.style.borderColor = "red";
  }
  if(input3.value === ""){
    error_date.innerHTML = "<span style='margin-bottom: 0px; margin-top: 5px;' >Date field is required.</span>";
    input3.style.borderColor = "red";
  }
  
  const submit_btn = document.getElementById("announce_button");
  submit_btn.onclick = function(){
    if (error_sub.innerHTML === "" && error_des.innerHTML === "" && error_date.innerHTML === "") {
        // this.innerHTML = "<div class='loader'></div>";
        form.submit();
        this.disabled = true;
        submit_btn.style.backgroundColor = "#5794ef";
    }
  }
});
