<?php
// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'Blog', 'span' ),
    'id'               => 'blog_options',
    'desc'             => __( 'General Options for Blog', 'span' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-file-new'
) );

span_opt_topbar( 'blog' );

span_opt_header( 'blog' );

span_opt_footer( 'blog' );

span_opt_layout( 'blog' );