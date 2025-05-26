<?php

namespace WSCART; 

if( !defined( 'ABSPATH' )){
    exit;
}

use WSCART\Query; 

class Side_Cart_Body{
    public function __construct()
    {
        add_action( 'wp_footer', array($this, 'side_cart_body_callback'));
        
    }

    public function side_cart_body_callback(){ 
        // $query = new Query(); 
    //   ob_start();
        ?>
        <div class='wscart-side-cart-body' id="wscart-side-cart-body-id">
            <div class="wscart-title" style="">
            <span class="dashicons dashicons-cart"></span><span>Your Cart</span>
            </div>
            <div class="cart-items-container"> 
                <?php
               Query::cart_query();
                ?>
            </div>
            <div class="wscart-buttons">
                <a href="#" class="ws-button wsshopping-continue">Continue Shopping</a>
                <a href="#" class="ws-button ws-view-cart">View Cart</a>
                <a href="#" class="ws-button ws-checkout">Checkout</a>
                
            </div>
        </div>

        <?php
        // return ob_get_clean();
       
    }
}