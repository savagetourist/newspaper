<?php
/*
Template Name: Blank Template (No header nor footer)
*/
get_header(); //the_post();
$theid = (isset($hazel_uc_id)) ? $hazel_uc_id : get_the_ID();
$post = get_post($theid);
if (class_exists('Ultimate_VC_Addons')) {
	if(stripos($post->post_content, 'font_call:')){
		preg_match_all('/font_call:(.*?)"/',$post->post_content, $display);
		enquque_ultimate_google_fonts_optimzed($display[1]);
	}
	hazel_google_fonts_scripts();
}
?>
<div class="page-template page-template-template-blank page-template-template-blank-php <?php echo esc_attr("the-id-is-$theid"); ?>">
	<div class="fullwindow_content container">
		<div class="tb-row">
			<div class="tb-cell">
				<?php 
					if (function_exists('wpb_js_remove_wpautop') == true)
						echo wpb_js_remove_wpautop($post->post_content);
					else echo wp_kses_post($post->post_content); 
					/* custom element css */
					$shortcodes_custom_css = get_post_meta( $theid, '_wpb_shortcodes_custom_css', true );
					if ( ! empty( $shortcodes_custom_css ) ) {
						hazel_set_custom_inline_css($shortcodes_custom_css);
					}
				?>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
<div id="templatepath" class="hazel_helper_div"><?php  echo get_template_directory_uri()."/"; ?></div>
<div id="homeURL" class="hazel_helper_div"><?php echo esc_url(home_url('/')); ?>/</div>
<div id="styleColor" class="hazel_helper_div"><?php $hazel_styleColor = "#".get_option("hazel"."_style_color"); echo esc_html($hazel_styleColor);?></div>	
<div id="headerStyleType" class="hazel_helper_div"><?php $hazel_headerStyleType = get_option("hazel"."_header_style_type"); echo esc_html($hazel_headerStyleType); ?></div>
<div class="hazel_helper_div" id="reading_option"><?php 
	$hazel_reading_option = get_option('hazel_blog_reading_type');
	if ($hazel_reading_option == "scrollauto"){
		$detect = new hazel_Mobile_Detect();
		if ($detect->isMobile())
			$hazel_reading_option = "scroll";
	}
	echo esc_html($hazel_reading_option); 
?></div>
<?php
	$hazel_color_code = get_option("hazel_style_color");
?>
<div class="hazel_helper_div" id="hazel_no_more_posts_text"><?php
	if (function_exists('icl_t')){
		printf(esc_html__("%s", "hazel"), icl_t( 'hazel', 'No more posts to load.', get_option('hazel_no_more_posts_text')));
	} else {
		printf(esc_html__("%s", "hazel"), get_option('hazel_no_more_posts_text'));
	}
?></div>
<div class="hazel_helper_div" id="hazel_load_more_posts_text"><?php
	if (function_exists('icl_t')){
		printf(esc_html__("%s", "hazel"), icl_t( 'hazel', 'Load More Posts', get_option('hazel_load_more_posts_text')));
	} else {
		printf(esc_html__("%s", "hazel"), get_option('hazel_load_more_posts_text'));
	}
?></div>
<div class="hazel_helper_div" id="hazel_loading_posts_text"><?php
	if (function_exists('icl_t')){
		printf(esc_html__("%s", "hazel"), icl_t( 'hazel', 'Loading posts.', get_option('hazel_loading_posts_text')));
	} else {
		printf(esc_html__("%s", "hazel"), get_option('hazel_loading_posts_text'));
	}
?></div>
<div class="hazel_helper_div" id="hazel_links_color_hover"><?php echo str_replace("__USE_THEME_MAIN_COLOR__", $hazel_color_code, get_option("hazel_links_color_hover")); ?></div>
<div class="hazel_helper_div" id="hazel_enable_images_magnifier"><?php echo get_option('hazel_enable_images_magnifier'); ?></div>
<div class="hazel_helper_div" id="hazel_thumbnails_hover_option"><?php echo get_option('hazel_thumbnails_hover_option'); ?></div>
<div class="hazel_helper_div" id="hazel_menu_color">#<?php echo get_option("hazel"."_menu_color"); ?></div>
<div class="hazel_helper_div" id="hazel_fixed_menu"><?php echo get_option("hazel"."_fixed_menu"); ?></div>
<div class="hazel_helper_div" id="hazel_thumbnails_effect"><?php if (get_option("hazel"."_animate_thumbnails") == "on") echo get_option("hazel_thumbnails_effect"); else echo "none"; ?></div>
<div class="hazel_helper_div" id="permalink_structure"><?php echo get_option('permalink_structure'); ?></div>
<div class="hazel_helper_div" id="headerstyle3_menucolor">#<?php echo get_option("hazel"."_menu_color"); ?></div>
<div class="hazel_helper_div" id="disable_responsive_layout"><?php echo get_option('hazel_disable_responsive'); ?></div>
<div class="hazel_helper_div" id="filters-dropdown-sort"><?php esc_html_e('Sort Gallery','hazel'); ?></div>
<div class="hazel_helper_div" id="searcheverything"><?php echo get_option("hazel"."_enable_search_everything"); ?></div>
<div class="hazel_helper_div" id="hazel_header_shrink"><?php if (get_option('hazel_fixed_menu') == 'on'){if (get_option('hazel_header_after_scroll') == 'on'){if (get_option('hazel_header_shrink_effect') == 'on'){echo "yes";} else echo "no";}} ?></div>
<div class="hazel_helper_div" id="hazel_header_after_scroll"><?php if (get_option('hazel_fixed_menu') == 'on'){if (get_option('hazel_header_after_scroll') == 'on'){echo "yes";} else echo "no";} ?></div>
<div class="hazel_helper_div" id="hazel_grayscale_effect"><?php echo get_option("hazel"."_enable_grayscale"); ?></div>
<div class="hazel_helper_div" id="hazel_enable_ajax_search"><?php echo get_option("hazel"."_enable_ajax_search"); ?></div>
<div class="hazel_helper_div" id="hazel_menu_add_border"><?php echo get_option("hazel"."_menu_add_border"); ?></div>
</div>