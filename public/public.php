<?php

/**
 * Main public/UI class
 * @class Reframer_Public
 * @version	1.0.2
 * @since 1.0.0
 * @package	Reframer
 * @author Mohan Dere
 */
class Reframer_Public{

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
	public function __construct ( $token, $version ) {
		$this->token = $token;
		$this->version = $version;

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * load public Stylesheets
	 * @access  public
	 * @since    1.0.0
	 */
	 public function enqueue_styles() {

		 	$base_style_handle = $this->token . '-public';
			wp_enqueue_style( $base_style_handle, plugin_dir_url( __FILE__ ) . 'css/reframer-public.min.css', array(), $this->version, 'all' );
	 }

	/**
	 * Register and load public JavaScript files
	 * @access  public
	 * @since    1.0.0
	 */
	 public function enqueue_scripts() {

		 $reframer_option = get_option( 'reframer_option' );
		 $base_script_handle = $this->token . '-public';


		 wp_enqueue_script( 'underscore' );
		 wp_register_script( $base_script_handle, plugin_dir_url( __FILE__ ) . 'js/reframer-public.min.js', array( 'jquery', 'underscore' ), $this->version, false );
		 $data = array(
			 'dom_selectors' => isset( $reframer_option['dom_selectors'] ) ? $reframer_option['dom_selectors'] : ''
		 );
		 wp_localize_script( $base_script_handle, 'reframer_option', $data );
		 wp_enqueue_script( $base_script_handle );


	 }

}
