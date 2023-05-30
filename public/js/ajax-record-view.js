$(document).on('click', '.action-view', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/record-of-alumni/' + id + '/ajaxview',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#view_fname').text(response.user.first_name);
            $('#view_mname').text(response.user.middle_name);
            $('#view_lname').text(response.user.last_name);
            $('#view_email').text(response.user.email);
            $('#view_gender').text(response.user.gender);
            $('#view_address').text(response.user.address);
            $('#view_course').text(response.user.course);
            $('#view_date').text(moment(response.user.created_at).format('LLLL'));

            // Display user roles
            var rolesHtml = '';
            $.each(response.user.roles, function(index, role) {
                rolesHtml += role.name + '<br>';
            });
            $('#view_roles').html(rolesHtml);

        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});
