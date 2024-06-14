<div class="message_main_container">
  <?php
  global $wpdb;
  $table_name = $wpdb->prefix . 'encoderit_fenix_people_chats';
  $user_id=$_GET['id'];
  if(empty($user_id))
  {
     echo "404 not allowed";
     exit;
  }
  $user_id=filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
  if(!get_user_by('ID',$user_id))
  {
    echo "404 not allowed";
    exit;
  }

  $sql="SELECT * FROM " . $table_name . "
          where  sender_id=$user_id or receiver_id=$user_id";
     
  $messages=$wpdb->get_results($sql);
  ?>
  <div class="message_div">
    <h2 class="user_name_chat"> <?php echo get_user_by('ID',$user_id)->display_name;?></h2>
   <?php
        if(!empty($messages))
        {
        foreach($messages as $key=>$val)
        {
            if($val->sender_id == $user_id)
            {
                ?>
                <div class="message_view user">
                  <div class="view_inner">
                    <p class="enc-white"><?=$val->message?> </p>
                  </div>
                </div>
                <?php
            }else
            {
                ?>
                <div class="message_view admin">
                  <div class="view_inner">
                    <p class="enc-aquamarine"><?=$val->message?> </p>
                  </div>
                </div>
                <?php
            }
        }
        }
   ?>
  </div>
  <?php

         
?>
<div class="admin_mesage_send_cont">
  <!-- <label for="">Send Message</label> -->
  <input type="text" id="send_message_by_admin" placeholder="Type your message here">
  <button id="send_message_by_admin_btn">
    <img src="<?php  echo esc_url(MY_PLUGIN_URL . 'assets/images/send_icon.png'); ?>" alt="Send Message">
  </button>
</div>

</div>
<?php
$user_message_css=WP_PLUGIN_DIR . '/fenix-people-addon/assets/css/admin_message_css.php';
$user_message_js=WP_PLUGIN_DIR . '/fenix-people-addon/assets/js/admin_message_js.php';
include_once($user_message_css);
include_once($user_message_js);