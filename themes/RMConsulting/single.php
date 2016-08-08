<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package RM_Consulting
 */

get_header(); ?>

<div class="band band--primary">
	<main role="main">
		<div class="container">
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			echo rm_share_buttons( esc_html__( 'Partilhe esta notícia', 'rm' ), get_permalink(), get_the_title() );

			$latest_news = rm_get_latest_posts(get_field( 'latest_news_to_show', 'option' ), array('Why us')); // exclude posts under the why us category

		?>
		</div><!-- container -->
		<section class="latest-news band">
			<div class="slider">
				<?php
				while( $latest_news->have_posts() ) : $latest_news->the_post();
					get_template_part( 'template-parts/content', 'entry' );
				endwhile;

				wp_reset_postdata();
				?>
			</div><!-- slider -->
		</section><!-- latest-news -->
		<?php
		endwhile; // End of the loop.
		?>
	</main>
</div><!-- band -->


<?php
get_footer();
