<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package span
 */

?>
<?php if( intval( span_hopt( 'display_page_title', span_tag_hierarchy(), '1' ) ) == true ):?>
<h4 class="classic-title" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
   <span>
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
   </span>
</h4>
<?php endif; // end display_page_title;?>

<?php the_content(); ?>

<?php
	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'span' ),
		'after'  => '</div>',
	) );
?>

<?php edit_post_link( esc_html__( 'Edit', 'span' ), '<span class="edit-link">', '</span>' ); ?>