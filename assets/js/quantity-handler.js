/**
 * WSCartQuantityUpdater class handles updating WooCommerce cart item quantities via AJAX
 * when the user changes the quantity input field.
 */
class WSCartQuantityUpdater {
  /**
   * @param {string} selector - jQuery selector for the quantity input fields.
   */
  constructor(selector) {
    this.selector = selector;
    this.ajaxUrl = WSCartAjax.ajax_url; // AJAX endpoint provided by WordPress
    this.nonce = WSCartAjax.nonce;     // Security nonce for request validation
    this.bindEvents();                 // Bind event listeners on init
  }

  /**
   * Binds the 'change' event to quantity inputs to trigger the update.
   */
  bindEvents() {
    jQuery(document).on('change', this.selector, (e) => {
      const input = jQuery(e.currentTarget);
      const cartKey = input.data('cart-key'); // WooCommerce cart item key
      const quantity = input.val();           // New quantity value

      this.sendUpdate(cartKey, quantity);     // Send AJAX request to update cart
    });
  }

  /**
   * Sends the updated quantity to the server via AJAX.
   *
   * @param {string} cartKey - The WooCommerce cart item key.
   * @param {number} quantity - The new quantity value.
   */
  sendUpdate(cartKey, quantity) {
    jQuery.ajax({
      url: this.ajaxUrl,
      type: 'POST',
      data: {
        action: 'ws_update_cart_quantity', // PHP handler for updating quantity
        cart_key: cartKey,
        quantity: quantity,
        nonce: this.nonce
      },
      success: (response) => {
        console.log('Cart updated:', response.data);
        // Optionally update the cart UI here if needed
      },
      error: (xhr, status, error) => {
        console.error('Error:', error);
      }
    });
  }
}

// Initialize the cart quantity updater when the DOM is ready
jQuery(document).ready(function () {
  new WSCartQuantityUpdater('.item_quantity_ws'); // Apply to elements with this class
});
