<?php
global $wpdb;
$encoderit_fenix_people_chat_subjects = $wpdb->prefix . 'encoderit_fenix_people_chat_subjects';
$encoderit_fenix_people_chats = $wpdb->prefix . 'encoderit_fenix_people_chats';
$user_id=get_current_user_id();

$sql = "SELECT *from $encoderit_fenix_people_chat_subjects where id in ( SELECT distinct subject_id FROM " . $encoderit_fenix_people_chats . "
          where  sender_id=$user_id or receiver_id=$user_id) order by id desc";

$result=$wpdb->get_results($sql);
$user=get_user_by('ID',$user_id);
$full_name='';
$first_name=get_user_meta( $user_id, 'first_name', true );
$last_name=get_user_meta( $user_id, 'last_name', true );
$full_name=$first_name.' '.$last_name;

?>
<div class="enc-white">
<div class="request_service_table_contianer">
    <table id="request_service_client">
        <thead class="bg-white">
            <tr>
                <th>ID</th>
                <th>From</th>
                <th>To</th>
                <th>Subject</th>
                <th>Details</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($result as $key=>$value)
            {
                $view_link=site_url().'/my-account/send-user-details-message?id=' . $value->id;
                ?>
                <tr>
                    <td>#<?=$key+1?></td>
                    <td>Fenix People Admin</td>
                    <td><?=!empty($user->display_name) ? $user->display_name : (!empty($full_name) ? $full_name : $user->user_email)?></td>
                    <td><?=$value->subject?></td>
                    <td><a  href="<?=$view_link?>" class="button">Details</a></td>
                    <td><?=$value->created_at?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
</div>