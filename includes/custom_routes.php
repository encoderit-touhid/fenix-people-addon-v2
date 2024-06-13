<?php
function submitted_service_request_single_view_without_logged_in_endpoint() {
    add_rewrite_endpoint('submitted-service-request-single-view-without-logged-in', EP_ROOT);
}
add_action('init', 'submitted_service_request_single_view_without_logged_in_endpoint');


// function submitted_service_request_single_view_without_logged_in_endpoint_callback() {
//     //var_dump($_GET);
// }
// add_action('template_redirect', 'submitted_service_request_single_view_without_logged_in_endpoint_callback');

add_action( 'init', 'redirect_user_single_case_view' );
 function redirect_user_single_case_view() {
  
    
       
    if(str_contains($_SERVER['REQUEST_URI'],'/my-account/submitted-service-request-single-view/'))
    {
        $form_id=isset($_GET['form_id']) ? $_GET['form_id'] : null ;
       if(empty($form_id) )
       {
          return;
       }
        $form_id_decoded=explode(';',enc_decodeContent($form_id));
        $db_user_id=$form_id_decoded[1];
        $user=get_user_by('id', $db_user_id);
        if(empty($user))
        {
            return ;
        }else
        {
            wp_set_current_user($db_user_id, $user->user_login);
            wp_set_auth_cookie($db_user_id);
            
            // Redirect to a specific page
            //wp_redirect(home_url('/desired-page'));
           // exit;
        }
    }
    if(str_contains($_SERVER['REQUEST_URI'],'/my-account/send-user-message/'))
    {
        $form_id= isset($_GET['form_id']) ? $_GET['form_id'] : null ;
        if(empty($form_id) )
        {
           return;
        }
         $form_id_decoded=explode(';',enc_decodeContent($form_id));
         $db_user_id=$form_id_decoded[1];
         $user=get_user_by('id', $db_user_id);
         if(empty($user))
         {
             return ;
         }else
         {
             wp_set_current_user($db_user_id, $user->user_login);
             wp_set_auth_cookie($db_user_id);
             
             // Redirect to a specific page
             //wp_redirect(home_url('/desired-page'));
            // exit;
         }
    }
  
 }