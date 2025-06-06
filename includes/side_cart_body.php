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
        <div class='wscart-side-cart-body' id="wscart-side-cart-body-id">
            
            <!-- Cart title bar -->
             <div class="wscart-topbar">
                <div class="wscart-title">
                                      
                    <span class="dashicons dashicons-cart"></span>
                    <span>Your Cart</span>
                </div>
                <div class="wscart-close" id="wscart-close-id">
                    <i class="fa-solid fa-x"></i>
                </div>
            </div>

            <!-- Container where cart items will be listed -->
            <div class="cart-items-container" id="cart-items-container-id"> 
                <?php
                // Render cart items using the Query class
                Query::cart_query();
                ?>
            </div>

            <!-- Action buttons -->
            <div class="wscart-buttons">
                <a href="#" class="ws-button wsshopping-continue">Continue Shopping</a>
                <a href="#" class="ws-button ws-view-cart">View Cart</a>
                <a href="#" class="ws-button ws-checkout">Checkout</a>
            </div>

        </div>
        <?php
    }
}
