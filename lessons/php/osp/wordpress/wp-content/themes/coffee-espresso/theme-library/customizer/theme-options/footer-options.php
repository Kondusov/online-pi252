<?php
/**
 * Footer Options
 *
 * @package coffee_espresso
 */

$wp_customize->add_section(
	'coffee_espresso_footer_options',
	array(
		'panel' => 'coffee_espresso_theme_options',
		'title' => esc_html__( 'Footer Options', 'coffee-espresso' ),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_footer_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_footer_separators', array(
	'label' => __( 'Footer Settings', 'coffee-espresso' ),
	'section' => 'coffee_espresso_footer_options',
	'settings' => 'coffee_espresso_footer_separators',
)));

// Footer Section - Enable Section.
$wp_customize->add_setting(
	'coffee_espresso_enable_footer_section',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_footer_section',
		array(
			'label'    => esc_html__( 'Show / Hide Footer', 'coffee-espresso' ),
			'section'  => 'coffee_espresso_footer_options',
			'settings' => 'coffee_espresso_enable_footer_section',
		)
	)
);

// column // 
$wp_customize->add_setting(
	'coffee_espresso_footer_widget_column',
	array(
        'default'			=> '4',
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'coffee_espresso_sanitize_select',
		
	)
);	

$wp_customize->add_control(
	'coffee_espresso_footer_widget_column',
	array(
	    'label'   		=> __('Select Widget Column','coffee-espresso'),
		'description' => __('Note: Default footer widgets are shown. Add your preferred widgets in (Appearance > Widgets > Footer) to see changes.', 'coffee-espresso'),
	    'section' 		=> 'coffee_espresso_footer_options',
		'type'			=> 'select',
		'choices'        => 
		array(
			'' => __( 'None', 'coffee-espresso' ),
			'1' => __( '1 Column', 'coffee-espresso' ),
			'2' => __( '2 Column', 'coffee-espresso' ),
			'3' => __( '3 Column', 'coffee-espresso' ),
			'4' => __( '4 Column', 'coffee-espresso' )
		) 
	) 
);

//  BG Color // 
$wp_customize->add_setting('footer_background_color_setting', array(
    'default' => '#000',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_background_color_setting', array(
    'label' => __('Footer Background Color', 'coffee-espresso'),
    'section' => 'coffee_espresso_footer_options',
)));

// Footer Background Image Setting
$wp_customize->add_setting('footer_background_image_setting', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_background_image_setting', array(
    'label' => __('Footer Background Image', 'coffee-espresso'),
    'section' => 'coffee_espresso_footer_options',
)));

// Footer Background Attachment
$wp_customize->add_setting(
	'coffee_espresso_footer_image_attachment_setting',
	array(
		'default'=> 'scroll',
		'sanitize_callback' => 'coffee_espresso_sanitize_choices'
	)
);

$wp_customize->add_control(
	'coffee_espresso_footer_image_attachment_setting',
	array(
		'type' => 'select',
		'label' => __('Footer Background Attatchment','coffee-espresso'),
		'choices' => array(
			'fixed' => __('fixed','coffee-espresso'),
			'scroll' => __('scroll','coffee-espresso'),
		),
		'section'=> 'coffee_espresso_footer_options',
  	)
);

//Footer Image Position
$wp_customize->add_setting(
	'coffee_espresso_footer_img_position_setting',
	array(
        'default'			=> 'center center',
		'capability'     	=> 'edit_theme_options',
		'sanitize_callback' => 'coffee_espresso_sanitize_choices',
		
	)
);	

$wp_customize->add_control(
	'coffee_espresso_footer_img_position_setting',
	array(
		'label'   		=> __('Footer Image Position','coffee-espresso'),
	    'section' 		=> 'coffee_espresso_footer_options',
		'type'			=> 'select',
		'choices'       => 
		array(
			'center center'   => __( 'Center', 'coffee-espresso' ),
			'center top'   	  => __( 'Top', 'coffee-espresso' ),
			'center bottom'   => __( 'Bottom', 'coffee-espresso' ),
		) 
	) 
);

$wp_customize->add_setting('footer_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

// Add Footer Text Transform Control
$wp_customize->add_control('footer_text_transform', array(
    'label' => __('Footer Heading Text Transform', 'coffee-espresso'),
    'section' => 'coffee_espresso_footer_options',
    'settings' => 'footer_text_transform',
    'type' => 'select',
    'choices' => array(
        'none' => __('None', 'coffee-espresso'),
        'capitalize' => __('Capitalize', 'coffee-espresso'),
        'uppercase' => __('Uppercase', 'coffee-espresso'),
        'lowercase' => __('Lowercase', 'coffee-espresso'),
    ),
));

// Footer Heading Alignment
$wp_customize->add_setting(
	'coffee_espresso_footer_header_align',
	array(
		'default' 			=> 'left',
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'coffee_espresso_footer_header_align',
	array(
		'label' => __('Footer Heading Alignment ','coffee-espresso'),
		'section' => 'coffee_espresso_footer_options',
		'type'			=> 'select',
		'choices' => 
		array(
			'left' => __('Left','coffee-espresso'),
			'right' => __('Right','coffee-espresso'),
			'center' => __('Center','coffee-espresso'),
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_copyright_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_copyright_separators', array(
	'label' => __( 'Copyright Settings', 'coffee-espresso' ),
	'section' => 'coffee_espresso_footer_options',
	'settings' => 'coffee_espresso_copyright_separators',
)));

// Copyright Section - Enable Section.
$wp_customize->add_setting(
	'coffee_espresso_enable_copyright_section',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_copyright_section',
		array(
			'label'    => esc_html__( 'Show / Hide Copyright', 'coffee-espresso' ),
			'section'  => 'coffee_espresso_footer_options',
			'settings' => 'coffee_espresso_enable_copyright_section',
		)
	)
);

$wp_customize->add_setting(
	'coffee_espresso_footer_copyright_text',
	array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	'coffee_espresso_footer_copyright_text',
	array(
		'label'    => esc_html__( 'Copyright Text', 'coffee-espresso' ),
		'section'  => 'coffee_espresso_footer_options',
		'settings' => 'coffee_espresso_footer_copyright_text',
		'type'     => 'textarea',
	)
);

//Copyright Alignment
$wp_customize->add_setting(
	'coffee_espresso_footer_bottom_align',
	array(
		'default' 			=> 'center',
		'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'coffee_espresso_footer_bottom_align',
	array(
		'label' => __('Copyright Alignment ','coffee-espresso'),
		'section' => 'coffee_espresso_footer_options',
		'type'			=> 'select',
		'choices' => 
		array(
			'left' => __('Left','coffee-espresso'),
			'right' => __('Right','coffee-espresso'),
			'center' => __('Center','coffee-espresso'),
		),
	)
);

//Copyright Font Size
$wp_customize->add_setting( 
	'coffee_espresso_copyright_font_size', 
	array(
		'default'           => 16,
		'sanitize_callback' => 'absint',
	)
);

$wp_customize->add_control( 'coffee_espresso_copyright_font_size', 
	array(
		'type'        => 'number',
		'section'     => 'coffee_espresso_footer_options',
		'label'       => __( 'copyright Font Size ', 'coffee-espresso' ),
		'input_attrs' => 
		array(
			'min'  => 10,
			'max'  => 100,
			'step' => 1,
		),
	)
);

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_scroll_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_scroll_separators', array(
	'label' => __( 'Scroll Top Settings', 'coffee-espresso' ),
	'section' => 'coffee_espresso_footer_options',
	'settings' => 'coffee_espresso_scroll_separators',
)));

// Footer Options - Scroll Top.
$wp_customize->add_setting(
	'coffee_espresso_scroll_top',
	array(
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
		'default'           => true,
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_scroll_top',
		array(
			'label'   => esc_html__( 'Enable Scroll Top Button', 'coffee-espresso' ),
			'section' => 'coffee_espresso_footer_options',
		)
	)
);
// icon // 
$wp_customize->add_setting(
	'coffee_espresso_scroll_btn_icon',
	array(
        'default' => 'fas fa-chevron-up',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
		
	)
);	

$wp_customize->add_control(new Coffee_Espresso_Change_Icon_Control($wp_customize, 
	'coffee_espresso_scroll_btn_icon',
	array(
	    'label'   		=> __('Scroll Top Icon','coffee-espresso'),
	    'section' 		=> 'coffee_espresso_footer_options',
		'iconset' => 'fa',
	))  
);


$wp_customize->add_setting( 'coffee_espresso_scroll_top_position', array(
    'default'           => 'bottom-right',
    'sanitize_callback' => 'coffee_espresso_sanitize_scroll_top_position',
) );

// Add control for Scroll Top Button Position
$wp_customize->add_control( 'coffee_espresso_scroll_top_position', array(
    'label'    => __( 'Scroll Top Button Position', 'coffee-espresso' ),
    'section'  => 'coffee_espresso_footer_options',
    'settings' => 'coffee_espresso_scroll_top_position',
    'type'     => 'select',
    'choices'  => array(
        'bottom-right' => __( 'Bottom Right', 'coffee-espresso' ),
        'bottom-left'  => __( 'Bottom Left', 'coffee-espresso' ),
        'bottom-center'=> __( 'Bottom Center', 'coffee-espresso' ),
    ),
) );

$wp_customize->add_setting( 'coffee_espresso_scroll_top_shape', array(
    'default'           => 'box',
    'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'coffee_espresso_scroll_top_shape', array(
    'label'    => __( 'Scroll to Top Button Shape', 'coffee-espresso' ),
    'section'  => 'coffee_espresso_footer_options',
    'settings' => 'coffee_espresso_scroll_top_shape',
    'type'     => 'radio',
    'choices'  => array(
        'box'        => __( 'Box', 'coffee-espresso' ),
        'curved-box' => __( 'Curved Box', 'coffee-espresso' ),
        'circle'     => __( 'Circle', 'coffee-espresso' ),
    ),
) );