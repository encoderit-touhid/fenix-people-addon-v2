<?php
$path_css=WP_PLUGIN_DIR . '/fenix-people-addon/assets/css/service-request-css.php';
include_once($path_css);


?>

<h1 class="enc-white">Request for Service</h1>

<label for="" class="enc-white">Services:</label>
<?php
$services=get_the_active_services();
if(!empty($services))
{
    ?>
    <div class="enc-white">
    <form id="fileUploadForm" class="request_service_form">
        <?php
        foreach($services as $key=>$sevice)
        {
            ?>
            <div class="product__item d-flex-center">
                <input
                    type="checkbox"
                    class="encoder_it_custom_services"
                    data-price="<?=$sevice->service_price?>"
                    onclick="add_total_price(this.id)"
                    id="encoder_it_custom_services<?=$sevice->id?>"
                    name="encoder_it_custom_services[]"
                    value="<?=$sevice->id?>"
                />
                <label class="p_title_price d-flex-center">
                    <span class="title"><?=$sevice->service_name?> ...</span>
                    <span>$<?=$sevice->service_price?></span>
                </label>
            </div>
            <?php
        }
        ?>
        <input type="hidden" id="person_number" value="1"/>

        <div class="textarea_heading">
            <label for="">Vendor request:</label>
            <textarea name="description" id="description" row="10"></textarea>
        </div>
        <div class="add_file_cont row_d">
            <div class="titel_col">
                <label for="">Add File:</label>
            </div>
            <div class="right_col add__file__container">
                <button id="addFile">Add File</button>
                <div id="files"></div>
            </div>
        </div>
        <div class="payment__method_cont row_d">
            <div class="titel_col">
                <label for="">Selected Payment Method</label>
            </div>
            <div class="right_col right_total_price">
                <div class="payment_method_container">
                    <div class="item d-flex-center">
                        <input type="radio" name="payment_method" id="encoderit_paypal"  value="Paypal" onclick="check_radio_payment_method(this.id)" />
                        <span>Paypal</span>
                    </div>
                    <div class="item d-flex-center">
                        <input type="radio" name="payment_method" id="encoderit_stripe"  value="Credit Card" onclick="check_radio_payment_method(this.id)"/>
                        <span>Credit Card</span>
                    </div>
                    <!-- <div class="item d-flex-center">
                        <input type="radio" name="payment_method" id="encoderit_bank_transfer" value="Bank Transfer" onclick="check_radio_payment_method(this.id)"/>
                        <span>Bank Transfer</span>
                    </div> -->
                </div>
                <div class="paymet-area">
                
                <div id="stripe_payment_div" style="display:none">
                    <div id="card-element"></div>
                    <div id="card-errors" role="alert"></div>
                </div>
                </div>
                <div id="paypal-button-container" style="display:none; z-index: 1000;"></div>

                <div class="total__price">
                <span>Total Price</span><span id="price"></span>
                </div>
                <div class="submit_btn">
                <input class="buttons" type="submit" name="btn" />
                </div>
            </div>
        </div>


    </form>
    </div>
    <?php
}
?>





<?php


$path_js=WP_PLUGIN_DIR . '/fenix-people-addon/assets/js/service-request-js.php';

include_once($path_js);