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
    const form = document.getElementById("sidecart_settings_form");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        formData.append("action", "wscart_save_settings");
        formData.append("security", WSCartAdminAjax.nonce);

        fetch(WSCartAdminAjax.ajax_url, {
            method: "POST",
            body: formData,
        })
            .then((res) => res.json())
            .then((response) => {
                if (response.success) {
                    alert(response.data.message);
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

    resetBtn.addEventListener("click", function () {
        if (!confirm("Are you sure you want to reset to default settings?")) return;

        const resetData = new FormData();
        resetData.append("action", "wscart_reset_settings");
        resetData.append("security", WSCartAdminAjax.nonce);

        fetch(WSCartAdminAjax.ajax_url, {
            method: "POST",
            body: resetData,
        })
            .then((res) => res.json())
            .then((response) => {
                if (response.success) {
                    alert(response.data.message);
                    location.reload();
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
