<?php
// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'Authors', 'span' ),
    'id'               => 'authors_options',
    'desc'             => __( 'General Options for Authors', 'span' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-adult'
) );

span_opt_layout( 'authors' );