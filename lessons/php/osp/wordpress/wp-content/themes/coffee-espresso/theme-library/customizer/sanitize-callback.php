<?php
function coffee_espresso_sanitize_select( $coffee_espresso_input, $coffee_espresso_setting ) {
	$coffee_espresso_input = sanitize_key( $coffee_espresso_input );
	$coffee_espresso_choices = $coffee_espresso_setting->manager->get_control( $coffee_espresso_setting->id )->choices;
	return ( array_key_exists( $coffee_espresso_input, $coffee_espresso_choices ) ? $coffee_espresso_input : $coffee_espresso_setting->default );
}

function coffee_espresso_sanitize_switch( $coffee_espresso_input ) {
	if ( true === $coffee_espresso_input ) {
		return true;
	} else {
		return false;
	}
}

function coffee_espresso_sanitize_google_fonts( $coffee_espresso_input, $coffee_espresso_setting ) {
	$coffee_espresso_choices = $coffee_espresso_setting->manager->get_control( $coffee_espresso_setting->id )->choices;
	return ( array_key_exists( $coffee_espresso_input, $coffee_espresso_choices ) ? $coffee_espresso_input : $coffee_espresso_setting->default );
}
/**
 * Sanitize HTML input.
 *
 * @param string $coffee_espresso_input HTML input to sanitize.
 * @return string Sanitized HTML.
 */
function coffee_espresso_sanitize_html( $coffee_espresso_input ) {
    return wp_kses_post( $coffee_espresso_input );
}

// Sanitize Scroll Top Position
function coffee_espresso_sanitize_scroll_top_position( $coffee_espresso_input ) {
    $valid_positions = array( 'bottom-right', 'bottom-left', 'bottom-center' );
    if ( in_array( $coffee_espresso_input, $valid_positions ) ) {
        return $coffee_espresso_input;
    } else {
        return 'bottom-right'; // Default to bottom-right if invalid value
    }
}

function coffee_espresso_sanitize_choices( $coffee_espresso_input, $coffee_espresso_setting ) {
	global $wp_customize; 
	$control = $wp_customize->get_control( $coffee_espresso_setting->id ); 
	if ( array_key_exists( $coffee_espresso_input, $control->choices ) ) {
		return $coffee_espresso_input;
	} else {
		return $coffee_espresso_setting->default;
	}
}

function coffee_espresso_sanitize_range_value( $coffee_espresso_number, $coffee_espresso_setting ) {

	// Ensure input is an absolute integer.
	$coffee_espresso_number = absint( $coffee_espresso_number );

	// Get the input attributes associated with the setting.
	$coffee_espresso_atts = $coffee_espresso_setting->manager->get_control( $coffee_espresso_setting->id )->input_attrs;

	// Get minimum number in the range.
	$coffee_espresso_min = ( isset( $coffee_espresso_atts['min'] ) ? $coffee_espresso_atts['min'] : $coffee_espresso_number );

	// Get maximum number in the range.
	$coffee_espresso_max = ( isset( $coffee_espresso_atts['max'] ) ? $coffee_espresso_atts['max'] : $coffee_espresso_number );

	// Get step.
	$coffee_espresso_step = ( isset( $coffee_espresso_atts['step'] ) ? $coffee_espresso_atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default.
	return ( $coffee_espresso_min <= $coffee_espresso_number && $coffee_espresso_number <= $coffee_espresso_max && is_int( $coffee_espresso_number / $coffee_espresso_step ) ? $coffee_espresso_number : $coffee_espresso_setting->default );
}