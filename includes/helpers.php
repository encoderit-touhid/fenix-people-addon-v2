<?php
if(!function_exists('get_the_subscription'))
{
    function get_the_subscription($id)
    {
          return 'Comming Soon';
    }
}
if(!function_exists('get_the_active_services'))
{
    function get_the_active_services()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'encoderit_fenix_people_services';
        return $wpdb->get_results("SELECT * FROM " . $table_name . "
                where is_active = 1 ORDER BY id DESC");
                 
    }
}

if(!function_exists('get_service_json_by_ids'))
{
    function get_service_json_by_ids($ids)
    {
       
        global $wpdb;
        $table_name = $wpdb->prefix . 'encoderit_fenix_people_services';
        $sql="SELECT * FROM " . $table_name . " where id in ($ids)";
       // return $sql;
        return $wpdb->get_results($sql);
                 
    }
}



if(!function_exists('enc_encodeContent'))
{
    function enc_encodeContent($content, $key="Py2Dj4!Q") {
        $encoded = base64_encode($content);
        $encrypted = openssl_encrypt($encoded, 'AES-256-CBC', $key, 0, substr(md5($key), 0, 16));
        return $encrypted;
    }
}

if(!function_exists('enc_decodeContent'))
{
    function enc_decodeContent($encodedContent, $key="Py2Dj4!Q") {
        $decrypted = openssl_decrypt($encodedContent, 'AES-256-CBC', $key, 0, substr(md5($key), 0, 16));
        $decoded = base64_decode($decrypted);
        return $decoded;
    }
}


if(!function_exists('get_the_last_form_id_by_user'))
{
    function get_the_last_form_id_by_user($user_id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'encoderit_fenix_people_form';
        $sql="SELECT id from $table_name where user_id = $user_id ORDER BY id DESC LIMIT 1";
        //return $sql;
        return $wpdb->get_row($sql)->id;
                 
    }
}




if(!function_exists('enc_get_client_name_by_message_subject'))
{
    function enc_get_client_name_by_message_subject($subject_id)
    {
        global $wpdb;
        $encoderit_fenix_people_chats = $wpdb->prefix . 'encoderit_fenix_people_chats';
        $get_client_user_name="SELECT * FROM " . $encoderit_fenix_people_chats . "
        where subject_id=$subject_id";
        
        $get_client_user_name=$wpdb->get_row($get_client_user_name);
        
        $client_id=$get_client_user_name->sender_id == 1 ? $get_client_user_name->receiver_id :$get_client_user_name->sender_id;  
        
       return  get_user_by('ID',$client_id)->display_name; 
    }
}

if(!function_exists('get_the_financial_report_sent_status'))
{   
     function get_the_financial_report_sent_status($user_id)
     {
        global $wpdb;
        $encoderit_fenix_people_financial_report = $wpdb->prefix . 'encoderit_fenix_people_financial_report';
        $get_client_user_name="SELECT * FROM " . $encoderit_fenix_people_financial_report . "
        where user_id=$user_id order by id desc";
        
        $get_client_user_name=$wpdb->get_row($get_client_user_name);
        
        return $get_client_user_name;  
        
     }
}

if(!function_exists('get_the_current_plan_name_by_user_id'))
{   
     function get_the_current_plan_name_by_user_id($user_id)
     {
        
        $arm_user_last_plan=get_user_meta($user_id,'arm_user_last_plan', true);
        if(empty($arm_user_last_plan))
        {
           return "-";
        }else
        {
            $plan_key='arm_user_plan_'.$arm_user_last_plan;
            $plaun_data=get_user_meta($user_id,$plan_key, true);
            return !empty($plaun_data['arm_current_plan_detail']['arm_subscription_plan_name']) ? $plaun_data['arm_current_plan_detail']['arm_subscription_plan_name'] : " ";
        }
        
        
     }
}


if(!function_exists('get_arm_subscription_plans_by_id'))
{   
     function get_arm_subscription_plans_by_id($plan_id)
     {
        
        global $wpdb;
        $arm_subscription_plans = $wpdb->prefix . 'arm_subscription_plans';
        $get_arm_subscription_plans="SELECT * FROM " . $arm_subscription_plans . "
        where arm_subscription_plan_id=$plan_id";
        
        $get_arm_subscription_plans=$wpdb->get_row($get_arm_subscription_plans);
        
        return !empty($get_arm_subscription_plans) ? $get_arm_subscription_plans->arm_subscription_plan_name : " ";  
        
     }
}

