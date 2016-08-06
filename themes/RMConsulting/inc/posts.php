<?php
/**
 * Returns the most recent posts
 *
 * @package Eduardo Domingos
 * @since 0.1.0
 * @author Eduardo Domingos
 * @param $nb_posts
 * @param $excluded_cats
 *
 * @return object
 *
 */
function rm_get_latest_posts($nb_posts, $excluded_cats = array()) {

	$excluded_cats_ids = array();

	foreach ($excluded_cats as $cat) {
		array_push($excluded_cats_ids, get_cat_ID($cat));
	}

	$args = [
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $nb_posts,
		'category__not_in' => $excluded_cats_ids,
		'orderby' => 'date',
	];

	return new WP_Query($args);
}
