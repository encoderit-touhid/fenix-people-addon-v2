<?php
class manage_financial_report
{
    public static function user_list_admin()
    {
        require_once( dirname( __FILE__ ).'/admin_view/financial_report/user_list.php' );
    }
    public static function admin_financial_report_submit()
    {
        
        $erros=self::check_validation_data_request_admin();
        
        if (!wp_verify_nonce($_POST['nonce'], 'admin_financial_report_submit')) {
            echo json_encode([
                'success' => 'error',
                'message'=>'Invalid Nonce field'
            ]);
        }elseif(!empty($erros))
        {
            echo $erros;
        }
        else
        {
            
            global $wpdb;
            $table_name = $wpdb->prefix . 'encoderit_fenix_people_financial_report';
        
            $data = array(
                'report_file' => self::save_files_by_admin(),
                'report_title' => $_POST['report_title'],
                'report_content'=>$_POST['report_content'],
                'user_id'=>$_POST['user_id'],
                'created_at' => date('Y-m-d H:i:s'),
            );
             
            $inserted=$wpdb->insert($table_name, $data);

                if($inserted)
                {
                    self::send_mail_to_user();

                    echo  json_encode([
                        'success' => 'success',
                        'created_at' => date('Y-m-d H:i:s'),
                        'message'=>'Form Submmited Successfully'
                    ]);
                }else
                {
                    echo  json_encode([
                        'success' => 'error',
                        'message'=>'Something worng.;'
                    ]);
                }
        }
        wp_die();
    }
    public static function check_validation_data_request_admin()
    {
        $message='';
         if(empty($_FILES))
         {
            $message .='Please Input files.;';
         }
         if(!empty($message))
         {
            return json_encode([
                'success' => 'error',
                'message'=>$message
            ]);
         }else
         {
            return;
         }
    }
    public static function save_files_by_admin()
    {
       
        $file_paths=[];
        $wordpress_upload_dir = wp_upload_dir();
       foreach($_FILES['file_array']['name'] as $key=>$value)
       {

         $tail='';
         $file_name_with_addition='';
         $new_file_path = $wordpress_upload_dir['path'] . '/' . $value;
         $i=1;
         while (file_exists($new_file_path)) {
            $i++;
            $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' .$value;
        }
        if (move_uploaded_file($_FILES['file_array']['tmp_name'][$key], $new_file_path)) {
            if($i>1)
            {
                //$string_json_path_Single=$wordpress_upload_dir['url'].'/' . $i . '_' .$value;
                $tail=$wordpress_upload_dir['subdir'].'/' . $i . '_' .$value;
                $file_name_with_addition= $i . '_' .$value;
            }else
            {
                //$string_json_path_Single=$wordpress_upload_dir['url'].'/'.$value; 
                $tail=$wordpress_upload_dir['subdir'].'/'.$value;
                $file_name_with_addition= $value; 
            }
            
           $single_file=[
            'name'=>$file_name_with_addition,
            'paths'=>$tail
           ];
           array_push($file_paths,$single_file);
        }   
       }
       return json_encode($file_paths);
    }
    
    public static function send_mail_to_user()
    {
        $user_id=$_POST['user_id'];

        global $wpdb;

       // $table_name=$wpdb->prefix . 'encoderit_fenix_people_form';
       // $sql="SELECT * FROM " . $table_name . " WHERE id = '$search_data'";
      //  $result=$wpdb->get_row($sql);
        $subscriber=get_user_by('ID',$user_id);

        $to = $subscriber->user_email;

		$subject = 'Admin Upload Financial Report ' . ' (' . $subscriber->display_name . ')';
        
        $view_service_request_link=site_url() .'/my-account/user-financial-report' ;

		$message = '<p>Admin Upload Financial Report , Please Collect them from your profile</p>';
        
        $message .= '<p>To View Report click below</p>';
        $message .= '<a href="'.$view_service_request_link.'">Click Here</a>';

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		wp_mail($to, $subject, $message, $headers);
    }
    public static function fenix_people_financial_report_admin_report_list_by_user()
    {
        require_once( dirname( __FILE__ ).'/admin_view/financial_report/report_by_user_list.php' );
    }
}