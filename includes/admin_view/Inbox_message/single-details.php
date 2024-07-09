<div class="message_main_container">
  <?php
  global $wpdb;
  
  $encoderit_fenix_people_chat_subjects = $wpdb->prefix . 'encoderit_fenix_people_chat_subjects';
  $encoderit_fenix_people_chats = $wpdb->prefix . 'encoderit_fenix_people_chats';

  $subject_id=$_GET['id'];
  if(empty($subject_id))
  {
     echo "404 not allowed";
     exit;
  }
  $subject_id=filter_var($subject_id, FILTER_SANITIZE_NUMBER_INT);
  $user_id=1;

  $get_message_by_subject="SELECT * FROM " . $encoderit_fenix_people_chats . "
          where subject_id=$subject_id and (sender_id=$user_id or receiver_id=$user_id)";

  $get_subject_name="SELECT * FROM " . $encoderit_fenix_people_chat_subjects . "
          where id=$subject_id";        

 $messages=$wpdb->get_results($get_message_by_subject); 
 if(empty($messages))
 {
  echo "404 not allowed";
  exit;
 }
 $get_subject_name=$wpdb->get_row($get_subject_name);

 $get_client_user_name="SELECT * FROM " . $encoderit_fenix_people_chats . "
 where subject_id=$subject_id and (sender_id <> $user_id or receiver_id <> $user_id)";
 
 $get_client_user_name=$wpdb->get_row($get_client_user_name);
 
 $client_id=$get_client_user_name->sender_id == 1 ? $get_client_user_name->receiver_id :$get_client_user_name->sender_id;  
 

 $user_info_showing_id=$client_id;
 $user_showing=get_user_by('ID',$user_info_showing_id);
 $full_name='';
 $first_name=get_user_meta( $user_id, 'first_name', true );
 $last_name=get_user_meta( $user_id, 'last_name', true );
 $full_name=$first_name.' '.$last_name;

  ?>
  <div class="message_div">
    <h2 class="user_name_chat"><?php echo $get_subject_name->subject?>  <?php echo  !empty($user_showing->display_name) ? $user_showing->display_name : (!empty($full_name) ? $full_name : $user_showing->user_email)?></h2>
   <?php
        if(!empty($messages))
        {
        foreach($messages as $key=>$val)
        {
            if($val->sender_id == $client_id)
            {
                if($val->is_file == 0)
                {
                  ?>
                  <div class="message_view user">
                    <div class="view_inner">
                      <p class="enc-white cursor_title" title="<?=$val->created_at?>"><?=$val->message?> </p>
                    </div>
                  </div>
                  <?php
                }else
                {
                  $file_data=json_decode($val->message,true);?>
                  <div class="message_view user">
                    <div class="view_inner">
                    <p class="cursor_title" title="<?=$val->created_at?>"><?php echo '<a href="'.wp_upload_dir()["baseurl"].$file_data['paths'].'" target="_blank">'.$file_data['name'].'</a>';?> </p>
                    </div>
                  </div>
                  <?php
                }
               
            }else
            {
                if($val->is_file == 0)
                {
                    ?>
                    <div class="message_view admin">
                      <div class="view_inner">
                        <p class="enc-aquamarine cursor_title" title="<?=$val->created_at?>"><?=$val->message?> </p>
                      </div>
                    </div>
                    <?php
                }else
                {
                  $file_data=json_decode($val->message,true);
                  ?>
                    <div class="message_view admin">
                      <div class="view_inner">
                      <p class="cursor_title" title="<?=$val->created_at?>"><?php echo '<a href="'.wp_upload_dir()["baseurl"].$file_data['paths'].'" target="_blank">'.$file_data['name'].'</a>';?> </p>
                      </div>
                    </div>
                    <?php
                }
                
            }
        }
        }
   ?>
  </div>
  <?php

         
?>
<div class="admin_mesage_send_cont">
  <!-- <label for="">Send Message</label> -->
  <i class="fa fa-file icon" id="send_message_by_admin_file_icon"></i>
  <input type="file" id="send_message_by_admin_file"/>
  <input type="text" id="send_message_by_admin" placeholder=" Select file or text mode by click on file icon">
  <button id="send_message_by_admin_btn">
    <img src="<?php  echo esc_url(MY_PLUGIN_URL . 'assets/images/send_icon.png'); ?>" alt="Send Message">
  </button>
</div>

</div>
<?php
include_once( dirname( __FILE__ ).'/inbox_message_admin_css.php');
include_once( dirname( __FILE__ ).'/inbox_message_admin_js.php');