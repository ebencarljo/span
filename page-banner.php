<?php if( intval( span_hopt( 'display_pbanner', span_tag_hierarchy(), '1' ) ) == true ):?>
<!-- Start Page Banner -->
<div class="page-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6">
      <?php
		if( is_home() && is_front_page() ){
			$title	=	get_bloginfo( 'name' );
		} elseif( is_category() ){
			$title	=	single_cat_title( '' , false );
		} elseif( is_tag() ){
			$title	=	sprintf( __( 'Tag "%s"' , 'span' ) , single_tag_title('', false) );
		} elseif( is_single() ){
			$title 	=	get_bloginfo( 'name' ); // single_post_title( '' , false );
		} elseif ( is_home() ){ // only blogpage
			$title	=	span_get_blogindex_title();
		} elseif( is_author() ){
			global $author;
	      $userdata = get_userdata($author);
			$title	=	ucwords( $userdata->display_name );
		} elseif( is_search() ){
			$title	=	sprintf( esc_html__( 'Search Results for: %s', 'span' ), '<span>' . get_search_query() . '</span>' );
		} elseif( is_404() ) {
			$title	=	__( 'Page Not Found', 'span' );
		} else { // check for page
			global $post;
			$title	=	esc_html( $post->post_title );
		}
		?>
      <h2><?php echo $title;?></h2>
      </div>
      <?php if( intval( span_hopt( 'display_breads', span_tag_hierarchy(), '1' ) ) == true ):?>
      <div class="col-md-6 col-sm-6 span-breadscrumbs">
      	<?php echo span_breadcrumbs();?>
      </div>
      <?php endif;?>
    </div>
  </div>
</div>
<!-- End Page Banner -->
<?php endif;?>