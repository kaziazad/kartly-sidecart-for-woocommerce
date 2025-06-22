<?php


namespace WSCART; 


// Exit if accessed directly
if( !defined( 'ABSPATH' )){
    exit;
}

class Admin{

    public function __construct(){
        $this->image_url = WOOCOMMERCE_SIDECART_URL . 'assets/img/kartly-logo-icon.png';
        add_action('admin_menu', array($this, 'kartly_admin_page'));
    }


     

    public function kartly_admin_page(){
        add_menu_page( 
            "Kartly Settings", 
            "Kartly Settings", 
            "manage_options", 
            "kartly-settings", 
            array($this, "kartly_admin_callback"), 
            $this->image_url, 
            6
        );
    }

    public function kartly_admin_callback(){ ?>
            <div class="kartly-admin-container">
               
                <div class="kartly-admin-title">
                    <div class="kartly-logo-area">
                        <img src="<?php echo esc_url( trailingslashit( WOOCOMMERCE_SIDECART_URL ) . 'assets/img/kartly-logo.jpg' ); ?>" alt="Kartly Logo">
                    </div>
                    <div class="kartly-title-area">
                        <h2>Kartly Settings Page</h2>
                        <h6>By- Kazi Mahmud Al Azad</h6>
                    </div>
                </div>
                <div class="kartly-admin-body">
                    <div class="kartly-sidebar">
                        <div class="kartly-cart-settings-sidebar active">
                            <span class="light"></span><span>Cart Basic Settings</span>
                        </div>
                        <div class="kartly-cart-settings-sidebar">
                             <span class="light"></span><span>Cart Items Settings</span>
                        </div>
                        <div class="kartly-cart-settings-sidebar">
                             <span class="light"></span><span>Cart Related Items Settings</span>
                        </div>
                        <div class="kartly-cart-settings-sidebar">
                             <span class="light"></span><span>Cart Buttons Settings</span>
                        </div>
                        <div class="kartly-cart-settings-sidebar">
                             <span class="light"></span><span>Kartly Shortcodes</span>
                        </div>
                    </div>
                    <div class="kartly-options-area">
                        <div class="kartly-cart-settings">
                            <ul class="kartly-cart-section-wrapper">
                                <li class="active">
                                    <div class="kartly-topbar">
                                        <span>Kartly Basic Settings</span>
                                        <div class="options-area">
                                            <form action="" method="post" id="sidecart_basic_settings_form">
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="kartly_title">Cart Title: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="text" id="kartly_title" name="kartly_title" value="<?php echo esc_attr(get_option('kartly_title', 'Kartly Cart')); ?>">
                                                    </div>
                                                    
                                                </div>
                                                <div class="settings-input">
                                                     <div class="settings-label">
                                                        <label for="title_bg">Cart Body Background: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="title_bg" name="title_bg" value="<?php echo esc_attr(get_option('title_bg', '#002f49')); ?>">
                                                    </div>

                                                     
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="title_color">Cart Title Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="title_color" name="title_color" value="<?php echo esc_attr(get_option('title_color', '#f0e1b8')); ?>">
                                                    </div>
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="cart_close_color">Cart Close Text Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="cart_close_color" name="cart_close_color" value="<?php echo esc_attr(get_option('cart_close_color', '#002f49')); ?>">
                                                    </div>
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="cart_close_bg_color">Cart close Button Background: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="cart_close_bg_color" name="cart_close_bg_color" value="<?php echo esc_attr(get_option('cart_close_bg_color', '#f0e1b8')); ?>">
                                                    </div>
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="cart_body_border_radius">Cart Body Border Radius(px) </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="number" id="cart_body_border_radius" name="cart_body_border_radius" value="<?php echo esc_attr(get_option('cart_body_border_radius', '5')); ?>">
                                                    </div>
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="cart_close_button_border_radius">Cart Close Button Border Radius(px) </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="number" id="cart_close_button_border_radius" name="cart_close_button_border_radius" value="<?php echo esc_attr(get_option('cart_close_button_border_radius', '5')); ?>">
                                                    </div>
                                                </div>
                                                <?php wp_nonce_field('save_items_settings_action', 'items_settings_nonce'); ?>
                                                <div class="settings-input">
                                                    <!-- <input type="submit" id="basic_settings_submit" name="basic_settings_submit" value="Save">
                                                    <input type="submit" id="basic_settings_reset" name="basic_settings_reset" value="Reset to Default" onclick="return confirm('Are you sure you want to reset to default settings?');"> -->

                                                    <button type="button" class="ws-button" id="basic_settings_submit">Save</button>
                                                    <button type="button" class="ws-button" id="basic_settings_reset">Reset to Default</button>  

                                                </div>
                                            </form>
                                        </div> 
                                    </div>    
                                   
                                </li>
                               
                                <li>
                                     <div class="kartly-items">
                                        <span>Kartly Items Settings</span>
                                        <div class="options-area">
                                            <form action="" method="post" id="sidecart_settings_form">
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="item_delete_icon">Item Delete Button icon</label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="item_delete_icon" name="item_delete_icon" value="<?php echo esc_attr(get_option('item_delete_icon', '#f0e1b8')); ?>">
                                                    </div>
                                                    
                                                </div>
                                                <div class="settings-input">
                                                     <div class="settings-label">
                                                        <label for="item_delete_bg">Item Delete Button Background  </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="item_delete_bg" name="item_delete_bg" value="<?php echo esc_attr(get_option('item_delete_bg', '#002f49')); ?>">
                                                    </div>

                                                     
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="items_title_color">Cart Items Title Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="items_title_color" name="items_title_color" value="<?php echo esc_attr(get_option('items_title_color', '#002f49')); ?>">
                                                    </div>
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="items_quantity_color">Cart Items quantity Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="items_quantity_color" name="items_quantity_color" value="<?php echo esc_attr(get_option('items_quantity_color', '#002f49')); ?>">
                                                    </div>
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="items_price_color">Cart Items Price Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="items_price_color" name="items_price_color" value="<?php echo esc_attr(get_option('items_price_color', '#002f49')); ?>">
                                                    </div>
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="items_total_price_color">Cart Total Price Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="items_total_price_color" name="items_total_price_color" value="<?php echo esc_attr(get_option('items_total_price_color', '#002f49')); ?>">
                                                    </div>
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="items_area_border_radius">Cart items Area Border Radius(px) </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="number" id="items_area_border_radius" name="items_area_border_radius" value="<?php echo esc_attr(get_option('items_area_border_radius', '5')); ?>">
                                                    </div>
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="items_area_quantity_border_radius">Cart items Quantity Border Radius(px) </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="number" id="items_area_quantity_border_radius" name="items_area_quantity_border_radius" value="<?php echo esc_attr(get_option('items_area_quantity_border_radius', '5')); ?>">
                                                    </div>
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="items_delete_button_border_radius">Cart items Delete Button Border Radius(px) </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="number" id="items_delete_button_border_radius" name="items_delete_button_border_radius" value="<?php echo esc_attr(get_option('items_delete_button_border_radius', '5')); ?>">
                                                    </div>
                                                </div>
                                                 <?php /* wp_nonce_field('save_items_settings_action', 'items_settings_nonce'); */?>
                                                <div class="settings-input">
                                                    <!-- <input type="submit" id="items_settings_submit" value="Save">
                                                    <input type="submit" id="items_settings_reset" value="Reset to Default" onclick="return confirm('Are you sure you want to reset to default settings?');"> -->
                                                        <!-- <input type="submit" id="items_settings_submit" value="Save"> -->
                                                        <button type="button" class="ws-button" id="items_settings_submit">Save</button>
                                                        <button type="button" class="ws-button" id="items_settings_reset">Reset to Default</button>  
                                                </div>
                                            </form>
                                            
                                        </div> 
                                    </div>  
                                </li>
                                <li>
                                      <div class="kartly-realted">
                                        <span>Kartly Related Items Settings</span>
                                        <div class="options-area">
                                           <h4>Pro Release</h4>
                                        </div> 
                                    </div>  
                                </li>
                                <li>
                                      <div class="kartly-buttons">
                                        <span>Kartly Buttons Settings</span>
                                        <div class="options-area">
                                           <form action="" method="post" id="button_settings_form">
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="shopping_button_color">Continue Shopping Button Text color</label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="shopping_button_color" name="shopping_button_color" value="<?php echo esc_attr(get_option('shopping_button_color', '#002f49')); ?>">
                                                    </div>
                                                    
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="shopping_button_bg_color">Continue Shopping Button Background color</label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="shopping_button_bg_color" name="shopping_button_bg_color" value="<?php echo esc_attr(get_option('shopping_button_bg_color', '#f0e1b8')); ?>">
                                                    </div>
                                                    
                                                </div>

                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="continue_shopping_button_border_radius">Continue Shopping Button Border Radius(px) </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="number" id="continue_shopping_button_border_radius" name="continue_shopping_button_border_radius" value="<?php echo esc_attr(get_option('continue_shopping_button_border_radius', '5')); ?>">
                                                    </div>
                                                </div>

                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="view_cart_button_color">View Cart Button Text color</label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="view_cart_button_color" name="view_cart_button_color" value="<?php echo esc_attr(get_option('view_cart_button_color', '#002f49')); ?>">
                                                    </div>
                                                    
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="view_cart_button_bg_color">View Cart Button Background color</label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="view_cart_button_bg_color" name="view_cart_button_bg_color" value="<?php echo esc_attr(get_option('view_cart_button_bg_color', '#f0e1b8')); ?>">
                                                    </div>
                                                    
                                                </div>

                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="view_cart_button_border_radius">View Cart Button Border Radius(px) </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="number" id="view_cart_button_border_radius" name="view_cart_button_border_radius" value="<?php echo esc_attr(get_option('view_cart_button_border_radius', '5')); ?>">
                                                    </div>
                                                </div>

                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="checkout_button_color">Checkout Button Text color</label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="checkout_button_color" name="checkout_button_color" value="<?php echo esc_attr(get_option('checkout_button_color', '#002f49')); ?>">
                                                    </div>
                                                    
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="checkout_button_bg_color">Checkout Button Background color</label>
                                                    </div>

                                                    <div class="setings-input-area">
                                                        <input type="color" id="checkout_button_bg_color" name="checkout_button_bg_color" value="<?php echo esc_attr(get_option('checkout_button_bg_color', '#f0e1b8')); ?>">
                                                    </div>
                                                    
                                                </div>
                                               

                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="checkout_button_border_radius">Checkout Button Border Radius(px) </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="number" id="checkout_button_border_radius" name="checkout_button_border_radius" value="<?php echo esc_attr(get_option('checkout_button_border_radius', '5')); ?>">
                                                    </div>
                                                </div>
                                                <?php wp_nonce_field('save_items_settings_action', 'items_settings_nonce'); ?>
                                                <div class="settings-input">
                                                    <!-- <input type="submit" id="button_settings_submit" name="button_settings_submit" value="Save">
                                                     <input type="submit" id="button_settings_reset" name="button_settings_reset" value="Reset to Default" onclick="return confirm('Are you sure you want to reset to default settings?');"> -->

                                                    <button type="button" class="ws-button" id="button_settings_submit">Save</button>
                                                    <button type="button" class="ws-button" id="button_settings_reset">Reset to Default</button>  
                                                </div>
                                            </form>
                                        </div> 
                                    </div>  
                                </li>
                                <li>
                                      <div class="kartly-buttons">
                                        <span>Kartly Shortcode</span>
                                        <div class="options-area">
                                           <p>Cart Button Shorcode: <strong>[ws-cart-button]</strong></p>
                                        </div> 
                                    </div>  
                                </li>
                            
                            </ul>            
                        </div>
                    </div>


                   
                </div>
            </div>
    <?php
        }

}

