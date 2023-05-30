$(document).on('click', '.action-edit', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/reissueance/' + id + '/ajaxedit',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#edit_r_id').val(response.reissueance.id);
            $('#edit_r_name').val(response.reissueance.name);
            $('#edit_r_idno').val(response.reissueance.id_no);
            $('#edit_r_degree').val(response.reissueance.degree);
            $('#edit_r_reason').val(response.reissueance.reason);
            $('#edit_r_orno').val(response.reissueance.or_no);
            $('#change-img-add').attr('src', response.image_url);
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});