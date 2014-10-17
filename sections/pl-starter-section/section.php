<?php
/*
    Section: PageLines Starter Section
    Author: PageLines
    Author URI: http://pagelines.com
    Description: A starter section for creating new sections.
    Class Name: pl_starter_section
    Demo:
    Filter: component
*/

/**
 * DMS Meta Info Tips

	// You can set the filter value to one of the following: component, layout, full-width, format, gallery , nav, slider, social, widgetized, misc
	// There are a few additional headers you can utlize. One of which is a full-width filter that forces the section full-width. The other is an active loading filter, which, when applied, doesn't require a page refresh for the section to show up. However, sections with javascript shouldn't use this.
*/


// Our class is namespaced with initials and the section name.
class pl_starter_section extends PageLinesSection {

	const version = '1.2';  // Declares a version, used in tracking the version of the script. 

    // READY TO USE VARIABLES
    // $this->id;          Section slug, in this case its pl-section
    // $this->base_url;    The base url of the section
    // $this->base_dir;    The base directory of the section
    // $this->images;      Create an /images directory in your section, then use this variable for the path
    // $this->screenshot;  The section thumb
    // $this->splash;      The section splash
    // $this->description  Get the description from the header
    // get_the_id();       Retrieves the clone id of the section

    // RUNS ALL TIME - This loads all the time, even if the section isn't on the page. Actions can go here, as well as post type setup functions
    function section_persistent(){}

    // LOAD SCRIPTS
    function section_scripts(){
        //wp_enqueue_script('script-name', $this->base_url.'/script.js', array('jquery'), self::version, true );
    }

    // RUNS IN <HEAD>
    function section_head() {

    	// Always use jQuery and never $ to avoid issues with other store products

        /*
    	?><script>
	    	jQuery(document).ready(function(){

	    	});
    	</script><?php
    	*/

        // This is only needed if you'll be using custom fonts
        // echo load_custom_font($this->opt('pl_custom_font'), '.target-class');

    }

    // BEFORE SECTION - This adds a class to the section wrap. You can also put HTML here and it will run outside of the section, and before it.
    function before_section_template( $location = '', $clone_id = null ) {

		//$this->wrapper_classes['background'] = 'special-class';

	}

    // SECTION MARKUP - This is the function that outputs all the HTML onto the page. Put all your viewable content here.
   	function section_template() {

        echo 'Hi'; // Outputs the word 'Hi'.

        // Call settings like so:
        // $var = $this->opt($this->id.'_some_key');


        // Display (or print) iterated options.
		$my_array 	= $this->opt('sample_item_array');
		$out 		= ''; // Creates an empty variable called 'out'.

		if( is_array($my_array) ){ // Check if something is in the array (set by user).

			foreach( $my_array as $optionset ){ // Within this loop, $my_array is now $optionset.

				$getlink	= pl_array_get('link', $optionset); // Pull 'link' out of $optionset.
				$geticon 	= pl_array_get('icon', $optionset, 'globe'); // Passing a default as a 3rd parameter if no icon has been selected by the user.

				$out    	.= sprintf('<a class="btn" href="%s"><i class="icon-%s"></i></a>',$getlink,$geticon); // Add what comes after .= to the variable $out.
			}

		} else {

			echo setup_section_notify($this); // If nothing is set, tell users to set some options.
		}

		printf('<div class="icon-wrap">%s</div>',$out); // %s denotes the variable that comes at the end of the sprintf statement, in this case $out.

   	}

    // RUNS IN <FOOTER> - This is just like using wp_footer so output will be in the footer of your site.
	function section_foot(){}


    // WELCOME MESSAGE - HTML content for the welcome/intro option field.
	function welcome(){

		ob_start();

		?><div style="font-size:12px;line-height:14px;color:#444;"><p><?php _e('You can have some custom text here.','pl-section');?></p></div><?php

		return ob_get_clean();
	}

    // SECTION OPTIONS - Draws out the section options. This symbol * denotes optional fields.
	function section_opts(){

		$options = array();

        // Anatomy of an option type
        $opts[] = array(
            'key'                   => $this->id.'_some_key', // A key must be unique for each option.
            'type'                  => 'text', // Option Type
            'title'                 => __('Option Title', 'pl-section'), // Same as 'label' if omitted.
            'label'                 => __('Option Label', 'pl-section'),
            'help'                  => __('Description Text', 'pl-section'),
            'ref'                   => __( 'This creates a help field with a toggle.', 'pl-section' )
        );

        // Welcome
		$options[] = array(
            'span'                  => 2, // Special type that makes the option wider.
            'key'                   => $this->id.'_some_key',
            'type'                  => 'template',
            'title'                 => __('Welcome to My Section','pl-section'),
            'template'              => $this->welcome()
        );

        // Count select
		$options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'count_select',
            'title'                 => __('Count Select','pl-section'),
            'count_start'           => 1,            // Starting Count Number.
            'count_number'          => 100,          // Ending Count Number.
            //'suffix'                => '%'          // * Added to the end of the value and optional.
        );

        // Image Upload
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'image_upload',
            'title'                 => __('Image Upload','pl-section'),
            'imgsize'               => '16',        // * The image preview 'max' size.
            'sizelimit'             => '512000',     // * Image upload max size default 512kb.
        );

        // Color Picker
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'color',
            'title'                 => __('Color Picker','pl-section'),
            'default'               => '#FFFFFF', // Always set a default.

        );

        // Text, Textareas and Checkboxes
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'text',  // Or "textarea" or "check".
            'title'                 => __('Text','pl-section'),
        );

        // Select Menu
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'select_menu',
            'title'                 => __('Menu Select','pl-section'),
        );

        // Fonts - There is a second step required in order to get this option working. In section head, there's an example showing how to load a custom font, targeting a specific class in your section.
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'type',
            'title'                 => __('Pick a Font','pl-section'),
        );

        // Icon selector
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'select_icon',
            'title'                 => __('Select an icon','pl-section'),
            'default'               => 'rocket'
        );

        // Link
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'link',
            'title'                 => __('Visit this link','pl-section'),
            'url'                   => 'http://www.pagelines.com',
            'classes'               => 'btn-info' // You can also use btn-primary, btn-warning, btn-success, btn-inverse.
        );

        // Button Select
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'select_button',
            'title'                 => __('Select a button','pl-section'),
        );

        // Multi Select
		$options[] = array(
			'type'	                => 'multi', // Here you can nest multiple options.
			'title'                 => __( 'Multiple Option Configuration', 'pl-section' ),
			'opts'	                => array(
				array(
					'key'			=> $this->id.'_some_key',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 12,
					'default'		=> 4,
					'label' 	    => __( 'Counter', 'pl-section' ),
				),
				array(
					'key'			=> $this->id.'_some_key',
					'type' 			=> 'color',
					'label' 	    => __( 'Color Picker', 'pl-section' ),
					'default'       => '#0077CC'
				),
			)

		);

		// Iterated Options
		$options[] = array(
			'key'				=> 'sample_item_array',
			'type'				=> 'accordion',
			'title'				=> __('Sample Item Array', 'pl-section'),
			'col'				=> 4,
			'opts' 				=> array(
				array(
					'key'		=> 'link', // Namespacing not required for iterated options as they fall within the scope of the top level key (sample_item_array).
					'label'		=> __( 'Link', 'pl-section' ),
					'type'		=> 'text'
				),
				array(
					'key'		=> 'icon', 
					'label'		=> __( 'Icon', 'pl-section' ),
					'type'		=> 'select_icon'
				),
			)
		);

		return $options;
	}

} // Don't put code past this point.
