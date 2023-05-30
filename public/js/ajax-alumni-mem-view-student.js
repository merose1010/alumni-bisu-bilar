$(document).on('click', '.view_alumni_mem', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/records-of-students/' + id + '/ajaxview_amem',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#view_mem_name').text(response.amem.name);
            $('#view_mem_address').text(response.amem.address);
            $('#view_mem_bday').text(response.amem.bday);
            $('#view_mem_con_num').text(response.amem.con_num);
            $('#view_mem_fb').text(response.amem.fb);
            $('#view_mem_paymed').text(response.amem.pay_med);
            $('#view_mem_status').text(response.amem.status);
            $('#view_mem_ref').text(response.amem.reference_no);
            $('#view_mem_price').text(response.amem.price);
            $('#view_mem_sig img').attr('src', response.image_url);
            $('#view_mem_date').text(moment(response.amem.created_at).format('LLLL'));
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});
