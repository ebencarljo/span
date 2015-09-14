<?php
class Span_Comments_Walker extends Walker_Comment {
	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

	// constructor – wrapper for the comments list
	function __construct() { ?>

		<ul>

	<?php }

	// start_lvl – wrapper for child comments list
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 2; ?>
		
		<ul>

	<?php }

	// end_lvl – closing wrapper for child comments list
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 2; ?>

		</ul>

	<?php }

	// start_el – HTML for comment template
	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		
		if( ! isset( $this->dateformat ) ):
		$this->dateformat					= get_option( 'date_format' );
		endif;
		
		$args[ 'reply_text' ]	=	sprintf( __( '%s Reply' ) , '<i class="fa fa-reply"></i>' );
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 

		if ( 'article' == $args['style'] ) {
			$tag = 'article';
			$add_below = 'comment';
		} else {
			$tag = 'article';
			$add_below = 'comment';
		} ?>
      <li class="media" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished">
         <div <?php comment_class( ( empty( $args['has_children'] ) ? '' : 'parent' ) . ' comment-box clearfix' ) ?> itemprop="comment" itemscope itemtype="http://schema.org/Comment" id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment, 75, '', 'avatar', array(
               'class'		=>		'pull-left'
            ) ); ?></a>
            
            <div class="comment-content" role="complementary">
            	<div class="comment-meta">
               	<h4 class="comment-by"><?php echo '<a class="comment-author-link" href="' . ( $url = get_comment_author_url() == '' ? '#' : $url ) 	. '" itemprop="author">' . get_comment_author() . '</a>';?></h4>
                  <span class="comment-date"><?php echo sprintf( __( '%s' , 'devor' ) , get_comment_date( $this->dateformat ) ) ?></span>
               </div>
               <p>
						<?php if ($comment->comment_approved == '0') : ?>
                  <?php _e( 'Your comment is awaiting moderation.' , 'span' );?>
                  <?php endif; ?>
                  <?php comment_text() ?>
               </p>
               <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])));?>
               <?php edit_comment_link( __( 'Edit this comment' , 'span' ) ,'',''); ?>
            </div>
         </div>
	<?php 
	}

	// end_el – closing HTML for comment template
	function end_el(&$output, $comment, $depth = 0, $args = array() ) { 
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 
	?>
      </li>

	<?php }

	// destructor – closing wrapper for the comments list
	function __destruct() { ?>

		</ul>
	
	<?php }

}
//  , get_comment_time() 