<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package span
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function span_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'span_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function span_jetpack_setup
add_action( 'after_setup_theme', 'span_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function span_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function span_infinite_scroll_render
