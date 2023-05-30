$(document).on('click', '.action-view', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/reissueance/' + id + '/ajaxview',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#view_name').text(response.reissueance.name);
            $('#view_idno').text(response.reissueance.id_no);
            $('#view_degree').text(response.reissueance.degree);
            $('#view_reason').text(response.reissueance.reason);
            $('#view_orno').text(response.reissueance.or_no);
            $('#view_sig img').attr('src', response.image_url);
            $('#view_date').text(moment(response.reissueance.created_at).format('LLLL'));
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});
