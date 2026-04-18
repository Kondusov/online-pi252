<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package coffee_espresso
 */

function coffee_espresso_body_classes( $coffee_espresso_classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$coffee_espresso_classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$coffee_espresso_classes[] = 'no-sidebar';
	}

	$coffee_espresso_classes[] = coffee_espresso_sidebar_layout();

	return $coffee_espresso_classes;
}
add_filter( 'body_class', 'coffee_espresso_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function coffee_espresso_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'coffee_espresso_pingback_header' );


/**
 * Get all posts for customizer Post content type.
 */
function coffee_espresso_get_post_choices() {
	$coffee_espresso_choices = array( '' => esc_html__( '--Select--', 'coffee-espresso' ) );
	$coffee_espresso_args    = array( 'numberposts' => -1 );
	$coffee_espresso_posts   = get_posts( $coffee_espresso_args );

	foreach ( $coffee_espresso_posts as $coffee_espresso_post ) {
		$coffee_espresso_id             = $coffee_espresso_post->ID;
		$coffee_espresso_title          = $coffee_espresso_post->post_title;
		$coffee_espresso_choices[ $coffee_espresso_id ] = $coffee_espresso_title;
	}

	return $coffee_espresso_choices;
}

/**
 * Get all pages for customizer Page content type.
 */
function coffee_espresso_get_page_choices() {
	$coffee_espresso_choices = array( '' => esc_html__( '--Select--', 'coffee-espresso' ) );
	$coffee_espresso_pages   = get_pages();

	foreach ( $coffee_espresso_pages as $coffee_espresso_page ) {
		$coffee_espresso_choices[ $coffee_espresso_page->ID ] = $coffee_espresso_page->post_title;
	}

	return $coffee_espresso_choices;
}

/**
 * Get all categories for customizer Category content type.
 */
function coffee_espresso_get_post_cat_choices() {
	$coffee_espresso_choices = array( '' => esc_html__( '--Select--', 'coffee-espresso' ) );
	$coffee_espresso_cats    = get_categories();

	foreach ( $coffee_espresso_cats as $coffee_espresso_cat ) {
		$coffee_espresso_choices[ $coffee_espresso_cat->term_id ] = $coffee_espresso_cat->name;
	}

	return $coffee_espresso_choices;
}

/**
 * Get all donation forms for customizer form content type.
 */
function coffee_espresso_get_post_donation_form_choices() {
	$coffee_espresso_choices = array( '' => esc_html__( '--Select--', 'coffee-espresso' ) );
	$coffee_espresso_posts   = get_posts(
		array(
			'post_type'   => 'give_forms',
			'numberposts' => -1,
		)
	);
	foreach ( $coffee_espresso_posts as $coffee_espresso_post ) {
		$coffee_espresso_choices[ $coffee_espresso_post->ID ] = $coffee_espresso_post->post_title;
	}
	return $coffee_espresso_choices;
}

if ( ! function_exists( 'coffee_espresso_excerpt_length' ) ) :
	/**
	 * Excerpt length.
	 */
	function coffee_espresso_excerpt_length( $coffee_espresso_length ) {
		if ( is_admin() ) {
			return $coffee_espresso_length;
		}

		return get_theme_mod( 'coffee_espresso_excerpt_length', 20 );
	}
endif;
add_filter( 'excerpt_length', 'coffee_espresso_excerpt_length', 999 );

if ( ! function_exists( 'coffee_espresso_excerpt_more' ) ) :
	/**
	 * Excerpt more.
	 */
	function coffee_espresso_excerpt_more( $coffee_espresso_more ) {
		if ( is_admin() ) {
			return $coffee_espresso_more;
		}

		return '&hellip;';
	}
endif;
add_filter( 'excerpt_more', 'coffee_espresso_excerpt_more' );

if ( ! function_exists( 'coffee_espresso_sidebar_layout' ) ) {
	/**
	 * Get sidebar layout.
	 */
	function coffee_espresso_sidebar_layout() {
		$coffee_espresso_sidebar_position      = get_theme_mod( 'coffee_espresso_sidebar_position', 'right-sidebar' );
		$coffee_espresso_sidebar_position_post = get_theme_mod( 'coffee_espresso_post_sidebar_position', 'right-sidebar' );
		$coffee_espresso_sidebar_position_page = get_theme_mod( 'coffee_espresso_page_sidebar_position', 'right-sidebar' );

		if ( is_home() ) {
			$coffee_espresso_sidebar_position = $coffee_espresso_sidebar_position_post;
		} elseif ( is_page() ) {
			$coffee_espresso_sidebar_position = $coffee_espresso_sidebar_position_page;
		}

		return $coffee_espresso_sidebar_position;
	}
}

if ( ! function_exists( 'coffee_espresso_is_sidebar_enabled' ) ) {
	/**
	 * Check if sidebar is enabled.
	 */
	function coffee_espresso_is_sidebar_enabled() {
		$coffee_espresso_sidebar_position      = get_theme_mod( 'coffee_espresso_sidebar_position', 'right-sidebar' );
		$coffee_espresso_sidebar_position_post = get_theme_mod( 'coffee_espresso_post_sidebar_position', 'right-sidebar' );
		$coffee_espresso_sidebar_position_page = get_theme_mod( 'coffee_espresso_page_sidebar_position', 'right-sidebar' );

		$coffee_espresso_sidebar_enabled = true;
		if ( is_single() || is_archive() || is_search() ) {
			if ( 'no-sidebar' === $coffee_espresso_sidebar_position ) {
				$coffee_espresso_sidebar_enabled = false;
			}
		} elseif ( is_home() ) {
			if ( 'no-sidebar' === $coffee_espresso_sidebar_position || 'no-sidebar' === $coffee_espresso_sidebar_position_post ) {
				$coffee_espresso_sidebar_enabled = false;
			}
		} elseif ( is_page() ) {
			if ( 'no-sidebar' === $coffee_espresso_sidebar_position || 'no-sidebar' === $coffee_espresso_sidebar_position_page ) {
				$coffee_espresso_sidebar_enabled = false;
			}
		}
		return $coffee_espresso_sidebar_enabled;
	}
}

if ( ! function_exists( 'coffee_espresso_get_homepage_sections ' ) ) {
	/**
	 * Returns homepage sections.
	 */
	function coffee_espresso_get_homepage_sections() {
		$coffee_espresso_sections = array(
			'banner'  => esc_html__( 'Banner Section', 'coffee-espresso' ),
			'product' => esc_html__( 'Product Section', 'coffee-espresso' ),
		);
		return $coffee_espresso_sections;
	}
}

/**
 * Renders customizer section link
 */
function coffee_espresso_section_link( $coffee_espresso_section_id ) {
	$coffee_espresso_section_name      = str_replace( 'coffee_espresso_', ' ', $coffee_espresso_section_id );
	$coffee_espresso_section_name      = str_replace( '_', ' ', $coffee_espresso_section_name );
	$coffee_espresso_starting_notation = '#';
	?>
	<span class="section-link">
		<span class="section-link-title"><?php echo esc_html( $coffee_espresso_section_name ); ?></span>
	</span>
	<style type="text/css">
		<?php echo $coffee_espresso_starting_notation . $coffee_espresso_section_id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>:hover .section-link {
			visibility: visible;
		}
	</style>
	<?php
}

/**
 * Adds customizer section link css
 */
function coffee_espresso_section_link_css() {
	if ( is_customize_preview() ) {
		?>
		<style type="text/css">
			.section-link {
				visibility: hidden;
				background-color: black;
				position: relative;
				top: 80px;
				z-index: 99;
				left: 40px;
				color: #fff;
				text-align: center;
				font-size: 20px;
				border-radius: 10px;
				padding: 20px 10px;
				text-transform: capitalize;
			}

			.section-link-title {
				padding: 0 10px;
			}

			.banner-section {
				position: relative;
			}

			.banner-section .section-link {
				position: absolute;
				top: 100px;
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'coffee_espresso_section_link_css' );

/**
 * Breadcrumb.
 */
function coffee_espresso_breadcrumb( $coffee_espresso_args = array() ) {
	if ( ! get_theme_mod( 'coffee_espresso_enable_breadcrumb', true ) ) {
		return;
	}

	$coffee_espresso_args = array(
		'show_on_front' => false,
		'show_title'    => true,
		'show_browse'   => false,
	);
	breadcrumb_trail( $coffee_espresso_args );
}
add_action( 'coffee_espresso_breadcrumb', 'coffee_espresso_breadcrumb', 10 );

/**
 * Add separator for breadcrumb trail.
 */
function coffee_espresso_breadcrumb_trail_print_styles() {
	$coffee_espresso_breadcrumb_separator = get_theme_mod( 'coffee_espresso_breadcrumb_separator', '/' );

	$coffee_espresso_style = '
		.trail-items li::after {
			content: "' . $coffee_espresso_breadcrumb_separator . '";
		}'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	$coffee_espresso_style = apply_filters( 'coffee_espresso_breadcrumb_trail_inline_style', trim( str_replace( array( "\r", "\n", "\t", '  ' ), '', $coffee_espresso_style ) ) );

	if ( $coffee_espresso_style ) {
		echo "\n" . '<style type="text/css" id="breadcrumb-trail-css">' . $coffee_espresso_style . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'coffee_espresso_breadcrumb_trail_print_styles' );

/**
 * Pagination for archive.
 */
function coffee_espresso_render_posts_pagination() {
	$coffee_espresso_is_pagination_enabled = get_theme_mod( 'coffee_espresso_enable_pagination', true );
	if ( $coffee_espresso_is_pagination_enabled ) {
		$coffee_espresso_pagination_type = get_theme_mod( 'coffee_espresso_pagination_type', 'default' );
		if ( 'default' === $coffee_espresso_pagination_type ) :
			the_posts_navigation();
		else :
			the_posts_pagination();
		endif;
	}
}
add_action( 'coffee_espresso_posts_pagination', 'coffee_espresso_render_posts_pagination', 10 );

/**
 * Pagination for single post.
 */
function coffee_espresso_render_post_navigation() {
	the_post_navigation(
		array(
			'prev_text' => '<span>&#10229;</span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="nav-title">%title</span> <span>&#10230;</span>',
		)
	);
}
add_action( 'coffee_espresso_post_navigation', 'coffee_espresso_render_post_navigation' );

/**
 * Adds footer copyright text.
 */
function coffee_espresso_output_footer_copyright_content() {
    $coffee_espresso_theme_data = wp_get_theme();
    $coffee_espresso_copyright_text = get_theme_mod('coffee_espresso_footer_copyright_text');

	if (!empty($coffee_espresso_copyright_text)) {
        $coffee_espresso_text = $coffee_espresso_copyright_text;
    } else {

		$coffee_espresso_default_text = '<a href="'. esc_url(__('https://asterthemes.com/products/coffee-espresso','coffee-espresso')) . '" target="_blank"> ' . esc_html($coffee_espresso_theme_data->get('Name')) . '</a>' . '&nbsp;' . esc_html__('by', 'coffee-espresso') . '&nbsp;<a target="_blank" href="' . esc_url($coffee_espresso_theme_data->get('AuthorURI')) . '">' . esc_html(ucwords($coffee_espresso_theme_data->get('Author'))) . '</a>';
		/* translators: %s: WordPress.org URL */
        $coffee_espresso_default_text .= sprintf(esc_html__(' | Powered by %s', 'coffee-espresso'), '<a href="' . esc_url(__('https://wordpress.org/', 'coffee-espresso')) . '" target="_blank">WordPress</a>. ');

        $coffee_espresso_text = $coffee_espresso_default_text;

    }
    ?>
    <span><?php echo wp_kses_post($coffee_espresso_text); ?></span>
    <?php
}
add_action('coffee_espresso_footer_copyright', 'coffee_espresso_output_footer_copyright_content');

/* Footer Social Icons */ 
function coffee_espresso_footer_social_links() {

    if ( get_theme_mod('coffee_espresso_enable_footer_icon_section', true) ) {

            ?>
            <div class="socialicons">
				<div class="asterthemes-wrapper">
					<?php if ( get_theme_mod('coffee_espresso_footer_facebook_link', 'https://www.facebook.com/') != '' ) { ?>
						<a target="_blank" href="<?php echo esc_url(get_theme_mod('coffee_espresso_footer_facebook_link', 'https://www.facebook.com/')); ?>">
							<i class="<?php echo esc_attr(get_theme_mod('coffee_espresso_facebook_icon', 'fab fa-facebook-f')); ?>"></i>
							<span class="screen-reader-text"><?php esc_html_e('Facebook', 'coffee-espresso'); ?></span>
						</a>
					<?php } ?>
					<?php if ( get_theme_mod('coffee_espresso_footer_twitter_link', 'https://x.com/') != '' ) { ?>
						<a target="_blank" href="<?php echo esc_url(get_theme_mod('coffee_espresso_footer_twitter_link', 'https://x.com/')); ?>">
							<i class="<?php echo esc_attr(get_theme_mod('coffee_espresso_twitter_icon', 'fab fa-twitter')); ?>"></i>
							<span class="screen-reader-text"><?php esc_html_e('Twitter', 'coffee-espresso'); ?></span>
						</a>
					<?php } ?>
					<?php if ( get_theme_mod('coffee_espresso_footer_instagram_link', 'https://www.instagram.com/') != '' ) { ?>
						<a target="_blank" href="<?php echo esc_url(get_theme_mod('coffee_espresso_footer_instagram_link', 'https://www.instagram.com/')); ?>">
							<i class="<?php echo esc_attr(get_theme_mod('coffee_espresso_instagram_icon', 'fab fa-instagram')); ?>"></i>
							<span class="screen-reader-text"><?php esc_html_e('Instagram', 'coffee-espresso'); ?></span>
						</a>
					<?php } ?>
					<?php if ( get_theme_mod('coffee_espresso_footer_linkedin_link', 'https://in.linkedin.com/') != '' ) { ?>
						<a target="_blank" href="<?php echo esc_url(get_theme_mod('coffee_espresso_footer_linkedin_link', 'https://in.linkedin.com/')); ?>">
							<i class="<?php echo esc_attr(get_theme_mod('coffee_espresso_linkedin_icon', 'fab fa-linkedin')); ?>"></i>
							<span class="screen-reader-text"><?php esc_html_e('Linkedin', 'coffee-espresso'); ?></span>
						</a>
					<?php } ?>
					<?php if ( get_theme_mod('coffee_espresso_footer_youtube_link', 'https://www.youtube.com/') != '' ) { ?>
						<a target="_blank" href="<?php echo esc_url(get_theme_mod('coffee_espresso_footer_youtube_link', 'https://www.youtube.com/')); ?>">
							<i class="<?php echo esc_attr(get_theme_mod('coffee_espresso_youtube_icon', 'fab fa-youtube')); ?>"></i>
							<span class="screen-reader-text"><?php esc_html_e('Youtube', 'coffee-espresso'); ?></span>
						</a>
					<?php } ?>
				</div>
            </div>
            <?php
    }
}
add_action('wp_footer', 'coffee_espresso_footer_social_links');

if ( ! function_exists( 'coffee_espresso_footer_widget' ) ) :
	function coffee_espresso_footer_widget() {
		$coffee_espresso_footer_widget_column = get_theme_mod('coffee_espresso_footer_widget_column','4');

		$coffee_espresso_column_class = '';
		if ($coffee_espresso_footer_widget_column == '1') {
			$coffee_espresso_column_class = 'one-column';
		} elseif ($coffee_espresso_footer_widget_column == '2') {
			$coffee_espresso_column_class = 'two-columns';
		} elseif ($coffee_espresso_footer_widget_column == '3') {
			$coffee_espresso_column_class = 'three-columns';
		} else {
			$coffee_espresso_column_class = 'four-columns';
		}
	
		if($coffee_espresso_footer_widget_column !== ''): 
		?>
		<div class="dt_footer-widgets <?php echo esc_attr($coffee_espresso_column_class); ?> wow bounceInUp delay-1000" data-wow-duration="2s">
			<div class="footer-widgets-column">
				<?php
				$footer_widgets_active = false;

				// Loop to check if any footer widget is active
				for ($coffee_espresso_i = 1; $coffee_espresso_i <= $coffee_espresso_footer_widget_column; $coffee_espresso_i++) {
					if (is_active_sidebar('footer-widget-' . $coffee_espresso_i)) {
						$footer_widgets_active = true;
						break;
					}
				}

				if ($footer_widgets_active) {
					// Display active footer widgets
					for ($coffee_espresso_i = 1; $coffee_espresso_i <= $coffee_espresso_footer_widget_column; $coffee_espresso_i++) {
						if (is_active_sidebar('footer-widget-' . $coffee_espresso_i)) : ?>
							<div class="footer-one-column">
								<?php dynamic_sidebar('footer-widget-' . $coffee_espresso_i); ?>
							</div>
						<?php endif;
					}
				} else {
				?>
				<div class="footer-one-column default-widgets">
					<aside id="search-2" class="widget widget_search default_footer_search">
						<div class="widget-header">
							<h4 class="widget-title"><?php esc_html_e('Search Here', 'coffee-espresso'); ?></h4>
						</div>
						<?php get_search_form(); ?>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="recent-posts-2" class="widget widget_recent_entries">
						<h2 class="widget-title"><?php esc_html_e('Recent Posts', 'coffee-espresso'); ?></h2>
						<ul>
							<?php
							$recent_posts = wp_get_recent_posts(array(
								'numberposts' => 5,
								'post_status' => 'publish',
							));
							foreach ($recent_posts as $post) {
								echo '<li><a href="' . esc_url(get_permalink($post['ID'])) . '">' . esc_html($post['post_title']) . '</a></li>';
							}
							wp_reset_query();
							?>
						</ul>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="recent-comments-2" class="widget widget_recent_comments">
						<h2 class="widget-title"><?php esc_html_e('Recent Comments', 'coffee-espresso'); ?></h2>
						<ul>
							<?php
							$recent_comments = get_comments(array(
								'number' => 5,
								'status' => 'approve',
							));
							foreach ($recent_comments as $comment) {
								echo '<li><a href="' . esc_url(get_comment_link($comment)) . '">' .
									/* translators: %s: details. */
									sprintf(esc_html__('Comment on %s', 'coffee-espresso'), get_the_title($comment->comment_post_ID)) .
									'</a></li>';
							}
							?>
						</ul>
					</aside>
				</div>
				<div class="footer-one-column default-widgets">
					<aside id="categories" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer1', 'coffee-espresso'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Categories', 'coffee-espresso'); ?></h3>
                        <ul>
                            <?php wp_list_categories('title_li=&number=5'); ?>
                        </ul>
                    </aside>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php
		endif;
	}
	endif;
add_action( 'coffee_espresso_footer_widget', 'coffee_espresso_footer_widget' );


function coffee_espresso_footer_text_transform_css() {
    $coffee_espresso_footer_text_transform = get_theme_mod('footer_text_transform', 'none');
    ?>
    <style type="text/css">
        .site-footer h4,footer#colophon h2.wp-block-heading,footer#colophon .widgettitle,footer#colophon .widget-title {
            text-transform: <?php echo esc_html($coffee_espresso_footer_text_transform); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'coffee_espresso_footer_text_transform_css');

/**
 * GET START FUNCTION
 */

 function coffee_espresso_getpage_css($hook) {
	wp_enqueue_script( 'coffee-espresso-admin-script', get_template_directory_uri() . '/resource/js/coffee-espresso-admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script( 'coffee-espresso-admin-script', 'coffee_espresso_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
    wp_enqueue_style( 'coffee-espresso-notice-style', get_template_directory_uri() . '/resource/css/notice.css' );
}

add_action( 'admin_enqueue_scripts', 'coffee_espresso_getpage_css' );

add_action('wp_ajax_coffee_espresso_dismissable_notice', 'coffee_espresso_dismissable_notice');
function coffee_espresso_switch_theme() {
    delete_user_meta(get_current_user_id(), 'coffee_espresso_dismissable_notice');
}
add_action('after_switch_theme', 'coffee_espresso_switch_theme');
function coffee_espresso_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'coffee_espresso_dismissable_notice', true);
    die();
}

function coffee_espresso_deprecated_hook_admin_notice() {
    global $pagenow;
    
    // Check if the current page is the one where you don't want the notice to appear
    if ( $pagenow === 'themes.php' && isset( $_GET['page'] ) && $_GET['page'] === 'coffee-espresso-getting-started' ) {
        return;
    }

    $dismissed = get_user_meta( get_current_user_id(), 'coffee_espresso_dismissable_notice', true );
    if ( !$dismissed) { ?>
        <div class="getstrat updated notice notice-success is-dismissible notice-get-started-class">
            <div class="at-admin-content" >
                <h2><?php esc_html_e('Welcome to Coffee Espresso', 'coffee-espresso'); ?></h2>
                <p><?php _e('Explore the features of our Pro Theme and take your Coffee Espresso journey to the next level.', 'coffee-espresso'); ?></p>
                <p ><?php _e('Get Started With Theme By Clicking On Getting Started.', 'coffee-espresso'); ?><p>
                <div style="display: flex; justify-content: center; align-items:center; flex-wrap: wrap; gap: 5px">
                    <a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=coffee-espresso-getting-started' )); ?>"><?php esc_html_e( 'Get started', 'coffee-espresso' ) ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="https://demo.asterthemes.com/coffee-bistro/"><?php esc_html_e('View Demo', 'coffee-espresso') ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( COFFEE_ESPRESSO_PREMIUM_PAGE ); ?>"><?php esc_html_e('Buy Now', 'coffee-espresso') ?></a>
                    <a  class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( COFFEE_ESPRESSO_BUNDLE_PAGE ); ?>"><?php esc_html_e('Get Bundle', 'coffee-espresso') ?></a>
                </div>
            </div>
            <div class="at-admin-image">
                <img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
            </div>
        </div>
    <?php }
}
add_action( 'admin_notices', 'coffee_espresso_deprecated_hook_admin_notice' );


//Admin Notice For Getstart
function coffee_espresso_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}