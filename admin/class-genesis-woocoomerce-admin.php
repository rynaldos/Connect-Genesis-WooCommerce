<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.developersq.com
 * @since      1.0.0
 *
 * @package    Genesis_Woocommerce
 * @subpackage Genesis_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Genesis_Woocommerce
 * @subpackage Genesis_Woocommerce/admin
 * @author     Aakash Dodiya <hello@developersq.com>
 */
class Genesis_Woocommerce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $genesis_woocoomerce    The ID of this plugin.
	 */
	private $genesis_woocoomerce;

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
	 * @param      string    $genesis_woocoomerce       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $genesis_woocoomerce, $version ) {

		$this->genesis_woocoomerce = $genesis_woocoomerce;
		$this->version = $version;

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
		 * defined in Genesis_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Genesis_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->genesis_woocoomerce, plugin_dir_url( __FILE__ ) . 'css/genesis-woocoomerce-admin.css', array(), $this->version, 'all' );

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
		 * defined in Genesis_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Genesis_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->genesis_woocoomerce, plugin_dir_url( __FILE__ ) . 'js/genesis-woocoomerce-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Add options page in admin.
	 *
	 * @since    1.0.0
	 */
	public function genwoo_create_menu() {

		/**
		 * This function creates plguin's setting menu page in admin
		 */
		add_object_page( __( 'Genesis Woocommerce Settings', 'genesis-woocommerce' ),
		__( 'Genesis Woocommerce', 'genesis-woocommerce' ),
		'administrator', 'genesis-woocommerce',
		array( $this, 'genwoo_settings_page' ), 'dashicons-share-alt' );

	}
	
	public function genwoo_settings_page() { 
		?>
		<form action='options.php' method='post'>
			
			<h2>Genesis Woocommerce</h2>
			
			<?php
			settings_fields( 'pluginPage' );
			do_settings_sections( 'pluginPage' );
			submit_button();
			?>
			
		</form>
		<?php		
	} 
	
	public function genwoo_settings_init(  ) { 

		register_setting( 'pluginPage', 'genwoo_settings' );
	
		add_settings_section(
			'genwoo_pluginPage_section', 
			__( 'Your section description', 'genesis-woocommerce' ), 
			array($this, 'genwoo_settings_section_callback'), 
			'pluginPage'
		);
	
		add_settings_field( 
			'genwoo_text_field_0', 
			__( 'Settings field description', 'genesis-woocommerce' ), 
			array($this, 'genwoo_text_field_0_render'), 
			'pluginPage', 
			'genwoo_pluginPage_section' 
		);
	
		add_settings_field( 
			'genwoo_checkbox_field_1', 
			__( 'Settings field description', 'genesis-woocommerce' ), 
			array($this, 'genwoo_checkbox_field_1_render'), 
			'pluginPage', 
			'genwoo_pluginPage_section' 
		);
	
		add_settings_field( 
			'genwoo_textarea_field_2', 
			__( 'Settings field description', 'genesis-woocommerce' ), 
			array($this,'genwoo_textarea_field_2_render'), 
			'pluginPage', 
			'genwoo_pluginPage_section' 
		);
	
		add_settings_field( 
			'genwoo_select_field_3', 
			__( 'Settings field description', 'genesis-woocommerce' ), 
			array($this,'genwoo_select_field_3_render'), 
			'pluginPage', 
			'genwoo_pluginPage_section' 
		);	
	}


	function genwoo_text_field_0_render(  ) { 	
		$options = get_option( 'genwoo_settings' );
		?>
		<input type='text' name='genwoo_settings[genwoo_text_field_0]' value='<?php echo $options['genwoo_text_field_0']; ?>'>
		<?php	
	}


	function genwoo_checkbox_field_1_render(  ) { 	
		$options = get_option( 'genwoo_settings' );
		?>
		<input type='checkbox' name='genwoo_settings[genwoo_checkbox_field_1]' <?php checked( $options['genwoo_checkbox_field_1'], 1 ); ?> value='1'>
		<?php	
	}

	
	function genwoo_textarea_field_2_render(  ) { 	
		$options = get_option( 'genwoo_settings' );
		?>
		<textarea cols='40' rows='5' name='genwoo_settings[genwoo_textarea_field_2]'> 
			<?php echo $options['genwoo_textarea_field_2']; ?>
	 	</textarea>
		<?php	
	}


	function genwoo_select_field_3_render(  ) { 	
		$options = get_option( 'genwoo_settings' );
		?>
		<select name='genwoo_settings[genwoo_select_field_3]'>
			<option value='1' <?php selected( $options['genwoo_select_field_3'], 1 ); ?>>Option 1</option>
			<option value='2' <?php selected( $options['genwoo_select_field_3'], 2 ); ?>>Option 2</option>
		</select>	
	<?php	
	}


	public function genwoo_settings_section_callback() { 
		echo __( 'This section description', 'genesis-woocommerce' );
	}
	
}