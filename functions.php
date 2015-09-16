<?php
/**
 * span functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package span
 */

if ( ! function_exists( 'span_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function span_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on span, use a find and replace
	 * to change 'span' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'span', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' 			=> esc_html__( 'Header Menu', 'span' ),
		'header_mobile'	=>	esc_html__( 'Header Mobile Menu' , 'span' ),
		'footer'	 			=> esc_html__( 'Footer Menu' , 'span' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'audio'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'span_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	// Image Size
	add_image_size( 'blog-posts', 848, 435, true ); // with a sidebar (left or right)
	add_image_size( 'widget-thumb' , 90, 60, true );
}
endif; // span_setup
add_action( 'after_setup_theme', 'span_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function span_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'span_content_width', 640 );
}
add_action( 'after_setup_theme', 'span_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function span_widgets_init() {
	// Unregister default widgets
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Widget_Archives' );
	
	// Register Widgets
	register_widget( 'span_recents_posts_widget' );
	register_widget( 'span_categories_widget' );
	register_widget( 'span_pages_widget' );
	register_widget( 'span_search_widget' );
	register_widget( 'span_calendar_widget' );
	register_widget( 'span_comments_widget' );
	register_widget( 'span_meta_widget' );
	register_widget( 'span_tag_cloud_widget' );
	register_widget( 'span_archives_widget' );
		
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'span' ),
		'id'            => 'left-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'span' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
	// Footer Sidebar
	
	$after_title		=	'<span class="head-line"></span></h4>';
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer A', 'span' ),
		'id'            => 'footer-A',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => $after_title
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer B', 'span' ),
		'id'            => 'footer-B',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => $after_title
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer C', 'span' ),
		'id'            => 'footer-C',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => $after_title
 	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer D', 'span' ),
		'id'            => 'footer-D',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => $after_title
	) );
}
add_action( 'widgets_init', 'span_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function span_scripts() {
	
	// CSS FILES
	
	wp_enqueue_style( 'span-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
	
	wp_enqueue_style( 'span-animate', get_stylesheet_directory_uri() . '/css/animate.css' );
	
	wp_enqueue_style( 'span-responsive', get_stylesheet_directory_uri() . '/css/responsive.css' );
	
	wp_enqueue_style( 'span-settings', get_stylesheet_directory_uri() . '/css/settings.css' );
	
	wp_enqueue_style( 'span-fontawesome', get_stylesheet_directory_uri() . '/fonts/font-awesome.min.css' );
	
	wp_enqueue_style( 'span-simpleicon', get_stylesheet_directory_uri() . '/fonts/simple-line-icons.css' );
	
	wp_enqueue_style( 'span-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'span-pink', get_stylesheet_directory_uri() . '/css/colors/'. span_hopt( 'color_scheme' , span_tag_hierarchy(), 'green' ) . '.css' );
	
	// JS FILES
	wp_enqueue_script( 'span-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'span-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20120206', true );
	
	wp_enqueue_script( 'span-modernizr', get_template_directory_uri() . '/js/modernizrr.js', array( 'jquery' ), '20120206', true );
	
	wp_enqueue_script( 'span-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '20120206', true );
	
	wp_enqueue_script( 'span-appear', get_template_directory_uri() . '/js/jquery.appear.js', array( 'jquery' ), '20120206', true );
    
    wp_enqueue_script( 'span-slicknav', get_template_directory_uri() . '/js/jquery.slicknav .js', array( 'jquery' ), '20120206', true );
    
    wp_enqueue_script( 'span-themepunch', get_template_directory_uri() . '/js/jquery.themepunch.revolution.min.js', array( 'jquery' ), '20120206', true );
    
    wp_enqueue_script( 'span-countdown', get_template_directory_uri() . '/js/count-to.js', array( 'jquery' ), '20120206', true );
    
    wp_enqueue_script( 'span-nivolightbox', get_template_directory_uri() . '/js/nivo-lightbox.min.js', array( 'jquery' ), '20120206', true );
	
	wp_enqueue_script( 'span-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '20120206', true );
    
    wp_enqueue_script( 'span-mixit' ,  get_template_directory_uri() . '/js/jquery.mixitup.min.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'span-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array( 'jquery' ), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'span_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Include Filters
**/

require get_template_directory() . '/inc/filters.php';

/**
 * Include actions
**/

require get_template_directory() . '/inc/actions.php';

/**
 * Desktop menu Walker
**/

require get_template_directory() . '/inc/desktop-walker.php';

/**
 * Comments Walker
**/

require get_template_directory() . '/inc/comments-walker.php';

/**
 * Register Widget
**/

require get_template_directory() . '/inc/widgets/widget.calendar.php';
require get_template_directory() . '/inc/widgets/widget.recents-posts.php';
require get_template_directory() . '/inc/widgets/widget.categories.php';
require get_template_directory() . '/inc/widgets/widget.pages.php';
require get_template_directory() . '/inc/widgets/widget.search.php';
require get_template_directory() . '/inc/widgets/widget.comments.php';
require get_template_directory() . '/inc/widgets/widget.meta.php';
require get_template_directory() . '/inc/widgets/widget.tagcloud.php';
require get_template_directory() . '/inc/widgets/widget.archive.php';

/**
 * Reusable Options
**/

require get_template_directory() . '/inc/options-fields.php';

/** 
 * Include Admin Folder
**/

require get_template_directory() . '/admin/admin-init.php';