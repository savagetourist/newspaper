<?php

get_header(); hazel_print_menu();

	$hazel_thisPostID = get_the_ID(); 	

	if (get_post_meta($hazel_thisPostID, "hazel_enable_custom_pagetitle_options_value", true) == "no" || !get_post_meta($hazel_thisPostID, "hazel_enable_custom_pagetitle_options_value", true)){
		$type = get_option("hazel_header_type");
		$thecolor = hazel_hex2rgb(get_option("hazel_header_color")); 
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
		$pt_overlay_the_color = hazel_hex2rgb(get_option("hazel_pagetitle_overlay_color"));
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
			    	?> <div class="revBanner"> <?php putRevSlider(substr($banner, 10)); ?> </div> <?php
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
	?>
	
	<div class="master_container" style="width: 100%;float: left;background-color: white;">
		<section class="page_content">
			<div class="container buddypress-container">
				<?php
				while (have_posts()) : the_post(); ?>
				 	<?php the_content(); ?>
				<?php endwhile; ?>	
			</div>
		</section>
	</div>
	<?php get_footer(); ?>