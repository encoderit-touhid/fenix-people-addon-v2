<?php
 add_action( 'admin_menu', 'admin_menu' );
 function admin_menu()
 {
   // add_menu_page('Fenix People Services', 'Fenix People Services', 'manage_options', 'fenix-people-services',array( 'fenix_people_admin_functionalities', 'get_service_list' ), 'dashicons-admin-generic', 4);

    //add_submenu_page('options.php', 'Fenix People Service Update', 'Fenix People Service Update', 'manage_options', 'fenix-people-service-update', array( 'fenix_people_admin_functionalities', 'update_service' ));

    //add_submenu_page('fenix-people-services', 'Add new Fenix People Service', 'Add new Fenix People Service', 'manage_options', 'fenix-people-service-create', array( 'fenix_people_admin_functionalities', 'add_new_service' ));

   // add_submenu_page('fenix-people-services', 'Submitted Service Request', 'Submitted Service Request', 'manage_options', 'fenix-people-service-request', array( 'fenix_people_admin_functionalities', 'fenix_people_service_request' ));

    add_submenu_page('options.php', 'Submitted Service Request Details', 'Submitted Service Request Details', 'manage_options', 'fenix-people-service-request-details-view-admin', array( 'fenix_people_admin_functionalities', 'fenix_people_service_request_details_view_admin' ));

    //add_menu_page('Fenix People Messages', 'Fenix People Messages', 'manage_options', 'fenix-people-messages-admin',array( 'fenix_people_admin_functionalities', 'fenix_people_messages_admin' ), 'dashicons-admin-generic', 4);

    add_menu_page('Fenix People Messages', 'Fenix People Messages', 'manage_options', 'fenix-people-messages-inbox-admin',array( 'message_inbox_functionalities', 'message_inbox_functionalities_admin_user_list' ), 'dashicons-admin-generic', 4);

    // add_submenu_page('options.php', 'Fenix People Message Details', 'Fenix People Message Details', 'manage_options', 'fenix-people-messages-admin-details-view', array( 'fenix_people_admin_functionalities', 'fenix_people_messages_admin_details_view' ));
    
    add_submenu_page('options.php', 'Fenix People Message Details', 'Fenix People Message Details', 'manage_options', 'fenix-people-messages-admin-inbox-details-view', array( 'message_inbox_functionalities', 'message_inbox_functionalities_admin_single_user_index' ));

    // add_options_page(
    //   'Fenix People Payment Gateway',        // Page title
    //   'Fenix People Payment Gateway',        // Menu title
    //   'manage_options',         // Capability required to access the page
    //   'fenix-people-payment-gateway',   // Menu slug (unique identifier)
    //   array( 'fenix_people_admin_functionalities', 'fenix_people_payment_gateway' ));


    add_menu_page('Fenix People Financial report', 'Fenix People Financial report', 'manage_options', 'fenix-people-financial-report-admin',array( 'manage_financial_report', 'user_list_admin' ), 'dashicons-admin-generic', 4);

    // add_submenu_page('options.php', 'Fenix People Message Details', 'Fenix People Message Details', 'manage_options', 'fenix-people-messages-admin-details-view', array( 'fenix_people_admin_functionalities', 'fenix_people_messages_admin_details_view' ));
    
    add_submenu_page('options.php', 'Fenix People Message Details', 'Fenix People Message Details', 'manage_options', 'fenix-people-messages-admin-inbox-details-view', array( 'message_inbox_functionalities', 'message_inbox_functionalities_admin_single_user_index' ));
 }
