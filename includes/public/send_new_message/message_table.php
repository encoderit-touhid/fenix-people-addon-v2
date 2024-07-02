<?php
global $wpdb;
$encoderit_fenix_people_chat_subjects = $wpdb->prefix . 'encoderit_fenix_people_chat_subjects';
$encoderit_fenix_people_chats = $wpdb->prefix . 'encoderit_fenix_people_chats';
$user_id=get_current_user_id();

$sql = "SELECT *from $encoderit_fenix_people_chat_subjects where id in ( SELECT distinct subject_id FROM " . $encoderit_fenix_people_chats . "
          where  sender_id=$user_id or receiver_id=$user_id)";

$result=$wpdb->get_results($sql);
//var_dump($result);

?>
<div class="enc-white">
<div class="request_service_table_contianer">
    <table id="request_service_client">
        <thead>
            <tr>
                <td>ID</td>
                <td>Subject</td>
                <td>Details</td>
                <td>Created at</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($result as $key=>$value)
            {
                $view_link=site_url().'/my-account/send-user-details-message?id=' . $value->id;
                ?>
                <tr>
                    <td>#<?=$value->id?></td>
                    <td><?=$value->subject?></td>
                    <td><a  href="<?=$view_link?>" class="button"  style="background-color: #009B00;color: black">Details</a></td>
                    <td><?=$value->created_at?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
</div>