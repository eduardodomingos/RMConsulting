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

			$category = get_the_category( get_the_ID() ); // this gets the category array of objects
			$cat_id = $category[0]->cat_ID;
			$cat_slug = $category[0]->slug;

			if($cat_slug === 'why-us') {
				get_template_part( 'template-parts/content', 'why-us' );
			}
			else {
				get_template_part( 'template-parts/content', get_post_format() );
				echo rm_share_buttons( esc_html__( 'Partilhe esta notícia', 'rm' ), get_permalink(), get_the_title() );
			}
		?>
		</div><!-- container -->




		<section class="latest-from-section band">
			<div class="container">
				<div class="slider">
					<?php

					if($cat_slug === 'why-us') {
						$query = rm_get_all_posts_by_category_id($cat_id);
					}
					else {
						$query = rm_get_latest_posts(get_field( 'latest_news_to_show', 'option' ), array('Why us')); // exclude posts under the why us category
					}

					while( $query->have_posts() ) : $query->the_post();
						get_template_part( 'template-parts/content', 'entry' );
					endwhile;

					wp_reset_postdata();

					?>
				</div><!-- slider -->
			</div><!-- container -->
		</section><!-- latest-from-section -->
		<?php
		endwhile; // End of the loop.
		?>
	</main>
</div><!-- band -->


<?php
get_footer();
