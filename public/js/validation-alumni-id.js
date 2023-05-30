
  // // add a custom method to check the file size
  // $.validator.addMethod('filesize', function(value, element, param) {
  //   return this.optional(element) || (element.files[0].size <= param * 1000000);
  // }, 'File size must be less than {0} MB.');

  // $.validator.addMethod('filetype', function(value, element, param) {
  //   var fileType = element.files[0].type;
  //   return this.optional(element) || (fileType === 'image/jpeg' || fileType === 'image/png');
  // }, 'File must be a JPEG or PNG image.');

  // $(document).ready(function() {
  //   // initialize the validator
  //   var validator = $('#alumni_id_form').validate({
  //     rules: {
  //       id_no: {
  //         required: true,
  //       },
  //       name: {
  //           required: true,
  //         },
  //         bday: {
  //           required: true,
  //         },
  //         address: {
  //           required: true,
  //         },

  //         course: {
  //           required: true,
  //         },
  //         address: {
  //           required: true,
  //         },
  //         signature: {
  //           required: true,
  //           filesize: 1,
  //           filetype: true
  //         }
  //     },
  //     messages: {
  //       id_no: {
  //         required: "Please enter your ID no",
  //       },
        
  //       name: {
  //           required: "Please enter your name",
  //         },
  //         bday: {
  //           required: "Please enter your birthday",
  //         },
  //         address: {
  //           required: "Please enter your address",
  //         },

  //         course: {
  //           required: "Please enter your course",
  //         },
  //         address: {
  //           required: "Please enter your address",
  //         },
  //         signature: {
  //           required: 'Please select a file.',
  //           filesize: 'File size must be less than 1 MB.',
  //           filetype: 'File must be a JPEG or PNG image.'
  //         }

        
  //     },
  //     errorPlacement: function(error, element) {
  //       error.insertAfter(element.next());
  //     },

  //     submitHandler: function(form) {
  //       form.submit();
  //     }
  //   });
  
  //   // validate the form fields before submitting
  //   $('#alumni_id_form').on('submit', function() {
  //     return validator.form();
  //   });
  
  //   // validate the form fields on change and blur events
  //   $('#id_no, #name, #bday, #course, #address, #addphotoBtn').on('change blur', function() {
  //     validator.element(this);
  //   });
  // });

