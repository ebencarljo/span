<?php
// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'            => __( 'General Options', 'span' ),
    'id'               => 'general_options',
    'desc'             => __( 'General Options for Span Theme', 'span' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-home'
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Top Bar', 'span' ),
    'id'               => 'general_topbar',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => __( 'You can order social profile link. If a social profile field is empty, it won\'t be displayed', 'span'),
    'fields'           => array(
        array(
            'id'       => 'social_profiles_links',
            'type'     => 'sortable',
            'title'    => __('Provide links for your social profiles', 'span'),
            'subtitle' => __('Define and reorder these however you want.', 'span'),
            // 'desc'     => __('.', 'redux-framework-demo'),
            'mode'     => 'text',
            'options' => array( 
                'facebook'      =>  '#Facebook', 
                'google-plus'    =>  '#GooglePlus', 
                'twitter'       =>  '#Twitter', 
                'pinterest'     =>  '#Pinterest', 
                'dribbble'      =>  '#Dribbble', 
                'linkedin'      =>  '#LinkedIn' 
            ),
        ),
        array(
            'id'       => 'top_bar_details_links',
            'type'     => 'sortable',
            'title'    => __('Provide links for top bar details', 'span'),
            'subtitle' => __('Define and reorder these however you want.', 'span'),
            // 'desc'     => __('.', 'redux-framework-demo'),
            'mode'     => 'text',
            'options' => array( 
                'phone'      =>  '#Phone', 
                'email'     =>  '#Email', 
                'location'    =>  '#Location', 
            ),
        )
    )
) );

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

// Footer Details
Redux::setSection( $opt_name, array(
    'title'            => __( 'Footer', 'span' ),
    'id'               => 'general_footer',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => __( 'This section let you customize footer options.', 'span'),
    'fields'           => array(
        array(
            'id'       => 'footer_copyright',
            'type'     => 'textarea', 
            'title'    => __('Footer Copyright', 'span'),
            'desc'     => __('You can set custom copyright on footer.', 'span'),
            // 'subtitle' => __('Choose a file to upload from your media library', 'span'),
        ),
        array(
            'id'       => 'footer_palette',
            'type'     => 'palette',
            'title'    => __( 'Footer palette', 'span' ),
            'subtitle' => __( 'You can set custom palette for footer.', 'span' ),
            'desc'     => __( 'If you don\'t want to spend time trying to find the better combinasion, you can use predefined palette.', 'span' ),
            'default'  => 'red',
            'palettes' => span_color_palette( 'footer' )
        ),
        array(
            'id'       => 'footer_color_type',
            'type'     => 'switch', 
            'title'    => __('Color Type', 'span'),
            'subtitle' => __('You can use Palette or Custom Color.', 'span'),
            'default'  => true,
            'on'      => __( 'Use Palette' , 'span' ),
            'off'     => __( 'Use Custom colors', 'span' )
        ),
        array(
            'id'       => 'footer_bg_color',
            'type'     => 'color',
            'title'    => __('Footer Background Color', 'span'), 
            'subtitle' => __('Pick a color for footer background.', 'span'),
            'default'  => '#172029',
            'validate' => 'color',
        ),
        array(
            'id'       => 'footer_text_color',
            'type'     => 'color',
            'title'    => __('Footer Text Color', 'span'), 
            'subtitle' => __('Pick a color for footer text.', 'span'),
            'default'  => '#CCC',
            'validate' => 'color',
        ),
        array(
            'id'       => 'footer_l ink_color',
            'type'     => 'color',
            'title'    => __('Footer link Color', 'span'), 
            'subtitle' => __('Pick a color for footer link.', 'span'),
            'default'  => '#172029',
            'validate' => 'color',
        ),
        array(
            'id'       => 'footer_link_hover',
            'type'     => 'color',
            'title'    => __('Footer Link Color on Hover', 'span'), 
            'subtitle' => __('Pick a color for footer link on hover.', 'span'),
            'default'  => '#172029',
            'validate' => 'color',
        ),
        array(
            'id'        => 'footer_padding',
            'type'      => 'slider',
            'title'     => __('Footer Padding', 'span'),
            'subtitle'  => __('This let you enhance or reduce footer height.', 'span'),
            'desc'      => __('You can set up to 100px as padding.', 'span'),
            "default"   => 15,
            "min"       => 5,
            "step"      => 5,
            "max"       => 50,
            'display_value' => 'padding'
        ),
        array(
            'id'        => 'footer_text_size',
            'type'      => 'slider',
            'title'     => __('Footer Text Size', 'span'),
            'subtitle'  => __('This let you enhance or reduce footer text size.', 'span'),
            'desc'      => __('You can set up to 100px as height.', 'span'),
            "default"   => 15,
            "min"       => 10,
            "step"      => 1,
            "max"       => 50,
            'display_value' => 'size'
        ),
		  array(
				'id'   =>'divider_1',
				'desc' => __('Divider', 'span'),
				'type' => 'divide',
			),
			array(
				'id'       => 'ga_tracking_code',
				'type'     => 'textarea',
				'title'    => __('Google Analaytics Tracking Code', 'span'),
				'desc'     => __('You can provide your Google Analytics in order to track user visit.', 'span'),
				'default'  => ''
			)
    )
) );

// Disabled
// Under Construct Mode
/**
Redux::setSection( $opt_name, array(
    'title'            => __( 'Underconstruct Mode', 'span' ),
    'id'               => 'underconstruct_mode',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => __( 'You can enable underconstruct mode to hide you work to people, but by giving access to specific user role.', 'span'),
    'fields'           => array(
        array(
            'id'       => 'enable_underconstruct',
            'type'     => 'switch', 
            'title'    => __('Enable Underconstruct mode', 'span'),
            'subtitle' => __('Clic "yes" to enable underconstruct mode', 'span'),
            'default'  => false,
        )
    )
) );
**/

Redux::setSection( $opt_name, array(
    'title'            => __( 'Layout and Design', 'span' ),
    'id'               => 'general_layout_and_design',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => __( 'You can change the layout and the design option here.', 'span'),
    'fields'           => array(
	 	  array(
				 'id'       => 'general_layout',
				 'type'     => 'button_set',
					'title'    => __('Layout', 'span'),
					'subtitle' => __('Set General Layout for your website.', 'span'),
				'desc'	  => __( 'This settings can be overrided by more specific settings such as those applyied on blog.', 'span' ),
				 //Must provide key => value pairs for options
				 'options' => array(
					  'boxed-page' => __( 'Boxed version', 'span' ), 
					  'wide-page' => __( 'Wide version', 'span' )
				  ), 
				 'default' => 'full'
			)
    )
) );