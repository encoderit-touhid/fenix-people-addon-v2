<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<style href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"></style>

<script>
    jQuery('#financial_document_admin').DataTable({

    });
   
    jQuery(document).on('click','.adding_financial_report_modal',function(e){
       e.preventDefault();
       jQuery('#user_id_to_report').val(jQuery(this).data('user_id'));
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
      var report_title=jQuery('#report_title').val();
      var report_content=jQuery('#report_content').val();
      var formdata = new FormData();
      var custom_file=document.getElementsByClassName("file_add");
      if(custom_file.length == 0 || !report_title)
      {
        swal.fire({
                text: "Please Add files",
              });
               
        return false; 
      }
      for(var i=0;i<custom_file.length;i++)
      {

              formdata.append('file_array[]', custom_file[i].files[0]);

      }
      formdata.append('user_id',jQuery('#user_id_to_report').val());
      formdata.append('report_title',report_title);
      formdata.append('report_content',report_content);
      formdata.append('action','admin_financial_report_submit');
      formdata.append('nonce','<?php echo wp_create_nonce('admin_financial_report_submit') ?>')
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
                                text: 'Uploaded files are successfully stored and the client will get an email about it',
                                showConfirmButton: false,
                                 timer: 2500
                            })
                            jQuery('#sent_status_'+jQuery('#user_id_to_report').val()).text("Sent");
                            jQuery('#created_status_'+jQuery('#user_id_to_report').val()).text(obj.created_at);
                            jQuery('#report_title').val("");
                            jQuery('#report_content').val("");
                            jQuery('#file_adding_div').empty();
                            jQuery('#createModal').modal('hide');
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
