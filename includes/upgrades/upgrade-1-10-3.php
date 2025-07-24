<?php

namespace WSCART;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Kartly_Upgrade_1_10_3 {
/*
   public static function run() {
        global $wpdb;

        $table   = esc_sql( $wpdb->prefix . 'kartly_cart_data' );

        $column  = 'new_field';


        if ( $wpdb->get_var( $wpdb->prepare("SHOW TABLES LIKE %s", $table ) ) === $table ) {

            $column_exists = $wpdb->get_results(  $wpdb->prepare( "SHOW COLUMNS FROM `$table` LIKE %s", $column ) );

            if ( empty( $column_exists ) ) {
                $wpdb->query( "ALTER TABLE `$table` ADD COLUMN new_field TEXT DEFAULT ''" );
            }

            update_option( 'wscart_last_upgraded_to', '1.0.0' );

        } else {
            // error_log( "Upgrade 1.10.3 failed: table $table does not exist." );
        }
    }
        */

    public static function run() {
    global $wpdb;

    $allowed_tables = [ $wpdb->prefix . 'kartly_cart_data' ];
    $table          = $wpdb->prefix . 'kartly_cart_data'; // use unescaped value here
    $column         = 'new_field';

    if ( ! in_array( $table, $allowed_tables, true ) ) {
        return; // bail out for unknown table
    }

    // Use prepare for SHOW TABLES LIKE
    if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $table ) ) === $table ) {

        // Build the full query with the validated table name
        $sql = $wpdb->prepare( "SHOW COLUMNS FROM `{$table}` LIKE %s", $column );
        $column_exists = $wpdb->get_results( $sql );

        if ( empty( $column_exists ) ) {
            // Use sprintf instead of direct interpolation for safety
            $alter_query = sprintf( "ALTER TABLE `%s` ADD COLUMN %s TEXT DEFAULT ''", esc_sql( $table ), esc_sql( $column ) );
            $wpdb->query( $alter_query );
        }

        update_option( 'wscart_last_upgraded_to', '1.0.0' );

        } else {
            // error_log("Upgrade 1.10.3 failed: table $table does not exist.");
        }
    }

}




