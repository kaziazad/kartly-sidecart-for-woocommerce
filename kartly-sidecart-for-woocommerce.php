<?php
/**
 * Plugin Name:       Kartly Sidecart for Woocommerce 
 * Plugin URI:        https://kazimahmud.com/kartly-sidecart
 * Description:       Kartly Side Cart for WooCommerce adds a modern, dynamic, and fully customizable side cart (mini cart) to your WooCommerce store. Improve your user experience and boost conversion rates by letting customers manage their cart contents instantly—without reloading the page or leaving the product page.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Kazi Mahmud Al Azad
 * Author URI:        https://kazimahmud.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       kartly-sidecart-for-woocommerce
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

    
    global $wpdb;
    $table = $wpdb->prefix . 'kartly_cart_data';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table (
        id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        product_id bigint(20) NOT NULL,
        session_id varchar(255) NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );



}
register_activation_hook( __FILE__, 'dependency_check' );

/**
 * Main plugin class to handle KM Sidecart functionality
 */
final class Woocommerce_Sidecart {

    // plugin version 
     const VERSION = '1.0.0';

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

         add_action( 'admin_notices', array( $this, 'kartly_version_notice' ) );

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
        <button class="cart-button-ws" id="cart_button_ws_id" onclick="wsCartToggle()">Cart</button>
          
        
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
       add_action( 'init', array( $this, 'maybe_upgrade' ) );
    }

    public function activate_plugin() {
        $installed_version = get_option( 'kartly_plugin_version' );
        if ( $installed_version !== self::VERSION ) {
            // Run upgrade routines here if needed
            update_option( 'kartly_plugin_version', self::VERSION );
        }
    }

    public function maybe_upgrade() {
    $installed_version = get_option( 'kartly_plugin_version' );

    if ( ! $installed_version ) {
        // Fresh install
        update_option( 'kartly_plugin_version', self::VERSION );
        return;
    }

    if ( version_compare( $installed_version, '1.0.0', '<' ) ) {
        require_once WOOCOMMERCE_SIDECART_PATH . 'includes/upgrades/upgrade-1-10-3.php';
       
        \WSCART\Kartly_Upgrade_1_10_3::run();
    }

    // if ( version_compare( $installed_version, '1.10.0', '<' ) ) {
    //     require_once WOOCOMMERCE_SIDECART_PATH . 'includes/upgrades/class-upgrade-1-10-0.php';
    //     WSCart_Upgrade_1_10_0::run();
    // }

    update_option( 'kartly_plugin_version', self::VERSION );
}


public function kartly_version_notice() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $plugin_version = get_option( 'kartly_plugin_version', 'unknown' );
    $upgrade_log = get_option( 'wscart_last_upgraded_to', 'Not recorded' );
    if($plugin_version !== $upgrade_log){
    ?>
    <div class="notice notice-success is-dismissible">
        <p><strong>Kartly Sidecart</strong> is currently running version <code><?php echo esc_html( $plugin_version ); ?></code>.</p>
        <p>Last upgrade processed: <code><?php echo esc_html( $upgrade_log ); ?></code></p>
    </div>
    <?php
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