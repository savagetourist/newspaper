<?php
/**
 * @package WordPress
 * @subpackage Hazel
 */
	
	add_action( 'after_setup_theme', 'hazel_setup' );
	
	function hazel_setup(){
		
		add_action( 'vc_before_init', 'hazel_vcSetAsTheme' );
		function hazel_vcSetAsTheme() {
		    vc_set_as_theme(true);
		}
		if (function_exists( 'set_revslider_as_theme' )){
			add_action( 'init', 'hazel_set_revslider_as_theme' );
			function hazel_set_revslider_as_theme() {
				set_revslider_as_theme();
			}
		}
		
	//body class
	function hazel_custom_body_class($classes, $class){
		if (is_singular() && get_post_meta(get_the_ID(), 'hazel_enable_custom_header_options_value', true)=='yes'){
			if (get_post_meta(get_the_ID(), 'hazel_content_to_the_top_value', true) == "off") $classes[] = "content_after_header";
		}
		else {
			if (get_option('hazel_content_to_the_top') == "off") $classes[] = "content_after_header";
		}
		return $classes;
	}
	
	add_filter( 'body_class', 'hazel_custom_body_class', 10, 2 );
			
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'woocommerce' );
		add_editor_style("/css/layout-style.css");
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		load_theme_textdomain( 'hazel', get_template_directory() . '/languages' );
			
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
		/*
	
		/**
		 * Set the content width based on the theme's design and stylesheet.
		 */
		if ( ! isset( $content_width ) )
			$content_width = 1170;
		
		//WMPL
		/**
		 * register panel strings for translation
		 */
		if (function_exists ( 'icl_register_string' )){
			require_once (get_template_directory().'/inc/theme-wpml.php');
		}
		//\WMPL
		
		//declare some global variables that will be used everywhere
		global $hazel_new_meta_boxes,
		$hazel_new_meta_post_boxes,
		$hazel_new_meta_portfolio_boxes,
		$hazel_buttons,
		$hazel_data;
		$hazel_new_meta_boxes=array();
		$hazel_new_meta_post_boxes=array();
		$hazel_new_meta_portfolio_boxes=array();
		$hazel_buttons=array();
		$hazel_data=new stdClass();
		
		
		/*----------------------------------------------------------------
		 *  DEFINE THE MAIN CONSTANTS
		 *---------------------------------------------------------------*/
		
		$my_theme = wp_get_theme();
		define("HAZEL_VERSION", $my_theme->Version);
		//define the main paths and URLs
		define("HAZEL_LIB_PATH", get_template_directory() . '/lib/');
		define("HAZEL_LIB_URL", get_template_directory_uri().'/lib/');
		define("HAZEL_JS_PATH", get_template_directory_uri().'/js/');
		define("HAZEL_CSS_PATH", get_template_directory_uri().'/css/');
	
		define("HAZEL_FUNCTIONS_PATH", HAZEL_LIB_PATH . 'functions/');
		define("HAZEL_FUNCTIONS_URL", HAZEL_LIB_URL.'functions/');
		define("HAZEL_CLASSES_PATH", HAZEL_LIB_PATH.'classes/');
		define("HAZEL_OPTIONS_PATH", HAZEL_LIB_PATH.'options/');
		define("HAZEL_WIDGETS_PATH", HAZEL_LIB_PATH.'widgets/');
		define("HAZEL_SHORTCODES_PATH", HAZEL_LIB_PATH.'shortcodes/');
		define("HAZEL_PLUGINS_PATH", HAZEL_LIB_PATH.'plugins/');
		define("HAZEL_UTILS_URL", HAZEL_LIB_URL.'utils/');
		
		define("HAZEL_IMAGES_URL", HAZEL_LIB_URL.'images/');
		define("HAZEL_CSS_URL", HAZEL_LIB_URL.'css/');
		define("HAZEL_SCRIPT_URL", HAZEL_LIB_URL.'script/');
		define("HAZEL_PATTERNS_URL", get_template_directory_uri().'/images/hazel_patterns/');
		$uploadsdir=wp_upload_dir();
		define("HAZEL_UPLOADS_URL", $uploadsdir['url']);
		define("HAZEL_SEPARATOR", '|*|');
		define("HAZEL_OPTIONS_PAGE", 'hazel_options');
		define("HAZEL_STYLE_OPTIONS_PAGE", 'hazel_style_options');
	
		/*----------------------------------------------------------------
		 *  INCLUDE THE FUNCTIONS FILES
		 *---------------------------------------------------------------*/
				
		require_once (HAZEL_FUNCTIONS_PATH.'general.php');  //some main common functions
		require_once (HAZEL_FUNCTIONS_PATH.'stylesheet.php');  //some main common functions
		add_action('wp_enqueue_scripts', 'hazel_style', 1);
		add_action('wp_enqueue_scripts','hazel_custom_head', 2);
		add_action('wp_enqueue_scripts', 'hazel_scripts', 10);
	
		
		require_once (HAZEL_FUNCTIONS_PATH.'sidebars.php');  //the sidebar functionality
		if ( isset($_GET['page']) && $_GET['page'] == HAZEL_OPTIONS_PAGE ){
			require_once (HAZEL_CLASSES_PATH.'tw-options-manager.php');  //the theme options manager functionality
		}
		if ( isset($_GET['page']) && $_GET['page'] == HAZEL_STYLE_OPTIONS_PAGE ){
			require_once (HAZEL_CLASSES_PATH.'tw-style-options-manager.php');  //the theme options manager functionality
		}
		
			
		require_once (HAZEL_CLASSES_PATH.'tw-custom-data-manager.php');  
		require_once (HAZEL_CLASSES_PATH.'tw-custom-page.php');  
		require_once (HAZEL_CLASSES_PATH.'tw-custom-page-manager.php');  
		require_once (HAZEL_FUNCTIONS_PATH.'custom-pages.php');  //the comments functionality
		require_once (HAZEL_FUNCTIONS_PATH.'comments.php');  //the comments functionality
		require_once (HAZEL_WIDGETS_PATH.'widgets.php');  //the widgets functionality
		if (function_exists('hazel_add_widgets')) hazel_add_widgets();
		require_once (HAZEL_FUNCTIONS_PATH.'options.php');  //the theme options functionality
		
		
		if (is_admin()){
			require_once (HAZEL_FUNCTIONS_PATH. 'meta.php');  //adds the custom meta fields to the posts and pages
			add_action('admin_enqueue_scripts','hazel_admin_style');
		}
		$functions_path = get_template_directory() . '/functions/';
		
		add_filter('woocommerce_add_to_cart_fragments' , 'hazel_woocommerce_header_add_to_cart_fragment' );
		
		// Declare sidebar widget zone
		if (function_exists('register_sidebar')) {
			register_sidebar(array(
				'name' => esc_html__( 'Blog Sidebar', 'hazel' ),
				'id'   => 'sidebar-widgets',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>'
			));
		}
		
		if (!function_exists('hazel_wp_pagenavi')){ 
			$including = $functions_path. 'wp-pagenavi.php';
		    require_once($including);
		}
		
		/* ------------------------------------------------------------------------ */
		/* Misc
		/* ------------------------------------------------------------------------ */
		// Post Thumbnail Sizes
		if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
		
		if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'hazel_blog', 1000, 563, true );				// Standard Blog Image
			add_image_size( 'hazel_mini', 80, 80, true ); 				// used for widget thumbnail
			add_image_size( 'hazel_portfolio', 600, 400, true );			// also for blog-medium
			add_image_size( 'hazel_regular', 500, 500, true ); 
			add_image_size( 'hazel_wide', 1000, 500, true ); 
			add_image_size( 'hazel_tall', 500, 1000, true );
			add_image_size( 'hazel_widetall', 1000, 1000, true ); 
		}
		
		/* tgm plugin activator */
		/**
		 * Include the TGM_Plugin_Activation class.
		 */
		require_once get_template_directory() . '/lib/functions/class-tgm-plugin-activation.php';
		
		add_action( 'tgmpa_register', 'hazel_register_required_plugins' );	
		
		if ( class_exists('VCExtendAddonClass')){
			// Finally initialize code
			new VCExtendAddonClass();
		}
		
		if (get_option("hazel_enable_smooth_scroll") == "on"){
			update_option('ultimate_smooth_scroll','enable');
		} else update_option('ultimate_smooth_scroll','disable');
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	}
	
	function hazel_admin_style(){
		wp_enqueue_style('hazel-fa-painel', HAZEL_CSS_PATH .'backcss.css');
		wp_enqueue_script( 'hazel-admin', HAZEL_JS_PATH .'hazel-admin.js', array(), '1',$in_footer = true);
	}
	
	
	
	function hazel_wpml_filter_langs( $languages ) {
		foreach ( $languages as $k => $language ) {                                       
			$lang_code = explode ( '-' , $languages[$k]['language_code'] );
			$languages[$k]['native_name']     = ucfirst( $lang_code[0] );
			$languages[$k]['translated_name'] = ucfirst( $lang_code[0] );
		}	
		return $languages;
	}
	add_filter( 'icl_ls_languages', 'hazel_wpml_filter_langs' );
	add_filter('wpml_add_language_selector', 'hazel_wpml_filter_langs');
	

	/*-----------------------------------------------------------------------------------*/
	/*  THEME REQUIRES
	/*-----------------------------------------------------------------------------------*/
	require_once (get_template_directory().'/inc/theme-styles.php');
	
	
	function hazel_custom_head(){
		wp_enqueue_script('hazel-html5trunk', get_template_directory_uri().'/js/html5.js', '1');
		wp_script_add_data( 'hazel-html5trunk', 'conditional', 'lt IE 9' );
	}
	
	function hazel_style() {		
		wp_enqueue_style( 'hazel-style', get_template_directory_uri().'/style.css', array(), '1' );
	}
	
	function hazel_slug_post_classes( $classes, $class, $post_id ) {
		$hazel_is_portfolio = array_search( 'type-portfolio', $classes );
		if ( is_single( $post_id ) && false !== $hazel_is_portfolio ) {
			$classes[] = 'container';
		}
		if (is_sticky( $post_id )) $classes[] = 'sticky';	 
		return $classes;
	}
	add_filter( 'post_class', 'hazel_slug_post_classes', 10, 3 );
	
	/*-----------------------------------------------------------------------------------*/
	/*  LOAD THEME SCRIPTS
	/*-----------------------------------------------------------------------------------*/
	function hazel_scripts(){
	
		if (!is_admin()){
			global $vc_addons_url, $post;
			
			if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
			
	   	    wp_enqueue_script( 'hazel_utils', HAZEL_JS_PATH .'utils.js', array('jquery'),'1.0',$in_footer = true);
	  	    wp_enqueue_script( 'hazel', HAZEL_JS_PATH .'hazel.js', array('jquery'), '1',$in_footer = true);
	  	    
	  		wp_enqueue_script('cubeportfolio-jquery-js',$in_footer = false);
			wp_enqueue_style('cubeportfolio-jquery-css',$in_footer = false);
			
			
			if (class_exists('Ultimate_VC_Addons')) {
				wp_enqueue_script('ultimate', plugins_url().'/Ultimate_VC_Addons/assets/min-js/ultimate.min.js', array('jquery'),'3.19.1');
				wp_enqueue_style('ultimate', plugins_url().'/Ultimate_VC_Addons/assets/min-css/ultimate.min.css', '3.19.1');
			}
			
			if (is_single()){
				wp_enqueue_style( 'prettyphoto'); wp_enqueue_script( 'prettyphoto'); 
			}
			if (isset($post->ID)) $template = get_post_meta( $post->ID, '_wp_page_template' ,true );
						
			if (isset($template) && ( $template == 'template-blank.php' || $template == 'template-home.php' ) || is_404()){
				if (class_exists('Ultimate_VC_Addons')) {
					wp_enqueue_script('ultimate', plugins_url().'/Ultimate_VC_Addons/assets/min-js/ultimate.min.js', array('jquery'),'3.19.1');
					wp_enqueue_style('ultimate', plugins_url().'/Ultimate_VC_Addons/assets/min-css/ultimate.min.css','3.19.1');
					wp_enqueue_script('ultimate-script');
					wp_enqueue_script('ultimate-vc-params');
				}
			}
			if (isset($template) && ($template == 'one-page-template.php' || $template == 'template-home.php')){
				wp_enqueue_script('googleapis');
			}

			if (isset($template) && ($template == 'blog-masonry-template.php' || $template == 'blog-template.php')){
				wp_enqueue_script( 'hazel-blog', HAZEL_JS_PATH .'blog.js', array('jquery'), '1',$in_footer = true);
			}
			
			wp_dequeue_style( 'wp-mediaelement' );
			wp_dequeue_script( 'wp-mediaelement' ); 
			
		}
	}


	/*-----------------------------------------------------------------------------------*/
	/*  FUNCTION FOR INSTALL AND REGISTER THEME PLUGINS
	/*-----------------------------------------------------------------------------------*/
	function hazel_register_required_plugins() {
	
		$plugins = array(
	
			// This is an example of how to include a plugin pre-packaged with a theme
				
				array(
					'name'      => esc_html('Contact Form 7','hazel'),
					'slug'      => esc_html('contact-form-7','hazel'),
					'required'  => false,
				),
				
				array(
					'name'      => esc_html('Widget Importer & Exporter','hazel'),
					'slug'      => esc_html('widget-importer-exporter','hazel'),
					'required'  => false,
				),
				
				array(
					'name'      => esc_html('Really Simple CAPTCHA','hazel'),
					'slug'      => esc_html('really-simple-captcha','hazel'),
					'required'  => false,
				),
				
				array(
					'name'      => esc_html('WooCommerce','hazel'),
					'slug'      => esc_html('woocommerce','hazel'),
					'required'  => false,
				),
				
				array(
					'name'      => esc_html('Easy Theme and Plugin Upgrades','hazel'),
					'slug'      => esc_html('easy-theme-and-plugin-upgrades','hazel'),
					'required'  => false,
				),
				
				array(
					'name'      => esc_html('Classic Editor','hazel'),
					'slug'      => esc_html('classic-editor','hazel'),
					'required'  => false,
				),
				
				array(
					'name'          => 'WPBakery Visual Composer',
					'slug'          => 'js_composer',
					'source'        => 'http://treethemes.net/plugins/hazel/js_composer.zip',
					'required'      => true,
					'version'       => '6.1'
				),
				array(
					'name'      	=> 'Revolution Slider',
					'slug'     	 	=> 'revslider',
					'source'        => 'http://treethemes.net/plugins/revslider.zip',
					'required'  	=> true,
					'version'       => '6.1.8'
				),
				
				array(
					'name'          => 'Ultimate Addons for Visual Composer',
					'slug'          => 'Ultimate_VC_Addons',
					'source'        => 'http://treethemes.net/plugins/Ultimate_VC_Addons.zip',
					'required'      => true,
					'version'       => '3.19.1'
				),
				array(
					'name'      	=> 'Hazel Custom Post Types',
					'slug'     	 	=> 'hazel_custom_post_types',
					'source'        => 'http://treethemes.net/plugins/hazel_custom_post_types.zip',
					'required'  	=> true,
					'version'       => '2.3.1'
				),
				
				array(
					'name'          => 'Cube Portfolio',
					'slug'          => 'cubeportfolio',
					'source'        => 'http://treethemes.net/plugins/cubeportfolio.zip',
					'required'      => true,
					'version'       => '3.8.0'
				)
				
		);
	
		// Change this to your theme text domain, used for internationalising strings
		$config = array(
			'domain'       		=> 'hazel',         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',
			'parent_slug'  => 'themes.php',            			// Parent menu slug.
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> esc_html__( 'Install Required Plugins', 'hazel' ),
				'menu_title'                       			=> esc_html__( 'Install Plugins', 'hazel' ),
				'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'hazel' ), // %1$s = plugin name
				'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'hazel' ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'hazel' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'hazel' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'hazel' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'hazel' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'hazel' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'hazel' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'hazel' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'hazel' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'hazel' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'hazel' ),
				'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'hazel' ),
				'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'hazel' ),
				'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'hazel' ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
	
		tgmpa( $plugins, $config );
	
	}
	

	
	/*-----------------------------------------------------------------------------------*/
	/*  THEME REQUIRES
	/*-----------------------------------------------------------------------------------*/

 	
 	if (file_exists(get_stylesheet_directory().'/inc/theme-header.php')) require_once (get_stylesheet_directory().'/inc/theme-header.php');
 	else require_once (get_template_directory().'/inc/theme-header.php');
 	
 	if (file_exists(get_stylesheet_directory().'/inc/theme-walker-menu.php')) require_once (get_stylesheet_directory().'/inc/theme-walker-menu.php');
 	else require_once (get_template_directory().'/inc/theme-walker-menu.php');
 	

 	
 	if (file_exists(get_stylesheet_directory().'/inc/theme-breadcrumb.php')) require_once (get_stylesheet_directory().'/inc/theme-breadcrumb.php');
 	else require_once (get_template_directory().'/inc/theme-breadcrumb.php');
 	
 	if (file_exists(get_stylesheet_directory().'/inc/theme-menu.php')) require_once (get_stylesheet_directory().'/inc/theme-menu.php');
 	else require_once (get_template_directory().'/inc/theme-menu.php');
 	
 	if (file_exists(get_stylesheet_directory().'/inc/theme-woocart.php')) require_once (get_stylesheet_directory().'/inc/theme-woocart.php');
 	else require_once (get_template_directory().'/inc/theme-woocart.php');
 	
	
	
	/*-----------------------------------------------------------------------------------*/
	/*  HEX TO RGB
	/*-----------------------------------------------------------------------------------*/
	function hazel_hex2rgb($hex = "000000") {
		if (is_array($hex)) $hex = "000000";
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}



	function hazel_get_string_between($string, $start, $end){
	    $string = " ".$string;
	    $ini = strpos($string,$start);
	    if ($ini == 0) return "";
	    $ini += strlen($start);
	    $len = strpos($string,$end,$ini) - $ini;
	    return substr($string,$ini,$len);
	}
	
	/* Remove VC Modules */
	if (function_exists('vc_remove_element')){
		vc_remove_element('vc_carousel');
		vc_remove_element('vc_posts_slider');
		vc_remove_element('vc_gallery');
		vc_remove_element('vc_images_carousel');
		vc_remove_element('vc_button');
		vc_remove_element('vc_cta_button');
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*  INCLUDE ADDONS IN HAZEL THEME
	/*-----------------------------------------------------------------------------------*/
	function hazel_content_shortcoder($post_content, $loadglobally = false){
		
		$dependancy = array('jquery');
		global $vc_addons_url;

			
		if (isset($vc_addons_url) && $vc_addons_url != ""){
			
			$js_path = 'assets/min-js/';
			$css_path = 'assets/min-css/';
			$ext = '.min';
			$isAjax = true;
			$ultimate_smooth_scroll = get_option('ultimate_smooth_scroll');
	
			// register js
			wp_register_script('ultimate-script',$vc_addons_url.'assets/min-js/ultimate.min.js',array('jquery', 'jquery-ui-core' ), '3.19.1', false);
			wp_register_script('ultimate-appear',$vc_addons_url.$js_path.'jquery-appear'.$ext.'.js',array('jquery'), '3.19.1');
			wp_register_script('ultimate-custom',$vc_addons_url.$js_path.'custom'.$ext.'.js',array('jquery'), '3.19.1');
			wp_register_script('ultimate-vc-params',$vc_addons_url.$js_path.'ultimate-params'.$ext.'.js',array('jquery'), '3.19.1');
			if($ultimate_smooth_scroll === 'enable') {
				$smoothScroll = 'SmoothScroll-compatible.min.js';
			}
			else {
				$smoothScroll = 'SmoothScroll.min.js';
			}
			wp_register_script('ultimate-smooth-scroll',$vc_addons_url.'assets/min-js/'.$smoothScroll,array('jquery'),'3.19.1',true);
			wp_register_script("ultimate-modernizr",$vc_addons_url.$js_path.'modernizr-custom'.$ext.'.js',array('jquery'),'3.19.1');
			wp_register_script("ultimate-tooltip",$vc_addons_url.$js_path.'tooltip'.$ext.'.js',array('jquery'),'3.19.1');
	
			// register css
			wp_register_style('ultimate-animate',$vc_addons_url.$css_path.'animate'.$ext.'.css',array(),'3.19.1');
			wp_register_style('ultimate-style',$vc_addons_url.$css_path.'style'.$ext.'.css',array(),'3.19.1');
			wp_register_style('ultimate-style-min',$vc_addons_url.'assets/min-css/ultimate.min.css',array(),'3.19.1');
			wp_register_style('ultimate-tooltip',$vc_addons_url.$css_path.'tooltip'.$ext.'.css',array(),'3.19.1');
	
			$ultimate_smooth_scroll = get_option('ultimate_smooth_scroll');
			if($ultimate_smooth_scroll == "enable" || $ultimate_smooth_scroll === 'enable') {
				wp_enqueue_script('ultimate-smooth-scroll');
			}
	
			if(function_exists('vc_is_editor')){
				if(vc_is_editor()){
					wp_enqueue_style('vc-fronteditor',$vc_addons_url.'assets/min-css/vc-fronteditor.min.css');
				}
			}
	
			$ultimate_global_scripts = ($loadglobally) ? 'enable' : bsf_get_option('ultimate_global_scripts');

			if($ultimate_global_scripts === 'enable') {
				
				wp_enqueue_script('ultimate-modernizr');
				wp_enqueue_script('jquery_ui');
				wp_enqueue_script('masonry');
				if(defined('DISABLE_ULTIMATE_GOOGLE_MAP_API') && (DISABLE_ULTIMATE_GOOGLE_MAP_API == true || DISABLE_ULTIMATE_GOOGLE_MAP_API == 'true'))
					$load_map_api = false;
				else
					$load_map_api = true;
				if($load_map_api)
					wp_enqueue_script('googleapis');
				wp_enqueue_script('ultimate-script');
				wp_enqueue_script('ultimate-modal-all');
				wp_enqueue_script('jquery.shake',$vc_addons_url.$js_path.'jparallax'.$ext.'.js');
				wp_enqueue_script('jquery.vhparallax',$vc_addons_url.$js_path.'vhparallax'.$ext.'.js');
	
				wp_enqueue_style('ultimate-style-min');
				wp_enqueue_style("ult-icons");
				wp_enqueue_style('ultimate-vidcons',$vc_addons_url.'assets/fonts/vidcons.css');
				wp_enqueue_script('jquery.ytplayer',$vc_addons_url.$js_path.'mb-YTPlayer'.$ext.'.js');
	
				$Ultimate_Google_Font_Manager = new Ultimate_Google_Font_Manager;
				$Ultimate_Google_Font_Manager->enqueue_selected_ultimate_google_fonts();
	
				return false;
			}
	
			if(!is_404() && !is_search()){
	
				if(stripos($post_content, 'font_call:'))
				{
					preg_match_all('/font_call:(.*?)"/',$post_content, $display);
					enquque_ultimate_google_fonts_optimzed($display[1]);
				}
				
				if( stripos( $post_content, '[swatch_container') || 
				    stripos( $post_content, '[ultimate_modal'))
				{
					wp_enqueue_script('ultimate-modernizr');
				}

				if( stripos( $post_content, '[ultimate_exp_section') ||
					stripos( $post_content, '[info_circle') ) {
					wp_enqueue_script('jquery_ui');
					wp_enqueue_script('ultimate-vc-params');
					wp_enqueue_script('info-circle');
				}

				if( stripos( $post_content, '[icon_timeline') ) {
					wp_enqueue_script('masonry');
				}

				if($isAjax == true) { // if ajax site load all js
					wp_enqueue_script('masonry');
				}

				if( stripos( $post_content, '[ultimate_google_map') ) {
					if(defined('DISABLE_ULTIMATE_GOOGLE_MAP_API') && (DISABLE_ULTIMATE_GOOGLE_MAP_API == true || DISABLE_ULTIMATE_GOOGLE_MAP_API == 'true'))
						$load_map_api = false;
					else
						$load_map_api = true;
					if($load_map_api)
						wp_enqueue_script('googleapis');
				}

				if( stripos( $post_content, '[ult_range_slider') ) {
					wp_enqueue_script('jquery-ui-mouse');
					wp_enqueue_script('jquery-ui-widget');
					wp_enqueue_script('jquery-ui-slider');
					wp_enqueue_script('ult_range_tick');
					wp_enqueue_script('ult_ui_touch_punch');
				}

				wp_enqueue_script('ultimate-script');

				if( stripos( $post_content, '[ultimate_modal') ) {
					//$modal_fixer = get_option('ultimate_modal_fixer');
					//if($modal_fixer === 'enable')
						//wp_enqueue_script('ultimate-modal-all-switched');
					//else
						wp_enqueue_script('ultimate-modal-all');
				}
				
				$ultimate_css = "enable";
	
				if ($ultimate_css == "enable"){
					wp_enqueue_style('ultimate-style-min');
					if( stripos( $post_content, '[ultimate_carousel') ) {
						wp_enqueue_style("ult-icons");
					}
				} 
			}
		}
	}	

	/*-----------------------------------------------------------------------------------*/
	/*  REQUIRED FOR WOOCOMMERCE CART
	/*-----------------------------------------------------------------------------------*/
	require_once (get_template_directory().'/inc/theme-woocart.php');
	
	
	function hazel_allowed_tags() {
		global $allowedtags, $allowedposttags;
		$allowedtags['option'] = array('style'=>array(), 'id'=>array(), 'name'=>array(), 'class'=>array(), 'value'=>array(), 'selected'=>array());
		$allowedtags['input'] = array('style'=>array(), 'id'=>array(), 'name'=>array(), 'class'=>array(), 'value'=>array(), 'selected'=>array(), 'type'=>array(), 'onchange'=>array(), 'placeholder'=>array());
		$allowedtags['label'] = array('for'=>array());
		$allowedtags['iframe'] = array('style'=>array(), 'src'=>array(), 'allowfullscreen'=>array());
		$allowedposttags['div']['aria-hidden'] = array();
		$allowedposttags['div']['style'] = array();
		$allowedtags = array_merge($allowedtags, $allowedposttags);
	}
	add_action('init', 'hazel_allowed_tags', 10);

	function hazel_get_the_woo(){
		global $woocommerce;
		return isset($woocommerce) ? $woocommerce : array(); 
	}

	/*-----------------------------------------------------------------------------------*/
	/*  LOAD GOOGLE FONTS
	/*-----------------------------------------------------------------------------------*/
	function hazel_fonts_url() {
		global $hazel_import_fonts;
		
		$aux = array();
		foreach ($hazel_import_fonts as $font){
			$aux[] = str_replace("|", ":", str_replace(" ", "+", $font));
		}
		
		$aux = array_unique($aux);
		
		if(($key = array_search("Helvetica+Neue", $aux)) !== false) {
		    unset($aux[$key]);
		}
		if(($key = array_search("Helvetica", $aux)) !== false) {
		    unset($aux[$key]);
		}
		
		$hazel_import_fonts = implode("|", $aux);
	    $font_url = '';
	    /*
	    Translators: If there are characters in your language that are not supported
	    by chosen font(s), translate this to 'off'. Do not translate into your own language.
	     */
	    if ( 'off' !== _x( 'on', 'Google font: on or off', 'hazel' ) ) {
	        $font_url = add_query_arg( 'family', $hazel_import_fonts, "//fonts.googleapis.com/css" );
	    }
	    return $font_url;
	}
	
	function hazel_google_fonts_scripts() {
	    wp_enqueue_style( 'hazel-google-fonts', hazel_fonts_url(), '' );
	}
	
	function hazel_get_custom_inline_css(){
		global $hazel_inline_css;
		wp_enqueue_style('hazel-custom-style', HAZEL_CSS_PATH .'hazel-custom.css',99);
		wp_add_inline_style('hazel-custom-style', $hazel_inline_css);
	}
	
	function hazel_set_custom_inline_css($css){
		global $hazel_inline_css;
		$tw_theme_main_color = "#".get_option('hazel_style_color');
		$hazel_inline_css .= str_replace( '__USE_THEME_MAIN_COLOR__', $tw_theme_main_color, $css );
	}
	
	function hazel_set_team_profiles_content($content){
		global $hazel_team_profiles;
		if (!isset($hazel_team_profiles)) $hazel_team_profiles = '';
		$hazel_team_profiles .= $content;
	}
	
	function hazel_get_team_profiles_content(){
		global $hazel_team_profiles;
		if (isset($hazel_team_profiles)){
			$hazel_team_profiles = wp_kses_no_null( $hazel_team_profiles, array( 'slash_zero' => 'keep' ) );
			$hazel_team_profiles = wp_kses_normalize_entities($hazel_team_profiles);
			$hazel_team_profiles = wp_kses_normalize_entities($hazel_team_profiles);
			echo wp_kses_hook($hazel_team_profiles, 'post', array());
		}
	}
	
	if (!function_exists('treethemesscrape_instagram')){
		function treethemesscrape_instagram( $username ) {
	
			$username  = trim( strtolower( str_replace( '@', '', $username ) ) );
			$instagram = get_transient( 'st_instagram_' . sanitize_title_with_dashes( $username ) );
			if ( false === $instagram ) {
				switch ( substr( $username, 0, 1 ) ) {
					case '#':
						$url = 'https://instagram.com/explore/tags/' . str_replace( '#', '', $username );
						break;
					default:
						$url = 'https://instagram.com/' . str_replace( '@', '', $username );
						break;
				}
				$remote = wp_remote_get( $url );
				if ( is_wp_error( $remote ) ) {
					return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'hazel' ) );
				}
				if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
					return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'hazel' ) );
				}
				$shards      = explode( 'window._sharedData = ', $remote['body'] );
				$insta_json  = explode( ';</script>', $shards[1] );
				$insta_array = json_decode( $insta_json[0], true );
				if ( ! $insta_array ) {
					return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'hazel' ) );
				}
				if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
					$images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
				} elseif ( isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
					$images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
				} else {
					return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'hazel' ) );
				}
				if ( ! is_array( $images ) ) {
					return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'hazel' ) );
				}
				$instagram = array();
				foreach ( $images as $image ) {
					$image = $image['node'];
					switch ( substr( $username, 0, 1 ) ) {
						case '#':
							$type = ( $image['is_video'] ) ? 'video' : 'image';
							$caption = __( 'Instagram Image', 'hazel' );
							if ( ! empty( $image['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
								$caption = $image['edge_media_to_caption']['edges'][0]['node']['text'];
							}
							$instagram[] = array(
								'description' => $caption,
								'link'        => trailingslashit( '//instagram.com/p/' . $image['shortcode'] ),
								'time'        => $image['taken_at_timestamp'],
								'comments'    => $image['edge_media_to_comment']['count'],
								'likes'       => $image['edge_liked_by']['count'],
								'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['thumbnail_resources'][0]['src'] ),
								'small'       => preg_replace( '/^https?\:/i', '', $image['thumbnail_resources'][2]['src'] ),
								'large'       => preg_replace( '/^https?\:/i', '', $image['thumbnail_resources'][4]['src'] ),
								'original'    => preg_replace( '/^https?\:/i', '', $image['display_url'] ),
								'type'        => $type,
							);
							break;
						default:
							$type = ( $image['is_video'] ) ? 'video' : 'image';
							$caption = __( 'Instagram Image', 'hazel' );
							if ( ! empty( $image['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
								$caption = $image['edge_media_to_caption']['edges'][0]['node']['text'];
							}
							$instagram[] = array(
								'description' => $caption,
								'link'        => trailingslashit( 'https://instagram.com/p/' . $image['shortcode'] ),
								'time'        => $image['taken_at_timestamp'],
								'comments'    => $image['edge_media_to_comment']['count'],
								'likes'       => $image['edge_liked_by']['count'],
								'thumbnail'   => $image['thumbnail_resources'][0]['src'],
								'small'       => $image['thumbnail_resources'][2]['src'],
								'large'       => $image['thumbnail_resources'][4]['src'],
								'original'    => $image['display_url'],
								'type'        => $type,
							);
							break;
					}
				}  // End foreach().
				// Do not set an empty transient - should help catch private or empty accounts.
				if ( ! empty( $instagram ) ) {
					$instagram = base64_encode( serialize( $instagram ) );
					set_transient( 'st_instagram_' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 1 ) );
				}
			}
			if ( ! empty( $instagram ) ) {
				return unserialize( base64_decode( $instagram ) );
			} else {
				return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'hazel' ) );
			}
		}
	}
	
	if (!function_exists('treethemesimages_only')){
		function treethemesimages_only( $media_item ) {
			if ( $media_item['type'] == 'image' )
				return true;
			return false;
		}
	}
	
	
	if (!function_exists('treethemes_scrape_instagram')){
	function treethemes_scrape_instagram() {
		
		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$limit = empty( $instance['number'] ) ? 9 : $instance['number'];
		$target = empty( $instance['target'] ) ? '_self' : $instance['target'];
		$link = empty( $instance['link'] ) ? '' : $instance['link'];
		
		$access_token = get_option('hazel_insta_token', false);
		
		if (!$access_token){
			echo 'Please authorize Instagram on Appearance > Hazel Options > Social Icons > Instagram and clicking on Authorize Instagram.';
			return;
		}
		
		$url = "https://ap" . "i.ins" . "tagr" . "am.com/v1/users/self";
		$args = array(
			'access_token' => $access_token
		);
		
		$response = hazel_remote_get($url, $args, "_scraper");
		
		$shards = explode(".",$access_token);

		if (empty($response)) {
			return false;
		}

		if (isset($response['meta']['code']) && ($response['meta']['code'] != 200) && isset($response['meta']['error_message'])) {
			echo "1 ".$response['meta']['error_message'];
			return false;
		}
		
		$limit = get_option('hazel_instagram_limit', 12);

		if (isset($response['data'])){
			
			$feedinger = hazel_access_get_user_items($access_token, null, $limit);
			
			if (isset($feedinger['data'])){
				$images = $feedinger['data'];
				
				$ulclass = apply_filters( 'treethemes_insta_list_class', 'instagram-pics' );
				$liclass = apply_filters( 'treethemes_insta_item_class', '' );
				$aclass = apply_filters( 'treethemes_insta_a_class', '' );
				$imgclass = apply_filters( 'treethemes_insta_img_class', '' );
				if (get_option('hazel_enable_grayscale') == "on") $imgclass .= ' hazel_grayscale ';
				echo '<ul class="'.esc_attr( $ulclass ).'">';
				foreach ($images as $image){
					echo '<li style="width:'. (100/$limit) .'%;" class="'. esc_attr( $liclass ) .'"><a href="'. esc_url( $image['link'] ) .'" target="'. esc_attr( $target ) .'"  class="'. esc_attr( $aclass ) .'"><img src="'. esc_url( $image['images']['thumbnail']['url'] ) .'"  alt="'. esc_attr( $image['caption']['text'] ) .'" title="'. esc_attr( $image['caption']['text'] ).'"  class="'. esc_attr( $imgclass ) .'"/></a></li>';
				}
				echo '</ul>';
				
				$linkclass = apply_filters( 'treethemes_insta_link_class', 'clear' );
				if ( get_option('hazel_instagram_link') != '' ) {
					?><p class="<?php echo esc_attr( $linkclass ); ?>"><a href="<?php echo trailingslashit( '//ins'.'tag'.'ram.com/' . $response['data']['username'] ); ?>" rel="me" target="<?php echo esc_attr( get_option('hazel_instagram_target') ); ?>"><?php echo esc_html( get_option('hazel_instagram_link') ); ?></a></p><?php
				}
				
			}
			
		} else {
			echo 'Something went wrong. Please re-authorize Instagram on Appearance > Hazel Options > Social Icons > Instagram and clicking on Authorize Instagram.';
			return;
		}
	}
}

if (!function_exists('hazel_access_get_user_items')){
	function hazel_access_get_user_items($access_token, $max_id = null, $limit = 12) {
		$args = array(
			'access_token' => $access_token,
			'max_id' => $max_id,
			'count' => $limit
		);

		$url = "https://ap" . "i.ins" . "tagr" . "am.com/v1/users/self/media/recent/";

		$response = hazel_remote_get($url, $args, "_user_items");

		if (empty($response)){
			return false;
		}

		if (isset($response['meta']['code']) && ($response['meta']['code'] != 200) && isset($response['meta']['error_message'])) {
			echo "2 ".$response['meta']['error_message'];
			return false;
		}

		if (!isset($response['data'])) {
			return false;
		}

		return $response;
	}
}

if (!function_exists('hazel_get_user_items')){
	function hazel_get_user_items($user_id = null, $limit = 12, $next_max_id = null, $max_id = null) {

		$access_token = get_option('hazel_insta_token');
		$shards = explode(".",$access_token);
		
		$response = hazel_access_get_user_items($access_token, $max_id);

		if (!isset($response['data'])) {
			return;
		}

		if (count($instagram_feeds = hazel_setup_user_item($response['data'], $next_max_id, $max_id)) >= $limit) {
			return $instagram_feeds;
		}

		if (!$next_max_id) {
			return $instagram_feeds;
		}

		if (!isset($response['pagination']['next_max_id'])) {
			return $instagram_feeds;
		}

		$max_id = $response['pagination']['next_max_id'];

		return array_merge($instagram_feeds, hazel_get_user_items($user_id, $limit, $next_max_id, $max_id));
	}
}

if (!function_exists('hazel_setup_user_item')){
	function hazel_setup_user_item($data, $next_max_id = null) {

		static $load = false;
		static $i = 1;

		if (!$next_max_id) {
			$load = true;
		}

		$instagram_items = array();

		if (is_array($data) && !empty($data)) {
			foreach ($data as $item) {
				if ($load) {
					preg_match_all("/#(\\w+)/", @$item['caption']['text'], $hashtags);
					$instagram_items[] = array(
						'i' => $i,
						'id' => str_replace("_{$item['user']['id']}", '', $item['id']),
						'images' => array(
							'standard' => @$item['images']['standard_resolution']['url'],
							'medium' => @$item['images']['low_resolution']['url'],
							'small' => @$item['images']['thumbnail']['url'],
						),
						'videos' => array(
							'standard' => @$item['videos']['standard_resolution']['url'],
							'medium' => @$item['videos']['low_resolution']['url'],
							'small' => @$item['videos']['thumbnail']['url'],
						),
						'likes' => @$item['likes']['count'],
						'comments' => @$item['comments']['count'],
						'caption' => preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', "<a href=\"https://www.instagram.com/explore/tags/$1\">#$1</a>", htmlspecialchars(@$item['caption']['text'])),
						'hashtags' => @$hashtags[1],
						'link' => @$item['link'],
						'type' => @$item['type'],
						'user_id' => @$item['user']['id'],
						'date' => date_i18n('j F, Y', strtotime(@$item['created_time']))
					);
				}
				if ($next_max_id && ($next_max_id == $i)) {
					$i = $next_max_id;
					$load = true;
				}
				$i++;
			}
		}
		return $instagram_items;
	}
}

if (!function_exists('hazel_remote_get')){
	function hazel_remote_get($url = null, $args = array(), $culprit = "") {
		if (!get_transient( 'hazel_insta_transient'.$culprit )){
			$url = add_query_arg($args, trailingslashit($url));
			$response = hazel_validate_response(wp_remote_get($url, array('timeout' => 29)));
			if (!isset($reponse['error'])) set_transient( 'hazel_insta_transient'.$culprit, $response, 3600 );
		} else $response = get_transient( 'hazel_insta_transient'.$culprit );
		return $response;
	}
}

if (!function_exists('hazel_validate_response')){
	function hazel_validate_response($json = null) {

		if (!($response = json_decode(wp_remote_retrieve_body($json), true)) || 200 !== wp_remote_retrieve_response_code($json)) {
			if (isset($response['meta']['error_message'])) {
				echo "3 ".$response['meta']['error_message'];
				return array(
					'error' => 1,
					'message' => $response['meta']['error_message']
				);
			}

			if (isset($response['error_message'])) {
				return array(
					'error' => 1,
					'message' => $response['error_message']
				);
			}

			if (is_wp_error($json)) {
				$response = array(
					'error' => 1,
					'message' => $json->get_error_message()
				);
			} else {
				$response = array(
					'error' => 1,
					'message' => esc_html__('Unknown error occurred, please try again', 'hazel')
				);
			}
		}
		return $response;
	}
}
	
	