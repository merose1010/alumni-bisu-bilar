$(document).on('click', '.action-edit', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/alumni-membership/' + id + '/ajaxedit',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#edit_mem_id').val(response.amem.id);
            $('#edit_mem_name').val(response.amem.name);
            $('#edit_mem_address').val(response.amem.address);
            $('#edit_mem_bday').val(response.amem.bday);
            $('#edit_mem_con_num').val(response.amem.con_num);
            $('#edit_mem_fb').val(response.amem.fb);
            $('#change-img-add').attr('src', response.image_url);
            // $('#addphotoBtn_amem').val(response.image_url);
            $('#edit_mem_date').val(moment(response.amem.created_at).format('LLLL'));
        },
        error: function(xhr) {
            alert('Error: ' + xhr.responseText);
        }
    });
});
