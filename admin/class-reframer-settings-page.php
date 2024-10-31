<?php

/**
 * Reframer admin settings page class
 * @class Reframer_Settings_Page
 * @version	1.0.2
 * @since 1.0.0
 * @package	Reframer
 * @author Mohan Dere
 */
class Reframer_Settings_Page{
	/**
	 * Holds the values to be used in the fields callbacks
	 * @var     string
	 * @access  private
	 * @since   1.0.0
	 */
	private $options;

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
	* Start up
	*/
	public function __construct( $token, $version )
	{
		$this->token = $token;
		$this->version = $version;

	  add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
	  add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page()
	{
	    // This page will be under "Settings"
	    add_options_page(
	        'Reframer Settings',
	        'Reframer',
	        'manage_options',
	        'reframer-setting-page',
	        array( $this, 'create_admin_page' )
	    );
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page()
	{
	    // Set class property
	    $this->options = get_option( 'reframer_option' );
	    ?>
	    <div id="reframer-options-page-view" class="wrap">
	        <h1><?php _e('Reframer Settings', $this->token); ?></h1>
	        <p><?php _e('Reframe unresponsive elements responsively.',$this->token ); ?></p>
					<hr/>
	        <form method="post" action="options.php">
	        <?php
	            // This prints out all hidden setting fields
	            settings_fields( 'reframer_option_group' );
	            do_settings_sections( 'reframer-setting-page' );
	            submit_button();
	        ?>
	        </form>
	    </div>
	    <?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init()
	{
	    register_setting(
	        'reframer_option_group', // Option group
	        'reframer_option', // Option name
	        array( $this, 'sanitize' ) // Sanitize
	    );

	    add_settings_section(
	        'reframer_setting_section_1', // ID
	        'DOM', // Title
	        array( $this, 'print_section_info' ), // Callback
	        'reframer-setting-page' // Page
	    );

	    add_settings_field(
	        'dom_selectors', // ID
	        'DOM Selectors', // Title
	        array( $this, 'dom_selectors_callback' ), // Callback
	        'reframer-setting-page', // Page
	        'reframer_setting_section_1' // Section
	    );

	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ){
	    return $input;
	}

	/**
	 * Print the Section text
	 */
	public function print_section_info()
	{
		?>

    <p><?php _e('Configure HTML elements to make them responsive.', $this->token); ?></p>
    <p><?php _e('All <a href="https://api.jquery.com/category/selectors/" target="_blank">jQuery DOM selectors</a> allowed.', $this->token); ?></p>
    <p><?php _e('Examples: iframe, video, .youtube, #vimeo ...', $this->token); ?></p>


	  <?php
	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function dom_selectors_callback()
	{
			$default_DOM_selectors = '';
			$isset = isset( $this->options['dom_selectors'] ) ? esc_attr( $this->options['dom_selectors']) : '';
	    printf(
	        '<input type="text" id="dom_selectors" name="reframer_option[dom_selectors]" class="tags" value="%s" />',
					($isset) ? $isset : $default_DOM_selectors
	    );
	}

}