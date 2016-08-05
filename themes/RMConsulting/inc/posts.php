<?php
/**
 * Returns the URL of the post 16:9 featured image
 *
 * @package Eduardo Domingos
 * @since 0.1.0
 * @author Eduardo Domingos
 * @param $post_id
 *
 * @return photo url
 *
 */
function rm_get_latest_posts($nb_posts) {
	$args = [
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $nb_posts,
		'orderby' => 'date',
	];

	return new WP_Query($args);
}
