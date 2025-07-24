<?php

namespace WSCART;



// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}


/**
 * Class Enqueue
 *
 * Handles the registration and enqueuing of frontend and admin styles/scripts
 */
class Enqueue {

    /**
     * Constructor registers WordPress hooks for enqueuing scripts and styles.
     */
    public function __construct() {
        // Enqueue scripts/styles on the frontend
        add_action('wp_enqueue_scripts', [$this, 'side_cart_custom_styles']);

        // Enqueue scripts/styles on the admin dashboard (currently unused)
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_assets']);
    }

    /**
     * Enqueues necessary styles and scripts for the side cart on the frontend.
     */
    public function side_cart_custom_styles() {
      
        // Load custom side cart styles
        wp_enqueue_style('side_cart_id', KARTLY_WOOCOMMERCE_SIDECART_URL . 'assets/css/style.css', array(),  time(), 'all');

        // Load jQuery (dependency for scripts)
        wp_enqueue_script('jquery');

        
        // Load custom side cart functionality script
        wp_enqueue_script(
            'sidecart-script',
            KARTLY_WOOCOMMERCE_SIDECART_URL . 'assets/js/sidecart.js',
            ['jquery'],
            '1.0.0',
            true
        );

        // Localize data to pass PHP variables to JS
        wp_localize_script('sidecart-script', 'WSCartAjax', [
            'ajax_url'      => admin_url('admin-ajax.php'),
            'nonce'         => wp_create_nonce('ws_cart_nonce'),
            'shop_url'      => get_permalink(wc_get_page_id('shop')),     // Link to shop page
            'cart_url'      => get_permalink(wc_get_page_id('cart')),     // Link to cart page
            'checkout_url'  => get_permalink(wc_get_page_id('checkout')), // Link to checkout page
        ]);
    }

    /**
     * Enqueues admin assets (reserved for future use).
     */
    public function admin_enqueue_assets() {

         if (isset($_GET['page']) && $_GET['page'] === 'kartly-settings') {
        // Enqueue styles/scripts only for this page
        wp_enqueue_style('kartly_side_cart_admin_css', KARTLY_WOOCOMMERCE_SIDECART_URL . 'admin/assets/css/admin-css.css', array(), time());
        wp_enqueue_script(
            'sidecart-admin-script',
            KARTLY_WOOCOMMERCE_SIDECART_URL . 'admin/assets/js/sidcart-admin.js',
            ['jquery'],
            time(),
            true
        );

           // Localize data to pass PHP variables to JS
        wp_localize_script('sidecart-admin-script', 'WSCartAdminAjax', [
            'ajax_url'      => admin_url('admin-ajax.php'),
            'nonce'         => wp_create_nonce('ws_cart_admin_nonce'),
        ]);
    }
        
    }
}
