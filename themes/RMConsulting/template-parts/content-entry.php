<?php
/**
 * Template part for displaying posts entries.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RM_Consulting
 */

?>
<?php
	$main_image = get_field('main_image');
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>

	<? if( $main_image ) : ?>
	<a href="<?php echo esc_url( get_permalink() ) ?>">
		<img src="<?php echo $main_image['sizes']['medium'] ?>" alt="<?php echo $main_image['alt']; ?>" class="entry__media img-fluid">
	</a>
	<?php endif; ?>

	<div class="entry__body">
		<?php the_title( '<h2 class="entry__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<p class="entry__text"><?php echo get_the_excerpt(); ?></p>
		<hr>
		<?php rm_posted_on(); ?>
	</div><!-- entry__text -->
</article><!-- entry -->
