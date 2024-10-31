<?php
/**
 * Plugin Name: Reframer
 * Plugin URI: https://github.com/mohandere/reframer
 * Description: Reframer makes unresponsive elements responsive by scaling at a fixed ratio.
 * Version: 1.0.2
 * Author: Mohan Dere
 * Author URI: https://geekymohan.wordpress.com/
 * Requires at least: 4.0.0
 * Tested up to: 4.7.3
 *
 * @package reframer
 * @category Core
 * @author Mohan Dere
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Returns the main instance of Reframer to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Reframer
 */
function Reframer() {
	return Reframer::instance();
} // End Reframer()

add_action( 'plugins_loaded', 'Reframer' );

/**
 * Main Reframer Class
 *
 * @class Reframer
 * @version	1.0.2
 * @since 1.0.0
 * @package	Reframer
 * @author Mohan Dere
 */
final class Reframer {
	/**
	 * Reframer The single instance.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

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
	 * The plugin directory URL.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $plugin_url;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 */
	public function __construct () {
		$this->token 			= 'reframer';
		$this->plugin_url 		= plugin_dir_url( __FILE__ );
		$this->plugin_path 		= plugin_dir_path( __FILE__ );
		$this->version 			= '1.0.2';

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		$this->init();

	} // End __construct()

	/**
	 * Load required files and initialize class
	 * @access  public
	 * @since   1.0.0
	 */
	public function init(){

		if( is_admin() ){
			require_once $this->plugin_path . 'admin/admin.php';
			$reframer_admin = new Reframer_Admin( $this->token, $this->version );
		} else {
			require_once $this->plugin_path . 'public/public.php';
			$reframer_public = new Reframer_Public( $this->token, $this->version );
		}

	} //End init()

	/**
	 * Main Reframer Instance
	 *
	 * Ensures only one instance of Reframer is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Reframer()
	 * @return Main Reframer instance
	 */
	public static function instance () {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()


	/**
	 * Cloning is forbidden.
	 * @access public
	 * @since 1.0.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->version );
	} // End __clone()

	/**
	 * Unserializing instances of this class is forbidden.
	 * @access public
	 * @since 1.0.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->version );
	} // End __wakeup()

	/**
	 * Installation. Runs on activation.
	 * @access  public
	 * @since   1.0.0
	 */
	public function install () {
		$this->_log_version_number();
	} // End install()

	/**
	 * Log the plugin version number.
	 * @access  private
	 * @since   1.0.0
	 */
	private function _log_version_number () {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	} // End _log_version_number()


} // End Class
