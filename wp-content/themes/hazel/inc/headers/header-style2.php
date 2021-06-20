<?php
	
function hazel_print_menu($ispagephp = true, $isfirstpage = false){
	global $hazel_header_bgstyle_pre, $hazel_header_bgstyle_after;
	$header_shrink = "";
	if (get_option('hazel_fixed_menu') == 'on'){
		if (get_option('hazel_header_after_scroll') == 'on'){
			if (get_option('hazel_header_shrink_effect') == 'on'){
				$header_shrink = " header_shrink";
			}
		}
	}
	$header_after_scroll = false;
	if (get_option('hazel_fixed_menu') == 'on'){
		if (get_option('hazel_header_after_scroll') == 'on'){
			$header_after_scroll = true;
		}
	}
	$typeofheader = get_option("hazel_header_style_type");
	
	?>
	
	<header class="navbar navbar-default navbar-fixed-top <?php echo esc_attr($typeofheader); ?> <?php if (get_option('hazel_fixed_menu') == 'off') echo " header_not_fixed"; else if (get_option('hazel_header_hide_on_start') == "on" && !$ispagephp) echo " hide-on-start"; ?><?php if (get_option("hazel_header_full_width") == "on") echo " header-full-width"; ?><?php if (get_option("hazel_header_full_width") == "off") echo " header-with-container"; ?><?php if (get_option("hazel_header_hover_line") == "on") echo " hover-line"; ?><?php if (get_option("hazel_header_menu_itens_style") == "simple") echo " menu-simple"; ?><?php echo " ".esc_attr($hazel_header_bgstyle_pre); ?>" data-rel="<?php echo esc_attr($hazel_header_bgstyle_pre."|".$hazel_header_bgstyle_after); ?>">
		
		<?php
		if (get_option("hazel_info_above_menu") == "on"){
			?>
			<div class="top-bar">
				<div class="top-bar-bg">
					<div class="<?php if (get_option("hazel_header_full_width") == "off") echo "container"; ?> clearfix">
						<div class="slidedown">
						    <div class="col-xs-12 col-sm-12">
							<?php
								
								/* wpml menu */
								if (get_option("hazel_wpml_menu_widget") == "on") {
									if (function_exists('icl_object_id')) { ?>
										<div class="menu_wpml_widget">	
											<?php if (function_exists('icl_language_selector')) do_action('icl_language_selector'); else if (function_exists('wpml_add_language_selector')) do_action('wpml_add_language_selector'); ?>
										</div>
									<?php 
									}
								}
								/* social icons */
								if (get_option("hazel_enable_socials") == "on"){
									?>
										<div class="social-icons-fa">
									        <ul>

											<?php
												$icons = array(array("houzz","Houzz"),array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("stumbleupon","Stumble Upon"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google-plus","Google+"),array("vimeo-square","Vimeo"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("wordpress","Wordpress"),array("youtube","Youtube"),array("reddit","Reddit"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble")
												,array("vk","VK"),array("twitch","Twitch"),array("foursquare","Foursquare"),array("slack","Slack"),array("whatsapp","whatsapp")
												,array("line","Line"),array("weixin","weixin"),array("tripadvisor","tripadvisor"));
												foreach ($icons as $i){
													if (is_string(get_option("hazel_icon-".$i[0])) && get_option("hazel_icon-".$i[0]) != ""){
													?>
													<li>
														<a href="<?php echo esc_url(get_option("hazel_icon-".$i[0])); ?>" target="_blank" class="<?php echo esc_attr(strtolower($i[0])); ?>" title="<?php echo esc_attr($i[1]); ?>"><i class="fab fa-<?php echo esc_attr(strtolower($i[0])); ?>"></i></a>
													</li>
													
													
													<?php
													}
												}
											?>
				
											<?php if ( is_string(get_option("hazel_icon-envelope")) && get_option("hazel_icon-envelope") != "" ){ ?>
												<li><a href="<?php echo esc_url(get_option("hazel_icon-envelope"))?>" target="_blank" class="envelope" title="email"><i class="far fa-envelope"></i></a></li>
											<?php } ?>
											
											<?php if ( is_string(get_option("hazel_icon-rss")) && get_option("hazel_icon-rss") != "" ){ ?>
												<li><a href="<?php echo esc_url(get_option("hazel_icon-rss"))?>" target="_blank" class="rss" title="rss"><i class="fa fa-rss-square"></i></a></li>
											<?php } ?>
											
											
										    </ul>
										</div>
									<?php	
								}
								/* company infos */
								if ( get_option("hazel_telephone_menu") != "" || get_option("hazel_email_menu") != "" || get_option("hazel_address_menu") != "" || get_option("hazel_text_field_menu") != "" ){
									?>
									<ul class="phone-mail">
										<?php if ( is_string(get_option("hazel_telephone_menu")) && get_option("hazel_telephone_menu") != "" ){ ?>
											<li><i class="fab fa-phone"></i><?php printf(esc_html__("%s", "hazel"), get_option("hazel_telephone_menu")); ?></li>
										<?php } ?>
										<?php if ( is_string(get_option("hazel_email_menu")) && get_option("hazel_email_menu") != "" ){ ?>
											<li><i class="fab fa-envelope"></i><a href="mailto:<?php echo esc_attr(get_option("hazel_email_menu")); ?>"><?php echo esc_html(get_option("hazel_email_menu")); ?></a></li>
										<?php } ?>
										<?php if ( is_string(get_option("hazel_address_menu")) && get_option("hazel_address_menu") != "" ){ ?>
											<li><i class="fab fa-map-marker"></i><?php echo wp_kses_post(get_option("hazel_address_menu")); ?></li>
										<?php } ?>
										<?php if ( is_string(get_option("hazel_text_field_menu")) && get_option("hazel_text_field_menu") != "" ){ ?>
											<li class="text_field"><?php echo wp_kses_post(get_option("hazel_text_field_menu")); ?></li>
										<?php } ?>
									</ul>
									<?php
								}
								
								
								/* topbar menu */
								if (get_option("hazel_top_bar_menu") == "on"){
									?>
									<div class="top-bar-menu">
										<?php wp_nav_menu( array( 'theme_location' => 'topbarnav', 'container' => false, 'menu_class' => 'sf-menu', 'menu_id' => 'menu_top_bar' )); ?>
									</div>
									<?php
								}
							?>
							</div>
						</div>
					</div>
				</div>
				<a href="#" class="down-button"><i class="fab fa-plus"></i></a><!-- this appear on small devices -->
			</div>
			<?php
			$hazel_inline_script = '
				jQuery(document).ready(function(){
					"use strict";
					if (jQuery(this).width() > 768) {
						jQuery("a.down-button").removeClass("current");
						jQuery(".slidedown").removeAttr("style");
					}
					jQuery("a.down-button").bind("click", function () {
					  if (jQuery(this).hasClass("current")) {
						  jQuery(this).removeClass("current");
						  jQuery(this).parent().parent().find(".slidedown").slideUp("slow", function(){ jQuery(this).closest(".top-bar").removeClass("opened"); });
						  return false;
					  } else {
						  jQuery(this).addClass("current").closest(".top-bar").addClass("opened");
						  jQuery(this).parent().parent().find(".slidedown").slideDown("slow");
						  return false;
					  }
					});
				});
				jQuery(window).resize(function(){
					if (jQuery(this).width() > 768) {
						jQuery("a.down-button").removeClass("current");
						jQuery(".slidedown").removeAttr("style");
					}
				});
			';
			wp_add_inline_script('hazel', $hazel_inline_script, 'after');
		}
		
		
		?>
		
		<div class="nav-container <?php if (get_option("hazel_header_full_width") == "off") echo " container"; ?>">
	    	<div class="navbar-header">
		    	
				<a class="navbar-brand nav-to" href="<?php echo esc_url(home_url("/")); ?>" tabindex="-1">
	        	<?php 
					$hazel_header_style_pre = $hazel_header_bgstyle_pre == 'dark' ? 'light' : 'dark';
					$hazel_header_style_after = $hazel_header_bgstyle_after == 'dark' ? 'light' : 'dark';
					
					$alone = true;
    				if (get_option("hazel_logo_retina_image_url_".$hazel_header_style_pre) != ""){
	    				$alone = false;
    				}
					?>
					<img class="logo_normal <?php if (!$alone) echo "notalone"; ?>" style="position: relative;" src="<?php echo esc_url(get_option("hazel_logo_image_url_".$hazel_header_style_pre)); ?>" alt="<?php esc_html_e("", "hazel"); ?>" title="<?php esc_html_e("", "hazel"); ?>">
    					
    				<?php 
    				if (get_option("hazel_logo_retina_image_url_".$hazel_header_style_pre) != ""){
    				?>
	    				<img class="logo_retina" style="display:none; position: relative;" src="<?php echo esc_url(get_option("hazel_logo_retina_image_url_".$hazel_header_style_pre)); ?>" alt="<?php esc_html_e("", "hazel"); ?>" title="<?php esc_html_e("", "hazel"); ?>">
    				<?php
					}
					/* hazel_header_after_scroll option */
	    			if ($header_after_scroll || get_option('hazel_header_hide_on_start') == 'on'){
		    			$alone = true;
	    				if (get_option("hazel_logo_retina_image_url_".$hazel_header_style_after) != ""){
		    				$alone = false;
	    				}
    					?>
    					<img class="logo_normal logo_after_scroll <?php if (!$alone) echo "notalone"; ?>" style="position: relative;" alt="<?php esc_html_e("", "hazel"); ?>" title="<?php esc_html_e("", "hazel"); ?>" src="<?php echo esc_url(get_option("hazel_logo_image_url_".$hazel_header_style_after)); ?>">
	    					
	    				<?php 
	    				if (get_option("hazel_logo_retina_image_url_".$hazel_header_style_after) != ""){
	    				?>
		    				<img class="logo_retina logo_after_scroll" style="display:none; position: relative;" src="<?php echo esc_url(get_option("hazel_logo_retina_image_url_".$hazel_header_style_after)); ?>" alt="<?php esc_html_e("", "hazel"); ?>" title="<?php esc_html_e("", "hazel"); ?>">
	    				<?php
    					}
	    			}
	    		?>
		        </a>
			</div>
			
			
			<?php
				if (!$isfirstpage){
					?>
					<div id="dl-menu" class="dl-menuwrapper">
						<div class="dl-trigger-wrapper">
							<button class="dl-trigger"></button>
						</div>
						<?php 
							if ($ispagephp){
								wp_nav_menu( array( 'theme_location' => 'PrimaryNavigation', 'container' => false, 'menu_class' => 'dl-menu', 'walker' => new hazel_walker_nav_menu_outsider_mobile, 'fallback_cb' => esc_html__('You need to assign a Menu to the Main Navigation Location.','hazel') ) );
							} 
							else {
								global $homes;
								$homes = 0;
								wp_nav_menu( array( 'theme_location' => 'PrimaryNavigation', 'container' => false, 'menu_class' => 'dl-menu', 'walker' => new hazel_walker_nav_menu_mobile, 'fallback_cb' => esc_html__('You need to assign a Menu to the Main Navigation Location.','hazel') ) );
							} 
						?>
					</div>
					<?php
				}
			?>
			
			<?php
			//the search input
			if (get_option("hazel_enable_search") == "on"){
				?>
				<form autocomplete="off" role="search" method="get" class="search_input <?php echo esc_attr(get_option("hazel_search_open_effect")); ?>" action="<?php echo esc_url(home_url("/")); ?>">
					<div class="search_close">
						<i class="ion-ios-close-empty"></i>
					</div>
					<div class="<?php if (get_option("hazel_header_full_width") == "off") echo "container"; ?>">
						<input value="" name="s" class="search_input_value" type="text" placeholder="<?php
							if (function_exists('icl_t')){
								printf(esc_html__("%s","hazel"), icl_t( 'hazel', 'Type your search and hit enter...', get_option('hazel_search_box_text')));
							} else {
								printf(esc_html__("%s","hazel"), get_option("hazel_search_box_text"));
							}
						?>" />
						<input class="hidden" type="submit" id="searchsubmit" value="Search" />
						<div class="ajax_search_results"><ul></ul></div>
					</div>
					<?php
						if (function_exists('icl_t')){
							?>
							<input class="hidden" name="lang" type="text" value="<?php echo ICL_LANGUAGE_CODE; ?>" />
							<?php
						}
					?>
				</form>	
				<?php
			}
			?>
			
		
			
			<div class="navbar-collapse collapse">
				<div class="menu_style2_bearer">
				<?php 
					
					if (!$isfirstpage){
						if ($ispagephp){
							wp_nav_menu( array( 'theme_location' => 'PrimaryNavigation', 'container' => false, 'menu_class' => 'nav navbar-nav navbar-right', 'walker' => new hazel_walker_nav_menu_outsider, 'fallback_cb' => esc_html__('You need to assign a Menu to the Main Navigation Location.','hazel') ) );
						} 
						else {
							global $homes;
							$homes = 0;
							wp_nav_menu( array( 'theme_location' => 'PrimaryNavigation', 'container' => false, 'menu_class' => 'nav navbar-nav navbar-right', 'walker' => new hazel_walker_nav_menu, 'fallback_cb' => esc_html__('You need to assign a Menu to the Main Navigation Location.','hazel') ) );
						} 	
					}
					
				?>
				</div>
			</div>
			
			
			<div class="hazel_right_header_icons <?php
				if (class_exists( 'WooCommerce' ) && get_option("hazel_woocommerce_cart") == "on") echo "with-woocommerce-cart";
			?>">
			
					<div class="header_social_icons <?php if (get_option("hazel_social_icons_menu") == "on") echo "with-social-icons"; ?>">
						<?php
							if (get_option("hazel_social_icons_menu") == "on" ){
								?>
								<div class="header_social_icons_wrapper">
								<?php
									$icons = array(array("houzz","Houzz"),array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("stumbleupon","Stumble Upon"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google-plus","Google+"),array("vimeo-square","Vimeo"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("wordpress","Wordpress"),array("youtube","Youtube"),array("reddit","Reddit"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble"),array("vk","VK"),array("twitch","Twitch"),array("foursquare","Foursquare"),array("slack","Slack"),array("whatsapp","whatsapp"),array("line","Line"),array("weixin","weixin"),array("tripadvisor","tripadvisor"));
									foreach ($icons as $i){
										if (is_string(get_option("hazel_icon-".$i[0])) && get_option("hazel_icon-".$i[0]) != ""){
										?>
										<div class="social_container <?php echo esc_attr(strtolower($i[0])); ?>_container" onclick="window.open('<?php echo esc_js(get_option("hazel_icon-".$i[0])); ?>', '_blank');">
											<i class="fab fa-<?php echo esc_attr(strtolower($i[0])); ?>"></i>
					                    </div>
								<?php
								}
							}
						?>	
						
							<?php if ( is_string(get_option("hazel_icon-envelope")) && get_option("hazel_icon-envelope") != "" ){ ?>
								<div class="social_container <?php echo esc_attr(strtolower($i[0])); ?>_container" onclick="window.open('<?php echo esc_js(get_option("hazel_icon-envelope")); ?>', '_blank');">
									<i class="far fa-envelope"></i>
			                    </div>
							<?php } ?>
							
							<?php if ( is_string(get_option("hazel_icon-envelope")) && get_option("hazel_icon-envelope") != "" ){ ?>
								<div class="social_container <?php echo esc_attr(strtolower($i[0])); ?>_container" onclick="window.open('<?php echo esc_js(get_option("hazel_icon-rss")); ?>', '_blank');">
									<i class="fa fa-rss"></i>
			                    </div>
							<?php } ?>
							
							
						</div>
						<?php
					}
					

				?>
			</div>
				
				<?php
				
				//search trigger
				if (get_option("hazel_enable_search") == "on"){
					?>
					<div class="search_trigger"><i class="ion-ios-search-strong"></i></div>
					<?php
				}
				?>
				
				<?php hazel_print_woocommerce_button();?>
				
				<?php
				if (get_option("hazel_sliding_panel") == "on"){
					?>					
						<div class="menu-controls sliderbar-menu-controller" title="Sidebar Menu Controller">
                            <div class="font-icon custom-font-icon">
	                            <i class="ion-grid"></i>
	                            <i class="ion-close"></i>
                            </div>
                        </div>
					<?php
				}
				
			?>
			</div>
			
			
		</div>
		
	</header>
	<?php
}
	
?>