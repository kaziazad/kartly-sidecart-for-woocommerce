// ================================
// Side Cart Toggle (Commented Out)
// ================================
// This section toggles the side cart visibility by moving it in and out of view
// via right position (commented out, possibly handled elsewhere now).


document.getElementById('wscart-close-id').onclick = function() {
  const sidecartws = document.getElementById('wscart-side-cart-body-id');
 
    sidecartws.style.right = '-700px';
  
};

// document.addEventListener('DOMContentLoaded', function () {
//   const cartButton = document.getElementById('cart_button_ws_id');
//   if (cartButton) {
//     cartButton.addEventListener('click', function () {
//       wsCartToggle();
//     });
//   }
// });



function wsCartToggle() {

  const sidecartws = document.getElementById('wscart-side-cart-body-id');
   if (sidecartws.style.right === '-700px' || sidecartws.style.right === '') {
     sidecartws.style.right = '0';
   } else {
     sidecartws.style.right = '-700px';
   }
  
}


function wsCartShow(){
  const sidecartws = document.getElementById('wscart-side-cart-body-id');
  sidecartws.style.right = '0';
}


// ============================
// Handle "Add to Cart" Event
// ============================
jQuery(document).ready(function ($) {

  // Listen for WooCommerce's AJAX add to cart event
  jQuery(document.body).on('added_to_cart', function (event, fragments, cart_hash, $button) {
    // console.log('✅ Product added to cart via AJAX');

    // Refresh side cart to show updated content
    refreshSideCart();
    wsCartShow();
  });


});



// ======================
// Refresh Side Cart HTML
// ======================
function refreshSideCart() {
  const formData = new FormData();
  formData.append('action', 'get_updated_side_cart');
  formData.append('security', WSCartAjax.nonce); // Nonce for security

  fetch(WSCartAjax.ajax_url, {
    method: 'POST',
    credentials: 'same-origin',
    body: formData
  })
    .then(res => res.json())
    .then(data => {
      // console.log('Updated cart:', data.data);

      // Update the cart HTML with new contents
      const sidecartContainer = document.querySelector('#cart-items-container-id');
      if (sidecartContainer && data.data.cart_html) {
        sidecartContainer.innerHTML = data.data.cart_html;
      }
    })
    .catch(error => {
      console.error('Error fetching updated cart:', error);
    });
}


// ============================
// Delete Item from the Cart
// ============================
function deleteItem(productId) {
  const formData = new FormData();
  formData.append('action', 'delete_item_from_cart');
  formData.append('security', WSCartAjax.nonce); // Nonce for security
  formData.append('product_id', productId);       // Target product ID

  fetch(WSCartAjax.ajax_url, {
    method: 'POST',
    credentials: 'same-origin',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        console.log('Item deleted:', data.data);

        // Update the cart with new contents
        const sidecartContainer = document.querySelector('#cart-items-container-id');
        if (sidecartContainer && data.data.cart_html) {
          sidecartContainer.innerHTML = data.data.cart_html;
        }
      } else {
        console.log('Failed:', data.data);
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
}


// ======================================
// Handle Quantity Change (Plus/Minus)
// ======================================
document.addEventListener('DOMContentLoaded', function () {
  const sideCartContainer = document.getElementById('wscart-side-cart-body-id');

  sideCartContainer.addEventListener('click', function (event) {
    event.preventDefault();

    const button = event.target.closest('.quantity-button');
    if (!button) return;

    const container = button.closest('.quantity-selector');
    const display = container.querySelector('.quantity-number');
    const cartItemKey = container.getAttribute('data-cart-item-key');
    const security = WSCartAjax.nonce;

    let quantity = parseInt(display.textContent);

    // Adjust quantity
    if (button.classList.contains('plus')) {
      quantity++;
    } else if (button.classList.contains('minus') && quantity > 1) {
      quantity--;
    }

    // Update UI immediately
    display.textContent = quantity;

    // Send updated quantity to server
    const formData = new FormData();
    formData.append('action', 'update_cart_item_quantity');
    formData.append('cart_item_key', cartItemKey);
    formData.append('quantity', quantity);
    formData.append('security', security);

    fetch(WSCartAjax.ajax_url, {
      method: 'POST',
      body: formData,
      credentials: 'same-origin'
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const cartItemContainer = document.getElementById('cart-items-container-id');
          if (data.data.cart_html) {
            cartItemContainer.innerHTML = data.data.cart_html;
          }
        } else {
          console.warn('AJAX succeeded but returned error:', data);
        }
      })
      .catch(error => {
        console.error('AJAX error:', error);
      });
  });
});


// ======================================
// Update Button Links (Shop/Cart/Checkout)
// ======================================
jQuery(document).ready(function ($) {
  $('.wsshopping-continue').attr('href', WSCartAjax.shop_url);
  $('.ws-view-cart').attr('href', WSCartAjax.cart_url);
  $('.ws-checkout').attr('href', WSCartAjax.checkout_url);
});

/*
// Alternative Vanilla JS version (commented out)
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.wsshopping-continue').forEach(function(el) {
    el.setAttribute('href', WSCartAjax.shop_url);
  });

  document.querySelectorAll('.ws-view-cart').forEach(function(el) {
    el.setAttribute('href', WSCartAjax.cart_url);
  });

  document.querySelectorAll('.ws-checkout').forEach(function(el) {
    el.setAttribute('href', WSCartAjax.checkout_url);
  });
});
*/
