<?php

namespace WSCART;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Kartly_Upgrade_1_10_3 {

   public static function run() {
        global $wpdb;

        $table   = esc_sql( $wpdb->prefix . 'kartly_cart_data' );

        $column  = 'new_field';


        if ( $wpdb->get_var( $wpdb->prepare("SHOW TABLES LIKE %s", $table ) ) === $table ) {

            $column_exists = $wpdb->get_results(  $wpdb->prepare( "SHOW COLUMNS FROM `$table` LIKE %s", $column ) );

            if ( empty( $column_exists ) ) {
                $wpdb->query( "ALTER TABLE `$table` ADD COLUMN new_field TEXT DEFAULT ''" );
            }

            update_option( 'wscart_last_upgraded_to', '1.10.3' );

        } else {
            error_log( "Upgrade 1.10.3 failed: table $table does not exist." );
        }
    }
}




