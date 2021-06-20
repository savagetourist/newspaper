<?php
/**
 * Template Name: Multi Page Template
 * @package WordPress
 * @subpackage Hazel
**/

get_header(); hazel_print_menu();

	$hazel_thisPostID = get_the_ID(); $hazel_color_code = get_option("hazel_style_color");

	if (get_post_meta($hazel_thisPostID, "hazel_enable_custom_pagetitle_options_value", true) == "no" || !get_post_meta($hazel_thisPostID, "hazel_enable_custom_pagetitle_options_value", true)){
		$type = get_option("hazel_header_type");
		$thecolor = hazel_hex2rgb(str_replace("__USE_THEME_MAIN_COLOR__", $hazel_color_code, get_option("hazel_header_color"))); 
		$opacity = intval(str_replace("%","",get_option("hazel_header_opacity")))/100;
		$color = "rgba(".$thecolor[0].",".$thecolor[1].",".$thecolor[2].",".$opacity.")";
		$image = get_option("hazel_header_image"); 
		$pattern = HAZEL_PATTERNS_URL.get_option("hazel_header_pattern"); 
		$custompattern = get_option("hazel_header_custom_pattern"); 
		$margintop = get_option("hazel_header_text_margin_top");	
		$banner = get_option("hazel_banner_slider");
		$showtitle = get_option("hazel_hide_pagetitle") == "on" ? true : false;
		$showsectitle = get_option("hazel_hide_sec_pagetitle") == "on" ? true : false;
		$tcolor = get_option("hazel".'_header_text_color');
		$tsize = intval(str_replace(" ", "", get_option("hazel".'_header_text_size')),10)."px";
		$tfont = get_option("hazel".'_header_text_font');
		$stcolor = get_option("hazel".'_secondary_title_text_color');
		$stsize = intval(str_replace(" ", "", get_option("hazel".'_secondary_title_text_size')),10)."px";
		$stfont = get_option("hazel".'_secondary_title_font');
		$stmargin = intval(str_replace(" ", "", get_option("hazel".'_header_sec_text_margin_top')),10)."px";
		$originalalign = get_option("hazel_header_text_alignment");
		$pt_parallax = get_option("hazel_pagetitle_image_parallax") == "on" ? true : false;
		$pt_overlay = get_option("hazel_pagetitle_image_overlay") == "on" ? true : false;
		$pt_overlay_type = get_option("hazel_pagetitle_overlay_type");
		$pt_overlay_the_color = hazel_hex2rgb(str_replace("__USE_THEME_MAIN_COLOR__", $hazel_color_code, get_option("hazel_pagetitle_overlay_color")));
		$pt_overlay_pattern = (is_string(get_option("hazel_pagetitle_overlay_pattern"))) ? HAZEL_PATTERNS_URL.get_option("hazel_pagetitle_overlay_pattern") : "";
		$pt_overlay_opacity = intval(str_replace("%","",get_option("hazel_pagetitle_overlay_opacity")))/100;
		$pt_overlay_color = "rgba(".$pt_overlay_the_color[0].",".$pt_overlay_the_color[1].",".$pt_overlay_the_color[2].",".$pt_overlay_opacity.")";
		$breadcrumbs = get_option("hazel_breadcrumbs");
		$breadcrumbs_margintop = get_option('hazel_breadcrumbs_text_margin_top');
		$pagetitlepadding = get_option('hazel_page_title_padding');
	} else {
		$type = get_post_meta($hazel_thisPostID, "hazel_header_type_value", true);
		$thecolor = hazel_hex2rgb(get_post_meta($hazel_thisPostID, "hazel_header_color_value", true)); 
		$opacity = intval(str_replace("%","",get_post_meta($hazel_thisPostID, "hazel_header_color_opacity_value", true)))/100;
		$color = "rgba(".$thecolor[0].",".$thecolor[1].",".$thecolor[2].",".$opacity.")";
		$image = get_post_meta($hazel_thisPostID, "hazel_header_image_value", true);
		$image = explode('|!|',$image);
		if (isset($image[1])) $image = explode('|*|',$image[1]);
		$image = $image[0];
		$pattern = HAZEL_PATTERNS_URL.get_post_meta($hazel_thisPostID, "hazel_header_pattern_value", true).".jpg";
		$custompattern = get_option("hazel_header_custom_pattern_value"); 
		$margintop = get_post_meta($hazel_thisPostID, "hazel_header_text_margin_top_value", true);
		$banner = get_post_meta($hazel_thisPostID, "hazel_banner_slider_value", true);
		$showtitle = get_post_meta($hazel_thisPostID, "hazel_hide_pagetitle_value", true) == "yes" ? true : false;
		$showsectitle = get_post_meta($hazel_thisPostID, "hazel_hide_sec_pagetitle_value", true) == "yes" ? true : false;
		$tcolor = get_post_meta($hazel_thisPostID, "hazel_header_text_color_value", true);
		$tsize = intval(str_replace(" ", "", get_post_meta($hazel_thisPostID, "hazel_header_text_size_value", true)),10)."px";
		$tfont = get_post_meta($hazel_thisPostID, "hazel_header_text_font_value", true);
		$stcolor = get_post_meta($hazel_thisPostID, "hazel_secondary_title_text_color_value", true);
		$stsize = intval(str_replace(" ", "", get_post_meta($hazel_thisPostID, "hazel_secondary_title_text_size_value", true)),10)."px";
		$stfont = get_post_meta($hazel_thisPostID, "hazel_secondary_title_font_value", true);
		$stmargin = intval(str_replace(" ", "", get_post_meta($hazel_thisPostID, "hazel_header_secondary_text_margin_top_value", true)),10)."px";
		$originalalign = get_post_meta($hazel_thisPostID, "hazel_header_text_alignment_value", true);
		$pt_parallax = get_post_meta($hazel_thisPostID, "hazel_pagetitle_image_parallax_value", true) == "on" ? true : false;
		$pt_overlay = get_post_meta($hazel_thisPostID, "hazel_pagetitle_image_overlay_value", true) == "on" ? true : false;
		$pt_overlay_type = get_post_meta($hazel_thisPostID, "hazel_pagetitle_overlay_type_value", true);
		$pt_overlay_the_color = hazel_hex2rgb(get_post_meta($hazel_thisPostID, "hazel_pagetitle_overlay_color_value", true));
		$pt_overlay_pattern = HAZEL_PATTERNS_URL.get_post_meta($hazel_thisPostID, "hazel_pagetitle_overlay_pattern_value", true).".jpg";
		$pt_overlay_opacity = intval(str_replace("%","",get_post_meta($hazel_thisPostID, "hazel_pagetitle_overlay_opacity_value", true)))/100;
		$pt_overlay_color = "rgba(".$pt_overlay_the_color[0].",".$pt_overlay_the_color[1].",".$pt_overlay_the_color[2].",".$pt_overlay_opacity.")";
		$breadcrumbs = get_post_meta($hazel_thisPostID, "hazel_enable_breadcrumbs_value", true) == "yes" ? "on" : "off";
		$breadcrumbs_margintop = intval(str_replace(" ", "", get_post_meta($hazel_thisPostID, "hazel_breadcrumbs_margin_top_value", true)),10)."px";
		$pagetitlepadding = intval(str_replace(" ", "", get_post_meta($hazel_thisPostID, "hazel_page_title_padding_value", true)),10)."px";
	}
	$height = "auto";

	$textalign = $originalalign;
	if ($originalalign == "titlesleftcrumbsright") $textalign = "left";
	if ($originalalign == "titlesrightcrumbsleft") $textalign = "right";

	$hazel_import_fonts[] = $tfont;
	$principalfont = explode("|",$tfont);
	$principalfont[0] = $principalfont[0]."', 'Arial', 'sans-serif";
	if (!isset($principalfont[1])) $principalfont[1] = "";
		
	$hazel_import_fonts[] = $stfont;
	$secondaryfont = explode("|",$stfont);
	$secondaryfont[0] = $secondaryfont[0]."', 'Arial', 'sans-serif";
	if (!isset($secondaryfont[1])) $secondaryfont[1] = "";
		
	if ($type != "without"){
		
		$ptitleaux = $bcaux = "";
		if ($originalalign == "titlesleftcrumbsright" || $originalalign == "titlesrightcrumbsleft"){
    		$ptitleaux .= "max-width: 50%;";
    		$bcaux .= "max-width: 50%;";
    		if ($originalalign == "titlesleftcrumbsright"){
				$ptitleaux .= "float:left;";
				$bcaux .= "float:right;";
			} else {
				$ptitleaux .= "float:right;";
				$bcaux .= "float:left;";
			}
		}
		$bcaux .= "margin-top:".intval($breadcrumbs_margintop,10)."px;";
		switch($originalalign){
			case "left": case "titlesrightcrumbsleft":
				$bcaux .= "text-align: left;";
			break;
			case "right": case "titlesleftcrumbsright":
				$bcaux .= "text-align:right;";
			break;
			case "center": 
				$bcaux .= "text-align:center;";
			break;
		}
		
		?>
		<div class="fullwidth-container <?php if ($type == "pattern") echo "bg-pattern"; ?> <?php if ($pt_parallax) echo "parallax"; ?>" <?php if ($pt_parallax) echo 'data-stellar-ratio="0.5"'; ?> style="
	    	<?php 
		 		if ($height != "") echo "height: ". esc_html($height) . ";";
				if ($type == "none") echo "background: none;"; 
				if ($type == "color") echo "background: " . esc_html($color) . ";";
				if ($type == "image") echo "background: url(" . esc_url($image) . ") no-repeat; background-size: 100% auto;";  
	 			if ($type == "pattern") echo "background: url('" . esc_url($pattern) . "') 0 0 repeat;";
	    	?>">
	    	<?php
		    	if ($type == "image" && $pt_overlay){
			    	echo '<div class="pagetitle_overlay" style="'; 
			    	if ($pt_overlay_type == "color") echo 'background-color:'.esc_html($pt_overlay_color);
			    	else echo 'background:url('.esc_url($pt_overlay_pattern).') repeat;opacity:'.esc_html($pt_overlay_opacity).';';
			    	echo '"></div>';
		    	}
		    	if ($type === "banner"){
			    	?> 
			    	<div class="revBanner">
				    	<?php
					    	if (strpos($banner, 'revSlider_') !== false) {
								if (!function_exists('putRevSlider')){
									echo 'Please install the missing plugin - RevolutionSlider.';
								} else putRevSlider(substr($banner, 10));
							} else {
								if (strpos($banner, 'masterSlider_') !== false) {
									if (!function_exists('masterslider')){
										echo 'Please install the missing plugin - MasterSlider.';
									} else echo do_shortcode( '[masterslider alias="'.substr($banner, 13).'"]' );
								}
							}
				    	?>
				    </div> 
				    <?php
		    	} else {
		    	?>
				<div class="container <?php echo esc_attr($originalalign); ?>" style="padding:<?php echo esc_attr($pagetitlepadding); ?> 15px;">
					<div class="pageTitle" style="<?php echo esc_attr("text-align:".$textalign.";") . esc_attr($ptitleaux); ?>">
					<?php
						if ($showtitle){
							?>
							<h1 class="page_title" style="<?php echo esc_attr("color: #$tcolor; font-size: $tsize; font-family: '{$principalfont[0]}', sans-serif;font-weight: {$principalfont[1]};");?><?php if ($margintop != "") echo esc_attr("margin-top: ".intval($margintop,10)."px;"); ?>">
								<?php echo wp_kses_post(get_the_title($hazel_thisPostID)); ?>
							</h1>
							<?php
						}
		    			if ($showsectitle){
			    			if (is_string(get_post_meta($hazel_thisPostID, 'secondaryTitle_value', true)) && get_post_meta($hazel_thisPostID, 'secondaryTitle_value', true) != ""){
						    	?>
							    <h2 class="secondaryTitle" style="<?php echo esc_attr("color: #$stcolor; font-size: $stsize; line-height: $stsize; font-family: '{$secondaryfont[0]}';font-weight:{$secondaryfont[1]}; margin-top:{$stmargin};");?>">
							    	<?php echo wp_kses_post(get_post_meta($hazel_thisPostID, 'secondaryTitle_value', true)); ?>
							    </h2>
					    		<?php
					    	}
		    			}
		    		?>
		    		</div>
		    		<?php
		    		if ($breadcrumbs == "on"){
			    		?>
			    		<div class="hazel_breadcrumbs" style="<?php echo esc_attr($bcaux); ?>">
							<?php hazel_the_breadcrumb(); ?>
			    		</div>
			    		<?php
					}
					?>
				</div>
		<?php }
		?>
		</div>	
		<?php
	}
	
	$sidebar = get_post_meta($post->ID, 'sidebars_available_value', true);
	switch (get_post_meta($post->ID, 'sidebar_for_default_value', true)){
		case "none":
			?>
			<div class="master_container" style="width: 100%;float: left;background-color: white;">
				<section class="page_content" id="section-<?php echo esc_attr(get_the_ID()); ?>">
					<div class="container">
						<?php
							if ((function_exists('vc_is_inline') && vc_is_inline()) || is_preview()){
								wp_reset_postdata();
								the_content();
							} else {
								if (post_password_required()) echo get_the_password_form();
								else {
									$content_post = get_post($hazel_thisPostID);
									$content = $content_post->post_content;
									
									if (strpos($content, '<!--nextpage-->') != false){
										//paged content
										$content_paged = 1;
										if (isset($wp_query) && $wp_query->query_vars['page'] > 0) $content_paged = $wp_query->query_vars['page'];
										$content_paged_index = $content_paged-1;
										$content = explode('<!--nextpage-->', $content);
										if (isset($content[$content_paged_index])) $content = $content[$content_paged_index];
										else $content = $content[0];
									}
									
									$tw_theme_main_color = "#".get_option('hazel_style_color');
									$content = str_replace( '__USE_THEME_MAIN_COLOR__', $tw_theme_main_color, $content );
									hazel_content_shortcoder($content);
									$content = apply_filters('the_content', $content);
									if (function_exists('wpb_js_remove_wpautop') == true)
										echo wpb_js_remove_wpautop($content);
									else echo wp_kses_post($content); 
									$shortcodes_custom_css = get_post_meta( $hazel_thisPostID, '_wpb_shortcodes_custom_css', true );
									if ( isset($shortcodes_custom_css) && ! empty( $shortcodes_custom_css ) ) {
										hazel_set_custom_inline_css($shortcodes_custom_css);
									}
									wp_reset_postdata();
									if (comments_open()){
										?>
										<div class="the_comments">
										    <?php comments_template( '', true ); ?>
									    </div>
										<?php
									}
								}
							}
							$args = array(
							'before'           => '<div class="navigation" style="margin-top: 0px;"><div class="des-pages"><span class="pages current">' . esc_html__('Pages:', 'hazel') . '</span>',
							'after'            => '</div></div>',
							'link_before'      => '<div class="postpagelinks">',
							'link_after'       => '</div>',
							'next_or_number'   => 'number',
							'nextpagelink'     => esc_html__('Next page','hazel'),
							'previouspagelink' => esc_html__('Previous page','hazel'),
							'pagelink'         => '%',
							'echo'             => 1
						); 
			    		wp_link_pages($args);	
						?>
					</div>
				</section>
			</div>
			<?php
		break;
		case "left":
			?>
			<div class="master_container" style="width: 100%;float: left;background-color: white;">
				<div class="container">
					<?php
						if (!post_password_required()){
							?>
							<section class="page_content left sidebar col-xs-12 col-md-3">
							<?php 
								if ( function_exists('dynamic_sidebar')) { 
									if ($sidebar == 'defaultblogsidebar'){
										get_sidebar();
									} else {
										ob_start();
									    do_shortcode(dynamic_sidebar($sidebar));
									    $html = ob_get_contents();
									    ob_end_clean();
										$html = wp_kses_no_null( $html, array( 'slash_zero' => 'keep' ) );
										$html = wp_kses_normalize_entities($html);
										echo wp_kses_hook($html, 'post', array());
									}
								} else {
									get_sidebar();
								}
								wp_reset_postdata();
							?>
						</section>
							<?php
						}
					?>
					<section class="page_content right col-xs-12 col-md-9" id="section-<?php echo esc_attr(get_the_ID()); ?>" <?php if (post_password_required()) echo ' style="border:none !important;" '; ?>>
						<?php
							if ((function_exists('vc_is_inline') && vc_is_inline()) || is_preview()){
								wp_reset_postdata();
								the_content();
							} else {
								if (post_password_required()) echo get_the_password_form();
								else {
									$content_post = get_post($hazel_thisPostID);
									$content = $content_post->post_content;
									
									if (strpos($content, '<!--nextpage-->') != false){
										//paged content
										$content_paged = 1;
										if (isset($wp_query) && $wp_query->query_vars['page'] > 0) $content_paged = $wp_query->query_vars['page'];
										$content_paged_index = $content_paged-1;
										$content = explode('<!--nextpage-->', $content);
										if (isset($content[$content_paged_index])) $content = $content[$content_paged_index];
										else $content = $content[0];
									}
									
									$tw_theme_main_color = "#".get_option('hazel_style_color');
									$content = str_replace( '__USE_THEME_MAIN_COLOR__', $tw_theme_main_color, $content );
									hazel_content_shortcoder($content);
									$content = apply_filters('the_content', $content);
									if (function_exists('wpb_js_remove_wpautop') == true)
										echo wpb_js_remove_wpautop($content);
									else echo wp_kses_post($content); 
									$shortcodes_custom_css = get_post_meta( $hazel_thisPostID, '_wpb_shortcodes_custom_css', true );
									if ( isset($shortcodes_custom_css) && ! empty( $shortcodes_custom_css ) ) {
										hazel_set_custom_inline_css($shortcodes_custom_css);
									}
									wp_reset_postdata();
									if (comments_open()){
										?>
										<div class="the_comments">
										    <?php comments_template( '', true ); ?>
									    </div>
										<?php
									}
								}
							}
							$args = array(
							'before'           => '<div class="navigation" style="margin-top: 0px;"><div class="des-pages"><span class="pages current">' . esc_html__('Pages:', 'hazel') . '</span>',
							'after'            => '</div></div>',
							'link_before'      => '<div class="postpagelinks">',
							'link_after'       => '</div>',
							'next_or_number'   => 'number',
							'nextpagelink'     => esc_html__('Next page','hazel'),
							'previouspagelink' => esc_html__('Previous page','hazel'),
							'pagelink'         => '%',
							'echo'             => 1
						); 
			    		wp_link_pages($args);
						?>
					</section>
				</div>
			</div>
			<?php
		break;
		case "right":
			?>
			<div class="master_container" style="width: 100%;float: left;background-color: white;">
				<div class="container">
					<section class="page_content left col-xs-12 col-md-9" id="section-<?php echo esc_attr(get_the_ID()); ?>" <?php if (post_password_required()) echo ' style="border:none !important;" '; ?>>
						<?php
							if ((function_exists('vc_is_inline') && vc_is_inline()) || is_preview()){
								wp_reset_postdata();
								the_content();
							} else {
								if (post_password_required()) echo get_the_password_form();
								else {
									$content_post = get_post($hazel_thisPostID);
									$content = $content_post->post_content;
									
									if (strpos($content, '<!--nextpage-->') != false){
										//paged content
										$content_paged = 1;
										if (isset($wp_query) && $wp_query->query_vars['page'] > 0) $content_paged = $wp_query->query_vars['page'];
										$content_paged_index = $content_paged-1;
										$content = explode('<!--nextpage-->', $content);
										if (isset($content[$content_paged_index])) $content = $content[$content_paged_index];
										else $content = $content[0];
									}
									
									$tw_theme_main_color = "#".get_option('hazel_style_color');
									$content = str_replace( '__USE_THEME_MAIN_COLOR__', $tw_theme_main_color, $content );
									hazel_content_shortcoder($content);
									$content = apply_filters('the_content', $content);
									if (function_exists('wpb_js_remove_wpautop') == true)
										echo wpb_js_remove_wpautop($content);
									else echo wp_kses_post($content); 
									$shortcodes_custom_css = get_post_meta( $hazel_thisPostID, '_wpb_shortcodes_custom_css', true );
									if ( isset($shortcodes_custom_css) && ! empty( $shortcodes_custom_css ) ) {
										hazel_set_custom_inline_css($shortcodes_custom_css);
									}
									wp_reset_postdata();
									if (comments_open()){
										?>
										<div class="the_comments">
										    <?php comments_template( '', true ); ?>
									    </div>
										<?php
									}
								}
							}
							$args = array(
							'before'           => '<div class="navigation" style="margin-top: 0px;"><div class="des-pages"><span class="pages current">' . esc_html__('Pages:', 'hazel') . '</span>',
							'after'            => '</div></div>',
							'link_before'      => '<div class="postpagelinks">',
							'link_after'       => '</div>',
							'next_or_number'   => 'number',
							'nextpagelink'     => esc_html__('Next page','hazel'),
							'previouspagelink' => esc_html__('Previous page','hazel'),
							'pagelink'         => '%',
							'echo'             => 1
						); 
			    		wp_link_pages($args);	
						?>
					</section>
					<?php
						if (!post_password_required()){
							?>
							<section class="page_content right sidebar col-xs-12 col-md-3">
							<?php 
								if ( function_exists('dynamic_sidebar')) { 
									if ($sidebar == 'defaultblogsidebar'){
										get_sidebar();
									} else {
										ob_start();
									    do_shortcode(dynamic_sidebar($sidebar));
									    $html = ob_get_contents();
									    ob_end_clean();
										$html = wp_kses_no_null( $html, array( 'slash_zero' => 'keep' ) );
										$html = wp_kses_normalize_entities($html);
										echo wp_kses_hook($html, 'post', array());
									}
								} else {
									get_sidebar();
								}
								wp_reset_postdata();
							?>
						</section>
							<?php
						}
					?>
				</div>
			</div>
			<?php
		break;
		default:
			?>
			<div class="master_container" style="width: 100%;float: left;background-color: white;">
				<section class="page_content" id="section-<?php echo esc_attr(get_the_ID()); ?>" style="margin: 50px 0px;">
					<div class="container">
						<?php
							if ((function_exists('vc_is_inline') && vc_is_inline()) || is_preview()){
								wp_reset_postdata();
								the_content();
							} else {
								if (post_password_required()) echo get_the_password_form();
								else {
									$content_post = get_post($hazel_thisPostID);
									$content = $content_post->post_content;
									
									if (strpos($content, '<!--nextpage-->') != false){
										//paged content
										$content_paged = 1;
										if (isset($wp_query) && $wp_query->query_vars['page'] > 0) $content_paged = $wp_query->query_vars['page'];
										$content_paged_index = $content_paged-1;
										$content = explode('<!--nextpage-->', $content);
										if (isset($content[$content_paged_index])) $content = $content[$content_paged_index];
										else $content = $content[0];
									}
									
									$tw_theme_main_color = "#".get_option('hazel_style_color');
									$content = str_replace( '__USE_THEME_MAIN_COLOR__', $tw_theme_main_color, $content );
									hazel_content_shortcoder($content);
									$content = apply_filters('the_content', $content);
									if (function_exists('wpb_js_remove_wpautop') == true)
										echo wpb_js_remove_wpautop($content);
									else echo wp_kses_post($content); 
									$shortcodes_custom_css = get_post_meta( $hazel_thisPostID, '_wpb_shortcodes_custom_css', true );
									if ( isset($shortcodes_custom_css) && ! empty( $shortcodes_custom_css ) ) {
										hazel_set_custom_inline_css($shortcodes_custom_css);
									}
									wp_reset_postdata();
									if (comments_open()){
										?>
										<div class="the_comments">
										    <?php comments_template( '', true ); ?>
									    </div>
										<?php
									}
								}
							}
							$args = array(
							'before'           => '<div class="navigation" style="margin-top: 0px;"><div class="des-pages"><span class="pages current">' . esc_html__('Pages:', 'hazel') . '</span>',
							'after'            => '</div></div>',
							'link_before'      => '<div class="postpagelinks">',
							'link_after'       => '</div>',
							'next_or_number'   => 'number',
							'nextpagelink'     => esc_html__('Next page','hazel'),
							'previouspagelink' => esc_html__('Previous page','hazel'),
							'pagelink'         => '%',
							'echo'             => 1
						); 
			    		wp_link_pages($args);	
						?>
					</div>
				</section>
			</div>
			<?php
		break;
	}
	?>

<?php get_footer(); ?>
