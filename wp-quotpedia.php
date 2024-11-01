<?php
/*
Plugin Name: WP-Quotpedia
Plugin URI: http://www.quotpedia.com
Description: Quotpedia for Wordpress
Author: Süleyman ÜSTÜN
Author URI: http://www.sustun.com
Text Domain: wp-quotpedia
Domain Path: /languages/
Version: 1.0
*/

// Register and load the widget
function wpb_load_widget() {
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 
add_action( 'plugins_loaded', 'myplugin_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function myplugin_load_textdomain() {
  load_plugin_textdomain( 'wp-quotpedia', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}

// Creating the widget 
class wpb_widget extends WP_Widget {
 
function __construct() {
	parent::__construct(
	
	// Base ID of your widget
	'wpb_widget', 
	// Widget name will appear in UI
	__('Quotpedia', 'wp-quotpedia'),
	
	// Widget description
	array( 'description' => __('Widget for Quotpedia.', 'wp-quotpedia' ), ) );
}
 
// Creating widget front-end
public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance['title'] );
	
	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
	if ( ! empty( $title ) )
		echo $args['before_title'] .'<a target="_blank" href="http://tr.quotpedia.com">'.$title.'</a>'. $args['after_title'];
	
	// This is where you run the code and display the output
	echo '<iframe src="http://tr.quotpedia.com/?Showcase" frameborder="0" scrolling="no" width="100%" height="300px;"></iframe>';
	echo $args['after_widget'];
}
         
// Widget Backend 
public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	} else {
		$title = __('Title', 'wp-quotpedia');
	}
	// Widget admin form
	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'wp-quotpedia'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="Quotpedia" />
	</p>
	<?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
	}
} // Class wpb_widget ends here

?>