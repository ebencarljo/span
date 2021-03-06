<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package span
 */

?>

      <!-- Start Footer Section -->
      <footer>
        <div class="container">
          <div class="row footer-widgets">
            <!-- Start Contact Widget -->
            <div class="col-md-3 col-sm-6 col-xs-12">
            <?php if( is_active_sidebar( 'footer-A' ) ):?>
            	<?php dynamic_sidebar( 'footer-A' );?>
            <?php else:?>
            	<?php span_footer_debug( 'footer-A' );?>
            <?php endif;?>
            </div>
            <!-- .col-md-3 -->
            <!-- End Contact Widget -->
            <!-- Start Recent Posts Widget -->
            <div class="col-md-3 col-sm-6 col-xs-12">
				<?php if( is_active_sidebar( 'footer-B' ) ):?>
            	<?php dynamic_sidebar( 'footer-B' );?>
            <?php else:?>
            	<?php span_footer_debug( 'footer-B' );?>
            <?php endif;?>
            </div>
            <!-- .col-md-3 -->
            <!-- End Recent posts Widget -->
            <!-- Start Tags Widget -->
            <div class="col-md-3 col-sm-6 col-xs-12">
            <?php if( is_active_sidebar( 'footer-C' ) ):?>
            	<?php dynamic_sidebar( 'footer-C' );?>
            <?php else:?>
            	<?php span_footer_debug( 'footer-C' );?>
            <?php endif;?>
            </div>
            <!-- .col-md-3 -->
            <!-- End Twitter Widget -->
            <!-- Start Flickr Widget -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <?php if( is_active_sidebar( 'footer-D' ) ):?>
            	<?php dynamic_sidebar( 'footer-D' );?>
            <?php else:?>
            	<?php span_footer_debug( 'footer-D' );?>
            <?php endif;?>
            </div>
            <!-- .col-md-3 -->
            <!-- End Flickr Widget -->
          </div>
          <!-- .row -->        
        </div>
      </footer>
      <!-- End Footer Section -->
      <!-- Start Copyright -->
      <div class="copyright-section">
        <div class="container">
          <div class="row">
            <div class="col-sm-5">
              <p><?php echo $copyright = span_opt( 'general_footer_copyright' ) ? esc_js( $copyright ) : __( 'Span WordPress Multipurpose Theme by Blair Jersyer', 'span' );?></p>
            </div>
            <!-- .col-md-6 -->
            <div class="col-sm-7">
            <?php
				$menu_array		=	array(
					'theme_location'	=>	'footer',
					'container'			=>	false,
					'menu_class'		=>	'nav navbar-nav navbar-right',
					'items_wrap'		=>	'<ul id="%1$s" class="footer-nav">%3$s</ul>',
					'link_after'		=>	' /',
					'walker'				=>	new Span_Desktop_Menu_Walker
			  );
			  if( ! in_array( $menu_id	= span_hopt( 'footer_menu', span_tag_hierarchy(), NULL ), array( '', NULL ), TRUE ) ) { // Displays custom menu if it's set
				  $menu_array[ 'menu' ] 	=	$menu_id;
			  }
			  ?>
              <?php wp_nav_menu( $menu_array );?>
            </div>
            <!-- .col-md-6 -->
          </div>
          <!-- .row -->
        </div>
      </div>
      <!-- End Copyright -->
    </div>
<?php wp_footer(); ?>
<style>
<?php
$footer_color_palette 	= span_color_palette( 'footer' );
$footer_color_type      = span_hopt( 'footer_color_type', span_tag_hierarchy(), '#EEE' );
// Custom Colors
$footer_link_color      = span_hopt( 'footer_link_color', span_tag_hierarchy(), '#F60' );
$footer_link_hover      = span_hopt( 'footer_link_hover', span_tag_hierarchy(), '#F60' );
$footer_bck             = span_hopt( 'footer_bg_color', span_tag_hierarchy(), '#999' );
$footer_text_color      = span_hopt( 'footer_text_color', span_tag_hierarchy(), '#DDD' );
// Palette
$footer_palette         = span_hopt( 'footer_palette', span_tag_hierarchy(), 'default' );
// Padding
$footer_padding         = span_hopt( 'footer_padding', span_tag_hierarchy(), '25px' );
// Size
$footer_size            = span_hopt( 'footer_text_size', span_tag_hierarchy(), '15px' );

// Footer Custom Colors
if( ! empty( $footer_link_color ) && ! empty( $footer_link_hover ) && ! empty( $footer_bck ) && ! empty( $footer_text_color ) && ! $footer_color_type ) {
    ?>
    .copyright-section {
        background-color:<?php echo $footer_bck;?> !important;
    }
    .copyright-section p {
        color:<?php echo $footer_text_color;?> !important;
    }
    .copyright-section a{
        color:<?php echo $footer_link_color;?> !important;
    }
    .copyright-section a:hover{
        color:<?php echo $footer_link_hover; ?> !important;
    }
    <?php
}
// Footer size
if( $footer_size ):
?>
.copyright-section p{
    font-size: <?php echo $footer_size;?>px !important;
}
<?php
endif;

// Footer Padding
if( $footer_padding ):
?>
.copyright-section {
    padding: <?php echo $footer_padding;?>px 0 !important;
}
<?php
endif;

// Footer Colors
if( $footer_color_type ) { // is palette is defined
    if( isset( $footer_color_palette[ $footer_palette ] ) ) {
        $colors    =    $footer_color_palette[ $footer_palette ];
        ?>
        .copyright-section p {
            color:<?php echo $colors[1];?> !important;
        }
        .copyright-section a{
            color:<?php echo $colors[2];?> !important;
        }
        .copyright-section a:hover{
            color:<?php echo $colors[3];?> !important;
        }
        <?php
    }
}
?>    
</style>
<style id="custom-css">
<?php echo span_hopt( 'custom_css', span_tag_hierarchy(), '' );?>
</style>
<script>
<?php echo span_hopt( 'ga_tracking_code', span_tag_hierarchy(), '' );?>
</script>
</body>
</html>
