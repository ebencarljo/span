<?php
// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'General Options', 'span' ),
    'id'               => 'general_options',
    'desc'             => __( 'General Options for Span Theme', 'span' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-home'
) );

global $option_namespace;
$option_namespace = 'general';

require( get_template_directory() . '/admin/parts/_global-options.php' );

// Logo Details
Redux::setSection( $opt_name, array(
    'title'            => __( 'Logo', 'span' ),
    'id'               => 'logo_details',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => __( 'You can choose specific file as logo for you site for different devices.', 'span'),
    'fields'           => array(
        array(
            'id'       => 'desktop_logo',
            'type'     => 'media', 
            'url'      => true,
            'title'    => __('Desktop Logo', 'span'),
            'desc'     => __('You can upload a media to define as logo for desktop and laptops', 'span'),
            'subtitle' => __('Choose a file to upload from your media library', 'span'),
            'default'  => array(
                'url'=> get_template_directory_uri() . '/images/logo.png'
            ),
        )
    )
) );