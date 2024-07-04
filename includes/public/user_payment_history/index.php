<?php
 global $wpdb;
  
 $arm_payment_log= $wpdb->prefix . 'arm_payment_log';


 $user_id=get_current_user_id();
 if(empty($user_id))
 {
    echo "404 not allowed";
    exit;
 }
 $sql="SELECT * FROM " . $arm_payment_log . "
 where arm_user_id=$user_id order by arm_log_id asc";

 //$sql="SELECT * FROM " . $arm_payment_log . "
 //where arm_log_id=6 order by arm_log_id asc";
 
 $arm_payment_log=$wpdb->get_results($sql);
 
 //var_dump($arm_payment_log);
 //exit;

// if(empty($arm_payment_log))
// {
//     echo "404 not allowed";
//     exit;
// }  

?>

<table id="financial_report_by_user">
    <thead>
        <tr>
            <td>Transaction ID</td>
            <td>Invoice ID</td>
            <td>Membership</td>
            <td>Payment GateWay</td>
            <td>Payment Type</td>
            <td>Payer Email</td>
            <td>Transaction Status</td>
            <td>Payment Date</td>
            <td>Amount</td>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($arm_payment_log as $key=>$value)
        {
           
          ?>
          <tr>
            <td><?php echo !empty($value->arm_transaction_id) ? $value->arm_transaction_id : "Manual" ?></td>
            <td>#<?php echo $value->arm_invoice_id  ?></td>
            <td><?php echo get_arm_subscription_plans_by_id($value->arm_plan_id);?></td>
            <td><?php echo $value->arm_payment_gateway?></td>
            <td><?php echo $value->arm_payment_mode=='manual_subscription' ? "Subscription" : "Subscription (Automatic)"?></td>
            <td><?php echo !empty($value->arm_payer_email) ? $value->arm_payer_email : "Paid By admin" ?></td>
            <td><?php echo $value->arm_transaction_status?></td>
            <td><?php echo $value->arm_created_date?></td>
            <td><?php echo $value->arm_amount.' '.$value->arm_currency?></td>
          </tr>
          <?php
        }
        ?>
    </tbody>
</table>




<?php
include_once( dirname( __FILE__ ).'/user_payment_history_css.php');
include_once( dirname( __FILE__ ).'/user_payment_history_js.php');



