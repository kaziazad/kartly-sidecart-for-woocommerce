<?php

namespace WSCART; 

// Exit if accessed directly
if( !defined( 'ABSPATH' )){
    exit;
}

// Use the custom Query class for handling cart data
use WSCART\Query; 

/**
 * Class Side_Cart_Body
 * 
 * Renders the side cart HTML structure in the frontend footer.
 */
class Side_Cart_Body {

    /**
     * Constructor hooks the side cart display function to wp_footer.
     */
    public function __construct() {
        add_action( 'wp_footer', array( $this, 'side_cart_body_callback' ) );
    }

    /**
     * Outputs the side cart HTML on the frontend.
     * This includes:
     * - Cart title with icon
     * - Dynamic cart items loaded via Query::cart_query()
     * - Action buttons for continuing shopping, viewing cart, and checkout
     */
    public function side_cart_body_callback() {
        ?>
        <div class='wscart-side-cart-body' id="wscart-side-cart-body-id" style = "background:<?php echo esc_attr(get_option('title_bg'));?>; border-radius:<?php echo esc_attr(get_option('cart_body_border_radius'));?>px;">
            
            <!-- Cart title bar -->
             <div class="wscart-topbar">
                <div class="wscart-title">
                             <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 32 32" width="20" fill="red"><g id="Layer_2" data-name="Layer 2"><path d="m16 17.82a6 6 0 0 1 -5.89-4.82 1 1 0 0 1 1-1.15 1 1 0 0 1 1 .83 4 4 0 0 0 7.83 0 1 1 0 0 1 1-.83 1 1 0 0 1 1 1.15 6 6 0 0 1 -5.94 4.82z"/><path d="m24.9 31h-17.8a3 3 0 0 1 -3-3.15l.81-17.24a3 3 0 0 1 3-2.87h16.18a3 3 0 0 1 3 2.87l.81 17.24a3 3 0 0 1 -3 3.15zm-16.99-21.25a1 1 0 0 0 -1 1l-.81 17.2a1 1 0 0 0 1 1.05h17.8a1 1 0 0 0 1-1.05l-.81-17.24a1 1 0 0 0 -1-1z"/><path d="m22 8.75h-2v-1.75a4 4 0 0 0 -8 0v1.75h-2v-1.75a6 6 0 0 1 12 0z"/></g></svg>         
                    <!-- <span class="dashicons dashicons-cart" style="color:<?php echo esc_attr(get_option('title_color')); ?>;"></span> -->
                    <span style="color:<?php echo esc_attr(get_option('title_color')); ?>;"><?php echo esc_attr(get_option('kartly_title'));?></span>
                </div>
                <div class="wscart-close" id="wscart-close-id" style="background:<?php echo esc_attr(get_option('cart_close_bg_color'));?>; border-radius:<?php echo esc_attr(get_option('cart_close_button_border_radius'));?>px;">
                    <i class="fa-solid fa-x" style="color:<?php echo esc_attr(get_option('cart_close_color'));?>;"></i>
                </div>
            </div>

            <!-- Container where cart items will be listed -->
            <div class="cart-items-container" id="cart-items-container-id" style="background:<?php echo esc_attr(get_option('cart_items_bg'));?>; border-radius:<?php echo esc_attr(get_option('items_area_border_radius')); ?>px;"> 
                <?php
                // Render cart items using the Query class
                Query::cart_query();
                ?>
            </div>

            <!-- Action buttons -->
            <div class="wscart-buttons">
                <a href="#" class="ws-button wsshopping-continue" onmouseover="this.style.background='<?php echo esc_attr(get_option('shopping_button_color')); ?>'; this.style.color='<?php echo esc_attr(get_option('shopping_button_bg_color')); ?>';" onmouseout="this.style.background='<?php echo esc_attr(get_option('shopping_button_bg_color')); ?>'; this.style.color='<?php echo esc_attr(get_option('shopping_button_color')); ?>'" style="color:<?php echo esc_attr(get_option('shopping_button_color')); ?>; background:<?php echo esc_attr(get_option('shopping_button_bg_color')); ?>; border-radius:<?php echo esc_attr(get_option('continue_shopping_button_border_radius')); ?>px;">Continue Shopping</a>
                <a href="#" class="ws-button ws-view-cart" onmouseover="this.style.background='<?php echo esc_attr(get_option('view_cart_button_color')); ?>'; this.style.color='<?php echo esc_attr(get_option('view_cart_button_bg_color')); ?>';" onmouseout="this.style.background='<?php echo esc_attr(get_option('view_cart_button_bg_color')); ?>'; this.style.color='<?php echo esc_attr(get_option('view_cart_button_color')); ?>'"  style="color:<?php echo esc_attr(get_option('view_cart_button_color')); ?>; background:<?php echo esc_attr(get_option('view_cart_button_bg_color')); ?>; border-radius:<?php echo esc_attr(get_option('view_cart_button_border_radius')); ?>px;">View Cart</a>
                <a href="#" class="ws-button ws-checkout" onmouseover="this.style.background='<?php echo esc_attr(get_option('checkout_button_color')); ?>'; this.style.color='<?php echo esc_attr(get_option('checkout_button_bg_color')); ?>';" onmouseout="this.style.background='<?php echo esc_attr(get_option('checkout_button_bg_color')); ?>'; this.style.color='<?php echo esc_attr(get_option('checkout_button_color')); ?>'"  style="color:<?php echo esc_attr(get_option('checkout_button_color')); ?>; background:<?php echo esc_attr(get_option('checkout_button_bg_color')); ?>; border-radius:<?php echo esc_attr(get_option('checkout_button_border_radius')); ?>px;">Checkout</a>
            </div>

        </div>

        

        <?php
    }
}
