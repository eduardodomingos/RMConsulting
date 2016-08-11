<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package RM_Consulting
 */

get_header(); ?>

<?php
	$category = get_the_category( get_the_ID() ); // this gets the category array of objects
	$cat_id = $category[0]->cat_ID;
	$cat_slug = $category[0]->slug;
?>

<div class="band band--primary">
	<main role="main">


		<div class="container <?php echo ($cat_slug === 'why-us') ? '': 'master-wrapper'; ?>">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-lg-12 col-lg-offset-0">
		<?php
		while ( have_posts() ) : the_post();



			if($cat_slug === 'why-us') {
				get_template_part( 'template-parts/content', 'why-us' );
			}
			else {
				get_template_part( 'template-parts/content', get_post_format() );
				if($cat_slug !== 'legal') {
					echo rm_share_buttons( esc_html__( 'Partilhe esta notícia', 'rm' ), get_permalink(), get_the_title() );
				}
			}
		?>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container -->

		<?php if($cat_slug !== 'legal') : ?>

			<section class="latest-from-section band">
				<div class="container master-wrapper">
					<div class="row">
						<div class="col-xs-10 col-xs-offset-1 col-lg-12 col-lg-offset-0">
					<div class="slider arrows-out">
						<?php

						if($cat_slug === 'why-us') {
							$query = rm_get_all_posts_by_category_id($cat_id);
						}
						else {
							$query = rm_get_latest_posts(get_field( 'latest_news_to_show', 'option' ), array('Why us', 'Legal')); // exclude posts under the why us category
						}

						while( $query->have_posts() ) : $query->the_post();
							get_template_part( 'template-parts/content', 'entry' );
						endwhile;

						wp_reset_postdata();

						?>
					</div><!-- slider -->
						</div><!-- col -->
					</div><!-- row -->
				</div><!-- container -->
			</section><!-- latest-from-section -->

		<?php endif;?>

		<?php
		endwhile; // End of the loop.
		?>
	</main>
</div><!-- band -->


<?php
get_footer();
