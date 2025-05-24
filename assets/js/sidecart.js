

// document.getElementById('cart_button_ws_id').onclick = function() {
//   const sidecartws = document.getElementById('wscart-side-cart-body-id');

//   if(sidecartws.style.right === '-700px'|| sidecartws.style.right === ''){
//     sidecartws.style.right = '0';
//   }else{
//     sidecartws.style.right = '-700px';
//   }
// };


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



                        const sidecartContainer = document.querySelector('#wscart-side-cart-body-id'); // <-- replace with your actual sidecart container ID or class
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

       
