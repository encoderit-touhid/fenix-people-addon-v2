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




