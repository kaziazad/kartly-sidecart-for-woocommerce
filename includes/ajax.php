<?php

namespace WSCART;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handles all AJAX-related functionality for the side cart.
 */
class Ajax {

    public function __construct() {
        // Register AJAX handlers for logged-in and guest users
        add_action('wp_ajax_delete_item_from_cart', [$this, "delete_item_form_cart"]);
        add_action('wp_ajax_nopriv_delete_item_from_cart', [$this, "delete_item_form_cart"]);

        add_action('wp_ajax_get_updated_side_cart', [$this, "get_updated_side_cart"]);
        add_action('wp_ajax_nopriv_get_updated_side_cart', [$this, "get_updated_side_cart"]);

        add_action('wp_ajax_update_cart_item_quantity', [$this, "update_cart_item_quantity"]);
        add_action('wp_ajax_nopriv_update_cart_item_quantity', [$this, "update_cart_item_quantity"]);
    }

    /**
     * Removes a product from the WooCommerce cart by its product ID.
     *
     * @param int $product_id
     */
    function remove_item_from_cart_by_product_id($product_id) {
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            if ($cart_item['product_id'] == $product_id) {
                WC()->cart->remove_cart_item($cart_item_key);
                break; // Remove only one instance
            }
        }
    }

    /**
     * AJAX handler: Deletes a product from the cart and returns updated cart HTML.
     */
    public function delete_item_form_cart() {
        check_ajax_referer('ws_cart_nonce', 'security');

        if (!isset($_POST['product_id'])) {
            wp_send_json_error('Missing Product ID');
        }

        $product_id = intval($_POST['product_id']);

        if (!WC()->cart) {
            wp_send_json_error('Cart not initialized');
        }

        $this->remove_item_from_cart_by_product_id($product_id);

        // Get updated cart HTML
        ob_start();
        Query::cart_query();
        $cart_html = ob_get_clean();

        wp_send_json_success(['cart_html' => $cart_html]);
    }

    /**
     * (Optional use) Updates product quantity by product ID in the cart.
     * Not currently hooked into AJAX.
     */
    // public function update_product_quantity() {
    //     check_ajax_referer('ws_cart_nonce', 'security');

    //     $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    //     $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    //     if (!$product_id || $quantity < 0) {
    //         wp_send_json_error(['message' => 'Invalid product or quantity.']);
    //     }

    //     foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    //         if ($cart_item['product_id'] == $product_id) {
    //             if ($quantity == 0) {
    //                 WC()->cart->remove_cart_item($cart_item_key);
    //             } else {
    //                 WC()->cart->set_quantity($cart_item_key, $quantity);
    //             }

    //             WC()->cart->calculate_totals();

    //             ob_start();
    //             Query::cart_query();
    //             $cart_html = ob_get_clean();

    //             wp_send_json_success([
    //                 'message' => 'Cart Updated',
    //                 'cart_html' => $cart_html
    //             ]);
    //         }
    //     }

    //     wp_send_json_error(['message' => 'Product not found in cart.']);
    // }

    /**
     * AJAX handler: Returns updated side cart HTML (used to refresh cart).
     */
    function get_updated_side_cart() {
        check_ajax_referer('ws_cart_nonce', 'security');

        ob_start();
        Query::cart_query();
        $cart_html = ob_get_clean();

        wp_send_json_success(['cart_html' => $cart_html]);
    }

    /**
     * AJAX handler: Updates cart quantity using WooCommerce cart item key.
     */
    public function update_cart_item_quantity() {
        check_ajax_referer('ws_cart_nonce', 'security');

        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        $quantity = intval($_POST['quantity']);

        if ($cart_item_key && $quantity >= 1) {
            WC()->cart->set_quantity($cart_item_key, $quantity, true);
            WC()->cart->calculate_totals();
        }

        ob_start();
        Query::cart_query();
        $cart_html = ob_get_clean();

        wp_send_json_success([
            'cart_html' => $cart_html,
        ]);
    }
}
