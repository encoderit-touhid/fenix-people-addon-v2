<?php
 global $wpdb;
  
 $encoderit_fenix_people_financial_report = $wpdb->prefix . 'encoderit_fenix_people_financial_report';


 $report_id=$_GET['id'];
 if(empty($report_id))
 {
    echo "404 not allowed";
    exit;
 }
 $get_client_user_name="SELECT * FROM " . $encoderit_fenix_people_financial_report . "
 where id=$report_id order by id desc";
 
 $get_client_user_name=$wpdb->get_row($get_client_user_name);
 //var_dump($get_client_user_name);
 //exit;

// if(empty($get_client_user_name))
// {
//     echo "404 not allowed";
//     exit;
// }  
$user_id=$get_client_user_name->user_id;
$user=get_user_by('ID',$user_id);
$full_name='';
$first_name=get_user_meta( $user_id, 'first_name', true );
$last_name=get_user_meta( $user_id, 'last_name', true );
$full_name=$first_name.' '.$last_name;
$files_by_admin=json_decode($get_client_user_name->report_file,true);
?>
<div class="full_width pe_20">
    <h2 class="text-center m-3"><?=$get_client_user_name->report_title?> for <?php echo  !empty($user->display_name) ? $user->display_name : (!empty($full_name) ? $full_name : $user->user_email)  ?></h2>
<table id="financial_report_by_user" class="full_width">
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
                $link='<a href="'.wp_upload_dir()['baseurl'].$value['paths'].'" class="btn btn-primary text-decoration-none">view</a>'    
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
include_once( dirname( __FILE__ ).'/single_details_css.php');
include_once( dirname( __FILE__ ).'/single_details_js.php');



