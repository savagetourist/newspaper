<?php
/*
Plugin Name: Hazel Custom Post Types
Plugin URI: http://treethemes.net
Description: Testimonials, Projects and Tree Themes Templates for WP Bakery page Builder.
Version: 2.3.1
Author: TreeThemes
Author URI: http://treethemes.net
*/


// don't load directly
if ( ! defined( 'ABSPATH' )) {
	die( '-1' );
}

/* defines */
if (!defined('HAZEL_PORTFOLIO_POST_TYPE')){
	if (!defined('HAZEL_SHORTNAME')) define('HAZEL_SHORTNAME', 'hazel');
	$portfolio_permalink = get_option(HAZEL_SHORTNAME."_portfolio_permalink");
	if (!get_option(HAZEL_SHORTNAME."_portfolio_permalink")) define("HAZEL_PORTFOLIO_POST_TYPE", "portfolio");
	else define("HAZEL_PORTFOLIO_POST_TYPE", get_option(HAZEL_SHORTNAME."_portfolio_permalink"));
}
if (!defined('HAZEL_TESTIMONIALS_POST_TYPE')){
	define("HAZEL_TESTIMONIALS_POST_TYPE", 'testimonials');
}

if (!defined('HAZEL_PLG_URL')){
	define('HAZEL_PLG_URL', plugin_dir_url(__FILE__) );
}
if (!defined('HAZEL_PLG_PATH')){
	define('HAZEL_PLG_PATH', plugin_dir_path(__FILE__) );
}

if (!defined('HAZEL_PLG_ACTIVE')){
	define('HAZEL_PLG_ACTIVE', true );
}



/*******+++++**/
/*	projects
/********+++++*/
/**
 * ADD THE ACTIONS
 */
add_action('init', 'hazel_register_portfolio_category');  //functions/portfolio.php
add_action('init', 'hazel_register_portfolio_post_type');  //functions/portfolio.php
add_action('manage_posts_custom_column',  'portfolio_show_columns'); //functions/portfolio.php
add_filter('manage_edit-portfolio_columns', 'portfolio_columns');

/**
 * Registers the portfolio category taxonomy.
 */
if (!function_exists('hazel_register_portfolio_category')){
    function hazel_register_portfolio_category(){

        register_taxonomy("portfolio_category",
            array(HAZEL_PORTFOLIO_POST_TYPE),
            array(	"hierarchical" => true,
                "label" => "Categories",
                "singular_label" => "Categories",
                "rewrite" => true,
                "query_var" => true
            ));

        register_taxonomy("portfolio_type",
            array(HAZEL_PORTFOLIO_POST_TYPE),
            array(	"hierarchical" => true,
                "label" => "Portfolios",
                "singular_label" => "Portfolios",
                "rewrite" => true,
                "query_var" => true
            ));
    }
}


/**
 * Registers the portfolio custom type.
 */
if (!function_exists('hazel_register_portfolio_post_type')){
    function hazel_register_portfolio_post_type() {
        $portfolio_permalink = get_option(HAZEL_SHORTNAME."_portfolio_permalink");
        //the labels that will be used for the portfolio items
        $labels = array(
            'name' => _x('Projects', 'portfolio name','hazel'),
            'singular_name' => _x('Project Item', 'portfolio type singular name','hazel'),
            'add_new' => __('Add New','hazel'),
            'add_new_item' => __('Add New Item','hazel'),
            'edit_item' => __('Edit Item','hazel'),
            'new_item' => __('New Project Item','hazel'),
            'view_item' => __('View Item','hazel'),
            'search_items' => __('Search Project Items','hazel'),
            'not_found' =>  __('No project items found','hazel'),
            'not_found_in_trash' => __('No project items found in Trash','hazel'),
            'parent_item_colon' => ''
        );

        //register the custom post type
        register_post_type( HAZEL_PORTFOLIO_POST_TYPE,
            array( 'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'capability_type' => 'post',
                'menu_icon' => get_template_directory_uri() . '/images/hazel_icons/projectsicon.png',
                'hierarchical' => false,
                'rewrite' => array( 'with_front' => 'false', 'slug' => $portfolio_permalink ),
                'taxonomies' => array('portfolio_category'),
                'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes', 'excerpt') ) );


    }
}



/* ------------------------------------------------------------------------*
 * SET THE DEFAULT IMAGE SIZES FOR THE PORTFOLIO ITEMS REGARDING THE
 * NUMBER OF COLUMNS
 * ------------------------------------------------------------------------*/

if (!function_exists('portfolio_columns')){
    function portfolio_columns($columns) {
        $columns['category'] = 'Category';
        $columns['type'] = 'Portfolio';
        return $columns;
    }
}

/**
 * Add category column to the portfolio items page
 * @param $name
 */
if (!function_exists('portfolio_show_columns')){
    function portfolio_show_columns($name) {
        global $post;
        switch ($name) {
            case 'category':
                $cats = get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' );
                echo $cats;
                break;
            case 'type':
                $cats = get_the_term_list( $post->ID, 'portfolio_type', '', ', ', '' );
                echo $cats;
                break;
        }
    }
}


/* new order by features helper */
if (!function_exists('treethemes_orderby_tax_clauses')){
	function treethemes_orderby_tax_clauses( $clauses, $wp_query ) {
		$orderby_arg = $wp_query->get('orderby');
		if ( ! empty( $orderby_arg ) && substr_count( $orderby_arg, 'taxonomy.' ) ) {
			global $wpdb;
			$bytax = "GROUP_CONCAT({$wpdb->terms}.name ORDER BY name ASC)";
			$array = explode( ' ', $orderby_arg ); 
			if ( ! isset( $array[1] ) ) {
				$array = array( $bytax, "{$wpdb->posts}.post_date" );
				$taxonomy = str_replace( 'taxonomy.', '', $orderby_arg );
			} else {
				foreach ( $array as $i => $t ) {
					if ( substr_count( $t, 'taxonomy.' ) )  {
						$taxonomy = str_replace( 'taxonomy.', '', $t );
						$array[$i] = $bytax;
					} elseif ( $t === 'meta_value' || $t === 'meta_value_num' ) {
						$cast = ( $t === 'meta_value_num' ) ? 'SIGNED' : 'CHAR';
						$array[$i] = "CAST( {$wpdb->postmeta}.meta_value AS {$cast} )";
					} else {
					$array[$i] = "{$wpdb->posts}.{$t}";
					}
				}
			}
			$order = strtoupper( $wp_query->get('order') ) === 'ASC' ? ' ASC' : ' DESC';
			$ot = strtoupper( $wp_query->get('ordertax') );
			$ordertax = $ot === 'DESC' || $ot === 'ASC' ? " $ot" : " $order";
			$clauses['orderby'] = implode(', ',
			array_map( function($a) use ( $ordertax, $order ) {
				return ( strpos($a, 'GROUP_CONCAT') === 0 ) ? $a . $ordertax : $a . $order;
			}, $array ));
			$clauses['join'] .= " LEFT OUTER JOIN {$wpdb->term_relationships} ";
			$clauses['join'] .= "ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id";
			$clauses['join'] .= " LEFT OUTER JOIN {$wpdb->term_taxonomy} ";
			$clauses['join'] .= "USING (term_taxonomy_id)";
			$clauses['join'] .= " LEFT OUTER JOIN {$wpdb->terms} USING (term_id)";
			$clauses['groupby'] = "object_id";
			$clauses['where'] .= " AND (taxonomy = '{$taxonomy}' OR taxonomy IS NULL)";
		}
		return $clauses;
	}	
}

/**
 * Gets a list of custom taxomomies by type
 * @param $type the type of the taxonomy
 */
if (!function_exists('hazel_get_taxonomies')){
    function hazel_get_taxonomies($type){
        $args = array(
            'type' => 'post',
            'orderby' => 'id',
            'order' => 'ASC',
            'taxonomy' => $type,
            'hide_empty' => 1,
            'pad_counts' => false );

        $categories = get_categories( $args );

        return $categories;
    }
}


/**
 * Gets a list of custom taxomomies by slug
 * @param $term_id the slug
 */
if (!function_exists('hazel_get_taxonomy_slug')){
    function hazel_get_taxonomy_slug($term_id){
        global $wpdb;

        $res = $wpdb->get_results($wpdb->prepare("SELECT slug FROM $wpdb->terms WHERE term_id=%s LIMIT 1;", $term_id));
        $res=$res[0];
        return $res->slug;
    }
}

/**
 * Gets a list of custom taxomomy's children
 * @param $type the type of the taxonomy
 * @param $parent_id the slug of the parent taxonomy
 */
if (!function_exists('hazel_get_taxonomy_children')){
    function hazel_get_taxonomy_children($type, $parent_id){
        global $wpdb;

        if($parent_id!='-1'){
            $res = $wpdb->get_results($wpdb->prepare("SELECT t.term_id, t.name, t.slug FROM $wpdb->terms as t LEFT JOIN $wpdb->term_taxonomy tt ON t.term_id=tt.term_id WHERE tt.taxonomy=%s AND tt.parent=%s;", $type, $parent_id));
        }else{
            $res = $wpdb->get_results($wpdb->prepare("SELECT t.term_id, t.name, t.slug FROM $wpdb->terms as t LEFT JOIN $wpdb->term_taxonomy tt ON t.term_id=tt.term_id WHERE tt.taxonomy=%s;", $type));
        }
        return $res;
    }
}

if (!function_exists('hazel_get_projects')){
    function hazel_get_projects(){
        $proj = array();
        $args= array(
            'posts_per_page' =>-1,
            'post_type' => HAZEL_PORTFOLIO_POST_TYPE
        );
        query_posts($args);

        if(have_posts()) {
            while (have_posts()) {
                the_post();
                $proj[] = array("p_title"=>get_the_title(), "p_id"=>get_the_ID());
                //$ret .= get_the_title() . "|*|";
            }
        }

        return $proj;
    }
}

/*******+++++**/
/*	testimonials
/********+++++*/
/**
 * ADD THE ACTIONS
 */
add_action('init', 'hazel_register_testimonials_post_type');  //functions/testimonials.php


/**
 * Registers the portfolio custom type.
 */
if (!function_exists('hazel_register_testimonials_post_type')){
    function hazel_register_testimonials_post_type() {

        register_taxonomy("testimonials_category",
            array(HAZEL_TESTIMONIALS_POST_TYPE),
            array(	"hierarchical" => true,
                "label" => "Categories",
                "singular_label" => "Categories",
                "rewrite" => true,
                "query_var" => true,
                "show_admin_column" => true,
            ));

        //the labels that will be used for the portfolio items
        $labels = array(
            'name' => _x('Testimonials', 'testimonials name','hazel'),
            'singular_name' => _x('Testimonials Item', 'testimonials type singular name','hazel'),
            'add_new' => __('Add New','hazel'),
            'add_new_item' => __('Add New Item','hazel'),
            'edit_item' => __('Edit Item','hazel'),
            'new_item' => __('New Testimonials Item','hazel'),
            'view_item' => __('View Item','hazel'),
            'search_items' => __('Search Testimonials Items','hazel'),
            'not_found' =>  __('No testimonials items found','hazel'),
            'not_found_in_trash' => __('No testimonials items found in Trash','hazel'),
            'parent_item_colon' => ''
        );

        //register the custom post type
        register_post_type( HAZEL_TESTIMONIALS_POST_TYPE,
            array( 'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'exclude_from_search' => true,
                'show_in_nav_menus' => false,
                'menu_icon' => get_template_directory_uri() . '/images/hazel_icons/testicon.png',
                'capability_type' => 'post',
                'hierarchical' => false,
                'rewrite' => array('slug'=>'testimonials'),
                'taxonomies' => array('testimonials_category'),
                'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes') ) );


    }
}

if (!function_exists('hazel_init_cpt_plugin')){
    function hazel_init_cpt_plugin(){
        hazel_register_testimonials_post_type();
    }
}

if (!function_exists('hazel_testimonials_categories_settings_field')){
	function hazel_testimonials_categories_settings_field($settings, $value){
		//$dependency = vc_generate_dependencies_attributes($settings);
		$taxonomy = 'testimonials_category';
		$tax_terms = get_terms($taxonomy);
		$output = "";
		if (!count($tax_terms)){
			$output .= "No categories defined.";
			$output .= '<input name="'.esc_attr($settings['param_name']).'" class="hidden wpb_vc_param_value wpb-textinput '.esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="text" value="0" />';
		} else {
			if (count($tax_terms) > 1) $output .= "<label class='testimonial_categories'><input class='selectall' type='checkbox' name='categories[]' value='0' onchange=\"if(jQuery(this).is(':checked')){ jQuery(this).parent().siblings().children('input').attr('checked',true);jQuery(this).parent().siblings('input.".esc_js($settings['param_name'])."').val('-1');} else { jQuery(this).parent().siblings().children('input').attr('checked',false);jQuery(this).parent().siblings('input.".esc_js($settings['param_name'])."').val('0');}\" />".esc_html__('All','hazel')."</label>";
			$value = explode(",",$value);
			foreach ($tax_terms as $tax_term) {
				$output .= "<label class='testimonial_categories'><input ";
				if (in_array($tax_term->slug, $value)) $output .= " checked='checked' ";
				$output .= "class='categories_checks' type='checkbox' name='categories[]' value='".esc_attr($tax_term->slug)."' onchange=\"var output = '';jQuery('.edit_form_line input:checked').not('.selectall').each(function(e){ if(e!=0){output += ',';} output += jQuery(this).val(); }); jQuery(this).parent().siblings('.testimonials_cats_field').val(output); if (jQuery('.edit_form_line input').not('.selectall').not(':checked').length) jQuery('.edit_form_line input.selectall').attr('checked',false); if (jQuery('.edit_form_line input.categories_checks:checked').not('.selectall').length == jQuery('.edit_form_line input.categories_checks').not('.selectall').length) jQuery('.edit_form_line input.selectall').attr('checked',true); \" />".esc_html($tax_term->name)."</label>";
			}
			$output .= '<input name="'.esc_attr($settings['param_name']).'" class="hidden wpb_vc_param_value wpb-textinput '.esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="text" value="'.esc_attr(implode(",",$value)).'" />';
		}
		return $output;
	}
}


if (!function_exists('hazel_fa_settings_field')){
	function hazel_fa_settings_field($settings, $value) {
	   //$dependency = vc_generate_dependencies_attributes($settings);
		$icons = array('fa-adjust','fa-adn','fa-align-center','fa-align-justify','fa-align-left','fa-align-right','fa-ambulance','fa-anchor','fa-android','fa-angle-double-down','fa-angle-double-left','fa-angle-double-right','fa-angle-double-up','fa-angle-down','fa-angle-left','fa-angle-right','fa-angle-up','fa-apple','fa-archive','fa-arrow-circle-down','fa-arrow-circle-left','fa-arrow-circle-o-down','fa-arrow-circle-o-left','fa-arrow-circle-o-right','fa-arrow-circle-o-up','fa-arrow-circle-right','fa-arrow-circle-up','fa-arrow-down','fa-arrow-left','fa-arrow-right','fa-arrow-up','fa-arrows','fa-arrows-alt','fa-arrows-h','fa-arrows-v','fa-asterisk','fa-automobile','fa-backward','fa-ban','fa-bank','fa-bar-chart-o','fa-barcode','fa-bars','fa-beer','fa-behance','fa-behance-square','fa-bell','fa-bell-o','fa-bitbucket','fa-bitbucket-square','fa-bitcoin','fa-bold','fa-bolt','fa-bomb','fa-book','fa-bookmark','fa-bookmark-o','fa-briefcase','fa-btc','fa-bug','fa-building','fa-building-o','fa-bullhorn','fa-bullseye','fa-cab','fa-calendar','fa-calendar-o','fa-camera','fa-camera-retro','fa-car','fa-caret-down','fa-caret-left','fa-caret-right','fa-caret-square-o-down','fa-caret-square-o-left','fa-caret-square-o-right','fa-caret-square-o-up','fa-caret-up','fa-certificate','fa-chain','fa-chain-broken','fa-check','fa-check-circle','fa-check-circle-o','fa-check-square','fa-check-square-o','fa-chevron-circle-down','fa-chevron-circle-left','fa-chevron-circle-right','fa-chevron-circle-up','fa-chevron-down','fa-chevron-left','fa-chevron-right','fa-chevron-up','fa-child','fa-circle','fa-circle-o','fa-circle-o-notch','fa-circle-thin','fa-clipboard','fa-clock-o','fa-cloud','fa-cloud-download','fa-cloud-upload','fa-cny','fa-code','fa-code-fork','fa-codepen','fa-coffee','fa-cog','fa-cogs','fa-columns','fa-comment','fa-comment-o','fa-comments','fa-comments-o','fa-compass','fa-compress','fa-copy','fa-credit-card','fa-crop','fa-crosshairs','fa-css3','fa-cube','fa-cubes','fa-cut','fa-cutlery','fa-dashboard','fa-database','fa-dedent','fa-delicious','fa-desktop','fa-deviantart','fa-digg','fa-dollar','fa-dot-circle-o','fa-download','fa-dribbble','fa-dropbox','fa-drupal','fa-edit','fa-eject','fa-ellipsis-h','fa-ellipsis-v','fa-empire','fa-envelope','fa-envelope-o','fa-envelope-square','fa-eraser','fa-eur','fa-euro','fa-exchange','fa-exclamation','fa-exclamation-circle','fa-exclamation-triangle','fa-expand','fa-external-link','fa-external-link-square','fa-eye','fa-eye-slash','fa-facebook','fa-facebook-square','fa-fast-backward','fa-fast-forward','fa-fax','fa-female','fa-fighter-jet','fa-file','fa-file-archive-o','fa-file-audio-o','fa-file-code-o','fa-file-excel-o','fa-file-image-o','fa-file-movie-o','fa-file-o','fa-file-pdf-o','fa-file-photo-o','fa-file-picture-o','fa-file-powerpoint-o','fa-file-sound-o','fa-file-text','fa-file-text-o','fa-file-video-o','fa-file-word-o','fa-file-zip-o','fa-files-o','fa-film','fa-filter','fa-fire','fa-fire-extinguisher','fa-flag','fa-flag-checkered','fa-flag-o','fa-flash','fa-flask','fa-flickr','fa-floppy-o','fa-folder','fa-folder-o','fa-folder-open','fa-folder-open-o','fa-font','fa-forward','fa-foursquare','fa-frown-o','fa-gamepad','fa-gavel','fa-gbp','fa-ge','fa-gear','fa-gears','fa-gift','fa-git','fa-git-square','fa-github','fa-github-alt','fa-github-square','fa-gittip','fa-glass','fa-globe','fa-google','fa-google-plus','fa-google-plus-square','fa-graduation-cap','fa-group','fa-h-square','fa-hacker-news','fa-hand-o-down','fa-hand-o-left','fa-hand-o-right','fa-hand-o-up','fa-hdd-o','fa-header','fa-headphones','fa-heart','fa-heart-o','fa-history','fa-home','fa-hospital-o','fa-html5','fa-image','fa-inbox','fa-indent','fa-info','fa-info-circle','fa-inr','fa-instagram','fa-institution','fa-italic','fa-joomla','fa-jpy','fa-jsfiddle','fa-key','fa-keyboard-o','fa-krw','fa-language','fa-laptop','fa-leaf','fa-legal','fa-lemon-o','fa-level-down','fa-level-up','fa-life-bouy','fa-life-ring','fa-life-saver','fa-lightbulb-o','fa-link','fa-linkedin','fa-linkedin-square','fa-linux','fa-list','fa-list-alt','fa-list-ol','fa-list-ul','fa-location-arrow','fa-lock','fa-long-arrow-down','fa-long-arrow-left','fa-long-arrow-right','fa-long-arrow-up','fa-magic','fa-magnet','fa-mail-forward','fa-mail-reply','fa-mail-reply-all','fa-male','fa-map-marker','fa-maxcdn','fa-medkit','fa-meh-o','fa-microphone','fa-microphone-slash','fa-minus','fa-minus-circle','fa-minus-square','fa-minus-square-o','fa-mobile','fa-mobile-phone','fa-money','fa-moon-o','fa-mortar-board','fa-music','fa-navicon','fa-openid','fa-outdent','fa-pagelines','fa-paper-plane','fa-paper-plane-o','fa-paperclip','fa-paragraph','fa-paste','fa-pause','fa-paw','fa-pencil','fa-pencil-square','fa-pencil-square-o','fa-phone','fa-phone-square','fa-photo','fa-picture-o','fa-pied-piper','fa-pied-piper-alt','fa-pinterest','fa-pinterest-square','fa-plane','fa-play','fa-play-circle','fa-play-circle-o','fa-plus','fa-plus-circle','fa-plus-square','fa-plus-square-o','fa-power-off','fa-print','fa-puzzle-piece','fa-qq','fa-qrcode','fa-question','fa-question-circle','fa-quote-left','fa-quote-right','fa-ra','fa-random','fa-rebel','fa-recycle','fa-reddit','fa-reddit-square','fa-refresh','fa-renren','fa-reorder','fa-repeat','fa-reply','fa-reply-all','fa-retweet','fa-rmb','fa-road','fa-rocket','fa-rotate-left','fa-rotate-right','fa-rouble','fa-rss','fa-rss-square','fa-rub','fa-ruble','fa-rupee','fa-save','fa-scissors','fa-search','fa-search-minus','fa-search-plus','fa-send','fa-send-o','fa-share','fa-share-alt','fa-share-alt-square','fa-share-square','fa-share-square-o','fa-shield','fa-shopping-cart','fa-sign-in','fa-sign-out','fa-signal','fa-sitemap','fa-skype','fa-slack','fa-sliders','fa-smile-o','fa-sort','fa-sort-alpha-asc','fa-sort-alpha-desc','fa-sort-amount-asc','fa-sort-amount-desc','fa-sort-asc','fa-sort-desc','fa-sort-down','fa-sort-numeric-asc','fa-sort-numeric-desc','fa-sort-up','fa-soundcloud','fa-space-shuttle','fa-spinner','fa-spoon','fa-spotify','fa-square','fa-square-o','fa-stack-exchange','fa-stack-overflow','fa-star','fa-star-half','fa-star-half-empty','fa-star-half-full','fa-star-half-o','fa-star-o','fa-steam','fa-steam-square','fa-step-backward','fa-step-forward','fa-stethoscope','fa-stop','fa-strikethrough','fa-stumbleupon','fa-stumbleupon-circle','fa-subscript','fa-suitcase','fa-sun-o','fa-superscript','fa-support','fa-table','fa-tablet','fa-tachometer','fa-tag','fa-tags','fa-tasks','fa-taxi','fa-tencent-weibo','fa-terminal','fa-text-height','fa-text-width','fa-th','fa-th-large','fa-th-list','fa-thumb-tack','fa-thumbs-down','fa-thumbs-o-down','fa-thumbs-o-up','fa-thumbs-up','fa-ticket','fa-times','fa-times-circle','fa-times-circle-o','fa-tint','fa-toggle-down','fa-toggle-left','fa-toggle-right','fa-toggle-up','fa-trash-o','fa-tree','fa-trello','fa-trophy','fa-truck','fa-try','fa-tumblr','fa-tumblr-square','fa-turkish-lira','fa-twitter','fa-twitter-square','fa-umbrella','fa-underline','fa-undo','fa-university','fa-unlink','fa-unlock','fa-unlock-alt','fa-unsorted','fa-upload','fa-usd','fa-user','fa-user-md','fa-users','fa-video-camera','fa-vimeo-square','fa-vine','fa-vk','fa-volume-down','fa-volume-off','fa-volume-up','fa-warning','fa-wechat','fa-weibo','fa-weixin','fa-wheelchair','fa-windows','fa-won','fa-wordpress','fa-wrench','fa-xing','fa-xing-square','fa-yahoo','fa-yen','fa-youtube','fa-youtube-play','fa-youtube-square');
		$output = '<div class="hazel_fa_block">'
		             .'<input name="'.esc_attr($settings['param_name'])
		             .'" class="wpb_vc_param_value wpb-textinput '
		             .esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="text" value="'
		             .esc_attr($value).'" />'
		         .'</div><div class="icons-container">';
		foreach($icons as $i){
			$output .= '<i class="fa '.esc_attr($i);
			if ($i == $value) $output .= ' selected';
			$output .= '" onclick="jQuery(this).closest(\'.edit_form_line\').find(\'input.hazel_fa_field\').val(\''.esc_js($i).'\');jQuery(this).addClass(\'selected\').siblings().removeClass(\'selected\');"/>';
		}
		$output .= '</div>';
	   return $output;
	}
}

if (!class_exists('VCExtendAddonClass')){
	class VCExtendAddonClass {
	
	    function __construct() {
	        // We safely integrate with VC with this hook
	        add_action( 'vc_before_init', array( $this, 'hazel_integrateWithVC' ) );       
	        add_action( 'admin_enqueue_scripts', array( $this, 'treethemes_cpt_admin_scripts' ) );
	        
	        global $hazel_testimonials_index, $hazel_single_testimonial_index;
	        	$hazel_testimonials_index = $hazel_single_testimonial_index = 1;
	    }
		
		function treethemes_cpt_admin_scripts(){
			wp_enqueue_style("treethemes-cpt-admin",plugins_url("lib/css/treethemes-cpt-admin.css",__FILE__));
		}
		
	    public function hazel_integrateWithVC() {
		    
		    if (function_exists('add_shortcode')){
				add_shortcode( 'testimonials', array( $this, 'hazel_renderTestimonials' ) );
	        }
		    
	        $vs_posttypes = get_option('wpb_js_content_types');
	        if (!isset($vs_posttypes)) update_option('wpb_js_content_types', array('post','page','portfolio'), true );
	        else {
		        if (!isset($vs_posttypes) || !$vs_posttypes) {
			        $vs_posttypes = array('post','page','portfolio');
		        }
				if (is_array($vs_posttypes) && !in_array('page',$vs_posttypes)){ 
					array_push($vs_posttypes, 'page');
				}
				if (is_array($vs_posttypes) && !in_array('portfolio',$vs_posttypes)){ 
					array_push($vs_posttypes, 'portfolio');
				} 
				update_option('wpb_js_content_types', $vs_posttypes, true);
	        }
        
	        vc_map( array(
				'name' => esc_html__( 'Testimonials', 'hazel' ),
				"category" => 'Shortcodes',
				'base' => 'testimonials',
				'is_container' => false,
				"icon" => "vc_extend_testimonials_icon", // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
				'admin_enqueue_js' => HAZEL_PLG_URL . 'lib/vc_shortcodes/testimonials.js',
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Style', 'hazel'),
						'param_name' => 'style_testimonials',
						'description' => esc_html__('3 Different Styles to choose from.','hazel'),
						'value' => array(
							esc_html__( 'Style 1', 'hazel' ) => 'style1',
							esc_html__( 'Style 2 (with scroller)', 'hazel' ) => 'style2',
							esc_html__( 'Style 3 (single wide)', 'hazel' ) => 'style3'
						),
					),
				
					/*flexoptions*/
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Animation Type','hazel'),
						'param_name' => 'des_testimonials_flex_animation',
						'description' => esc_html__('Choose between Slide and Fade effects.','hazel'),
						'value' => array(
							esc_html__( 'Slide', 'hazel' ) => 'slide',
							esc_html__( 'Fade', 'hazel' ) => 'fade'
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Slideshow?', 'hazel' ),
						'param_name' => 'des_testimonials_flex_slideshow',
						'description' => esc_html__( 'Animate slider automatically.', 'hazel' ),
						'value' => array( esc_html__( 'Yes, please', 'hazel' ) => 'yes', esc_html__( 'No, thanks', 'hazel' ) => 'no' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Slideshow Speed', 'hazel' ),
						'param_name' => 'des_testimonials_flex_slideshow_speed',
						'description' => esc_html__( 'Set the speed of the slideshow cycling, in milliseconds.', 'hazel' ),
						'value' => '3500'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Duration', 'hazel' ),
						'param_name' => 'des_testimonials_flex_animation_duration',
						'description' => esc_html__( 'Set the speed of animations, in milliseconds.', 'hazel' ),
						'value' => '1000'
					),
					
					/* new hazel options */
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Number of Items in Desktop', 'hazel' ),
						'param_name' => 'des_testimonials_flex_items_desktop',
						'description' => esc_html__( 'The number of visible items per slide in a desktop.', 'hazel' ),
						'value' => array('1'=>1,'2'=>2,'3'=>3),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Number of Items in a Small Desktop', 'hazel' ),
						'param_name' => 'des_testimonials_flex_items_small_desktop',
						'description' => esc_html__( 'The number of visible items per slide in a small desktop.', 'hazel' ),
						'value' => array('1'=>1,'2'=>2,'3'=>3),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Number of Items in a Tablet', 'hazel' ),
						'param_name' => 'des_testimonials_flex_items_tablet',
						'description' => esc_html__( 'The number of visible items per slide in a tablet.', 'hazel' ),
						'value' => array('1'=>1,'2'=>2,'3'=>3),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Number of Items in Mobile', 'hazel' ),
						'param_name' => 'des_testimonials_flex_items_mobile',
						'description' => esc_html__( 'The number of visible items per slide in a mobile.', 'hazel' ),
						'value' => array('1'=>1,'2'=>2,'3'=>3),
					),
					/* endof new hazel options */
					
					
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Direction Navigation', 'hazel' ),
						'param_name' => 'des_testimonials_flex_direction_nav',
						'description' => esc_html__( 'Create navigation for previous/next navigation.', 'hazel' ),
						'value' => array( esc_html__( 'Yes, please', 'hazel' ) => 'yes', esc_html__( 'No, thanks', 'hazel' ) => 'no' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Navigation Style', 'hazel' ),
						'param_name' => 'des_testimonials_flex_nav_style',
						'description' => esc_html__( 'Choose between Dark and Light style.', 'hazel' ),
						'value' => array( esc_html__( 'Dark', 'hazel' ) => 'dark', esc_html__( 'Light', 'hazel' ) => 'light' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Control Navigation', 'hazel' ),
						'param_name' => 'des_testimonials_flex_control_nav',
						'description' => esc_html__( 'Create navigation for paging control of each slide.', 'hazel' ),
						'value' => array( esc_html__( 'Yes, please', 'hazel' ) => 'yes', esc_html__( 'No, thanks', 'hazel' ) => 'no' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Pause on Hover', 'hazel' ),
						'param_name' => 'des_testimonials_flex_pause_on_hover',
						'description' => esc_html__( 'Pause the slideshow when hovering over slider, then resume when no longer hovering.', 'hazel' ),
						'value' => array( esc_html__( 'Yes, please', 'hazel' ) => 'yes', esc_html__( 'No, thanks', 'hazel' ) => 'no' )
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Testimonials Scroller Height', 'hazel' ),
						'param_name' => 'des_testimonials_flex_height',
						'description' => esc_html__( 'The height of the testimonials scroller in pixels.', 'hazel' ),
						'std' => '650'
					),
					/*endofflexoptions*/
				
					array(
						'type' => 'testimonials_cats',
						'heading' => esc_html__( 'Categories', 'hazel' ),
						'param_name' => 'testimonials_cats',
						'description' => esc_html__( 'Choose one or more Categories', 'hazel' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number of Testimonials', 'hazel' ),
						'param_name' => 'number',
						'description' => esc_html__( 'The number of testimonials. If set to 0 it will display all.', 'hazel' )
					),
					/* new order options */
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order By', 'hazel' ),
						'param_name' => 'hazel_testimonials_orderby',
						'value' => array( esc_html__( 'Date', 'hazel' ) => 'date', esc_html__( 'Author', 'hazel' ) => 'author', esc_html__( 'Company', 'hazel' ) => 'company' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'hazel' ),
						'param_name' => 'hazel_testimonials_order',
						'value' => array( esc_html__( 'DESC', 'hazel' ) => 'DESC', esc_html__( 'ASC', 'hazel' ) => 'ASC' )
					),
					/* endof new order options */
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hide author?', 'hazel' ),
						'param_name' => 'hide_author',
						'description' => esc_html__( 'If selected, the author will not be displayed.', 'hazel' ),
						'value' => array( esc_html__( 'Yes, please', 'hazel' ) => 'yes' )
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hide company?', 'hazel' ),
						'param_name' => 'hide_company',
						'description' => esc_html__( 'If selected, the company will not be displayed.', 'hazel' ),
						'value' => array( esc_html__( 'Yes, please', 'hazel' ) => 'yes' )
					)
				),
				'js_view' => 'VcTestimonialsView',
				'front_enqueue_js' => array(HAZEL_PLG_URL . "lib/vc_shortcodes/testimonials.js")
			) );
		
	    }
    
	    /*
	    Shortcode logic how it should be rendered
	    */
    
	    public function hazel_renderTestimonials( $atts, $content = null ) {	
	    
		  extract( shortcode_atts( array(
			 'style_testimonials' => 'style1',
			 'testimonials_cats' => -1,
		  	 'number' => -1,
			 'hide_author' => 'no',
			 'hide_company' => 'no',
			 'des_testimonials_flex_animation' => 'slide',
			 'des_testimonials_flex_direction' => 'horizontal',
			 'des_testimonials_flex_items_desktop' => 1,
			 'des_testimonials_flex_items_small_desktop' => 1,
			 'des_testimonials_flex_items_tablet' => 1,
			 'des_testimonials_flex_items_mobile' => 1,
			 'des_testimonials_flex_slideshow' => 'yes',
			 'des_testimonials_flex_slideshow_speed' => '3500',
			 'des_testimonials_flex_animation_duration' => '1000',
			 'des_testimonials_flex_direction_nav' => 'yes',
			 'des_testimonials_flex_control_nav' => 'yes',
			 'des_testimonials_flex_pause_on_hover' => 'yes',
			 'des_testimonials_flex_nav_style' => 'dark',
			 'des_testimonials_flex_height' => '650'
		  ), $atts ) );
	      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

		  global $hazel_testimonials_index, $hazel_single_testimonial_index;
			  $hazel_testimonials_index = vc_is_inline() ? uniqid() : $hazel_testimonials_index;
			  $hazel_single_testimonial_index = vc_is_inline() ? uniqid() : $hazel_single_testimonial_index;
		  $output = "";
	  
		  if ($testimonials_cats == "0" || $testimonials_cats == -1 || $testimonials_cats == "") {
			  $args = array(
				'posts_per_page' => $number,
			  	'post_type' => 'testimonials'
			  );
			  $testimonials = get_posts($args);
		  } else {
			  $testimonials_cats = explode(",",$testimonials_cats);
			  $aux_cats = array();
  			  foreach($testimonials_cats as $t){
  			  	  $term = get_term_by( 'slug', $t, 'testimonials_category', ARRAY_A );
  			  	  if (!empty($term)){
	  			  	  $aux_cats[] = $term['term_taxonomy_id'];
  			  	  }
  			  }
  			  $testimonials_cats = $aux_cats;
			  $args = array(
				'posts_per_page' => $number,
			  	'post_type' => 'testimonials',
			  	'tax_query' => array(
			        array(
			            'taxonomy' => 'testimonials_category',
			            'field'    => 'term_id',
			            'terms'    => $testimonials_cats
			        ),
			    )
		   	  );
		   	  $testimonials = get_posts($args);
		  }
	  
		  if ($style_testimonials === "style1"){
			  $output .= '<div id="testimonials-container-'.esc_attr($hazel_testimonials_index).'" class="container testimonials '.esc_attr($style_testimonials).'"><div class="testimonial-box">'; 
			  
			  $first = true;
			  $hazel_single_testimonial_index = 1;
			  $output .= '<ul class="testimonial-nav">';
			  foreach ($testimonials as $t){
				$output .= '<li><a href="#testimonial-'.esc_attr($hazel_single_testimonial_index).'" ';
				if ($first){
					$first = false;
					$output .= ' class="active" ';
				}
				$output .= '><img alt="'.esc_attr(get_the_title( $t->ID )).'" src="'; 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $t->ID ), 'single-post-thumbnail' );
				$output .= esc_url($image[0]);
				$output .= '" /><div class="cover-test-img"></div></a></li>';
				$hazel_single_testimonial_index++;
			  }

			  $output .= '</ul>';
			  
			  
			  
			  
			  $hazel_single_testimonial_index = 1;

			  $output .= '<div class="testimonials-content">';
			  foreach ($testimonials as $t){
				  	$active = ($hazel_single_testimonial_index == 1) ? " active" : "";
					$output .= '<div class="testimonial'.esc_attr($active).'" id="testimonial-'.esc_attr($hazel_single_testimonial_index).'">'.wp_kses_post($t->post_content);
					if ($hide_author === "no" && $hide_company === "no" || get_post_meta($t->ID,'author_value', true) != '' && get_post_meta($t->ID,'company_value', true) != '') { $output .= '<span class="t-author-style1">'; }
						if (get_post_meta($t->ID,'author_value', true) != ''){
							if (get_post_meta($t->ID,'author_link_value', true) != ''){ $output .= '<a href="'.esc_url(get_post_meta($t->ID,'author_link_value', true)).'">'; }
							$output .= esc_html(get_post_meta($t->ID,'author_value', true));
							if (get_post_meta($t->ID,'author_link_value', true) != ''){ $output .= '</a>'; }
						}
						if (get_post_meta($t->ID,'author_value', true) != '' && get_post_meta($t->ID,'company_value', true) != '') $output .= ' <br/> ';
						if (get_post_meta($t->ID,'company_value', true) != ''){
							if (get_post_meta($t->ID,'company_link_value', true) != ''){ $output .= '<a href="'.esc_url(get_post_meta($t->ID,'company_link_value', true)).'">'; }
							$output .= esc_html(get_post_meta($t->ID,'company_value', true));
							if (get_post_meta($t->ID,'company_link_value', true) != ''){ $output .= '</a>'; }
						}
					if ($hide_author === "no" && $hide_company === "no" || get_post_meta($t->ID,'author_value', true) != '' && get_post_meta($t->ID,'company_value', true) != '') { $output .= '</span>'; }
					$output .= '</div>';
				    $hazel_single_testimonial_index++;
			  }
			  $output .= '</div>'; // end of testimonials-content

			  $output .= '</div></div>'; //end of #testimonials
		  
			  $output .= "
			  <script type=\"text/javascript\">
			  jQuery(document).ready(function(){
					var who = jQuery('#testimonials-container-".esc_js($hazel_testimonials_index)."');
					who.find('.testimonials-content').height( who.find('.testimonials-content .testimonial.active > p').height() + who.find('.testimonials-content .testimonial.active > span').height() +40 );
					who.find('.testimonial-nav a').on('click', function(e){
						e.preventDefault();
					});
					who.find('.testimonial-nav a').on('mouseenter', function(){
						who.find('.testimonial-nav a').removeClass('active');
						jQuery(this).addClass('active');
						who.find('.testimonial.active').removeClass('active');
						who.find(jQuery(this).attr('href')).addClass('active');
						who.find('.testimonials-content').height( who.find('.testimonials-content .testimonial.active > p').height() + who.find('.testimonials-content .testimonial.active > span').height() +40 );
					});
			  });
			  </script>";		  
		  } else {
		  	wp_enqueue_script('ult-slick');
			wp_enqueue_script('ultimate-appear');
			wp_enqueue_script('ult-slick-custom');
			if ($style_testimonials == "style2"){
				$output .= '<div id="testimonials-slider-'.esc_attr($hazel_testimonials_index).'" class="testimonials-style2 style-'.esc_attr($des_testimonials_flex_nav_style).'"><ul class="slides styled-list"'; 
			} else {
				$output .= '<div id="testimonials-slider-'.esc_attr($hazel_testimonials_index).'" class="single-wide-testimonials testimonials-style2 style-'.esc_attr($des_testimonials_flex_nav_style).'"><ul class="slides styled-list"'; 
			}
			
			$output .= ' style="max-height:'.intval($des_testimonials_flex_height).'px;" ';
			$output .= '>';
					
			foreach ($testimonials as $t){
				$output .= '<li class="testimonials-slide"><div class="testimonials-slide-content container"><div class="testimonilas1bg">';
			
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $t->ID ), 'single-post-thumbnail' );
				if ($image[0] != ""){
					$output .= '<div class="img-container"><img title="'.esc_attr(get_post_meta($t->ID,'author_value', true)).'" src="'.esc_url($image[0]).'" alt="'.esc_attr(get_post_meta($t->ID,'author_value', true)).'">';
					
				
					$output .= '</div>';
				}
				
				$output .= '<div class="text-container">';
				
				$output .= '<span class="testimonials_text_content">';
				$output .= wp_kses_post($t->post_content);
				$output .= '</span>';
				$output .= '</div>';
				
				
				if ($hide_author === "no" && $hide_company === "no" || get_post_meta($t->ID,'author_value', true) != '' && get_post_meta($t->ID,'company_value', true) != '') { $output .= '<span class="t-author">'; }
				if (get_post_meta($t->ID,'author_value', true) != ''){
					if (get_post_meta($t->ID,'author_link_value', true) != ''){ $output .= '<a href="'.esc_url(get_post_meta($t->ID,'author_link_value', true)).'">'; }
					$output .= esc_html(get_post_meta($t->ID,'author_value', true));
					if (get_post_meta($t->ID,'author_link_value', true) != ''){ $output .= '</a>'; }
				}
				if (get_post_meta($t->ID,'author_value', true) != '' && get_post_meta($t->ID,'company_value', true) != '') $output .= '';
				if (get_post_meta($t->ID,'company_value', true) != ''){
					if (get_post_meta($t->ID,'company_link_value', true) != ''){ $output .= '<a href="'.esc_url(get_post_meta($t->ID,'company_link_value', true)).'">'; }
					$output .= esc_html(get_post_meta($t->ID,'company_value', true));
					if (get_post_meta($t->ID,'company_link_value', true) != ''){ $output .= '</a>'; }
				}
				if ($hide_author === "no" && $hide_company === "no" || get_post_meta($t->ID,'author_value', true) != '' && get_post_meta($t->ID,'company_value', true) != '') { $output .= '</span>'; }
				
				$output .= '</div></div></li>';
			}
			$output .= '</ul></div>';
			
			
			if ($style_testimonials == "style3"){
				$des_testimonials_flex_items_desktop = $des_testimonials_flex_items_small_desktop = $des_testimonials_flex_items_tablet = $des_testimonials_flex_items_mobile = 1;
			}
			
					
			$output .= "
			<script type=\"text/javascript\">
				jQuery(document).ready(function(){
					
					if (window.self===window.top){
						if (jQuery('body').is('.wp-admin.compose-mode')){
							return;
						}
					}
					
					var who = jQuery('#testimonials-slider-".esc_js($hazel_testimonials_index)." ul.slides');
				
					var opts = ['".esc_js($des_testimonials_flex_animation)."','".esc_js($des_testimonials_flex_direction)."','".esc_js($des_testimonials_flex_slideshow)."','".esc_js($des_testimonials_flex_slideshow_speed)."','".esc_js($des_testimonials_flex_animation_duration)."','".esc_js($des_testimonials_flex_direction_nav)."','".esc_js($des_testimonials_flex_control_nav)."','".esc_js($des_testimonials_flex_pause_on_hover)."','".esc_js($des_testimonials_flex_nav_style)."','".esc_js($des_testimonials_flex_items_desktop)."','".esc_js($des_testimonials_flex_items_small_desktop)."','".esc_js($des_testimonials_flex_items_tablet)."','".esc_js($des_testimonials_flex_items_mobile)."'];
					if (opts[2] == 'yes') opts[2] = true; else opts[2] = false;
					if (opts[5] == 'yes') {
						opts[5] = true;
					} else opts[5] = false;
					if (opts[6] == 'yes') {
						opts[6] = true;
					} else opts[6] = false;
					if (opts[7] == 'yes') opts[7] = true; else opts[7] = false;
					if (opts[0] == 'fade') opts[0] = true; else opts[0] = false;
				
					who.slick({
						fade: opts[0],
						dots: opts[6], 
						autoplay: opts[2], 
						autoplaySpeed:opts[3], speed:opts[4], infinite: true,
						arrows: opts[5],
						adaptiveHeight:true,
						nextArrow:'<button type=\"button\" class=\"slick-next default\"><i class=\"ultsl-arrow-right6\"></i></button>',
						prevArrow:'<button type=\"button\" class=\"slick-prev default\"><i class=\"ultsl-arrow-left6\"></i></button>',
						swipe:true,
						draggable:true,
						touchMove:true,
						slidesToScroll: parseInt(opts[9],10),
						slidesToShow: parseInt(opts[9],10),
						responsive:[{
							breakpoint: 1024,
							settings:{
								slidesToShow: parseInt(opts[10],10),
								slidesToScroll: parseInt(opts[10],10)
							}
						},{
							breakpoint: 768,
							settings:{
								slidesToShow: parseInt(opts[11],10),
								slidesToScroll: parseInt(opts[11],10)
							}
						},{
							breakpoint: 480,
							settings:{
								slidesToShow: parseInt(opts[12],10),
								slidesToScroll: parseInt(opts[12],10)
							}
						}],
						pauseOnHover:opts[7],
						pauseOnDotsHover:opts[7],
						customPaging:function(slider,i){
							return'<i type=\"button\" class=\"ultsl-record\" data-role=\"none\"></i>';
						}
					});
				});
			</script>";
		  }
	
	      wp_reset_postdata();

		  $hazel_testimonials_index++;
	      return $output;
		}

	} 
}

if (!function_exists('hazel_vc_before_init')){
	function hazel_vc_before_init(){

		if (function_exists('vc_add_shortcode_param')){
			vc_add_shortcode_param('testimonials_cats', 'hazel_testimonials_categories_settings_field');
			vc_add_shortcode_param('hazel_fa', 'hazel_fa_settings_field');	
		}
		if (function_exists('vc_remove_element')){
			vc_remove_element('vc_carousel');
			vc_remove_element('vc_posts_slider');
			vc_remove_element('vc_gallery');
			vc_remove_element('vc_images_carousel');
			vc_remove_element('vc_button');
			vc_remove_element('vc_cta_button');
		}

			
		if (class_exists('WPBakeryVisualComposerAbstract')){
			if (!function_exists('treethemes_vc_library_cat_list')){
				function treethemes_vc_library_cat_list() {
					return array( __('All','hazel') => 'all', 
						__('About','hazel') => 'about', 
						__('FAQ','hazel') => 'faq',
						__('Counters','hazel') => 'counters',  
						__('Contact & Maps','hazel') => 'contactforms', 						
						__('General','hazel') => 'general',  
						__('Portfolio','hazel') => 'portfolio',
						__('Pricing','hazel') => 'pricing',
						__('Services','hazel') => 'services',
						__('Testimonials','hazel') => 'testimonials');
				}
			}
		
			if(!function_exists('add_treethemes_vc_modules_to_vc')) {
				function add_treethemes_vc_modules_to_vc() {
					if (is_admin()) { 
						require_once ('lib/treethemes-vc-modules/treethemes-vc-modules-templates.php');
						wp_enqueue_style( 'treethemes-vc-modules', plugins_url('lib/treethemes-vc-modules/treethemes-vc-modules.css', __FILE__), 'all' );
					}
				}
			}
		
			add_treethemes_vc_modules_to_vc();
		}
		
		
	}
}


add_action('vc_before_init', 'hazel_vc_before_init');

if (!function_exists('hazel_add_increase_time')){
	function hazel_add_increase_time(){
		@ini_set( 'max_execution_time', '300' );
	}
}

add_filter('widget_text', 'do_shortcode');

?>