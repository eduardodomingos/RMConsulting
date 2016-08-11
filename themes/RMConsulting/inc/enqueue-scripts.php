<?php

/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'rm_scripts' ) ) :
	function rm_scripts() {
		wp_enqueue_style( 'rm-style', get_template_directory_uri() . '/assets/build/css/main.css' );

		wp_enqueue_script( 'gmap-api', 'http://maps.googleapis.com/maps/api/js?key='. get_field( 'gmaps_api_key', 'option' ) .'&amp;ver=4.1.12', array(), '', true );

		wp_enqueue_script( 'rm-js', get_template_directory_uri() . '/assets/build/js/main.js', array( 'jquery' ), '', true );
	}
endif;
add_action( 'wp_enqueue_scripts', 'rm_scripts' );
