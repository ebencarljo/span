<?php if( span_hopt( 'sidebar_layout', span_tag_hierarchy(), 'right-sidebar' ) === 'left-sidebar' ):?>
<?php
// Get Custom sidebar or default, if not defined
$sidebar				=	span_hopt( 'left_sidebar', span_tag_hierarchy(), 'left-sidebar' );
?>
<aside id="sidebar" class="col-md-3 left-sidebar"> 
	<?php dynamic_sidebar( $sidebar );?>
</aside>
<?php endif;?>