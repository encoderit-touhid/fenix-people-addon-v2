<?php 


class fenix_people_user_functionalities
{
   public static function fenix_people_message_by_user()
   {
            
            if (!wp_verify_nonce($_POST['nonce'], 'fenix_people_message_by_user')) {
                echo json_encode([
                    'success' => 'error',
                    'message'=>'Invalid Nonce field'
                ]);
            }else
            {
                $message=$_POST['message'];
                $is_file=0;
                $file_url=null;
                if(!empty($_FILES))
                {
                   $message=self::save_message_file_by_user();
                   $file_data=json_decode($message,true);
                   $file_url='<a href="'.wp_upload_dir()["baseurl"].$file_data['paths'].'" target="_blank">'.$file_data['name'].'</a>';
                 //  exit;
                   $is_file=1;
                }
                global $wpdb;
                $table_name = $wpdb->prefix . 'encoderit_fenix_people_chats';

                $data = array(
                    "sender_id" => wp_get_current_user()->ID,
                    "receiver_id" => 1,
                    "message" => $message,
                    "is_file" => $is_file,
                    "created_at" => date('Y-m-d H:i:s'),
                  );
                 $wpdb->insert($table_name, $data);

                 self::message_notification_to_admin();
                 echo json_encode([
                    'success' => 'success',
                    'file_url'=>$file_url
                ]);
               

            }
        wp_die();    
   }
   public static function message_notification_to_admin()
   {
        $to = get_option('admin_email');

        $subject = 'Message sent from ' . ' (' . wp_get_current_user()->display_name . ')';
        $view_message_link=admin_url() .'admin.php'. '?page=fenix-people-messages-admin-details-view&id=' . wp_get_current_user()->ID;

        $message = '<p>To view Message click below</p>';

        $message .= '<a href="'.$view_message_link.'">Click Here</a>';

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        wp_mail($to, $subject, $message, $headers);
   }
   public static function save_message_file_by_user()
   {
        $file_paths=[];
        $wordpress_upload_dir = wp_upload_dir();
   // foreach($_FILES['files']['name'] as $key=>$value)
    //{

        $tail='';
        $file_name_with_addition='';
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $_FILES['files']['name'];
        $i=1;
        while (file_exists($new_file_path)) {
            $i++;
            $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' .$_FILES['files']['name'];
        }
        if (move_uploaded_file($_FILES['files']['tmp_name'], $new_file_path)) {
            if($i>1)
            {
                //$string_json_path_Single=$wordpress_upload_dir['url'].'/' . $i . '_' .$value;
                $tail=$wordpress_upload_dir['subdir'].'/' . $i . '_' .$_FILES['files']['name'];
                $file_name_with_addition= $i . '_' .$_FILES['files']['name'];
            }else
            {
                //$string_json_path_Single=$wordpress_upload_dir['url'].'/'.$value; 
                $tail=$wordpress_upload_dir['subdir'].'/'.$_FILES['files']['name'];
                $file_name_with_addition= $_FILES['files']['name']; 
            }
            
        $single_file=[
            'name'=>$file_name_with_addition,
            'paths'=>$tail
        ];
         return json_encode($single_file);
        }   
    //}
    
   }
}