<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coffee_espresso
 */

$coffee_espresso_menu_text_color = get_theme_mod('coffee_espresso_menu_text_color'); 
$coffee_espresso_sub_menu_text_color = get_theme_mod('coffee_espresso_sub_menu_text_color'); 
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    
	<?php wp_head(); ?>
</head>

<body <?php body_class(get_theme_mod('coffee_espresso_website_layout', false) ? 'site-boxed--layout' : ''); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site asterthemes-site-wrapper">
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'coffee-espresso' ); ?></a>
    <?php if (get_theme_mod('coffee_espresso_enable_preloader', false)) : ?>
        <div id="loader" class="<?php echo esc_attr(get_theme_mod('coffee_espresso_preloader_style', 'style1')); ?>">
            <div class="loader-container">
                <div id="preloader">
                    <?php 
                    $coffee_espresso_preloader_style = get_theme_mod('coffee_espresso_preloader_style', 'style1');
                    if ($coffee_espresso_preloader_style === 'style1') : ?>
                        <!-- STYLE 1 -->
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/resource/loader.gif'); ?>" alt="<?php esc_attr_e('Loading...', 'coffee-espresso'); ?>">
                    <?php elseif ($coffee_espresso_preloader_style === 'style2') : ?>
                        <!-- STYLE 2 -->
                        <div class="dot"></div>
                    <?php elseif ($coffee_espresso_preloader_style === 'style3') : ?>
                        <!-- STYLE 3 -->
                        <div class="bars">
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <header id="masthead" class="site-header">
            <div class="header-main-wrapper">
                
                <?php if ( get_theme_mod( 'coffee_espresso_enable_topbar', true ) ) {
                    $coffee_espresso_discount_topbar_text      = get_theme_mod( 'coffee_espresso_discount_topbar_text', '' );
                    $coffee_espresso_topbar_email              = get_theme_mod( 'coffee_espresso_topbar_email', '' );
                    $coffee_espresso_location_view_button_text = get_theme_mod( 'coffee_espresso_location_view_button_text', '' );
                    $coffee_espresso_location_view_button_url  = get_theme_mod( 'coffee_espresso_location_view_button_url', '#' );
                    ?>
                        <div class="top-header-part">
                            <div class="asterthemes-wrapper">
                                <div class="topbar-content-wrapper">

                                    <div class="topbar-welcome-text">
                                        <?php if ( ! empty( $coffee_espresso_discount_topbar_text ) ) { ?>
                                            <p><?php echo esc_html( $coffee_espresso_discount_topbar_text ); ?></p>
                                        <?php } ?>
                                    </div>

                                    <div class="topbar-contact-info">
                                        <?php if ( ! empty( $coffee_espresso_topbar_email ) ) { ?>
                                            <a href="mailto:<?php echo esc_attr( $coffee_espresso_topbar_email ); ?>">
                                                <i class="fas fa-envelope" aria-hidden="true"></i>
                                                <?php echo esc_html( $coffee_espresso_topbar_email ); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if ( ! empty( $coffee_espresso_location_view_button_text ) ) { ?>
                                            <a href="<?php echo esc_url( $coffee_espresso_location_view_button_url ); ?>">
                                                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                                <?php echo esc_html( $coffee_espresso_location_view_button_text ); ?>
                                            </a>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                <?php } ?>
                <div class="bottom-header-outer-wrapper">
                    <div class="bottom-header-part">
                        <div class="asterthemes-wrapper">
                            <div class="bottom-header-part-wrapper hello">

                                <div class="bottom-header-left-part">
                                    <div class="site-branding">
                                       <?php
                                            // Check if the 'Enable Site Logo' setting is true.
                                            if ( get_theme_mod( 'coffee_espresso_enable_site_logo', true ) ) {
                                            ?>
                                            <div class="site-logo">
                                                <?php if ( has_custom_logo() ) {
                                                    the_custom_logo();
                                                } else { ?>
                                                    <!-- Default Logo -->
                                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/resource/img/logo.png'); ?>" alt="<?php bloginfo('name'); ?>">
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        <?php }
                                             ?>
                                        <div class="site-identity">
                                            <?php
                                            $coffee_espresso_site_title_size = get_theme_mod('coffee_espresso_site_title_size', 17);

                                            if (get_theme_mod('coffee_espresso_enable_site_title_setting', false)) {
                                                if (is_front_page() && is_home()) : ?>
                                                    <h1 class="site-title" style="font-size: <?php echo esc_attr($coffee_espresso_site_title_size); ?>px;">
                                                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                                    </h1>
                                                <?php else : ?>
                                                    <p class="site-title" style="font-size: <?php echo esc_attr($coffee_espresso_site_title_size); ?>px;">
                                                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                                    </p>
                                                <?php endif;
                                            }

                                            if (get_theme_mod('coffee_espresso_enable_tagline_setting', false)) :
                                                $coffee_espresso_description = get_bloginfo('description', 'display');
                                                if ($coffee_espresso_description || is_customize_preview()) : ?>
                                                    <p class="site-description"><?php echo esc_html($coffee_espresso_description); ?></p>
                                                <?php endif;
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="navigation-menus">
                                    <div class="navigation-part">
                                        <nav id="site-navigation" class="main-navigation">
                                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </button>
                                            <div class="main-navigation-links">
                                                <?php
                                                    wp_nav_menu(
                                                        array(
                                                            'theme_location' => 'primary',
                                                        )
                                                    );
                                                ?>
                                            </div>
                                            <style>
                                                /* Main Menu Links */
                                                .main-navigation ul li a, .menu a {
                                                    color: <?php echo esc_attr($coffee_espresso_menu_text_color); ?>;
                                                }

                                                /* Submenu Links */
                                                .main-navigation ul.children a, 
                                                .home .main-navigation ul.children a, 
                                                .main-navigation ul.menu li .sub-menu a, 
                                                .home .main-navigation ul ul a {
                                                    color: <?php echo esc_attr($coffee_espresso_sub_menu_text_color); ?>;
                                                }
                                            </style>
                                        </nav>
                                    </div>
                                </div>
                                
                                <div class="bottom-header-right-part nav-box">
                                    <?php
                                    $coffee_espresso_btn_text = get_theme_mod( 'coffee_espresso_order_view_button_text', '' );
                                    $coffee_espresso_btn_url  = get_theme_mod( 'coffee_espresso_order_view_button_url', '#' );
                                    if ( ! empty( $coffee_espresso_btn_text ) ) { ?>
                                        <a href="<?php echo esc_url( $coffee_espresso_btn_url ); ?>" class="header-order-btn">
                                            <?php echo esc_html( $coffee_espresso_btn_text ); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
        </header>
<?php
if ( ! is_front_page() || is_home() ) {
	if ( is_front_page() ) {
		require get_template_directory() . '/sections/sections.php';
		coffee_espresso_homepage_sections();

	}
	?>
    <?php
        if (!is_front_page() || is_home()) {
            get_template_part('page-header');
        }
    ?>
	<div id="content" class="site-content">
		<div class="asterthemes-wrapper">
			<div class="asterthemes-page">
			<?php } ?>