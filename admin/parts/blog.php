<?php
// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'Blog', 'span' ),
    'id'               => 'blog_options',
    'desc'             => __( 'General Options for Blog', 'span' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-file-new'
) );

global $option_namespace;
$option_namespace = 'blog';

require( get_template_directory() . '/admin/parts/_global-options.php' );