
// DASHBOARD OLD PASSWORD

const togglePassword1 = document.querySelector('#togglePassword1');
const oldPassword = document.querySelector('#oldPassword');


togglePassword1.addEventListener('click', function (e) {
// toggle the type attribute
const type = oldPassword.getAttribute('type') === 'password' ? 'text' : 'password';
oldPassword.setAttribute('type', type);
// toggle the eye slash icon
this.classList.toggle('fa-eye-slash');
});



// DASHBOARD NEW PASSWORD

const togglePassword2 = document.querySelector('#togglePassword2');
const newPassword = document.querySelector('#newPassword');


togglePassword2.addEventListener('click', function (e) {
// toggle the type attribute
const type2 = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
newPassword.setAttribute('type', type2);
// toggle the eye slash icon
this.classList.toggle('fa-eye-slash');
});


// DASHBOARD CONFIRM PASSWORD

const togglePassword3 = document.querySelector('#togglePassword3');
const confirmPassword = document.querySelector('#confirmPassword');


togglePassword3.addEventListener('click', function (e) {
// toggle the type attribute
const type3 = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
confirmPassword.setAttribute('type', type3);
// toggle the eye slash icon
this.classList.toggle('fa-eye-slash');
});


