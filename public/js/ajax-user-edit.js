$(document).on('click', '.action-edit', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/user-roles/' + id + '/ajaxedit',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#user_id').val(response.user.id);
            $('#edit_fname').val(response.user.first_name);
            $('#edit_mname').val(response.user.middle_name);
            $('#edit_lname').val(response.user.last_name);
            $('#edit_email').val(response.user.email);
            $('#edit_gender').val(response.user.gender);
            $('#edit_address').val(response.user.address);
            $('#edit_course').val(response.user.course);

        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});
