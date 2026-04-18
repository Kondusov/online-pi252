<?php
/**
 * Active Callbacks
 *
 * @package coffee_espresso
 */

// Theme Options.
function coffee_espresso_is_pagination_enabled( $coffee_espresso_control ) {
	return ( $coffee_espresso_control->manager->get_setting( 'coffee_espresso_enable_pagination' )->value() );
}
function coffee_espresso_is_breadcrumb_enabled( $coffee_espresso_control ) {
	return ( $coffee_espresso_control->manager->get_setting( 'coffee_espresso_enable_breadcrumb' )->value() );
}
function coffee_espresso_is_layout_enabled( $coffee_espresso_control ) {
	return ( $coffee_espresso_control->manager->get_setting( 'coffee_espresso_website_layout' )->value() );
}
function coffee_espresso_is_pagetitle_bcakground_image_enabled( $coffee_espresso_control ) {
	return ( $coffee_espresso_control->manager->get_setting( 'coffee_espresso_page_header_style' )->value() );
}
function coffee_espresso_is_preloader_style( $coffee_espresso_control ) {
	return ( $coffee_espresso_control->manager->get_setting( 'coffee_espresso_enable_preloader' )->value() );
}

// Header Options.
function coffee_espresso_is_topbar_enabled( $coffee_espresso_control ) {
	return ( $coffee_espresso_control->manager->get_Setting( 'coffee_espresso_enable_topbar' )->value() );
}

// Banner Slider Section.
function coffee_espresso_is_banner_slider_section_enabled( $coffee_espresso_control ) {
	return ( $coffee_espresso_control->manager->get_setting( 'coffee_espresso_enable_banner_section' )->value() );
}
function coffee_espresso_is_banner_slider_section_and_content_type_post_enabled( $coffee_espresso_control ) {
	$coffee_espresso_content_type = $coffee_espresso_control->manager->get_setting( 'coffee_espresso_banner_slider_content_type' )->value();
	return ( coffee_espresso_is_banner_slider_section_enabled( $coffee_espresso_control ) && ( 'post' === $coffee_espresso_content_type ) );
}
function coffee_espresso_is_banner_slider_section_and_content_type_page_enabled( $coffee_espresso_control ) {
	$coffee_espresso_content_type = $coffee_espresso_control->manager->get_setting( 'coffee_espresso_banner_slider_content_type' )->value();
	return ( coffee_espresso_is_banner_slider_section_enabled( $coffee_espresso_control ) && ( 'page' === $coffee_espresso_content_type ) );
}

// Product section.
function coffee_espresso_is_post_tab_section_and_content_type_page_enabled( $coffee_espresso_control ) {
	$coffee_espresso_content_type = $coffee_espresso_control->manager->get_setting( 'coffee_espresso_banner_slider_content_type' )->value();
	return ( coffee_espresso_is_banner_slider_section_enabled( $coffee_espresso_control ) && ( 'page' === $coffee_espresso_content_type ) );
}
function coffee_espresso_is_post_tab_section_and_content_type_post_enabled( $coffee_espresso_control ) {
	$coffee_espresso_content_type = $coffee_espresso_control->manager->get_setting( 'coffee_espresso_banner_slider_content_type' )->value();
	return ( coffee_espresso_is_banner_slider_section_enabled( $coffee_espresso_control ) && ( 'post' === $coffee_espresso_content_type ) );
}
function coffee_espresso_is_product_section_enabled( $coffee_espresso_control ) {
	return ( $coffee_espresso_control->manager->get_setting( 'coffee_espresso_enable_product_section' )->value() );
}
function coffee_espresso_is_product_section_and_content_type_post_enabled( $coffee_espresso_control ) {
	$coffee_espresso_content_type = $coffee_espresso_control->manager->get_setting( 'coffee_espresso_product_content_type' )->value();
	return ( coffee_espresso_is_product_section_enabled( $coffee_espresso_control ) && ( 'post' === $coffee_espresso_content_type ) );
}
function coffee_espresso_is_product_section_and_content_type_page_enabled( $coffee_espresso_control ) {
	$coffee_espresso_content_type = $coffee_espresso_control->manager->get_setting( 'coffee_espresso_product_content_type' )->value();
	return ( coffee_espresso_is_product_section_enabled( $coffee_espresso_control ) && ( 'page' === $coffee_espresso_content_type ) );
}