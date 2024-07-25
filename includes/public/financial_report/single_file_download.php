<?php
$report_id=$_GET['report_id'];

//var_dump($form_id);
//exit;

if(empty($report_id) )
{
    echo "404 not allowed";
    exit;
}
global $wpdb;
$user_id=get_current_user_id();  
$encoderit_fenix_people_financial_report = $wpdb->prefix . 'encoderit_fenix_people_financial_report';

$get_client_user_name="SELECT * FROM " . $encoderit_fenix_people_financial_report . "
where user_id=$user_id and id=$report_id";

$get_client_user_name=$wpdb->get_row($get_client_user_name);

$files_by_admin=json_decode($get_client_user_name->report_file,true);
//var_dump($files_by_admin);
//exit;
?>
<div class="enc-white">
    <table id="financial_report_by_user">
        <thead>
            <tr>
                <th>SL.</th>
                <th>FiLe Name</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($files_by_admin as $key=>$value)
            {
                $link='<a href="'.wp_upload_dir()['baseurl'].$value['paths'].'" class="btn btn-primary text-decoration-none">View</a>'    
            ?>
            <tr>
                <td><?php echo $key+1?></td>
                <td><?php echo $value['name']?></td>
                <td><?php echo $link?></td>
            </tr>
            <?php     
            }
            ?>
        </tbody>
    </table>
</div>

<?php


?>
<?php
include_once( dirname( __FILE__ ).'/financial_report_single_css.php');
include_once( dirname( __FILE__ ).'/financial_report_single_js.php');
