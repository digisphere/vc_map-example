<?php if (!defined('ABSPATH')) die('-1');

class My_Element {
	/*
		Constructor
	*/
    function __construct() {
	    
        // Integrate with VC
        add_action( 'init', array( $this, 'integrateWithVC' ) );
 
        // Create our Shortcode
        add_shortcode( 'element_shortcode', array( $this, 'renderElement' ) );
    }
    
    /*
		Integration
	*/
    public function integrateWithVC() {
	    
	    // if vc dosn't exist
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
	        
            // Display notice that Visual Compser is required
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }
		vc_map(
        	array(
	        	"name"			=> __("Element Title", 'textdomain'),						// element name
				"description"	=> __("Element description", 'textdomain'),						// element description
				"base"			=> "element_shortcode",										// element base shortcode
				"class"			=> "",														// element special class
				"controls"		=> "full",
				"icon"			=> get_template_directory_uri() . '/img/element-icon.png',	// element icon
				"category"		=> 'My Widgets Category',									// element category
				
				// Widget options
				"params"		=> array(
					
					// hide meta content
	            	array(
	            		"type"			=> "checkbox",
	            		"holder"		=> "div",
	            		"class"			=> "",
						"heading"		=> __("Hide element", 'newa'),
						"param_name"	=> "hide_element",
						"value"			=> "",
					),
				)
			)
		);
    }
    
    // Shortcode logic & rendering

    public function renderElement( $atts, $content = null ) {
      	extract( shortcode_atts( array(
			'hide_element' => false,
		), $atts ) );
		
		// fix unclosed/unwanted paragraph tags in $content
		$content = wpb_js_remove_wpautop($content, true);
		
		
		// start the output
		
		$output = '';
		
		return $output;
    }
    
    // Show notice if your plugin is activated but Visual Composer is not

    public function showVcVersionNotice() {
        $plugin_data = get_plugin_data(__FILE__);
        echo '
        <div class="updated">
          <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
        </div>';
    }
}

// Finally initialize code
new My_Element();