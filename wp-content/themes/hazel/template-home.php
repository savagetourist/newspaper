<?php
/*
Template Name: Homepage Template
*/

get_header(); hazel_print_menu(false);

	$this_page_id = get_the_ID();

	$thepost = get_post($this_page_id);
	?>
	<section id="home"></section>
	<section class="page_content section_page-<?php echo esc_attr($this_page_id); ?> content_from_homepage_template" id="section_page-<?php echo esc_attr($this_page_id); ?>" data-section-title="<?php echo esc_attr($thepost->post_title); ?>">
		<div class="container">
		<?php
			if (class_exists('Ultimate_VC_Addons')) {
			if (function_exists('vc_is_inline') && vc_is_inline()){
				wp_reset_query();
				the_content();
			} else {
				$content_post = get_post($this_page_id);
				if(stripos($content_post->post_content, 'font_call:')){
					preg_match_all('/font_call:(.*?)"/',$content_post->post_content, $display);
					enquque_ultimate_google_fonts_optimzed($display[1]);
				}
				
				$content = $content_post->post_content;
				$tw_theme_main_color = "#".get_option('hazel_style_color');
				$content = str_replace( '__USE_THEME_MAIN_COLOR__', $tw_theme_main_color, $content );
				hazel_content_shortcoder($content);
				$content = apply_filters('the_content', $content);
				if (function_exists('wpb_js_remove_wpautop') == true)
					echo wpb_js_remove_wpautop($content);
				else echo wp_kses_post($content); 
				
				$shortcodes_custom_css = get_post_meta( $this_page_id, '_wpb_shortcodes_custom_css', true );
				if ( ! empty( $shortcodes_custom_css ) ) {
					hazel_set_custom_inline_css($shortcodes_custom_css);
				}
				$post_custom_css = get_post_meta( $this_page_id, '_wpb_post_custom_css', true );
				if ( ! empty( $post_custom_css ) ) {
					$post_custom_css = strip_tags( $post_custom_css );
					hazel_set_custom_inline_css($post_custom_css);
				}
			}
			}
		?>
		</div>
	</section>
	<?php
		
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
	
	if (!empty($theMenu)){
		$args = array(
	        'order'                  => 'ASC',
	        'orderby'                => 'menu_order',
	        'post_type'              => 'nav_menu_item',
	        'post_status'            => 'publish',
	        'output'                 => ARRAY_A,
	        'output_key'             => 'menu_order',
	        'nopaging'               => true,
	        'update_post_term_cache' => false 
	    );
		$items = wp_get_nav_menu_items( $theMenu->slug, $args );
		
		$outsiders = array();
		//$firstHome = true;
		foreach ($items as $i){
			$thisID = $i->object_id;
			$template = get_post_meta($thisID, '_wp_page_template', true);
			
			if ($this_page_id != $thisID){
				if ($template === "one-page-template.php"){
					$thepost = get_post($thisID);
					?>
					<section class="page_content section_page-<?php echo esc_attr($thisID); ?>" id="section_page-<?php echo esc_attr($thisID); ?>" data-section-title="<?php echo esc_attr($thepost->post_title); ?>">
						<div class="container">
						<?php
							$content = $thepost->post_content;
							if (class_exists('Ultimate_VC_Addons')) {
							if(stripos($content, 'font_call:')){
								preg_match_all('/font_call:(.*?)"/',$content, $display);
								enquque_ultimate_google_fonts_optimzed($display[1]);
							}
							}
							$tw_theme_main_color = "#".get_option('hazel_style_color');
							$content = str_replace( '__USE_THEME_MAIN_COLOR__', $tw_theme_main_color, $content );
							hazel_content_shortcoder($content);
							$content = apply_filters('the_content', $content);
							if (function_exists('wpb_js_remove_wpautop') == true)
								echo wpb_js_remove_wpautop($content);
							else echo wp_kses_post($content); 
							
							/* custom element css */
							$shortcodes_custom_css = get_post_meta( $thisID, '_wpb_shortcodes_custom_css', true );
							if ( ! empty( $shortcodes_custom_css ) ) {
								hazel_set_custom_inline_css($shortcodes_custom_css);
							}
							$post_custom_css = get_post_meta( $thisID, '_wpb_post_custom_css', true );
							if ( ! empty( $post_custom_css ) ) {
								$post_custom_css = strip_tags( $post_custom_css );
								hazel_set_custom_inline_css($post_custom_css);
							}
						?>
						</div>
					</section>
					<?php
				} else {
					array_push($outsiders, $thisID);
				}	
			}
			
		}
	}
		
	?>
	
		    		
<?php get_footer(); ?>