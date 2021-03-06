<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package span
 * @options : layout,
 */
?>
<?php get_header(); ?>

<?php get_template_part( 'page' , 'banner' );?>

<div id="content">
   <div class="container">
      <div class="row sidebar-page"> 
      
      	<?php if( span_hopt( 'sidebar_layout', span_tag_hierarchy(), 'right-sidebar' ) === 'left-sidebar' ):?>
         <!--Sidebar-->
         <?php get_sidebar( 'left' );?>
         <!--End sidebar-->
         <?php endif;?>
         
         <!-- Page Content -->
         <div class="col-md-<?php echo span_body_width();?> page-content"> 
            <!-- Classic Heading -->
            <?php while ( have_posts() ) : the_post(); ?>
            
            <?php get_template_part( 'template-parts/content', 'page' ); ?>
            
				<?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
               comments_template();
            endif;
            ?>
            
            <?php endwhile;?>
            <!-- End Page Content -->
         </div>
         <!-- End Page Content--> 
         
         <?php if( span_hopt( 'sidebar_layout', span_tag_hierarchy(), 'right-sidebar' ) === 'right-sidebar' ):?>
         <!--Sidebar-->
         <?php get_sidebar( 'right' );?>
         <!--End sidebar-->
         <?php endif;?>
         
      </div>
   </div>
</div>

<?php get_footer();?>