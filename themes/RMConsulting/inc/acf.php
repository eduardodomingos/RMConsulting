<?php
if ( function_exists( 'acf_add_options_page' ) ) {

	/*acf_add_options_page(array(
		'page_title'		=> 'Theme Options',
		'menu_title'		=> 'Theme Options',
		'menu_slug'			=> 'theme-options',
		'capability'		=> 'edit_posts',
		'parent_slug'		=> '',
		'position'			=> false,
		'icon_url'			=> false,
	));*/

	acf_add_options_sub_page(array(
		'page_title'		=> 'Homepage Settings',
		'menu_title'		=> 'Homepage Settings',
		'menu_slug'			=> 'homepage-settings',
		'capability'		=> 'edit_posts',
		'parent_slug'		=> 'edit.php?post_type=page',
		'position'			=> false,
		'icon_url'			=> false,
	));

}
