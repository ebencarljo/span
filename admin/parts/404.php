<?php
// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'            => __( '404 Page', 'span' ),
    'id'               => '404_options',
    'desc'             => __( 'General Options for 404 page', 'span' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-minus-sign'
) );

global $option_namespace;
$option_namespace = '404';

require( get_template_directory() . '/admin/parts/_global-options.php' );