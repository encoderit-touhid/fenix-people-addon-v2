<?php

/**
 * 
 * Strat for Service Request 
 * 
 */

// Add new endpoint for 'service-request'
function custom_add_service_request_endpoint() {
    add_rewrite_endpoint( 'service-request', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'custom_add_service_request_endpoint' );

// Flush rewrite rules on theme activation
function custom_service_request_flush_rewrite_rules() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'custom_service_request_flush_rewrite_rules' );

// Add new menu item to My Account navigation
function custom_my_account_menu_items( $items ) {

    $new_items = array();
    // Loop throu menu items
    foreach( $items as $key => $item ){
        if( 'orders' == $key )
            $new_items['service-request'] = __( 'Service Request', 'woocommerce');

        $new_items[$key] = $item;
    }
    return $new_items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );

// Display content for 'service-request' endpoint
function custom_service_request_endpoint_content() {
     include(dirname( __FILE__ ).'/public/service/index.php');
    // Add your custom content here
}
add_action( 'woocommerce_account_service-request_endpoint', 'custom_service_request_endpoint_content' );
/**
 * 
 * End of Service Request
 * 
 */



 /*** User Profile and file download */

 // Add new endpoint for 'service-request'
function custom_submitted_service_request_endpoint() {
    add_rewrite_endpoint( 'submitted-service-request', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'custom_submitted_service_request_endpoint' );

// Flush rewrite rules on theme activation
function custom_submitted_service_request_flush_rewrite_rules() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'custom_submitted_service_request_flush_rewrite_rules' );

// Add new menu item to My Account navigation
function custom_my_account_menu_items_submitted_service_request( $items ) {
    $new_items = array();
    // Loop throu menu items
    foreach( $items as $key => $item ){
        if( 'orders' == $key )
            $new_items['submitted-service-request'] = __( 'Submitted Service Request', 'woocommerce');

        $new_items[$key] = $item;
    }
    return $new_items;

    // $items['submitted-service-request'] = __( 'Submitted Service Request', 'woocommerce');
    // return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items_submitted_service_request', );

// Display content for 'service-request' endpoint
function submitted_service_request_endpoint_content() {
     include(dirname( __FILE__ ).'/public/request_service/index.php');
    // Add your custom content here
}
add_action( 'woocommerce_account_submitted-service-request_endpoint', 'submitted_service_request_endpoint_content');





 /*** Single view details by user */

 

 add_action( 'init', 'submitted_service_request_single_view_add_endpoint' );
 function submitted_service_request_single_view_add_endpoint() {
    
     // Check WP_Rewrite
     add_rewrite_endpoint( 'submitted-service-request-single-view', EP_PAGES );
  
 }
 /*
  * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
  */
 add_action( 'woocommerce_account_submitted-service-request-single-view_endpoint', 'submitted_service_request_single_view_my_account_content' );
 function submitted_service_request_single_view_my_account_content() {
  
     // Content for new page
     include(dirname( __FILE__ ).'/public/request_service/single.php');
 
  
 }

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
      include(dirname( __FILE__ ).'/public/send_message/message.php');
  
   
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




 /*** Membership response */

 

 add_action( 'init', 'user_membership_add_endpont' );
 function user_membership_add_endpont() {
    
     // Check WP_Rewrite
     add_rewrite_endpoint( 'user-membership', EP_PAGES );
  
 }
 /*
  * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
  */
 add_action( 'woocommerce_account_user-membership_endpoint', 'woocommerce_account_user_membership_endpoint' );
 function woocommerce_account_user_membership_endpoint() {
  
     // Content for new page
     
    include(dirname( __FILE__ ).'/public/membership/index.php');
  
 }
 function custom_my_account_menu_items_user_membership( $items ) {
   $new_items = array();
   // Loop throu menu items
   foreach( $items as $key => $item ){
       if( 'orders' == $key )
           $new_items['user-membership'] = __( 'Subscription', 'woocommerce');

       $new_items[$key] = $item;
   }
   return $new_items;

   // $items['submitted-service-request'] = __( 'Submitted Service Request', 'woocommerce');
   // return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items_user_membership', );