<?php
/**
 * @package WordPress
 * @subpackage Hazel
 */
?><!DOCTYPE html>
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1" name="viewport">
	<?php wp_head(); ?>
</head>

<?php
	
	if (is_singular() && get_post_meta(get_the_ID(), 'hazel_enable_custom_header_options_value', true)=='yes') $body_extra_class = get_post_meta(get_the_ID(), 'hazel_content_to_the_top_value', true) == "off" ? " content_after_header" : "";
	else $body_extra_class = get_option('hazel_content_to_the_top') == "off" ? " content_after_header" : "";
	
?>

<body <?php body_class(); if (get_option("hazel_body_type") == "body_boxed") echo esc_html('id=boxed_layout');?>>
	
	<?php
		if (get_option("hazel_sliding_panel") == "on"){
			?>
			<div class="hazel-push-sidebar hazel-push-sidebar-right">
			    <i class="overlay-menu-close font-icon icon-icon_close"></i>
			    <div class="display-table">
			        <div id="hazel-push-sidebar-content" class="hazel-push-sidebar-content ajaxable">
				        <?php
					        if (function_exists('dynamic_sidebar')){
						        dynamic_sidebar('sliding_panel_sidebar');
					        }
				        ?>
			        </div>
			    </div>
			</div>
			<?php
		}
	?>	
	
	
	<div id="main">
	<?php
		$loader = ((is_page_template() && get_post_meta(get_the_ID(), 'hazel_enable_custom_header_options_value', true) == "yes") || (is_single() && get_post_meta(get_the_ID(), 'hazel_enable_custom_header_options_value', true) == "yes")) ? get_post_meta(get_the_ID(), 'hazel_enable_website_loading_value', true) : get_option("hazel_enable_website_loader");
		if ($loader == "on"){
			?>
			<div id="hazel_website_load">
			  	 <div class="loader-container">
			    	<div class="loading-css"></div>
			        <div class="loader-logo"></div>
			    </div>
				
				<?php if (get_option("hazel_header_menu_itens_style") == "rounded") echo " menu-rounded"; ?>
				
				<div class="introloading_logo">
					<?php
						
						if (get_option("hazel_enable_website_loader_logo") == "on"){
							?>
							
							<img class="logo_normal" style="position: relative;" src="<?php echo esc_url(get_option("hazel_logo_intro_image_url")); ?>" alt="<?php esc_html_e("", "hazel"); ?>" title="<?php esc_html_e("", "hazel"); ?>">
		    					
	    				<?php 
	    				if (get_option("hazel_logo_intro_retina_image_url") != ""){
	    				?>
		    				<img class="logo_retina" style="display:none; position: relative;" src="<?php echo esc_url(get_option("hazel_logo_intro_retina_image_url")); ?>" alt="<?php esc_html_e("", "hazel"); ?>" title="<?php esc_html_e("", "hazel"); ?>">
		    			<?php 	
						}
						?>
			  	
					<?php
					}
				?>
				</div>
			
				<?php
					if (get_option("hazel_enable_website_loader_percentage") == "on"){
						?>
						<div class="percentage">0%</div>
						<?php
					}
				?>
				
				
			</div>
	
	<?php
		}
	?>
	
	<?php
		if (get_option("hazel_body_type") == "body_boxed"){
			?>
			<div class="boxed_layout">
			<?php
		}
	?>
