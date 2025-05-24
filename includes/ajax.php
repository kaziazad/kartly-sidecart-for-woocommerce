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
        // $this remove_item_from_cart_by_product_id()
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

             <div class="wscart-title" style="background-color:red;">
            <span class="dashicons dashicons-cart"></span><span>Your Cart</span>
            </div>
            <div class="cart-items-container"> 
                <?php
               Query::cart_query();
                ?>
            </div> 
            <?php
        $cart_html = ob_get_clean();


         wp_send_json_success(['cart_html' => $cart_html]);

         

    } 





}