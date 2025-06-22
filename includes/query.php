<?php

namespace WSCART;

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Query
 *
 * Handles the rendering of the WooCommerce side cart table UI
 */
class Query {

    public function __construct() {
        // Reserved for future hook-based usage
        // Example: add_action('wp_loaded', [$this, 'cart_query']);
    }

    /**
     * Outputs the current contents of the WooCommerce cart in a custom table format
     */
    public static function cart_query() {
        // Check if WooCommerce cart is initialized
        if (!WC()->cart) {
            return;
        }

        // Retrieve cart items
        $cart_items = WC()->cart->get_cart();

        // If the cart is empty, display a message and exit
        if (empty($cart_items)) {
            echo '<p>Cart is empty.</p>';
            return;
        }
        ?>

        <!-- Start of custom cart table UI -->
        <!-- <form action="" method="POST"> -->
            <table class='cart-table'>
                <tbody>

                <?php
                // Loop through each cart item
                foreach ($cart_items as $cart_item_key => $cart_item) {
                    $products = $cart_item['data'];
                    $product_id = $cart_item['product_id'];
                    $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'single-post-thumbnail');
                    $product_name = get_the_title($product_id);
                    $quantity = $cart_item['quantity'];
                    $price = $products->get_price();
                ?>

                    <tr>
                        <!-- Delete button for item -->
                        <td class="close_btn_ws" onclick="deleteItem(<?php echo esc_js($product_id); ?>)">
                            <i class="fa-solid fa-x" style="color:<?php echo esc_attr(get_option('item_delete_icon')); ?>; background:<?php echo esc_attr(get_option('item_delete_bg')); ?>; border-radius:<?php echo esc_attr(get_option('items_delete_button_border_radius')); ?>px;"></i>
                        </td>

                        <!-- Product image -->
                        <td class="item_image_ws">
                            <?php echo wp_get_attachment_image( get_post_thumbnail_id($product_id), 'thumbnail', false, array( 'class' => 'item-thumb' ) ); ?>
                            
                        </td>

                        <!-- Product name and quantity controls -->
                        <td class="item_title_quantity_wrapper_ws">
                            <div class="item_title_ws" style="color:<?php echo esc_attr(get_option('items_title_color')); ?>;">
                                <?php echo esc_html($product_name); ?>
                            </div>
                            <div class="item_quantity_wrapper_ws">
                                <div class="quantity-selector" style="border-radius:<?php echo esc_attr(get_option('items_area_quantity_border_radius')); ?>px;" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                                    <button class="quantity-button minus" style="color:<?php echo esc_attr(get_option('items_quantity_color')); ?>;">−</button>
                                    <div class="quantity-number" style="color:<?php echo esc_attr(get_option('items_quantity_color')); ?>;"><?php echo esc_html($quantity); ?></div>
                                    <button class="quantity-button plus" style="color:<?php echo esc_attr(get_option('items_quantity_color')); ?>;">+</button>
                                </div>
                            </div>
                        </td>

                        <!-- Subtotal for this item -->
                        <td class="item_total_ws" style="color:<?php echo esc_attr(get_option('items_price_color')); ?>;">
                            <?php echo wp_kses_post(wc_price(floatval($quantity * $price))); ?>
                        </td>
                    </tr>

                <?php } ?>
                   
                    <!-- Total cart price row -->
                    <tr class="total-price_ws">
                        <td></td>
                        <td></td>
                        <td style="color:<?php echo esc_attr(get_option('items_total_price_color')); ?>;">Total</td>
                        <td style="color:<?php echo esc_attr(get_option('items_total_price_color')); ?>;"><?php echo wp_kses_post(WC()->cart->get_total()); ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="kartly-coupon">
                <div> <input type="text"></div>
                <div><button>Apply</button></div>
            </div>
        <!-- </form> -->
        <!-- End of custom cart table UI -->

        <?php
    }
}