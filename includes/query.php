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
            <div class="cart-items-area">
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
                                <!-- <i class="fa-solid fa-x" style="color:<?php echo esc_attr(get_option('item_delete_icon')); ?>; background:<?php echo esc_attr(get_option('item_delete_bg')); ?>; border-radius:<?php echo esc_attr(get_option('items_delete_button_border_radius')); ?>px;"></i> -->
                                  <?php  $delete_icon_value = esc_attr(get_option( 'item_delete_icon'));

                            if($delete_icon_value == 1){ ?>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30" x="0" y="0" viewBox="0 0 512.015 512.015" style="background:<?php echo esc_attr(get_option('item_delete_bg')); ?>; padding:5px; border-radius:<?php echo esc_attr(get_option('items_delete_button_border_radius')); ?>px;" xml:space="preserve" class=""><g><path d="M298.594 256.011 503.183 51.422c11.776-11.776 11.776-30.81 0-42.586s-30.81-11.776-42.586 0L256.008 213.425 51.418 8.836C39.642-2.94 20.608-2.94 8.832 8.836s-11.776 30.81 0 42.586l204.589 204.589L8.832 460.6c-11.776 11.776-11.776 30.81 0 42.586a30.034 30.034 0 0 0 21.293 8.824c7.71 0 15.42-2.952 21.293-8.824l204.589-204.589 204.589 204.589a30.034 30.034 0 0 0 21.293 8.824c7.71 0 15.42-2.952 21.293-8.824 11.776-11.776 11.776-30.81 0-42.586L298.594 256.011z" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>" opacity="1" data-original="#000000" class=""/></g></svg>
                            <?php 
                            }elseif($delete_icon_value == 2){?>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30" x="0" y="0" viewBox="0 0 24 24" style="background:<?php echo esc_attr(get_option('item_delete_bg')); ?>; padding:3px; border-radius:<?php echo esc_attr(get_option('items_delete_button_border_radius')); ?>px;" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1ZM20 4h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>" opacity="1" data-original="#000000" class=""/><path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0ZM15 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>" opacity="1" data-original="#000000" class=""/></g></svg>

                            <?php
                            }elseif ($delete_icon_value == 3) {?>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30" x="0" y="0" viewBox="0 0 50 50" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>" style="background:<?php echo esc_attr(get_option('item_delete_bg')); ?>; padding:5px; border-radius:<?php echo esc_attr(get_option('items_delete_button_border_radius')); ?>px;" style="enable-background:new 0 0 512 512" xml:space="preserve" fill-rule="evenodd" class=""><g><path d="M41.745 12.563c.283 0 .567.121.767.331.183.21.283.493.267.776 0 0-1.267 19.809-1.834 28.401a5.198 5.198 0 0 1-5.185 4.878H14.386a5.198 5.198 0 0 1-5.185-4.878A21330.79 21330.79 0 0 1 7.367 13.67a1.093 1.093 0 0 1 .267-.776c.2-.21.484-.33.767-.33zm-1.117 2.084H9.518l1.75 27.295c.034.347.1.694.25 1.017.484 1.155 1.635 1.89 2.868 1.906h21.44a3.176 3.176 0 0 0 3.051-2.923zM28.199 3.185a3.127 3.127 0 0 1 3.126 3.126v2.084c0 .575-.466 1.042-1.042 1.042h-10.42a1.042 1.042 0 0 1-1.042-1.042V6.311a3.127 3.127 0 0 1 3.126-3.126zm1.042 4.168V6.311a1.043 1.043 0 0 0-1.042-1.042h-6.252a1.043 1.043 0 0 0-1.042 1.042v1.042z" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>" opacity="1" data-original="#000000" class=""/><path d="M35.676 7.356c.156.01.306.05.444.122.752.409.698 1.542-.091 1.878-.129.052-.267.081-.406.081H6.437c-.569 0-1.042.474-1.043 1.042 0 .628-.167 1.44.42 1.878.08.06.17.107.264.143.116.042.236.06.359.063h37.525c.576 0 1.042-.466 1.042-1.042v-1.042c0-.576-.466-1.042-1.042-1.042h-4.17a1.043 1.043 0 0 1 0-2.084h4.17a3.126 3.126 0 0 1 3.127 3.126v1.042c0 1.727-1.4 3.126-3.127 3.126H6.437a3.126 3.126 0 0 1-3.128-3.126v-1.042c0-1.727 1.4-3.126 3.128-3.126h29.186zM19.13 24.817 29.442 35.13a1.042 1.042 0 0 0 1.474-1.474L20.603 23.344a1.042 1.042 0 0 0-1.474 1.473z" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>" opacity="1" data-original="#000000" class=""/><path d="M29.491 23.295 19.177 33.608a1.042 1.042 0 0 0 1.474 1.474l10.313-10.314a1.042 1.042 0 0 0-1.473-1.473z" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>" opacity="1" data-original="#000000" class=""/><path d="M19.13 24.817 29.442 35.13a1.042 1.042 0 0 0 1.474-1.474L20.603 23.344a1.042 1.042 0 0 0-1.474 1.473z" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>" opacity="1" data-original="#000000" class=""/><path d="M29.491 23.295 19.177 33.608a1.042 1.042 0 0 0 1.474 1.474l10.313-10.314a1.042 1.042 0 0 0-1.473-1.473z" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>" opacity="1" data-original="#000000" class=""/></g></svg>
                            <?php
                            }elseif ($delete_icon_value == 4) {?>
                                <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 512.016 512.016" height="30" viewBox="0 0 512.016 512.016" width="30" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>"  style="background:<?php echo esc_attr(get_option('item_delete_bg')); ?>; padding:5px; border-radius:<?php echo esc_attr(get_option('items_delete_button_border_radius')); ?>px;"><g><path d="m448.199 164.387h-236.813l106.048-106.048c5.858-5.858 5.858-15.356 0-21.215l-26.872-26.872c-13.669-13.669-35.831-13.669-49.501 0l-27.63 27.631-14.144-14.144c-15.596-15.597-40.975-15.596-56.572 0l-55.158 55.158c-15.597 15.597-15.597 40.976 0 56.573l14.143 14.144-27.63 27.63c-13.669 13.669-13.669 35.831 0 49.501l26.872 26.872c5.857 5.858 15.356 5.859 21.214 0l38.021-38.021v231.416c0 35.901 29.104 65.005 65.005 65.005h158.012c35.901 0 65.005-29.104 65.005-65.005zm-325.284-35.989-14.143-14.143c-3.899-3.899-3.899-10.244 0-14.144l55.158-55.158c3.9-3.9 10.245-3.899 14.143 0l14.143 14.144zm129.533 299.612c0 8.285-6.716 15.001-15.001 15.001s-15.001-6.716-15.001-15.001v-179.616c0-8.285 6.716-15.001 15.001-15.001s15.001 6.716 15.001 15.001zm66.741 0c0 8.285-6.716 15.001-15.001 15.001s-15.001-6.716-15.001-15.001v-179.616c0-8.285 6.716-15.001 15.001-15.001s15.001 6.716 15.001 15.001zm66.741 0c0 8.285-6.716 15.001-15.001 15.001s-15.001-6.716-15.001-15.001v-179.616c0-8.285 6.716-15.001 15.001-15.001s15.001 6.716 15.001 15.001z"/><path d="m320.898 113.548c-9.151 3.19-15.571 11.361-16.631 20.842h143.932v-24.932c0-17.119-16.845-29.167-33.022-23.682l-93.968 27.672c-.101.029-.211.069-.311.1z"/></g></svg>
                            <?php
                            }elseif ($delete_icon_value == 5) {?>
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" width="30" height="30" enable-background="new 0 0 512 512" viewBox="0 0 512 512" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>" style="background:<?php echo esc_attr(get_option('item_delete_bg')); ?>; padding:5px; border-radius:<?php echo esc_attr(get_option('items_delete_button_border_radius')); ?>px;"><g id="Layer_2_00000060023533762576666680000013708961081672033712_"><g id="trash_xmark"><path d="m64.9 123.9c0 4 13.4 231.9 20.2 340 1.9 29.9 21.7 48 52 48h235.6c34.5 0 52.7-17.7 54.8-52 5.6-92.4 19.2-317.7 20.2-336.1zm271.5 227.5c12.9 12.9 12.9 33.8 0 46.7s-33.8 12.9-46.7 0l-33.4-33.4-33.4 33.4c-12.9 12.9-33.8 12.9-46.7 0s-12.9-33.8 0-46.7l33.4-33.4-33.4-33.5c-12.9-12.9-12.9-33.8 0-46.7s33.8-12.9 46.7 0l33.4 33.4 33.4-33.4c12.9-12.9 33.8-12.9 46.7 0s12.9 33.8 0 46.7l-33.4 33.5z"/><path d="m447.3 32.9c-27.1-.2-54.1-.4-81.1.1-1.6-18.6-17.2-33-35.9-33h-148.6c-18.7 0-34.3 14.4-35.8 33-27.8-.5-55.7-.3-83.5-.1-14.6.2-25.2 8.3-28.7 21.1-6.1 22.3 7.4 40.7 30.5 40.8 64.1.2 128.1.1 192.1.1h190.8c20.7 0 32.6-11.6 32.7-30.9s-11.9-31-32.5-31.1z"/></g></g></svg>
                            <?php
                            }elseif($delete_icon_value == 6){?>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>" height="30" viewBox="0 0 24 24" width="30" style="background:<?php echo esc_attr(get_option('item_delete_bg')); ?>; padding:5px; border-radius:<?php echo esc_attr(get_option('items_delete_button_border_radius')); ?>px;"><clipPath id="clip0_13_3375"><path d="m0 0h24v24h-24z"/></clipPath><g clip-path="url(#clip0_13_3375)" fill="<?php echo esc_attr(get_option('item_delete_icon_color')); ?>"><path d="m18.5 24c1.3807 0 2.5-1.1193 2.5-2.5s-1.1193-2.5-2.5-2.5-2.5 1.1193-2.5 2.5 1.1193 2.5 2.5 2.5z"/><path d="m8.5 24c1.38071 0 2.5-1.1193 2.5-2.5s-1.11929-2.5-2.5-2.5-2.5 1.1193-2.5 2.5 1.11929 2.5 2.5 2.5z"/><path d="m20.5 18h-11.541c-1.663 0-3.106-1.183-3.432-2.813l-2.437-12.187h-2.59c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h3c.238 0 .443.168.49.402l2.518 12.588c.233 1.165 1.263 2.01 2.451 2.01h11.541c.276 0 .5.224.5.5s-.224.5-.5.5z"/><path d="m21.972 11.279c-.149-.088-.332-.094-.485-.013-.935.487-1.94.734-2.987.734-3.584 0-6.51-2.71-6.506-6.376 0-.007.005-.103.006-.109.004-.138-.049-.271-.146-.368-.098-.098-.233-.15-.369-.147h-7c-.146.004-.283.073-.374.187-.092.113-.13.261-.102.405l1.5 8c.044.237.25.408.491.408h13.734c1.258 0 2.325-.941 2.48-2.19.003-.025.003-.088.003-.113-.004-.172-.097-.33-.245-.418z"/><path d="m18.5 0c-3.033 0-5.5 2.467-5.5 5.5s2.467 5.5 5.5 5.5 5.5-2.467 5.5-5.5-2.467-5.5-5.5-5.5zm2.354 7.146c.195.195.195.512 0 .707-.098.098-.226.147-.354.147s-.256-.049-.354-.146l-1.646-1.647-1.646 1.646c-.098.098-.226.147-.354.147s-.256-.049-.354-.146c-.195-.195-.195-.512 0-.707l1.647-1.647-1.646-1.646c-.195-.195-.195-.512 0-.707s.512-.195.707 0l1.646 1.646 1.646-1.646c.195-.195.512-.195.707 0s.195.512 0 .707l-1.646 1.646z"/></g></svg>
                            <?php
                            }?>
                                  
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
            </div>
            <div class="kartly-coupon">
                <div> <input type="text"></div>
                <div><button>Apply</button></div>
            </div>
        <!-- </form> -->
        <!-- End of custom cart table UI -->

        <?php
    }
}