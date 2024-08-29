<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<style href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"></style>
<script>
     jQuery('#request_service_client').DataTable({
		 "order": []
	});
</script>

<script>
    jQuery(document).on('click','.adding_financial_report_modal',function(e){
       e.preventDefault();
       
       jQuery('#subject').val("");
       jQuery('#message_content').val("");
       jQuery('#user_id_to_message').val("");
       jQuery('#file_adding_div').empty();
       jQuery('#user_id_to_message').val(jQuery(this).data('user_id'));
       jQuery('#createModalLabel').text(`Send Message to `+jQuery(this).data('user_name'));
       jQuery('#createModal').modal('show');

    })
    
    jQuery(document).ready(function () {
    jQuery(document).on("click","#createModal #addFile", function (e) {
      e.preventDefault();
      var newInput =
        '<div class="file_item"><input type="file" class="file_add" name="files[]" multiple><button class="removefile">X</button><div>';
      jQuery("#createModal #file_adding_div").append(newInput);
    });
  });
  jQuery(document).on("click", ".removefile", function (e) {
    e.preventDefault();

    jQuery(this).closest("div").remove(); // to get clicked element
  });
  jQuery('#add_report').on('click',function(e)
    {
      e.preventDefault();
      swal.showLoading();
      var subject=jQuery('#subject').val();
      var message_content=jQuery('#report_content').val();
      var receiver_id=jQuery('#user_id_to_message').val();
      var formdata = new FormData();
      var custom_file=document.getElementsByClassName("file_add");

      if(!subject)
      {
        swal.fire({
                text: "Please Add Subject",
              });
              return false;      
      }
      if(!message_content)
      {
        swal.fire({
                text: "Please Add Message",
              });
               
        return false; 
      }
      for(var i=0;i<custom_file.length;i++)
      {

              formdata.append('file_array[]', custom_file[i].files[0]);

      }
      formdata.append('receiver_id',receiver_id);
      formdata.append('subject',subject);
      formdata.append('message_content',message_content);
      formdata.append('action','fenix_people_message_by_admin_with_subject_message_file_in_single_message');
      formdata.append('nonce','<?php echo wp_create_nonce('fenix_people_message_by_admin_with_subject_message_file_in_single_message') ?>')
      jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        processData: false,
        contentType: false,
        processData: false,
        data: formdata,
        success: function(data) {
                      swal.hideLoading()
                      const obj = JSON.parse(data);
                      console.log(obj);

                        if (obj.success == "success") {
                            Swal.fire({
                                // position: 'top-end',
                                icon: 'success',
                                text: 'Message is successfully sent and the client will get an email about it',
                                showConfirmButton: false,
                                 timer: 2500
                            })
                            jQuery('#createModal').modal('hide');
                            window.location.href = obj.redirect_to ;
                        }
                        if(obj.success == "error")
                        {
                          let message_arr=obj.message.split(';')
                          let html='';
                          for(let index=0;index<message_arr.length;index++)
                          {
                               var temp=message_arr[index]+"\n";
                               html = html+temp;
                          }
                          swal.fire({
                            

                            html: html,
                        
                           });
                        }
                    }
             })

    })
</script>