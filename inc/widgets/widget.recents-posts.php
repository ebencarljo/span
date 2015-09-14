<?php
class span_recents_posts_widget extends WP_Widget
{
	function __construct()
	{
		parent::__construct( 'widget-popular-posts' , __( 'Span WordPress Posts' , 'span' ) , array(
			'description'	=>	__( 'Displays Posts in your sidebar' ),
			'classname'		=>	'widget-popular-posts recent-posts-widget'
		) );
	}
	
	function widget( $args , $instance )
	{
		// fill all
		$instance[ 'title' ] 		= isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Recent Posts' , 'span' );
		$instance[ 'showdate' ] 	= isset( $instance[ 'showdate' ] ) ? $instance[ 'showdate' ] : 'yes';
		$instance[ 'order' ] 		= isset( $instance[ 'order' ] ) ? $instance[ 'order' ] : 'most_commented';
		$instance[ 'number' ] 		= isset( $instance[ 'number' ] ) ? $instance[ 'number' ] : 5;
		
		$this->title	=	apply_filters( 'widget_tilte' , $instance[ 'title' ] );		
		// $args[ 'before_widget' ]	=	str_replace( 'widget_widget-popular-posts' , 'widget-popular-posts' , $args[ 'before_widget' ] );
		
		$this->is_footer		=	false;
		if( in_array( $args['id'] , array( 'footer-A', 'footer-B', 'footer-C', 'footer-D' ) ) ){
			$this->ul_parent	=	'<ul class="recent-post">';
			$this->li_parent	=	'<li class="post">';
			$this->is_footer  = 	true;
		} else {
			$this->ul_parent	=	'<ul class="posts-list">';
			$this->li_parent	=	'<li>';
		}
		
		echo $args[ 'before_widget' ];
		echo ! empty( $this->title ) ? $args[ 'before_title' ] . $this->title . $args[ 'after_title' ] : '';
		
		if( $instance[ 'order' ] === 'most_commented' )
		{
			$popular = new WP_Query( 'orderby=comment_count&posts_per_page=' . $instance[ 'number' ] );
			if( $popular->have_posts() )
			{
            echo $this->ul_parent;
				while( $popular->have_posts() ): $popular->the_post();
					$this->template( $instance, $args, $popular );
				endwhile;
				echo '</ul>';
			}
		}
		else if( $instance[ 'order' ] === 'recents' )
		{
			$popular = new WP_Query('orderby=date&posts_per_page=' . $instance[ 'number' ] . '&order=DESC' );
			if( $popular->have_posts() )
			{
            echo $this->ul_parent;
				while( $popular->have_posts() ): $popular->the_post();
					$this->template( $instance, $args, $popular );
				endwhile;
				echo '</ul>';
			}
		}
		else if( $instance[ 'order' ] === 'old_ones' )
		{
			$popular = new WP_Query('orderby=date&posts_per_page=' . $instance[ 'number' ] . '&order=ASC' );
			if( $popular->have_posts() )
			{
            echo $this->ul_parent;
				while( $popular->have_posts() ): $popular->the_post();
					$this->template( $instance, $args, $popular );
				endwhile;
				echo '</ul>';
			}
		}
		echo $args[ 'after_widget' ];
	}
	
	private function template( $instance, $args, $popular )
	{
		$widget_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $popular->ID ), 'widget-thumb' );
		echo $this->li_parent;
		if( $this->is_footer ){ // if it's displayed on footer
			if( $widget_thumb ):?>
         
			<a class="lightbox" href="<?php the_permalink();?>"><img width="90" height="60" src="<?php echo $widget_thumb[0];?>" alt="<?php the_title();?>"></a>
         
         <?php endif;?>
         
			<p class="text cursor-pointer" onclick="document.location='<?php the_permalink();?>'">
				<?php echo wp_trim_words( get_the_title() , 6 , '...' );?>
				<br />
				<span><?php echo get_the_time( 'F j, Y' );?></span>
			</p>
			<?php
		} else { // if it's not footer
				if( $widget_thumb ): // if thumb exists
				// if well sized thumb exists
				?>
				<div class="widget-thumb">
					<a href="<?php the_title();?>"><img width="90" height="60" src="<?php echo $widget_thumb[0];?>" alt="<?php the_title();?>"></a>
				</div>
				<?php
				endif;
				?>
				<div class="widget-content">
					<a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 6 , '...' );?></a>
					<?php
					if( isset( $instance[ 'showdate' ] ) )
					{
						if( $instance[ 'showdate' ] === 'yes' )
						{
					?>
					<span><?php echo get_the_time( 'F j, Y' );?></span>
					<?php
						}
					}
					?>
				</div>
				<div class="clearfix"></div>
			<?php
         } 
		echo '</li>';
	}
	function form( $instance )
	{
		$title		=	__( 'Post Widgets' , 'span' );
		$order		=	isset( $instance[ 'order' ] ) ? $instance[ 'order' ] : 'recents';
		$number		=	isset( $instance[ 'number' ] ) ? $instance[ 'number' ] : 10;
		$showdate	=	isset( $instance[ 'showdate' ] ) ? $instance[ 'showdate' ] : 'no';
		if( isset( $instance[ 'title' ] ) )
		{
			$title	=	$instance[ 'title' ];
		}
		?>
      <label for="<?php echo $this->get_field_id( 'title' );?>">
      	<?php _e( 'Title' , 'span' );?> :
      </label>
      <br />
      <input type="text" name="<?php echo $this->get_field_name( 'title' );?>" value="<?php echo esc_attr( $title );?>" />
      <br />
      <br />
      <label for="<?php echo $this->get_field_id( 'order' );?>">
      	<?php _e( 'Order By' , 'span' );?> :
      </label>
      <br />
      <select name="<?php echo $this->get_field_name( 'order' );?>">
      	<option <?php echo $order == 'recents' ? 'selected="selected"' : '';?> value="recents"><?php _e( 'Most Recents' , 'span' );?></option>
         <option <?php echo $order == 'most_commented' ? 'selected="selected"' : '';?> value="most_commented"><?php _e( 'Most Commented' , 'span' );?></option>
         <option <?php echo $order == 'old_ones' ? 'selected="selected"' : '';?> value="old_ones"><?php _e( 'Old Ones' , 'span' );?></option>
      </select>
      <br />
      <br />
      <label for="<?php echo $this->get_field_id( 'showdate' );?>">
      	<?php _e( 'Display date ?' , 'span' );?> :
      </label>
      <br />
      <select name="<?php echo $this->get_field_name( 'showdate' );?>">
      	<option <?php echo $showdate == 'yes' ? 'selected="selected"' : '';?> value="yes"><?php _e( 'Yes' , 'span' );?></option>
         <option <?php echo $showdate == 'no' ? 'selected="selected"' : '';?> value="no"><?php _e( 'No' , 'span' );?></option>
      </select>
      <br />
      <br />
      <label for="<?php echo $this->get_field_id( 'number' );?>">
      	<?php _e( 'How many posts' , 'span' );?> :
      </label>
      <br />
      <input type="text" name="<?php echo $this->get_field_name( 'number' );?>" value="<?php echo esc_attr( $number );?>" />
      <br />
      <br />
      <?php
	}
	
	function update( $new_instance , $old_instance )
	{
		$instance	=	array();
		$instance[ 'title' ]	=	( ! empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
		$instance[ 'order' ]	=	( ! empty( $new_instance[ 'order' ] ) ) ? strip_tags( $new_instance[ 'order' ] ) : '';
		$instance[ 'number' ]	=	( ! empty( $new_instance[ 'number' ] ) ) ? strip_tags( $new_instance[ 'number' ] ) : '';
		$instance[ 'showdate' ]	=	( ! empty( $new_instance[ 'showdate' ] ) ) ? strip_tags( $new_instance[ 'showdate' ] ) : '';
		return $instance;
	}
}