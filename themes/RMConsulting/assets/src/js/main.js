(function($) {

	$(window).load(function(){
		// Fade body in
		$('body.home').addClass('active');
	});


	$(document).ready(function(){
		/*
		 * Cache references for DOM elements
		 */
		var dom = {
			$window: 					$(window),
			$body:	 					$('body'),
			$menuToggle:				$('#js-menu-toggle'),
			//$menuToggleIcon:				$('#js-menu-toggle i'),
			$siteNav:					$('.site-nav'),
			$siteNavMenu:				$('.site-nav .menu'),
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
		dom.$menuToggle.click(function(e){
			var menuHeight = dom.$siteNavMenu.outerHeight();
			if(dom.$body.hasClass('nav-open')){
				// nav is open, close it
				dom.$siteNav.removeAttr('style');
				dom.$body.removeClass('nav-open');

			} else {
				// nav is closed, open it
				dom.$siteNav.css('max-height', menuHeight);
				dom.$body.addClass('nav-open');
			}
		});

		/*
		 * Homepage Code
		 */
		if(dom.$body.hasClass('home')) {

			/*
			 * Smooth scroll
			 */
			dom.$siteNavMenu.find('a').attr('data-scroll', true);
			smoothScroll.init();
			if ( window.location.hash ) {
				var hash = smoothScroll.escapeCharacters( window.location.hash ); // Escape the hash
				var toggle = document.querySelector( 'a[href*="' + hash + '"]' ); // Get the toggle (if one exists)
				var options = {
					speed: 1000,
				}; // Any custom options you want to use would go here
				smoothScroll.animateScroll( hash, toggle, options );
			}

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
				asNavFor: '.headlines .slider-for',
				responsive: [
					{
						breakpoint: 1023,
						settings: {
							arrows: true
						}
					}
				]
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
				responsive: [
					{
						breakpoint: 740,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					}
				]
			});

			// On window resize:
			$(window).resize(function(event){
				$('.latest-news .slider').trigger('afterChange');
			});


			// Load more courses
			$('.courses .js-load-more').click(function(e) {
				e.preventDefault();
				var step = $(".courses-list").data('step');
				$(".courses-list>li:not('.off'):last")
					.nextAll('.off:lt('+ step +')')
					.removeClass('off').addClass('on');

				// If all visible hide button
				if($('.courses-list > li.off').length === 0) {
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

			/*
			 * Article share buttons
			 */
			//if( dom.$body.hasClass('single-post') || dom.$body.hasClass('single-service') ) {
				var $share = $('.share-this'); // cache share
				if ( $share.length ) {

					// Facebook
					$share.find('.link-share-facebook').on('click', function(e){
						e.preventDefault();
						window.open( $(this).attr('href'), 'sharer', 'toolbar=0,status=0,width=548,height=325');
					});

					// Twitter Share
					$share.find('.link-share-twitter').on('click', function(e){
						e.preventDefault();
						window.open( $(this).attr('href'), 'twitter', 'toolbar=0,status=0,width=548,height=325');
					});

					// Share Google Plus
					$share.find('.link-share-gplus').on('click', function(e){
						e.preventDefault();
						window.open( $(this).attr('href'), 'gplus', 'toolbar=0,status=0,width=548,height=325');
					});

					// Share LinkedIn
					$share.find('.link-share-in').on('click', function(e){
						e.preventDefault();
						window.open( $(this).attr('href'), 'LinkedIn','toolbar=0,status=0,width=520,height=570');
					});

				}
			//}


			dom.$window.load(function(){
				// Latest News slider
				$('.latest-from-section .slider').slick({
					mobileFirst: true,
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

			// On window resize:
			$(window).resize(function(event){
				$('.latest-from-section .slider').trigger('afterChange');
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

		//map.panBy(-300, 0);

		var mapMarker = new google.maps.Marker({
			position: mapOptions.center,
			map: map,
			icon: 'wp-content/themes/RMConsulting/assets/build/img/rm-map-marker.png'
		});

		google.maps.event.addDomListener(window, 'resize', function() {
			map.setCenter(mapOptions.center);
			//map.panBy(-300, 0);
		});
	}


}(jQuery));
