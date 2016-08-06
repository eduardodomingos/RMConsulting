<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rm_widgets_init() {

	// Homepage sections
	register_sidebar( array(
		'name'          => __( 'Homepage sections', 'rm' ),
		'id'            => 'rm-homepage-sections',
		'description'	=> '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_widget( 'Rm_Latest_News' );
	register_widget( 'Rm_About_Rm' );
	register_widget( 'Rm_Why_Rm' );
	register_widget( 'Rm_Courses' );
}

add_action( 'widgets_init', 'rm_widgets_init' );

class Rm_Latest_News extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'news', 'description' => __( 'Display the latest news', 'rm' ) );
		parent::__construct( 'news', __('Latest News','rm' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$latest_news = rm_get_latest_posts(get_field( 'latest_news_to_show', 'option' ), array('Why us')); // exclude posts under the why us category

		echo $args['before_widget'];

		$markup = '<section id="latest-news" class="latest-news band">';
		$markup.= '<div class="container">';
		$markup.= '<div class="slider">';
		echo $markup;

		while( $latest_news->have_posts() ) : $latest_news->the_post();
			get_template_part( 'template-parts/content', 'entry' );
		endwhile;

		wp_reset_postdata();

		$markup = '</div><!-- slider -->';
		$markup.= '</div><!-- container -->';
		$markup.= '</section><!-- latest-news -->';
		echo $markup;

		echo $args['after_widget'];
	}
}

class Rm_About_Rm extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'about-rm', 'description' => __( 'Display company info', 'rm' ) );
		parent::__construct( 'about-rm', __('About RM','rm' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		echo $args['before_widget'];

		$markup = '<section id="about-rm" class="about-rm band">';
		$markup.= '<div class="container">';
		$markup.= '<div class="tabs">';
		echo $markup;

		if( have_rows('about_rm') ) {
			$markup = '<ul>';
			$counter = 1;
			while ( have_rows('about_rm') ) {
				the_row();
				$markup.= '<li><a href="#tab-'. $counter .'">'. get_sub_field('title') .'</a></li>';
				$counter++;
			}
			$markup.='</ul>';
			echo $markup;

			$markup ='';
			$counter = 1;
			while ( have_rows('about_rm') ) {
				the_row();
				$markup.= '<div id="tab-'. $counter .'">'. get_sub_field('text') .'</div>';
				$counter++;
			}
			echo $markup;
		}

		$markup = '</div><!-- tabs -->';
		$markup.= '</div><!-- container -->';
		$markup.= '</section><!-- about -->';
		echo $markup;

		echo $args['after_widget'];
	}
}

class Rm_Why_Rm extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'why-rm', 'description' => __( 'Display the why RM info', 'rm' ) );
		parent::__construct( 'why-rm', __('Why RM','rm' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = $instance['title'];
		$subtitle = empty( $instance['subtitle'] ) ? '' : $instance['subtitle'];
		//$text = empty( $instance['text'] ) ? '' : $instance['text'];

		echo $args['before_widget'];

		$markup = '<section id="why-rm" class="why-rm band">';
		$markup.= '<div class="container">';
		$markup.= '<div class="row">';
		echo $markup;


		$markup = '<div class="col-sm-12">';
		$markup.= '<hgroup>';
		$markup.= '<h2 class="section-title">'. $title .'</h2>';
		$markup.= '<h3 class="section-subtitle">'. $subtitle .'</h3>';
		$markup.= '</hgroup>';
		//$markup.= '<p>'. $text . '</p>';
		$markup.= '</div><!-- col -->';
		echo $markup;

		$markup = '<div class="col-sm-12">';
		$markup.= '<div class="slider">';

		echo $markup;

		$posts = get_field('why_rm');

		if( $posts ){
			global $post;

			foreach( $posts as $post) {
				setup_postdata($post);

				get_template_part( 'template-parts/content', 'entry' );
			}

			wp_reset_postdata();
		}

		$markup = '</div><!-- slider -->';
		$markup.= '</div><!-- col -->';

		echo $markup;

		$markup = '</div><!-- row -->';
		$markup.= '</div><!-- container -->';
		$markup.= '</section><!-- about -->';
		echo $markup;




		echo $args['after_widget'];
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = !empty( $new_instance['title'] ) ? $new_instance['title'] : '';
		$instance['subtitle'] = !empty( $new_instance['subtitle'] ) ? $new_instance['subtitle'] : '';
		//$instance['text'] =  $new_instance['text'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'text' => '', 'title' => '', 'subtitle' => '') );

		$markup = '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'title' ) .'">'. esc_html( 'Title:', 'rm') .'</label>';
		$markup.= '<input class="widefat" id="'. $this->get_field_id( 'title' ) .'" name="'. $this->get_field_name( 'title' ) .'" type="text" value="'. esc_attr( $instance['title'] ) .'"  />';
		$markup.= '</p>';

		$markup.= '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'subtitle' ) .'">'. esc_html( 'Subtitle:', 'rm') .'</label>';
		$markup.= '<input class="widefat" id="'. $this->get_field_id( 'subtitle' ) .'" name="'. $this->get_field_name( 'subtitle' ) .'" type="text" value="'. esc_attr( $instance['subtitle'] ) .'"  />';
		$markup.= '</p>';

		/*$markup.= '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'description' ) .'">'. esc_html( 'Text:', 'rm') .'</label>';
		$markup.= '<textarea class="widefat" rows="10" cols="20" id="'. $this->get_field_id( 'text' ) .'" name="'. $this->get_field_name( 'text' ) .'">'. esc_textarea( $instance['text'] ) .'</textarea>';
		$markup.= '</p>';*/

		echo $markup;
	}
}

class Rm_Courses extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'courses', 'description' => __( 'Display the list of available courses', 'rm' ) );
		parent::__construct( 'courses', __('Courses','rm' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = $instance['title'];
		$subtitle = empty( $instance['subtitle'] ) ? '' : $instance['subtitle'];
		$text = empty( $instance['text'] ) ? '' : $instance['text'];

		echo $args['before_widget'];

		$markup = '<section id="courses" class="courses band">';
		$markup.= '<div class="container">';
		$markup.= '<div class="row">';
		echo $markup;

		$markup = '<div class="col-sm-12">';
		$markup.= '<hgroup>';
		$markup.= '<h2 class="section-title">'. $title .'</h2>';
		$markup.= '<h3 class="section-subtitle">'. $subtitle .'</h3>';
		$markup.= '</hgroup>';
		$markup.= '<p>'. $text . '</p>';
		$markup.= '</div><!-- col -->';
		echo $markup;


		$markup = '<div class="col-sm-12">';
		$markup.= '<div class="courses-portlet">';
		$markup.= '<div class="courses-portlet__head">';
		$markup.= '<p class="m-b-0">// Algumas das formações tradicionais são:</p>';
		$markup.= '</div><!-- courses-portlet__head -->';

		// check for rows (parent repeater)
		if( have_rows('courses') ) {
			$nb_courses = count( get_field('courses') );
			$courses_to_show = get_field( 'courses_to_show', 'option' );

			if($nb_courses > $courses_to_show) {
				$courses_counter = 0;
				$show_load_more = true;
			}

			$markup.= '<div class="courses-portlet__body">';
			$markup.= '<ul>';

			while ( have_rows('courses') ) {
				the_row();

				if(isset($courses_counter)) {
					$courses_counter++;
					if($courses_counter > $courses_to_show) {
						break;
					}
				}

				$markup.= '<span class="course-name"><strong>'. get_sub_field('name'). '</strong>';
				if(get_sub_field('description')) {
					$markup.= ' - '. get_sub_field('description');
				}
				$markup.= '</span>';

				// check for rows (sub repeater)
				if( have_rows('modules') ) {
					$markup.= '<ul id="accordion" role="tablist" aria-multiselectable="true">';
					$counter = 1;
					while ( have_rows('modules') ) {
						the_row();

						$markup.= '<li class="panel panel-default">';
						$markup.= '<div class="panel-heading" role="tab" id="heading'. $counter .'">';
						$markup.= '<a class="collapsed course-name" data-toggle="collapse" data-parent="#accordion" href="#collapse'. $counter .'" aria-expanded="true" aria-controls="collapse'. $counter .'">'. get_sub_field('name') .'</a>';
						$markup.= '</div>';
						$markup.= '<div id="collapse'. $counter .'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'. $counter .'">';
						$markup.= '<div>'. get_sub_field('description') .'</div>';
						$markup.= '</div><!-- collapse -->';
						$markup.= '</li><!-- panel -->';

						$counter++;
					}
					$markup.= '<ul>';
				}
			}

			$markup.='</ul>';
			$markup.='</div><!-- courses-portlet__body -->';

			if(isset($show_load_more) && $show_load_more) {
				$markup.='<div class="courses-portlet__foot text-xs-center">';
				$markup.='<button class="js-load-more"><span class="sr-only">Carregar mais</span><i class="icon-down-open-big"></i></button>';
				$markup.='</div><!-- courses-portlet__foot -->';
			}
		}
		
		$markup.= '</div><!--courses-portlet -->';
		$markup.= '</div><!-- col -->';
		echo $markup;

		$markup = '</div><!-- row -->';
		$markup.= '</div><!-- container -->';
		$markup.= '</section><!-- courses -->';
		echo $markup;

		echo $args['after_widget'];
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = !empty( $new_instance['title'] ) ? $new_instance['title'] : '';
		$instance['subtitle'] = !empty( $new_instance['subtitle'] ) ? $new_instance['subtitle'] : '';
		$instance['text'] =  $new_instance['text'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'text' => '', 'title' => '', 'subtitle' => '') );

		$markup = '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'title' ) .'">'. esc_html( 'Title:', 'rm') .'</label>';
		$markup.= '<input class="widefat" id="'. $this->get_field_id( 'title' ) .'" name="'. $this->get_field_name( 'title' ) .'" type="text" value="'. esc_attr( $instance['title'] ) .'"  />';
		$markup.= '</p>';

		$markup.= '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'subtitle' ) .'">'. esc_html( 'Subtitle:', 'rm') .'</label>';
		$markup.= '<input class="widefat" id="'. $this->get_field_id( 'subtitle' ) .'" name="'. $this->get_field_name( 'subtitle' ) .'" type="text" value="'. esc_attr( $instance['subtitle'] ) .'"  />';
		$markup.= '</p>';

		$markup.= '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'description' ) .'">'. esc_html( 'Text:', 'rm') .'</label>';
		$markup.= '<textarea class="widefat" rows="10" cols="20" id="'. $this->get_field_id( 'text' ) .'" name="'. $this->get_field_name( 'text' ) .'">'. esc_textarea( $instance['text'] ) .'</textarea>';
		$markup.= '</p>';

		echo $markup;
	}

}
