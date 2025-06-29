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
         add_action('wp_ajax_wscart_save_basic_settings', [$this, 'wscart_save_basic_settings']);
         add_action('wp_ajax_wscart_reset_basic_settings', [$this, 'wscart_reset_basic_settings']);

         add_action('wp_ajax_wscart_save_settings', [$this, 'wscart_save_settings']);
         add_action('wp_ajax_wscart_reset_settings', [$this, 'wscart_reset_settings']);

         add_action('wp_ajax_wscart_save_button_settings', [$this, 'wscart_save_button_settings']);
         add_action('wp_ajax_wscart_reset_button_settings', [$this, 'wscart_reset_button_settings']);
    }

   //  ws cart basic settings update and reset  

    function wscart_save_basic_settings() {
    check_ajax_referer('ws_cart_admin_nonce', 'security');
  
       
  
     if (isset($_POST['kartly_title'])) {
        update_option('kartly_title', sanitize_text_field(wp_unslash($_POST['kartly_title'])));
     }
     if (isset($_POST['kartly_icon'])) {
        update_option('kartly_icon', sanitize_text_field(wp_unslash($_POST['kartly_icon'])));
     }
     if (isset($_POST['kartly_icon_color'])) {
        update_option('kartly_icon_color', sanitize_text_field(wp_unslash($_POST['kartly_icon_color'])));
     }
     if (isset($_POST['title_bg'])) {
        update_option('title_bg', sanitize_hex_color(wp_unslash($_POST['title_bg'])));
     }
     if (isset($_POST['cart_items_bg'])) {
        update_option('cart_items_bg', sanitize_hex_color(wp_unslash($_POST['cart_items_bg'])));
     }
     if (isset($_POST['title_color'])) {
        update_option('title_color', sanitize_hex_color(wp_unslash($_POST['title_color'])));
     }
     if (isset($_POST['cart_close_color'])) {
        update_option('cart_close_color', sanitize_hex_color(wp_unslash($_POST['cart_close_color'])));
     }
     if (isset($_POST['cart_close_bg_color'])) {
        update_option('cart_close_bg_color', sanitize_hex_color(wp_unslash($_POST['cart_close_bg_color'])));
     }
     
     if (isset($_POST['cart_body_border_radius'])) {
        update_option('cart_body_border_radius', intval(wp_unslash($_POST['cart_body_border_radius'])));
     }
    
     if (isset($_POST['cart_close_button_border_radius'])) {
        update_option('cart_close_button_border_radius', intval($_POST['cart_close_button_border_radius']));
     }
    
    wp_send_json_success(['message' => 'Settings saved successfully.']);
}



function wscart_reset_basic_settings() {
    check_ajax_referer('ws_cart_admin_nonce', 'security');


    
         update_option('kartly_title', sanitize_text_field('Kartly Cart'));
         update_option('kartly_icon', sanitize_text_field('1'));
         update_option('kartly_icon_color', sanitize_hex_color('#ffffff'));
         update_option('title_bg', sanitize_hex_color('#002f49'));
         update_option('cart_items_bg', sanitize_hex_color('#ffffff'));
         update_option('title_color', sanitize_hex_color('#ffffff'));
         update_option('cart_close_color', sanitize_hex_color('#002f49'));
         update_option('cart_close_bg_color', sanitize_hex_color('#ffffff'));
         update_option('cart_body_border_radius', intval('5'));
         update_option('cart_close_button_border_radius', intval('5'));
   

    wp_send_json_success(['message' => 'Settings reset to default.']);
}
   



   //  items settings save and reset 
    function wscart_save_settings() {
    check_ajax_referer('ws_cart_admin_nonce', 'security');
  
     if (isset($_POST['item_delete_icon'])) {
        update_option('item_delete_icon', sanitize_hex_color(wp_unslash($_POST['item_delete_icon'])));
     }
     if (isset($_POST['item_delete_bg'])) {
        update_option('item_delete_bg', sanitize_hex_color(wp_unslash($_POST['item_delete_bg'])));
     }
     if (isset($_POST['items_title_color'])) {
        update_option('items_title_color', sanitize_hex_color(wp_unslash($_POST['items_title_color'])));
     }
     if (isset($_POST['items_quantity_color'])) {
        update_option('items_quantity_color', sanitize_hex_color(wp_unslash($_POST['items_quantity_color'])));
     }
     if (isset($_POST['items_price_color'])) {
        update_option('items_price_color', sanitize_hex_color(wp_unslash($_POST['items_price_color'])));
     }
     if (isset($_POST['items_total_price_color'])) {
        update_option('items_total_price_color', sanitize_hex_color(wp_unslash($_POST['items_total_price_color'])));
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


    
        update_option('item_delete_icon', sanitize_hex_color('#ffffff'));
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


   //  button settings save and reset 
    function wscart_save_button_settings() {
    check_ajax_referer('ws_cart_admin_nonce', 'security');

  
     if (isset($_POST['shopping_button_color'])) {
       update_option('shopping_button_color', sanitize_hex_color(wp_unslash($_POST['shopping_button_color'])));
     }
     if (isset($_POST['shopping_button_bg_color'])) {
        update_option('shopping_button_bg_color', sanitize_hex_color(wp_unslash($_POST['shopping_button_bg_color'])));
     }
     if (isset($_POST['continue_shopping_button_border_radius'])) {
        update_option('continue_shopping_button_border_radius', intval($_POST['continue_shopping_button_border_radius']));
     }


     if (isset($_POST['view_cart_button_color'])) {
        update_option('view_cart_button_color', sanitize_hex_color(wp_unslash($_POST['view_cart_button_color'])));
     }
     if (isset($_POST['view_cart_button_bg_color'])) {
        update_option('view_cart_button_bg_color', sanitize_hex_color(wp_unslash($_POST['view_cart_button_bg_color'])));
     }
     if (isset($_POST['view_cart_button_border_radius'])) {
        update_option('view_cart_button_border_radius', intval($_POST['view_cart_button_border_radius']));
     }


     if (isset($_POST['checkout_button_color'])) {
        update_option('checkout_button_color', sanitize_hex_color(wp_unslash($_POST['checkout_button_color'])));
     }
     if (isset($_POST['checkout_button_bg_color'])) {
        update_option('checkout_button_bg_color', sanitize_hex_color(wp_unslash($_POST['checkout_button_bg_color'])));
     }
     if (isset($_POST['checkout_button_border_radius'])) {
        update_option('checkout_button_border_radius', intval($_POST['checkout_button_border_radius']));
     }
    
    
    wp_send_json_success(['message' => 'Settings saved successfully.']);
}



function wscart_reset_button_settings() {
    check_ajax_referer('ws_cart_admin_nonce', 'security');


    
         update_option('shopping_button_color', sanitize_hex_color('#002f49'));
         update_option('shopping_button_bg_color', sanitize_hex_color('#ffffff'));
         update_option('continue_shopping_button_border_radius', intval(5));
                                        
         update_option('view_cart_button_color', sanitize_hex_color('#002f49'));
         update_option('view_cart_button_bg_color', sanitize_hex_color('#ffffff'));
         update_option('view_cart_button_border_radius', intval(5));
                                        
         update_option('checkout_button_color', sanitize_hex_color('#002f49'));
         update_option('checkout_button_bg_color', sanitize_hex_color('#ffffff'));
         update_option('checkout_button_border_radius', intval(5));
   

    wp_send_json_success(['message' => 'Settings reset to default.']);
}



}