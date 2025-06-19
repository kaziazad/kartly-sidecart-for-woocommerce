jQuery(document).ready(function ($) {

    $(document).on("click", ".kartly-cart-settings-sidebar", function() {
	var numberIndex = $(this).index();

	if (!$(this).is("active")) {
		$(".kartly-cart-settings-sidebar").removeClass("active");
		$(".kartly-cart-settings ul li").removeClass("active");

		$(this).addClass("active");
		$(".kartly-cart-settings ul").find("li:eq(" + numberIndex + ")").addClass("active");

		var listItemHeight = $(".kartly-cart-settings ul")
			.find("li:eq(" + numberIndex + ")")
			.innerHeight();
		$(".kartly-cart-settingsr ul").height(listItemHeight + "px");
	}
});





});



document.addEventListener("DOMContentLoaded", function () {

    // basic settings update and reset 

    const basixForm = document.getElementById("sidecart_basic_settings_form");
    const basicFormSubmit = document.getElementById("basic_settings_submit");

    basicFormSubmit.addEventListener("click", function (e) {
        e.preventDefault();

        const formBasicData = new FormData(basixForm);
        formBasicData.append("action", "wscart_save_basic_settings");
        formBasicData.append("security", WSCartAdminAjax.nonce);

        fetch(WSCartAdminAjax.ajax_url, {
            method: "POST",
            credentials: 'same-origin',
            body: formBasicData,
        })
            .then((res) => res.json())
            .then((response) => {
                if (response.success) {
                    // alert(response.data.message);
                } else {
                    alert(response.data.message || "Something went wrong.");
                }
            })
            .catch((error) => {
                console.error("AJAX error:", error);
                alert("Error saving settings.");
            });
    });

    const basicResetBtn = document.getElementById("basic_settings_reset");
    const basicResetData = document.getElementById("sidecart_basic_settings_form");

    basicResetBtn.addEventListener("click", function (event) {

         event.preventDefault(); 

        if (!confirm("Are you sure you want to reset to default settings?")) return;

        const resetDataBasic = new FormData(basicResetData);
        resetDataBasic.append("action", "wscart_reset_basic_settings");
        resetDataBasic.append("security", WSCartAdminAjax.nonce);

        fetch(WSCartAdminAjax.ajax_url, {
            method: "POST",
            credentials: 'same-origin',
            body: resetDataBasic,
        })
            .then((res) => res.json())
            .then((response) => {
                if (response.success) {
                    // alert(response.data.message);
                    // location.reload(); 

                    document.getElementById('kartly_title').value = 'kartly_title';
                    document.getElementById('title_bg').value = '#002f49';
                    document.getElementById('title_color').value = '#f0e1b8';
                    document.getElementById('cart_close_color').value = '#002f49';
                    document.getElementById('cart_close_bg_color').value = '#f0e1b8';
                    document.getElementById('cart_body_border_radius').value = '5';
                    document.getElementById('cart_close_button_border_radius').value = '5';
                    
                    
                } else {
                    alert("Reset failed.");
                }
            })
            .catch((error) => {
                console.error("Reset error:", error);
                alert("Error resetting settings.");
            });
    });


// items setting update and reset 


    const form = document.getElementById("sidecart_settings_form");
    const formSubmit = document.getElementById("items_settings_submit");

    formSubmit.addEventListener("click", function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        formData.append("action", "wscart_save_settings");
        formData.append("security", WSCartAdminAjax.nonce);

        fetch(WSCartAdminAjax.ajax_url, {
            method: "POST",
            credentials: 'same-origin',
            body: formData,
        })
            .then((res) => res.json())
            .then((response) => {
                if (response.success) {
                    // alert(response.data.message);
                } else {
                    alert(response.data.message || "Something went wrong.");
                }
            })
            .catch((error) => {
                console.error("AJAX error:", error);
                alert("Error saving settings.");
            });
    });

    const resetBtn = document.getElementById("items_settings_reset");
    const formdatas = document.getElementById("sidecart_settings_form");

    resetBtn.addEventListener("click", function (event) {

         event.preventDefault(); 

        if (!confirm("Are you sure you want to reset to default settings?")) return;

        const resetData = new FormData(formdatas);
        resetData.append("action", "wscart_reset_settings");
        resetData.append("security", WSCartAdminAjax.nonce);

        fetch(WSCartAdminAjax.ajax_url, {
            method: "POST",
            credentials: 'same-origin',
            body: resetData,
        })
            .then((res) => res.json())
            .then((response) => {
                if (response.success) {
                    // alert(response.data.message);
                    // location.reload(); 
                    document.getElementById('item_delete_icon').value = '#f0e1b8';
                    document.getElementById('item_delete_bg').value = '#002f49';
                    document.getElementById('items_title_color').value = '#002f49';
                    document.getElementById('items_quantity_color').value = '#002f49';
                    document.getElementById('items_price_color').value = '#002f49';
                    document.getElementById('items_total_price_color').value = '#002f49';

                    document.getElementById('items_area_border_radius').value = 5;
                    document.getElementById('items_area_quantity_border_radius').value = 5;
                    document.getElementById('items_delete_button_border_radius').value = 5;
                } else {
                    alert("Reset failed.");
                }
            })
            .catch((error) => {
                console.error("Reset error:", error);
                alert("Error resetting settings.");
            });
    });



// Button settings update and reset 


    const buttonForm = document.getElementById("button_settings_form");
    const buttonFormSubmit = document.getElementById("button_settings_submit");

    buttonFormSubmit.addEventListener("click", function (e) {
        e.preventDefault();

        const buttonFormData = new FormData(buttonForm);
        buttonFormData.append("action", "wscart_save_button_settings");
        buttonFormData.append("security", WSCartAdminAjax.nonce);

        fetch(WSCartAdminAjax.ajax_url, {
            method: "POST",
            credentials: 'same-origin',
            body: buttonFormData,
        })
            .then((res) => res.json())
            .then((response) => {
                if (response.success) {
                    // alert(response.data.message);
                } else {
                    alert(response.data.message || "Something went wrong.");
                }
            })
            .catch((error) => {
                console.error("AJAX error:", error);
                alert("Error saving settings.");
            });
    });

    // const resetBtn = document.getElementById("button_settings_form");
    const buttonSettingsReset = document.getElementById("button_settings_reset");

    buttonSettingsReset.addEventListener("click", function (event) {

         event.preventDefault(); 

        if (!confirm("Are you sure you want to reset to default settings?")) return;

        const buttonReset = new FormData(buttonForm);
        buttonReset.append("action", "wscart_reset_button_settings");
        buttonReset.append("security", WSCartAdminAjax.nonce);

        fetch(WSCartAdminAjax.ajax_url, {
            method: "POST",
            credentials: 'same-origin',
            body: buttonReset,
        })
            .then((res) => res.json())
            .then((response) => {
                if (response.success) {
                    // alert(response.data.message);
                    // location.reload(); 
                   
                    document.getElementById('shopping_button_color').value = '#002f49';
                    document.getElementById('shopping_button_bg_color').value = '#f0e1b8';
                    document.getElementById('continue_shopping_button_border_radius').value = '5';

                    document.getElementById('view_cart_button_color').value = '#002f49';
                    document.getElementById('view_cart_button_bg_color').value = '#f0e1b8';
                    document.getElementById('view_cart_button_border_radius').value = '5';

                    document.getElementById('checkout_button_color').value = '#002f49';
                    document.getElementById('checkout_button_bg_color').value = '#f0e1b8';
                    document.getElementById('checkout_button_border_radius').value = '5';
                } else {
                    alert("Reset failed.");
                }
            })
            .catch((error) => {
                console.error("Reset error:", error);
                alert("Error resetting settings.");
            });
    });


});
