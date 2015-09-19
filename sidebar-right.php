<?php if( span_hopt( 'sidebar_layout', span_tag_hierarchy(), 'right-sidebar' ) === 'right-sidebar' ):?>
<?php
// Get Custom sidebar or default, if not defined
$sidebar				=	span_hopt( 'right_sidebar', span_tag_hierarchy(), 'right-sidebar' );
?>
<aside id="sidebar" class="col-md-3 right-sidebar"> 
	<?php dynamic_sidebar( $sidebar );?>
</aside>
<?php endif;?>