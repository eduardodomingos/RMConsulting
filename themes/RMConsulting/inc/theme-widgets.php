<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rm_widgets_init() {
	/*register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'rm' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'rm' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );*/



	// Homepage sections
	register_sidebar( array(
		'name'          => __( 'Homepage sections', 'rm' ),
		'id'            => 'rm-homepage-sections',
		'description'	=> '',
		'before_widget' => '<section id="%2$s" class="band section"><div class="container"><div class="row">',
		'after_widget'  => '</div><!-- row --></div><!-- container --></section><!-- section -->',
		'before_title'  => '',
		'after_title'   => '',
	) );


	register_widget( 'Rm_Latest_News' );
}

add_action( 'widgets_init', 'rm_widgets_init' );

class Rm_Latest_News extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'news', 'description' => __( 'Display the latest news', 'dynamic' ) );
		parent::__construct( 'news', __('Latest News','rm' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$latest_news = rm_get_latest_posts(get_field( 'latest_news_to_show', 'option' ));

		echo $args['before_widget'];

		while( $latest_news->have_posts() ) : $latest_news->the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		endwhile;

		wp_reset_postdata();

		echo $args['after_widget'];
	}
}
