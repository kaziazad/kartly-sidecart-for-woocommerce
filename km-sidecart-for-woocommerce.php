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

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Dependency check to ensure WooCommerce is installed and active.
 * If not, deactivate the plugin and show an error message.
 */
function dependency_check() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        wp_die( 'This plugin requires WooCommerce.', 'Plugin dependency check', array( 'back_link' => true ) );
    }
}
register_activation_hook( __FILE__, 'dependency_check' );

/**
 * Main plugin class to handle KM Sidecart functionality
 */
final class Woocommerce_Sidecart {

    // plugin version 
     const VERSION = '1.10.3';

    // Singleton instance
    private static $instance = NULL;

    /**
     * Constructor: Defines constants, loads classes, registers shortcodes and AJAX handlers
     */
    private function __construct() {
        $this->define_ws_constants();
        $this->load_classes();

        // Register shortcode for cart button
        add_action( 'init', array( $this, 'cart_button_shortcode' ) );

         $this->init_hooks();

    }

    /**
     * Singleton getter
     *
     * @return Woocommerce_Sidecart
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
            return self::$instance;
        }

        return self::$instance;
    }

    /**
     * Registers the shortcode [ws-cart-button] to display the cart button
     */
    public function cart_button_shortcode() {
        add_shortcode( 'ws-cart-button', array( $this, 'ws_cart_button_callback' ) );
    }

    /**
     * Shortcode callback to output the cart button HTML
     */
    public function ws_cart_button_callback() {
        ob_start();
        ?>
        <button class="cart-button-ws" onclick="wsCartToggle()" id="cart_button_ws_id">Cart</button>
        <?php
         return ob_get_clean();
    }

    /**
     * Define plugin path and URL constants
     */
    private function define_ws_constants() {
        if ( ! defined( 'WOOCOMMERCE_SIDECART_PATH' ) ) {
            define( 'WOOCOMMERCE_SIDECART_PATH', plugin_dir_path( __FILE__ ) );
        }

        if ( ! defined( 'WOOCOMMERCE_SIDECART_URL' ) ) {
            define( 'WOOCOMMERCE_SIDECART_URL', plugin_dir_url( __FILE__ ) );
        }
         if ( ! defined( 'WOOCOMMERCE_SIDECART_URL' ) ) {
            define( 'KARTLY_VERSION', self::VERSION );
         }
    }
    

    private function init_hooks() {
        register_activation_hook( __FILE__, array( $this, 'activate_plugin' ) );
    }

    public function activate_plugin() {
        $installed_version = get_option( 'kartly_plugin_version' );
        if ( $installed_version !== self::VERSION ) {
            // Run upgrade routines here if needed
            update_option( 'kartly_plugin_version', self::VERSION );
        }
    }
    
 
    /**
     * Load required plugin classes
     */
    private function load_classes() {
        require_once WOOCOMMERCE_SIDECART_PATH . 'includes/side_cart_body.php';
        require_once WOOCOMMERCE_SIDECART_PATH . 'includes/enqueue.php';
        require_once WOOCOMMERCE_SIDECART_PATH . 'includes/query.php';
        require_once WOOCOMMERCE_SIDECART_PATH . 'includes/ajax.php';
        require_once WOOCOMMERCE_SIDECART_PATH . 'admin/admin.php';
        require_once WOOCOMMERCE_SIDECART_PATH . 'admin/admin-ajax.php';


        // Initialize plugin components
        new WSCART\Side_Cart_Body();
        new WSCART\enqueue();
        new WSCART\Query();
        new WSCART\Ajax();
        new WSCART\Admin();
        new WSCART\Admin_Ajax();
    }
}

// Initialize the plugin
Woocommerce_Sidecart::get_instance();