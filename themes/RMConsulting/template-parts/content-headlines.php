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
		<div class="slider slider-nav">
			<?php
			if( have_rows('headlines') ):
				while ( have_rows('headlines') ) : the_row();
					$image_phone = get_sub_field('image_phone');
					$image_tablet = get_sub_field('image_tablet');
					$image_desktop = get_sub_field('image_desktop');
					?>
					<div class="slider-item">
						<picture>
							<source media="(min-width: 1024px)"
									srcset="<?php echo $image_desktop['url']; ?> 2000w"
									sizes="100vw" />
							<source media="(min-width: 480px)"
									srcset="<?php echo $image_tablet['url']; ?> 1024w"
									sizes="100vw" />
							<source srcset="<?php echo $image_phone['url']; ?> 480w"
									sizes="100vw" />
							<img src="<?php echo $image_phone['url']; ?>" alt="<?php echo $image_desktop['alt']; ?>" class="img-fluid">
						</picture>
					</div>
			<?php
				endwhile;
			endif; ?>
		</div><!-- slider-nav -->
	</div><!-- headlines__media -->

	<div class="slider slider-for">
		<?php
		if( have_rows('headlines') ):
			while ( have_rows('headlines') ) : the_row(); ?>
				<div class="slider-item">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">

								<?php if(get_sub_field('url')): ?>
								<a href="<?php the_sub_field('url'); ?>">
								<?php endif; ?>

									<?php if(get_sub_field('author')): ?>
										<blockquote class="blockquote">
											<p><?php the_sub_field('text'); ?></p>
											<footer class="blockquote-footer"><?php the_sub_field('author'); ?></footer>
										</blockquote>
									<?php else: ?>
										<p class="m-b-0"><?php the_sub_field('text'); ?></p>
									<?php endif; ?>

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
