<?php
/**
 * Wizard
 *
 * @package Whizzie
 * @author Aster Themes
 * @since 1.0.0
 */

class Whizzie {

	protected $version = '1.1.0';
	protected $theme_name = '';
	protected $theme_title = '';
	protected $page_slug = '';
	protected $page_title = '';
	protected $config_steps = array();
	public $plugin_path;
	public $parent_slug;
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $plugin_url = '';

	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';

	/*** Constructor ***
	* @param $config	Our config parameters
	*/
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}

	/**
	* Set some settings
	* @since 1.0.0
	* @param $config	Our config parameters
	*/

	public function set_vars( $config ) {
		// require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['page_slug'] ) ) {
			$this->page_slug = esc_attr( $config['page_slug'] );
		}
		if( isset( $config['page_title'] ) ) {
			$this->page_title = esc_attr( $config['page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}

		$this->plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->plugin_path );
		$this->plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$current_theme = wp_get_theme();
		$this->theme_title = $current_theme->get( 'Name' );
		$this->theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_theme->get( 'Name' ) ) );
		$this->page_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_page_slug', $this->theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_parent_slug', '' );
	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */
	public function init() {
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'theme-wizard-style', get_template_directory_uri() . '/theme-wizard/assets/css/theme-wizard-style.css');
		wp_register_script( 'theme-wizard-script', get_template_directory_uri() . '/theme-wizard/assets/js/theme-wizard-script.js', array( 'jquery' ) );

		wp_localize_script(
			'theme-wizard-script',
			'coffee_espresso_whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'verify_text'	=> esc_html( 'verifying', 'coffee-espresso' )
			)
		);
		wp_enqueue_script( 'theme-wizard-script' );
	}

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2*/
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}

	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}

	/***        Make a modal screen for the wizard        ***/
	
	public function menu_page() {
		add_theme_page( esc_html( $this->page_title ), esc_html( $this->page_title ), 'manage_options', $this->page_slug, array( $this, 'coffee_espresso_setup_wizard' ) );
	}

	/***        Make an interface for the wizard        ***/

	public function wizard_page() {
		tgmpa_load_bulk_installer();
		// install plugins with TGM.
		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( 'Failed to find TGM' );
		}
		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );

		// copied from TGM
		$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.
		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		// Now we have some credentials, setup WP_Filesystem.
		if ( ! WP_Filesystem( $creds ) ) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}
		/* If we arrive here, we have the filesystem */ ?>
		<div class="main-wrap">
			<?php
			echo '<div class="card whizzie-wrap">';
				// The wizard is a list with only one item visible at a time
				$steps = $this->get_steps();
				echo '<ul class="whizzie-menu">';
				foreach( $steps as $step ) {
					$class = 'step step-' . esc_attr( $step['id'] );
					echo '<li data-step="' . esc_attr( $step['id'] ) . '" class="' . esc_attr( $class ) . '">';
						printf( '<h2>%s</h2>', esc_html( $step['title'] ) );
						// $content is split into summary and detail
						$content = call_user_func( array( $this, $step['view'] ) );
						if( isset( $content['summary'] ) ) {
							printf(
								'<div class="summary">%s</div>',
								wp_kses_post( $content['summary'] )
							);
						}
						if( isset( $content['detail'] ) ) {
							// Add a link to see more detail
							printf( '<p><a href="#" class="more-info">%s</a></p>', __( 'More Info', 'coffee-espresso' ) );
							printf(
								'<div class="detail">%s</div>',
								$content['detail'] // Need to escape this
							);
						}
						// The next button
						if( isset( $step['button_text'] ) && $step['button_text'] ) {
                            ?>
                            <?php if ( ! get_option('is-demo-imported') ) : ?>
                            <?php
                            printf(
                                '<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
                                esc_attr( $step['callback'] ),
                                esc_attr( $step['id'] ),
                                esc_html( $step['button_text'] )
                            );
                            ?>
                            <?php else : ?>
                                <a target="_blank" href="<?php echo esc_url( home_url() ); ?>" class="button button-primary" style="margin: auto; font-size: 20px; font-weight: 600">
                                    <?php esc_html_e( 'Visit Site', 'coffee-espresso' ); ?>
                                </a>
                            <?php endif; ?>
                            <?php
                        }
					echo '</li>';
				}
				echo '</ul>';
				?>
				<div class="step-loading"><span class="spinner"></span></div>
			</div><!-- .whizzie-wrap -->

		</div><!-- .wrap -->
	<?php }



	public function activation_page() {
		?>
		<div class="main-wrap">
			<h3><?php esc_html_e('Theme Setup Wizard','coffee-espresso'); ?></h3>
		</div>
		<?php
	}

	public function coffee_espresso_setup_wizard(){

			$display_string = '';

			$body = [
				'home_url'					 => home_url(),
				'theme_text_domain'	 => wp_get_theme()->get( 'TextDomain' )
			];

			$body = wp_json_encode( $body );
			$options = [
				'body'        => $body,
				'sslverify' 	=> false,
				'headers'     => [
					'Content-Type' => 'application/json',
				]
			];

			//custom function about theme customizer
			$return = add_query_arg( array()) ;
			$theme = wp_get_theme( 'coffee-espresso' );

			?>
				<div class="wrapper-info get-stared-page-wrap">
					<div class="tab-sec theme-option-tab">
						<div id="demo_offer" class="tabcontent">
							<?php $this->wizard_page(); ?>
						</div>
					</div>
				</div>
			<?php
	}
	

	/**
	* Set options for the steps
	* Incorporate any options set by the theme dev
	* Return the array for the steps
	* @return Array
	*/
	public function get_steps() {
		$dev_steps = $this->config_steps;
		$steps = array(
			'intro' => array(
				'id'			=> 'intro',
				'title'			=> __( 'Welcome to ', 'coffee-espresso' ) . $this->theme_title,
				'icon'			=> 'dashboard',
				'view'			=> 'get_step_intro', // Callback for content
				'callback'		=> 'do_next_step', // Callback for JS
				'button_text'	=> __( 'Start Now', 'coffee-espresso' ),
				'can_skip'		=> false // Show a skip button?
			),
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Plugins', 'coffee-espresso' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'coffee-espresso' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Demo Importer', 'coffee-espresso' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text'	=> __( 'Import Demo', 'coffee-espresso' ),
				'can_skip'		=> true
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'coffee-espresso' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);

		// Iterate through each step and replace with dev config values
		if( $dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $dev_steps as $dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $dev_step['id'] ) ) {
					$id = $dev_step['id'];
					if( isset( $steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $dev_step[$element] ) ) {
								$steps[$id][$element] = $dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $steps;
	}

	/*** Display the content for the intro step ***/
	public function get_step_intro() { ?>
		<div class="summary">
			<p style="text-align: center;"><?php esc_html_e( 'Thank you for choosing our theme! We are excited to help you get started with your new website.', 'coffee-espresso' ); ?></p>
			<p style="text-align: center;"><?php esc_html_e( 'This section will guide you through setting up and customizing the theme. You can follow the steps to import demo content or adjust settings at any time to make the website look and work the way you want.', 'coffee-espresso' ); ?></p>
		</div>
	<?php }
	
	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); ?>
			<div class="summary">
				<p>
					<?php esc_html_e('Additional plugins always make your website exceptional. Install these plugins by clicking the install button. You may also deactivate them from the dashboard.','coffee-espresso') ?>
				</p>
			</div>
		<?php // The detail element is initially hidden from the user
		$content['detail'] = '<ul class="whizzie-do-plugins">';
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
			$keys = array();
			if ( isset( $plugins['install'][ $slug ] ) ) {
			    $keys[] = 'Installation';
			}
			if ( isset( $plugins['update'][ $slug ] ) ) {
			    $keys[] = 'Update';
			}
			if ( isset( $plugins['activate'][ $slug ] ) ) {
			    $keys[] = 'Activation';
			}
			$content['detail'] .= implode( ' and ', $keys ) . ' required';
			$content['detail'] .= '</span></li>';
		}
		$content['detail'] .= '</ul>';

		return $content;
	}

	/*** Display the content for the widgets step ***/
	public function get_step_widgets() { ?>
		<div class="summary">
			<p><?php esc_html_e('To get started, use the button below to import demo content and add widgets to your site. After installation, you can manage settings and customize your site using the Customizer. Enjoy your new theme!', 'coffee-espresso'); ?></p>
		</div>
	<?php }

	/***        Print the content for the final step        ***/

	public function get_step_done() { ?>
		<div id="aster-demo-setup-guid">
			<div class="aster-setup-menu">
				<h3><?php esc_html_e('Setup Navigation Menu','coffee-espresso'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Menu','coffee-espresso'); ?></p>
				<h4><?php esc_html_e('A) Create Pages','coffee-espresso'); ?></h4>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Pages >> Add New','coffee-espresso'); ?></li>
					<li><?php esc_html_e('Enter Page Details And Save Changes','coffee-espresso'); ?></li>
				</ol>
				<h4><?php esc_html_e('B) Add Pages To Menu','coffee-espresso'); ?></h4>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Menu','coffee-espresso'); ?></li>
					<li><?php esc_html_e('Click On The Create Menu Option','coffee-espresso'); ?></li>
					<li><?php esc_html_e('Select The Pages And Click On The Add to Menu Button','coffee-espresso'); ?></li>
					<li><?php esc_html_e('Select Primary Menu From The Menu Setting','coffee-espresso'); ?></li>
					<li><?php esc_html_e('Click On The Save Menu Button','coffee-espresso'); ?></li>
				</ol>
			</div>
			<div class="aster-setup-widget">
				<h3><?php esc_html_e('Setup Footer Widgets','coffee-espresso'); ?></h3>
				<p><?php esc_html_e('Follow the following Steps to Setup Footer Widgets','coffee-espresso'); ?></p>
				<ol>
					<li><?php esc_html_e('Go to Dashboard >> Appearance >> Widgets','coffee-espresso'); ?></li>
					<li><?php esc_html_e('Drag And Add The Widgets In The Footer Columns','coffee-espresso'); ?></li>
				</ol>
			</div>
			<div style="display:flex; justify-content: center; margin-top: 20px; gap:20px">
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url(home_url()); ?>" class="button button-primary">Visit Site</a>
				</div>
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>" class="button button-primary">Customize Your Demo</a>
				</div>
				<div class="aster-setup-finish">
					<a target="_blank" href="<?php echo esc_url( admin_url('themes.php?page=coffee-espresso-getting-started') ); ?>" class="button button-primary">Dashboard</a>
				</div>
			</div>
		</div>
	<?php }

	/***       Get the plugins registered with TGMPA       ***/
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}


	public function setup_plugins() {
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();

		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','coffee-espresso' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','coffee-espresso' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','coffee-espresso' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','coffee-espresso' ) ) );
		}
		exit;
	}

	/***------------------------------------------------- Imports the Demo Content* @since 1.1.0 ----------------------------------------------****/


	//  ------------- MENUS ----------------- //

	public function coffee_espresso_customizer_primary_menu(){

	$menu_name = 'Main Menu';
	$menu_location = 'primary';

	$menu_exists = wp_get_nav_menu_object( $menu_name );

	if ( ! $menu_exists ) {

		$menu_id = wp_create_nav_menu( $menu_name );

		// HOME
		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'  => __('Home','coffee-espresso'),
			'menu-item-url'    => home_url('/'),
			'menu-item-status' => 'publish'
		));

		// ABOUT PAGE 
		$about = get_page_by_title('About');
		if( ! $about ){
			$about_id = wp_insert_post(array(
				'post_type' => 'page',
				'post_title' => 'About',
				'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
				'post_status' => 'publish'
			));
		} else {
			$about_id = $about->ID;
		}

		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'  => __('About','coffee-espresso'),
			'menu-item-url'    => get_permalink($about_id),
			'menu-item-status' => 'publish'
		));

		// MENU PAGE 
		$menu_page = get_page_by_title('Menu');
		if( ! $menu_page ){
			$menu_page_id = wp_insert_post(array(
				'post_type' => 'page',
				'post_title' => 'Menu',
				'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
				'post_status' => 'publish'
			));
		} else {
			$menu_page_id = $menu_page->ID;
		}

		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'  => __('Menu','coffee-espresso'),
			'menu-item-url'    => get_permalink($menu_page_id),
			'menu-item-status' => 'publish'
		));

		// BLOG PAGE
		$blog = get_page_by_title('Blog');
		if( $blog ){
			$blog_id = $blog->ID;
		} else {
			$blog_id = wp_insert_post(array(
				'post_type' => 'page',
				'post_title' => 'Blog',
				'post_status' => 'publish'
			));
		}

		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'  => __('Blog','coffee-espresso'),
			'menu-item-url'    => get_permalink($blog_id),
			'menu-item-status' => 'publish'
		));

		// CONTACT PAGE
		$contact = get_page_by_title('Contact');
		if( ! $contact ){
			$contact_id = wp_insert_post(array(
				'post_type' => 'page',
				'post_title' => 'Contact',
				'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
				'post_status' => 'publish'
			));
		} else {
			$contact_id = $contact->ID;
		}

		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'  => __('Contact','coffee-espresso'),
			'menu-item-url'    => get_permalink($contact_id),
			'menu-item-status' => 'publish'
		));

		// ASSIGN MENU LOCATION
		if ( ! has_nav_menu( $menu_location ) ) {
			$locations = get_theme_mod('nav_menu_locations');
			$locations[$menu_location] = $menu_id;
			set_theme_mod('nav_menu_locations', $locations);
		}
	}
}

	public function setup_widgets() {

		// Create a front page and assigned the template
		$coffee_espresso_home_title = 'Home';
		$coffee_espresso_home_check = get_page_by_title($coffee_espresso_home_title);
		$coffee_espresso_home = array(
			'post_type' => 'page',
			'post_title' => $coffee_espresso_home_title,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'home'
		);
		$coffee_espresso_home_id = wp_insert_post($coffee_espresso_home);

		//Set the static front page
		$coffee_espresso_home = get_page_by_title( 'Home' );
		update_option( 'page_on_front', $coffee_espresso_home->ID );
		update_option( 'show_on_front', 'page' );

		// Create a Women and assigned the template
		$coffee_espresso_gallery_title = 'Pages';
		$coffee_espresso_gallery_check = get_page_by_title($coffee_espresso_gallery_title);
		$coffee_espresso_gallery = array(
			'post_type' => 'page',
			'post_title' => $coffee_espresso_gallery_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'pages'
		);
		$coffee_espresso_gallery_id = wp_insert_post($coffee_espresso_gallery);

		// Create Services Page
		$coffee_espresso_services_title = 'Services';
		$coffee_espresso_services = get_page_by_title($coffee_espresso_services_title);

		if (!$coffee_espresso_services) {
			$coffee_espresso_services = array(
				'post_type'    => 'page',
				'post_title'   => $coffee_espresso_services_title,
				'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
				'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'services'
			);

			$coffee_espresso_services_id = wp_insert_post($coffee_espresso_services);

			if (is_wp_error($coffee_espresso_services_id)) {
				// Handle error
			}
		} else {
			$coffee_espresso_services_id = $coffee_espresso_services->ID;
		}

		// Create a Contact and assigned the template
		$coffee_espresso_contact_title = 'Pages';
		$coffee_espresso_contact_check = get_page_by_title($coffee_espresso_contact_title);
		$coffee_espresso_contact = array(
			'post_type' => 'page',
			'post_title' => $coffee_espresso_contact_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'pages'
		);
		$coffee_espresso_contact_id = wp_insert_post($coffee_espresso_contact);

		// Create a posts page and assigned the template
		$coffee_espresso_blog_title = 'Blog';
		$coffee_espresso_blog = get_page_by_title($coffee_espresso_blog_title);

		if (!$coffee_espresso_blog) {
			$coffee_espresso_blog = array(
				'post_type' => 'page',
				'post_title' => $coffee_espresso_blog_title,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_slug' => 'blog'
			);
			$coffee_espresso_blog_id = wp_insert_post($coffee_espresso_blog);

			if (is_wp_error($coffee_espresso_blog_id)) {
				// Handle error
			}
		} else {
			$coffee_espresso_blog_id = $coffee_espresso_blog->ID;
		}
		// Set the posts page
		update_option('page_for_posts', $coffee_espresso_blog_id);

		$coffee_espresso_contact_title = 'Shop';

		$coffee_espresso_contact_check = get_page_by_title( $coffee_espresso_contact_title );

		if ( ! $coffee_espresso_contact_check ) {

			$coffee_espresso_contact = array(
				'post_type'    => 'page',
				'post_title'   => $coffee_espresso_contact_title,
				'post_content' => '',
				'post_status'  => 'publish',
				'post_author'  => 1,
				'post_name'    => 'shop', // slug
			);

			$coffee_espresso_shop_page_id = wp_insert_post( $coffee_espresso_contact );

		} else {
			$coffee_espresso_shop_page_id = $coffee_espresso_contact_check->ID;
		}

		if ( function_exists( 'wc_get_page_id' ) ) {
			update_option( 'woocommerce_shop_page_id', $coffee_espresso_shop_page_id );
		}

		// Create a Contact and assigned the template
		$coffee_espresso_contact_title = 'Contact Us';
		$coffee_espresso_contact_check = get_page_by_title($coffee_espresso_contact_title);
		$coffee_espresso_contact = array(
			'post_type' => 'page',
			'post_title' => $coffee_espresso_contact_title,
			'post_content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_slug' => 'contact-us'
		);
		$coffee_espresso_contact_id = wp_insert_post($coffee_espresso_contact);

		// Header Button
		set_theme_mod( 'coffee_espresso_order_view_button_text', 'Order Online' );
		set_theme_mod( 'coffee_espresso_order_view_button_url', '#' );


	// Enable Topbar
	set_theme_mod( 'coffee_espresso_enable_topbar', true );

	// Topbar Content
	set_theme_mod( 'coffee_espresso_discount_topbar_text', 'Welcome To Our Coffee House' );
	set_theme_mod( 'coffee_espresso_topbar_email', 'info@example.com' );
	set_theme_mod( 'coffee_espresso_location_view_button_text', 'Road -02, Block D West London City' );
	set_theme_mod( 'coffee_espresso_location_view_button_url', '#' );

	/*----------------------------------------- Header Section --------------------------------------------------*/

	// Contact Details
	set_theme_mod( 'coffee_espresso_phone_number', '+91 123 456 789' );
	set_theme_mod( 'coffee_espresso_email_topbar_address', 'yoga1256@example.com' );
	set_theme_mod( 'coffee_espresso_header_location', '995 N Broadway, Los Angeles, CA 90012, United States' );

	// Icons
	set_theme_mod( 'coffee_espresso_header_phone_icon', 'fas fa-phone' );
	set_theme_mod( 'coffee_espresso_email_icon', 'fas fa-envelope' );
	set_theme_mod( 'coffee_espresso_location_header_icon', 'fas fa-map-marker-alt' );

	// Enable Social Icons
	set_theme_mod( 'coffee_espresso_enable_header_icon_section', true );

	// Social Links
	set_theme_mod( 'coffee_espresso_header_linkedin_link', 'https://linkedin.com' );
	set_theme_mod( 'coffee_espresso_header_twitter_link', 'https://twitter.com' );
	set_theme_mod( 'coffee_espresso_header_instagram_link', 'https://instagram.com' );
	set_theme_mod( 'coffee_espresso_header_youtube_link', 'https://youtube.com' );

	// Social Icons Classes
	set_theme_mod( 'coffee_espresso_header_linkedin_icon', 'fab fa-linkedin-in' );
	set_theme_mod( 'coffee_espresso_header_twitter_icon', 'fab fa-twitter' );
	set_theme_mod( 'coffee_espresso_header_instagram_icon', 'fab fa-instagram' );
	set_theme_mod( 'coffee_espresso_header_youtube_icon', 'fab fa-youtube' );

	// Header Features
	set_theme_mod( 'coffee_espresso_enable_header_search_section', true );
	set_theme_mod( 'coffee_espresso_enable_sticky_header', true );

	// Menu Colors
	set_theme_mod( 'coffee_espresso_menu_text_color', '#000000' );
	set_theme_mod( 'coffee_espresso_sub_menu_text_color', '#333333' );

	// Layout
	set_theme_mod( 'coffee_espresso_website_layout', false );

	
	// ------------------------- Banner Section -------------------------

		set_theme_mod( 'coffee_espresso_enable_slider_section', true);
		set_theme_mod( 'coffee_espresso_slider_heading', 'Quality services');
		set_theme_mod( 'coffee_espresso_one_word_heading', 'Plumbing');
		set_theme_mod( 'coffee_espresso_slider_button_label', 'Book Now');
		set_theme_mod( 'coffee_espresso_slider_button_link', '#');

		$coffee_espresso_category_slider = get_term_by( 'name', 'Slider', 'category' );
		if ( ! $coffee_espresso_category_slider ) {
			$coffee_espresso_category_slider = wp_create_category( 'Slider' );
		} else {
			$coffee_espresso_category_slider = $coffee_espresso_category_slider->term_id;
		}

		// Set the theme mod with the Slider category ID
		set_theme_mod( 'coffee_espresso_slider_slider_category', 'Slider' );

		// Post titles and slider image filenames
		$slider_post_titles = array(
			'We provide top notch plumbing & repair services',
			'Expert Plumbing Solutions for Homes & Businesses',
			'Fast, Affordable & Trusted Repair Services',
		);

		$slider_images = array(
			'slider1.png',
			'slider2.png',
			'slider3.png'
		);

		// Path to theme images
		$slider_img_base_path = get_template_directory() . '/resource/img/';

		foreach ( $slider_post_titles as $i => $title ) {
			$post_exists = get_page_by_title( $title, OBJECT, 'post' );
			if ( $post_exists ) {
				continue;
			}

			$post_id = wp_insert_post( array(
				'post_title'    => $title,
				'post_content'  => 'Our team of experts is equipped to assist you with a variety of pipe repair needs. Please share your email address to connect with us. ',
				'post_status'   => 'publish',
				'post_category' => array( $coffee_espresso_category_slider ),
			) );

			$filename = $slider_images[$i];
			$file     = $slider_img_base_path . $filename;

			if ( file_exists( $file ) ) {
				require_once ABSPATH . 'wp-admin/includes/image.php';
				require_once ABSPATH . 'wp-admin/includes/file.php';
				require_once ABSPATH . 'wp-admin/includes/media.php';

				$upload = wp_upload_bits( $filename, null, file_get_contents( $file ) );
				if ( ! $upload['error'] ) {
					$wp_filetype = wp_check_filetype( $upload['file'], null );
					$attachment  = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name( $filename ),
						'post_status'    => 'inherit'
					);
					$attach_id  = wp_insert_attachment( $attachment, $upload['file'], $post_id );
					$attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
					wp_update_attachment_metadata( $attach_id, $attach_data );
					set_post_thumbnail( $post_id, $attach_id );
				}
			}
		}

	// Banner Section Settings
	set_theme_mod( 'coffee_espresso_enable_banner_section', true );
	set_theme_mod( 'coffee_espresso_banner_section_heading', 'We Serve richest coffee in the city!' );
	set_theme_mod( 'coffee_espresso_banner_button_label_one', 'Order Online' );
	set_theme_mod( 'coffee_espresso_banner_button_link_one', '#' );

	// Set banner image (must be URL)
	set_theme_mod( 'coffee_espresso_banner_section_image', get_template_directory_uri() . '/resource/img/banner.jpg' );


/*----------------------------------------- Product Section --------------------------------------------------*/

	// Enable Product Section
	set_theme_mod( 'coffee_espresso_enable_product_section', true );

	// Section Heading
	set_theme_mod( 'coffee_espresso_trending_product_sub_heading', 'Menu' );
	set_theme_mod( 'coffee_espresso_trending_product_heading', 'Explore Our Menu' );

	// Button
	set_theme_mod( 'coffee_espresso_product_view_button_text', 'View All Products' );
	set_theme_mod( 'coffee_espresso_product_view_button_url', '#' );

	// Product Category Slug
	set_theme_mod( 'coffee_espresso_trending_product_category', 'coffee' );


	// CREATE PRODUCT CATEGORY 
	if ( ! term_exists( 'Coffee', 'product_cat' ) ) {
		wp_insert_term(
			'Coffee',
			'product_cat',
			array(
				'slug' => 'coffee',
			)
		);
	}

	//  CREATE DEMO PRODUCTS
	if ( class_exists( 'WooCommerce' ) ) {

		$term = get_term_by( 'slug', 'coffee', 'product_cat' );

  $products = array(
    array(
        'name'  => 'Espresso Coffee',
        'sale_price' => '120', 
		'price' => '150',  
        'image' => 'product1.png'
    ),
    array(
        'name'  => 'Cappuccino Coffee',
       	'sale_price' => '120',   
		'price' => '150',
        'image' => 'product2.png'
    ),
    array(
        'name'  => 'Latte Coffee',
      	'sale_price' => '120',  
		'price' => '150', 
        'image' => 'product3.png'
    ),
    array(
        'name'  => 'Cold Brew Coffee',
        'sale_price' => '120', 
		'price' => '150',  
        'image' => 'product5.png'
    ),

    array(
        'name'  => 'Mocha Coffee',
        'sale_price' => '120', 
		'price' => '150',  
        'image' => 'product4.png'
    ),
    array(
        'name'  => 'Americano Coffee',
        'sale_price' => '120',  
		'price' => '150', 
        'image' => 'product3.png'
    ),
 
);

    $img_path = get_template_directory() . '/resource/img/';

    foreach ( $products as $product_data ) {

        $product = new WC_Product_Simple();
        $product->set_name( $product_data['name'] );

		if ( ! empty( $product_data['sale_price'] ) ) {
			$product->set_sale_price( $product_data['sale_price'] );
			$product->set_price( $product_data['sale_price'] );
		} else {
			$product->set_price( $product_data['price'] );
		}
		 $product->set_regular_price( $product_data['price'] );
        $product->set_status( 'publish' );

        if ( $term ) {
            $product->set_category_ids( array( $term->term_id ) );
        }

        $product_id = $product->save();

		// ===== Add Ratings =====
		update_post_meta( $product_id, '_wc_average_rating', 4.5 );
		update_post_meta( $product_id, '_wc_review_count', 7 );
		update_post_meta( $product_id, '_wc_rating_count', array(
			5 => 6,
			4 => 3,
			3 => 1,
		) );

        // ===== Set Product Image =====
        $file = $img_path . $product_data['image'];

        if ( file_exists( $file ) ) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';

            $upload = wp_upload_bits( $product_data['image'], null, file_get_contents( $file ) );

            if ( ! $upload['error'] ) {
                $wp_filetype = wp_check_filetype( $upload['file'], null );

                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title'     => sanitize_file_name( $product_data['image'] ),
                    'post_status'    => 'inherit'
                );

                $attach_id = wp_insert_attachment( $attachment, $upload['file'], $product_id );
                $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
                wp_update_attachment_metadata( $attach_id, $attach_data );

                set_post_thumbnail( $product_id, $attach_id );
            }
        }
    }
}

// ---------------------------------------- Related post_tag --------------------------------------------------- //	
		
		set_theme_mod('coffee_espresso_post_related_post_label','Related Posts');
		set_theme_mod('coffee_espresso_related_posts_count','3');

		$this->coffee_espresso_customizer_primary_menu();
		update_option('is-demo-imported', true);
	}
}