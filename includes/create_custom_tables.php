<?php
class fenix_people_create_custom_table
{
    
    public static function create_custom_tables()
    {
        add_option('ENCODER_IT_STRIPE_PK','pk_test_51OD1o3HXs2mM51TXR04wpLYzxxWNpOQWZr8Y84oV0Bp5aP1sB0gVic7JqBdrOgQmqYAwT7a9TOfq4UBG5ioifu9F00VwcHhkCb');
        add_option('ENCODER_IT_STRIPE_SK','sk_test_51OD1o3HXs2mM51TXAPMu48pbSpxilR2QjxiXEipq60TE8y96wg51zs9qPSDZomhDtYGcmwIFPboEgFaHi1SINsNZ00FZ8b7i8R');
        add_option('ENCODER_IT_PAYPAL_CLIENT','AaXp9zv9TqTd30YTT48MJgSQc_5A74dGcWoCKGfu75iqMYChNCh4drlXNB4gjmPDeUnbrLQjvWk-NNOI');
        add_option('ENCODER_IT_PAYPAL_SECRET','EKqkmLLyfTgwswkdR-ME6J0Rco1jupQfNEZqiQW1Q20nbKv7C8a-WgwDemzBGQhpKT-DKfSyAx3ME7JE');

        self::create_encoderit_fenix_people_services_table();
        self::create_encoderit_encoderit_fenix_people_form_table();
        self::create_encoderit_fenix_people_chats_table();
        self::create_encoderit_encoderit_fenix_people_chat_subjects_table();
        self::create_encoderit_fenix_people_financial_report_table();
        //self::create_encoderit_encoderit_fenix_people_table();
       //// self::create_encoderit_country_with_code_table();
       // self::create_encoderit_service_with_country_table();
       // self::create_encoderit_fixed_service_with_country_table();
        // global $wpdb;
        // $table_name=$wpdb->prefix . 'encoderit_country_with_code';
        // $countryList=self::countryList();

        //     foreach($countryList as $key=>$value)
        //     {
        //         $wpdb->insert(
        //             $table_name,
        //             array(
        //                 'country_name' => $value,
        //                 'country_code' => $key,
        //             )
        //         );
        //     }
    }
    public  static function drop_custom_tables()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'encoderit_country_with_code';
        $wpdb->query("DROP TABLE IF EXISTS $table_name");

    }
    public static function  create_encoderit_fenix_people_services_table()
    {
        global $wpdb;
       
        $table_name = $wpdb->prefix . 'encoderit_fenix_people_services';

       $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS  $table_name (
            `id` BIGINT NOT NULL AUTO_INCREMENT,
            `service_name` VARCHAR(100) NOT NULL,
            `service_price` INT NOT NULL,
            `is_active` TINYINT NOT NULL DEFAULT '1' COMMENT '1 Active , 0 DeActive',
            `recurring_subscription` INT NULL DEFAULT NULL,
            `created_at` DATETIME NULL DEFAULT NULL,
            `updated_at` DATETIME NULL DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate;";
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql ); 

    }
    public static function create_encoderit_encoderit_fenix_people_form_table()
    {
        global $wpdb;
         
        $table_name = $wpdb->prefix . 'encoderit_fenix_people_form';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS  $table_name (
            `id` BIGINT NOT NULL AUTO_INCREMENT,
            `user_id` BIGINT NOT NULL,
            `country_id` BIGINT  NULL, 
            `person_number` MEDIUMINT  NULL,
            `description` TEXT NULL DEFAULT NULL,
            `services` TEXT NULL DEFAULT NULL,    
            `files_by_user` JSON NULL DEFAULT NULL,
            `files_by_admin` JSON NULL DEFAULT NULL, 
            `payment_method` VARCHAR(100) NULL, 
            `transaction_number` VARCHAR(100) NULL,
            `total_price` FLOAT NOT NULL,
            `is_cancelled` TINYINT NULL DEFAULT '0', 
            `created_at` TIMESTAMP NULL DEFAULT NULL, 
            `updated_at` TIMESTAMP NULL DEFAULT NULL,
            `updated_by` BIGINT NOT NULL DEFAULT '0',
             PRIMARY KEY (`id`)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
    public static function create_encoderit_fenix_people_chats_table()
    {
        global $wpdb;
         
        $table_name = $wpdb->prefix . 'encoderit_fenix_people_chats';

        $charset_collate = $wpdb->get_charset_collate();
 
            $sql = "CREATE TABLE IF NOT EXISTS  $table_name (
                `id` bigint NOT NULL AUTO_INCREMENT,
                `sender_id` bigint NOT NULL,
                `receiver_id` bigint NOT NULL,
                `subject_id` int DEFAULT NULL,
                `message` text NOT NULL,
                `parent_id` bigint DEFAULT NULL,
               `is_file` TINYINT NULL DEFAULT '0',
               `created_at` datetime DEFAULT NULL, 
                PRIMARY KEY (`id`)
            ) $charset_collate;";


        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
    public static function create_encoderit_encoderit_fenix_people_chat_subjects_table()
    {
        global $wpdb;
         
        $table_name = $wpdb->prefix . 'encoderit_fenix_people_chat_subjects';

        $charset_collate = $wpdb->get_charset_collate();
 
            $sql = "CREATE TABLE IF NOT EXISTS  $table_name (
                `id` bigint NOT NULL AUTO_INCREMENT,
                `subject` varchar(255) DEFAULT NULL,
               `created_at` datetime DEFAULT NULL, 
                PRIMARY KEY (`id`)
            ) $charset_collate;";


        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
    public static function create_encoderit_fenix_people_financial_report_table()
    {
        global $wpdb;
         
        $table_name = $wpdb->prefix . 'encoderit_fenix_people_financial_report';

        $charset_collate = $wpdb->get_charset_collate();
 
            $sql = "CREATE TABLE IF NOT EXISTS  $table_name (
                `id` bigint NOT NULL AUTO_INCREMENT,
                `report_title` varchar(255) DEFAULT NULL,
                `report_file`  JSON NULL DEFAULT NULL,
                `report_content` TEXT NULL DEFAULT NULL,
                `user_id` bigint NOT NULL,
                `created_at` datetime DEFAULT NULL, 
                PRIMARY KEY (`id`),
                KEY `user_id` (`user_id`)
            ) $charset_collate;";


        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}