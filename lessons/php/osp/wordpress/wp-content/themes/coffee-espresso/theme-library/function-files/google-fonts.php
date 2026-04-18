<?php
function coffee_espresso_get_all_google_fonts() {
    $coffee_espresso_webfonts_json = get_template_directory() . '/theme-library/google-webfonts.json';
    if ( ! file_exists( $coffee_espresso_webfonts_json ) ) {
        return array();
    }

    $coffee_espresso_fonts_json_data = file_get_contents( $coffee_espresso_webfonts_json );
    if ( false === $coffee_espresso_fonts_json_data ) {
        return array();
    }

    $coffee_espresso_all_fonts = json_decode( $coffee_espresso_fonts_json_data, true );
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        return array();
    }

    $coffee_espresso_google_fonts = array();
    foreach ( $coffee_espresso_all_fonts as $coffee_espresso_font ) {
        $coffee_espresso_google_fonts[ $coffee_espresso_font['family'] ] = array(
            'family'   => $coffee_espresso_font['family'],
            'variants' => $coffee_espresso_font['variants'],
        );
    }
    return $coffee_espresso_google_fonts;
}

function coffee_espresso_get_all_google_font_families() {
    $coffee_espresso_google_fonts  = coffee_espresso_get_all_google_fonts();
    $coffee_espresso_font_families = array();
    foreach ( $coffee_espresso_google_fonts as $coffee_espresso_font ) {
        $coffee_espresso_font_families[ $coffee_espresso_font['family'] ] = $coffee_espresso_font['family'];
    }
    return $coffee_espresso_font_families;
}

function coffee_espresso_get_fonts_url() {
    $coffee_espresso_fonts_url = '';
    $coffee_espresso_fonts     = array();

    $coffee_espresso_all_fonts = coffee_espresso_get_all_google_fonts();

    if ( ! empty( get_theme_mod( 'coffee_espresso_site_title_font', 'Inter' ) ) ) {
        $coffee_espresso_fonts[] = get_theme_mod( 'coffee_espresso_site_title_font', 'Inter' );
    }

    if ( ! empty( get_theme_mod( 'coffee_espresso_site_description_font', 'Inter' ) ) ) {
        $coffee_espresso_fonts[] = get_theme_mod( 'coffee_espresso_site_description_font', 'Inter' );
    }

    if ( ! empty( get_theme_mod( 'coffee_espresso_header_font', 'Inter' ) ) ) {
        $coffee_espresso_fonts[] = get_theme_mod( 'coffee_espresso_header_font', 'Inter' );
    }

    if ( ! empty( get_theme_mod( 'coffee_espresso_content_font', 'Inter' ) ) ) {
        $coffee_espresso_fonts[] = get_theme_mod( 'coffee_espresso_content_font', 'Inter' );
    }

    $coffee_espresso_fonts = array_unique( $coffee_espresso_fonts );

    foreach ( $coffee_espresso_fonts as $coffee_espresso_font ) {
        $coffee_espresso_variants      = $coffee_espresso_all_fonts[ $coffee_espresso_font ]['variants'];
        $coffee_espresso_font_family[] = $coffee_espresso_font . ':' . implode( ',', $coffee_espresso_variants );
    }

    $coffee_espresso_query_args = array(
        'family' => urlencode( implode( '|', $coffee_espresso_font_family ) ),
    );

    if ( ! empty( $coffee_espresso_font_family ) ) {
        $coffee_espresso_fonts_url = add_query_arg( $coffee_espresso_query_args, 'https://fonts.googleapis.com/css' );
    }

    return $coffee_espresso_fonts_url;
}