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
              <?php dynamic_sidebar( 'footer-A' );?>
            </div>
            <!-- .col-md-3 -->
            <!-- End Contact Widget -->
            <!-- Start Recent Posts Widget -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <?php dynamic_sidebar( 'footer-B' );?>
            </div>
            <!-- .col-md-3 -->
            <!-- End Recent posts Widget -->
            <!-- Start Tags Widget -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <?php dynamic_sidebar( 'footer-C' );?>
            </div>
            <!-- .col-md-3 -->
            <!-- End Twitter Widget -->
            <!-- Start Flickr Widget -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <?php dynamic_sidebar( 'footer-D' );?>
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
            <div class="col-sm-6">
              <p><?php echo esc_js( span_opt( 'footer_copyright' ) );?></p>
            </div>
            <!-- .col-md-6 -->
            <div class="col-sm-6">
              <?php wp_nav_menu( array(
						'theme_location'	=>	'footer',
						'container'			=>	false,
						'menu_class'		=>	'nav navbar-nav navbar-right',
						'items_wrap'		=>	'<ul id="%1$s" class="footer-nav">%3$s</ul>',
						'link_after'		=>	' /',
						'walker'				=>	new Span_Desktop_Menu_Walker
				  ) );?>
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
$footer_color_palette = span_color_palette( 'footer' );
$footer_color_type      = span_opt( 'footer_color_type' );
// Custom Colors
$footer_link_color      = span_opt( 'footer_link_color' );
$footer_link_hover      = span_opt( 'footer_link_hover' );
$footer_bck             = span_opt( 'footer_bg_color' );
$footer_text_color      = span_opt( 'footer_text_color' );
// Palette
$footer_palette         = span_opt( 'footer_palette' );
// Padding
$footer_padding         = span_opt( 'footer_padding' );
// Size
$footer_size            = span_opt( 'footer_text_size' );

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

</body>
</html>
