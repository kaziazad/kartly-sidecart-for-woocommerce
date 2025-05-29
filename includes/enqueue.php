<?php


namespace WSCART;

if (!defined('ABSPATH')) {
    exit;
}

class Enqueue {

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'side_cart_custom_styles']);
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_assets']);
    }

    public function side_cart_custom_styles() {
        wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css');
        wp_enqueue_style('side_cart_id', WOOCOMMERCE_SIDECART_URL . 'assets/css/style.css');

        wp_enqueue_script('jquery');

        wp_enqueue_script('quantity-script', WOOCOMMERCE_SIDECART_URL . 'assets/js/quantity-handler.js', ['jquery'], '1.0', true);
        wp_enqueue_script('sidecart-script', WOOCOMMERCE_SIDECART_URL . 'assets/js/sidecart.js', ['jquery'], '1.0.0', true);

        wp_localize_script('quantity-script', 'WSCartAjax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('ws_cart_nonce'),
            'shop_url' => get_permalink(wc_get_page_id('shop')), // shop button link 
            'cart_url'   => get_permalink(wc_get_page_id('cart')), // cart page link
            'checkout_url' => get_permalink(wc_get_page_id('checkout')), // checkout page link

        ]);
    }

    public function admin_enqueue_assets() {
        // Future admin assets here
    }
}