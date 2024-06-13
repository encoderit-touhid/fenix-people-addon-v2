<?php
add_action('wp_ajax_fenix_people_service_add_ajax_callback', array('fenix_people_admin_functionalities','fenix_people_service_add_ajax_callback'));
add_action('wp_ajax_fenix_people_service_update_ajax_callback', array('fenix_people_admin_functionalities','fenix_people_service_update_ajax_callback'));

add_action('wp_ajax_fenix_people_stripe_form_submit', array('service_request_customer','fenix_people_stripe_form_submit'));
add_action('wp_ajax_fenix_people_paypal_form_submit', array('service_request_customer','fenix_people_paypal_form_submit'));

add_action('wp_ajax_fenix_people_admin_file_submit', array('fenix_people_admin_functionalities','fenix_people_admin_file_submit'));

add_action('wp_ajax_fenix_people_message_by_user', array('fenix_people_user_functionalities','fenix_people_message_by_user'));

add_action('wp_ajax_fenix_people_message_by_admin', array('fenix_people_admin_functionalities','fenix_people_message_by_admin'));

