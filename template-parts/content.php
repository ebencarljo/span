<?php
/**
 * Template part for displaying posts.
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
      <?php span_post_meta();?>
      <p>
         <?php the_excerpt();?>
      </p>
   </div>
   <!-- Post Content --> 
   
   <!-- Share social -->
   <div class="share">
      <?php span_post_share();?>
      <div class="pull-right"> <a class="btn btn-effect" href="<?php the_permalink();?>">
         <?php _e( 'Continue Reading' , 'span' );?>
         <i class="fa fa-angle-right"></i></a> </div>
   </div>
</div>
