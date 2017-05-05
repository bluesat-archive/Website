<?php
/*****************************************************
* CPT Bootstrap Team Bio
* http://www.tallphil.co.uk/bootstrap-carousel/
* ----------------------------------------------------
* bstb-settings.php
* Code to handle the Settings page
******************************************************/

///////////////////
// SETTINGS PAGE
///////////////////

// Set up settings defaults
register_activation_hook(__FILE__, 'bstb_set_options');
function bstb_set_options (){
	$defaults = array(
		'interval' => '5000',
		'showcaption' => 'true',
		'showcontrols' => 'true',
		'customprev' => '',
		'customnext' => '',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'category' => '',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
		'before_caption' => '<p>',
		'after_caption' => '</p>',
		'image_size' => 'full',
		'link_button' => '1',
		'link_button_text' => 'Read more',
		'link_button_class' => 'btn btn-default pull-right',
		'link_button_before' => '',
		'link_button_after' => '',
		'id' => '',
		'twbs' => '3',
		'use_background_images' => '0',
		'background_images_height' => '500',
        'background_images_style_size' => 'cover',
        'use_javascript_animation' => '1',
	);
	add_option('bstb_settings', $defaults);
}
// Clean up on uninstall
register_activation_hook(__FILE__, 'bstb_deactivate');
function bstb_deactivate(){
	delete_option('bstb_settings');
}


// Render the settings page
class bstb_settings_page {
	// Holds the values to be used in the fields callbacks
	private $options;
			
	// Start up
	public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
			add_action( 'admin_init', array( $this, 'page_init' ) );
	}
			
	// Add settings page
	public function add_plugin_page() {
		add_submenu_page('edit.php?post_type=bstb', __('Settings', 'bluesat-team-bios'), __('Settings', 'bluesat-team-bios'), 'manage_options', 'bluesat-team-bios', array($this,'create_admin_page'));
	}
			
	// Options page callback
	public function create_admin_page() {
		// Set class property
		$this->options = get_option( 'bstb_settings' );
		if(!$this->options){
			bstb_set_options ();
			$this->options = get_option( 'bstb_settings' );
		}
		?>
		<div class="wrap">
		<h2>Team Team Bio <?php _e('Settings', 'bluesat-team-bios'); ?></h2>
		<p><?php printf(__('You can set the default behaviour of your carousels here. Most of these settings can be overridden by using %s shortcode attributes %s.', 'bluesat-team-bios'),'<a href="http://wordpress.org/plugins/bluesat-team-bios/" target="_blank">', '</a>'); ?></p>
					 
				<form method="post" action="options.php">
				<?php
						settings_fields( 'bstb_settings' );   
						do_settings_sections( 'bluesat-team-bios' );
						submit_button(); 
				?>
				</form>
		</div>
		<?php
	}
			
	// Register and add settings
	public function page_init() {		
		register_setting(
				'bstb_settings', // Option group
				'bstb_settings', // Option name
				array( $this, 'sanitize' ) // Sanitize
		);
		
        // Sections
		add_settings_section(
				'bstb_settings_behaviour', // ID
				__('Team Bio Behaviour', 'bluesat-team-bios'), // Title
				array( $this, 'bstb_settings_behaviour_header' ), // Callback
				'bluesat-team-bios' // Page
		);
		add_settings_section(
				'bstb_settings_setup', // ID
				__('Team Bio Setup', 'bluesat-team-bios'), // Title
				array( $this, 'bstb_settings_setup' ), // Callback
				'bluesat-team-bios' // Page
		);
		add_settings_section(
				'bstb_settings_link_buttons', // ID
				__('Link Buttons', 'bluesat-team-bios'), // Title
				array( $this, 'bstb_settings_link_buttons_header' ), // Callback
				'bluesat-team-bios' // Page
		);
		add_settings_section(
				'bstb_settings_markup', // ID
				__('Custom Markup', 'bluesat-team-bios'), // Title
				array( $this, 'bstb_settings_markup_header' ), // Callback
				'bluesat-team-bios' // Page
		);
        
		// Behaviour Fields
		add_settings_field(
				'interval', // ID
				__('Slide Interval (milliseconds)', 'bluesat-team-bios'), // Title
				array( $this, 'interval_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_behaviour' // Section
		);
		add_settings_field(
				'showcaption', // ID
				__('Show Slide Titles / Captions?', 'bluesat-team-bios'), // Title 
				array( $this, 'showcaption_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_behaviour' // Section		   
		);
		add_settings_field(
				'showcontrols', // ID
				__('Show Slide Controls?', 'bluesat-team-bios'), // Title 
				array( $this, 'showcontrols_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_behaviour' // Section		   
		);
		add_settings_field(
				'orderby', // ID
				__('Order Slides By', 'bluesat-team-bios'), // Title 
				array( $this, 'orderby_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_behaviour' // Section		   
		);
		add_settings_field(
				'order', // ID
				__('Ordering Direction', 'bluesat-team-bios'), // Title 
				array( $this, 'order_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_behaviour' // Section		   
		);
		add_settings_field(
				'category', // ID
				__('Restrict to Category', 'bluesat-team-bios'), // Title 
				array( $this, 'category_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_behaviour' // Section		   
		);
		
		add_settings_field(
                'role', // ID
                __('Role', 'bluesat-team-bios'), // Title 
                array( $this, 'role_callback' ), // Callback
                'bluesat-team-bios', // Page
                'bstb_settings_behaviour' // Section           
        );
        
        // Team Bio Setup Section
		add_settings_field(
				'twbs', // ID
				__('Twitter Bootstrap Version', 'bluesat-team-bios'), // Title 
				array( $this, 'twbs_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_setup' // Section		   
		);
		add_settings_field(
				'image_size', // ID
				__('Image Size', 'bluesat-team-bios'), // Title 
				array( $this, 'image_size_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_setup' // Section		   
		);
		
		add_settings_field(
				'use_background_images', // ID
				__('Use background images?', 'bluesat-team-bios'), // Title 
				array( $this, 'use_background_images_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_setup' // Section		   
		);
		add_settings_field(
				'background_images_height', // ID
				__('Height if using bkgrnd images (px)', 'bluesat-team-bios'), // Title
				array( $this, 'background_images_height_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_setup' // Section
		);
		add_settings_field(
				'background_images_style_size', // ID
				__('Background images size style', 'bluesat-team-bios'), // Title
				array( $this, 'background_images_style_size_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_setup' // Section
		);
		add_settings_field(
				'use_javascript_animation', // ID
				__('Use Javascript to animate carousel?', 'bluesat-team-bios'), // Title 
				array( $this, 'use_javascript_animation_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_setup' // Section		   
		);

		// Link buttons
		add_settings_field(
				'link_button', // ID
				__('Show links as button in caption', 'bluesat-team-bios'), // Title
				array( $this, 'link_button_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_link_buttons' // Section
		);
		add_settings_field(
				'link_button_text', // ID
				__('Default text for link buttons', 'bluesat-team-bios'), // Title
				array( $this, 'link_button_text_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_link_buttons' // Section
		);
		add_settings_field(
				'link_button_class', // ID
				__('Class for link buttons', 'bluesat-team-bios'), // Title
				array( $this, 'link_button_class_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_link_buttons' // Section
		);
		add_settings_field(
				'link_button_before', // ID
				__('HTML before link buttons', 'bluesat-team-bios'), // Title
				array( $this, 'link_button_before_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_link_buttons' // Section
		);
		add_settings_field(
				'link_button_after', // ID
				__('HTML after link buttons', 'bluesat-team-bios'), // Title
				array( $this, 'link_button_after_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_link_buttons' // Section
		);
        
        // Markup Section
		add_settings_field(
				'customprev', // ID
				__('Custom prev button class', 'bluesat-team-bios'), // Title
				array( $this, 'customprev_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_markup' // Section
		);
		add_settings_field(
				'customnext', // ID
				__('Custom next button class', 'bluesat-team-bios'), // Title
				array( $this, 'customnext_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_markup' // Section
		);
		add_settings_field(
				'before_title', // ID
				__('HTML before title', 'bluesat-team-bios'), // Title
				array( $this, 'before_title_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_markup' // Section
		);
		add_settings_field(
				'after_title', // ID
				__('HTML after title', 'bluesat-team-bios'), // Title
				array( $this, 'after_title_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_markup' // Section
		);
		add_settings_field(
				'before_caption', // ID
				__('HTML before caption text', 'bluesat-team-bios'), // Title
				array( $this, 'before_caption_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_markup' // Section
		);
		add_settings_field(
				'after_caption', // ID
				__('HTML after caption text', 'bluesat-team-bios'), // Title
				array( $this, 'after_caption_callback' ), // Callback
				'bluesat-team-bios', // Page
				'bstb_settings_markup' // Section
		);
			 
	}
			
	// Sanitize each setting field as needed -  @param array $input Contains all settings fields as array keys
	public function sanitize( $input ) {
		$new_input = array();
		foreach($input as $key => $var){
			if($key == 'twbs' || $key == 'interval' || $key == 'background_images_height'){
				$new_input[$key] = absint( $input[$key] );
			} else if ($key == 'link_button_before' || $key == 'link_button_after' || $key == 'before_title' || $key == 'after_title' || $key == 'before_caption' || $key == 'after_caption'){
				$new_input[$key] = $input[$key]; // Don't sanitise these, meant to be html!
			} else { 
				$new_input[$key] = sanitize_text_field( $input[$key] );
			}
		}
		return $new_input;
	}
			
	// Print the Section text
	public function bstb_settings_behaviour_header() {
            echo '<p>'.__('Basic setup of how each Team Bio will function, what controls will show and which images will be displayed.', 'bluesat-team-bios').'</p>';
	}
	public function bstb_settings_setup() {
            echo '<p>'.__('Change the setup of the carousel - how it functions.', 'bluesat-team-bios').'</p>';
	}
	public function bstb_settings_link_buttons_header() {
            echo '<p>'.__('Options for using a link button instead of linking the image directly.', 'bluesat-team-bios').'</p>';
	}
	public function bstb_settings_markup_header() {
            echo '<p>'.__('Customise which CSS classes and HTML tags the Team Bio uses.', 'bluesat-team-bios').'</p>';
	}
			
	// Callback functions - print the form inputs
    // Team Bio behaviour	
	public function interval_callback() {
			printf('<input type="text" id="interval" name="bstb_settings[interval]" value="%s" size="15" />',
					isset( $this->options['interval'] ) ? esc_attr( $this->options['interval']) : '');
            echo '<p class="description">'.__('How long each image shows for before it slides. Set to 0 to disable animation.', 'bluesat-team-bios').'</p>';
	}
	public function showcaption_callback() {
		if(isset( $this->options['showcaption'] ) && $this->options['showcaption'] == 'false'){
			$bstb_showcaption_t = '';
			$bstb_showcaption_f = ' selected="selected"';
		} else {
			$bstb_showcaption_t = ' selected="selected"';
			$bstb_showcaption_f = '';
		}
		print '<select id="showcaption" name="bstb_settings[showcaption]">
			<option value="true"'.$bstb_showcaption_t.'>'.__('Show', 'bluesat-team-bios').'</option>
			<option value="false"'.$bstb_showcaption_f.'>'.__('Hide', 'bluesat-team-bios').'</option>
		</select>';
	}
	public function showcontrols_callback() {
		if(isset( $this->options['showcontrols'] ) && $this->options['showcontrols'] == 'false'){
			$bstb_showcontrols_t = '';
			$bstb_showcontrols_f = ' selected="selected"';
			$bstb_showcontrols_c = '';
		} else if(isset( $this->options['showcontrols'] ) && $this->options['showcontrols'] == 'true'){
			$bstb_showcontrols_t = ' selected="selected"';
			$bstb_showcontrols_f = '';
			$bstb_showcontrols_c = '';
		} else if(isset( $this->options['showcontrols'] ) && $this->options['showcontrols'] == 'custom'){
			$bstb_showcontrols_t = '';
			$bstb_showcontrols_f = '';
			$bstb_showcontrols_c = ' selected="selected"';
		}
		print '<select id="showcontrols" name="bstb_settings[showcontrols]">
			<option value="true"'.$bstb_showcontrols_t.'>'.__('Show', 'bluesat-team-bios').'</option>
			<option value="false"'.$bstb_showcontrols_f.'>'.__('Hide', 'bluesat-team-bios').'</option>
			<option value="custom"'.$bstb_showcontrols_c.'>'.__('Custom', 'bluesat-team-bios').'</option>
		</select>';
	}
	public function orderby_callback() {
		$orderby_options = array (
			'menu_order' => __('Menu order, as set in Team Bio overview page', 'bluesat-team-bios'),
			'date' => __('Date slide was published', 'bluesat-team-bios'),
			'rand' => __('Random ordering', 'bluesat-team-bios'),
			'title' => __('Slide title', 'bluesat-team-bios')	  
		);
		print '<select id="orderby" name="bstb_settings[orderby]">';
		foreach($orderby_options as $val => $option){
			print '<option value="'.$val.'"';
			if(isset( $this->options['orderby'] ) && $this->options['orderby'] == $val){
				print ' selected="selected"';
			}
			print ">$option</option>";
		}
		print '</select>';
	}
	public function order_callback() {
		if(isset( $this->options['order'] ) && $this->options['order'] == 'DESC'){
			$bstb_showcontrols_a = '';
			$bstb_showcontrols_d = ' selected="selected"';
		} else {
			$bstb_showcontrols_a = ' selected="selected"';
			$bstb_showcontrols_d = '';
		}
		print '<select id="order" name="bstb_settings[order]">
			<option value="ASC"'.$bstb_showcontrols_a.'>'.__('Ascending', 'bluesat-team-bios').'</option>
			<option value="DESC"'.$bstb_showcontrols_d.'>'.__('Decending', 'bluesat-team-bios').'</option>
		</select>';
	}
	public function category_callback() {
		$cats = get_terms('teambio_category');
		print '<select id="orderby" name="bstb_settings[category]">
			<option value="">'.__('All Categories', 'bluesat-team-bios').'</option>';
		foreach($cats as $cat){
			print '<option value="'.$cat->name.'"';
			if(isset( $this->options['category'] ) && $this->options['category'] == $cat->name){
				print ' selected="selected"';
			}
			print ">".$cat->name."</option>";
		}
		print '</select>';
	}
	
	public function role_callback() {
        $cats = get_terms('teambio_role');
        print '<select id="orderby" name="bstb_settings[role]">
            <option value="">'.__('All Roles', 'bluesat-team-bios').'</option>';
        foreach($cats as $cat){
            print '<option value="'.$cat->name.'"';
            if(isset( $this->options['role'] ) && $this->options['role'] == $cat->name){
                print ' selected="selected"';
            }
            print ">".$cat->name."</option>";
        }
        print '</select>';
    }
	
    // Setup Section
	public function twbs_callback() {
		if(isset( $this->options['twbs'] ) && $this->options['twbs'] == '3'){
			$bstb_twbs3 = ' selected="selected"';
			$bstb_twbs2 = '';
		} else {
			$bstb_twbs3 = '';
			$bstb_twbs2 = ' selected="selected"';
		}
		print '<select id="twbs" name="bstb_settings[twbs]">
			<option value="2"'.$bstb_twbs2.'>2.x</option>
			<option value="3"'.$bstb_twbs3.'>3.x (Default)</option>
		</select>';
        echo '<p class="description">'.__("Set according to which version of Bootstrap you're using.", 'bluesat-team-bios').'</p>';
	}
	public function image_size_callback() {
		$image_sizes = get_intermediate_image_sizes();
		print '<select id="image_size" name="bstb_settings[image_size]">
			<option value="full"';
			if(isset( $this->options['image_size'] ) && $this->options['image_size'] == 'full'){
				print ' selected="selected"';
			}
			echo '>Full (default)</option>';
		foreach($image_sizes as $size){
			print '<option value="'.$size.'"';
			if(isset( $this->options['image_size'] ) && $this->options['image_size'] == $size){
				print ' selected="selected"';
			}
			print ">".ucfirst($size)."</option>";
		}
		print '</select>';
        echo '<p class="description">'.__("If your carousels are small, you can a smaller image size to increase page load times.", 'bluesat-team-bios').'</p>';
	}
	public function use_background_images_callback() {
		print '<select id="use_background_images" name="bstb_settings[use_background_images]">';
		print '<option value="0"';
		if(isset( $this->options['use_background_images'] ) && $this->options['use_background_images'] == 0){
			print ' selected="selected"';
		}
		echo '>No (default)</option>';
		print '<option value="1"';
		if(isset( $this->options['use_background_images'] ) && $this->options['use_background_images'] == 1){
			print ' selected="selected"';
		}
		echo '>Yes</option>';
		print '</select>';
        echo '<p class="description">'.__("Experimental feature - Use CSS background images so that pictures auto-fill the space available.", 'bluesat-team-bios').'</p>';
	}
	public function background_images_height_callback() {
		printf('<input type="text" id="background_images_height" name="bstb_settings[background_images_height]" value="%s" size="15" />',
				isset( $this->options['background_images_height'] ) ? esc_attr( $this->options['background_images_height']) : '500px');
        echo '<p class="description">'.__("If using background images above, how tall do you want the carousel to be?", 'bluesat-team-bios').'</p>';
	}

	public function use_javascript_animation_callback() {
		print '<select id="use_javascript_animation" name="bstb_settings[use_javascript_animation]">';
		print '<option value="1"';
		if(isset( $this->options['use_javascript_animation'] ) && $this->options['use_javascript_animation'] == 1){
			print ' selected="selected"';
		}
		echo '>Yes (default)</option>';
		print '<option value="0"';
		if(isset( $this->options['use_javascript_animation'] ) && $this->options['use_javascript_animation'] == 0){
			print ' selected="selected"';
		}
		echo '>No</option>';
		print '</select>';
        echo '<p class="description">'.__("The Bootstrap Team Bio is designed to work usign data-attributes. Sometimes the animation doesn't work correctly with this, so the default is to include a small portion of Javascript to fire the carousel. You can choose not to include this here.", 'bluesat-team-bios').'</p>';
	}
	public function background_images_style_size_callback() {
		print '<select id="select_background_images_style_size" name="bstb_settings[select_background_images_style_size]">';
		print '<option value="cover"';
		if(isset( $this->options['select_background_images_style_size'] ) && $this->options['select_background_images_style_size'] === 'cover'){
			print ' selected="selected"';
		}
		echo '>Cover (default)</option>';
		print '<option value="contain"';
		if(isset( $this->options['select_background_images_style_size'] ) && $this->options['select_background_images_style_size'] === 'contain'){
			print ' selected="selected"';
		}
		echo '>Contain</option>';
		print '<option value="auto"';
		if(isset( $this->options['select_background_images_style_size'] ) && $this->options['select_background_images_style_size'] === 'auto'){
			print ' selected="selected"';
		}
		echo '>Auto</option>';
		print '</select>';
        echo '<p class="description">'.__('If you find that your images are not scaling correctly when using background images try switching the style to \'contain\' or \'auto\'', 'bluesat-team-bios').'</p>';
	}

	// Link buttons section
	public function link_button_callback(){
		print '<select id="link_button" name="bstb_settings[link_button]">';
		print '<option value="1"';
		if(isset( $this->options['link_button'] ) && $this->options['link_button'] == 1){
			print ' selected="selected"';
		}
		echo '>Yes</option>';
		print '<option value="0"';
		if(!isset( $this->options['link_button'] ) || $this->options['link_button'] == 0){
			print ' selected="selected"';
		}
		echo '>No (Default)</option>';
		print '</select>';
		echo '<p class="description">'.__("If a URL is set for a carousel image, this option will create a button in the caption instead of linking the image itself.", 'bluesat-team-bios').'</p>';
	}
	public function link_button_text_callback() {
			printf('<input type="text" id="link_button_text" name="bstb_settings[link_button_text]" value="%s" size="20" />',
					isset( $this->options['link_button_text'] ) ? esc_attr( $this->options['link_button_text']) : 'Read more');
	}
	public function link_button_class_callback() {
			printf('<input type="text" id="link_button_class" name="bstb_settings[link_button_class]" value="%s" size="20" />',
					isset( $this->options['link_button_class'] ) ? esc_attr( $this->options['link_button_class']) : 'btn btn-default pull-right');
			echo '<p class="description">'.__("Bootstrap style buttons must have the class <code>btn</code> and then one of the following: <code>btn-default</code>, <code>btn-primary</code>, <code>btn-success</code>, <code>btn-warning</code>, <code>btn-danger</code> or <code>btn-info</code>. No <code>.</code> prefixes. <code>pull-right</code> to float the button on the right. See the ", 'bluesat-team-bios').' <a href="http://getbootstrap.com/css/#buttons-options" target="_blank">Bootstrap documentation</a>.</p>';
	}
	public function link_button_before_callback() {
			printf('<input type="text" id="link_button_before" name="bstb_settings[link_button_before]" value="%s" size="20" />',
					isset( $this->options['link_button_before'] ) ? esc_attr( $this->options['link_button_before']) : '');
	}
	public function link_button_after_callback() {
			printf('<input type="text" id="link_button_after" name="bstb_settings[link_button_after]" value="%s" size="20" />',
					isset( $this->options['link_button_after'] ) ? esc_attr( $this->options['link_button_after']) : '');
	}
    
    // Markup section
	public function before_title_callback() {
			printf('<input type="text" id="before_title" name="bstb_settings[before_title]" value="%s" size="15" />',
					isset( $this->options['before_title'] ) ? esc_attr( $this->options['before_title']) : '<h4>');
	}
	public function customnext_callback() {
			printf('<input type="text" id="customnext" name="bstb_settings[customnext]" value="%s" size="15" />',
					isset( $this->options['customnext'] ) ? esc_attr( $this->options['customnext']) : '');
	}
	public function customprev_callback() {
			printf('<input type="text" id="customprev" name="bstb_settings[customprev]" value="%s" size="15" />',
					isset( $this->options['customprev'] ) ? esc_attr( $this->options['customprev']) : '');
	}
	public function after_title_callback() {
			printf('<input type="text" id="after_title" name="bstb_settings[after_title]" value="%s" size="15" />',
					isset( $this->options['after_title'] ) ? esc_attr( $this->options['after_title']) : '</h4>');
	}
	public function before_caption_callback() {
			printf('<input type="text" id="before_caption" name="bstb_settings[before_caption]" value="%s" size="15" />',
					isset( $this->options['before_caption'] ) ? esc_attr( $this->options['before_caption']) : '<p>');
	}
	public function after_caption_callback() {
			printf('<input type="text" id="after_caption" name="bstb_settings[after_caption]" value="%s" size="15" />',
					isset( $this->options['after_caption'] ) ? esc_attr( $this->options['after_caption']) : '</p>');
	}	
	
}

if( is_admin() ){
		$bstb_settings_page = new bstb_settings_page();
}

// Add settings link on plugin page
function bstb_settings_link ($links) { 
	$settings_link = '<a href="edit.php?post_type=bstb&page=bluesat-team-bios">'.__('Settings', 'bluesat-team-bios').'</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
}
$bstb_plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$bstb_plugin", 'bstb_settings_link' );
