<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package coffee_espresso
 */


// Output inline CSS based on Customizer setting

// Breadcrumb - Enable Breadcrumb.
function coffee_espresso_customizer_css_inline() {
	$coffee_espresso_custom_css = '';
	$coffee_espresso_enable_breadcrumb = get_theme_mod( 'coffee_espresso_enable_breadcrumb', true );

	if ( ! $coffee_espresso_enable_breadcrumb ) {
		$coffee_espresso_custom_css .= 'nav.woocommerce-breadcrumb { 
            display: none; 
        }';
	}

	if ( ! empty( $coffee_espresso_custom_css ) ) {
		wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_customizer_css_inline' );

//Global Color
function coffee_espresso_customize_css() {
	$coffee_espresso_primary_color = get_theme_mod( 'coffee_espresso_primary_color', '#8E5331' );
	$coffee_espresso_custom_css = ":root { --primary-color: {$coffee_espresso_primary_color}; }";
  
	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_customize_css' );

//Google Fonts
function coffee_espresso_enqueue_selected_fonts() {
    $coffee_espresso_fonts_url = coffee_espresso_get_fonts_url();
    if (!empty($coffee_espresso_fonts_url)) {
        wp_enqueue_style('coffee-espresso-google-fonts', $coffee_espresso_fonts_url, array(), null);
    }
}
add_action('wp_enqueue_scripts', 'coffee_espresso_enqueue_selected_fonts');

//Set Width
function coffee_espresso_layout_customizer_css() {
	$coffee_espresso_margin = get_theme_mod( 'coffee_espresso_layout_width_margin', 50 );
	$coffee_espresso_custom_css = "body.site-boxed--layout #page { margin: 0 {$coffee_espresso_margin}px; }";

	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_layout_customizer_css', 20 );

//Blog Content Alignment
function coffee_espresso_blog_layout_customizer_css() {
	// Retrieve the blog layout option
	$coffee_espresso_layout_option = get_theme_mod( 'coffee_espresso_blog_layout_option_setting', 'Left' );

	// Determine text alignment based on option
	switch ( $coffee_espresso_layout_option ) {
		case 'Right':
			$coffee_espresso_text_align = 'right';
			break;
		case 'Default':
			$coffee_espresso_text_align = 'center';
			break;
		case 'Left':
		default:
			$coffee_espresso_text_align = 'left';
			break;
	}

	// Create custom CSS
	$coffee_espresso_custom_css = ".mag-post-detail { text-align: {$coffee_espresso_text_align}; }";

	// Attach CSS to theme style
	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_blog_layout_customizer_css' );

//Sidebar Width Setting
function coffee_espresso_sidebar_width_customizer_css() {
	$coffee_espresso_sidebar_width = get_theme_mod( 'coffee_espresso_sidebar_width', '30' );

	$coffee_espresso_custom_css = "
		.right-sidebar .asterthemes-wrapper .asterthemes-page {
			grid-template-columns: auto {$coffee_espresso_sidebar_width}%;
		}
		.left-sidebar .asterthemes-wrapper .asterthemes-page {
			grid-template-columns: {$coffee_espresso_sidebar_width}% auto;
		}
	";

	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_sidebar_width_customizer_css' );


if ( ! function_exists( 'coffee_espresso_get_page_title' ) ) {
    function coffee_espresso_get_page_title() {
        $coffee_espresso_title = '';

        if (is_404()) {
            $coffee_espresso_title = esc_html__('Page Not Found', 'coffee-espresso');
        } elseif (is_search()) {
            $coffee_espresso_title = esc_html__('Search Results for: ', 'coffee-espresso') . esc_html(get_search_query());
        } elseif (is_home() && !is_front_page()) {
            $coffee_espresso_title = esc_html__('Blogs', 'coffee-espresso');
        } elseif (function_exists('is_shop') && is_shop()) {
            $coffee_espresso_title = esc_html__('Shop', 'coffee-espresso');
        } elseif (is_page()) {
            $coffee_espresso_title = get_the_title();
        } elseif (is_single()) {
            $coffee_espresso_title = get_the_title();
        } elseif (is_archive()) {
            $coffee_espresso_title = get_the_archive_title();
        } else {
            $coffee_espresso_title = get_the_archive_title();
        }

        return apply_filters('coffee_espresso_page_title', $coffee_espresso_title);
    }
}

if ( ! function_exists( 'coffee_espresso_has_page_header' ) ) {
    function coffee_espresso_has_page_header() {
        // Default to true (display header)
        $coffee_espresso_return = true;

        // Custom conditions for disabling the header
        if ('hide-all-devices' === get_theme_mod('coffee_espresso_page_header_visibility', 'all-devices')) {
            $coffee_espresso_return = false;
        }

        // Apply filters and return
        return apply_filters('coffee_espresso_display_page_header', $coffee_espresso_return);
    }
}

if ( ! function_exists( 'coffee_espresso_page_header_style' ) ) {
    function coffee_espresso_page_header_style() {
        $coffee_espresso_style = get_theme_mod('coffee_espresso_page_header_style', 'default');
        return apply_filters('coffee_espresso_page_header_style', $coffee_espresso_style);
    }
}

//Page Title Options
function coffee_espresso_page_title_customizer_css() {
	$coffee_espresso_layout_option = get_theme_mod( 'coffee_espresso_page_header_layout', 'left' );
	$coffee_espresso_custom_css = '';

	if ( $coffee_espresso_layout_option === 'flex' ) {
		$coffee_espresso_custom_css .= '
			.asterthemes-wrapper.page-header-inner {
				display: flex;
				justify-content: space-between;
				align-items: center;
			}
		';
	} else {
		$coffee_espresso_custom_css .= "
			.asterthemes-wrapper.page-header-inner {
				text-align: {$coffee_espresso_layout_option};
			}
		";
	}

	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_page_title_customizer_css' );

//Set Height
function coffee_espresso_pagetitle_height_css() {
	$coffee_espresso_height = get_theme_mod( 'coffee_espresso_pagetitle_height', 50 );

	$coffee_espresso_custom_css = "
		header.page-header {
			padding: {$coffee_espresso_height}px 0;
		}
	";

	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_pagetitle_height_css' );

//Adjust Site Logo Width
function coffee_espresso_site_logo_width() {
	$coffee_espresso_logo_width = get_theme_mod( 'coffee_espresso_site_logo_width', 150 );

	$coffee_espresso_custom_css = "
		.site-logo img {
			max-width: {$coffee_espresso_logo_width}px;
		}
	";

	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_site_logo_width' );

//Menu Font Size
function coffee_espresso_menu_font_size_css() {
	$coffee_espresso_font_size = get_theme_mod( 'coffee_espresso_menu_font_size', 14 );

	$coffee_espresso_custom_css = "
		.main-navigation a {
			font-size: {$coffee_espresso_font_size}px;
		}
	";

	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_menu_font_size_css' );

//Menu Font Weight
function coffee_espresso_menu_font_weight_css() {
	$coffee_espresso_font_weight = get_theme_mod( 'coffee_espresso_menu_font_weight', 400 );

	$coffee_espresso_custom_css = "
		.main-navigation a {
		    font-weight: {$coffee_espresso_font_weight};
		}
	";

	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_menu_font_weight_css' );

//Menu text transform
function coffee_espresso_menu_text_transform_css() {
	$coffee_espresso_text_transform = get_theme_mod( 'coffee_espresso_menu_text_transform', 'capitalize' );

	$coffee_espresso_custom_css = "
		.main-navigation a {
			text-transform: {$coffee_espresso_text_transform};
		}
	";

	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_menu_text_transform_css' );

// Featured Image Dimension
function coffee_espresso_custom_featured_image_css() {
    $coffee_espresso_dimension = get_theme_mod('coffee_espresso_blog_post_featured_image_dimension', 'default');
    $coffee_espresso_width = get_theme_mod('coffee_espresso_blog_post_featured_image_custom_width', '');
    $coffee_espresso_height = get_theme_mod('coffee_espresso_blog_post_featured_image_custom_height', '');
    
    if ($coffee_espresso_dimension === 'custom' && $coffee_espresso_width && $coffee_espresso_height) {
        $coffee_espresso_custom_css = "body:not(.single-post) .mag-post-single .mag-post-img img { width: {$coffee_espresso_width}px !important; height: {$coffee_espresso_height}px !important; }";
        wp_add_inline_style('coffee-espresso-style', $coffee_espresso_custom_css);
    }
}
add_action('wp_enqueue_scripts', 'coffee_espresso_custom_featured_image_css');

// Featured Image Border Radius
function coffee_espresso_featured_image_border_radius_css() {
	$coffee_espresso_radius = get_theme_mod( 'coffee_espresso_featured_image_border_radius', 10 );

	$coffee_espresso_custom_css = "
		.mag-post-single img {
			border-radius: {$coffee_espresso_radius}px;
		}
	";

	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_featured_image_border_radius_css' );

//Heading Font Size
function coffee_espresso_sidebar_widget_font_size_css() {
	$coffee_espresso_sidebar_widget_font_size = get_theme_mod( 'coffee_espresso_sidebar_widget_font_size', 24 );

	$coffee_espresso_custom_css = "
		h2.wp-block-heading,
		aside#secondary .widgettitle,
		aside#secondary .widget-title {
			font-size: {$coffee_espresso_sidebar_widget_font_size}px;
		}
	";

	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_sidebar_widget_font_size_css' );

// Woocommerce Related Products Settings
function coffee_espresso_related_product_css() {
    $coffee_espresso_related_product_show_hide = get_theme_mod( 'coffee_espresso_related_product_show_hide', true );

    if ( ! $coffee_espresso_related_product_show_hide ) {
        $coffee_espresso_custom_css = '
            .related.products {
                display: none;
            }
        ';
        wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_related_product_css' );

// Product Sale Badge Position
function coffee_espresso_product_sale_position_customizer_css() {
    $coffee_espresso_position = get_theme_mod('coffee_espresso_product_sale_position', 'left');
    $coffee_espresso_css = '.woocommerce ul.products li.product .onsale {';
    if ($coffee_espresso_position === 'left') {
        $coffee_espresso_css .= 'right: auto; left: 0px;';
    } else {
        $coffee_espresso_css .= 'left: auto; right: 0px;';
    }
    $coffee_espresso_css .= '}';
    wp_add_inline_style('coffee-espresso-style', $coffee_espresso_css);
}
add_action('wp_enqueue_scripts', 'coffee_espresso_product_sale_position_customizer_css');

//Footer Social Icon Alignment
function coffee_espresso_footer_icons_alignment_css() {
    $coffee_espresso_footer_social_align = get_theme_mod( 'coffee_espresso_footer_social_align', 'center' );   
    ?>
    <style type="text/css">
        .socialicons {
            text-align: <?php echo esc_attr( $coffee_espresso_footer_social_align ); ?> 
        }

        /* Mobile Specific */
        @media screen and (max-width: 575px) {
            .socialicons {
                text-align: center;
            }
        }
    </style>
    <?php
}
add_action( 'wp_head', 'coffee_espresso_footer_icons_alignment_css' );

// Footer Copyright Alignment
function coffee_espresso_footer_copyright_alignment_css() {
    $coffee_espresso_align = get_theme_mod('coffee_espresso_footer_bottom_align', 'center');
    $coffee_espresso_css = "
        .site-footer .site-footer-bottom .site-footer-bottom-wrapper {
            justify-content: {$coffee_espresso_align};
        }
        @media screen and (max-width: 575px) {
            .site-footer .site-footer-bottom .site-footer-bottom-wrapper {
                justify-content: center;
                text-align: center;
            }
        }
    ";
    wp_add_inline_style('coffee-espresso-style', $coffee_espresso_css);
}
add_action('wp_enqueue_scripts', 'coffee_espresso_footer_copyright_alignment_css');

// Footer Copyright Font Size
function coffee_espresso_copyright_font_size_css() {
    $coffee_espresso_font_size = get_theme_mod('coffee_espresso_copyright_font_size', 16);
    $coffee_espresso_css = ".site-footer-bottom .site-info span {
        font-size: {$coffee_espresso_font_size}px;
    }";
    wp_add_inline_style('coffee-espresso-style', $coffee_espresso_css);
}
add_action('wp_enqueue_scripts', 'coffee_espresso_copyright_font_size_css');

// Preloader Background Color
function coffee_espresso_preloader_background_colors_css() {
    $coffee_espresso_color = get_theme_mod('coffee_espresso_preloader_background_color_setting', '');
    if (!empty($coffee_espresso_color)) {
        $coffee_espresso_css = "#loader {
            background-color: {$coffee_espresso_color};
        }";
        wp_add_inline_style('coffee-espresso-style', $coffee_espresso_css);
    }
}
add_action('wp_enqueue_scripts', 'coffee_espresso_preloader_background_colors_css');

// Preloader Background Image
function coffee_espresso_preloader_background_image_css() {
    $coffee_espresso_image_url = get_theme_mod('coffee_espresso_preloader_background_image_setting', '');
    if (!empty($coffee_espresso_image_url)) {
        $coffee_espresso_css = "#loader {
            background-image: url('{$coffee_espresso_image_url}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }";
        wp_add_inline_style('coffee-espresso-style', $coffee_espresso_css);
    }
}
add_action('wp_enqueue_scripts', 'coffee_espresso_preloader_background_image_css');

// Footer Heading Alignment
function coffee_espresso_footer_heading_alignment_css() {
    $coffee_espresso_align = get_theme_mod('coffee_espresso_footer_header_align', 'left');
    $coffee_espresso_css = "
        .site-footer h4,
        footer#colophon h2.wp-block-heading,
        footer#colophon .widgettitle,
        footer#colophon .widget-title {
            text-align: {$coffee_espresso_align};
        }
    ";
    wp_add_inline_style('coffee-espresso-style', $coffee_espresso_css);
}
add_action('wp_enqueue_scripts', 'coffee_espresso_footer_heading_alignment_css');

//First Capital Letter
function coffee_espresso_show_first_caps() {
	$coffee_espresso_first_caps = get_theme_mod('coffee_espresso_show_first_caps', false);
	$coffee_espresso_css = '';
	if ( $coffee_espresso_first_caps ) {
	$coffee_espresso_css .= '
		.mag-post-single .mag-post-detail .mag-post-excerpt p:first-of-type::first-letter {
		    font-size: 55px;
			font-weight: 600;
			margin-right: 6px;
			line-height: 1;
			display: inline-block;
			vertical-align: baseline;
		}';
	} else {
		$coffee_espresso_css .= '
		.mag-post-single .mag-post-detail .mag-post-excerpt p:first-of-type::first-letter {
			display: none;
		}';
	}
	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_show_first_caps' );

// Topbar Padding Dynamic CSS
function coffee_espresso_topbar_padding_css(){
	$padding = get_theme_mod('coffee_espresso_topbar_padding');
	$custom_css = ".top-header-part{
		padding-top: {$padding}px !important;
		padding-bottom: {$padding}px !important;
	}";
	wp_add_inline_style('coffee-espresso-style',$custom_css);

}
add_action('wp_enqueue_scripts','coffee_espresso_topbar_padding_css');

// Banner Button Color
function coffee_espresso_banner_button_color_css() {
    $btn_color = get_theme_mod('coffee_espresso_banner_btn_color');
	$btn_bg_color = get_theme_mod('coffee_espresso_banner_btn_bg_color');

	$custom_css = '';
    if ( !empty($btn_color) ) {
		$custom_css .= "
		.banner-single .banner-btn a.asterthemes-button{
			color: {$btn_color};
		}";
	}

	if ( !empty($btn_bg_color) ) {
		$custom_css .= "
		.banner-single .banner-btn a.asterthemes-button{
			background-color: {$btn_bg_color};
		}";
	}

	wp_add_inline_style('coffee-espresso-style', $custom_css);
}
add_action('wp_enqueue_scripts','coffee_espresso_banner_button_color_css');

// WooCommerce Product Border Radius
function coffee_espresso_woocommerce_border_radius_css() {
	$coffee_espresso_radius = get_theme_mod('coffee_espresso_woocommerce_product_border_radius', 3);
    $coffee_espresso_custom_css = "
		.woocommerce ul.products li.product {
			border-radius: {$coffee_espresso_radius}px;
			overflow: hidden;
		}
	";
    wp_add_inline_style('coffee-espresso-style', $coffee_espresso_custom_css);
}
add_action('wp_enqueue_scripts', 'coffee_espresso_woocommerce_border_radius_css');
