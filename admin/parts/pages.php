<?php
// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'Pages', 'span' ),
    'id'               => 'pages_options',
    'desc'             => __( 'General Options for Pages', 'span' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-file'
) );

global $option_namespace;
$option_namespace = 'pages';

require( get_template_directory() . '/admin/parts/_global-options.php' );
