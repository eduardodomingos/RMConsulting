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
?>
<?php

$body_class = '';
if( is_home() || is_front_page() ){
	$body_class = 'page--home';
}
elseif(is_singular('post')) {
	$category = get_the_category( get_the_ID() );
	$cat_id = $category[0]->cat_ID;
	$cat_slug = $category[0]->slug;

	if($cat_slug === 'why-us') {
		$body_class = 'page--what-we-do';
	}
	elseif($cat_slug === 'legal') {
		$body_class = 'page--legal';
	}
	else {
		$body_class = 'page--news';
	}
}

?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class($body_class); ?>>

<header class="page-head" role="banner">
	<div class="container clearfix">
		<button id="js-menu-toggle" class="menu-toggle"><span class="sr-only">Menu</span></button>

		<div class="pull-lg-right">
			<nav class="site-nav">
				<div class="container-until-lg">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container'=> false, 'menu_id' => 'primary-menu' ) ); ?>
				</div><!-- container-until-lg -->
			</nav><!-- site-nav -->

			<nav class="socials">
				<?php wp_nav_menu( array( 'theme_location' => 'social_header', 'container'=> false, 'menu_id' => 'socials-menu-header', 'link_before' => '<span class="sr-only">', 'link_after' => '</span>' ) ); ?>
			</nav><!-- socials -->
		</div>

	</div><!-- container -->
</header><!-- page-head -->
