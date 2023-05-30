


// $(document).ready(function() {
//   // Validate the form
//   $("#alumni_mem_form").validate({
//     rules: {
//       name: {
//         required: true,
//       },
//       address: {
//         required: true,
//       },
//       bday: {
//         required: true,
//       },
//       fb: {
//         required: true,
//       },
//       con_num: {
//         required: true,
//         number: true,
//       },
//       ref: {
//         required: {
//           depends: function() {
//             return $("#opt2").prop("checked");
//           },
//         },
//         number: true,
//       },
//     },
//     messages: {
//       name: "Please enter your name",
//       address: "Please enter your address",
//       // bday: "Please enter your birthday",
//       fb: "Please enter your Facebook account",
//       con_num: {
//         required: "Please enter your contact number",
//         number: "Please enter a valid number",
//       },
//       ref: {
//         required: "Please enter a reference number",
//         number: "Please enter a valid number",
//       },
//     },
//   });
// });


// // When the form is submitted, check the validation
// $("#alumni_mem_form").submit(function() {
//   // Check if the form is valid
//   if ($(this).valid()) {
//     // Submit the form
//     return true;
//   } else {
//     // Show the errors
//     $(this).find(".error-text").show();
//     return false;
//   }
// });
