<div class="">
<div class="container mt-4">
    <div class="row">
      <div class="col-md-4">
        <ul class="nav nav-tabs flex-column" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="inbox-tab" data-bs-toggle="tab" href="#inbox" role="tab" aria-controls="inbox" aria-selected="true">Inbox</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="send-message-tab" data-bs-toggle="tab" href="#send-message" role="tab" aria-controls="send-message" aria-selected="false">Send message</a>
          </li>
        </ul>
      </div>
      <div class="col-md-8">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="inbox" role="tabpanel" aria-labelledby="inbox-tab">
            <h4>Inbox</h4>
            <?php include_once(dirname( __FILE__ ).'/message_table.php')?>
          </div>
          <div class="tab-pane fade" id="send-message" role="tabpanel" aria-labelledby="send-message-tab">
            <h2 class="text-center text-primary">Send Message</h2>
            <form action="">
              <label for="" class="form-label text-primary">Subject</label>
              <input type="text" class="mb-5" name="subject" id="message_subject">
              <div class="admin_mesage_send_cont">
                <!-- <label for="">Send Message</label> -->
                <i class="fa fa-file icon" id="send_message_by_user_file_icon"></i>
                <input type="file" id="send_message_by_user_file"/>
                <input type="text" id="send_message_by_user" placeholder=" Select file or text mode by click on file icon">
                <button id="send_message_by_user_btn">
                  <img src="<?php echo esc_url(MY_PLUGIN_URL . 'assets/images/send_icon.png'); ?>" alt="Send Message">
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
require_once( dirname( __FILE__ ).'/send_new_message_css.php');
require_once( dirname( __FILE__ ).'/send_new_message_js.php');