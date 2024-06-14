
<?php
$path_css=WP_PLUGIN_DIR . '/fenix-people-addon/assets/css/service-request-css.php';
include_once($path_css);

$form_id=$_GET['form_id'];

//var_dump($form_id);
//exit;

if(empty($form_id) )
{
    ?>
    <div class="enc-white">
      <p>You are not Allowed</p>
    </div>
    <?php
}else
{
    $form_id_decoded=explode(';',enc_decodeContent($form_id));
    $db_form_id=$form_id_decoded[0];
    $db_user_id=get_current_user_id();
    global $wpdb;
    $table_name = $wpdb->prefix . 'encoderit_fenix_people_form';
    $result = $wpdb->get_row("SELECT * FROM " . $table_name . " where id =$db_form_id and user_id=$db_user_id");
    if(empty($result))
    {
        ?>
        <div class="enc-white">
         <p>You are not Allowed</p>
        </div>
        <?php
    }else
    {
        //var_dump($result);
        $files_by_user=json_decode($result->files_by_user,true);
        $get_all_services=json_decode($result->services,true);
        $files_by_admin=null;
        if(!empty($result->files_by_admin))
        {

            $files_by_admin=json_decode($result->files_by_admin,true);
        }

        ?>
          
<div style="padding: 30px" class="enc-white">
    <h1>Request ID #<?=$result->id?></h1>
    
        
        <div class="row_d">
            <div class="titel_col">
                <label for="">Description:</label>
            </div>
            <div class="right_col">
                <p style="font-size: 15px; font-weight:900"><?=$result->description?></p>
            </div>
        </div>

        <div class="row_d">
            <div class="titel_col">
                <label for="">File By User:</label>
            </div>
            <div class="right_col add__file__container">
                
                <?php
                foreach($files_by_user as $key=>$value)
                {
                    ?>
                     <a href="<?=wp_upload_dir()['baseurl'].$value['paths']?>" target="_blank"><?=$value['name']?></a>
                     <br>
                     <br>
                    <?php

                }
                
                ?>
            </div>
        </div>

        <div class="row_d services_row">
            <div class="titel_col">
                <label for="">Services:</label>
            </div>
            <div class="right_col product__container">
                <?php
                 
                 //var_dump($get_all_services);
                
                    foreach ($get_all_services as $key => $value) 
                    {
                        ?>
                    <div class="product__item d-flex-center">
                        <input type="checkbox" class="encoder_it_custom_services" checked disabled/>
                        <label class="d-flex-center">
                            <span><?= $value['service_name'] ?></span>
                            <span>$<?= $value['service_price'] ?></span>
                        </label>
                    </div>
                    <?php
                    }

                 

       ?>
            </div>
        </div>

        <div class="row_d">
            <div class="titel_col">
                <label for="">Payment Method:</label>
            </div>
            <div class="right_col right_total_price">
                <div class="payment_method_container">
                    <div class="item d-flex-center">
                        <input type="radio" checked disabled/>
                        <span><?=$result->payment_method?></span>
                    </div>
                </div>
               
                <div class="total__price">
                    <span>Total Price</span><span id="price">$ <?=$result->total_price?></span>
                </div>
                
            </div>
        </div>
        <div class="row_d">
            <div class="titel_col">
            <label for="">Add File By Admin:</label>
            </div>
          <div class="right_col add__file__container">
          <?php
              if(!empty($files_by_admin))
              {
                $is_ssl=false;
                if(str_contains(site_url(), 'https'))
                 {
                    $is_ssl=true;
                 }
                $files=[];
                //$files_by_admin=json_decode($value->files_by_admin,true);
                foreach ($files_by_admin as $file) {
                    if($is_ssl)
                    {

                        $file_path = str_replace("http://","https://",wp_upload_dir()['baseurl'].$file['paths']);
                    }else
                    {
                        $file_path = wp_upload_dir()['baseurl'].$file['paths'];
                    }
                    array_push($files,$file_path);
                }
                $case_id=$db_form_id;
                $a=implode(',',$files);
                $file_name_string='#'.$db_form_id.'-'.date('Y-m-d-H-i-s').'-'.wp_get_current_user()->ID;
                $id="user_id_enc_don_".$case_id;

                foreach($files_by_admin as $key=>$value)
                {
                    ?>
                     <a href="<?=wp_upload_dir()['baseurl'].$value['paths']?>" target="_blank"><?=$value['name']?></a>
                     <br>
                     <br>
                    <?php

                }
                ?><a href="#"  data-case="<?=$case_id?>" data-name="<?=$file_name_string?>"   data-file="<?=$a?>" id="<?=$id?>" onclick="enc_download(this.id)">Download ZIP</a><?php
              }
                
            ?>
        </div>
    </div>
    
</div>
        <?php
    }

}

?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<?php
$path_download_js=WP_PLUGIN_DIR . '/fenix-people-addon/assets/js/submitted-service-request-download-js.php';
include_once($path_download_js);