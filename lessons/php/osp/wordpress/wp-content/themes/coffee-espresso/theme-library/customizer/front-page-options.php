<?php
/**
 * Front Page Options
 *
 * @package Coffee Espresso
 */

$wp_customize->add_panel(
	'coffee_espresso_front_page_options',
	array(
		'title'    => esc_html__( 'Front Page Options', 'coffee-espresso' ),
		'priority' => 20,
	)
);

// Header Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/header.php';

// Banner Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/banner.php';

// Tranding Product Section.
require get_template_directory() . '/theme-library/customizer/front-page-options/product.php';