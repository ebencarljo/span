<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package span
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="background:url(<?php echo span_hopt( 'offset_background', span_tag_hierarchy(), '#999' );?>)">
    <!-- Full Body Container -->
    <div id="container" class="<?php echo span_hopt( 'layout', span_tag_hierarchy(), 'wide-page' );?>">
		<!-- Start Header Section -->
      <div class="hidden-header">
      </div>
      <header class="clearfix" style="<?php echo span_header_top_offset();?>">
        <!-- Start Top Bar -->
        <?php if( intval( span_hopt( 'display_topbar', span_tag_hierarchy(), '1' ) ) == true ):?>
        <div class="top-bar <?php echo intval( span_hopt( 'use_skin', span_tag_hierarchy(), '1' ) ) == true ? 'color-bar' : '';?>">
          <div class="container">
            <div class="row">
              <div class="col-md-7 col-sm-9">
                <!-- Start Contact Info -->
                <ul class="contact-details">
                    <?php if( is_array( $top_bar_details = span_opt( 'top_bar_details_links' ) ) ):?>
                        <?php foreach( $top_bar_details as $key => $topbar ):?>
                            <?php if( ! empty( $topbar ) ):?>
                                <?php
                                switch( $key ) {
                                    case 'phone' : $icon = 'call-out'; break;
                                    case 'location' : $icon = 'pointer'; break;
                                    case 'email' : $icon = 'envelope'; break;
                                }
                                ?>
                            <li>
                                <a href"javascript:void()">
                                <i class="icon-<?php echo $icon;?>">
                                </i>
                                <?php echo esc_html( $topbar );?>
                                </a>
                            </li>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endif;?>                    
                </ul>
                <!-- End Contact Info -->
              </div>
              <div class="col-md-5 col-sm-3">
                <!-- Start Social Links -->
                <ul class="social-list">
                    <?php if( is_array( $social_profiles_links = span_opt( 'social_profiles_links' ) ) ):?>
                        <?php foreach( $social_profiles_links as $key => $link ):?>
                            <?php if( ! empty( $link ) ):?>
                            <?php 
                            $text   =   str_replace( '-', ' ', $key );
                            switch( $key ) {
                                case 'facebook' : $class = 'facebook'; break;
                                case 'twitter' : $class = 'twitter'; break;
                                case 'google-plus' : $class = 'google'; break;
                                case 'dribbble' : $class = 'dribbble'; break;
                                case 'linkedin' : $class = 'linkdin'; break;
                            }
                            ?>
                  <li>
                    <a class="<?php echo $class;?> itl-tooltip" data-placement="bottom" title="<?php ucwords( $text );?>" href="<?php echo esc_url( $link );?>">
                    <i class="fa fa-<?php echo esc_html( $key );?>">
                    </i>
                    </a>
                  </li>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endif;?>
                </ul>
                <!-- End Social Links -->
              </div>
            </div>
          </div>
        </div>
        <?php endif;?>
        <!-- End Top Bar -->
        <?php if( intval( span_hopt( 'display_header', span_tag_hierarchy(), '1' ) ) == true ):?>
        <!-- Start  Logo & Naviagtion  -->
        <div class="navbar navbar-default navbar-top">
          <div class="container">
            <div class="navbar-header">
              <!-- Stat Toggle Nav Link For Mobiles -->
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars">
              </i>
              </button>
              <!-- End Toggle Nav Link For Mobiles -->
              <a class="navbar-brand" href="<?php echo home_url( '/' );?>">
              <?php $logo = span_opt( 'desktop_logo' );?>
              <img alt="" src="<?php echo ( ! empty( $logo ) ? $logo['url'] : get_template_directory_uri() . '/images/logo.png' );?>">
              </a>
            </div>
            <div class="navbar-collapse collapse">
              <!-- Stat Search -->
              <div class="search-side">
                <a class="show-search">
                <i class="fa fa-search"></i>
                </a>
              </div>
              <!-- Form for navbar search area -->
              <form class="full-search" action="<?php echo home_url( '/' );?>">
                <div class="container">
                  <div class="row">
                    <input class="form-control" name="s" type="text" placeholder="<?php _e( 'Type to search', 'span' );?>">
                    <a class="close-search">
                    <span class="fa fa-times fa-2x">
                    </span>
                    </a>
                  </div>
                </div>
              </form>
              <!-- Search form ends -->
              <!-- Start Navigation List -->
              <?php 
				  if( has_nav_menu( 'primary' ) ) {
					  wp_nav_menu( array(
							  'theme_location'	=>	'primary',
							  'container'			=>	'',
							  'menu_class'		=>	'nav navbar-nav navbar-right',
							  'items_wrap'		=>	'<ul id="%1$s" class="%2$s">%3$s</ul>',
							  'walker'				=>	new Span_Desktop_Menu_Walker
					  ) );
				  } else {
					  ?>
                 <ul class="nav navbar-nav navbar-right">
                   <li>
                   <?php if( intval( span_hopt( 'debug_mode', span_tag_hierarchy(), '1' ) ) == true ):?>
                     <a href="<?php echo admin_url( 'nav-menus.php' );?>">
                     <?php _e( 'No menu bind to this location', 'span' );?>
                     </a>
						 <?php endif;?>                     
                   </li>
                 </ul>
                 <?php
				  }
				  ;?>
              <!-- End Navigation List -->
            </div>
          </div>
			<?php if( has_nav_menu( 'header_mobile' ) ):?>
          <!-- Mobile Menu Start -->
          <?php wp_nav_menu( array(
                'theme_location'	=>	'header_mobile',
                'container'		=>	'',
                'menu_class'		=>	'mobile-menu',
                'items_wrap'		=>	'<ul id="%1$s" class="wpb-mobile-menu %2$s">%3$s</ul>',
                'walker'			=>	new Span_Desktop_Menu_Walker
          ) );?>
          <!-- Mobile Menu End -->
          <?php else: ?>
          <ul class="wpb-mobile-menu">
             <li>
             <?php if( intval( span_hopt( 'debug_mode', span_tag_hierarchy(), '1' ) ) == true ):?>
               <a href="<?php echo admin_url( 'nav-menus.php' );?>">
               <?php _e( 'No menu bind to this location', 'span' );?>
               </a>
				 <?php endif;?>
             </li>
           </ul>
          <?php endif;?>

        </div>
        <!-- End Header Logo & Naviagtion -->
        <?php endif;?>
      </header>