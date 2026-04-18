<?php
/**
 * Coffee Espresso functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package coffee_espresso
 */

if ( ! defined( 'COFFEE_ESPRESSO_VERSION' ) ) {
	define( 'COFFEE_ESPRESSO_VERSION', '1.0.0' );
}

$coffee_espresso_theme_data = wp_get_theme();

if( ! defined( 'COFFEE_ESPRESSO_THEME_VERSION' ) ) define ( 'COFFEE_ESPRESSO_THEME_VERSION', $coffee_espresso_theme_data->get( 'Version' ) );
if( ! defined( 'COFFEE_ESPRESSO_THEME_NAME' ) ) define( 'COFFEE_ESPRESSO_THEME_NAME', $coffee_espresso_theme_data->get( 'Name' ) );

if ( ! function_exists( 'coffee_espresso_setup' ) ) :
	
	function coffee_espresso_setup() {
		
		load_theme_textdomain( 'coffee-espresso', get_template_directory() . '/languages' );

		add_theme_support( 'woocommerce' );

		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'coffee-espresso' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'woocommerce',
			)
		);

		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio', 
		) );

		add_theme_support(
			'custom-background',
			apply_filters(
				'coffee_espresso_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'align-wide' );

		add_theme_support( 'responsive-embeds' );

		/*
		* This theme styles the visual editor to resemble the theme style,
		* specifically font, colors, icons, and column width.
		*/
		add_editor_style( '/resource/css/editor-style.css' );

		/*  Demo Import */
		require get_parent_theme_file_path( '/theme-wizard/config.php' );

	}
endif;
add_action( 'after_setup_theme', 'coffee_espresso_setup' );

function coffee_espresso_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'coffee_espresso_content_width', 640 );
}
add_action( 'after_setup_theme', 'coffee_espresso_content_width', 0 );

function coffee_espresso_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'coffee-espresso' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'coffee-espresso' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// Regsiter 4 footer widgets.
	$coffee_espresso_footer_widget_column = get_theme_mod('coffee_espresso_footer_widget_column','4');
	for ($coffee_espresso_i=1; $coffee_espresso_i<=$coffee_espresso_footer_widget_column; $coffee_espresso_i++) {
		register_sidebar( array(
			'name' => __( 'Footer  ', 'coffee-espresso' )  . $coffee_espresso_i,
			'id' => 'footer-widget-' . $coffee_espresso_i,
			'description' => __( 'The Footer Widget Area', 'coffee-espresso' )  . $coffee_espresso_i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h4 class="widget-title">',
			'after_title' => '</h4></div>',
		) );
	}
}
add_action( 'widgets_init', 'coffee_espresso_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function coffee_espresso_scripts() {
	// Append .min if SCRIPT_DEBUG is false.
	$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Fontawesome style.
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri())."/resource/css/fontawesome-all.css" );

	// Main style.
	wp_enqueue_style( 'coffee-espresso-style', get_template_directory_uri() . '/style.css', array(), COFFEE_ESPRESSO_VERSION );

	// RTL style.
	wp_style_add_data('coffee-espresso-style', 'rtl', 'replace');

	if (get_theme_mod('coffee_espresso_enable_animation', true) == true){
		// Animate CSS
		wp_enqueue_style( 'animate-style', get_template_directory_uri() . '/resource/css/animate.css' );
		// Wow script.
		wp_enqueue_script( 'wow-jquery', get_template_directory_uri() . '/resource/js/wow.js', array('jquery'),'' ,true );
	}

	wp_enqueue_style( 'owl.carousel-css', esc_url(get_template_directory_uri())."/resource/css/owl.carousel.css" );

	// Navigation script.
	wp_enqueue_script( 'coffee-espresso-navigation-script', get_template_directory_uri() . '/resource/js/navigation.js', array(), COFFEE_ESPRESSO_VERSION, true );

	// Custom script.
	wp_enqueue_script( 'coffee-espresso-custom-script', get_template_directory_uri() . '/resource/js/custom.js', array( 'jquery' ), COFFEE_ESPRESSO_VERSION, true );

	wp_enqueue_script( 'owl.carousel-js', esc_url(get_template_directory_uri()). '/resource/js/owl.carousel.js', array('jquery') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Include the file.
	require_once get_theme_file_path( 'theme-library/function-files/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'Inter',
		Coffee_Espresso_wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap' ),
		array(),
		'1.0'
	);
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_scripts' );

//Change number of products per page 
add_filter( 'loop_shop_per_page', 'coffee_espresso_products_per_page' );
function coffee_espresso_products_per_page( $cols ) {
  	return  get_theme_mod( 'coffee_espresso_products_per_page',9);
}

// Change number or products per row 
add_filter('loop_shop_columns', 'coffee_espresso_loop_columns');
	if (!function_exists('coffee_espresso_loop_columns')) {
	function coffee_espresso_loop_columns() {
		return get_theme_mod( 'coffee_espresso_products_per_row', 3 );
	}
}

/**
 * Include wptt webfont loader.
 */
require_once get_theme_file_path( 'theme-library/function-files/wptt-webfont-loader.php' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/theme-library/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/theme-library/function-files/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/theme-library/function-files/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/theme-library/customizer.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/theme-library/function-files/google-fonts.php';

/**
 * Dynamic CSS
 */
require get_template_directory() . '/theme-library/dynamic-css.php';

/**
 * Breadcrumb
 */
require get_template_directory() . '/theme-library/function-files/class-breadcrumb-trail.php';

/**
 * Customizer Settings Functions
*/
require get_template_directory() . '/theme-library/function-files/customizer-settings-functions.php';


/**
 * Getting Started
*/
require get_template_directory() . '/theme-library/getting-started/getting-started.php';

function coffee_espresso_links_setup() {
	if ( ! defined( 'COFFEE_ESPRESSO_PREMIUM_PAGE' ) ) {
	define('COFFEE_ESPRESSO_PREMIUM_PAGE',__('https://asterthemes.com/products/bistro-wordpress-theme','coffee-espresso'));
	}
	if ( ! defined( 'COFFEE_ESPRESSO_THEME_PAGE' ) ) {
		define('COFFEE_ESPRESSO_THEME_PAGE',__('https://asterthemes.com/products/coffee-espresso','coffee-espresso'));
	}
	if ( ! defined( 'COFFEE_ESPRESSO_SUPPORT' ) ) {
	define('COFFEE_ESPRESSO_SUPPORT',__('https://wordpress.org/support/theme/coffee-espresso/','coffee-espresso'));
	}
	if ( ! defined( 'COFFEE_ESPRESSO_REVIEW' ) ) {
	define('COFFEE_ESPRESSO_REVIEW',__('https://wordpress.org/support/theme/coffee-espresso/reviews/','coffee-espresso'));
	}
	if ( ! defined( 'COFFEE_ESPRESSO_PRO_DEMO' ) ) {
	define('COFFEE_ESPRESSO_PRO_DEMO',__('https://demo.asterthemes.com/coffee-bistro/','coffee-espresso'));
	}
	if ( ! defined( 'COFFEE_ESPRESSO_THEME_DOCUMENTATION' ) ) {
	define('COFFEE_ESPRESSO_THEME_DOCUMENTATION',__('https://demo.asterthemes.com/docs/coffee-espresso-free/','coffee-espresso'));
	}
	if ( ! defined( 'COFFEE_ESPRESSO_PREMIUM_DOCUMENTATION' ) ) {
	define('COFFEE_ESPRESSO_PREMIUM_DOCUMENTATION',__('https://demo.asterthemes.com/docs/bistro-wordpress-theme-pro/','coffee-espresso'));
	}
	if ( ! defined( 'COFFEE_ESPRESSO_BUNDLE_PAGE' ) ) {
		define('COFFEE_ESPRESSO_BUNDLE_PAGE',__('https://asterthemes.com/products/wp-theme-bundle','coffee-espresso'));
	}
}
add_action('after_setup_theme', 'coffee_espresso_links_setup');

// Enqueue Customizer live preview script
function coffee_espresso_customizer_live_preview() {
    wp_enqueue_script(
        'coffee-espresso-customizer',
        get_template_directory_uri() . '/resource/js/customizer.js',
        array('jquery', 'customize-preview'),
        '',
        true
    );
}
add_action('customize_preview_init', 'coffee_espresso_customizer_live_preview');

// Featured Image Dimension
function coffee_espresso_blog_post_featured_image_dimension(){
	if(get_theme_mod('coffee_espresso_blog_post_featured_image_dimension') == 'custom' ) {
		return true;
	}
	return false;
}


add_filter( 'woocommerce_loop_add_to_cart_link', 'custom_add_to_cart_icon', 10, 2 );
function custom_add_to_cart_icon( $button, $product ) {
    $icon = ' <i class="fas fa-arrow-right"></i>';
    return str_replace( '</a>', $icon . '</a>', $button );
}

// Add animation class
if ( class_exists( 'WooCommerce' ) ) { 
	add_filter('post_class', function($coffee_espresso_classes, $class, $product_id) {

	    if( is_shop() || is_product_category() || is_product() ){
	        
	        $coffee_espresso_classes = array_merge(['wow','zoomIn'], $coffee_espresso_classes);
	    }

	    return $coffee_espresso_classes;

	}, 10, 3);
}
//woocommerce-end//

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );