<?php
/**
 * Render homepage sections.
 */
function coffee_espresso_homepage_sections() {
	$coffee_espresso_homepage_sections = array_keys( coffee_espresso_get_homepage_sections() );

	foreach ( $coffee_espresso_homepage_sections as $coffee_espresso_section ) {
		require get_template_directory() . '/sections/' . $coffee_espresso_section . '.php';
	}
}