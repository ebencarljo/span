<?php
/**
 * Tag cloud widget class
 *
 * @since 2.8.0
 */
class span_tag_cloud_widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname'	=>	'tag', 'description' => __( "A cloud of your most used tags.") );
		parent::__construct('tag_cloud', __('Tag Cloud'), $widget_ops);
	}

	public function widget( $args, $instance ) {
	
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __('Tags');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}
		
		if( in_array( $args['id'] , array( 'footer-A', 'footer-B', 'footer-C', 'footer-D' ) ) ){
			$this->is_footer = true;
		} else {
			$this->is_footer	=	false;	
		}
		
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo ( $this->is_footer ) ? '<ul class="tags">' : '';

		/**
		 * Filter the taxonomy used in the Tag Cloud widget.
		 *
		 * @since 2.8.0
		 * @since 3.0.0 Added taxonomy drop-down.
		 *
		 * @see wp_tag_cloud()
		 *
		 * @param array $current_taxonomy The taxonomy to use in the tag cloud. Default 'tags'.
		 */
		$tagcloud	=	wp_tag_cloud( apply_filters( 'widget_tag_cloud_args', array(
			'taxonomy' 	=> $current_taxonomy,
			'format'		=>	'array'
		) ) );
		
		foreach( $tagcloud as $tag ){
			$tag 	= 	str_replace( 'font-size: 8pt;', '', $tag );
			$tag	=	$this->is_footer ? $tag : str_replace( '\'>', '\'><i class="fa fa-tag"></i> ', $tag );

			$this->is_footer ? str_replace( 'font-size: 8pt;', '', $tag ): '';
			echo ( $this->is_footer ) ? '<li>' . $tag . '</li>' : $tag;
		}

		echo ( $this->is_footer ) ? '</ul>' : '';
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		return $instance;
	}

	public function form( $instance ) {
		$current_taxonomy = $this->_get_current_taxonomy($instance);
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
	<p><label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy:') ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
	<?php foreach ( get_taxonomies() as $taxonomy ) :
				$tax = get_taxonomy($taxonomy);
				if ( !$tax->show_tagcloud || empty($tax->labels->name) )
					continue;
	?>
		<option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $current_taxonomy) ?>><?php echo $tax->labels->name; ?></option>
	<?php endforeach; ?>
	</select></p><?php
	}

	public function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
}