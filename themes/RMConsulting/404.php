<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package RM_Consulting
 */

get_header(); ?>



	<h1 class="logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php bloginfo('template_directory');?>/assets/build/img/rm_logo.svg" alt="<?php bloginfo( 'name' ); ?>">
				<span class="sr-only"><?php bloginfo( 'name' ); ?>/span>
		</a>
	</h1>

	<!-- PRIMARY SECTION
        ========================================================= -->
	<div class="band">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-xs-center lead">
					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'dw' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go back home', 'dw' ); ?></a>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container -->
	</div><!-- band--primary -->


<?php

get_footer();
