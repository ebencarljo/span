<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package span
 */

get_header(); ?>

<?php get_template_part( 'page' , 'banner' );?>

<!-- Start Content -->
<div id="content">
  <div class="container">
    <div class="row">
    
    	<!--Sidebar-->
      <?php get_sidebar( 'left' );?>
      <!--End sidebar-->
      
      <!-- Start Blog Posts -->
      <div class="col-md-<?php echo span_body_width();?> home-body">
        <!-- Start Post -->
        <?php if ( have_posts() ) : ?>
        
        <?php while( have_posts() ): the_post();?>
        
        <?php
			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_format() );
			?>
        
        <?php endwhile;?>
        
        <?php span_pagination();?>
        
        <?php else:;?>
        
        <?php get_template_part( 'template-parts/content', 'none' );;?>
        
        <?php endif;?>
        
      </div>
      <!-- End Blog Posts -->

      <!--Sidebar-->
      <?php get_sidebar( 'right' );?>
      <!--End sidebar-->
      
    </div>
  </div>
</div>
<!-- End Content -->

<?php get_footer(); ?>