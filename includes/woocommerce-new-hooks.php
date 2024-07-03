<?php
/*** Chat response */

 

add_action( 'init', 'send_user_message_add_endpont' );
function send_user_message_add_endpont() {
   
    // Check WP_Rewrite
    add_rewrite_endpoint( 'send-user-message', EP_PAGES );
 
}
/*
 * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
 */
add_action( 'woocommerce_account_send-user-message_endpoint', 'woocommerce_account_send_user_message_add_endpoint' );
function woocommerce_account_send_user_message_add_endpoint() {
 
    // Content for new page
    include(dirname( __FILE__ ).'/public/send_new_message/message.php');

 
}
function custom_my_account_menu_items_send_user_message( $items ) {
  $new_items = array();
  // Loop throu menu items
  foreach( $items as $key => $item ){
      if( 'orders' == $key )
          $new_items['send-user-message'] = __( 'Message', 'woocommerce');

      $new_items[$key] = $item;
  }
  return $new_items;

  // $items['submitted-service-request'] = __( 'Submitted Service Request', 'woocommerce');
  // return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items_send_user_message', );



/*** Chat Single response */

 

add_action( 'init', 'send_user_message_details_add_endpont' );
function send_user_message_details_add_endpont() {
   
    // Check WP_Rewrite
    add_rewrite_endpoint( 'send-user-details-message', EP_PAGES );
 
}
/*
 * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
 */
add_action( 'woocommerce_account_send-user-details-message_endpoint', 'woocommerce_account_send_user_details_message_add_endpoint' );
function woocommerce_account_send_user_details_message_add_endpoint() {
 
    // Content for new page
    include(dirname( __FILE__ ).'/public/send_new_message/message-details.php');

 
}

/*** Financial Reports response */

add_action( 'init', 'user_financial_report_endpoint' );
function user_financial_report_endpoint() {
   
    // Check WP_Rewrite
    add_rewrite_endpoint( 'user-financial-report', EP_PAGES );
 
}
/*
 * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
 */
add_action( 'woocommerce_account_user-financial-report_endpoint', 'user_financial_report' );
function user_financial_report() {
 
    // Content for new page
    include(dirname( __FILE__ ).'/public/financial_report/index.php');

 
}

function custom_my_account_menu_items_financial_report( $items ) {
    $new_items = array();
    // Loop throu menu items
    foreach( $items as $key => $item ){
        if( 'orders' == $key )
            $new_items['user-financial-report'] = __( 'Financial Report', 'woocommerce');
  
        $new_items[$key] = $item;
    }
    return $new_items;
  
    // $items['submitted-service-request'] = __( 'Submitted Service Request', 'woocommerce');
    // return $items;
  }
  add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items_financial_report', );