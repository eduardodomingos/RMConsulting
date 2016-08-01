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
			console.log('x');

			// Headlines slider
			$('.headlines .slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.slider-nav'
			});

			$('.headlines .slider-nav').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				asNavFor: '.slider-for',
			});
		}
	});


}(jQuery));
