<?php
/**
 * Dynamic CSS
 */
function coffee_espresso_dynamic_css() {
	$coffee_espresso_primary_color = get_theme_mod( 'coffee_espresso_primary_color', '#8E5331' );
	$coffee_espresso_site_title_font       = get_theme_mod( 'coffee_espresso_site_title_font', 'Inter' );
	$coffee_espresso_site_description_font = get_theme_mod( 'coffee_espresso_site_description_font', 'Inter' );
	$coffee_espresso_header_font           = get_theme_mod( 'coffee_espresso_header_font', 'Inter' );
	$coffee_espresso_content_font          = get_theme_mod( 'coffee_espresso_content_font', 'Inter' );

	// Enqueue Google Fonts
	$coffee_espresso_fonts_url = coffee_espresso_get_fonts_url();
	if ( ! empty( $coffee_espresso_fonts_url ) ) {
		wp_enqueue_style( 'coffee-espresso-google-fonts', esc_url( $coffee_espresso_fonts_url ), array(), null );
	}

	$coffee_espresso_custom_css  = '';
	$coffee_espresso_custom_css .= '
    /* Color */
    :root {
        --primary-color: ' . esc_attr( $coffee_espresso_primary_color ) . ';
        --header-text-color: ' . esc_attr( '#' . get_header_textcolor() ) . ';
    }
    ';

	$coffee_espresso_custom_css .= '
    /* Typography */
    :root {
        --font-main: "' . esc_attr( $coffee_espresso_header_font ) . '", serif;
        --font-main: -apple-system, BlinkMacSystemFont, "' . esc_attr( $coffee_espresso_content_font ) . '", "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    }

    body,
	button, input, select, optgroup, textarea, p {
        font-family: "' . esc_attr( $coffee_espresso_content_font ) . '", sans-serif;
	}

	.site-identity p.site-title, h1.site-title a, h1.site-title, p.site-title a, .site-branding h1.site-title a, header.site-header .header-main-wrapper:not(.transparent-header) .bottom-header-outer-wrapper .bottom-header-part .bottom-header-part-wrapper .site-branding .site-identity .site-title .banner-text {
        font-family: "' . esc_attr( $coffee_espresso_site_title_font ) . '", serif;
	}
    
	p.site-description {
        font-family: "' . esc_attr( $coffee_espresso_site_description_font ) . '", sans-serif !important;
	}
    ';

	wp_add_inline_style( 'coffee-espresso-style', $coffee_espresso_custom_css );
}
add_action( 'wp_enqueue_scripts', 'coffee_espresso_dynamic_css', 99 );