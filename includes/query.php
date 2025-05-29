<?php

namespace WSCART;

if( !defined( 'ABSPATH' )){
    exit; 
}



class Query{

    public function __construct()
    {
    //    add_action('wp_loaded', array($this, 'cart_query')); 
    
    } 

    

    public static function cart_query(){

        if( !WC()->cart ){
            return; 
        }
    
        $cart_items = WC()->cart->get_cart(); 
      
        echo "<pre>";
        // var_dump($cart_items);
        echo "</pre>";


        if(empty($cart_items)){
            echo '<p>Cart is empty.</p>'; 
            return; 
        }
        
    ?>
    <form action="" method="POST">
    <table class='cart-table'>
        <tbody>
            
        <?php
        echo "<pre>";
        // var_dump($cart_items);
        echo "</pre>";
            foreach($cart_items as $cart_item_key => $cart_item){
                $products = $cart_item['data'];
                echo "<pre>";
                    // var_dump($products);
                echo "</pre>";
                $product_id = $cart_item['product_id'];
                // echo  $product_id;
                $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' );

                // var_dump ($product_image);
                $product_name = get_the_title($product_id);
                $quantity = $cart_item['quantity'];
                $price =  $products->get_price();


        ?>
            <tr>
                <td class="close_btn_ws" onclick="deleteItem(<?php echo esc_js($product_id); ?>)"><i class="fa-solid fa-x"></i></td>
                <td class="item_image_ws"><img src="<?php  echo esc_url($product_image[0]); ?>"></td>
                <td class="item_title_ws"><?php echo esc_html($product_name); ?></td>
                
                <td class="item_quantity_wrapper_ws"><?php echo wp_kses_post( wc_price( floatval( $price ) ) ).' '; ?><i class="fa-solid fa-x"></i><input 
  type="number" 
  class="item_quantity_ws" 
  data-cart-key="<?php echo esc_attr($cart_item_key); ?>" 
  value="<?php echo esc_attr($quantity); ?>" onchange="itemQuantityUpdate(this)" data-product-id = "<?php echo esc_attr($product_id); ?>"></td>

                <td class="">
                <div class="quantity-selector" data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>">
                <button class="quantity-button minus">−</button>
                <div class="quantity-number"><?php echo esc_html( $cart_item['quantity'] ); ?></div>
                <button class="quantity-button plus">+</button>
                </div>

                </td>
                <td class="item_total_ws"><?php echo wp_kses_post( wc_price( floatval( $quantity*$price ) ) ); ?></td>
            </tr>
        <?php
        }
        ?>
            <tr class="total-price_ws">
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td><?php echo wp_kses_post( WC()->cart->get_total() ); ?></td>
           </tr>
        </tbody>

    </table>

    </form>
    <?php

    }


}