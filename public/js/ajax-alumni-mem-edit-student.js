$(document).on('click', '.edit_alumni_mem', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/records-of-students/' + id + '/ajaxedit_amem',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#edit_mem_id').val(response.amem.id);
            $('#edit_mem_name').val(response.amem.name);
            $('#edit_mem_address').val(response.amem.address);
            $('#edit_mem_bday').val(response.amem.bday);
            $('#edit_mem_con_num').val(response.amem.con_num);
            $('#edit_mem_fb').val(response.amem.fb);
            $('#edit_mem_ref').val(response.amem.reference_no);
            $('#edit_mem_sig_img').attr('src', response.image_url);
            // $('#addphotoBtn_amem').val(response.image_url);
            $('#edit_mem_date').val(moment(response.amem.created_at).format('LLLL'));
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});
