<?php
// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'Search Page', 'span' ),
    'id'               => 'search_options',
    'desc'             => __( 'General Options for search page', 'span' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-search'
) );

global $option_namespace;
$option_namespace = 'search';

require( get_template_directory() . '/admin/parts/_global-options.php' );