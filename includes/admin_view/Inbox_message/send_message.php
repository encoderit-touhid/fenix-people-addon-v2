<?php
global $wpdb;
$user_query = new WP_User_Query( array(
    'role__not_in' => array( 'Administrator' ),
    'fields' => 'all',
    
) );

$result = $user_query->get_results();

?>
<div class="enc-white">
    <div class="request_service_table_contianer full_width pe_20">
        <table id="request_service_client" class="full_width">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Send Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($result as $key=>$value)
                {
                    $first_name=get_user_meta( $value->ID, 'first_name', true );
                     $last_name=get_user_meta( $value->ID, 'last_name', true );
                     $full_name= $first_name.' '. $last_name;

                     $data_user_name_showing=!empty($value->display_name) ? $value->display_name : (!empty($full_name) ? $full_name : $value->user_email);
                    ?>
                    <tr>
                        <td>#<?=$key+1?></td>
                        <td><?=$value->display_name?></td>
                        <td><?=$value->user_email?></td>
                        <td><?php echo !empty($first_name) ? $first_name : '-' ?></td>
                        <td><?php echo !empty($last_name) ? $first_name : '-' ?></td>
                        <td><a href="" class="btn btn-primary adding_financial_report_modal" data-user_name="<?=$data_user_name_showing?>" data-user_id="<?=$value->ID?>">Send Message</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade mngt_tbl_modal" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Send New Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="p-3 m-2">
                <div class="mb-3">
                    <input type="hidden" id="user_id_to_message">
                    <label for="" class="form-label">Enter Message Subject</label>
                    <input type="text" id="subject" id_handler="role_name" name="role_name_1" class="form-control" required>
                </div>
               <div class="mb-3">
                    <label for="" class="form-label">Enter Your Message Here</label>
                    <textarea name="" id="report_content" class="form-control"></textarea>
               </div>
                <div class="mb-3">
                    <label for="">Add Files</label>
                    <div class="w-100">
                        <button id="addFile" class="btn btn-primary">Add File</button>
                    </div>
                </div>
                <div id="file_adding_div"></div>
                  <br>
                <button id="add_report" class="btn btn-primary">Submit Message</button>
        </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once( dirname( __FILE__ ).'/send_message_admin_css.php');
include_once( dirname( __FILE__ ).'/send_message_admin_js.php');

