<script>
    jQuery('#send_message_by_user_btn').on('click',function(e){
        e.preventDefault();
        let message=jQuery('#send_message_by_user').val();
        if(!message)
        {
            return;
        }else
        {
            var formdata = new FormData();
            formdata.append('message',message);
            formdata.append('action','fenix_people_message_by_user');
            formdata.append('nonce','<?php echo wp_create_nonce('fenix_people_message_by_user') ?>')
        
      jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    processData: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: 'json',
                    success: function(data) {
                        if(data.success == "success")
                        {
                            let html=`
                            <div class="message_view user">
                                <div class="view_inner">
                                    <p class="enc-white">${message} </p>
                                </div>
                            </div>
                            `;
                            jQuery('.message_div').append(html);
                            jQuery('#send_message_by_user').val('')
                        }
                    }
              });
            
        }
    })
</script>