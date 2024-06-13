<?php
if(isset($_POST['btn'])){
  
  
      global $wpdb;
      $table_name = $wpdb->prefix . 'encoderit_fenix_people_services';
      $search_data=$_POST["service_name"];
      $sql="SELECT * FROM " . $table_name . " WHERE service_name = '$search_data'";
      $result=$wpdb->get_results($sql);
      if (count($result) != 0)
      {
        echo "<script>alert('This service name $search_data is already in database')</script>";
      }
      else
      {
        $data = array(
          "service_name" => $_POST["service_name"],
          "service_price" => $_POST["service_price"],
          "created_at" => date('Y-m-d H:i:s'),
        );
        $inserted = $wpdb->insert($table_name, $data);
        if($inserted)
        {
            $service_name=$_POST['service_name'];
            echo "<script>Swal.fire({
            
            text: 'Successfully inserted service name $service_name ',
          })</script>";
        }
      } 
    
    
}
  
  
  

?>


<style type="text/css">
  :root {
    --white-color: #ffffff;
    --primary-color: #91d3ee;
    --border-color: #8c8f94;
    --text-color: #3c434a;
    --bg-secondary-color: #c3e1ff;
  }

  label {
    display: block;
    font-weight: bold;
    margin: 15px 0;
  }
  input {
    padding: 2px;
    border: 1px solid #eee;
    font: normal 1em Verdana, sans-serif;
    color: #777;
    width: 100%;
    box-sizing: border-box;
  }
  select {
    padding: 2px;
    border: 1px solid #eee;
    font: normal 1em Verdana, sans-serif;
    color: #777;
    width: 100%;
    box-sizing: border-box;
  }
  input.buttons {
    font: bold 12px Arial, Sans-serif;
    height: 50px;
    width: 150px;
    margin-top: 20px;
    margin-left: 200px;
    margin-bottom: 50px;
    cursor: pointer;
    color: #333;
    background: #e7e6e6 url(MarketPlace-images/button.jpg) repeat-x;
    border: 1px solid #dadada;
  }
  .flex {
    display: flex;
  }
  .removefile {
    margin-left: 5px;
  }
  form {
    font-size: 15px;
    max-width: 900px;
  }
  .main_contianer {
    max-width: 500px;
    background: #fff;
    border: 1px solid #ccd0d4;
    border-inline-start-width: 4px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
    padding: 20px;
  }
  .input_item,
  .back_btn {
    margin-bottom: 25px;
  }
  .input_item label {
    margin: 0;
    margin-bottom: 5px;
  }
  .input_item p {
    margin: 0;
  }
  .back_btn a {
    display: inline-block;
  }
  #add_service {
    color: #ffffff;
    background-color: #313fa0;
    border: none;
    outline: none;
    box-shadow: none;
    transition: 0.4s;
    font-size: 16px;
    padding: 7px 20px;
    border-radius: 4px;
  }
  #add_service:hover {
    background-color: #f73e19;
  }
</style>



<div class="wrap pbwp">

<a href="<?=admin_url() .'admin.php.?page=fenix-people-services'?>" class="button" style="padding:5px 25px;background-color: #2271b1;color: white">Back</a>
<br>
<h1 class="wp-heading-inline">Add New Service</h1>
  <div class="main_contianer">
    <form action="" method='POST' enctype="multipart/form-data">
      <div class="input_item">
        <label for="">Service Name:</label>
        <input type="text" name="service_name" id="service_name" value="" style="width:100%;" required>
      </div>
      <div class="input_item">
        <label for="">Service Price:</label>
        <input type="text" name="service_price" id="service_price" value="" style="width:100%;" required>
      </div>
      <button id="add_service" class="button" >Add Service</button>
    </form>
  </div>
</div>
<script>
  jQuery(document).ready(function () {
          
    jQuery('#add_service').on('click',function(e){
      //alert();
      e.preventDefault();
      var formdata = new FormData();
      var service_price=jQuery('#service_price').val();
      var service_name=jQuery('#service_name').val();

      formdata.append('service_name',service_name);
      formdata.append('service_price',service_price);
      formdata.append('action','fenix_people_service_add_ajax_callback');
      formdata.append('nonce','<?php echo wp_create_nonce('fenix_people_add_service_admin') ?>')
      
      jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    processData: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: 'json',
                    success: function(data) {
                    //console.log(data);
                    // const obj = JSON.parse(data)
                     if(data.success === "success")
                     {
                        Swal.fire({
                          text: data.message,
                          timer: 2000,
                          icon: 'success',
                          showConfirmButton: false,
                        });
                        jQuery('#service_name').val('');
                        jQuery('#service_price').val('');
                     }else
                     {
                        Swal.fire({
                            text: data.message,
                            timer: 2000,
                            icon: 'warning',
                            showConfirmButton: false,
                          });
                     }
                       
                    

                    }
              });

    })

  });
</script>