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

// Logo Details
Redux::setSection( $opt_name, array(
    'title'            => __( 'Advanced', 'span' ),
    'id'               => 'advanced_settings',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => __( 'You can change advanced setting.', 'span'),
    'fields'           => array(
		  array(
				 'id'       => 'general_debug_mode',
				 'type'     => 'switch', 
				 'title'    => __('Enable Debug Mode', 'span'),
				 'desc'		=>	__( 'This option enable debug mode, which will let you know the current state of menu, widgets, sidebars and many other useful informations.', 'span' ),
				 'default'  => true,
			),
			array(
				 'id'       => 'general_custom_css',
				 'type'     => 'ace_editor',
				 'title'    => __('Custom CSS Code', 'span'),
				 'mode'     => 'css',
				 'theme'    => 'monokai',
				 'desc'     => 'Improve Span style by adding your custom CSS changes.',
				 'default'  => "/** Your Code here... **/"
			),
			array(
				'id'       => 'general_ga_tracking_code',
				'type'     => 'textarea',
				'title'    => __('Google Analaytics Tracking Code', 'span'),
				'desc'     => __('You can provide your Google Analytics in order to track user visit.', 'span'),
				'default'  => ''
			)
    )
) );