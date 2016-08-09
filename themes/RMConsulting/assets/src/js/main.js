(function($) {

	$(document).ready(function(){
		/*
		 * Cache references for DOM elements
		 */
		var dom = {
			$window: 					$(window),
			$body:	 					$('body'),
			$menuToggle:				$('#js-menu-toggle'),
			//$menuToggleIcon:				$('#js-menu-toggle i'),
			//$siteNav:					$('.site-nav'),
			//$siteNavList:				$('.site-nav .menu'),
		};




		/*
		 * All pages Code
		 */
		// Scroll to top
		$('a[href="#top"]').click(function() {
			$("html, body").animate({ scrollTop: 0 }, 1000);
			return false;
		});

		// Toggle mobile menu
		// var menuHeight = dom.$siteNavList.outerHeight();
		// dom.$menuToggle.click(function(e){
		// 	if(dom.$siteNav.hasClass('active')) {
		// 		dom.$siteNav.css('max-height', 0);
		// 		dom.$menuToggleIcon.removeClass('icon-cancel').addClass('icon-menu');
		// 		dom.$siteNav.removeClass('active');
		// 	} else {
		// 		dom.$siteNav.css('max-height', menuHeight);
		// 		dom.$menuToggleIcon.removeClass('icon-menu').addClass('icon-cancel');
		// 		dom.$siteNav.addClass('active');
		// 	}
		// });


		// On window resize:
		// $(window).resize(function(event){
		// 	if( window.matchMedia('(min-width: 1024px)').matches ) {
		// 		if(dom.$siteNav.hasClass('active')) {
		// 			dom.$menuToggleIcon.removeClass('icon-cancel').addClass('icon-menu');
		// 			dom.$siteNav.removeClass('active');
		// 		}
        //
		// 		dom.$siteNav.removeAttr('style').removeClass('active');
		// 	}
		// });

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

			$('#about-rm .tabs').responsiveTabs({
				startCollapsed: 'accordion',
				animation: 'slide',
				duration: 200
			});

			// What we do slider
			$('.why-rm .slider').slick({
				mobileFirst: true,
				variableWidth: true,
			});

			// Load more courses
			$('.courses .js-load-more').click(function(e) {
				e.preventDefault();
				var step = $(".courses-list").data('step');
				$(".courses-list>li:not('.hidden'):last")
					.nextAll('.hidden:lt('+ step +')')
					.removeClass('hidden');

				// If all visible hide button
				if($('.courses-list > li.hidden').length === 0) {
					$(this).hide();
				}
			});

			// Google Map
			googleMap();

			dom.$window.load(function(){
				// Latest News slider
				$('.latest-news .slider').slick({
					mobileFirst: true,
					variableWidth: true,
					slidesToShow: 1,
					responsive: [
						{
							breakpoint: 479,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1
							}
						}
					]
				}).on('afterChange', function(event){
					fixVerticalArrows(event);
				}).trigger('afterChange');
			});
		}

		/*
		 * Single page Code
		 */
		if(dom.$body.hasClass('single')) {

			dom.$window.load(function(){
				// Latest News slider
				$('.latest-from-section .slider').slick({
					mobileFirst: true
				}).on('afterChange', function(event){
					fixVerticalArrows(event);
				}).trigger('afterChange');
			});
		}
	});

	function fixVerticalArrows(event){
		var h =  $(event.target).find('.slick-active img').height()/2;
		if( h ) {
			$(event.target).find('.slick-arrow').css('top',h+'px');
		}
	}

	function googleMap() {
		styles = [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}];

		var mapOptions = {
			center: new google.maps.LatLng(coords.lat, coords.long), // coords object is echoed by the contact widget
			disableDefaultUI: true,
			zoom: 17,
			scrollwheel: false,
			draggable: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles: styles
		};

		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		var mapMarker = new google.maps.Marker({
			position: mapOptions.center,
			map: map,
			icon: '/wp-content/themes/RMConsulting/assets/build/img/rm-map-marker.png'
		});

	}


}(jQuery));
