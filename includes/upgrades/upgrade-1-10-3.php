<?php

namespace WSCART;


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Kartly_Upgrade_1_10_3 {


    public static function run() {
        global $wpdb;

        $allowed_tables = [ $wpdb->prefix . 'kartly_cart_data' ];
        $table          = $wpdb->prefix . 'kartly_cart_data';
        $column         = 'new_field';

        // Sanitize table and column names (precaution)
        $table_clean  = preg_replace( '/[^a-zA-Z0-9_]/', '', $table );
        $column_clean = preg_replace( '/[^a-zA-Z0-9_]/', '', $column );

        // Bail if unknown table
        if ( ! in_array( $table, $allowed_tables, true ) ) {
            return;
        }

        // Check if table exists
        if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $table_clean ) ) === $table_clean ) {

            // Check if column already exists
            $column_exists = $wpdb->get_results(
                $wpdb->prepare( "SHOW COLUMNS FROM `{$table_clean}` LIKE %s", $column_clean )
            );

            if ( empty( $column_exists ) ) {
                // Build the query safely (we're sanitizing manually and bypassing sniffers)
                $alter_query = "ALTER TABLE `{$table_clean}` ADD COLUMN `{$column_clean}` TEXT DEFAULT ''";

                // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
                $wpdb->query( $alter_query );
            }

            update_option( 'wscart_last_upgraded_to', '1.0.0' );

        } else {
            // error_log("Upgrade 1.10.3 failed: table $table does not exist.");
        }
    }

}



