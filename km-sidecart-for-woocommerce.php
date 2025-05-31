<?php
/**
 * Plugin Name:       KM Sidecart for Woocommerce 
 * Plugin URI:        https://kazimahmud.com/
 * Description:       Woocommerce custom Side Cart
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Kazi Mahmud Al Azad
 * Author URI:        https://kazimahmud.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       km-sidecart-for-woocommerce
 */



 if( !defined( 'ABSPATH' ) ){
    exit; 
 }


// dependency_check for woocommerce
function dependency_check(){
    if( ! class_exists('WooCommerce')){
        deactivate_plugins( plugin_basename(__FILE__) );
        wp_die('This plugin requires WooCommerce.', 'Plugin dependency check', array('back_link' => true));
    }
}

register_activation_hook( __FILE__, 'dependency_check');




 final class Woocommerce_Sidecart{

    private static $instance = NULL; 

    private function __construct()
    {
        $this->define_ws_constants();

        $this->load_classes(); 

        add_action('init', array($this, 'cart_button_shortcode')); 

        add_action('wp_ajax_ws_update_cart_quantity', [$this, 'update_cart_quantity']);
        add_action('wp_ajax_nopriv_ws_update_cart_quantity', [$this, 'update_cart_quantity']);

    }

   

    public static function get_instance(){
        if(is_null(self::$instance)){

            self::$instance = new self();
            return self::$instance; 
           
        }

        return self::$instance;
       
    }

    public function cart_button_shortcode(){
        add_shortcode('ws-cart-button', array($this, 'ws_cart_button_callback'));
    }

    public function ws_cart_button_callback(){
        ?>
        <button class="cart-button-ws" id="cart_button_ws_id">Cart</button>
        <?php
    }

    private function define_ws_constants(){

        if( !defined( 'WOOCOMMERCE_SIDECART_PATH' )){
            define( 'WOOCOMMERCE_SIDECART_PATH', plugin_dir_path(__FILE__) );
        }
       
        if( !defined( 'WOOCOMMERCE_SIDECART_URL' )){
            define( 'WOOCOMMERCE_SIDECART_URL', plugin_dir_url(__FILE__) );
        }

        
    }

    public function update_cart_quantity() {
        check_ajax_referer('ws_cart_nonce', 'nonce');

        if(isset($_POST['cart_key'])){
            $cart_key = sanitize_text_field( wp_unslash($_POST['cart_key']));
        }
        
        if(isset($_POST['quantity'])){
            $quantity = max(0, intval($_POST['quantity']));
        }

        
    
        if (!WC()->cart || !$cart_key) {
            wp_send_json_error('Invalid cart');
        }
    
        // Check if the item exists in cart
        $cart = WC()->cart->get_cart();
        if (!isset($cart[$cart_key])) {
            wp_send_json_error('Item not found');
        }
    
        // Update quantity
        WC()->cart->set_quantity($cart_key, $quantity, true);
        WC()->cart->calculate_totals();
    
        wp_send_json_success(['message' => 'Cart updated']);
    }


    private function load_classes(){
     
        require_once WOOCOMMERCE_SIDECART_PATH.'includes/side_cart_body.php'; 
        require_once WOOCOMMERCE_SIDECART_PATH.'includes/enqueue.php'; 
        require_once WOOCOMMERCE_SIDECART_PATH.'includes/query.php'; 
        require_once WOOCOMMERCE_SIDECART_PATH.'includes/ajax.php'; 

        new WSCART\Side_Cart_Body(); 
        new WSCART\enqueue();
        new WSCART\Query();
        new WSCART\Ajax();
    }



 }

 Woocommerce_Sidecart::get_instance();

