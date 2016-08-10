<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RM_Consulting
 */

?>

<?php
$main_image = get_field('main_image');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<header class="post__header">
		<?php if ( 'post' === get_post_type() ) : ?>
		<p class="post__category"><?php echo esc_html__( 'Notícias', 'rm' ); ?></p>
		<?php
		endif; ?>

		<? if( $main_image ) : ?>
			<img src="<?php echo $main_image['sizes']['large'] ?>" alt="<?php echo $main_image['alt']; ?>" class="post__media img-fluid">
		<?php endif; ?>


		<?php
		if ( is_single() ) :
			the_title( '<h1 class="post__title">', '</h1>' );
		else :
			the_title( '<h2 class="post__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="post__meta">
			<?php rm_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="post__content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'rm' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="post__footer">
		<?php rm_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
