<?php
/**
 * Host reusable options field 
**/

function span_opt_layout( $name ){
	$patterns	=	array();
	for( $i = 1; $i < 15; $i++ ){
		$patterns[ get_template_directory_uri() . '/images/patterns/' . $i . '.png' ]	=	array(
			'alt'	=>	'Pattern ' . $i,
			'img'	=>	get_template_directory_uri() . '/images/patterns/' . $i . '.png'
		);
	}
	
	Redux::setSection( SPAN_OPT_NAME, array(
		 'title'            => __( 'Layout and Skin', 'span' ),
		 'id'               => $name . '_layout_and_design',
		 'subsection'       => true,
		 'customizer_width' => '450px',
		 'desc'             => __( 'You can change the layout and the design option here.', 'span'),
		 'fields'           => array(
			  array(
					 'id'       => $name . '_layout',
					 'type'     => 'button_set',
						'title'    => __( 'Layout', 'span'),
						'subtitle' => sprintf( __( 'You can set %s Layout for your website.', 'span') , ucwords( $name ) ),
					'desc'	  => __( 'This settings can be overrided by more specific settings such as those applied on blog.', 'span' ),
					 'options' => array(
						  'boxed-page' => __( 'Boxed version', 'span' ), 
						  'wide-page' => __( 'Wide version', 'span' )
					  ), 
					 'default' => 'full'
				),
				array(
					 'id'       => $name . '_offset_background',
					 'type'     => 'image_select',
					 'title'    => sprintf( __('Offset Background for %s', 'span'), $name ), 
					 'subtitle' => __('Select an image you want to apply as background.', 'span'),
					 'options'  => $patterns,
					 'default' => '2',
					 'width'		=>	50,
					 'height'	=>	50
				),
				array(
            'id'       => $name . '_color_scheme',
            'type'     => 'palette',
            'title'    => __( 'Color Scheme', 'span' ),
            'desc'     => sprintf( __( 'Set a color scheme for %s', 'span' ), ucwords( $name ) ),
            'default'  => 'red',
            'palettes' => span_skin_collection()
        )
		 )
	) );
}

/**
 * Overall Footer Options
**/

function span_opt_footer( $namespace ) {
	// Hiding options
	$fields			=		array();
	
	if( $namespace === 'general' ): // displayed once on General Options
		$fields[]		=		array(
			'id'       => $namespace . '_footer_copyright',
			'type'     => 'textarea', 
			'title'    => __('Footer Copyright', 'span'),
			'desc'     => __('You can set custom copyright on footer.', 'span'),
		);
	 endif;
	 
	 $fields[]			=	array(
		 'id'       => $namespace . '_footer_menu',
		 'type'     => 'select',
		 'title'    => __('Select a menu', 'span'), 
		 'desc'     => __('Choose a menu you want to display on footer. Delete menu to use default menu saved on "<strong>Appearence > Menus</strong>".', 'span'),
		 'data'		=>	'menus'
	);
	 
	$fields[]		=	  array(
			'id'       => $namespace . '_footer_palette',
			'type'     => 'palette',
			'title'    => __( 'Footer palette', 'span' ),
			'subtitle' => __( 'You can set custom palette for footer.', 'span' ),
			'desc'     => __( 'If you don\'t want to spend time trying to find the better combinasion, you can use predefined palette.', 'span' ),
			'default'  => 'red',
			'palettes' => span_color_palette( 'footer' )
	  );
	$fields[]		=	  array(
			'id'       => $namespace . '_footer_color_type',
			'type'     => 'switch', 
			'title'    => __('Color Type', 'span'),
			'subtitle' => __('You can use Palette or Custom Color.', 'span'),
			'default'  => true,
			'on'      => __( 'Use Palette' , 'span' ),
			'off'     => __( 'Use Custom colors', 'span' )
	  );
	$fields[]		=	  array(
			'id'       => $namespace . '_footer_bg_color',
			'type'     => 'color',
			'title'    => __('Footer Background Color', 'span'), 
			'subtitle' => __('Pick a color for footer background.', 'span'),
			'default'  => '#172029',
			'validate' => 'color',
	  );
	$fields[]		=	  array(
			'id'       => $namespace . '_footer_text_color',
			'type'     => 'color',
			'title'    => __('Footer Text Color', 'span'), 
			'subtitle' => __('Pick a color for footer text.', 'span'),
			'default'  => '#CCC',
			'validate' => 'color',
	  );
	$fields[]		=		array(
			'id'       => $namespace . '_footer_link_color',
			'type'     => 'color',
			'title'    => __('Footer link Color', 'span'), 
			'subtitle' => __('Pick a color for footer link.', 'span'),
			'default'  => '#172029',
			'validate' => 'color',
	  );
	$fields[]		= 	  array(
			'id'       => $namespace . '_footer_link_hover',
			'type'     => 'color',
			'title'    => __('Footer Link Color on Hover', 'span'), 
			'subtitle' => __('Pick a color for footer link on hover.', 'span'),
			'default'  => '#172029',
			'validate' => 'color',
	  );
	$fields[]		=	  array(
		'id'        => $namespace . '_footer_padding',
		'type'      => 'slider',
		'title'     => __('Footer Padding', 'span'),
		'subtitle'  => __('This let you enhance or reduce footer height.', 'span'),
		'desc'      => __('You can set up to 100px as padding.', 'span'),
		"default"   => 15,
		"min"       => 5,
		"step"      => 5,
		"max"       => 50,
		'display_value' => 'padding'
  );
	$fields[]		=	  array(
		'id'        => $namespace . '_footer_text_size',
		'type'      => 'slider',
		'title'     => __('Footer Text Size', 'span'),
		'subtitle'  => __('This let you enhance or reduce footer text size.', 'span'),
		'desc'      => __('You can set up to 100px as height.', 'span'),
		"default"   => 15,
		"min"       => 10,
		"step"      => 1,
		"max"       => 50,
		'display_value' => 'size'
  );
	// Footer Details
	Redux::setSection( SPAN_OPT_NAME, array(
		 'title'            => __( 'Footer', 'span' ),
		 'id'               => $namespace . '_footer',
		 'subsection'       => true,
		 'customizer_width' => '450px',
		 'desc'             => sprintf( __( 'This section let you customize %s footer options.', 'span'), ucwords( $namespace ) ),
		 'fields'           => $fields
	) );
}

/**
 * Top Bar
**/

function span_opt_topbar( $namespace ) {
	$fields		=	array();
	if( $namespace === 'general' ) { // only used by general
	$fields[]	=	array(
            'id'       => 'social_profiles_links',
            'type'     => 'sortable',
            'title'    => __('Provide links for your social profiles', 'span'),
            'subtitle' => __('Define and reorder these however you want.', 'span'),
            // 'desc'     => __('.', 'span'),
            'mode'     => 'text',
            'options' => array( 
                'facebook'      =>  '#Facebook', 
                'google-plus'    =>  '#GooglePlus', 
                'twitter'       =>  '#Twitter', 
                'pinterest'     =>  '#Pinterest', 
                'dribbble'      =>  '#Dribbble', 
                'linkedin'      =>  '#LinkedIn' 
            ),
        );
	$fields[]	=	array(
            'id'       => 'top_bar_details_links',
            'type'     => 'sortable',
            'title'    => __('Provide links for top bar details', 'span'),
            'subtitle' => __('Define and reorder these however you want.', 'span'),
            // 'desc'     => __('.', 'span'),
            'mode'     => 'text',
            'options' => array( 
                'phone'      =>  '#Phone', 
                'email'     =>  '#Email', 
                'location'    =>  '#Location', 
            ),
        );
	}
	
	// Enable
	$fields[]	=	array(
		'id'       => $namespace . '_display_topbar',
		'type'     => 'switch', 
		'title'    => __('Display topbar', 'span'), 
		'desc'     => __('This option let you hide topbar.', 'span'),
		'default'  => true
	);
	
	// Use Skin
	$fields[]	=	array(
		 'id'       => $namespace . '_use_skin',
		 'type'     => 'switch', 
		 'title'    => __('Use Skin Color', 'span'),
		 'desc'		=>	__( 'You can use main skin color on topbar. Else Dark style is used.', 'span' ),
		 'default'  => true,
	);
	// Loading Option
	Redux::setSection( SPAN_OPT_NAME, array(
		 'title'            => __( 'Top Bar', 'span' ),
		 'id'               => $namespace . '_topbar',
		 'subsection'       => true,
		 'customizer_width' => '450px',
		 'desc'             => __( 'You can order social profile link. If a social profile field is empty, it won\'t be displayed', 'span'),
		 'fields'           => $fields
	) );	
}

/**
 * Header Options
**/

function span_opt_header( $namespace ) {
	// Displays Header
	$fields[]	=	array(
		 'id'       => $namespace . '_display_header',
		 'type'     => 'switch', 
		 'title'    => __('Display Header', 'span'),
		 'default'  => true,
	);
	// mobile menu
	$fields[]			=	array(
		 'id'       => $namespace . '_mobile_menu',
		 'type'     => 'select',
		 'title'    => __('Select a mobile menu', 'span'), 
		 'desc'     => __('This menu will be displayed only on mobile device.<br>If this field is empty default menu defined on "<strong>Appreance > Menus</strong>" will be used instead.', 'span'),
		 'data'		=>	'menus'
	);
	// desktop mobile
	$fields[]			=	array(
		 'id'       => $namespace . '_desktop_menu',
		 'type'     => 'select',
		 'title'    => __('Select a desktop menu', 'span'), 
		 'desc'     => __('This menu will be displayed only on desktop.<br>If this field is empty default menu defined on "<strong>Appreance > Menus</strong>" will be used instead.', 'span'),
		 'data'		=>	'menus'
	);
	
	Redux::setSection( SPAN_OPT_NAME, array(
		 'title'            => __( 'Header', 'span' ),
		 'id'               => $namespace . '_header',
		 'subsection'       => true,
		 'customizer_width' => '450px',
		 'desc'             => sprintf( __( 'This hold options for %s header options', 'span'), ucwords( $namespace ) ),
		 'fields'           => $fields
	) );
}

/**
 * Sidebar Layout
**/

function span_opt_sidebar( $namespace ) {
	$fields		=	array();
	$fields[]	=	array(
		'id'       => $namespace . '_sidebar_layout',
		'type'     => 'select',
		'title'    => __( 'Layout', 'span'),
		'subtitle' => sprintf( __( 'You can set %s sidebar.', 'span') , ucwords( $namespace ) ),
		'desc'	  => __( 'This settings can be overrided by more specific settings such as those applied on single items.', 'span' ),
		'options' => array(
			'left-sidebar' 	=> __( 'Left Sidebar', 'span' ), 
			'right-sidebar' 	=> __( 'Right Sidebar', 'span' ),
			'no-sidebar' 	=> __( 'No Sidebar', 'span' )
		), 
		'default' => 'right-sidebar'
	);
	
	if( $namespace === 'pages' ) {
		// Displays page title
		$fields[]	=	array(
			 'id'       => $namespace . '_display_page_title',
			 'type'     => 'switch', 
			 'title'    => __('Display Page Title', 'span'),
			 'desc'		=>	__( 'This option let you disable inner content page title.', 'span' ),
			 'default'  => true,
		);
	}
	
	// Menu
	$fields[]	=	array(
		 'id'       => $namespace . '_left_sidebar',
		 'type'     => 'select', 
		 'title'    => __('Select Left Sidebar Sidebar', 'span'),
		 'desc'		=>	__( 'This option let you choose a custom sidebar for left sidebar. If this fields is left blank, default menu defined on <strong>"Appearance > Widgets"</strong> will be used instead.', 'span' ),
		 'data'  	=> 'sidebar',
	);
	
	$fields[]	=	array(
		 'id'       => $namespace . '_right_sidebar',
		 'type'     => 'select', 
		 'title'    => __('Select Right Sidebar Sidebar', 'span'),
		 'desc'		=>	__( 'This option let you choose a custom sidebar for right sidebar. If this fields is left blank, default menu defined on <strong>"Appearance > Widgets"</strong> will be used instead.', 'span' ),
		 'data'  => 'sidebar',
	);
	
	Redux::setSection( SPAN_OPT_NAME, array(
		 'title'            => __( 'Sidebar', 'span' ),
		 'id'               => $namespace . '_sidebar',
		 'subsection'       => true,
		 'customizer_width' => '450px',
		 'desc'             => sprintf( __( 'This hold options for %s sidebar', 'span'), ucwords( $namespace ) ),
		 'fields'           => $fields
	) );	
}

/**
 * Page Banner
**/

function span_opt_pheader( $namespace ) {
	// Displays Header
	$fields[]	=	array(
		 'id'       => $namespace . '_display_pbanner',
		 'type'     => 'switch', 
		 'title'    => __('Display Page Banner', 'span'),
		 'default'  => true,
	);
	
	// BreadScrubms
	$fields[]	=	array(
		 'id'       => $namespace . '_display_breads',
		 'type'     => 'switch', 
		 'title'    => __('Display Breadscrumbs', 'span'),
		 'default'  => true,
	);
	
	Redux::setSection( SPAN_OPT_NAME, array(
		 'title'            => __( 'Page banner', 'span' ),
		 'id'               => $namespace . '_page_banner',
		 'subsection'       => true,
		 'customizer_width' => '450px',
		 'desc'             => sprintf( __( 'This hold options for %s page banner', 'span'), ucwords( $namespace ) ),
		 'fields'           => $fields
	) );
}

/**
 * Post Meta
**/

function span_opt_post( $namespace ) {
	// Meta
	$fields		=	array();
	$fields[]	=	array(
		 'id'       => $namespace . '_post_meta',
		 'type'     => 'checkbox',
		 'title'    => __('Post Meta', 'span'), 
		 'desc'     => __('You can enable or disable a meta according to your needs.', 'span'),
	 
		 //Must provide key => value pairs for multi checkbox options
		 'options'  => array(
			  'date' 		=> __( 'Display date', 'span' ),
			  'category'	=> __( 'Display category', 'span' ),
			  'tag' 			=> __( 'Display tag (on single post)', 'span' ),
			  'like' 		=> __( 'Display like', 'span' ), // premium feature
			  'comments'	=> __( 'Display comments', 'span' ),
			  'author' 		=> __( 'Display author', 'span' ),
		 ),
	 
		 //See how default has changed? you also don't need to specify opts that are 0.
		 'default' 			=> array(
			  'date' 		=> '1', 
			  'category' 	=> '1', 
			  'tag' 			=> '1',
			  'like'			=>	'1',
			  'comments'	=>	'1',
			  'author'		=>	'1'
		 )
	);
	
	// Share
	$fields[]	=	array(
		 'id'       => $namespace . '_post_share',
		 'type'     => 'checkbox',
		 'title'    => __('Social Share', 'span'), 
		 'desc'     => __('Pick at least one service to enable post share feature.', 'span'),
	 
		 //Must provide key => value pairs for multi checkbox options
		 'options'  => array(
			  'facebook'	=> __( 'Facebook', 'span' ), // premium feature
			  'twitter' 	=> __( 'Twitter', 'span' ),
			  'google' 		=> __( 'Google+', 'span' ),
			  'linkedin' 	=> __( 'LinkedIn', 'span' ),
		 ),
	 
		 //See how default has changed? you also don't need to specify opts that are 0.
		 'default' => array(
			  'facebook' 	=> '0', 
			  'twitter' 	=> '1', 
			  'google' 		=> '1',
			  'linkedin'	=>	'1',
		 )
	);
	
	Redux::setSection( SPAN_OPT_NAME, array(
		 'title'            => __( 'Post Options', 'span' ),
		 'id'               => $namespace . '_post_options',
		 'subsection'       => true,
		 'customizer_width' => '450px',
		 'desc'             => sprintf( __( 'This hold options for %s post', 'span'), ucwords( $namespace ) ),
		 'fields'           => $fields
	) );
}
