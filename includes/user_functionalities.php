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
                global $wpdb;
                $table_name = $wpdb->prefix . 'encoderit_fenix_people_chats';

                $data = array(
                    "sender_id" => wp_get_current_user()->ID,
                    "receiver_id" => 1,
                    "message" => $_POST['message'],
                    "created_at" => date('Y-m-d H:i:s'),
                  );
                 $wpdb->insert($table_name, $data);

                 self::message_notification_to_admin();
                 echo json_encode([
                    'success' => 'success',
                    
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
}