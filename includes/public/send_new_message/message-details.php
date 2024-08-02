<?php
$subject_id=$_GET['id'];
if(empty($subject_id) || !isset($subject_id))
{
    echo "<h1>You are not Allowed</h1>";
    exit;
}
?>
<div class="message_main_container">
<?php
  global $wpdb;
  $table_name = $wpdb->prefix . 'encoderit_fenix_people_chats';
  $user_id=wp_get_current_user()->ID;
  $sql="SELECT * FROM " . $table_name . "
          where  subject_id=$subject_id and (sender_id=$user_id or receiver_id=$user_id)";
  //var_dump($sql);
  //exit;   
  $messages=$wpdb->get_results($sql);
  if(empty($messages))
  {
    echo "<h1>You are not Allowed</h1>";
    exit;
  }
  $wpfenix_encoderit_fenix_people_chat_subjects = $wpdb->prefix . 'encoderit_fenix_people_chat_subjects';
  $user_id=wp_get_current_user()->ID;
  $sql="SELECT * FROM " . $wpfenix_encoderit_fenix_people_chat_subjects . "
          where  id=$subject_id";
     
  $subject_name=$wpdb->get_row($sql)->subject;

  ?>
  <input id="message_details_for" value="<?php echo $subject_name?>" type="hidden">

  <div class="message_div">
   <?php
        if(!empty($messages))
        {
        foreach($messages as $key=>$val)
        {
            if($val->sender_id == $user_id)
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
                $file_data=json_decode($val->message,true);
                ?>
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
  <i class="fa fa-file icon" id="send_message_by_user_file_icon"></i>
  <input type="file" id="send_message_by_user_file"/>
   <input type="text" id="send_message_by_user" placeholder=" Select file or text mode by click on file icon">
  <button id="send_message_by_user_btn">
    <img src="<?php echo esc_url(MY_PLUGIN_URL . 'assets/images/send_icon.png'); ?>" alt="Send Message">
  </button>
</div>



</div>
<?php
include_once( dirname( __FILE__ ).'/message-details-css.php');
include_once( dirname( __FILE__ ).'/message-details-js.php');
