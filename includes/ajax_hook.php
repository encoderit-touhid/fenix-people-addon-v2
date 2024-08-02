<?php
add_action('wp_ajax_fenix_people_service_add_ajax_callback', array('fenix_people_admin_functionalities','fenix_people_service_add_ajax_callback'));
add_action('wp_ajax_fenix_people_service_update_ajax_callback', array('fenix_people_admin_functionalities','fenix_people_service_update_ajax_callback'));

add_action('wp_ajax_fenix_people_stripe_form_submit', array('service_request_customer','fenix_people_stripe_form_submit'));
add_action('wp_ajax_fenix_people_paypal_form_submit', array('service_request_customer','fenix_people_paypal_form_submit'));

add_action('wp_ajax_fenix_people_admin_file_submit', array('fenix_people_admin_functionalities','fenix_people_admin_file_submit'));

add_action('wp_ajax_fenix_people_message_by_user', array('fenix_people_user_functionalities','fenix_people_message_by_user'));

add_action('wp_ajax_fenix_people_message_by_admin', array('fenix_people_admin_functionalities','fenix_people_message_by_admin'));

add_action('wp_ajax_encoder_it_set_payment_keys', array('fenix_people_admin_functionalities','encoder_it_set_payment_keys'));

/******* New Update */

add_action('wp_ajax_fenix_people_message_by_user_with_subject', array('message_inbox_functionalities','fenix_people_message_by_user_with_subject'));

add_action('wp_ajax_fenix_people_message_by_admin_with_subject', array('message_inbox_functionalities','fenix_people_message_by_admin_with_subject'));


add_action('wp_ajax_admin_financial_report_submit', array('manage_financial_report','admin_financial_report_submit'));

add_action('wp_ajax_fenix_people_message_by_user_with_subject_message_file_in_single_message', array('message_inbox_functionalities','fenix_people_message_by_user_with_subject_message_file_in_single_message'));

add_action('wp_ajax_fenix_people_message_by_admin_with_subject_message_file_in_single_message', array('message_inbox_functionalities','fenix_people_message_by_admin_with_subject_message_file_in_single_message'));
