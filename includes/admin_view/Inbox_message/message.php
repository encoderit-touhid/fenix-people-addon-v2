<?php
global $wpdb;
$table_name = $wpdb->prefix . 'encoderit_fenix_people_chat_subjects';
$result = $wpdb->get_results("SELECT * FROM " . $table_name . "  ORDER BY id DESC");
//var_dump(get_the_last_form_id_by_user(wp_get_current_user()->ID) );

?>
<div class="enc-white">
    <div class="request_service_table_contianer">
        <table id="request_service_client">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Subject</td>
                    <td>User</td>
                    <td>Details</td>
                    <td>Created at</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($result as $key=>$value)
                {
                    $view_link=admin_url() .'admin.php'. '?page=fenix-people-messages-admin-inbox-details-view&id=' . $value->id;
                    ?>
                    <tr>
                        <td>#<?=$value->id?></td>
                        <td><?=$value->subject?></td>
                        <td><?=enc_get_client_name_by_message_subject($value->id)?></td>
                        <td><a  href="<?=$view_link?>" class="button"  style="background-color: #009B00;color: black">Details</a></td>
                        <td><?=$value->created_at?></td>
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
//$path_download_js=WP_PLUGIN_DIR . '/fenix-people-addon/assets/js/submitted-service-request-download-js.php';
//$css_path=WP_PLUGIN_DIR . '/fenix-people-addon/assets/css/submitted-service-request-css.php';
//include_once($path_download_js);
//include_once($css_path);

include_once( dirname( __FILE__ ).'/inbox_message_admin_css.php');
include_once( dirname( __FILE__ ).'/inbox_message_admin_js.php');