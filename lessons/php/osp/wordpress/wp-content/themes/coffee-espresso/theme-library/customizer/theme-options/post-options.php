<?php
/**
 * Post Options
 *
 * @package coffee_espresso
 */

$wp_customize->add_section(
	'coffee_espresso_post_options',
	array(
		'title' => esc_html__( 'Post Options', 'coffee-espresso' ),
		'panel' => 'coffee_espresso_theme_options',
	)
);

// ---------------------------------------- PAGINATION ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_pagination_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_pagination_separator', array(
	'label' => __( 'Enable / Disable Pagination Section', 'coffee-espresso' ),
	'section' => 'coffee_espresso_post_options',
	'settings' => 'coffee_espresso_pagination_separator',
) ) );

// Pagination - Enable Pagination.
$wp_customize->add_setting(
	'coffee_espresso_enable_pagination',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_pagination',
		array(
			'label'    => esc_html__( 'Enable Pagination', 'coffee-espresso' ),
			'section'  => 'coffee_espresso_post_options',
			'settings' => 'coffee_espresso_enable_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Type.
$wp_customize->add_setting(
	'coffee_espresso_pagination_type',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'coffee_espresso_sanitize_select',
	)
);

$wp_customize->add_control(
	'coffee_espresso_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Type', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_post_options',
		'settings'        => 'coffee_espresso_pagination_type',
		'active_callback' => 'coffee_espresso_is_pagination_enabled',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'coffee-espresso' ),
			'numeric' => __( 'Numeric', 'coffee-espresso' ),
		),
	)
);

// Post Options - Add Post Date Icon
$wp_customize->add_setting(
    'coffee_espresso_post_date_icon',
    array(
        'default' => 'far fa-clock', 
        'sanitize_callback' => 'sanitize_text_field',
        'capability' => 'edit_theme_options',
    )
);

$wp_customize->add_control(new Coffee_Espresso_Change_Icon_Control(
    $wp_customize, 
    'coffee_espresso_post_date_icon',
    array(
        'label'    => __('Add Date Icon','coffee-espresso'),
        'section'  => 'coffee_espresso_post_options',
        'iconset'  => 'fa',
    )
));

// Post Options - Show / Hide Date.
$wp_customize->add_setting(
	'coffee_espresso_post_hide_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_post_hide_date',
		array(
			'label'   => esc_html__( 'Show / Hide Date', 'coffee-espresso' ),
			'section' => 'coffee_espresso_post_options',
		)
	)
);

// Post Options - Add Post Author Icon
$wp_customize->add_setting(
    'coffee_espresso_post_author_icon',
    array(
        'default' => 'fas fa-user', 
        'sanitize_callback' => 'sanitize_text_field',
        'capability' => 'edit_theme_options',
    )
);

$wp_customize->add_control(new Coffee_Espresso_Change_Icon_Control(
    $wp_customize, 
    'coffee_espresso_post_author_icon',
    array(
        'label'    => __('Add Author Icon','coffee-espresso'),
        'section'  => 'coffee_espresso_post_options',
        'iconset'  => 'fa',
    )
));

// Post Options - Show / Hide Author.
$wp_customize->add_setting(
	'coffee_espresso_post_hide_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_post_hide_author',
		array(
			'label'   => esc_html__( 'Show / Hide Author', 'coffee-espresso' ),
			'section' => 'coffee_espresso_post_options',
		)
	)
);

// Post Options - Add Post Comments Icon
$wp_customize->add_setting(
    'coffee_espresso_post_comments_icon',
    array(
        'default' => 'fas fa-comments', 
        'sanitize_callback' => 'sanitize_text_field',
        'capability' => 'edit_theme_options',
    )
);

$wp_customize->add_control(new Coffee_Espresso_Change_Icon_Control(
    $wp_customize, 
    'coffee_espresso_post_comments_icon',
    array(
        'label'    => __('Add Comments Icon','coffee-espresso'),
        'section'  => 'coffee_espresso_post_options',
        'iconset'  => 'fa',
    )
));

// Post Options - Show / Hide Comments.
$wp_customize->add_setting(
	'coffee_espresso_post_hide_comments',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_post_hide_comments',
		array(
			'label'   => esc_html__( 'Show / Hide Comments', 'coffee-espresso' ),
			'section' => 'coffee_espresso_post_options',
		)
	)
);

// Post Options - Add Post Time Icon
$wp_customize->add_setting(
    'coffee_espresso_post_time_icon',
    array(
        'default' => 'fas fa-clock', 
        'sanitize_callback' => 'sanitize_text_field',
        'capability' => 'edit_theme_options',
    )
);

$wp_customize->add_control(new Coffee_Espresso_Change_Icon_Control(
    $wp_customize, 
    'coffee_espresso_post_time_icon',
    array(
        'label'    => __('Add Time Icon','coffee-espresso'),
        'section'  => 'coffee_espresso_post_options',
        'iconset'  => 'fa',
    )
));

// Post Options - Show / Hide Time.
$wp_customize->add_setting(
	'coffee_espresso_post_hide_time',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_post_hide_time',
		array(
			'label'   => esc_html__( 'Show / Hide Time', 'coffee-espresso' ),
			'section' => 'coffee_espresso_post_options',
		)
	)
);

// Post Options - Show / Hide Category.
$wp_customize->add_setting(
	'coffee_espresso_post_hide_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_post_hide_category',
		array(
			'label'   => esc_html__( 'Show / Hide Category', 'coffee-espresso' ),
			'section' => 'coffee_espresso_post_options',
		)
	)
);

// Post Options - Show / Hide Feature Image.
$wp_customize->add_setting(
	'coffee_espresso_post_hide_feature_image',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_post_hide_feature_image',
		array(
			'label'   => esc_html__( 'Show / Hide Featured Image', 'coffee-espresso' ),
			'section' => 'coffee_espresso_post_options',
		)
	)
);

// Post Options - Show / Hide Post Heading.
$wp_customize->add_setting(
	'coffee_espresso_post_hide_post_heading',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_post_hide_post_heading',
		array(
			'label'   => esc_html__( 'Show / Hide Post Heading', 'coffee-espresso' ),
			'section' => 'coffee_espresso_post_options',
		)
	)
);

// Post Options - Show / Hide Post Content.
$wp_customize->add_setting(
	'coffee_espresso_post_hide_post_content',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_post_hide_post_content',
		array(
			'label'   => esc_html__( 'Show / Hide Post Content', 'coffee-espresso' ),
			'section' => 'coffee_espresso_post_options',
		)
	)
);

// ---------------------------------------- Post layout ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_archive_layuout_separator', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_archive_layuout_separator', array(
	'label' => __( 'Archive/Blogs Layout Setting', 'coffee-espresso' ),
	'section' => 'coffee_espresso_post_options',
	'settings' => 'coffee_espresso_archive_layuout_separator',
)));


// Archive Layout - Column Layout.
$wp_customize->add_setting(
	'coffee_espresso_archive_column_layout',
	array(
		'default'           => 'column-1',
		'sanitize_callback' => 'coffee_espresso_sanitize_select',
	)
);

$wp_customize->add_control(
	'coffee_espresso_archive_column_layout',
	array(
		'label'   => esc_html__( 'Select Posts Layout', 'coffee-espresso' ),
		'section' => 'coffee_espresso_post_options',
		'type'    => 'select',
		'choices' => array(
			'column-1' => __( 'Column 1', 'coffee-espresso' ),
			'column-2' => __( 'Column 2', 'coffee-espresso' ),
			'column-3' => __( 'Column 3', 'coffee-espresso' ),
			'column-4' => __( 'Column 4', 'coffee-espresso' ),
		),
	)
);

$wp_customize->add_setting('coffee_espresso_blog_layout_option_setting',array(
	'default' => 'Left',
	'sanitize_callback' => 'coffee_espresso_sanitize_choices'
  ));
  $wp_customize->add_control(new Coffee_Espresso_Image_Radio_Control($wp_customize, 'coffee_espresso_blog_layout_option_setting', array(
	'type' => 'select',
	'label' => __('Blog Content Alignment','coffee-espresso'),
	'section' => 'coffee_espresso_post_options',
	'choices' => array(
		'Left' => esc_url(get_template_directory_uri()).'/resource/img/layout-2.png',
		'Default' => esc_url(get_template_directory_uri()).'/resource/img/layout-1.png',
		'Right' => esc_url(get_template_directory_uri()).'/resource/img/layout-3.png',
))));


// ---------------------------------------- Read More ----------------------------------------------------

// Add Separator Custom Control
$wp_customize->add_setting( 'coffee_espresso_readmore_separators', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Coffee_Espresso_Separator_Custom_Control( $wp_customize, 'coffee_espresso_readmore_separators', array(
	'label' => __( 'Read More Button Settings', 'coffee-espresso' ),
	'section' => 'coffee_espresso_post_options',
	'settings' => 'coffee_espresso_readmore_separators',
)));


// Post Options - Show / Hide Read More Button.
$wp_customize->add_setting(
	'coffee_espresso_post_readmore_button',
	array(
		'default'           => true,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_post_readmore_button',
		array(
			'label'   => esc_html__( 'Show / Hide Read More Button', 'coffee-espresso' ),
			'section' => 'coffee_espresso_post_options',
		)
	)
);

$wp_customize->add_setting(
    'coffee_espresso_readmore_btn_icon',
    array(
        'default' => 'fas fa-chevron-right', // Set default icon here
        'sanitize_callback' => 'sanitize_text_field',
        'capability' => 'edit_theme_options',
    )
);

$wp_customize->add_control(new Coffee_Espresso_Change_Icon_Control(
    $wp_customize, 
    'coffee_espresso_readmore_btn_icon',
    array(
        'label'    => __('Read More Icon','coffee-espresso'),
        'section'  => 'coffee_espresso_post_options',
        'iconset'  => 'fa',
    )
));

$wp_customize->add_setting(
	'coffee_espresso_readmore_button_text',
	array(
		'default'           => 'Read More',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_readmore_button_text',
	array(
		'label'           => esc_html__( 'Read More Button Text', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_post_options',
		'settings'        => 'coffee_espresso_readmore_button_text',
		'type'            => 'text',
	)
);

// Featured Image Dimension
$wp_customize->add_setting(
	'coffee_espresso_blog_post_featured_image_dimension',
	array(
		'default' => 'default',
		'sanitize_callback' => 'coffee_espresso_sanitize_choices'
	)
);

$wp_customize->add_control(
	'coffee_espresso_blog_post_featured_image_dimension', 
	array(
		'type' => 'select',
		'label' => __('Featured Image Dimension','coffee-espresso'),
		'section' => 'coffee_espresso_post_options',
		'choices' => array(
			'default' => __('Default','coffee-espresso'),
			'custom' => __('Custom Image Size','coffee-espresso'),
		),
		'description' => __('Note: If you select "Custom Image Size", you can set a custom width and height up to 950px.', 'coffee-espresso')
	)
);
 
// Featured Image Custom Width
$wp_customize->add_setting(
	'coffee_espresso_blog_post_featured_image_custom_width',
	array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'coffee_espresso_blog_post_featured_image_custom_width',
	array(
		'label'	=> __('Featured Image Custom Width','coffee-espresso'),
		'section'=> 'coffee_espresso_post_options',
		'type'=> 'text',
		'input_attrs' => array(
			'placeholder' => __( '300', 'coffee-espresso' ),
		),
		'active_callback' => 'coffee_espresso_blog_post_featured_image_dimension'
	)
);

// Featured Image Custom Height
$wp_customize->add_setting(
	'coffee_espresso_blog_post_featured_image_custom_height',
	array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	)
);

$wp_customize->add_control(
	'coffee_espresso_blog_post_featured_image_custom_height',
	array(
		'label'	=> __('Featured Image Custom Height','coffee-espresso'),
		'section'=> 'coffee_espresso_post_options',
		'type'=> 'text',
		'input_attrs' => array(
			'placeholder' => __( '300', 'coffee-espresso' ),
		),
		'active_callback' => 'coffee_espresso_blog_post_featured_image_dimension'
	)
);

// Featured Image Border Radius
$wp_customize->add_setting( 
	'coffee_espresso_featured_image_border_radius', 
	array(
		'default'           => 10,
		'transport'         => 'refresh',
		'sanitize_callback' => 'coffee_espresso_sanitize_range_value',
	) 
);

$wp_customize->add_control( 
	'coffee_espresso_featured_image_border_radius', 
	array(
		'label'       => esc_html__( 'Featured Image Border Radius', 'coffee-espresso' ),
		'section'     => 'coffee_espresso_post_options',
		'type'        => 'range',
		'input_attrs' => array(
			'step' => 1,
			'min'  => 0,
			'max'  => 150,
		),
	) 
);


$wp_customize->add_setting('coffee_espresso_show_first_caps', array(
	'default'           => false,
	'transport'         => 'refresh',
	'sanitize_callback' => 'coffee_espresso_sanitize_switch',
));

$wp_customize->add_control(new Coffee_Espresso_Toggle_Switch_Custom_Control(
	$wp_customize,
	'coffee_espresso_show_first_caps',
	array(
		'label'   => esc_html__('First Cap (First Capital Letter)', 'coffee-espresso'),
		'section' => 'coffee_espresso_post_options',
	)
));