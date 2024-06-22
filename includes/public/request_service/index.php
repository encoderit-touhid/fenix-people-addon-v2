<?php
global $wpdb;
$table_name = $wpdb->prefix . 'encoderit_fenix_people_form';
$result = $wpdb->get_results("SELECT * FROM " . $table_name . " where user_id = ".get_current_user_id()."  ORDER BY id DESC");
//var_dump(get_the_last_form_id_by_user(wp_get_current_user()->ID) );


?>
<div class="enc-white">
    <div class="request_service_table_contianer">
        <table id="request_service_client">
            <thead>
                <tr>
                    <td>Case No</td>
                    <td>Amount</td>
                    <td>Payment Method</td>
                    <td>Request Date</td>
                    <td>Details</td>
                    <td>Download</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($result as $key=>$value)
                {
                    $view_link=site_url().'/my-account/submitted-service-request-single-view/?form_id='.base64_encode($value->id);
                    ?>
                    <tr>
                        <td>#<?=$value->id?></td>
                        <td>$<?=$value->total_price?></td>
                        <td><?=$value->payment_method?></td>
                        <td><?=$value->created_at?></td>
                        <td><a href="<?=$view_link?>">View</a></td>
                        <?php
                        if(!empty($value->files_by_admin))
                        {
                            $is_ssl=false;
                            if(str_contains(site_url(), 'https'))
                            {
                                $is_ssl=true;
                            }
                            $files=[];
                            $files_by_admin=json_decode($value->files_by_admin,true);
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
                            $case_id=$value->id;
                            $a=implode(',',$files);
                            $file_name_string='#'.$value->id.'-'.date('Y-m-d-H-i-s').'-'.wp_get_current_user()->ID;
                            $id="user_id_enc_don_".$case_id;
                            ?>
                            <td><a href="#"  data-case="<?=$case_id?>" data-name="<?=$file_name_string?>"   data-file="<?=$a?>" id="<?=$id?>" onclick="enc_download(this.id)">Download Now</a></td>
                            <?php
                        }else
                        {
                            ?><td></td><?php
                        }

                        ?>
                        
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<style href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"></style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script>
     jQuery('#request_service_client').DataTable({
		 
	});
</script>
<?php
$path_download_js=WP_PLUGIN_DIR . '/fenix-people-addon/assets/js/submitted-service-request-download-js.php';
$css_path=WP_PLUGIN_DIR . '/fenix-people-addon/assets/css/submitted-service-request-css.php';
include_once($path_download_js);
include_once($css_path);

