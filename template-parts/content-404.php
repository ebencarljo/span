<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package span
 */
if( span_hopt( 'sidebar_layout', span_tag_hierarchy(), 'right-sidebar' ) == 'no-sidebar' ) {
	$width	=	6;
	$offset	=	3;
} else {
	$width	=	8;
	$offset	=	2;
}
?>
<div class="row">
   <div class="col-md-<?php echo $width;?> col-md-offset-<?php echo $offset;?>">
     <div class="error-page">
       <p><?php _e( 'Ooopps.! The page you were looking for doesn\'t exist', 'span' );?></p>
       <h1>404</h1>
       <a href="<?php echo home_url();?>" class="btn btn-larg btn-effect"><?php _e( 'Back to home page', 'span' );?></a>
     </div>
   </div>
</div>