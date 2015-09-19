<?php
// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'Archives', 'span' ),
    'id'               => 'archives_options',
    'desc'             => __( 'General Options for archives', 'span' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-folder-open'
) );

global $option_namespace;
$option_namespace = 'archives';

require( get_template_directory() . '/admin/parts/_global-options.php' );