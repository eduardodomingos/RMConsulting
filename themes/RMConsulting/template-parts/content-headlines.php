<?php
/**
 * Template part for displaying headlines.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RM_Consulting
 */

?>

<section id="headlines" class="headlines">
	<div class="headlines__media">
		<h1 class="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php bloginfo('template_directory');?>/assets/build/img/rm_logo.svg" alt="<?php bloginfo( 'name' ); ?>">
				<span class="sr-only"><?php bloginfo( 'name' ); ?>/span>
			</a>
		</h1>
		<div class="slider-nav">
			<?php
			if( have_rows('headlines') ):
				while ( have_rows('headlines') ) : the_row(); ?>
					<div>
						<picture>
							<source media="(min-width: 1024px)"
									srcset="<?php the_sub_field('image_desktop'); ?> 1024w"
									sizes="100vw" />
							<source media="(min-width: 480px)"
									srcset="<?php the_sub_field('image_tablet'); ?> 480w"
									sizes="100vw" />
							<source srcset="<?php the_sub_field('image_phone'); ?> 320w"
									sizes="100vw" />
							<img src="<?php the_sub_field('image_phone'); ?>" alt="" class="img-fluid">
						</picture>
					</div>
			<?php
				endwhile;
			endif; ?>
		</div><!-- slider-nav -->
	</div><!-- headlines__media -->

	<div class="slider-for">
		<?php
		if( have_rows('headlines') ):
			while ( have_rows('headlines') ) : the_row(); ?>
				<div>
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<?php if(get_sub_field('url')): ?>
								<a href="<?php the_sub_field('url'); ?>">
								<?php endif; ?>
									
									<?php the_sub_field('text'); ?>

								<?php if(get_sub_field('url')): ?>
								</a>
								<?php endif; ?>
							</div><!-- col -->
						</div><!-- row -->
					</div><!-- container -->
				</div>
			<?php
		endwhile;
		endif; ?>
	</div><!-- slider-for -->

</section><!-- headlines -->
