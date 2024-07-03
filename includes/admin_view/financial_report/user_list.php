<?php
$user_query = new WP_User_Query( array(
    'role__not_in' => array( 'Administrator' ),
    'fields' => 'all'
) );

$users = $user_query->get_results();
?>
<div class="full_width pe_20">
<table id="financial_document_admin" class="full_width">
    <thead>
        <tr>
            <th>SL.</th>
            <th>User Name</th>
            <th>Sent Status</th>
            <th>Last Sent</th>
            <th>Control</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($users as $key=>$value)
        {
            $get_the_financial_report_sent_status=get_the_financial_report_sent_status($value->ID)
           ?>
           <tr>
            <td><?php echo $key+1?></td>
            <td><?php echo $value->display_name?></td>
            <td id="sent_status_<?php echo $value->ID?>"><?php echo !empty($get_the_financial_report_sent_status) ? "Sent" :"Not sent any"?></td>
            <td id="created_status_<?php echo $value->ID?>"><?php echo !empty($get_the_financial_report_sent_status->created_at) ? $get_the_financial_report_sent_status->created_at :" " ?></td>
            <td>
                <a href="<?php echo admin_url() .'admin.php?page=fenix-people-financial-report-admin-report-list-by-user&id='.$value->ID ?>" class="btn btn-primary view_financial_report_modal" data-user_id="<?=$value->ID?>">Details</a>
                <a href="" class="btn btn-secondary adding_financial_report_modal" data-user_id="<?=$value->ID?>">Add</a>
            </td>
           </tr>
           <?php     
        }
        ?>
    </tbody>
</table>
</div>
<div class="modal fade mngt_tbl_modal" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add New Financial Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="bg-secondary p-3 m-2">
                <input type="hidden" id="user_id_to_report">
                <label for="" class="form-label">Enter Your Report Title</label>
                <input type="text" id="report_title" id_handler="role_name" name="role_name_1" class="form-control" required>
                <label for="" class="form-label">Enter Your Comments (if Any)</label>
                <textarea name="" id="report_content" class="form-control"></textarea>
                <label for="">Add Files</label>
                <button id="addFile" class="btn btn-primary">Add File</button>
                <div id="file_adding_div"></div>
                  <br>
                <button id="add_report" class="btn btn-primary">Submit Report</button>
        </div>
            </div>
        </div>
    </div>
</div>




<?php
include_once( dirname( __FILE__ ).'/financial_report_css.php');
include_once( dirname( __FILE__ ).'/financial_report_js.php');

