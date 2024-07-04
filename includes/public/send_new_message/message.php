<div class="send_user_message_cont">
<div class="enc-white mt-4">
    <div class="row">
      <h2 class="display-5 fw-bold text-center text-primary" id="send_message_h2" style="display: none;">Send Message</h2>
      <h2 class="display-5 fw-bold text-center text-primary" id="inbox_h2">Inbox</h2>
      <div class="col-md-3">
        <ul class="nav nav-tabs flex-column" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="inbox-tab" data-bs-toggle="tab" href="#inbox" role="tab" aria-controls="inbox" aria-selected="true">Inbox</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="send-message-tab" data-bs-toggle="tab" href="#send-message" role="tab" aria-controls="send-message" aria-selected="false">Send message</a>
          </li>
        </ul>
      </div>
      <div class="col-md-9">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="inbox" role="tabpanel" aria-labelledby="inbox-tab">
            <!-- <h2 class="text-center text-primary">Inbox</h2> -->
            <?php include_once(dirname( __FILE__ ).'/message_table.php')?>
          </div>
          <div class="tab-pane fade" id="send-message" role="tabpanel" aria-labelledby="send-message-tab">
            <!-- <h2 class="text-center text-primary">Send Message</h2> -->
            <label for="" class="form-label text-primary">Subject</label>
            <input type="text" placeholder="Type the subject here" class="mb-5" name="subject" id="message_subject">
            <label for="" class="form-label text-primary">Message</label>
            <!-- <input type="text" id="send_message_by_user" placeholder="Select file or text mode by click on file icon" class="mb-5"> -->
            <textarea name="" id="send_message_by_user" class="mb-5"></textarea>
            <label for="" class="form-label text-primary">Files</label>
             <div class="w-100">
                  <button id="addFile" class="btn btn-primary">Add File</button>
              </div>
                
            <div id="file_adding_div"></div>
            <button id="send_message_by_user_btn">
                  <img src="<?php echo esc_url(MY_PLUGIN_URL . 'assets/images/send_icon.png'); ?>" alt="Send Message">
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once( dirname( __FILE__ ).'/send_new_message_css.php');
require_once( dirname( __FILE__ ).'/send_new_message_js.php');