<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.enweby.com/
 * @since      1.0.0
 *
 * @package    Header_Footer_Custom_Html
 * @subpackage Header_Footer_Custom_Html/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Header_Footer_Custom_Html
 * @subpackage Header_Footer_Custom_Html/public
 * @author     Enweby <support@enweby.com>
 */
class Header_Footer_Custom_Html_Public {

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
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/header-footer-custom-html-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/header-footer-custom-html-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Getting Custom html code for header
	 *
	 * @since    1.0.0
	 */
	public function enweby_get_custom_html_header() {
		$custom_html_header = get_option( 'enweby_hfch_header_html', '' );
		$custom_html_header = '<div class="hfch-header">' . $custom_html_header . '</div>';
		echo wp_kses_post( apply_filters( 'enweby_get_custom_html_header', $custom_html_header ) );
	}


	/**
	 * Getting Custom html code for header
	 *
	 * @since    1.0.0
	 */
	public function enweby_get_custom_html_footer() {
		$custom_html_footer = get_option( 'enweby_hfch_footer_html', '' );
		$custom_html_footer = '<div class="hfch-footer">' . $custom_html_footer . '</div>';
		echo wp_kses_post( apply_filters( 'enweby_get_custom_html_footer', $custom_html_footer ) );
	}

	/**
	 * Getting Custom css and processing
	 *
	 * @since    1.0.0
	 */
	public function enweby_get_custom_css() {
		$custom_css          = get_option( 'enweby_hfch_custom_css', '' );
		$custom_css_filtered = wp_kses_post( apply_filters( 'enweby_get_custom_css', $custom_css ) );
		wp_add_inline_style( 'header-footer-custom-html', $custom_css_filtered ); // where header-footer-custom-html is plugin name.
	}
}
