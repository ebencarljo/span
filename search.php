<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package span
 */

get_header(); ?>

<?php get_template_part( 'page' , 'banner' );?>

<!-- Start Content -->
<div id="content">
  <div class="container">
    <div class="row">
      <!-- Start Blog Posts -->
      <div class="col-md-9">
        <!-- Start Post -->
        <?php if ( have_posts() ) : ?>
        
        <?php while( have_posts() ): the_post();?>
        
        <?php
			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', 'search' );
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
<?php get_footer();?>