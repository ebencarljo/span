<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package span
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function span_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'span_body_classes' );

/**
 * Display calendar with days that have posts as links.
 *
 * The calendar is cached, which will be retrieved, if it exists. If there are
 * no posts for the month, then it will not be displayed.
 *
 * @since 1.0.0
 *
 * @global wpdb      $wpdb
 * @global int       $m
 * @global int       $monthnum
 * @global int       $year
 * @global WP_Locale $wp_locale
 * @global array     $posts
 *
 * @param bool $initial Optional, default is true. Use initial calendar names.
 * @param bool $echo    Optional, default is true. Set to false for return.
 * @return string|void String when retrieving.
 */
function span_get_calendar($initial = true, $echo = true) {
	global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;
	$key = md5( $m . $monthnum . $year );
	if ( $cache = wp_cache_get( 'get_calendar', 'calendar' ) ) {
		if ( is_array($cache) && isset( $cache[ $key ] ) ) {
			if ( $echo ) {
				/** This filter is documented in wp-includes/general-template.php */
				echo apply_filters( 'get_calendar', $cache[$key] );
				return;
			} else {
				/** This filter is documented in wp-includes/general-template.php */
				return apply_filters( 'get_calendar', $cache[$key] );
			}
		}
	}
	if ( !is_array($cache) )
		$cache = array();
	// Quick check. If we have no posts at all, abort!
	if ( !$posts ) {
		$gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' LIMIT 1");
		if ( !$gotsome ) {
			$cache[ $key ] = '';
			wp_cache_set( 'get_calendar', $cache, 'calendar' );
			return;
		}
	}
	if ( isset($_GET['w']) )
		$w = ''.intval($_GET['w']);
	// week_begins = 0 stands for Sunday
	$week_begins = intval(get_option('start_of_week'));
	// Let's figure out when we are
	if ( !empty($monthnum) && !empty($year) ) {
		$thismonth = ''.zeroise(intval($monthnum), 2);
		$thisyear = ''.intval($year);
	} elseif ( !empty($w) ) {
		// We need to get the month from MySQL
		$thisyear = ''.intval(substr($m, 0, 4));
		$d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
		$thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
	} elseif ( !empty($m) ) {
		$thisyear = ''.intval(substr($m, 0, 4));
		if ( strlen($m) < 6 )
				$thismonth = '01';
		else
				$thismonth = ''.zeroise(intval(substr($m, 4, 2)), 2);
	} else {
		$thisyear = gmdate('Y', current_time('timestamp'));
		$thismonth = gmdate('m', current_time('timestamp'));
	}
	$unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);
	$last_day = date('t', $unixmonth);
	// Get the next and previous month and year with at least one post
	$previous = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date < '$thisyear-$thismonth-01'
		AND post_type = 'post' AND post_status = 'publish'
			ORDER BY post_date DESC
			LIMIT 1");
	$next = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
		AND post_type = 'post' AND post_status = 'publish'
			ORDER BY post_date ASC
			LIMIT 1");
	/* translators: Calendar caption: 1: month name, 2: 4-digit year */
	$calendar_caption = _x('%1$s %2$s', 'calendar caption');
	$calendar_output = '<table id="wp-calendar" class="table">
	<caption>' . sprintf($calendar_caption, $wp_locale->get_month($thismonth), date('Y', $unixmonth)) . '</caption>
	<thead>
	<tr>';
	$myweek = array();
	for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
		$myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
	}
	foreach ( $myweek as $wd ) {
		$day_name = $initial ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
		$wd = esc_attr($wd);
		$calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
	}
	$calendar_output .= '
	</tr>
	</thead>
	<tfoot>
	<tr>';
	if ( $previous ) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev"><a href="' . get_month_link($previous->year, $previous->month) . '">&laquo; ' . $wp_locale->get_month_abbrev($wp_locale->get_month($previous->month)) . '</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev" class="pad">&nbsp;</td>';
	}
	$calendar_output .= "\n\t\t".'<td class="pad">&nbsp;</td>';
	if ( $next ) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next"><a href="' . get_month_link($next->year, $next->month) . '">' . $wp_locale->get_month_abbrev($wp_locale->get_month($next->month)) . ' &raquo;</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next" class="pad">&nbsp;</td>';
	}
	$calendar_output .= '
	</tr>
	</tfoot>
	<tbody>
	<tr>';
	$daywithpost = array();
	// Get days with posts
	$dayswithposts = $wpdb->get_results("SELECT DISTINCT DAYOFMONTH(post_date)
		FROM $wpdb->posts WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00'
		AND post_type = 'post' AND post_status = 'publish'
		AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59'", ARRAY_N);
	if ( $dayswithposts ) {
		foreach ( (array) $dayswithposts as $daywith ) {
			$daywithpost[] = $daywith[0];
		}
	}
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'camino') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'safari') !== false)
		$ak_title_separator = "\n";
	else
		$ak_title_separator = ', ';
	$ak_titles_for_day = array();
	$ak_post_titles = $wpdb->get_results("SELECT ID, post_title, DAYOFMONTH(post_date) as dom "
		."FROM $wpdb->posts "
		."WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00' "
		."AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59' "
		."AND post_type = 'post' AND post_status = 'publish'"
	);
	if ( $ak_post_titles ) {
		foreach ( (array) $ak_post_titles as $ak_post_title ) {
				/** This filter is documented in wp-includes/post-template.php */
				$post_title = esc_attr( apply_filters( 'the_title', $ak_post_title->post_title, $ak_post_title->ID ) );
				if ( empty($ak_titles_for_day['day_'.$ak_post_title->dom]) )
					$ak_titles_for_day['day_'.$ak_post_title->dom] = '';
				if ( empty($ak_titles_for_day["$ak_post_title->dom"]) ) // first one
					$ak_titles_for_day["$ak_post_title->dom"] = $post_title;
				else
					$ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
		}
	}
	// See how much we should pad in the beginning
	$pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
	if ( 0 != $pad )
		$calendar_output .= "\n\t\t".'<td colspan="'. esc_attr($pad) .'" class="pad">&nbsp;</td>';
	$daysinmonth = intval(date('t', $unixmonth));
	for ( $day = 1; $day <= $daysinmonth; ++$day ) {
		if ( isset($newrow) && $newrow )
			$calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
		$newrow = false;
		if ( $day == gmdate('j', current_time('timestamp')) && $thismonth == gmdate('m', current_time('timestamp')) && $thisyear == gmdate('Y', current_time('timestamp')) )
			$calendar_output .= '<td id="today">';
		else
			$calendar_output .= '<td>';
		if ( in_array($day, $daywithpost) ) // any posts today?
				$calendar_output .= '<a href="' . get_day_link( $thisyear, $thismonth, $day ) . '" title="' . esc_attr( $ak_titles_for_day[ $day ] ) . "\">$day</a>";
		else
			$calendar_output .= $day;
		$calendar_output .= '</td>';
		if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
			$newrow = true;
	}
	$pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
	if ( $pad != 0 && $pad != 7 )
		$calendar_output .= "\n\t\t".'<td class="pad" colspan="'. esc_attr($pad) .'">&nbsp;</td>';
	$calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";
	$cache[ $key ] = $calendar_output;
	wp_cache_set( 'get_calendar', $cache, 'calendar' );
	if ( $echo ) {
		/**
		 * Filter the HTML calendar output.
		 *
		 * @since 3.0.0
		 *
		 * @param string $calendar_output HTML output of the calendar.
		 */
		echo apply_filters( 'get_calendar', $calendar_output );
	} else {
		/** This filter is documented in wp-includes/general-template.php */
		return apply_filters( 'get_calendar', $calendar_output );
	}
}

// Span navigation
if( ! function_exists( 'span_pagination' ) ){
	function span_pagination()
	{
        global $wp_query;
        $total = $wp_query->max_num_pages;

        $big = 999999999; // need an unlikely integer
        if( $total > 1 )  {
             if( !$current_page = get_query_var('paged') )
                 $current_page = 1;
             if( get_option('permalink_structure') ) {
                 $format 	= 'page/%#%/';
             } else {
                 $format 	= '&paged=%#%';
             }
            $pagination		=	 paginate_links(array(
                'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'        => $format,
                'current'       => $current	=	max( 1, get_query_var('paged') ),
                'total'         => $total,
                'mid_size'      => 3,
                'type'          => 'array',
                'prev_text'     => __( 'Next' , 'span' ),
                'next_text'     => __( 'Previous' , 'span' ),
             ) );
			 // var_dump( $pagination );
			 ?>
          <div id="pagination">
             <span class="all-pages"><?php echo sprintf( __( 'Page %s of %s' , 'span' ) , $current , $total );?></span>
             <?php
				 foreach( $pagination as  $page )
				{
					$page 	=	str_replace( 'page-numbers' , 'page-num' , $page );
					$page		=	str_replace( 'next' , 'next-page' , $page );
					$page		=	str_replace( 'prev' , 'next-page' , $page );
					
					$current_pagination_page	=	strip_tags( $page );
					if( intval( $current_pagination_page ) == intval(  $current_page ) ){
						echo '<span class="current page-num">' . $current_pagination_page . '</span> ';
					} else {
						echo $page .' ';
					}
				}
				 ?>
           </div>
             <?php
        }

	}
}

// Categories

if( ! function_exists( 'span_categories' ) ){
	function span_categories(){
		// Looping categories
		$categories		=	 get_the_category();
		$category_link	=	'';
		
		foreach( $categories as $index => $category ){
			if( count( $categories ) - 1 > $index ){
				$category_link .= '<a style="display:inline" href="' . get_category_link( $category->cat_ID ) . '">' . esc_html( $category->name ) . '</a>, ';
			}	else	{
				$category_link .= '<a style="display:inline" href="' . get_category_link( $category->cat_ID ) . '">' . esc_html( $category->name ) . '</a>';
			}
		}
		return $category_link;
	}
};

// Count Comments

if( ! function_exists( 'span_comments_nbr' ) ){
	function span_comments_nbr(){
		// Counting Comments
		$comments	=	get_comments_number( get_the_ID() );
		if( $comments == 0 )
		{
			$comment_string	=	__( 'No Comment' , 'devor' );
		}
		else
		{
			$comment_string = sprintf( __( '%s Comments' , 'devor' ) , $comments );
		}
		return $comment_string;
	};
};

// Post Thumbnails

if( ! function_exists( 'span_post_thumb' ) ){
	function span_post_thumb( $thumb_type = 'blog-posts' ){
		global $post;
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumb_type );
		return $large_image_url[0];
	};
};

// Author

if( ! function_exists( 'span_author_link' ) ){
	function span_author_link( $icon ){
		return '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"><i class="' . esc_html( $icon ) . '"></i> ' . ucwords( get_the_author() ) . '</a>';
	}
};

// Post icon

if( ! function_exists( 'span_post_format_icon' ) ){
	function span_post_format_icon(){
		global $post;
		switch( get_post_format( $post->ID ) ){
			case "quote" : return 'icon-question';break;
			case "aside" : return 'icon-moustache'; break;
			case "video" : return 'icon-camcorder'; break;
			case "audio" : return 'icon-volume-2'; break;
			default: return 'icon-pencil'; break;
		}
	}
}

// Post format link

if( ! function_exists( 'span_post_format_link' ) ){
	function span_post_format_link(){
		global $post;
		$format	=	get_post_format( $post->ID );
		return get_post_format_link( $format );
	}
}

// BreadScrumbs

function span_breadcrumbs( $parent = 'div' , $before = '', $after = '', $delimiter = '<span class="crumbs-spacer"><i class="fa fa-angle-right"></i></span>', $showOnHome = 0, $showCurrent = 1) {
	
	$show_on_front	=	get_option( 'show_on_front' );
	if( $show_on_front === 'page' ){ // if it's a page which is set a home page
		$front_page_id	=	get_option( 'page_for_posts' );		
		$page		=	get_post( $front_page_id );
		$home		=	esc_html( $page->post_title );
		$homeLink = get_page_link( $page->ID );
	} else {
		$home	=	get_bloginfo( 'name' );
		$homeLink = get_bloginfo('url');
	}
  global $post;
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<' . $parent . ' class="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a></' . $parent . '>';
 
  } else {
 
    echo '<' . $parent . ' class="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . __( 'Archive by category "' , 'span' ) . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . __( 'Search results for "' , 'span' ) . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo '' . $cats . '';
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . __( 'Posts tagged "' , 'span' ) . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . __( 'Posts posted by ' , 'span' ) . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . __( 'Error 404' , 'span' ) . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</' . $parent . '>';
 
  }
} 

// Span top header offset

if( ! function_exists( 'span_header_top_offset' ) ){
	function span_header_top_offset(){
        global $wp_customize;
		if( is_user_logged_in() && ! isset( $wp_customize ) ){
			return 'top:32px;';
		}
	}
}

// Page banner margin top
if( ! function_exists( 'span_page_header_topmargin' ) ){
	function span_page_header_topmargin(){
		$default 	=	90;
		if( is_user_logged_in() ){
			$default += 32;
		}
		return $default; 
	}
}

// Blog page Title
if( ! function_exists( 'span_get_blogindex_title' ) ){
	function span_get_blogindex_title(){
		$front_page_id	=	get_option( 'page_for_posts' );		
		$page		=	get_post( $front_page_id );
		return	esc_html( $page->post_title );
	}
}

/**
 * Fetch Span Options from database
 *
 * @access public
 * @param string
 * @return var
**/

if( ! function_exists( 'span_opt' ) ) {
    function span_opt( $option = null ) {
        global $span_options;
        if( $option !== null && isset( $span_options[ $option ] ) ) {
            return $span_options[ $option ];
        } elseif( $option === null ) {
            return $span_options;
        }
        return NULL;
    }
}

/**
 * Introducing Facebook Comments
**/

add_action( 'wp_footer' , 'span_veothemes_app' );
function span_veothemes_app() {
?>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '735491383222026',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<?php
}

/**
 * Return color palette saved for several use.
 * 
 * @access public
 * @param string
 * @return array
**/

if( ! function_exists( 'span_color_palette' ) ) {
    function span_color_palette( $part ) {
        if( $part == 'footer' ) {
            return array(
                'default'   => array(
                    '#172029',
                    '#CCC',
                    '#6D7780',
                    '#FFF'
                ),
                'bleen'  => array(
                    '#05668D',
                    '#F0F3BD',
                    '#02C39A',
                    '#FFF',
                ),
                'koz' => array(
                    '#13293D',
                    '#E8F1F2',
                    '#247BA0',
                    '#FFF',
                ),
                'darket' => array(
                    '#2B2D42',
                    '#EEEEEE',
                    '#EF233C',
                    '#FFF'
                ),
                'underwater' => array(
                    '#0D0630',
                    '#E6F9AF',
                    '#8BBEB2',
                    '#FFF'
                ),
            );
        }
    }
}

/**
 * Load custom stylesheet file
 *
 * @access public
 * @params string
 * @return string
**/

function span_stylesheet( $link ) {
    
}

/**
 * Get Span options considering location( blog, single, page, archives, author, search)
 *
 * @access public
 * @param string
 * @param array
 * @param bool
 * @return var
 *
**/

function span_hopt( $opt_name, $parents_namespace , $default = false, $default_prefix = null ){
	if( $default_prefix !== null ){
		$option_prefix 	=	$default_prefix;
	} elseif( is_page() ){
		$option_prefix 	=	'pages_';
	} elseif( is_archive() ){ // tag, Category
		$option_prefix 	=	'archives_';
	} elseif( is_home() ){
		$option_prefix 	=	'blog_';
	} elseif( is_front_page() && ! is_home() ){
		$option_prefix 	=	'fpage_';
	} elseif( is_single() ){
		$option_prefix 	=	'single_';
	} elseif( is_author() ){
		$option_prefix 	=	'authors_';
	} elseif( is_search() ){
		$option_prefix 	=	'search_';
	} elseif( is_404() ){
		$hierarchy			=	'404_';
	} else { // general options is applied
		$option_prefix 	=	'general_';
		return span_opt( $option_prefix . $opt_name );
	}
	// Looping options names
	$opt_full	=	$option_prefix . $opt_name;
	$opt	= span_opt( $opt_full );
	// var_dump( $opt_name, $opt, $parents_namespace );
	if( is_array( $parents_namespace ) && ! empty( $parents_namespace ) ) {
		if( $opt === NULL ) {
			$default_prefix	=	$parents_namespace[0];
			array_shift( $parents_namespace );
			return span_hopt( $opt_name, $parents_namespace, $default, $default_prefix );
		}
	}
	return ( $opt !== NULL ? $opt : $default ); // if options exists
}

/**
 * span_tag_hierarchy()
 * get page hierarchy
 *
 * @access public
 * @return array
**/

function span_tag_hierarchy() {
	if( is_page() ){
		$hierarchy			=	array( 'general_' );
	} elseif( is_archive() ){ // tag, Category
		$hierarchy			=	array( 'blog_', 'general_' );
	} elseif( is_home() ){
		$hierarchy			=	array( 'general_' );
	} elseif( is_front_page() && ! is_home() ){
		$hierarchy			=	array( 'general_' );
	} elseif( is_single() ){
		$hierarchy			=	array( 'blog_', 'general_' );
	} elseif( is_author() ){
		$hierarchy			=	array( 'general_' );
	} elseif( is_search() ){
		$hierarchy			=	array( 'general_' );
	} elseif( is_404() ){
		$hierarchy			=	array( '404_' );
	} else { // general options is applied
		$hierarchy			=	array( 'general_' );
	}
	return $hierarchy;
}

/**
 * Span Skin
 * returns span skin collection
 *
 * @access public
 * @return array
**/

function span_skin_collection() {
	return array(
	 'red'  => array(
		  '#ee3733',
		  '#fff',
		  '#666',
	 ),
	 'jade'  => array(
		  '#0bb586',
		  '#fff',
		  '#666',
	 ),
	 'green'  => array(
		  '#94c523',
		  '#fff',
		  '#666',
	 ),
	 'blue'  => array(
		  '#0a9fd8',
		  '#fff',
		  '#666',
	 ),
	 'beige'  => array(
		  '#fdb655',
		  '#fff',
		  '#666',
	 ),
	 'cyan'  => array(
		  '#27bebe',
		  '#fff',
		  '#666',
	 ),
	 'orange'  => array(
		  '#f36510',
		  '#fff',
		  '#666',
	 ),
	 'peach'  => array(
		  '#f49237',
		  '#fff',
		  '#666',
	 ),
	 'pink'  => array(
		  '#f1505b',
		  '#fff',
		  '#666',
	 ),
	 'purple'  => array(
		  '#6a3da3',
		  '#fff',
		  '#666',
	 ),
	 'sky-blue'  => array(
		  '#38cbcb',
		  '#fff',
		  '#666',
	 ),
	 'yellow'  => array(
		  '#f8ba01',
		  '#fff',
		  '#666',
	 ),
);
}

/**
 * Body Length
**/

function span_body_width() {
	return ( span_hopt( 'sidebar_layout', span_tag_hierarchy(), 'right-sidebar' ) === 'no-sidebar' ) ? 12 : 9;
}

/**
 *
**/
function span_footer_debug( $name ) {
	var_dump( span_hopt( 'debug_mode', span_tag_hierarchy(), '1' ) );
	if( intval( span_hopt( 'debug_mode', span_tag_hierarchy(), '1' ) ) == true ):?>
      <div class="call-action call-action-boxed call-action-style1 clearfix" style="color:#333;margin:5px 0px 60px 0px;">
        <!-- Call Action Button -->
        <div class="button-side" style="margin-top:8px;float:none;">
        	<a href="<?php echo admin_url( 'widgets.php' );?>" class="btn btn-small btn-effect"><?php _e( 'Change Sidebar', 'span' );?></a>
        </div>
        <h2 class="primary"><strong>Span</strong> <?php _e( 'No widgets assigned to this sidebar', 'span' );?></h2>
        <p><?php echo sprintf( __( 'Log to your dashboard to assign a widget to this area : <strong>%s</strong>', 'span' ), $name );?></p>
      </div>
   <?php
	endif;
}