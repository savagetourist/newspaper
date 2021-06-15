<?php
/**
 * @package WordPress
 * @subpackage Hazel
 */
	get_header();
	
		$hazel_reading_option = get_option("hazel_blog_reading_type");
		$hazel_more = 0; 
	
		$menuLocations = get_nav_menu_locations();
		
		$menuID = 0;
		if (isset($menuLocations['PrimaryNavigation'])){
			$menuID = $menuLocations['PrimaryNavigation'];
		}
		/*New wpml fix menu*/
		if (function_exists('icl_object_id')){
			global $sitepress;
			$current_lang = $sitepress->get_current_language();
			$default_lang = $sitepress->get_default_language();
			if ($current_lang!=$default_lang){
				$table_name = $wpdb->base_prefix."icl_translations";
				$q = "SELECT trid FROM {$table_name} WHERE element_type LIKE 'tax_nav_menu' AND element_id=%d";
				$res = $wpdb->get_results($wpdb->prepare($q, $menuID), OBJECT);
				if (!empty($res)){			
					$trid = (int) $res[0]->trid;
					$q = "SELECT element_id FROM {$table_name} WHERE language_code LIKE '".$current_lang."' AND trid=%d";
					$res = $wpdb->get_results($wpdb->prepare($q, $trid), OBJECT);
					if (!empty($res)) $menuID = (int) $res[0]->element_id;
				}
			}
		}
		/**/
		$theMenus = wp_get_nav_menus($menuID);
		$theMenu = array();
		
		for ($idx = 0; $idx < count($theMenus); $idx++){
			if ($theMenus[$idx]->term_id == $menuID){
				$theMenu = $theMenus[$idx];
			}
		}
		
		wp_enqueue_style('js_composer_front');
		define('HAZEL_IS_FIRST_PAGE', true);
		get_template_part('blog-template');
	
?>

<div class="clear"></div>
	
	
<?php get_footer(); ?>