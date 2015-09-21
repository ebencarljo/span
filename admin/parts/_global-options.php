<?php
global $option_namespace;
span_opt_topbar( $option_namespace );

span_opt_header( $option_namespace );

span_opt_footer( $option_namespace );

span_opt_layout( $option_namespace );

span_opt_sidebar( $option_namespace );

span_opt_pheader( $option_namespace );

if( in_array( $option_namespace, array( 'blog', 'archives', 'authors', 'search' ) ) ) {
	span_opt_post( $option_namespace );
}