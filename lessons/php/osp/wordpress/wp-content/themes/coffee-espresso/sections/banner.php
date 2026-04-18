<?php
if ( ! get_theme_mod( 'coffee_espresso_enable_banner_section', false ) ) {
	return;
}

/**
 * Render Banner Section.
 */

$coffee_espresso_banner_section_heading    = get_theme_mod( 'coffee_espresso_banner_section_heading' );
$coffee_espresso_banner_button_label_one   = get_theme_mod( 'coffee_espresso_banner_button_label_one' );
$coffee_espresso_banner_button_link_one    = get_theme_mod( 'coffee_espresso_banner_button_link_one' );
$coffee_espresso_banner_section_image      = get_theme_mod( 'coffee_espresso_banner_section_image' );
$coffee_espresso_banner_bg_style           = ! empty( $coffee_espresso_banner_section_image )
	? 'style="background-image: url(' . esc_url( $coffee_espresso_banner_section_image ) . ');"'
	: '';
?>

<section id="coffee_espresso_banner_section" class="banner-section" <?php echo $coffee_espresso_banner_bg_style; ?>>
	<?php
	if ( is_customize_preview() ) :
		coffee_espresso_section_link( 'coffee_espresso_banner_section' );
	endif;
	?>
	<div class="banner-overlay"></div>
	<div class="asterthemes-wrapper">
		<div class="banner-content-center wow zoomIn">
			<?php if ( ! empty( $coffee_espresso_banner_section_heading ) ) { ?>
				<h1 class="banner-caption-title">
					<?php echo esc_html( $coffee_espresso_banner_section_heading ); ?>
				</h1>
			<?php } ?>
			<?php if ( ! empty( $coffee_espresso_banner_button_label_one ) ) { ?>
				<div class="banner-btn">
					<a href="<?php echo esc_url( $coffee_espresso_banner_button_link_one ); ?>" class="banner-cta-btn">
						<?php echo esc_html( $coffee_espresso_banner_button_label_one ); ?>
					</a>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="banner-zigzag"></div>
</section>
