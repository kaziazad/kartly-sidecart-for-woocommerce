

// document.getElementById('cart_button_ws_id').onclick = function() {
//   const sidecartws = document.getElementById('wscart-side-cart-body-id');

//   if(sidecartws.style.right === '-700px'|| sidecartws.style.right === ''){
//     sidecartws.style.right = '0';
//   }else{
//     sidecartws.style.right = '-700px';
//   }
// };


// after add to cart action 
jQuery( document ).ready(function($) {
    
    jQuery(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
        console.log('✅ Product added to cart via AJAX');

        // Update sidecart
        refreshSideCart();
    });

});


function refreshSideCart() {
    const formData = new FormData();
    formData.append('action', 'get_updated_side_cart');
    formData.append('security', WSCartAjax.nonce);

    fetch(WSCartAjax.ajax_url, {
        method: 'POST',
        credentials: 'same-origin',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        console.log('Updated cart:', data.data);

      
            const sidecartContainer = document.querySelector('#cart-items-container-id');
            if (sidecartContainer && data.data.cart_html) {
                sidecartContainer.innerHTML = data.data.cart_html;
            }
        
    })
    .catch(error => {
        console.error('Error fetching updated cart:', error);
    });
}
    


// Delete Item from cart 

        function deleteItem(param) {

            // alert(param);
            
            const formData = new FormData(); 

            formData.append('action', 'delete_item_from_cart');
            formData.append('security', WSCartAjax.nonce);
            formData.append('product_id', param); 


            fetch(WSCartAjax.ajax_url, {
                method: 'POST', 
                credentials: 'same-origin', 
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    console.log('success', data.data); 

                    const sidecartContainer = document.querySelector('#cart-items-container-id'); 

                if(sidecartContainer && data.data.cart_html) {
                    sidecartContainer.innerHTML = data.data.cart_html;
                }



                }else{
                    console.log('Faild:', data.data);
                }
            })
            .catch(error => {
                console.error('Error:', error); 
            });
    }



    // Item quantity change and update 

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

    if (button.classList.contains('plus')) {
      quantity++;
    } else if (button.classList.contains('minus') && quantity > 1) {
      quantity--;
    }

    display.textContent = quantity;

    // Send AJAX
    const formData = new FormData();
    formData.append('action', 'update_cart_item_quantity');
    formData.append('cart_item_key', cartItemKey);
    formData.append('credentials', 'same-origin');
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


// shop button link 

jQuery(document).ready(function($) {
  $('.wsshopping-continue').attr('href', WSCartAjax.shop_url);
  $('.ws-view-cart').attr('href', WSCartAjax.cart_url);
  $('.ws-checkout').attr('href', WSCartAjax.checkout_url);
});