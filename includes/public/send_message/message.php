<div class="message_main_container">
<?php
  global $wpdb;
  $table_name = $wpdb->prefix . 'encoderit_fenix_people_chats';
  $user_id=wp_get_current_user()->ID;
  $sql="SELECT * FROM " . $table_name . "
          where  sender_id=$user_id or receiver_id=$user_id";
     
  $messages=$wpdb->get_results($sql);
  ?>
  <div class="message_div">
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
   <input type="text" id="send_message_by_user" placeholder="Type your message here">
  <button id="send_message_by_user_btn">
    <img src="<?php echo esc_url(MY_PLUGIN_URL . 'assets/images/send_icon.png'); ?>" alt="Send Message">
  </button>
</div>



</div>
<?php
$user_message_css=WP_PLUGIN_DIR . '/fenix-people-addon/assets/css/user_message_css.php';
$user_message_js=WP_PLUGIN_DIR . '/fenix-people-addon/assets/js/user_message_js.php';
include_once($user_message_css);
include_once($user_message_js);