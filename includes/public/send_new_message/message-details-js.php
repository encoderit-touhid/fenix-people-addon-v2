<script>
jQuery('#send_message_by_user_btn').on('click', function(e) {
    e.preventDefault();
    let message = jQuery('#send_message_by_user').val();
    let files=document.getElementById("send_message_by_user_file").files[0];
   
    if (!message && files === undefined) {
        return;
    } else {
        var formdata = new FormData();
        formdata.append('message', message);
        formdata.append('files', files);
        formdata.append('action', 'fenix_people_message_by_user_with_subject');
        formdata.append('subject_id',<?=$subject_id?>);
        formdata.append('nonce', '<?php echo wp_create_nonce('fenix_people_message_by_user_with_subject') ?>')

        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'post',
            processData: false,
            contentType: false,
            data: formdata,
            dataType: 'json',
            success: function(data) {
                if (data.success == "success") {
                    let enc_white='enc-white';
                    if(!message && data.file_url)
                    {
                        message=data.file_url;
                        enc_white='';
                    }

                    let html = `
                    <div class="message_view user">
                        <div class="view_inner">
                            <p class="${enc_white}">${message}</p>
                        </div>
                    </div>
                    `;
                    jQuery('.message_div').append(html);
                    jQuery('#send_message_by_user').val('')
                    jQuery('#send_message_by_user_file').val('')
                    jQuery('#send_message_by_user_file').hide()
                    jQuery('#send_message_by_user').show()
                    //jQuery('#send_message_by_user_file').val('')
                   // jQuery('#send_message_by_user_file').val('')
                   // jQuery('#send_message_by_user').toggle();
                    //jQuery('#send_message_by_user_file').toggle();
                }
            }
        });
    }
});

jQuery('#send_message_by_user').on('keydown', function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) { 
        e.preventDefault(); 
        jQuery('#send_message_by_user_btn').click(); 
    }
});
jQuery('#send_message_by_user_file').hide();

jQuery('#send_message_by_user_file_icon').on('click',function(e){
    e.preventDefault();
    jQuery('#send_message_by_user').toggle();
    jQuery('#send_message_by_user_file').toggle();
    jQuery('#send_message_by_user').val('');
    jQuery('#send_message_by_user_file').val('');
})

jQuery('.entry-title').text(jQuery('#message_details_for').val())
</script>