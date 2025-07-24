<?php


namespace WSCART; 


// Exit if accessed directly
if( !defined( 'ABSPATH' )){
    exit;
}
// admin page class 
class Admin{

    public function __construct(){
        $this->image_url = KARTLY_WOOCOMMERCE_SIDECART_URL . 'assets/img/kartly-logo-icon.png';
        add_action('admin_menu', array($this, 'kartly_admin_page'));
    }


     
// Admin page register 
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
// Admin page markup 
    public function kartly_admin_callback(){ ?>
            <div class="kartly-admin-container">
               
                <div class="kartly-admin-title">
                    <div class="kartly-logo-area">
                        <img src="<?php echo esc_url( trailingslashit( KARTLY_WOOCOMMERCE_SIDECART_URL ) . 'assets/img/kartly-logo.jpg' ); ?>" alt="Kartly Logo">
                    </div>
                    <div class="kartly-title-area">
                        <h2>Kartly Settings Page</h2>
                        <h6>By- Kazi Mahmud Al Azad</h6>
                    </div>
                </div>
                <div class="kartly-admin-body">
                    <!-- Admin page sidebar  -->
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

                    <!-- Admin page body  -->
                    <div class="kartly-options-area">
                        <div class="kartly-cart-settings">
                            <ul class="kartly-cart-section-wrapper">
                                <!-- Basic settings area  -->
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
                               
                                <!-- Cart Items Settings  -->
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
                                                        <div class="delete-icons-area">
                                                            <?php $delete_icon_value = get_option( 'item_delete_icon', '1' ); ?>
                                                            <div class="delete-icons-select">
                                                                <input type="radio" id="item_delete_icon1" name="item_delete_icon" value="1" <?php checked( $delete_icon_value, '1' ); ?>>
                                                                <label for="item_delete_icon1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 512.015 512.015" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M298.594 256.011 503.183 51.422c11.776-11.776 11.776-30.81 0-42.586s-30.81-11.776-42.586 0L256.008 213.425 51.418 8.836C39.642-2.94 20.608-2.94 8.832 8.836s-11.776 30.81 0 42.586l204.589 204.589L8.832 460.6c-11.776 11.776-11.776 30.81 0 42.586a30.034 30.034 0 0 0 21.293 8.824c7.71 0 15.42-2.952 21.293-8.824l204.589-204.589 204.589 204.589a30.034 30.034 0 0 0 21.293 8.824c7.71 0 15.42-2.952 21.293-8.824 11.776-11.776 11.776-30.81 0-42.586L298.594 256.011z" fill="#000000" opacity="1" data-original="#000000" class=""/></g></svg></label>
                                                            </div>
                                                             <div class="cart-icons-select">
                                                                <input type="radio" id="item_delete_icon2" name="item_delete_icon" value="2" <?php checked( $delete_icon_value, '2' ); ?>>
                                                                <label for="item_delete_icon2"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1ZM20 4h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z" fill="#000000" opacity="1" data-original="#000000" class=""/><path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0ZM15 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z" fill="#000000" opacity="1" data-original="#000000" class=""/></g></svg></label>
                                                            </div>
                                                        
                                                            <div class="cart-icons-select">
                                                                <input type="radio" id="item_delete_icon3" name="item_delete_icon" value="3" <?php checked( $delete_icon_value, '3' ); ?>>
                                                                <label for="item_delete_icon3"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" x="0" y="0" viewBox="0 0 50 50" style="enable-background:new 0 0 512 512" xml:space="preserve" fill-rule="evenodd" class=""><g><path d="M41.745 12.563c.283 0 .567.121.767.331.183.21.283.493.267.776 0 0-1.267 19.809-1.834 28.401a5.198 5.198 0 0 1-5.185 4.878H14.386a5.198 5.198 0 0 1-5.185-4.878A21330.79 21330.79 0 0 1 7.367 13.67a1.093 1.093 0 0 1 .267-.776c.2-.21.484-.33.767-.33zm-1.117 2.084H9.518l1.75 27.295c.034.347.1.694.25 1.017.484 1.155 1.635 1.89 2.868 1.906h21.44a3.176 3.176 0 0 0 3.051-2.923zM28.199 3.185a3.127 3.127 0 0 1 3.126 3.126v2.084c0 .575-.466 1.042-1.042 1.042h-10.42a1.042 1.042 0 0 1-1.042-1.042V6.311a3.127 3.127 0 0 1 3.126-3.126zm1.042 4.168V6.311a1.043 1.043 0 0 0-1.042-1.042h-6.252a1.043 1.043 0 0 0-1.042 1.042v1.042z" fill="#000000" opacity="1" data-original="#000000" class=""/><path d="M35.676 7.356c.156.01.306.05.444.122.752.409.698 1.542-.091 1.878-.129.052-.267.081-.406.081H6.437c-.569 0-1.042.474-1.043 1.042 0 .628-.167 1.44.42 1.878.08.06.17.107.264.143.116.042.236.06.359.063h37.525c.576 0 1.042-.466 1.042-1.042v-1.042c0-.576-.466-1.042-1.042-1.042h-4.17a1.043 1.043 0 0 1 0-2.084h4.17a3.126 3.126 0 0 1 3.127 3.126v1.042c0 1.727-1.4 3.126-3.127 3.126H6.437a3.126 3.126 0 0 1-3.128-3.126v-1.042c0-1.727 1.4-3.126 3.128-3.126h29.186zM19.13 24.817 29.442 35.13a1.042 1.042 0 0 0 1.474-1.474L20.603 23.344a1.042 1.042 0 0 0-1.474 1.473z" fill="#000000" opacity="1" data-original="#000000" class=""/><path d="M29.491 23.295 19.177 33.608a1.042 1.042 0 0 0 1.474 1.474l10.313-10.314a1.042 1.042 0 0 0-1.473-1.473z" fill="#000000" opacity="1" data-original="#000000" class=""/><path d="M19.13 24.817 29.442 35.13a1.042 1.042 0 0 0 1.474-1.474L20.603 23.344a1.042 1.042 0 0 0-1.474 1.473z" fill="#000000" opacity="1" data-original="#000000" class=""/><path d="M29.491 23.295 19.177 33.608a1.042 1.042 0 0 0 1.474 1.474l10.313-10.314a1.042 1.042 0 0 0-1.473-1.473z" fill="#000000" opacity="1" data-original="#000000" class=""/></g></svg> </label>
                                                            </div>
                                                             <div class="cart-icons-select">
                                                                <input type="radio" id="item_delete_icon4" name="item_delete_icon" value="4" <?php checked( $delete_icon_value, '4' ); ?>>
                                                                <label for="item_delete_icon4"><svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 512.016 512.016" height="20" viewBox="0 0 512.016 512.016" width="20"><g><path d="m448.199 164.387h-236.813l106.048-106.048c5.858-5.858 5.858-15.356 0-21.215l-26.872-26.872c-13.669-13.669-35.831-13.669-49.501 0l-27.63 27.631-14.144-14.144c-15.596-15.597-40.975-15.596-56.572 0l-55.158 55.158c-15.597 15.597-15.597 40.976 0 56.573l14.143 14.144-27.63 27.63c-13.669 13.669-13.669 35.831 0 49.501l26.872 26.872c5.857 5.858 15.356 5.859 21.214 0l38.021-38.021v231.416c0 35.901 29.104 65.005 65.005 65.005h158.012c35.901 0 65.005-29.104 65.005-65.005zm-325.284-35.989-14.143-14.143c-3.899-3.899-3.899-10.244 0-14.144l55.158-55.158c3.9-3.9 10.245-3.899 14.143 0l14.143 14.144zm129.533 299.612c0 8.285-6.716 15.001-15.001 15.001s-15.001-6.716-15.001-15.001v-179.616c0-8.285 6.716-15.001 15.001-15.001s15.001 6.716 15.001 15.001zm66.741 0c0 8.285-6.716 15.001-15.001 15.001s-15.001-6.716-15.001-15.001v-179.616c0-8.285 6.716-15.001 15.001-15.001s15.001 6.716 15.001 15.001zm66.741 0c0 8.285-6.716 15.001-15.001 15.001s-15.001-6.716-15.001-15.001v-179.616c0-8.285 6.716-15.001 15.001-15.001s15.001 6.716 15.001 15.001z"/><path d="m320.898 113.548c-9.151 3.19-15.571 11.361-16.631 20.842h143.932v-24.932c0-17.119-16.845-29.167-33.022-23.682l-93.968 27.672c-.101.029-.211.069-.311.1z"/></g></svg></label>
                                                            </div>
                                                             <div class="cart-icons-select">
                                                                <input type="radio" id="item_delete_icon5" name="item_delete_icon" value="5" <?php checked( $delete_icon_value, '5' ); ?>>
                                                                <label for="item_delete_icon5"><svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="20" height="20" enable-background="new 0 0 512 512" viewBox="0 0 512 512"><g id="Layer_2_00000060023533762576666680000013708961081672033712_"><g id="trash_xmark"><path d="m64.9 123.9c0 4 13.4 231.9 20.2 340 1.9 29.9 21.7 48 52 48h235.6c34.5 0 52.7-17.7 54.8-52 5.6-92.4 19.2-317.7 20.2-336.1zm271.5 227.5c12.9 12.9 12.9 33.8 0 46.7s-33.8 12.9-46.7 0l-33.4-33.4-33.4 33.4c-12.9 12.9-33.8 12.9-46.7 0s-12.9-33.8 0-46.7l33.4-33.4-33.4-33.5c-12.9-12.9-12.9-33.8 0-46.7s33.8-12.9 46.7 0l33.4 33.4 33.4-33.4c12.9-12.9 33.8-12.9 46.7 0s12.9 33.8 0 46.7l-33.4 33.5z"/><path d="m447.3 32.9c-27.1-.2-54.1-.4-81.1.1-1.6-18.6-17.2-33-35.9-33h-148.6c-18.7 0-34.3 14.4-35.8 33-27.8-.5-55.7-.3-83.5-.1-14.6.2-25.2 8.3-28.7 21.1-6.1 22.3 7.4 40.7 30.5 40.8 64.1.2 128.1.1 192.1.1h190.8c20.7 0 32.6-11.6 32.7-30.9s-11.9-31-32.5-31.1z"/></g></g></svg></label>
                                                            </div>
                                                            <div class="cart-icons-select">
                                                                <input type="radio" id="item_delete_icon6" name="item_delete_icon" value="6" <?php checked( $delete_icon_value, '6' ); ?>>
                                                                <label for="item_delete_icon6"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none" height="20" viewBox="0 0 24 24" width="20"><clipPath id="clip0_13_3375"><path d="m0 0h24v24h-24z"/></clipPath><g clip-path="url(#clip0_13_3375)" fill="#000"><path d="m18.5 24c1.3807 0 2.5-1.1193 2.5-2.5s-1.1193-2.5-2.5-2.5-2.5 1.1193-2.5 2.5 1.1193 2.5 2.5 2.5z"/><path d="m8.5 24c1.38071 0 2.5-1.1193 2.5-2.5s-1.11929-2.5-2.5-2.5-2.5 1.1193-2.5 2.5 1.11929 2.5 2.5 2.5z"/><path d="m20.5 18h-11.541c-1.663 0-3.106-1.183-3.432-2.813l-2.437-12.187h-2.59c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h3c.238 0 .443.168.49.402l2.518 12.588c.233 1.165 1.263 2.01 2.451 2.01h11.541c.276 0 .5.224.5.5s-.224.5-.5.5z"/><path d="m21.972 11.279c-.149-.088-.332-.094-.485-.013-.935.487-1.94.734-2.987.734-3.584 0-6.51-2.71-6.506-6.376 0-.007.005-.103.006-.109.004-.138-.049-.271-.146-.368-.098-.098-.233-.15-.369-.147h-7c-.146.004-.283.073-.374.187-.092.113-.13.261-.102.405l1.5 8c.044.237.25.408.491.408h13.734c1.258 0 2.325-.941 2.48-2.19.003-.025.003-.088.003-.113-.004-.172-.097-.33-.245-.418z"/><path d="m18.5 0c-3.033 0-5.5 2.467-5.5 5.5s2.467 5.5 5.5 5.5 5.5-2.467 5.5-5.5-2.467-5.5-5.5-5.5zm2.354 7.146c.195.195.195.512 0 .707-.098.098-.226.147-.354.147s-.256-.049-.354-.146l-1.646-1.647-1.646 1.646c-.098.098-.226.147-.354.147s-.256-.049-.354-.146c-.195-.195-.195-.512 0-.707l1.647-1.647-1.646-1.646c-.195-.195-.195-.512 0-.707s.512-.195.707 0l1.646 1.646 1.646-1.646c.195-.195.512-.195.707 0s.195.512 0 .707l-1.646 1.646z"/></g></svg></label>
                                                            </div>
                                                        
                                                        
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="item_delete_icon_color">Item Delete Button icon Color</label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="item_delete_icon_color" name="item_delete_icon_color" value="<?php echo esc_attr(get_option('item_delete_icon_color', '#ffffff')); ?>">
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

                                <!-- cart realated items setting   -->
                                <li>
                                      <div class="kartly-realted">
                                        <span>Kartly Related Items Settings</span>
                                        <div class="options-area">
                                           <h4>Pro Release</h4>
                                        </div> 
                                    </div>  
                                </li>

                                <!-- Cart buttons settings  -->
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
                                <!-- carts shortcode and other information  -->
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

