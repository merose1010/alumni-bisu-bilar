


// $(document).ready(function() {
//     // Validate the form
//     $("#reissueance_form").validate({
//       rules: {
//         name: {
//           required: true,
//         },
//         id_no: {
//           required: true,
//         },
//         degree: {
//           required: true,
//         },
//         reason: {
//           required: true,
//         },
//         or_no: {
//           required: true,
//           number: true,
//         },
//         signature: {
//             required: true,
//           },
//       },
//       messages: {
//         name: "Please enter your name",
//         id_no: "Please enter your ID No",
//         degree: "Please enter your degree",
//         reason: "Please enter your reason",
//         or_no: {
//           required: "Please enter your OR no",
//           number: "Please enter a number",
//         },
//         signature: "Please select an image",
//       },
//     });
//   });
  
  
//   // When the form is submitted, check the validation
//   $("#reissueance_form").submit(function() {
//     // Check if the form is valid
//     if ($(this).valid()) {
//       // Submit the form
//       return true;
//     } else {
//       // Show the errors
//       $(this).find(".error-text").show();
//       return false;
//     }
//   });
  