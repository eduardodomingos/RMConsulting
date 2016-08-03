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
			// $('.courses .js-load-more').click(function() {
            //
			// 	var html = '<div class="panel panel-default">';
			// 	html+= '<div class="panel-heading" role="tab" id="headingOne">';
			// 	html+= '<h4 class="panel-title">';
			// 	html+= '<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">SMED - Optimização dos Tempos de Preparação</a>';
			// 	html+= '</h4>';
			// 	html+= '</div>';
			// 	html+= '<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">';
			// 	html+= 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute.';
			// 	html+= '</div>';
			// 	html+= '</div>';
			//
			// 	$('.courses #accordion').append(html);
            //
			// });


			// Google Map
			googleMap();


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

	function googleMap() {
		styles = [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}];

		var mapOptions = {
			center: new google.maps.LatLng(40.63971, -8.655896),
			center: new google.maps.LatLng(40.63971, -8.655896),
			disableDefaultUI: true,
			zoom: 17,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles: styles
		}

		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	}


}(jQuery));
