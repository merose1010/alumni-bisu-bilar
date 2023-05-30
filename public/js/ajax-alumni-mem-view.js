$(document).on('click', '.action-view', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/alumni_mem/' + id + '/ajaxview',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#view_name').text(response.amem.name);
            $('#view_address').text(response.amem.address);
            $('#view_bday').text(response.amem.bday);
            $('#view_con_num').text(response.amem.con_num);
            $('#view_fb').text(response.amem.fb);
            $('#view_paymed').text(response.amem.pay_med);
            $('#view_status').text(response.amem.status);
            $('#view_ref').text(response.amem.reference_no);
            $('#view_sig img').attr('src', response.image_url);
            $('#view_date').text(moment(response.amem.created_at).format('LLLL'));
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});
