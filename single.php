<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package span
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'page' , 'banner' );?>

<div id="content">
   <div class="container">
      <div class="row sidebar-page"> 
      	<!--Sidebar-->
         <?php get_sidebar( 'left' );?>
         <!--End sidebar--> 
         
         <!-- Page Content -->
         <div class="col-md-<?php echo span_body_width();?> page-content"> 
            <!-- Classic Heading -->
            <?php while ( have_posts() ) : the_post(); ?>
            
            <?php get_template_part( 'template-parts/content', 'single' ); ?>
            
            <?php endwhile;?>
            <!-- End Page Content -->
         </div>
         <!-- End Page Content--> 
         
         <!--Sidebar-->
         <?php get_sidebar( 'right' );?>
         <!--End sidebar--> 
      </div>
   </div>
</div>

<?php get_footer();?>