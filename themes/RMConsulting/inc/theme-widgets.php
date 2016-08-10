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
	register_widget( 'Rm_Download' );
	register_widget( 'Rm_Text_Banner' );
	register_widget( 'Rm_Contacts' );
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
		$markup.= '<div class="slider-wrapper">';

		$markup.= '<div class="slider arrows-out">';
		echo $markup;

		while( $latest_news->have_posts() ) : $latest_news->the_post();
			get_template_part( 'template-parts/content', 'entry' );
		endwhile;

		wp_reset_postdata();

		$markup = '</div><!-- slider -->';
		$markup.= '</div><!-- slider-wrapper -->';
		$markup.= '</div><!-- container -->';
		$markup.= '</section><!-- latest-news -->';
		echo $markup;

		echo $args['after_widget'];
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
		$markup.= '<div class="row">';
		$markup.= '<div class="col-lg-12">';
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
		$markup.= '</div><!-- row -->';
		$markup.= '</div><!-- col -->';
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


		$markup = '<div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-6 col-lg-offset-0">';
		$markup.= '<hgroup>';
		$markup.= '<h2 class="section-title">'. $title .'</h2>';
		$markup.= '<h3 class="section-subtitle">'. $subtitle .'</h3>';
		$markup.= '</hgroup>';
		//$markup.= '<p>'. $text . '</p>';
		$markup.= '</div><!-- col -->';
		echo $markup;

		$markup = '<div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-6 col-lg-offset-0">';
		$markup.= '<div class="slider-wrapper">';
		$markup.= '<div class="slider arrows-out">';

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
		$markup = '</div><!-- slider-wrapper -->';
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




		$markup = '<div class="col-lg-6">';
		$markup.= '<hgroup>';
		$markup.= '<h2 class="section-title">'. $title .'</h2>';
		$markup.= '<h3 class="section-subtitle">'. $subtitle .'</h3>';
		$markup.= '</hgroup>';
		$markup.= '<p>'. $text . '</p>';
		$markup.= '</div><!-- col -->';
		echo $markup;


		$markup = '<div class="col-lg-5 pull-lg-right">';
		$markup.= '<div class="courses-portlet">';
		$markup.= '<div class="courses-portlet__head">';
		$markup.= '<p class="m-b-0">// Algumas das formações tradicionais são:</p>';
		$markup.= '</div><!-- courses-portlet__head -->';
		echo $markup;

		// check for rows (parent repeater)
		if( have_rows('courses') ) {
			$nb_courses = count( get_field('courses') );
			$courses_to_show = get_field( 'courses_to_show', 'option' );
			if($nb_courses > $courses_to_show) {
				$courses_counter = 0;
				$show_load_more = true;
			}

			$markup = '<div class="courses-portlet__body">';
			$markup.= '<ul class="courses-list" data-step="'. $courses_to_show .'">';
			echo $markup;

			while ( have_rows('courses') ) {
				the_row();

				if(isset($courses_counter)) {
					$courses_counter++;
				}

				$markup = '<li '. (($courses_counter > $courses_to_show) ? 'class="off"' : '') .'><span class="course-name"><strong>'. get_sub_field('name'). '</strong>';
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
						$markup.= '<a class="collapsed course-name" data-toggle="collapse" data-parent="#accordion" href="#collapse'. $counter .'" aria-expanded="true" aria-controls="collapse'. $counter .'"><strong>'. get_sub_field('name') .'</strong></a>';
						$markup.= '</div>';
						$markup.= '<div id="collapse'. $counter .'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'. $counter .'">';
						$markup.= '<div>'. get_sub_field('description') .'</div>';
						$markup.= '</div><!-- collapse -->';
						$markup.= '</li><!-- panel -->';

						$counter++;
					}
					$markup.= '</ul>';
				}
				$markup.= '</li>';

				echo $markup;
			}

			$markup = '</ul>';
			$markup.='</div><!-- courses-portlet__body -->';

			if(isset($show_load_more) && $show_load_more) {
				$markup.='<div class="courses-portlet__foot text-xs-center">';
				$markup.='<button class="js-load-more floating-arrow"><span class="sr-only">Carregar mais</span><i class="icon-down-open-big"></i></button>';
				$markup.='</div><!-- courses-portlet__foot -->';
			}
			echo $markup;
		}

		$markup = '</div><!--courses-portlet -->';


		$markup.= '</div><!-- col -->';
		$markup.= '</div><!-- row -->';
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

class Rm_Download extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'download', 'description' => __( 'Display the download section', 'rm' ) );
		parent::__construct( 'download', __('Download','rm' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$text = empty( $instance['text'] ) ? '' : $instance['text'];
		$download_url = empty( $instance['download_url'] ) ? '' : $instance['download_url'];

		echo $args['before_widget'];

		$markup = '<section id="download" class="download band">';
		$markup.= '<div class="container">';
		$markup.= '<div class="row">';
		$markup.= '<div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-4 col-lg-offset-4">';

		$markup .= do_shortcode('[easy_media_download url="'. $download_url .'" text="<span>Download</span>" color="rm"]');

		$markup.= '<p class="m-b-0">'. $text .'</p>';

		$markup.= '</div><!-- col -->';
		$markup.= '</div><!-- row -->';
		$markup.= '</div><!-- container -->';
		$markup.= '</section><!-- download -->';



		echo $markup;

		echo $args['after_widget'];
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['text'] =  $new_instance['text'];
		$instance['download_url'] =  $new_instance['download_url'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'text' => '') );

		$markup = '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'description' ) .'">'. esc_html( 'Text:', 'rm') .'</label>';
		$markup.= '<textarea class="widefat" rows="10" cols="20" id="'. $this->get_field_id( 'text' ) .'" name="'. $this->get_field_name( 'text' ) .'">'. esc_textarea( $instance['text'] ) .'</textarea>';
		$markup.= '</p>';


		$markup.= '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'download_url' ) .'">'. esc_html( 'Download URL:', 'rm') .'</label>';
		$markup.= '<input class="widefat" id="'. $this->get_field_id( 'download_url' ) .'" name="'. $this->get_field_name( 'download_url' ) .'" type="text" value="'. esc_attr( $instance['download_url'] ) .'"  />';
		$markup.= '</p>';

		echo $markup;
	}
}

class Rm_Text_Banner extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'text-banner', 'description' => __( 'Display the banner text', 'rm' ) );
		parent::__construct( 'text-banner', __('Text banner','rm' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = $instance['title'];
		$subtitle = empty( $instance['subtitle'] ) ? '' : $instance['subtitle'];
		$text = empty( $instance['text'] ) ? '' : $instance['text'];

		echo $args['before_widget'];

		$markup = '<section class="text-banner band">';
		$markup.= '<div class="container">';
		$markup.= '<div class="row">';
		$markup.= '<div class="col-xs-12">';
		$markup.= '<hgroup>';
		$markup.= '<h2 class="section-title m-b-0">'. $title .'</h2>';
		$markup.= '<h3 class="section-subtitle">'. $subtitle .'</h3>';
		$markup.= '</hgroup>';
		$markup.= '<p class="m-b-0">'. $text . '</p>';
		$markup.= '</div><!-- col -->';

		$markup.= '</div><!-- row -->';
		$markup.= '</div><!-- container -->';
		$markup.= '</section><!-- text-banner -->';
		echo $markup;

		echo $args['after_widget'];
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = !empty( $new_instance['title'] ) ? $new_instance['title'] : '';
		$instance['subtitle'] = !empty( $new_instance['subtitle'] ) ? $new_instance['subtitle'] : '';
		$instance['text'] = !empty( $new_instance['text'] ) ? $new_instance['text'] : '';

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

class Rm_Contacts extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'contact', 'description' => __( 'Display the contacts', 'rm' ) );
		parent::__construct( 'contact', __('Contact','rm' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}


		$title = empty( $instance['title'] ) ? '' : $instance['title'];
		$subtitle = empty( $instance['subtitle'] ) ? '' : $instance['subtitle'];
		$address = empty( $instance['address'] ) ? '' : $instance['address'];
		$phone = empty( $instance['phone'] ) ? '' : $instance['phone'];
		$email = empty( $instance['email'] ) ? '' : $instance['email'];
		$latitude = empty( $instance['latitude'] ) ? '' : $instance['latitude'];
		$longitude= empty( $instance['longitude'] ) ? '' : $instance['longitude'];

		echo $args['before_widget'];

		$markup = '<section id="contact" class="contact">';
		$markup.= '<div class="container">';
		$markup.= '<div class="row">';
		$markup.= '<div class="col-xs-12 col-md-8 col-md-offset-1 col-lg-6 col-lg-offset-0 band p-b-0 form-wrapper">';
		$markup.= '<hgroup>';
		$markup.= '<h2 class="section-title">'. $title .'</h2>';
		$markup.= '<h3 class="section-subtitle">'. $subtitle .'</h3>';
		$markup.= '</hgroup>';

		$markup .= do_shortcode('[contact-form-7 id="108" title="Contact form 1" html_class="contact-form"]');
		$markup.= '</div><!-- col -->';

		$markup.= '</div><!-- row -->';

		$markup.= '</div><!-- container -->';



		$markup.= '<div class="container">';


		$markup.= '<div class="row">';
		$markup.= '<div class="col-xs-12 col-md-8 col-md-offset-1 col-lg-6 col-lg-offset-0 contacts">';
		$markup.= '<div class="row">';
		$markup.= '<div class="col-xs-6">';
		$markup.= '<p class="m-b-0">'. $address .'<br>';
		$markup.= 'tel. <a href="tel:+351'. str_replace(' ', '', $phone) .'">'. $phone .'</a><br>';
		$markup.= '<a href="mailto:'. $email .'">'. $email .'</a>';
		$markup.= '</p>';
		$markup.= '</div><!-- col -->';
		$markup.= '<div class="col-xs-6">';

		$markup.= '<nav class="socials">';
		echo $markup;

		wp_nav_menu( array( 'theme_location' => 'social_footer', 'container'=> false, 'menu_id' => 'socials-menu-footer', 'link_before' => '<span class="sr-only">', 'link_after' => '</span>' ) );

		$markup = '</nav><!-- socials -->';
		$markup.= '<p class="m-b-0">Coordenadas GPS:<br>';
		$markup.= 'Latitude: '. $latitude .'<br>';
		$markup.= 'Longitude: '. $longitude .'</p>';

		$markup.= '</div><!-- col -->';
		$markup.= '</div><!-- row -->';
		$markup.= '</div><!-- col -->';
		$markup.= '</div><!-- row -->';
		$markup.= '</div><!-- container -->';
		$markup.= '<div id="map-canvas"></div>';
		$markup.= '</section><!-- contact -->';

		$markup.= '<script>';
		$markup.= 'var coords = {"lat":'. $latitude .',"long": '. $longitude .'}';
		$markup.= '</script>';

		echo $markup;

		echo $args['after_widget'];
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = !empty( $new_instance['title'] ) ? $new_instance['title'] : '';
		$instance['subtitle'] = !empty( $new_instance['subtitle'] ) ? $new_instance['subtitle'] : '';
		$instance['address'] = !empty( $new_instance['address'] ) ? $new_instance['address'] : '';
		$instance['phone'] = !empty( $new_instance['phone'] ) ? $new_instance['phone'] : '';
		$instance['email'] = !empty( $new_instance['email'] ) ? $new_instance['email'] : '';
		$instance['latitude'] = !empty( $new_instance['latitude'] ) ? $new_instance['latitude'] : '';
		$instance['longitude'] = !empty( $new_instance['longitude'] ) ? $new_instance['longitude'] : '';

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'text' => '', 'title' => '', 'subtitle' => '') );

		$markup = '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'title' ) .'">'. esc_html( 'Title:', 'rm') .'</label>';
		$markup.= '<input class="widefat" id="'. $this->get_field_id( 'title' ) .'" name="'. $this->get_field_name( 'title' ) .'" type="text" value="'. esc_attr( $instance['title'] ) .'"  />';

		$markup.= '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'subtitle' ) .'">'. esc_html( 'Subtitle:', 'rm') .'</label>';
		$markup.= '<input class="widefat" id="'. $this->get_field_id( 'subtitle' ) .'" name="'. $this->get_field_name( 'subtitle' ) .'" type="text" value="'. esc_attr( $instance['subtitle'] ) .'"  />';

		$markup.= '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'address' ) .'">'. esc_html( 'Address:', 'rm') .'</label>';
		$markup.= '<textarea class="widefat" rows="10" cols="20" id="'. $this->get_field_id( 'address' ) .'" name="'. $this->get_field_name( 'address' ) .'">'. esc_textarea( $instance['address'] ) .'</textarea>';
		$markup.= '</p>';

		$markup.= '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'phone' ) .'">'. esc_html( 'Phone:', 'rm') .'</label>';
		$markup.= '<input class="widefat" id="'. $this->get_field_id( 'phone' ) .'" name="'. $this->get_field_name( 'phone' ) .'" type="text" value="'. esc_attr( $instance['phone'] ) .'"  />';
		$markup.= '</p>';

		$markup.= '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'email' ) .'">'. esc_html( 'Email:', 'rm') .'</label>';
		$markup.= '<input class="widefat" id="'. $this->get_field_id( 'email' ) .'" name="'. $this->get_field_name( 'email' ) .'" type="text" value="'. esc_attr( $instance['email'] ) .'"  />';
		$markup.= '</p>';

		$markup.= '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'latitude' ) .'">'. esc_html( 'Latitude:', 'rm') .'</label>';
		$markup.= '<input class="widefat" id="'. $this->get_field_id( 'latitude' ) .'" name="'. $this->get_field_name( 'latitude' ) .'" type="text" value="'. esc_attr( $instance['latitude'] ) .'"  />';
		$markup.= '</p>';

		$markup.= '<p>';
		$markup.= '<label for="'. $this->get_field_name( 'longitude' ) .'">'. esc_html( 'Longitude:', 'rm') .'</label>';
		$markup.= '<input class="widefat" id="'. $this->get_field_id( 'longitude' ) .'" name="'. $this->get_field_name( 'longitude' ) .'" type="text" value="'. esc_attr( $instance['longitude'] ) .'"  />';
		$markup.= '</p>';

		echo $markup;
	}
}
