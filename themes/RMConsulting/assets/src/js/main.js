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

			// Accordion load more
			$('.courses .js-load-more').click(function() {

				var html = '<div class="panel panel-default">';
				html+= '<div class="panel-heading" role="tab" id="headingOne">';
				html+= '<h4 class="panel-title">';
				html+= '<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">SMED - Optimização dos Tempos de Preparação</a>';
				html+= '</h4>';
				html+= '</div>';
				html+= '<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">';
				html+= 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute.';
				html+= '</div>';
				html+= '</div>';
				
				$('.courses #accordion').append(html);

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
