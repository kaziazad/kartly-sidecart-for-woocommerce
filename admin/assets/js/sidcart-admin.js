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