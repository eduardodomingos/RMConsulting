<?php

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function rm_custom_excerpt_length() {
	return get_field( 'excerpt_length', 'option' );
}
add_filter( 'excerpt_length', 'rm_custom_excerpt_length', 999 );






/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function rm_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'rm_excerpt_more' );

