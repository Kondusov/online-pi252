<?php
require get_template_directory() . '/theme-wizard/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function coffee_espresso_register_recommended_plugins_set() {
	$plugins = array(
		array(
			'name'             => __( 'Woocommerce', 'coffee-espresso' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'coffee_espresso_register_recommended_plugins_set' );