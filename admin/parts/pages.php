<?php
// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'Pages', 'span' ),
    'id'               => 'pages_options',
    'desc'             => __( 'General Options for Pages', 'span' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-file'
) );

span_opt_layout( 'pages' );

span_opt_footer( 'pages' );
