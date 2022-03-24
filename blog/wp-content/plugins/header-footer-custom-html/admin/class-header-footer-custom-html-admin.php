<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.enweby.com/
 * @since      1.0.0
 *
 * @package    Header_Footer_Custom_Html
 * @subpackage Header_Footer_Custom_Html/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Header_Footer_Custom_Html
 * @subpackage Header_Footer_Custom_Html/admin
 * @author     Enweby <support@enweby.com>
 */
class Header_Footer_Custom_Html_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;


	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Header_Footer_Custom_Html_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Header_Footer_Custom_Html_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/header-footer-custom-html-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Header_Footer_Custom_Html_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Header_Footer_Custom_Html_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/header-footer-custom-html-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * To add Plugin Menu and Settings page
	 */
	public function plugin_menu_settings() {
		// Main Menu Item.
		add_menu_page(
			'Header footer Custom Html',
			'Header footer Custom Html',
			'manage_options',
			'header-footer-custom-html',
			array( $this, 'header_footer_custom_html_main_menu' ),
			'dashicons-editor-code',
			60
		);
	}

	/**
	 * Admin Page Display
	 */
	public function header_footer_custom_html_main_menu() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/hfch-main-menu.php';
	}

	/**
	 * Setting plugin menu element
	 */
	public function menu_settings_using_helper() {

		require_once HEADER_FOOTER_CUSTOM_HTML_DIR . 'vendor/boo-settings-helper/class-boo-settings-helper.php';

		$header_footer_custom_html_settings = array(
			'tabs'     => true,
			'prefix'   => 'enweby_',
			'menu'     => array(
				'slug'       => 'header-footer-custom-html',
				'page_title' => __( 'Header Footer Custom Html', 'header-footer-custom-html' ),
				'menu_title' => __( 'Header Footer Custom Html', 'header-footer-custom-html' ),
				'parent'     => 'admin.php?page=header-footer-custom-html',
				'submenu'    => true,
			),
			'sections' => array(
				// General Section.
				array(
					'id'    => 'hfch_general_section',
					'title' => __( 'General Settings', 'header-footer-custom-html' ),
				),
			),
			'fields'   => array(
				// fields for General section.
				'hfch_general_section' => array(
					array(
						'id'                => 'hfch_header_html',
						'label'             => __( 'Html for Header', 'header-footer-custom-html' ),
						'desc'              => __( 'Code will be inserted just before the header', 'header-footer-custom-html' ),
						'placeholder'       => __( 'Paste your html code here', 'header-footer-custom-html' ),
						'type'              => 'editor',
						'sanitize_callback' => 'sanitize_editor',
					),
					array(
						'id'                => 'hfch_footer_html',
						'label'             => __( 'Html for footer', 'header-footer-custom-html' ),
						'desc'              => __( 'Html code in this area will go in footer after the footer content', 'header-footer-custom-html' ),
						'placeholder'       => __( 'Paste your html code here', 'header-footer-custom-html' ),
						'type'              => 'editor',
						'sanitize_callback' => 'sanitize_editor',
					),
					array(
						'id'                => 'hfch_custom_css',
						'label'             => __( 'Custom CSS', 'header-footer-custom-html' ),
						'desc'              => __( 'Your custom CSS code will go here', 'header-footer-custom-html' ),
						'placeholder'       => __( 'Paste your css code', 'header-footer-custom-html' ),
						'type'              => 'editor',
						'sanitize_callback' => 'sanitize_editor',
					),
				),
			),
		);

		new Boo_Settings_Helper( $header_footer_custom_html_settings );

	}

	/**
	 * Action links for admin.
	 *
	 * @param  array $links Array of action links.
	 * @return array
	 */
	public function plugin_action_links( $links ) {

		$settings_link = esc_url( add_query_arg( array( 'page' => 'header-footer-custom-html' ), admin_url( 'admin.php' ) ) );

		$new_links['settings'] = sprintf( '<a href="%1$s" title="%2$s">%2$s</a>', $settings_link, esc_attr__( 'Settings', 'header-footer-custom-html' ) );
		// phpcs:disable
		/*
		if ( ! class_exists( 'Header_Footer_Custom_Html_Pro' ) ){
			$pro_link = esc_url( add_query_arg( array( 'utm_source' => 'wp-admin-plugins', 'utm_medium' => 'go	-pro', 'utm_campaign' => 'header-footer-custom-html' ), 'https://www.enweby.com/shop/wordpress-plugins/header-footer-custom-html/' ) );
			$new_links[ 'go-pro' ] = sprintf( '<a target="_blank" style="color: #45b450; font-weight: bold;" href="%1$s" title="%2$s">%2$s</a>', $pro_link, esc_attr__('Go Pro', 'header-footer-custom-html' ) );
		}*/
		// phpcs:enable
		return array_merge( $links, $new_links );
	}

	/**
	 * Plugin row meta.
	 *
	 * @param  array  $links array of row meta.
	 * @param  string $file  plugin base name.
	 * @return array
	 */
	public function plugin_row_meta( $links, $file ) {
		// phpcs:ignore
		if ( $file === HEADER_FOOTER_CUSTOM_HTML_BASE_NAME ) {

			$report_url = add_query_arg(
				array(
					'utm_source'   => 'wp-admin-plugins',
					'utm_medium'   => 'row-meta-link',
					'utm_campaign' => 'header-footer-custom-html',
				),
				'https://www.enweby.com/shop/wordpress-plugins/header-footer-custom-html#support/'
			);

			$documentation_url = add_query_arg(
				array(
					'utm_source'   => 'wp-admin-plugins',
					'utm_medium'   => 'row-meta-link',
					'utm_campaign' => 'header-footer-custom-html',
				),
				'https://www.enweby.com/shop/wordpress-plugins/header-footer-custom-html#documentation/'
			);

			$row_meta['documentation'] = sprintf( '<a target="_blank" href="%1$s" title="%2$s">%2$s</a>', esc_url( $documentation_url ), esc_html__( 'Documentation', 'header-footer-custom-html' ) );
			// phpcs:ignore
			$row_meta['issues']        = sprintf( '%2$s <a target="_blank" href="%1$s">%3$s</a>', esc_url( $report_url ), esc_html__( '', 'header-footer-custom-html' ), '<span style="color: #45b450;font-weight:bold;">' . esc_html__( 'Get Support', 'header-footer-custom-html' ) . '</span>' );

			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}
