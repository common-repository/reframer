<?php

/**
 * Main Admin class
 * @class Reframer_Admin
 * @version	1.0.2
 * @since 1.0.0
 * @package	Reframer
 * @author Mohan Dere
 */
class Reframer_Admin{

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 */
	public function __construct( $token, $version ) {
		$this->token = $token;
		$this->version = $version;

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		$this->init();

	}

	/**
	 * Load required files and initialize class
	 * @access  public
	 * @since   1.0.0
	 */
	public function init(){

		require_once plugin_dir_path( __FILE__ ) . 'class-reframer-settings-page.php';
		$refremer_settings_page = new Reframer_Settings_Page( $this->token, $this->version);

	}//End init()


	/**
	 * Load admin side Stylesheets
	 * @access  public
	 * @since    1.0.0
	 */
	 public function enqueue_styles( $hook ) {

	 	if ( 'settings_page_reframer-setting-page' != $hook ) {
        return;
    }
	 	$base_style_handle = $this->token . '-admin';

		wp_enqueue_style( $base_style_handle, plugin_dir_url( __FILE__ ) . 'css/reframer-admin.min.css', array(), $this->version, 'all' );
	 }

	/**
	 * Load admin side JavaScript files
	 * @access  public
	 * @since    1.0.0
	 */
	 public function enqueue_scripts( $hook ) {

	 	if ( 'settings_page_reframer-setting-page' != $hook ) {
        return;
    }

		$base_script_handle = $this->token . '-admin';

		wp_enqueue_script( 'underscore' );
		wp_enqueue_script( 'backbone' );
		wp_enqueue_script( $base_script_handle, plugin_dir_url( __FILE__ ) . 'js/reframer-admin.min.js', array( 'jquery', 'underscore', 'backbone' ), $this->version, false );
	 }



}
