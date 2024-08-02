<?php

class message_inbox_functionalities
{
     public static function message_inbox_functionalities_admin_user_list()
     {
        require_once( dirname( __FILE__ ).'/admin_view/inbox_message/message.php' );
     }
     public static function message_inbox_functionalities_admin_single_user_index()
     {
        require_once( dirname( __FILE__ ).'/admin_view/inbox_message/single-details.php' );
     }

     public static function fenix_people_message_by_user_with_subject()
     {
        //var_dump($_POST);
        //exit;
      if (!wp_verify_nonce($_POST['nonce'], 'fenix_people_message_by_user_with_subject')) {
         echo json_encode([
             'success' => 'error',
             'message'=>'Invalid Nonce field'
         ]);
     }else
     {
         $admin_notify_id=null;
         $message=$_POST['message'];
         $message_subject=null;
         $subject_id=null;
         $is_new_subject=false;
         if(isset($_POST['message_subject']) && !empty($_POST['message_subject']))
         {
            $message_subject=$_POST['message_subject'];
            $is_new_subject=true;
         }elseif(isset($_POST['subject_id']) && !empty($_POST['subject_id']))
         {
            $subject_id=$_POST['subject_id'];
         }
         $is_file=0;
         $file_url=null;
         if(!empty($_FILES))
         {
            $message=self::save_message_file_by_user();
            $file_data=json_decode($message,true);
            $file_url='<a style="color:#262626 !important" href="'.wp_upload_dir()["baseurl"].$file_data['paths'].'" target="_blank">'.$file_data['name'].'</a>';
          //  exit;
            $is_file=1;
         }
         global $wpdb;
         if($is_new_subject)
         {
            $wpfenix_encoderit_fenix_people_chat_subjects=$wpdb->prefix . 'encoderit_fenix_people_chat_subjects';
            $data = array(
                "subject" => $message_subject,
                "created_at" => date('Y-m-d H:i:s'),
              );
             $wpdb->insert($wpfenix_encoderit_fenix_people_chat_subjects, $data);
             $lastid = $wpdb->insert_id;
             $admin_notify_id=$lastid;
             $table_name = $wpdb->prefix . 'encoderit_fenix_people_chats';

             $data = array(
                "sender_id" => wp_get_current_user()->ID,
                "receiver_id" => 1,
                "subject_id" => $lastid,
                "message" => $message,
                "is_file" => $is_file,
                "created_at" => date('Y-m-d H:i:s'),
              );
             $wpdb->insert($table_name, $data);
         }else
         {
            $table_name = $wpdb->prefix . 'encoderit_fenix_people_chats';

            $data = array(
               "sender_id" => wp_get_current_user()->ID,
               "receiver_id" => 1,
               "subject_id" => $subject_id,
               "message" => $message,
               "is_file" => $is_file,
               "created_at" => date('Y-m-d H:i:s'),
             );
            $wpdb->insert($table_name, $data);
            $admin_notify_id=$subject_id;
         }

         

        

          self::message_notification_to_admin($admin_notify_id);
          echo json_encode([
             'success' => 'success',
             'file_url'=>$file_url
         ]);
        

     }
     wp_die();    
     }
     public static function message_notification_to_admin($admin_notify_id)
     {
          $to = get_option('admin_email');
  
          $subject = 'Message sent from ' . ' (' . wp_get_current_user()->display_name . ')';
          $view_message_link=admin_url() .'admin.php'. '?page=fenix-people-messages-admin-inbox-details-view&id=' . $admin_notify_id;
  
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

     public static function fenix_people_message_by_admin_with_subject()
     {
        //var_dump($_POST);
        //exit;

         if (!wp_verify_nonce($_POST['nonce'], 'fenix_people_message_by_admin_with_subject')) {
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
                $message=fenix_people_user_functionalities::save_message_file_by_user();
                $file_data=json_decode($message,true);
                $file_url='<a style="color:#262626 !important" href="'.wp_upload_dir()["baseurl"].$file_data['paths'].'" target="_blank">'.$file_data['name'].'</a>';
              //  exit;
                $is_file=1;
             }
             global $wpdb;
             $table_name = $wpdb->prefix . 'encoderit_fenix_people_chats';
 
             $data = array(
                 "sender_id" => 1,
                 "subject_id"=>$_POST['subject_id'],
                 "receiver_id" => $_POST['receiver_id'],
                 "message" => $message,
                 "is_file" => $is_file,
                 "created_at" => date('Y-m-d H:i:s'),
               );
              $wpdb->insert($table_name, $data);
              self::message_notification_to_user($_POST['subject_id']);
              echo json_encode([
                 'success' => 'success',
                 'file_url'=>$file_url
                 
             ]);
         }
       wp_die(); 
 
     }
     public static function message_notification_to_user($subject_id)
     {
          $to = get_user_by('ID', $_POST['receiver_id'])->user_email;
  
          $subject = 'Message sent from ' . ' (' . wp_get_current_user()->display_name . ')';
          //'/my-account/send-user-message/';
          $view_message_link=site_url(). '/my-account/send-user-details-message/?id='.$subject_id;
  
          $message = '<p>To view Message click below</p>';
  
          $message .= '<a href="'.$view_message_link.'">Click Here</a>';
  
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  
          wp_mail($to, $subject, $message, $headers);
     }

     public static function fenix_people_message_by_user_with_subject_message_file_in_single_message()
     {
        
        if (!wp_verify_nonce($_POST['nonce'], 'fenix_people_message_by_user_with_subject_message_file_in_single_message')) {
            echo json_encode([
                'success' => 'error',
                'message'=>'Invalid Nonce field'
            ]);
        }else
        {
            global $wpdb;
            $message_subject=$_POST['message_subject'];
            $message=$_POST['message'];
            $wpfenix_encoderit_fenix_people_chat_subjects=$wpdb->prefix . 'encoderit_fenix_people_chat_subjects';
            $data = array(
                "subject" => $message_subject,
                "created_at" => date('Y-m-d H:i:s'),
              );
             $wpdb->insert($wpfenix_encoderit_fenix_people_chat_subjects, $data);
             $lastid = $wpdb->insert_id;
             $admin_notify_id=$lastid;
             $encoderit_fenix_people_chats = $wpdb->prefix . 'encoderit_fenix_people_chats';
             if(!empty($_FILES))
             {
                $saved_files=manage_financial_report::save_files_by_admin();
                foreach(json_decode($saved_files,true) as $single_content)
                {
                    
                    $data = array(
                        "sender_id" => wp_get_current_user()->ID,
                        "subject_id"=>$admin_notify_id,
                        "receiver_id" => 1,
                        "message" => json_encode($single_content),
                        "is_file" => 1,
                        "created_at" => date('Y-m-d H:i:s'),
                      );
                     $wpdb->insert($encoderit_fenix_people_chats, $data);
                } 
             }
             $data = array(
                "sender_id" => wp_get_current_user()->ID,
                "subject_id"=>$admin_notify_id,
                "receiver_id" => 1,
                "message" => $message,
                "is_file" => 0,
                "created_at" => date('Y-m-d H:i:s'),
              );
             $wpdb->insert($encoderit_fenix_people_chats, $data);

             self::message_notification_to_admin($admin_notify_id);
             echo json_encode([
                'success' => 'success',
            ]);
        }
        wp_die();
     }
     public static function message_inbox_functionalities_admin_user_list_send_message()
     {
        require_once( dirname( __FILE__ ).'/admin_view/inbox_message/send_message.php' );
     }

     public static function fenix_people_message_by_admin_with_subject_message_file_in_single_message()
     {
        
        if (!wp_verify_nonce($_POST['nonce'], 'fenix_people_message_by_admin_with_subject_message_file_in_single_message')) {
            echo json_encode([
                'success' => 'error',
                'message'=>'Invalid Nonce field'
            ]);
        }else
        {
            global $wpdb;
            $message_subject=$_POST['subject'];
            $message=$_POST['message_content'];
            $receiver_id=$_POST['receiver_id'];
            $wpfenix_encoderit_fenix_people_chat_subjects=$wpdb->prefix . 'encoderit_fenix_people_chat_subjects';
            $data = array(
                "subject" => $message_subject,
                "created_at" => date('Y-m-d H:i:s'),
              );
             $wpdb->insert($wpfenix_encoderit_fenix_people_chat_subjects, $data);
             $lastid = $wpdb->insert_id;
             $admin_notify_id=$lastid;
             $encoderit_fenix_people_chats = $wpdb->prefix . 'encoderit_fenix_people_chats';
             if(!empty($_FILES))
             {
                $saved_files=manage_financial_report::save_files_by_admin();
                foreach(json_decode($saved_files,true) as $single_content)
                {
                    
                    $data = array(
                        "sender_id" => 1,
                        "subject_id"=>$admin_notify_id,
                        "receiver_id" => $receiver_id,
                        "message" => json_encode($single_content),
                        "is_file" => 1,
                        "created_at" => date('Y-m-d H:i:s'),
                      );
                     $wpdb->insert($encoderit_fenix_people_chats, $data);
                } 
             }
             $data = array(
                "sender_id" => 1,
                "subject_id"=>$admin_notify_id,
                "receiver_id" => $receiver_id,
                "message" => $message,
                "is_file" => 0,
                "created_at" => date('Y-m-d H:i:s'),
              );
             $wpdb->insert($encoderit_fenix_people_chats, $data);

            // self::message_notification_to_admin($admin_notify_id);
             self::message_notification_to_user($admin_notify_id);

             $redirect_to=admin_url() .'admin.php'. '?page=fenix-people-messages-admin-inbox-details-view&id=' . $admin_notify_id;
             echo json_encode([
                'success' => 'success',
                'redirect_to'=>$redirect_to
            ]);
        }
        wp_die();
     }
}
