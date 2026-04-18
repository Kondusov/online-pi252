<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! coffee_espresso_has_page_header() ) {
    return;
}

$coffee_espresso_classes = array( 'page-header' );
$coffee_espresso_style = coffee_espresso_page_header_style();

if ( $coffee_espresso_style ) {
    $coffee_espresso_classes[] = $coffee_espresso_style . '-page-header';
}

$coffee_espresso_visibility = get_theme_mod( 'coffee_espresso_page_header_visibility', 'all-devices' );

if ( 'hide-all-devices' === $coffee_espresso_visibility ) {
    // Don't show the header at all
    return;
}

if ( 'hide-tablet' === $coffee_espresso_visibility ) {
    $coffee_espresso_classes[] = 'hide-on-tablet';
} elseif ( 'hide-mobile' === $coffee_espresso_visibility ) {
    $coffee_espresso_classes[] = 'hide-on-mobile';
} elseif ( 'hide-tablet-mobile' === $coffee_espresso_visibility ) {
    $coffee_espresso_classes[] = 'hide-on-tablet-mobile';
}

$coffee_espresso_PAGE_TITLE_background_color = get_theme_mod('coffee_espresso_page_title_background_color_setting', '');

// Get the toggle switch value
$coffee_espresso_background_image_enabled = get_theme_mod('coffee_espresso_page_header_style', true);

// Add background image to the header if enabled
$coffee_espresso_background_image = get_theme_mod( 'coffee_espresso_page_header_background_image', '' );
$coffee_espresso_background_height = get_theme_mod( 'coffee_espresso_page_header_image_height', '200' );
$coffee_espresso_inline_style = '';

if ( $coffee_espresso_background_image_enabled && ! empty( $coffee_espresso_background_image ) ) {
    $coffee_espresso_inline_style .= 'background-image: url(' . esc_url( $coffee_espresso_background_image ) . '); ';
    $coffee_espresso_inline_style .= 'height: ' . esc_attr( $coffee_espresso_background_height ) . 'px; ';
    $coffee_espresso_inline_style .= 'background-size: cover; ';
    $coffee_espresso_inline_style .= 'background-position: center center; ';

    // Add the unique class if the background image is set
    $coffee_espresso_classes[] = 'has-background-image';
}

$coffee_espresso_classes = implode( ' ', $coffee_espresso_classes );
$coffee_espresso_heading = get_theme_mod( 'coffee_espresso_page_header_heading_tag', 'h1' );
$coffee_espresso_heading = apply_filters( 'coffee_espresso_page_header_heading', $coffee_espresso_heading );

?>

<?php do_action( 'coffee_espresso_before_page_header' ); ?>

<header class="<?php echo esc_attr( $coffee_espresso_classes ); ?>" style="<?php echo esc_attr( $coffee_espresso_inline_style ); ?> background-color: <?php echo esc_attr($coffee_espresso_PAGE_TITLE_background_color); ?>;">

    <?php do_action( 'coffee_espresso_before_page_header_inner' ); ?>

    <div class="asterthemes-wrapper page-header-inner">

        <?php if ( coffee_espresso_has_page_header() ) : ?>

            <<?php echo esc_attr( $coffee_espresso_heading ); ?> class="page-header-title">
                <?php echo wp_kses_post( coffee_espresso_get_page_title() ); ?>
            </<?php echo esc_attr( $coffee_espresso_heading ); ?>>

        <?php endif; ?>

        <?php if ( function_exists( 'coffee_espresso_breadcrumb' ) ) : ?>
            <?php coffee_espresso_breadcrumb(); ?>
        <?php endif; ?>

    </div><!-- .page-header-inner -->

    <?php do_action( 'coffee_espresso_after_page_header_inner' ); ?>

</header><!-- .page-header -->

<?php do_action( 'coffee_espresso_after_page_header' ); ?>