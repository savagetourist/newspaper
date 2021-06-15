<?php
/*
Template Name: Blog Template
*/
get_header(); hazel_print_menu();

	$hazel_thisPostID = get_the_ID(); $hazel_color_code = get_option("hazel_style_color");

	if (get_post_meta($hazel_thisPostID, "hazel_enable_custom_pagetitle_options_value", true) == "no" || !get_post_meta($hazel_thisPostID, "hazel_enable_custom_pagetitle_options_value", true)){
		$type = get_option("hazel_header_type");
		$thecolor = hazel_hex2rgb(str_replace("__USE_THEME_MAIN_COLOR__", $hazel_color_code, get_option("hazel_header_color"))); 
		$opacity = intval(str_replace("%","",get_option("hazel_header_opacity")))/100;
		$color = "rgba(".$thecolor[0].",".$thecolor[1].",".$thecolor[2].",".$opacity.")";
		$image = get_option("hazel_header_image"); 
		$pattern = is_string(get_option("hazel_header_pattern")) ? HAZEL_PATTERNS_URL.get_option("hazel_header_pattern") : ""; 
		$custompattern = get_option("hazel_header_custom_pattern"); 
		//$height = get_option("hazel_header_height"); 
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
		//$height = get_post_meta($hazel_thisPostID, "hazel_header_height_value", true);
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
		 		$hazel_output = "";
		 		if ($height != "") $hazel_output.= "height: ". $height . ";";
				if ($type == "none") $hazel_output.= "background: none;"; 
				if ($type == "color") $hazel_output.= "background: " . $color . ";";
				if ($type == "image") $hazel_output.= "background: url(" . $image . ") no-repeat; background-size: 100% auto;";  
	 			if ($type == "pattern") $hazel_output.= "background: url('" . $pattern . "') 0 0 repeat;";
		 			
				echo esc_attr($hazel_output);
	    	?>">
	    	<?php
		    	if ($type == "image" && $pt_overlay){
			    	$hazel_output = "";
			    	echo '<div class="pagetitle_overlay" style="'; 
			    	if ($pt_overlay_type == "color") $hazel_output.= 'background-color:'.$pt_overlay_color;
			    	else $hazel_output.= 'background:url('.$pt_overlay_pattern.') repeat;opacity:'.$pt_overlay_opacity.';';
			    	echo esc_attr($hazel_output).'"></div>';
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
									} else masterslider(substr($banner, 13));
								}
							}
				    	?>
				    </div> 
				    <?php
		    	} else {
		    	?>
				<div class="container <?php echo esc_attr($originalalign); ?>" style="padding:<?php echo esc_attr("$pagetitlepadding 15px"); ?>">
					<div class="pageTitle" style="text-align:<?php echo esc_attr("$textalign"); ?>;<?php echo esc_attr($ptitleaux); ?>">
					<?php
						if ($showtitle){
							?>
							<h1 class="page_title" style="<?php echo esc_attr("color: #$tcolor; font-size: $tsize; font-family: '{$principalfont[0]}'; font-weight: {$principalfont[1]};");?><?php if ($margintop != "") echo esc_attr("margin-top: ".intval($margintop,10)."px;"); ?>">
								<?php if (is_front_page() && is_home()) echo wp_kses_post(get_option('hazel_blog_single_primary_title')); else echo wp_kses_post(get_the_title($hazel_thisPostID)); ?>
							</h1>
							
							<?php
						}
		    			if ($showsectitle){
			    			if (get_post_meta($post->ID, 'secondaryTitle_value', true) != ""){
						    	?>
							    <h2 class="secondaryTitle" style="<?php echo esc_attr("color: #$stcolor; font-size: $stsize; line-height: $stsize; font-family: '{$secondaryfont[0]}'; font-weight: {$secondaryfont[1]}; margin-top:{$stmargin};");?>">
							    	<?php echo wp_kses_post(get_post_meta($post->ID, 'secondaryTitle_value', true)); ?>
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

	$sidebar_scheme = get_post_meta($hazel_thisPostID, 'sidebar_for_default_value', true);
	if (defined('HAZEL_IS_FIRST_PAGE')) $sidebar_scheme = get_option('hazel_blog_archive_sidebar');
	$sidebar = get_post_meta($hazel_thisPostID, 'sidebars_available_value', true);
	if (!$sidebar) $sidebar = "defaultblogsidebar";
	
	$pageid = get_the_ID();
	switch ($sidebar_scheme){
		case "none":
			if (!defined("HAZEL_IS_FIRST_PAGE") && $post->post_content != ""){
				?>
				<div class="content-before-blog container">
					<?php 
						hazel_content_shortcoder($post->post_content);
						echo do_shortcode($post->post_content); 
					?>
				</div>
				<?php
			}
			?>
			<div class="blog-default wideblog">
				<div class="master_container">
					<section class="page_content col-xs-12 col-md-12">
						<div class="blog-default-bg">
							<div class="container">
							<?php hazel_print_blog($pageid); ?>
							</div>
						</div>
					</section>
				</div>
			</div>
			<?php
		break;
		case "left":
			if (!defined("HAZEL_IS_FIRST_PAGE") && $post->post_content != ""){
				?>
				<div class="content-before-blog container">
					<?php 
						hazel_content_shortcoder($post->post_content);
						echo do_shortcode($post->post_content); 
					?>
				</div>
				<?php
			}
			?>
			<div class="blog-default">
				<div class="master_container container">
					<section class="page_content left sidebar col-xs-12 col-md-3">
						<div class="blog-sidebar-bg">
							<?php 
							if ($sidebar === "defaultblogsidebar"){
								get_sidebar();
							} else {
								if ( function_exists('dynamic_sidebar')) { 
									ob_start();
								    do_shortcode(dynamic_sidebar($sidebar));
								    $html = ob_get_contents();
								    ob_end_clean();
								    $html = wp_kses_no_null( $html, array( 'slash_zero' => 'keep' ) );
									$html = wp_kses_normalize_entities($html);
									echo wp_kses_hook($html, 'post', array());  
								}
							}
							?>
						</div>
					</section>
					<section class="page_content right col-xs-12 col-md-9">
						<div class="blog-default-bg">
							<?php hazel_print_blog($pageid); ?>
						</div>
					</section>
				</div>
			</div>
			<?php
		break;
		case "right":
			if (!defined("HAZEL_IS_FIRST_PAGE") && $post->post_content != ""){
				?>
				<div class="content-before-blog container">
					<?php 
						hazel_content_shortcoder($post->post_content);
						echo do_shortcode($post->post_content); 
					?>
				</div>
				<?php
			}
			?>
			<div class="blog-default">
				<div class="master_container container">
					<section class="page_content left col-xs-12 col-md-9">
						<div class="blog-default-bg">
							<?php hazel_print_blog($pageid); ?>
						</div>
					</section>
					<section class="page_content right sidebar col-xs-12 col-md-3">
						<div class="blog-sidebar-bg">
							<?php 
							if ($sidebar === "defaultblogsidebar"){
								get_sidebar();
							} else {
								if ( function_exists('dynamic_sidebar')) { 
									ob_start();
								    do_shortcode(dynamic_sidebar($sidebar));
								    $html = ob_get_contents();
								    ob_end_clean();
								    $html = wp_kses_no_null( $html, array( 'slash_zero' => 'keep' ) );
									$html = wp_kses_normalize_entities($html);
									echo wp_kses_hook($html, 'post', array());  
								}
							}
							?>
						</div>
					</section>
				</div>
			</div>
			<?php
		break;
		default:
			if (!defined("HAZEL_IS_FIRST_PAGE") && $post->post_content != ""){
				?>
				<div class="content-before-blog container">
					<?php 
						hazel_content_shortcoder($post->post_content);
						echo do_shortcode($post->post_content); 
					?>
				</div>
				<?php
			}
			?>
			<div class="blog-default wideblog">
				<div class="master_container">
					<section class="page_content col-xs-12 col-md-12">
						<div class="blog-default-bg">
							<div class="container">
							<?php hazel_print_blog($pageid); ?>
							</div>
						</div>
					</section>
				</div>
			</div>
			<?php
		break;
	}

	function hazel_print_blog($pageid){
		
		$pag = 1;
		global $wp_query;
		$pag = $wp_query->query_vars['paged'];
		if ($pag=="" && isset($wp_query->query['paged'])) $pag = $wp_query->query['paged'];
		
		$cattype = "category__in";
		if (strpos(get_post_meta($pageid, 'posts_filter_categories_value', true), ',') !== false){
			$categories = explode(',',get_post_meta($pageid, 'posts_filter_categories_value', true));	
		} else {
			$cattype = "cat";
			$categories = get_post_meta($pageid, 'posts_filter_categories_value', true);
		}
		$tagtype = "tag__in";
		if (strpos(get_post_meta($pageid, 'posts_filter_tags_value', true), ',') !== false){
			$tags = explode(",",get_post_meta($pageid, 'posts_filter_tags_value', true));	
		} else {
			$tagtype = "tag_id";
			$tags = get_post_meta($pageid, 'posts_filter_tags_value', true);
		}
		$authortype = "author__in";
		if (strpos(get_post_meta($pageid, 'posts_filter_authors_value', true), ',') !== false){
			$authors = explode(",",get_post_meta($pageid, 'posts_filter_authors_value', true));
		} else {
			$authortype = "author";
			$authors = get_post_meta($pageid, 'posts_filter_authors_value', true);
		}
		$orderby = get_post_meta($pageid, 'posts_filter_orderby_value', true);
		$order = get_post_meta($pageid, 'posts_filter_order_value', true);
		
		if (!isset($nposts)) $nposts = get_option('posts_per_page');
		$args = array(
			'showposts' => $nposts,
	    	'orderby' => $orderby,
	    	'order' => $order,
	    	$cattype => $categories,
	    	$tagtype => $tags,
	    	$authortype => $authors,
	    	'post_status' => 'publish',
	    	'paged' => $pag
	    );
	    	
	    global $post, $wp_query, $hazel_the_query, $hazel_import_fonts;
	    
	    $hazel_the_query = new WP_Query( $args );
	    				    
	    if ($hazel_the_query->have_posts()){ 
	    ?> 
	    	<div class="post-listing">
		    	
	    	<?php
		    
			    while ($hazel_the_query->have_posts()){
				    $hazel_the_query->the_post();
				    $postid = get_the_ID();
				    ?>
				    
				    <article id="post-<?php esc_attr(the_ID()); ?>" <?php post_class(); ?>>
					    
					    <?php
						    $posttype = get_post_meta(get_the_ID(), 'posttype_value', true);
						    switch($posttype){
					    		case "image":
					    		
					    			if (wp_get_attachment_url( get_post_thumbnail_id($postid))){
									?>
										<div class="featured-image">
											<a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php the_title(); ?>">
											<img alt="<?php the_title(); ?>" src="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id($postid))); ?>" title="<?php esc_attr(get_the_title()); ?>"/>
											<span class="post_overlay">
													<i class="fa fa-plus" aria-hidden="true"></i>
												</span>
											</a>
										</div>
										<?php 
									}
					    			
					    		break;

					    		case "slider": 
					    			$randClass = rand(0,1000);
									?>
										<div class="flexslider <?php echo esc_attr($posttype); ?>" id="<?php echo esc_attr($randClass); ?>">
											<ul class="slides">
												<?php
													$sliderData = get_post_meta($postid, "sliderImages_value", true);
													$slide = explode("|*|",$sliderData);
												    foreach ($slide as $s){
												    	if ($s != ""){
												    		$params = explode("|!|",$s);
												    		$attachment = get_post( $params[0] );
												    		$title = isset($attachment->post_excerpt) ? $attachment->post_excerpt : "";
												    		echo "<li>";
												    		echo "<img src='".esc_url($params[1])."' alt='' title='".esc_attr($title)."'>";
												    		echo "</li>";	
												    	}
												    }
												?>
											</ul>
										</div>
									<?php
										$hazel_inline_script = '
											jQuery(document).ready(function(){
												"use strict";
												jQuery("#'.$randClass.'.flexslider").flexslider({
													animation: "fade",
													slideshow: true,
													slideshowSpeed: 3500,
													animationDuration: 1000,
													directionNav: true,
													controlNav: true,
													smootheHeight:false,
													start: function(slider) {
													  slider.removeClass("loading").css("overflow","");
													}
												});
											});
										';
										wp_add_inline_script('hazel', $hazel_inline_script, 'after');
					    		break;

					    		case "audio":
					    			?>
									<div class="audioContainer">
										<?php
											if (get_post_meta($postid, 'audioSource_value', true) == 'embed') echo get_post_meta($postid, 'audioCode_value', true); 
											else {
												$audio = explode("|!|",get_post_meta($postid, 'audioMediaLibrary_value', true));
												if (isset($audio[1])) {
													$ext = explode(".",$audio[1]);
													if (isset($ext)) $ext = $ext[count($ext)-1];
													?>
													<audio controls="controls"><source type="audio/<?php echo esc_attr($ext); ?>" src="<?php echo esc_url($audio[1]); ?>"></audio>
													<?php
												}
											}
										?>
									</div>
									<?php
					    		break;
					    		
					    		case "video":
					    			?>
					    			<div class="post-video <?php echo esc_attr(get_post_meta($postid, "videoSource_value", true)); ?>">
										<div class="video-thumb">
											<div class="video-wrapper vendor">
										<?php
											$videosType = get_post_meta($postid, "videoSource_value", true);
											if ($videosType != "embed"){
												$videos = get_post_meta($postid, "videoCode_value", true);
												$videos = preg_replace( '/\s+/', '', $videos );
												$vid = explode(",",$videos);
											}
											switch (get_post_meta($postid, "videoSource_value", true)){
												case "media":
													$video = explode("|!|",get_post_meta($postid, 'videoMediaLibrary_value', true));
													if (isset($video[1])) {
														$ext = explode(".",$video[1]);
														if (isset($ext)) $ext = $ext[count($ext)-1];
														?>
														<video controls="controls" class="video-controls"><source type="video/<?php echo esc_attr($ext); ?>" src="<?php echo esc_url($video[1]); ?>"></video>
														<?php
													}
												break;
												case "youtube":
													if (isset($vid[0])) echo "<iframe src='//www.youtube.com/embed/".esc_attr($vid[0])."' frameborder='0' allowfullscreen></iframe>";
													break;
												case "vimeo":
													if (isset($vid[0])) echo '<iframe src="https://player.vimeo.com/video/'.esc_attr($vid[0]).'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
													break;
											}						
										?>
											</div>
										</div>
									</div>
									<?php
					    		break;
					    		
					    		case "gallery":
						    		$slider = get_post_meta($postid,'gallery_slider_value',true);
									if ($slider != '-1'){
										if (substr($slider, 0, 10) === "revSlider_"){
											?>
											<div class="gallery_container">
												<?php
													if (!function_exists('putRevSlider')){
														echo 'Please install the missing plugin - Revolution Slider.';
													} else {
														putRevSlider(substr($slider, 10));
													}
												?>
											</div>
											<?php
										} else {
											?>
											<div class="gallery_container">
												<?php
													if (!function_exists('masterslider')){
														echo 'Please install the missing plugin - MasterSlider.';
													} else {
														masterslider(substr($slider, 13));
													}
												?>
											</div>
											<?php
										}
									}
					    		break;
					    		
					    		case "quote":
					    			?>
					    			<a href="<?php esc_url(the_permalink()); ?>">
						    			<div class="post-quote">
				                        	<blockquote><i class="fa fa-quote-left"></i> <?php echo wp_kses_post(get_post_meta($postid, 'quote_text_value', true)); ?> <i class="fa fa-quote-right"></i></blockquote>
				                        	<span class="author-quote">-- <?php echo wp_kses_post(get_post_meta($postid, 'quote_author_value', true)); ?> --</span>
				                        </div>
			                        </a>
					    			<?php
					    		break;

								case "link":
									?>
									<h2 class="post-title post-link">
										<?php
											$linkurl = get_post_meta($postid, 'link_url_value', true) != '' ? get_post_meta($postid, 'link_url_value', true) : get_permalink();
											$linktext = get_post_meta($postid, 'link_text_value', true) != '' ? get_post_meta($postid, 'link_text_value', true) : $linkurl;
										?>
										<a href="<?php echo esc_url($linkurl); ?>" target="_blank"><?php echo esc_html($linktext); ?></a>
			                        </h2>
									<?php
								break;
					    		
					    		case "text": default:

					    		break;
				    		}
					    ?>		
				    		
				    		<?php
					    		if ($posttype != "quote" && $posttype != "link"){
						    		?>
						    		<div class="the_title"><h2><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php wp_kses_post(the_title()); ?></a></h2></div>
													
									
						    		<div class="blog_excerpt">
								    	<?php wp_kses_post(the_excerpt()); ?>
								    </div>
								    
								    <div class="metas-container">
			    			
						    			<p class="blog-date"><i class="fa fa-calendar-o"></i><?php echo get_the_date(); ?></p>
						    			<p><a class="the_author" href="<?php echo esc_url(home_url("/"))."?author=".get_the_author_meta('ID'); ?>"><i class="fa fa-user"></i> <?php echo esc_html(the_author_meta('nickname')); ?></a></p>
										
							    		<?php
											$posttags = get_the_tags();
											if ($posttags) {
												$first = true;
												echo '<p><i class="fa fa-tags"></i> ';
												foreach($posttags as $tag) {
													if ($tag->name != "uncategorized"){
														if ($first){
															echo "<a href='".esc_url( home_url( '/' ) )."?tag=".esc_html($tag->slug)."'>".esc_html($tag->name)."</a>"; 
															$first = false;
														} else {
															echo "<span class='tags-on-icons'>, </span><a href='".esc_url( home_url( '/' ) )."?tag=".esc_html($tag->slug)."'>".esc_html($tag->name)."</a>";

														}		
													}								    
											  	}
											  	echo '</p>';
											}
										?>
										<?php
											$postcats = get_the_category();
											if ($postcats) {
												$first = true;
												echo '<p><i class="fa fa-pencil-square-o"></i> ';
												foreach($postcats as $cat) {
													if ($cat->name != "uncategorized"){
														if ($first){
															echo "<a href='".esc_url( home_url( '/' ) )."?cat=".esc_html($cat->term_id)."'>".esc_html($cat->name)."</a>"; 
															$first = false;
														} else {
															echo "<span class='tags-on-icons'>, </span><a href='".esc_url( home_url( '/' ) )."?cat=".esc_html($cat->term_id)."'>".esc_html($cat->name)."</a>"; 
														}	
													}									    
											  	}
											  	echo '</p>';
											}
										?>								
										<p><a href="#comments"><i class="fa fa-comments-o"></i> <?php echo get_comments_number(); ?></a></p>
						    		</div>
						    		
						    		<?php
					    		}
				    		?>
					    <div class="divider-posts"></div>
				    </article>
				    <?php
			    }
			    
			    ?>
	    	</div>
	    	<div class="navigation">
				<?php
					$hazel_reading_option = get_option('hazel_blog_reading_type');
					wp_reset_postdata();
					if ($hazel_reading_option != "paged" && $hazel_reading_option != "dropdown"){ 
						if (function_exists('icl_t')){
							next_posts_link( '<div class="next-posts"><i class="fa fa-angle-left"></i>'.sprintf(esc_html__("%s", "hazel"), icl_t( 'hazel', 'Previous posts', get_option('hazel_previous_text'))).'</div>', $hazel_the_query->max_num_pages);  
							previous_posts_link('<div class="prev-posts">'.sprintf(esc_html__("%s", "hazel"), icl_t( 'hazel', 'Next posts', get_option('hazel_next_text'))).'<i class="fa fa-angle-right"></i></div>', $hazel_the_query->max_num_pages);
						} else {
							next_posts_link( '<div class="next-posts"><i class="fa fa-angle-left"></i>'.sprintf(esc_html__("%s", "hazel"), get_option("hazel_previous_text")).'</div>', $hazel_the_query->max_num_pages);  
							previous_posts_link('<div class="prev-posts">'.sprintf(esc_html__("%s", "hazel"), get_option("hazel_next_text")).'<i class="fa fa-angle-right"></i></div>', $hazel_the_query->max_num_pages);
						}
					} else {
						hazel_wp_pagenavi();
					}
				?>	
			</div>
	    <?php
		}
	}
	
	?>
	
<?php get_footer(); ?>