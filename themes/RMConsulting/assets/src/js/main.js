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

			$('#about .tabs').responsiveTabs({
				startCollapsed: 'accordion'
			});

			// What we do slider
			$('.what-we-do .slider').slick({
				mobileFirst: true
			});


			dom.$window.load(function(){
				// Latest News slider
				$('.latest-news .slider').slick({
					mobileFirst: true
				}).on('afterChange',function(event){
					fixVerticalArrows(event);
				}).trigger('afterChange');
			});
		}
	});

	function fixVerticalArrows(event){
		var h =  $(event.target).find('.slick-active img').height()/2;
		console.log($(event.target).find('.slick-active img').height());
		$(event.target).find('.slick-arrow').css('top',h+'px');
	}


}(jQuery));
