
<?php 


class fenix_people_admin_functionalities
{
    public static function get_service_list()
    {
        require_once( dirname( __FILE__ ).'/admin_view/service/index.php' );
        
    }
    public static function add_new_service()
    {
        require_once( dirname( __FILE__ ).'/admin_view/service/add.php' );
    }
    public static function update_service()
    {
        require_once( dirname( __FILE__ ).'/admin_view/service/update.php' );
    }
    public static function  fenix_people_service_add_ajax_callback()
    {
        ob_clean();
        if (!wp_verify_nonce($_POST['nonce'], 'fenix_people_add_service_admin')) {
            echo json_encode([
                'success' => 'error',
                'message'=>'Invalid Nonce field'
            ]);
             
        }
        else
        {
            
           
                if(empty($_POST["service_name"]) || empty($_POST["service_price"]))
                {
                    echo json_encode([
                        'success' => 'error',
                        'message'=>'Please input name and price'
                    ]);
                }else
                {
                    global $wpdb;
                    $table_name = $wpdb->prefix . 'encoderit_fenix_people_services';
                    $search_data=$_POST["service_name"];
                    $sql="SELECT * FROM " . $table_name . " WHERE service_name = '$search_data'";
                    $result=$wpdb->get_row($sql);
                    if(!empty($result))
                    {
                    
                       echo json_encode([
                        'success'=>'error',
                        'message'=> $search_data ." is already in database"
                    ]);
                    }else
                    {
                        $data = array(
                            "service_name" => $_POST["service_name"],
                            "service_price" => $_POST["service_price"],
                            "created_at" => date('Y-m-d H:i:s'),
                            "updated_at" => date('Y-m-d H:i:s'),
                          );
                          $inserted = $wpdb->insert($table_name, $data);
                          if($inserted)
                          {
                              $service_name=$_POST['service_name'];
                            echo json_encode([
                                'success'=>'success',
                                'message'=>"Successfully inserted"
                              ]);
                          }
                    }
                   
                }

            

        }
        
      
      wp_die();   
    }
    public static function fenix_people_service_update_ajax_callback()
    {
        ob_clean();
        if (!wp_verify_nonce($_POST['nonce'], 'fenix_people_service_update_ajax_callback')) {
            echo json_encode([
                'success' => 'error',
                'message'=>'Invalid Nonce field'
            ]);
             
        }
        else
        {
            
           
                if(empty($_POST["service_name"]) || empty($_POST["service_price"]))
                {
                    echo json_encode([
                        'success' => 'error',
                        'message'=>'Please input name and price'
                    ]);
                }else
                {
                    global $wpdb;
                    $table_name = $wpdb->prefix . 'encoderit_fenix_people_services';
                    $search_data=$_POST["service_name"];
                    $ID=$_POST['service_id'];
                    $sql="SELECT * FROM " . $table_name . " WHERE service_name = '$search_data' and id <> $ID";
                    $result=$wpdb->get_row($sql);
                    if(!empty($result))
                    {
                    
                       echo json_encode([
                        'success'=>'error',
                        'message'=> $search_data ." is already in database"
                    ]);
                    }else
                    {
                        $data = array(
                            "service_name" => $_POST["service_name"],
                            "service_price" => $_POST["service_price"],
                            "is_active"=>$_POST["service_active"],
                            "created_at" => date('Y-m-d H:i:s'),
                            "updated_at" => date('Y-m-d H:i:s'),
                          );
                          $where=[
                            'id'=>$ID
                          ];
                          $inserted = $wpdb->update($table_name, $data, $where);
                          if($inserted)
                          {
                              $service_name=$_POST['service_name'];
                            echo json_encode([
                                'success'=>'success',
                                'message'=>"Successfully updated"
                              ]);
                          }
                    }
                   
                }
        }
        wp_die();
    }

    public static function fenix_people_service_request()
    {
        require_once( dirname( __FILE__ ).'/admin_view/request_services/index.php' );
    }
    public static function fenix_people_service_request_details_view_admin()
    {
        require_once( dirname( __FILE__ ).'/admin_view/request_services/details_view.php' );
    }

    public static function fenix_people_admin_file_submit()
    {
        $erros=self::check_validation_data_request();
        
        if (!wp_verify_nonce($_POST['nonce'], 'fenix_people_admin_file_submit')) {
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
            $table_name = $wpdb->prefix . 'encoderit_fenix_people_form';
        
            $data = array(
                'files_by_admin' => self::save_files_by_admin(),
                'updated_by' => wp_get_current_user()->id,
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $where_condition=array(
                'id' => $_POST['form_id']
            );
             
            $inserted=$wpdb->update($table_name, $data, $where_condition);

                if($inserted)
                {
                    self::send_mail_to_user();

                    echo  json_encode([
                        'success' => 'success',
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

    public static function check_validation_data_request()
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
    public static function send_mail_to_user()
    {
        $search_data=$_POST['form_id'];

        global $wpdb;

        $table_name=$wpdb->prefix . 'encoderit_fenix_people_form';
        $sql="SELECT * FROM " . $table_name . " WHERE id = '$search_data'";
        $result=$wpdb->get_row($sql);
        $subscriber=get_user_by('ID',$result->user_id);

        $to = $subscriber->user_email;

		$subject = 'Admin Upload Files to Your Request ' . ' (' . $subscriber->display_name . ')';
        
        $view_service_request_link=site_url() .'/my-account/submitted-service-request-single-view/?form_id='.enc_encodeContent($search_data) ;

		$message = '<p>Admin Upload Files to Your Service Request Please Collect them </p>';
        
        $message .= '<p>To view Message click below</p>';
        $message .= '<a href="'.$view_service_request_link.'">Click Here</a>';

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		wp_mail($to, $subject, $message, $headers);
    }
    public static function save_files_by_admin()
    {
        global $wpdb;
        $id=$_POST['form_id'];
        $table_name = $wpdb->prefix . 'encoderit_fenix_people_form';
        $file_paths=[];
        $result = $wpdb->get_row("SELECT * FROM " . $table_name . " where id =$id");
        if(!empty($result->files_by_admin))
        {

            $file_paths=json_decode($result->files_by_admin,true);
        }
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

    public static function fenix_people_messages_admin()
    {
        require_once( dirname( __FILE__ ).'/admin_view/message/index.php' );
    }
    public static function fenix_people_messages_admin_details_view()
    {
        require_once( dirname( __FILE__ ).'/admin_view/message/details.php' );
    }
    public static function fenix_people_message_by_admin()
    {
        if (!wp_verify_nonce($_POST['nonce'], 'fenix_people_message_by_admin')) {
            echo json_encode([
                'success' => 'error',
                'message'=>'Invalid Nonce field'
            ]);
        }else
        {
            global $wpdb;
            $table_name = $wpdb->prefix . 'encoderit_fenix_people_chats';

            $data = array(
                "sender_id" => 1,
                "receiver_id" => $_POST['receiver_id'],
                "message" => $_POST['message'],
                "created_at" => date('Y-m-d H:i:s'),
              );
             $wpdb->insert($table_name, $data);
             self::message_notification_to_user();
             echo json_encode([
                'success' => 'success',
                
            ]);
        }
      wp_die(); 

    }
    public static function message_notification_to_user()
    {
         $to = get_user_by('ID', $_POST['receiver_id'])->user_email;
 
         $subject = 'Message sent from ' . ' (' . wp_get_current_user()->display_name . ')';
         //'/my-account/send-user-message/';
         $view_message_link=site_url(). '/my-account/send-user-message/';
 
         $message = '<p>To view Message click below</p>';
 
         $message .= '<a href="'.$view_message_link.'">Click Here</a>';
 
         $headers = "MIME-Version: 1.0" . "\r\n";
         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 
         wp_mail($to, $subject, $message, $headers);
    }
    public static function fenix_people_payment_gateway()
    {
        require_once( dirname( __FILE__ ).'/admin_view/payment_gateway/index.php' );
    }
    public static function encoder_it_set_payment_keys()
    {
        update_option('ENCODER_IT_STRIPE_PK',str_replace(' ', '', $_POST['ENCODER_IT_STRIPE_PK']));
        update_option('ENCODER_IT_STRIPE_SK',str_replace(' ', '', $_POST['ENCODER_IT_STRIPE_SK']));
        update_option('ENCODER_IT_PAYPAL_CLIENT',str_replace(' ', '', $_POST['ENCODER_IT_PAYPAL_CLIENT']));
        update_option('ENCODER_IT_PAYPAL_SECRET',str_replace(' ', '', $_POST['ENCODER_IT_PAYPAL_SECRET']));
         
        $ENCODER_IT_STRIPE_PK=get_option('ENCODER_IT_STRIPE_PK');
        $ENCODER_IT_STRIPE_SK=get_option('ENCODER_IT_STRIPE_SK');
        $ENCODER_IT_PAYPAL_CLIENT=get_option('ENCODER_IT_PAYPAL_CLIENT');
        $ENCODER_IT_PAYPAL_SECRET=get_option('ENCODER_IT_PAYPAL_SECRET');

        if($ENCODER_IT_STRIPE_PK == "pk_test_51OD1o3HXs2mM51TXR04wpLYzxxWNpOQWZr8Y84oV0Bp5aP1sB0gVic7JqBdrOgQmqYAwT7a9TOfq4UBG5ioifu9F00VwcHhkCb" || $ENCODER_IT_STRIPE_SK=="sk_test_51OD1o3HXs2mM51TXAPMu48pbSpxilR2QjxiXEipq60TE8y96wg51zs9qPSDZomhDtYGcmwIFPboEgFaHi1SINsNZ00FZ8b7i8R" || $ENCODER_IT_PAYPAL_CLIENT=="AaXp9zv9TqTd30YTT48MJgSQc_5A74dGcWoCKGfu75iqMYChNCh4drlXNB4gjmPDeUnbrLQjvWk-NNOI" || $ENCODER_IT_PAYPAL_SECRET=="EKqkmLLyfTgwswkdR-ME6J0Rco1jupQfNEZqiQW1Q20nbKv7C8a-WgwDemzBGQhpKT-DKfSyAx3ME7JE")
        {

            $message='<span style="color: tomato">Registered with Test Keys</span>';
        }elseif(isset($ENCODER_IT_STRIPE_PK) && !empty($ENCODER_IT_STRIPE_PK) && isset($ENCODER_IT_STRIPE_SK) && !empty($ENCODER_IT_STRIPE_SK) && isset($ENCODER_IT_PAYPAL_CLIENT) && !empty($ENCODER_IT_PAYPAL_CLIENT) && isset($ENCODER_IT_PAYPAL_SECRET) && !empty($ENCODER_IT_PAYPAL_SECRET))
        {
            $message='<span style="color: green">Registered</span>';
        }
        echo $message;
        wp_die();
    }
}