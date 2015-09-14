<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package span
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'span' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="comments-title"><?php esc_html_e( 'Comment navigation', 'span' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'span' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'span' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comments-list">
         <?php
         wp_list_comments( array(
            'walker'		=>	new Span_Comments_Walker,
            'style'      => 'ol',
            'short_ping' => true,
         ) );
      ?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'span' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'span' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'span' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
   <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'span' ); ?></p>
	<?php endif; ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$fields		=	array(
		'author' =>
			'<div class="col-md-4">
				<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . 
				'" size="30" placeholder="' . __( 'Name', 'span' ) . ( $req ? '*' : '' ) .
				'" ' . $aria_req . '>
			 </div>',
			 		
		'email' =>
			'<div class="col-md-4">
				<input id="email" class="form-control" name="author" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" placeholder="' . __( 'Email', 'span' ) . ( $req ? '*' : '' ) . '" ' . $aria_req . '>
			 </div>',
		
		'url' =>
			'<div class="col-md-4">
				 <input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" size="30" placeholder="' . __( 'Website', 'span' ) . '">
			 </div>'
	);
	?>
   
   <h2 class="respond-title"><?php _e( 'Leave a reply', 'span' );?></h2>
   
	<?php comment_form( array(
		'title_reply'		=> '' ,
		
		'class_submit'		=>	'default_submitbutton',
		
		'comment_field'	=>	'<div class="row">
			 <div class="col-md-12">
				<textarea id="comment" class="form-control" name="comment" cols="45" rows="8" placeholder="' . __( 'Comment', 'span' ) . '"></textarea>
				
			 </div>
		  </div>',
		  
		'fields'		=>		apply_filters( 'comment_form_default_fields', $fields ) ,
		
		'comment_notes_after'	=>	'<p class="form-allowed-tags">' .
			 sprintf(
				__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
				' <code>' . allowed_tags() . '</code>'
			 ) . '</p>
			<button type="submit" id="submit" class="btn btn-large btn-effect"><i class="fa fa-check"></i> ' . __( 'Submit Comment', 'span' ) . '</button>'
	) ); ?>
   
   <style type="text/css">
	.default_submitbutton
	{
		display:none !important;
	}
	</style>
   

</div><!-- #comments -->
