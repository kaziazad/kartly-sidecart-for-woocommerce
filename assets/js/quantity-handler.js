class WSCartQuantityUpdater {
    constructor(selector) {
      this.selector = selector;
      this.ajaxUrl = WSCartAjax.ajax_url;
      this.nonce = WSCartAjax.nonce;
      this.bindEvents();
    }
  
    bindEvents() {
      jQuery(document).on('change', this.selector, (e) => {
        const input = jQuery(e.currentTarget);
        const cartKey = input.data('cart-key');
        const quantity = input.val();
  
        this.sendUpdate(cartKey, quantity);
      });
    }
  
    sendUpdate(cartKey, quantity) {
      jQuery.ajax({
        url: this.ajaxUrl,
        type: 'POST',
        data: {
          action: 'ws_update_cart_quantity',
          cart_key: cartKey,
          quantity: quantity,
          nonce: this.nonce
        },
        success: (response) => {
          console.log('Cart updated:', response.data);
          // Optionally refresh cart UI
        },
        error: (xhr, status, error) => {
          console.error('Error:', error);
        }
      });
    }
  }
  
  jQuery(document).ready(function () {
    new WSCartQuantityUpdater('.item_quantity_ws');
  });
  