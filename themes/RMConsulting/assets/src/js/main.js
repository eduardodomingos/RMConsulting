(function($) {

	$(document).ready(function(){
		/*
		 * Cache references for DOM elements
		 */
		var dom = {
			$window: 					$(window),
			$body:	 					$('body')
		};


		/*
		 * Homepage Code
		 */
		if(dom.$body.hasClass('home')) {

			// Headlines slider
			$('.headlines .slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.headlines .slider-nav'
			});

			$('.headlines .slider-nav').slick({
				mobileFirst: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				asNavFor: '.headlines .slider-for'
			});

			// Latest News slider
			$('.latest-news').slick({
				mobileFirst: true
			});
		}
	});


}(jQuery));
