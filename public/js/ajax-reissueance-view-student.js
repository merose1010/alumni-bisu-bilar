

$(document).on('click', '.view_reissue', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/records-of-students/' + id + '/ajaxedit_reissue',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#view_r_name').text(response.reissueance.name);
            $('#view_r_idno').text(response.reissueance.id_no);
            $('#view_r_degree').text(response.reissueance.degree);
            $('#view_r_reason').text(response.reissueance.reason);
            $('#view_r_orno').text(response.reissueance.or_no);
            $('#view_r_sig img').attr('src', response.image_url);
            $('#view_r_date').text(moment(response.reissueance.created_at).format('LLLL'));
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});
