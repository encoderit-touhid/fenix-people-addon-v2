<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<style href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"></style>
<script>
    jQuery('.entry-title').text('Message')
    jQuery('#send_message_by_user_btn').on('click', function(e) {
    e.preventDefault();
    let message = jQuery('#send_message_by_user').val();
    let message_subject = jQuery('#message_subject').val();
    let custom_file=document.getElementsByClassName("file_add");
   
    if (!message_subject || !message) {
       
            Swal.fire({
            title: "Please Add Subject and Message",
            icon: "warning"
            });
           return;
        
        
    }
    else {
       swal.showLoading();
        var formdata = new FormData();
        formdata.append('message', message);
        formdata.append('message_subject', message_subject);
        for(var i=0;i<custom_file.length;i++)
        {
          formdata.append('file_array[]', custom_file[i].files[0]);
        }
        
        formdata.append('action', 'fenix_people_message_by_user_with_subject_message_file_in_single_message');
        formdata.append('nonce', '<?php echo wp_create_nonce('fenix_people_message_by_user_with_subject_message_file_in_single_message') ?>')

        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'post',
            processData: false,
            contentType: false,
            data: formdata,
            dataType: 'json',
            success: function(data) {
                if (data.success == "success") {
                    // let enc_white='enc-white';
                    // if(!message && data.file_url)
                    // {
                    //     message=data.file_url;
                    //     enc_white='';
                    // }

                    // let html = `
                    // <div class="message_view user">
                    //     <div class="view_inner">
                    //         <p class="${enc_white}">${message}</p>
                    //     </div>
                    // </div>
                    // `;
                    // jQuery('.message_div').append(html);
                    // jQuery('#send_message_by_user').val('')
                    // jQuery('#send_message_by_user_file').val('')
                    // jQuery('#send_message_by_user_file').hide()
                    // jQuery('#send_message_by_user').show()
                    // jQuery('#message_subject').val()
                    //jQuery('#send_message_by_user_file').val('')
                   // jQuery('#send_message_by_user_file').val('')
                   // jQuery('#send_message_by_user').toggle();
                    //jQuery('#send_message_by_user_file').toggle();
                    Swal.fire({
                    title: "Message Sent",
                    icon: "success"
                    });
                    location.reload();
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
//jQuery('#send_message_by_user_file').hide();

jQuery('#send_message_by_user_file_icon').on('click',function(e){
    e.preventDefault();
    jQuery('#send_message_by_user').toggle();
    jQuery('#send_message_by_user_file').toggle();
    jQuery('#send_message_by_user').val('');
    jQuery('#send_message_by_user_file').val('');
})
jQuery('#request_service_client').DataTable({
		 
        });

jQuery('#inbox-tab').on('click',function(){
  jQuery('#send_message_h2').hide();
  jQuery('#inbox_h2').show();

});    
jQuery('#send-message-tab').on('click',function(){
  jQuery('#send_message_h2').show();
  jQuery('#inbox_h2').hide();

});



    jQuery(document).on("click","#addFile", function (e) {
      e.preventDefault();
      var newInput =
        '<div class="file_item"><input type="file" class="file_add" name="files[]" multiple><button class="removefile">X</button><div>';
      jQuery("#file_adding_div").append(newInput);
    });
  
  jQuery(document).on("click", ".removefile", function (e) {
    e.preventDefault();

    jQuery(this).closest("div").remove(); // to get clicked element
  });

</script>