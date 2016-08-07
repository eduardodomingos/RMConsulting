<?php
/**
 * The homepage template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RM_Consulting
 */

get_header(); ?>

	<?php
	// Headlines
	get_template_part('template-parts/content', 'headlines');

	// Homepage widgets
	dynamic_sidebar('rm-homepage-sections');
	?>
<?php
get_footer();
