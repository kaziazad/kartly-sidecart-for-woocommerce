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
                                                        <label for="kartly_icon">Cart Icon: </label>
                                                    </div>
                                                    <div class="setings-input-area">

                                                         <?php $iconvalue = get_option( 'kartly_icon', '1' ); ?> 
                                                        <div class="cart-icons-area">
                                                            <div class="cart-icons-select">
                                                                <input type="radio" id="kartly_icon1" name="kartly_icon" value="1" <?php checked( $iconvalue, '1' ); ?>>
                                                                <label for="kartly_icon1"><svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 32 32" width="20" ><g id="Layer_2" data-name="Layer 2"><path d="m16 17.82a6 6 0 0 1 -5.89-4.82 1 1 0 0 1 1-1.15 1 1 0 0 1 1 .83 4 4 0 0 0 7.83 0 1 1 0 0 1 1-.83 1 1 0 0 1 1 1.15 6 6 0 0 1 -5.94 4.82z"/><path d="m24.9 31h-17.8a3 3 0 0 1 -3-3.15l.81-17.24a3 3 0 0 1 3-2.87h16.18a3 3 0 0 1 3 2.87l.81 17.24a3 3 0 0 1 -3 3.15zm-16.99-21.25a1 1 0 0 0 -1 1l-.81 17.2a1 1 0 0 0 1 1.05h17.8a1 1 0 0 0 1-1.05l-.81-17.24a1 1 0 0 0 -1-1z"/><path d="m22 8.75h-2v-1.75a4 4 0 0 0 -8 0v1.75h-2v-1.75a6 6 0 0 1 12 0z"/></g></svg>    </label>
                                                            </div>
                                                             <div class="cart-icons-select">
                                                                <input type="radio" id="kartly_icon2" name="kartly_icon" value="2" <?php checked( $iconvalue, '2' ); ?>>
                                                                <label for="kartly_icon2"><svg id="Layer_1" enable-background="new 0 0 128 128" height="20" viewBox="0 0 128 128" width="20" xmlns="http://www.w3.org/2000/svg"><g><path d="m87.7 33.1-.8-10.8c-.9-11.9-10.9-21.3-22.9-21.3s-22.1 9.4-22.9 21.3l-.8 10.8h-11.5c-4.7 0-8.6 3.7-9 8.4l-5.4 75.9c-.2 2.5.7 5 2.4 6.8s4.1 2.9 6.6 2.9h81.3c2.5 0 4.9-1 6.6-2.9 1.7-1.8 2.6-4.3 2.4-6.8l-5.4-75.2c-.4-5.1-4.6-9-9.7-9h-10.9zm-40.6-10.4c.6-8.8 8-15.7 16.9-15.7s16.3 6.9 16.9 15.7l.7 10.4h-35.3zm55.2 19.9 5.4 75.2c.1.8-.2 1.6-.8 2.3-.6.6-1.4 1-2.2 1h-81.3c-.8 0-1.6-.3-2.2-1s-.9-1.4-.8-2.3l5.4-75.9c.1-1.6 1.4-2.8 3-2.8h11.1l-.6 8c-.1 1.7 1.1 3.1 2.8 3.2h.2c1.6 0 2.9-1.2 3-2.8l.6-8.4h36.2l.6 8.4c.1 1.7 1.5 2.9 3.2 2.8s2.9-1.5 2.8-3.2l-.6-8h10.5c1.9 0 3.5 1.5 3.7 3.5z"/></g></svg></label>
                                                            </div>
                                                        
                                                            <div class="cart-icons-select">
                                                                <input type="radio" id="kartly_icon3" name="kartly_icon" value="3" <?php checked( $iconvalue, '3' ); ?>>
                                                                <label for="kartly_icon3"><svg id="Layer_1" height="20" viewBox="0 0 48 48" width="20" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"><path d="m23 35a11.979 11.979 0 0 0 5.38 10h-20.85a4.994 4.994 0 0 1 -4.96-5.62l3-24a5 5 0 0 1 4.96-4.38h2.47v6a1 1 0 0 0 2 0v-6h12v6a1 1 0 0 0 2 0v-6h2.47a5 5 0 0 1 4.96 4.38l.98 7.86a12.02 12.02 0 0 0 -14.41 11.76z"/><path d="m29 11h-2a6 6 0 0 0 -12 0h-2a8 8 0 0 1 16 0z"/><path d="m35 25a10 10 0 1 0 10 10 10.011 10.011 0 0 0 -10-10zm3 11h-2v2a1 1 0 0 1 -2 0v-2h-2a1 1 0 0 1 0-2h2v-2a1 1 0 0 1 2 0v2h2a1 1 0 0 1 0 2z"/></svg> </label>
                                                            </div>
                                                             <div class="cart-icons-select">
                                                                <input type="radio" id="kartly_icon4" name="kartly_icon" value="4" <?php checked( $iconvalue, '4' ); ?>>
                                                                <label for="kartly_icon4"><svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 32 32" width="20"><g id="Layer_2" data-name="Layer 2"><path d="m16 1a6 6 0 0 0 -6 6v1h-.83a3.27 3.27 0 0 0 -3.27 3.12l-.79 16.45a3.28 3.28 0 0 0 3.27 3.43h15.24a3.28 3.28 0 0 0 3.27-3.43l-.79-16.45a3.27 3.27 0 0 0 -3.27-3.12h-.83v-1a6 6 0 0 0 -6-6zm-4 6a4 4 0 0 1 8 0v1h-8zm-1.64 5.19a1 1 0 1 1 1 1 1 1 0 0 1 -1-1zm9.28 0a1 1 0 1 1 1 1 1 1 0 0 1 -1-1z"/></g></svg></label>
                                                            </div>
                                                             <div class="cart-icons-select">
                                                                <input type="radio" id="kartly_icon5" name="kartly_icon" value="5" <?php checked( $iconvalue, '5' ); ?>>
                                                                <label for="kartly_icon5"><svg id="Capa_1" enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m504.399 185.065c-6.761-8.482-16.904-13.348-27.83-13.348h-98.604l-53.469-122.433c-3.315-7.591-12.157-11.06-19.749-7.743-7.592 3.315-11.059 12.158-7.743 19.75l48.225 110.427h-178.458l48.225-110.427c3.315-7.592-.151-16.434-7.743-19.75-7.591-3.317-16.434.15-19.749 7.743l-53.469 122.434h-98.604c-10.926 0-21.069 4.865-27.83 13.348-6.637 8.328-9.086 19.034-6.719 29.376l52.657 230c3.677 16.06 17.884 27.276 34.549 27.276h335.824c16.665 0 30.872-11.216 34.549-27.276l52.657-230.001c2.367-10.342-.082-21.048-6.719-29.376zm-80.487 256.652h-335.824c-2.547 0-4.778-1.67-5.305-3.972l-52.657-229.998c-.413-1.805.28-3.163.936-3.984.608-.764 1.985-2.045 4.369-2.045h85.503l-3.929 8.997c-3.315 7.592.151 16.434 7.743 19.75 1.954.854 3.99 1.258 5.995 1.258 5.782 0 11.292-3.363 13.754-9l9.173-21.003h204.662l9.173 21.003c2.462 5.638 7.972 9 13.754 9 2.004 0 4.041-.404 5.995-1.258 7.592-3.315 11.059-12.158 7.743-19.75l-3.929-8.997h85.503c2.384 0 3.761 1.281 4.369 2.045.655.822 1.349 2.18.936 3.983l-52.657 230c-.528 2.301-2.76 3.971-5.307 3.971z"/><path d="m166 266.717c-8.284 0-15 6.716-15 15v110c0 8.284 6.716 15 15 15s15-6.716 15-15v-110c0-8.284-6.715-15-15-15z"/><path d="m256 266.717c-8.284 0-15 6.716-15 15v110c0 8.284 6.716 15 15 15s15-6.716 15-15v-110c0-8.284-6.716-15-15-15z"/><path d="m346 266.717c-8.284 0-15 6.716-15 15v110c0 8.284 6.716 15 15 15s15-6.716 15-15v-110c-.001-8.284-6.716-15-15-15z"/></svg>  </label>
                                                            </div>
                                                            <div class="cart-icons-select">
                                                                <input type="radio" id="kartly_icon6" name="kartly_icon" value="6" <?php checked( $iconvalue, '6' ); ?>>
                                                                <label for="kartly_icon6"><svg width="20" height="20" id="semibold" enable-background="new 0 0 32 32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g><path d="m31 15h-30c-.6 0-1-.4-1-1s.4-1 1-1h30c.6 0 1 .4 1 1s-.4 1-1 1z"/></g><g><path d="m7 15c-.1 0-.3 0-.4-.1-.5-.2-.7-.8-.5-1.3l4-9c.2-.5.8-.7 1.3-.5s.7.8.5 1.3l-4 9c-.2.4-.5.6-.9.6z"/></g><g><path d="m25 15c-.4 0-.7-.2-.9-.6l-4-9c-.2-.5 0-1.1.5-1.3s1.1 0 1.3.5l4 9c.2.5 0 1.1-.5 1.3-.1.1-.3.1-.4.1z"/></g><g><path d="m2.5 14v.2l2.2 11.4c.3 1.4 1.5 2.4 3 2.4h16.7c1.4 0 2.7-1 2.9-2.4l2.2-11.4c0-.1 0-.1 0-.2zm8.7 10c-.1 0-.1 0-.2 0-.5 0-.9-.3-1-.8l-1-5c-.1-.6.2-1.1.8-1.2.5-.1 1.1.2 1.2.8l1 5c.1.5-.3 1.1-.8 1.2zm5.8-1c0 .5-.5 1-1 1s-1-.5-1-1v-5c0-.5.5-1 1-1s1 .5 1 1zm6-4.8-1 5c-.1.5-.5.8-1 .8-.1 0-.1 0-.2 0-.5-.1-.9-.6-.8-1.2l1-5c.1-.5.6-.9 1.2-.8.5.1.9.6.8 1.2z"/></g></svg></label>
                                                            </div>
                                                        
                                                        
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="settings-input">
                                                     <div class="settings-label">
                                                        <label for="kartly_icon_color">Cart Icon Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="kartly_icon_color" name="kartly_icon_color" value="<?php echo esc_attr(get_option('kartly_icon_color', '#ffffff')); ?>">
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
                                                        <label for="cart_items_bg">Cart Items Background: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="cart_items_bg" name="cart_items_bg" value="<?php echo esc_attr(get_option('cart_items_bg', '#ffffff')); ?>">
                                                    </div>

                                                     
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="title_color">Cart Title Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="title_color" name="title_color" value="<?php echo esc_attr(get_option('title_color', '#ffffff')); ?>">
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
                                                         <input type="color" id="cart_close_bg_color" name="cart_close_bg_color" value="<?php echo esc_attr(get_option('cart_close_bg_color', '#ffffff')); ?>">
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
                                                        <input type="color" id="item_delete_icon" name="item_delete_icon" value="<?php echo esc_attr(get_option('item_delete_icon', '#ffffff')); ?>">
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
                                                        <input type="color" id="shopping_button_bg_color" name="shopping_button_bg_color" value="<?php echo esc_attr(get_option('shopping_button_bg_color', '#ffffff')); ?>">
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
                                                        <input type="color" id="view_cart_button_bg_color" name="view_cart_button_bg_color" value="<?php echo esc_attr(get_option('view_cart_button_bg_color', '#ffffff')); ?>">
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
                                                        <input type="color" id="checkout_button_bg_color" name="checkout_button_bg_color" value="<?php echo esc_attr(get_option('checkout_button_bg_color', '#ffffff')); ?>">
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

