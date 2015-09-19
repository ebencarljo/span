<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package span
 */

?>

<!-- Start Post -->
<div class="blog-post" id="post-<?php the_ID(); ?>">
   <?php if( span_post_thumb() !== null ):?>
   <!-- Post format icon -->
   <div class="post-format">
      <span>
         <a href="<?php echo $link = span_post_format_link() ? $link : "javascript:void(0)";?>"><i class="<?php echo span_post_format_icon();?>"></i></a>
      </span>
   </div>
   <!-- Post feature-inner -->
   <?php
	$blog_post	=	span_post_thumb( 'blog-posts' );
	$full_blog	=	span_post_thumb( 'full-blog' );
	?>
   <div class="feature-inner"> <a class="lightbox" href="<?php echo span_post_thumb( 'full' );?>"><img src="<?php echo span_hopt( 'sidebar_layout', span_tag_hierarchy(), 'right-sidebar' ) === 'no-sidebar' ? $full_blog : $blog_post;?>" alt=""></a> </div>
   <!-- End Post feature-inner -->
   <?php endif;?>
   <!-- Post Content -->
   <div class="post-content">
      <?php the_title( sprintf( '<h3 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
      <div class="meta">
         <span class="meta-part">
            <a href="#"><i class="icon-clock"></i>
            <?php span_posted_on(); ?>
            </a>
         </span>
         <span class="meta-part">
            <a href="<?php the_permalink();?>#comments"><i class="icon-bubbles"></i> <?php echo span_comments_nbr();?></a>
         </span>
         <span class="meta-part">
            <a href="#"><i class="icon-like "></i> 214 Likes</a>
         </span>
         <span class="meta-part">
            <i class="icon-folder"></i> <?php echo span_categories();?>
         </span>
         <span class="meta-part">
            <?php echo span_author_link( 'icon-user' );?>
         </span>
      </div>
      <p>
         <?php the_content();?>
      </p>
   </div>
   <!-- Post Content --> 
   
   <!-- Share social -->
   <div class="share">
      <div class="social-link pull-left">
         <span>
            <?php _e( 'Share this post' , 'span' );?>
         </span>
         <a class="twitter" target="_blank" data-original-title="twitter" href="#" data-toggle="tooltip" data-placement="top"><i class="fa fa-twitter"></i></a> 
         <a class="facebook" target="_blank" data-original-title="facebook" href="#" data-toggle="tooltip" data-placement="top"><i class="fa fa-facebook"></i></a> 
         <a class="google" target="_blank" data-original-title="google-plus" href="#" data-toggle="tooltip" data-placement="top"><i class="fa fa-google-plus"></i></a> 
         <a class="linkedin" target="_blank" data-original-title="linkedin" href="#" data-toggle="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a> 
		</div>
      <div class="pull-right">
        <div class="post-tags-list">
        <?php 
		  $post_tags	=	get_the_tags();
		  if( $post_tags ){
			  foreach( $post_tags as $tag ){
				  echo '<a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a> ';
			  }
		  }
		  ?>
        </div>
      </div>
   </div>
   
   <?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>
</div>