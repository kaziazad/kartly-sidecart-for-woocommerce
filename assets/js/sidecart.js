

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

      
            const sidecartContainer = document.querySelector('#wscart-side-cart-body-id');
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

                    const sidecartContainer = document.querySelector('#wscart-side-cart-body-id'); 

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



// Quantity and price total adjust  

    function itemQuantityUpdate(params) {
       const quantity = parseInt(params.value, 10);
       const productId = params.getAttribute('data-product-id');

       console.log("Quantity:", quantity);
       console.log("Product ID:", productId);

       const itemQuantityInfo = new FormData(); 

       itemQuantityInfo.append('action', 'update_product_quantity'); 
       itemQuantityInfo.append('product_id', productId);
       itemQuantityInfo.append('quantity', quantity);
       itemQuantityInfo.append('security', WSCartAjax.nonce);

       fetch(WSCartAjax.ajax_url,{
        method:'POST', 
        credentials: 'same-origin', 
        body: itemQuantityInfo
       })
       .then(response => response.json())
       .then(data => {

        if(data.success){
            console.log('Server Response', data.data);

            const sidecartContainer = document.querySelector('#wscart-side-cart-body-id'); 
        if(sidecartContainer && data.data.cart_html) {
            sidecartContainer.innerHTML = data.data.cart_html;
        }


        }else
        {
                    console.log('Faild:', data.data);
                }
        

         


       })
       .catch(error =>{
        console.error('Ajax Error', error); 
       });


    }
       
// quantity js 

  jQuery(document).ready(function($) {
  $('.quantity-selector').on('click', '.quantity-button', function() {
    const $container = $(this).closest('.quantity-selector');
    const $display = $container.find('.quantity-number');
    const cartItemKey = $container.data('cart-item-key');
    const security = WSCartAjax.nonce;
    let quantity = parseInt($display.text());

    if ($(this).hasClass('plus')) {
      quantity++;
    } else if ($(this).hasClass('minus') && quantity > 1) {
      quantity--;
    }

    $display.text(quantity);

    // Ajax call to update cart item
    $.ajax({
      type: 'POST',
      url: WSCartAjax.ajax_url,
      data: {
        action: 'update_cart_item_quantity',
        cart_item_key: cartItemKey,
        credentials: 'same-origin',
        quantity: quantity, 
        security: security

      },
      success: function(response) {
        console.log('kaj hoice');
        // Optionally refresh fragments or cart total
        $(document.body).trigger('updated_cart_totals');
      }
    });
  });
});