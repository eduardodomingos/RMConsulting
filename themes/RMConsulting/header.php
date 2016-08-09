<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RM_Consulting
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="page-head" role="banner">
	<div class="container">
		<button id="js-menu-toggle" class="menu-toggle"><i class="icon-menu"><span class="sr-only">Menu</span></i></button>

		<nav class="site-nav container-until-lg">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container'=> false, 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- site-nav -->

		<nav class="socials">
			<?php wp_nav_menu( array( 'theme_location' => 'social_header', 'container'=> false, 'menu_id' => 'socials-menu-header', 'link_before' => '<span class="sr-only">', 'link_after' => '</span>' ) ); ?>
		</nav><!-- socials -->

	</div><!-- container -->
</header><!-- page-head -->
