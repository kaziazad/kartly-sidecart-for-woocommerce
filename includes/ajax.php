<?php


namespace WSCART;



if (!defined('ABSPATH')) {
    exit;
}




class Ajax{

    public function __construct()
    {
        add_action('wp_ajax_delete_item_from_cart', array($this, "delete_item_form_cart"));  
        add_action('wp_ajax_nopriv_delete_item_from_cart', array($this, "delete_item_form_cart"));  
       


        add_action('wp_ajax_get_updated_side_cart', array($this, "get_updated_side_cart"));  
        add_action('wp_ajax_nopriv_get_updated_side_cart', array($this, "get_updated_side_cart"));  


        
        add_action('wp_ajax_update_cart_item_quantity', array($this, "update_cart_item_quantity"));  
        add_action('wp_ajax_nopriv_update_cart_item_quantity', array($this, "update_cart_item_quantity"));  

       
    }


    function remove_item_from_cart_by_product_id($product_id) {
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                
                if ($cart_item['product_id'] == $product_id) {
                    WC()->cart->remove_cart_item($cart_item_key);
                    break; // remove only one instance, remove this line if you want to remove all
                }
            }
        }


    public function delete_item_form_cart(){

         check_ajax_referer('ws_cart_nonce', 'security');

         if(!isset($_POST['product_id'])){
            wp_send_json_error('Missing Product ID');
         }

         $product_id = intval($_POST['product_id']); 

         if(!WC()->cart){
            wp_send_json_error('Cart not initialized'); 

         }

        $this->remove_item_from_cart_by_product_id($product_id);


        ob_start(); ?>

             <!-- <div class="wscart-title" style="">
            <span class="dashicons dashicons-cart"></span><span>Your Cart</span>
            </div> -->
            <!-- <div class="cart-items-container" id="cart-items-conatiner-id">  -->
                <?php
               Query::cart_query();
                ?>
            <!-- </div>  -->
            <?php
        $cart_html = ob_get_clean();


         wp_send_json_success(['cart_html' => $cart_html]);

         

    } 



    public function update_product_quantity(){

        check_ajax_referer('ws_cart_nonce', 'security');

        if(isset( $_POST['product_id'])){
                $product_id = intval($_POST['product_id']); 
        }
        
        if(isset($_POST['quantity'])){
              $quantity = intval($_POST['quantity']); 
        }
     

        if(!$product_id || $quantity < 0){
            wp_send_json_error(['message' => 'Invalid product or quantity.']);
        }
        
        foreach(WC()->cart->get_cart() as $cart_item_key => $cart_item){
            if($cart_item['product_id'] == $product_id){
                if($quantity == 0){
                    WC()->cart->remove_cart_item($cart_item_key); 
                }else{
                    WC()->cart->set_quantity($cart_item_key, $quantity); 
                }

                WC()->cart->calculate_totals(); 

                ob_start(); ?>

             <!-- <div class="wscart-title" style="background-color:red;">
            <span class="dashicons dashicons-cart"></span><span>Your Cart</span>
            </div>
            <div class="cart-items-container">  -->
                <?php
               Query::cart_query();
                ?>
            <!-- </div>  -->
            <?php
        $cart_html = ob_get_clean();

           wp_send_json_success([
            'message' => 'Cart Updated',
            'cart_html' => $cart_html
            ]);


            }
        }


       wp_send_json_error(['message' => 'Product not found in cart.']);

    }


    function get_updated_side_cart() {

     check_ajax_referer('ws_cart_nonce', 'security');


    ob_start(); ?>

        <!-- <div class="wscart-title" style="">
            <span class="dashicons dashicons-cart"></span><span>Your Cart</span>
            </div>
            <div class="cart-items-container">  -->
                <?php
               Query::cart_query();
                ?>
            <!-- </div>  -->
            <?php
        $cart_html = ob_get_clean();


    wp_send_json_success(['cart_html' => $cart_html]);
}




// Quantity change update function 




public function update_cart_item_quantity(){
    check_ajax_referer('ws_cart_nonce', 'security');

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);

    if ($cart_item_key && $quantity >= 1) {
        WC()->cart->set_quantity($cart_item_key, $quantity, true);
        WC()->cart->calculate_totals();
    }

    ob_start();
    ?>
    <!-- <div class="wscart-title">
        <span class="dashicons dashicons-cart"></span><span>Your Cart</span>
    </div>
    <div class="cart-items-container"> -->
        <?php Query::cart_query(); ?>
    <!-- </div> -->
    <?php
    $cart_html = ob_get_clean();

    

    wp_send_json_success([
        'cart_html' => $cart_html,
       
    ]);
}


}