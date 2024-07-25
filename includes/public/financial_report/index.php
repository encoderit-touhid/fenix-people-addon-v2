<?php
 global $wpdb;
  
 $encoderit_fenix_people_financial_report = $wpdb->prefix . 'encoderit_fenix_people_financial_report';


 $user_id=get_current_user_id();
 if(empty($user_id))
 {
    echo "404 not allowed";
    exit;
 }
 $get_client_user_name="SELECT * FROM " . $encoderit_fenix_people_financial_report . "
 where user_id=$user_id order by id desc";
 
 $get_client_user_name=$wpdb->get_results($get_client_user_name);
 
// if(empty($get_client_user_name))
// {
//     echo "404 not allowed";
//     exit;
// }  

?>

<div class="enc-white">
    <table id="financial_report_by_user">
        <thead>
            <tr>
                <th>SL.</th>
                <th>Report Title</th>
                <th>Message (if any)</th>
                <th>Show Files</th>
                <th>Report Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($get_client_user_name as $key=>$value)
            {
                $download_button_tag=null;
                $files_by_admin=json_decode($value->report_file,true);
            
                $is_ssl=false;
                if(str_contains(site_url(), 'https'))
                {
                    $is_ssl=true;
                }
                $files=[];
                $file_html='';
                foreach ($files_by_admin as $file) {
                    if($is_ssl)
                    {

                        $file_path = str_replace("http://","https://",wp_upload_dir()['baseurl'].$file['paths']);
                    }else
                    {
                        $file_path = wp_upload_dir()['baseurl'].$file['paths'];
                    }
                    array_push($files,$file_path);
                    $file_html .='<a href="'.$file_path.'" class="btn btn-primary">'.$file['name'].'</a> <br>';
                }
                $case_id=$value->id;
                $a=implode(',',$files);
            
                $file_name_string='#'.$case_id.'-'.date('Y-m-d-H-i-s').'-'.$value->user_id;
                $id="user_id_enc_don_".$case_id;
                //$download_button_tag='<a href="#" class="btn btn-primary"  data-case="'.$case_id.'" data-name="'.$file_name_string.'"   data-file="'.$a.'" id="'.$id.'" onclick="enc_download(this.id)">Download ZIP</a>';
                $single_report_link=site_url() .'/my-account/user-financial-report-single-file-download/?report_id='.$case_id ;
                $download_button_tag='<a href="'.$single_report_link.'" class="btn btn-primary">View Files</a>';
                
                
                
            ?>
            <tr>
                <td><?php echo $key+1?></td>
                <td><?php echo $value->report_title?></td>
                <td><?php echo $value->report_content?></td>
                <td><?php echo $file_html?></td>
                <td><?php echo $value->created_at?></td>
            </tr>
            <?php     
            }
            ?>
        </tbody>
    </table>
</div>




<?php
include_once( dirname( __FILE__ ).'/financial_report_report_list_to_user_css.php');
include_once( dirname( __FILE__ ).'/financial_report_report_list_to_user_js.php');



