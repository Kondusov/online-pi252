<?php
/**
 * Product Section
 *
 * @package coffee_espresso
 */

$wp_customize->add_section(
	'coffee_espresso_products_section',
	array(
		'panel'    => 'coffee_espresso_front_page_options',
		'title'    => esc_html__( 'Product Section', 'coffee-espresso' ),
		'priority' => 10,
	)
);

// Product Section - Enable Section.
$wp_customize->add_setting(
	'coffee_espresso_enable_product_section',
	array(
		'default'           => false,
		'sanitize_callback' => 'coffee_espresso_sanitize_switch',
	)
);

$wp_customize->add_control(
	new Coffee_Espresso_Toggle_Switch_Custom_Control(
		$wp_customize,
		'coffee_espresso_enable_product_section',
		array(
			'label'    => esc_html__( 'Enable Product Section', 'coffee-espresso' ),
			'section'  => 'coffee_espresso_products_section',
			'settings' => 'coffee_espresso_enable_product_section',
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'coffee_espresso_enable_product_section',
		array(
			'selector' => '#coffee_espresso_service_section .section-link',
			'settings' => 'coffee_espresso_enable_product_section',
		)
	);
}

// Product Section - Heading.
$wp_customize->add_setting(
	'coffee_espresso_trending_product_heading',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_trending_product_heading',
	array(
		'label'           => esc_html__( 'Heading', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_products_section',
		'settings'        => 'coffee_espresso_trending_product_heading',
		'type'            => 'text',
		'active_callback' => 'coffee_espresso_is_product_section_enabled',
	)
);

// Product Section - Sub Heading.
$wp_customize->add_setting(
	'coffee_espresso_trending_product_sub_heading',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'coffee_espresso_trending_product_sub_heading',
	array(
		'label'           => esc_html__( 'Sub Heading', 'coffee-espresso' ),
		'section'         => 'coffee_espresso_products_section',
		'settings'        => 'coffee_espresso_trending_product_sub_heading',
		'type'            => 'text',
		'active_callback' => 'coffee_espresso_is_product_section_enabled',
	)
);

if(class_exists('woocommerce')){

$coffee_espresso_args = array(
	'type'                     => 'product',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'term_group',
	'order'                    => 'ASC',
	'hide_empty'               => false,
	'hierarchical'             => 1,
	'number'                   => '',
	'taxonomy'                 => 'product_cat',
	'pad_counts'               => false
);
$coffee_espresso_categories = get_categories($coffee_espresso_args);
$coffee_espresso_cat_posts = array();
$coffee_espresso_m = 0;
$coffee_espresso_cat_posts[]='Select';
foreach($coffee_espresso_categories as $coffee_espresso_category){
	if($coffee_espresso_m==0){
		$coffee_espresso_default = $coffee_espresso_category->slug;
		$coffee_espresso_m++;
	}
	$coffee_espresso_cat_posts[$coffee_espresso_category->slug] = $coffee_espresso_category->name;
}

$wp_customize->add_setting('coffee_espresso_trending_product_category',array(
	'default'	=> 'uncategorized',
	'sanitize_callback' => 'coffee_espresso_sanitize_select',
));
$wp_customize->add_control('coffee_espresso_trending_product_category',array(
	'type'    => 'select',
	'choices' => $coffee_espresso_cat_posts,
	'label' => __('Select category to display products ','coffee-espresso'),
	'section' => 'coffee_espresso_products_section',
	'active_callback' => 'coffee_espresso_is_product_section_enabled',
));
}