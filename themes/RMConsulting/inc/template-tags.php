<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package RM_Consulting
 */

if ( ! function_exists( 'rm_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function rm_posted_on() {
	$time_string = '<time datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date('d/m/Y') )
	);

	$posted_on = sprintf(
		esc_html_x( '%1$sPosted on%2$s %3$s', 'post date', 'rm' ),
		'<span class="sr-only">',
		'</span>',
		$time_string
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'rm_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function rm_entry_footer() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'rm' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function rm_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'rm_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'rm_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so rm_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so rm_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in rm_categorized_blog.
 */
function rm_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'rm_categories' );
}
add_action( 'edit_category', 'rm_category_transient_flusher' );
add_action( 'save_post',     'rm_category_transient_flusher' );



/**
 * Builds the share buttons acrross different articles / pages
 * @param string $label     What appears before the button
 * @param string $title     Normally the page title
 * @param string $description   Normally the page description
 * @param string $classes       CSS classes to add on the wrapper
 * @return string (html)
 */
function rm_share_buttons( $label = 'Share', $url = '', $title = '', $description = '', $classes = '' ) {
	$url = urlencode(html_entity_decode( $url, ENT_COMPAT, 'UTF-8') );
	$title = rawurlencode(html_entity_decode( $title, ENT_COMPAT, 'UTF-8') );
	$description = urlencode(html_entity_decode( $description, ENT_COMPAT, 'UTF-8') );
	$html = '<div class="share-this ' . $classes . '">';
	if ( $label != '' ) {
		$html .= '<p class="share-this__label">' . $label . ': </p>';
	}
	$html .= '<a title="'. esc_html__( 'Share on', 'dw' ) .' Facebook" href="https://www.facebook.com/sharer/sharer.php?t=' . $title . '&u=' . $url . '" class="share-this__link link-share-facebook"><span class="icon-facebook"></span></a>';
	$html .= '<a title="'. esc_html__( 'Share on', 'dw' ) .' LinkedIn" href="http://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . '" class="share-this__link link-share-in"><span class="icon-linkedin"></span></a>';
	$html .= '<a title="'. esc_html__( 'Share on', 'dw' ) .' Twitter" href="https://twitter.com/intent/tweet?original_referer=' . $url . '&text=' . $title . ': ' . $url . '&via=rmconsulting" class="share-this__link link-share-twitter"><span class="icon-twitter"></span></a>';
	$html .= '<a title="'. esc_html__( 'Share on', 'dw' ) .' Google+" href="https://plus.google.com/share?url=' . $url . '" class="share-this__link link-share-gplus"><span class="icon-gplus"></span></a>';
	$html .= '</div>';
	return $html;
}
