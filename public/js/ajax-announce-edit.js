$(document).on('click', '.action-edit', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/announcement/' + id + '/ajaxedit',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#id').val(response.announce.id);
            $('#edit_subject').val(response.announce.subject);
            $('#edit_description').val(response.announce.description);
            $('#edit_date').val(response.announce.date);
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});
