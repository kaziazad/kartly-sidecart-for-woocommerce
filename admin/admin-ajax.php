<?php

namespace WSCART;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handles all AJAX-related functionality for the side cart.
 */
class Admin_Ajax {

    public function __construct(){
        add_action('wp_ajax_wscart_save_settings', 'wscart_save_settings');
        add_action('wp_ajax_wscart_reset_settings', 'wscart_reset_settings');
    }

    function wscart_save_settings() {
    check_ajax_referer('ws_cart_admin_nonce', 'security');


     if (isset($_POST['item_delete_icon'])) {
        update_option('item_delete_icon', sanitize_hex_color($_POST['item_delete_icon']));
     }
     if (isset($_POST['item_delete_bg'])) {
        update_option('item_delete_bg', sanitize_hex_color($_POST['item_delete_bg']));
     }
     if (isset($_POST['items_title_color'])) {
        update_option('items_title_color', sanitize_hex_color($_POST['items_title_color']));
     }
     if (isset($_POST['items_quantity_color'])) {
        update_option('items_quantity_color', sanitize_hex_color($_POST['items_quantity_color']));
     }
     if (isset($_POST['items_price_color'])) {
        update_option('items_price_color', sanitize_hex_color($_POST['items_price_color']));
     }
     if (isset($_POST['items_total_price_color'])) {
        update_option('items_total_price_color', sanitize_hex_color($_POST['items_total_price_color']));
     }
    
     if (isset($_POST['items_area_border_radius'])) {
        update_option('items_area_border_radius', intval($_POST['items_area_border_radius']));
     }
    
     if (isset($_POST['items_area_quantity_border_radius'])) {
        update_option('items_area_quantity_border_radius', intval($_POST['items_area_quantity_border_radius']));
     }
    
     if (isset($_POST['items_delete_button_border_radius'])) {
        update_option('items_delete_button_border_radius', intval($_POST['items_delete_button_border_radius']));
     }
    
    wp_send_json_success(['message' => 'Settings saved successfully.']);
}



function wscart_reset_settings() {
    check_ajax_referer('ws_cart_admin_nonce', 'security');


    
        update_option('item_delete_icon', sanitize_hex_color('#f0e1b8'));
        update_option('item_delete_bg', sanitize_hex_color('#002f49'));
        update_option('items_title_color', sanitize_hex_color('#002f49'));
        update_option('items_quantity_color', sanitize_hex_color('#002f49'));
        update_option('items_price_color', sanitize_hex_color('#002f49'));
        update_option('items_total_price_color', sanitize_hex_color('#002f49'));
        update_option('items_area_border_radius', intval(5));
        update_option('items_area_quantity_border_radius', intval(5));
        update_option('items_delete_button_border_radius', intval(5));
   

    wp_send_json_success(['message' => 'Settings reset to default.']);
}



}