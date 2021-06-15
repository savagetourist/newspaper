jQuery(document).ready(function($){ 
	"use strict";
	/* custom css */
	var _default_custom_css = jQuery('#enable_custom_css').val();
	jQuery('#enable_custom_css').change(function(){
		if (jQuery('#enable_custom_css').val() == "on"){
			jQuery('#enable_custom_css').closest('.option').next().next().fadeIn(500);
		} else {
			jQuery('#enable_custom_css').closest('.option').next().next().fadeOut(500);
		} 
	}).trigger('change');
		
	
	/* body boxed layout options */
	jQuery('#hazel_bodybg_type').change(function(){
		if (jQuery(this).val() == 'image') {
			jQuery('#upload-hazel_bodybg_type_image').closest('.option').fadeIn(500);
			jQuery('#hazel_bodybg_type_color').closest('.option').fadeOut(500);
		} else {
			jQuery('#upload-hazel_bodybg_type_image').closest('.option').fadeOut(500);
			jQuery('#hazel_bodybg_type_color').closest('.option').fadeIn(500);
		}
	}).trigger('change');
	
	jQuery('#hazel_body_type').change(function(){
		if (jQuery(this).val() == 'body_boxed'){
			jQuery('#hazel_bodybg_type').trigger('change').closest('.option').fadeIn(500);
		} else {
			jQuery(this).closest('.option').nextAll().fadeOut(500);
		}
	}).trigger('change');
	
	/* footer custom text editor */
	var submiter = jQuery('.textarea_wysiwyg_container input#submit');
		submiter.css('display','none');
	jQuery('input.save-button').click(function(){ submiter.click(); });
		
	/* headers and menus */
	if (jQuery('.hazel_fixed_menu').html() == 'on' && jQuery('.hazel_header_shrink_effect').html() == 'on' && jQuery('.hazel_header_after_scroll').html() == 'on'){
		jQuery('#hazel_logo_after_scroll_size').closest('.option').prev().nextAll().andSelf().css('display','block');
		jQuery('#hazel_logo_font').closest('.option').nextUntil(jQuery('#hazel_logo_margin_top').closest('.option')).andSelf()
			.add(jQuery('#hazel_logo_after_scroll_size').closest('.option').nextUntil(jQuery('#hazel_logo_after_scroll_margin_top').closest('.option')).andSelf())
			.css('display','none');
	} else {
		jQuery('#hazel_logo_after_scroll_size').closest('.option').prev().nextAll().andSelf().css('display','none');
		if (jQuery('.hazel_header_after_scroll').html() == 'on'){

		} else {
			jQuery('#hazel_headerbg_after_scroll_type_light').closest('.option').prev().nextAll().andSelf().css('display','none');
			jQuery('#hazel_headerbg_after_scroll_type_dark').closest('.option').prev().nextAll().andSelf().css('display','none');

		}
	}
	
	/* logo type */
/* 	if (jQuery('.hazel_logo_type.hidden').html() != 'text') */ jQuery('#hazel_logo_font').closest('.option').nextUntil(jQuery('#hazel_logo_margin_top').closest('.option')).andSelf()
		.add(jQuery('#hazel_logo_after_scroll_size').closest('.option').nextUntil(jQuery('#hazel_logo_after_scroll_margin_top').closest('.option')).andSelf())
		.css('display','none');
	
	if (jQuery('.hazel_header_after_scroll').html() == 'on'){
		//menu
		if (jQuery('.hazel_header_shrink_effect').html() == 'off'){
			jQuery('#hazel_menu_after_scroll_font_size').closest('.option')
				.add(jQuery('#hazel_menu_after_scroll_margin_top').closest('.option'))
				.add(jQuery('#hazel_menu_after_scroll_padding_bottom').closest('.option'))
			.css('display','none');
		}
		//background afterscroll options
		jQuery('#hazel_headerbg_after_scroll_type').change(function(){
			switch (jQuery('#hazel_headerbg_after_scroll_type').val()){
				case "color":
					jQuery('#hazel_headerbg_after_scroll_color').closest('.option')
						.add(jQuery('#hazel_headerbg_after_scroll_opacity').closest('.option'))
					.css('display','block');
					jQuery('#hazel_headerbg_after_scroll_image').closest('.option')
						.add(jQuery('#hazel_headerbg_after_scroll_pattern').closest('.option'))
						.add(jQuery('#hazel_headerbg_after_scroll_custom_pattern').closest('.option'))
					.css('display','none');
				break;
				case "image":
					jQuery('#hazel_headerbg_after_scroll_image').closest('.option').css('display','block');
					jQuery('#hazel_headerbg_after_scroll_color').closest('.option')
						.add(jQuery('#hazel_headerbg_after_scroll_pattern').closest('.option'))
						.add(jQuery('#hazel_headerbg_after_scroll_custom_pattern').closest('.option'))
						.add(jQuery('#hazel_headerbg_after_scroll_opacity').closest('.option'))
					.css('display','none');
				break;
				case "pattern":
					jQuery('#hazel_headerbg_after_scroll_pattern').closest('.option').css('display','block');
					jQuery('#hazel_headerbg_after_scroll_color').closest('.option')
						.add(jQuery('#hazel_headerbg_after_scroll_image').closest('.option'))
						.add(jQuery('#hazel_headerbg_after_scroll_custom_pattern').closest('.option'))
						.add(jQuery('#hazel_headerbg_after_scroll_opacity').closest('.option'))
					.css('display','none');
				break;
				case "custom_pattern":
					jQuery('#hazel_headerbg_after_scroll_pattern').closest('.option').css('display','block');
					jQuery('#hazel_headerbg_after_scroll_color').closest('.option')
						.add(jQuery('#hazel_headerbg_after_scroll_image').closest('.option'))
						.add(jQuery('#hazel_headerbg_after_scroll_custom_pattern').closest('.option'))
						.add(jQuery('#hazel_headerbg_after_scroll_opacity').closest('.option'))
					.css('display','none');
				break;
			}	
		});
		jQuery('#hazel_headerbg_after_scroll_type').trigger('change');	
	} else {
		// no after scroll neither shrink 
		jQuery('#hazel_menu_after_scroll_font_size').closest('.option').prev().nextAll().andSelf().css('display','none');
	}

	jQuery('#hazel_social_icons_style_four').closest('.option').next().find('p').appendTo(jQuery('#hazel_social_icons_style_four').closest('.option'));
	jQuery('#hazel_social_icons_style_four').closest('.option').next().remove();
	jQuery('#hazel_social_icons_style_four').siblings('p').css({'clear':'both','float':'left'});

	/*limit portfolio custom permalink*/
	jQuery('#hazel_portfolio_permalink').attr('maxlength',20);
	jQuery('#hazel_portfolio_permalink').closest('.option').next().css({
		'margin-top': '-15px',
		'z-index': 81,
		'background': 'white',
		'border-bottom': '1px solid #EDEDED',
		'color':'#999'
	});

	/* header style type */
	jQuery('#hazel_header_style_type').closest('.option').css('display','none');
	jQuery('#hazel_header_style_type option').each(function(e){
		var alt = "";
		switch(e){
			case 0:
				alt = "ESQ: logo ---- DIR: menu + socials";
			break;
			case 1:
				alt = "ESQ: logo + icons ---- DIR: socials";
			break;
			case 2:
				alt = "CENTER: logo + menu + socials possivelmente (tudo centrado)";
			break;
			case 3:
				alt = "CENTER: metade menu + logo + metade menu";
			break;
		}
		if (jQuery(this).is(':selected')){
			jQuery(this).parents('.sub-navigation-container').append('<div class="screenshot_container selected"><span class="style-'+e+'" alt="'+alt+'" /></span></div>');
		} else {
			jQuery(this).parents('.sub-navigation-container').append('<div class="screenshot_container"><span class="style-'+e+'" alt="'+alt+'" /></span></div>');
		}
	});
	jQuery('#hazel_header_style_type').parents('.sub-navigation-container').on("click", "span", function(){
		var idx = jQuery(this).attr('class').split('le-');
		jQuery('#hazel_header_style_type').val( jQuery('#hazel_header_style_type option').eq(idx[1]).val() );
		jQuery(this).parent().addClass('selected').siblings().removeClass('selected');
	});
	/* endof header style type */

	var def_sidebars = jQuery('#sidebar_name_list').html();

	jQuery('#tab_navigation-9-customcss textarea').keydown(function(e) {
	    if(e.keyCode === 9) { // tab was pressed
	        // get caret position/selection
	        var start = this.selectionStart;
	        var end = this.selectionEnd;
	
	        var $this = $(this);
	        var value = $this.val();
	
	        $this.val(value.substring(0, start)
	                    + "\t"
	                    + value.substring(end));
	
	        this.selectionStart = this.selectionEnd = start + 1;
	        e.preventDefault();
	    }
	});

	jQuery('#hazel_export_options_button, #hazel_export_style_options_button').css('top',0).closest('.option').find('br').remove();

	/*panel options*/
	jQuery('#hazel_import_options_button').closest('.option').append('<a class="hazel-button custom-option-button" style="position: relative; float: left; clear: both; margin-top: 20px;" id="hazel_apply_imported_settings_button" ><span>Apply Settings</span></a>');
	jQuery('#hazel_import_options_button').siblings('.hazel-button').click(function(){
		var confirm = window.confirm("This will replace all your panel options.\n\rAre you sure?");
		if (confirm==true){
		 	var xmlPath = jQuery('#hazel_import_options').val();
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            type: 'POST',
	            data: {
	                xmlPath: xmlPath,
	                thepath: jQuery('#homePATH').html()!=""?jQuery('#homePATH').html():jQuery('#homePATH2').html()
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
		}
	});
	jQuery('#hazel_reset_options_button').unbind().css({
		'position':'relative',
		'float':'left',
		'display':'inline-block',
		'clear':'both'
	});
	jQuery('#hazel_reset_options_button').siblings('ul').css('display','none');
	jQuery('#hazel_reset_options_button').click(function(e){
		e.stopPropagation();
		e.preventDefault();
		var confirm = window.confirm("Are you sure?");
		if (confirm == true){
		 	var xmlPath = jQuery('#templatepath').html()+"/hazel_panel_options.xml";
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            type: 'POST',
	            data: {
	                xmlPath: xmlPath,
	                thepath: jQuery('#homePATH').html()!=""?jQuery('#homePATH').html():jQuery('#homePATH2').html(),
	                action: 'reset'
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
	        jQuery(this).siblings('ul').remove();
		} else {
			return false;
		}
	});
	
	/*panel style options*/
	jQuery('#hazel_import_style_options_button').closest('.option').append('<a class="hazel-button custom-option-button" style="position: relative; float: left; clear: both; margin-top: 20px;" id="hazel_apply_imported_style_settings_button" ><span>Apply Settings</span></a>');
	jQuery('#hazel_import_style_options_button').siblings('.hazel-button').click(function(){
		var confirm = window.confirm("This will replace all your panel options.\n\rAre you sure?");
		if (confirm==true){
		 	var xmlPath = jQuery('#hazel_import_style_options').val();
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            type: 'POST',
	            data: {
	                xmlPath: xmlPath,
	                thepath: jQuery('#homePATH').html()!=""?jQuery('#homePATH').html():jQuery('#homePATH2').html()
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
		}
	});
	jQuery('#hazel_reset_style_options_button').unbind().css({
		'position':'relative',
		'float':'left',
		'display':'inline-block',
		'clear':'both'
	});
	jQuery('#hazel_reset_style_options_button').siblings('ul').css('display','none');
	jQuery('#hazel_reset_style_options_button').click(function(e){
		e.stopPropagation();
		e.preventDefault();
		var confirm = window.confirm("Are you sure?");
		if (confirm == true){
		 	var xmlStylePath = jQuery('#templatepath').html()+"/hazel_panel_style_options.xml";
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            type: 'POST',
	            data: {
	                xmlStylePath: xmlStylePath,
	                thepath: jQuery('#homePATH').html()!=""?jQuery('#homePATH').html():jQuery('#homePATH2').html(),
	                action: 'reset'
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
	        jQuery(this).siblings('ul').remove();
		} else {
			return false;
		}
	});
	
	var _default_menu_add_border = jQuery('#hazel_menu_add_border').val();
	jQuery('#hazel_menu_add_border').change(function(){
		if (jQuery(this).val() == "on"){
			jQuery('#hazel_menu_border_color').closest('.option').fadeIn(500);
		} else {
			jQuery('#hazel_menu_border_color').closest('.option').fadeOut(500);
		}
	}).trigger('change');
	
	var _default_ajax_search = jQuery('#hazel_enable_ajax_search').val();
	jQuery('#hazel_enable_ajax_search').change(function(){
		if (jQuery(this).val() == "on"){
			jQuery('#hazel_search_show_author').closest('.option').prev().nextAll().andSelf().fadeIn(500);
		} else jQuery('#hazel_search_show_author').closest('.option').prev().nextAll().andSelf().fadeOut(500);
	}).trigger('change');
	
	var _default_search = jQuery('#hazel_enable_search').val();
	jQuery('#hazel_enable_search').change(function(){
		if (jQuery(this).val() == "on" ){
			jQuery(this).closest('.option').nextUntil(jQuery('#hazel_search_sidebars_available').closest('.option').next()).fadeIn(500);
			jQuery('#hazel_enable_ajax_search').trigger('change');
		} else jQuery(this).closest('.option').nextAll().fadeOut(500);
	}).trigger('change');
	
	var _default_footer_display_social_icons = jQuery('#hazel_footer_display_social_icons').val();
	jQuery('#hazel_footer_display_social_icons').change(function(){
		if (jQuery(this).val() == 'on'){
			jQuery('#hazel_footer_social_icons_alignment').closest('.option').fadeIn(500);
		} else {
			jQuery('#hazel_footer_social_icons_alignment').closest('.option').fadeOut(500);
		}
	}).trigger('change');
	
	var _default_footer_display_custom_text = jQuery('#hazel_footer_display_custom_text').val();
	jQuery('#hazel_footer_display_custom_text').change(function(){
		if (jQuery(this).val() == 'on'){
			jQuery('#hazel_footer_custom_text').closest('.option').add(jQuery('#hazel_footer_custom_text_alignment').closest('.option')).fadeIn(500);
		} else {
			jQuery('#hazel_footer_custom_text').closest('.option').add(jQuery('#hazel_footer_custom_text_alignment').closest('.option')).fadeOut(500);
		}
	}).trigger('change');
	
	var _default_footer_display_logo = jQuery('#hazel_footer_display_logo').val();
	jQuery('#hazel_footer_display_logo').change(function(){
		if (jQuery(this).val() == 'on'){
			jQuery(this).closest('.option').nextUntil(jQuery('#hazel_footer_display_social_icons').closest('.option')).css('display','block');
		} else {
			jQuery(this).closest('.option').nextUntil(jQuery('#hazel_footer_display_social_icons').closest('.option')).css('display','none');
		}
	}).trigger('change');
	
	
	var _default_animate_thumbnails = jQuery('#hazel_animate_thumbnails').val();
	if (_default_animate_thumbnails === "on"){
		jQuery('#hazel_thumbnails_effect').closest('.option').fadeIn(500);
	} else {
		jQuery('#hazel_thumbnails_effect').closest('.option').fadeOut(500);
	}
	jQuery('#hazel_animate_thumbnails').change(function(){
		if (_default_animate_thumbnails === "on"){
			jQuery('#hazel_thumbnails_effect').closest('.option').fadeIn(500);
		} else {
			jQuery('#hazel_thumbnails_effect').closest('.option').fadeOut(500);
		}
	});
	
	var _default_body_shadow = jQuery('#hazel_body_shadow').val();
	if (_default_body_shadow === "on"){
		jQuery('#hazel_body_shadow').closest('.option').next().fadeIn(500).removeClass('optoff');
	} else {
		jQuery('#hazel_body_shadow').closest('.option').next().fadeOut(500).addClass('optoff');
	}
	jQuery('#hazel_body_shadow').change(function(){
		if (_default_body_shadow === "on"){
			jQuery('#hazel_body_shadow').closest('.option').next().fadeIn(500).removeClass('optoff');
		} else {
			jQuery('#hazel_body_shadow').closest('.option').next().fadeOut(500).addClass('optoff');
		}
	});
	
	//body background type
	var _default_body_background = jQuery('#hazel_body_type').val();
	switch(_default_body_background){
		case "image":
			jQuery('#hazel_body_type').closest('.option').next().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#hazel_body_type').closest('.option').next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#hazel_body_type').closest('.option').next().next().fadeOut(500).addClass('optoff');
			jQuery('#hazel_body_type').closest('.option').next().fadeIn(500).removeClass('optoff');
			break;
		case "color":
			jQuery('#hazel_body_type').closest('.option').next().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#hazel_body_type').closest('.option').next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#hazel_body_type').closest('.option').next().next().fadeIn(500).removeClass('optoff');
			jQuery('#hazel_body_type').closest('.option').next().fadeOut(500).addClass('optoff');
			break;
		case "pattern": case "custom_pattern":
			jQuery('#hazel_body_type').closest('.option').next().next().next().next().fadeIn(500).removeClass('optoff');
			jQuery('#hazel_body_type').closest('.option').next().next().next().fadeIn(500).removeClass('optoff');
			jQuery('#hazel_body_type').closest('.option').next().next().fadeOut(500).addClass('optoff');
			jQuery('#hazel_body_type').closest('.option').next().fadeOut(500).addClass('optoff');
			break;
	}
	jQuery('#hazel_body_type').change(function(){
		var _default_body_background = jQuery('#hazel_body_type').val();
		switch(_default_body_background){
			case "image":
				jQuery('#hazel_body_type').closest('.option').next().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#hazel_body_type').closest('.option').next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#hazel_body_type').closest('.option').next().next().fadeOut(500).addClass('optoff');
				jQuery('#hazel_body_type').closest('.option').next().fadeIn(500).removeClass('optoff');
				break;
			case "color":
				jQuery('#hazel_body_type').closest('.option').next().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#hazel_body_type').closest('.option').next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#hazel_body_type').closest('.option').next().next().fadeIn(500).removeClass('optoff');
				jQuery('#hazel_body_type').closest('.option').next().fadeOut(500).addClass('optoff');
				break;
			case "pattern": case "custom_pattern":
				jQuery('#hazel_body_type').closest('.option').next().next().next().next().fadeIn(500).removeClass('optoff');
				jQuery('#hazel_body_type').closest('.option').next().next().next().fadeIn(500).removeClass('optoff');
				jQuery('#hazel_body_type').closest('.option').next().next().fadeOut(500).addClass('optoff');
				jQuery('#hazel_body_type').closest('.option').next().fadeOut(500).addClass('optoff');
				break;
		}
	});	
	
	var _default_headerbg_type_light = jQuery('#hazel_headerbg_type_light').val();
	switch (_default_headerbg_type_light){
		case "color":
			jQuery('#hazel_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_color_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_opacity_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#hazel_headerbg_image_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#hazel_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_custom_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#hazel_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_custom_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);		
		break;
	}
	jQuery('#hazel_headerbg_type_light').change(function(){
		switch (_default_headerbg_type_light){
			case "color":
				jQuery('#hazel_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_color_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_opacity_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#hazel_headerbg_image_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#hazel_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_custom_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#hazel_headerbg_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_custom_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);		
			break;
		}
	});


	var _default_headerbg_after_scroll_type_light = jQuery('#hazel_headerbg_after_scroll_type_light').val();
	switch (_default_headerbg_after_scroll_type_light){
		case "color":
			jQuery('#hazel_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_color_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_after_scroll_opacity_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_after_scroll_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#hazel_headerbg_after_scroll_image_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#hazel_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_after_scroll_custom_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#hazel_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_custom_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);		
		break;
	}
	jQuery('#hazel_headerbg_after_scroll_type_light').change(function(){
		switch (_default_headerbg_after_scroll_type_light){
			case "color":
				jQuery('#hazel_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_color_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_after_scroll_opacity_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_after_scroll_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#hazel_headerbg_after_scroll_image_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_custom_pattern_light').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#hazel_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_after_scroll_custom_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#hazel_headerbg_after_scroll_image_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_color_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_opacity_light').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_pattern_light').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_custom_pattern_light').closest('.option').removeClass('optoff').fadeIn(500);		
			break;
		}
	});

	
	var _default_headerbg_type_dark = jQuery('#hazel_headerbg_type_dark').val();
	switch (_default_headerbg_type_dark){
		case "color":
			jQuery('#hazel_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_color_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_opacity_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#hazel_headerbg_image_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#hazel_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_custom_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#hazel_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_custom_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);		
		break;
	}
	jQuery('#hazel_headerbg_type_dark').change(function(){
		switch (_default_headerbg_type_dark){
			case "color":
				jQuery('#hazel_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_color_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_opacity_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#hazel_headerbg_image_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#hazel_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_custom_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#hazel_headerbg_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_custom_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);		
			break;
		}
	});
	
	var _default_headerbg_after_scroll_type_dark = jQuery('#hazel_headerbg_after_scroll_type_dark').val();
	switch (_default_headerbg_after_scroll_type_dark){
		case "color":
			jQuery('#hazel_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_color_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_after_scroll_opacity_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_after_scroll_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#hazel_headerbg_after_scroll_image_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#hazel_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_headerbg_after_scroll_custom_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#hazel_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#hazel_headerbg_after_scroll_custom_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);		
		break;
	}
	jQuery('#hazel_headerbg_after_scroll_type_dark').change(function(){
		switch (_default_headerbg_after_scroll_type_dark){
			case "color":
				jQuery('#hazel_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_color_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_after_scroll_opacity_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_after_scroll_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#hazel_headerbg_after_scroll_image_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_custom_pattern_dark').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#hazel_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_headerbg_after_scroll_custom_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#hazel_headerbg_after_scroll_image_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_color_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_opacity_dark').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_pattern_dark').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#hazel_headerbg_after_scroll_custom_pattern_dark').closest('.option').removeClass('optoff').fadeIn(500);		
			break;
		}
	});
	
	
	var _default_toppanelbg_type = jQuery('#hazel_toppanelbg_type').val();
	switch (_default_toppanelbg_type){
		case "color":
			jQuery('#hazel_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_toppanelbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#hazel_toppanelbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#hazel_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_toppanelbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_toppanelbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#hazel_toppanelbg_type').change(function(){
		switch (_default_toppanelbg_type){
			case "color":
				jQuery('#hazel_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_toppanelbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#hazel_toppanelbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#hazel_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_toppanelbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_toppanelbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	var _default_sec_footerbg_type = jQuery('#hazel_sec_footerbg_type').val();
	switch (_default_sec_footerbg_type){
		case "color":
			jQuery('#hazel_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_sec_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#hazel_sec_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#hazel_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#hazel_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#hazel_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#hazel_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
		break;
	}
	jQuery('#hazel_sec_footerbg_type').change(function(){
		switch (_default_sec_footerbg_type){
			case "color":
				jQuery('#hazel_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_sec_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#hazel_sec_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#hazel_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#hazel_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#hazel_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#hazel_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_sec_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			break;
		}
	});
	
	
	var _default_footerbg_type = jQuery('#hazel_footerbg_type').val();
	switch (_default_footerbg_type){
		case "color":
			jQuery('#hazel_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#hazel_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#hazel_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#hazel_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeOut(500);
		break;
		case "custom_pattern":
			jQuery('#hazel_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_pattern').closest('.option').removeClass('optoff').fadeOut(500);
			jQuery('#hazel_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#hazel_footerbg_type').change(function(){
		switch (_default_footerbg_type){
			case "color":
				jQuery('#hazel_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#hazel_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#hazel_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#hazel_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeOut(500);
			break;
			case "custom_pattern":
				jQuery('#hazel_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_color_opacity').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_pattern').closest('.option').removeClass('optoff').fadeOut(500);
				jQuery('#hazel_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	
	
	//style > body - body layout type
	var _default_body_layout_type = jQuery('#hazel_body_layout_type').val();
	if (_default_body_layout_type === "full"){
		jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().next().fadeOut(500);
		jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().fadeOut(500);
		jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().fadeOut(500);
		jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().fadeOut(500);
		jQuery('#hazel_body_layout_type').closest('.option').next().next().next().fadeOut(500);
		jQuery('#hazel_body_layout_type').closest('.option').next().next().fadeOut(500);
		jQuery('#hazel_body_layout_type').closest('.option').next().fadeOut(500);
	} else {
		if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().next().hasClass('optoff'))
			jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().next().fadeIn(500);
		if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().hasClass('optoff'))
			jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().fadeIn(500);
		if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().hasClass('optoff'))
			jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().fadeIn(500);
		if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().hasClass('optoff'))
			jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().fadeIn(500);
		if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().next().hasClass('optoff'))
			jQuery('#hazel_body_layout_type').closest('.option').next().next().next().fadeIn(500);
		if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().hasClass('optoff'))
			jQuery('#hazel_body_layout_type').closest('.option').next().next().fadeIn(500);
		if (!jQuery('#hazel_body_layout_type').closest('.option').next().hasClass('optoff'))
			jQuery('#hazel_body_layout_type').closest('.option').next().fadeIn(500);
	}
	jQuery('#hazel_body_layout_type').change(function(){
		if (_default_body_layout_type === "full"){
			jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().next().fadeOut(500);
			jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().fadeOut(500);
			jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().fadeOut(500);
			jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().fadeOut(500);
			jQuery('#hazel_body_layout_type').closest('.option').next().next().next().fadeOut(500);
			jQuery('#hazel_body_layout_type').closest('.option').next().next().fadeOut(500);
			jQuery('#hazel_body_layout_type').closest('.option').next().fadeOut(500);
		} else {
			if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().next().hasClass('optoff'))
				jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().next().fadeIn(500);
			if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().hasClass('optoff'))
				jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().next().fadeIn(500);
			if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().hasClass('optoff'))
				jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().next().fadeIn(500);
			if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().hasClass('optoff'))
				jQuery('#hazel_body_layout_type').closest('.option').next().next().next().next().fadeIn(500);
			if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().next().hasClass('optoff'))
				jQuery('#hazel_body_layout_type').closest('.option').next().next().next().fadeIn(500);
			if (!jQuery('#hazel_body_layout_type').closest('.option').next().next().hasClass('optoff'))
				jQuery('#hazel_body_layout_type').closest('.option').next().next().fadeIn(500);
			if (!jQuery('#hazel_body_layout_type').closest('.option').next().hasClass('optoff'))
				jQuery('#hazel_body_layout_type').closest('.option').next().fadeIn(500);
		}
	});
	
	var _default_overlay_type = jQuery('#hazel_pagetitle_overlay_type').val();
	jQuery('#hazel_pagetitle_overlay_type').change(function(){
		_default_overlay_type = jQuery('#hazel_pagetitle_overlay_type').val();
		if (jQuery('#hazel_pagetitle_overlay_type').val() == "color"){
			jQuery('#hazel_pagetitle_overlay_color').closest('.option').fadeIn(500);
			jQuery('#hazel_pagetitle_overlay_pattern').closest('.option').fadeOut(500);
		} else {
			jQuery('#hazel_pagetitle_overlay_color').closest('.option').fadeOut(500);
			jQuery('#hazel_pagetitle_overlay_pattern').closest('.option').fadeIn(500);
		}
	}).trigger('change');
	
	var _default_overlay_type_shop = jQuery('#hazel_pagetitle_overlay_type_shop').val();
	jQuery('#hazel_pagetitle_overlay_type_shop').change(function(){
		_default_overlay_type_shop = jQuery('#hazel_pagetitle_overlay_type_shop').val();
		if (jQuery('#hazel_pagetitle_overlay_type_shop').val() == "color"){
			jQuery('#hazel_pagetitle_overlay_color_shop').closest('.option').fadeIn(500);
			jQuery('#hazel_pagetitle_overlay_pattern_shop').closest('.option').fadeOut(500);
		} else {
			jQuery('#hazel_pagetitle_overlay_color_shop').closest('.option').fadeOut(500);
			jQuery('#hazel_pagetitle_overlay_pattern_shop').closest('.option').fadeIn(500);
		}
	}).trigger('change');
	
	var _default_overlay_enable = jQuery('#hazel_pagetitle_image_overlay').val();
	jQuery('#hazel_pagetitle_image_overlay').change(function(){
		_default_overlay_enable = jQuery('#hazel_pagetitle_image_overlay').val();
		if (jQuery('#hazel_pagetitle_image_overlay').val() == "on"){
			jQuery('#hazel_pagetitle_overlay_opacity').closest('.option').add(jQuery('#hazel_pagetitle_overlay_type').closest('.option')).fadeIn(500);
			jQuery('#hazel_pagetitle_overlay_type').change();
		} else {
			jQuery('#hazel_pagetitle_overlay_type').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity').closest('.option').next()).andSelf().fadeOut(500);
		}
	}).trigger('change');
	
	var _default_overlay_enable_shop = jQuery('#hazel_pagetitle_image_overlay_shop').val();
	jQuery('#hazel_pagetitle_image_overlay_shop').change(function(){
		_default_overlay_enable_shop = jQuery('#hazel_pagetitle_image_overlay_shop').val();
		if (jQuery('#hazel_pagetitle_image_overlay_shop').val() == "on"){
			jQuery('#hazel_pagetitle_overlay_opacity_shop').closest('.option').add(jQuery('#hazel_pagetitle_overlay_type_shop').closest('.option')).fadeIn(500);
			jQuery('#hazel_pagetitle_overlay_type_shop').change();
		} else {
			jQuery('#hazel_pagetitle_overlay_type_shop').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity_shop').closest('.option').next()).andSelf().fadeOut(500);
		}
	}).trigger('change');
	
	//style > header - background type
	var _default_header_bkg = jQuery('#hazel_header_type').val();
	jQuery('#hazel_header_type').change(function(){
		var _default_header_bkg = jQuery('#hazel_header_type').val();
		switch (_default_header_bkg){
			case "without": 			
				jQuery('#hazel_header_type').closest('.option').nextAll().fadeOut(500);
			break;
			case "none": case "border":
				jQuery('#hazel_header_text_alignment').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs').closest('.option').prev().andSelf())
				.fadeIn(500);
				
				
				
				jQuery('#upload-hazel_header_image').closest('.option')
					.add(jQuery('#hazel_header_color').closest('.option')).add(jQuery('#hazel_header_opacity').closest('.option'))
					.add(jQuery('#hazel_header_pattern').closest('.option'))
					.add(jQuery('#upload-hazel_header_custom_pattern').closest('.option'))
				.fadeOut(500);
				
				jQuery('#hazel_pagetitle_image_parallax').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity').closest('.option').next()).andSelf().fadeOut();
				
			break;
			case "image":
				jQuery('#hazel_header_text_alignment').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs').closest('.option').prev().andSelf())
				.fadeIn(500);
				
				jQuery('#upload-hazel_header_image').closest('.option').fadeIn(500);
				
				jQuery('#hazel_header_color').closest('.option').add(jQuery('#hazel_header_opacity').closest('.option'))
					.add(jQuery('#hazel_header_pattern').closest('.option'))
					.add(jQuery('#upload-hazel_header_custom_pattern').closest('.option'))
					.add(jQuery('#hazel_banner_slider').closest('.option'))
				.fadeOut(500);
				
				jQuery('#hazel_pagetitle_image_parallax').closest('.option').add(jQuery('#hazel_pagetitle_image_overlay').closest('.option')).fadeIn(500);
				jQuery('#hazel_pagetitle_image_overlay').change();
				
			break;
			case "color":
				jQuery('#hazel_header_text_alignment').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_pagetitle_image_parallax').closest('.option'))
				.fadeIn(500);
				
				jQuery('#hazel_header_color').closest('.option')
					.add(jQuery('#hazel_header_opacity').closest('.option'))
				.fadeIn(500);
				
				jQuery('#upload-hazel_header_image').closest('.option')
					.add(jQuery('#hazel_header_pattern').closest('.option'))
					.add(jQuery('#upload-hazel_header_custom_pattern').closest('.option'))
					.add(jQuery('#hazel_banner_slider').closest('.option'))
				.fadeOut(500);
				
							jQuery('#hazel_pagetitle_image_parallax').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity').closest('.option').next()).fadeOut();
				
			break;
			case "pattern":
				jQuery('#hazel_header_text_alignment').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_pagetitle_image_parallax').closest('.option'))
				.fadeIn(500);
				
				jQuery('#hazel_header_pattern').closest('.option').fadeIn(500);
				
				jQuery('#upload-hazel_header_image').closest('.option')
					.add(jQuery('#hazel_header_color').closest('.option')).add(jQuery('#hazel_header_opacity').closest('.option'))
					.add(jQuery('#upload-hazel_header_custom_pattern').closest('.option'))
					.add(jQuery('#hazel_banner_slider').closest('.option'))
				.fadeOut(500);
				
							jQuery('#hazel_pagetitle_image_parallax').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity').closest('.option').next()).fadeOut();
				
			break;
			case "custom_pattern":
				jQuery('#hazel_header_text_alignment').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_pagetitle_image_parallax').closest('.option'))
				.fadeIn(500);
				
				jQuery('#upload-hazel_header_custom_pattern').closest('.option').fadeIn(500);
				
				jQuery('#upload-hazel_header_image').closest('.option')
					.add(jQuery('#hazel_header_color').closest('.option')).add(jQuery('#hazel_header_opacity').closest('.option'))
					.add(jQuery('#hazel_header_pattern').closest('.option'))
					.add(jQuery('#hazel_banner_slider').closest('.option'))
				.fadeOut(500);
				
							jQuery('#hazel_pagetitle_image_parallax').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity').closest('.option').next()).fadeOut();
				
			break;
			case "banner":
			
				jQuery('#hazel_header_text_alignment').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_pagetitle_image_parallax').closest('.option'))
				.fadeIn(500);
				
				jQuery('#hazel_banner_slider').closest('.option').fadeIn(500);
				
				jQuery('#upload-hazel_header_image').closest('.option')
					.add(jQuery('#hazel_header_color').closest('.option')).add(jQuery('#hazel_header_opacity').closest('.option'))
					.add(jQuery('#hazel_header_pattern').closest('.option'))
					.add(jQuery('#upload-hazel_header_custom_pattern').closest('.option'))
				.fadeOut(500);
				
							jQuery('#hazel_pagetitle_image_parallax').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity').closest('.option').next()).fadeOut();
				
			break;
		}
		if (_default_header_bkg == "border" || _default_header_bkg == "image" || _default_header_bkg == "pattern" || _default_header_bkg == "custom_pattern" || _default_header_bkg == "banner" || _default_header_bkg == "color"){
			jQuery('#hazel_header_height').closest('.option').fadeIn(500);
			jQuery('#hazel_header_text_alignment').closest('.option').fadeIn(500);
			jQuery('#hazel_hide_pagetitle').add(jQuery('#hazel_hide_sec_pagetitle')).add(jQuery('#hazel_breadcrumbs')).trigger('change');
		}
	}).trigger('change');
	
	
	var _default_header_bkg_shop = jQuery('#hazel_header_type_shop').val();
	jQuery('#hazel_header_type_shop').change(function(){
		var _default_header_bkg_shop = jQuery('#hazel_header_type_shop').val();
		switch (_default_header_bkg_shop){
			case "without": 			
				jQuery('#hazel_header_type_shop').closest('.option').nextAll().fadeOut(500);
			break;
			case "none": case "border":
				jQuery('#hazel_header_text_alignment_shop').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs_shop').closest('.option').prev().andSelf())
				.fadeIn(500);
				
				
				
				jQuery('#upload-hazel_header_image_shop').closest('.option')
					.add(jQuery('#hazel_header_color_shop').closest('.option')).add(jQuery('#hazel_header_opacity_shop').closest('.option'))
					.add(jQuery('#hazel_header_pattern_shop').closest('.option'))
					.add(jQuery('#upload-hazel_header_custom_pattern_shop').closest('.option'))
				.fadeOut(500);
				
				jQuery('#hazel_pagetitle_image_parallax_shop').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity_shop').closest('.option').next()).andSelf().fadeOut();
				
			break;
			case "image":
				jQuery('#hazel_header_text_alignment_shop').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs_shop').closest('.option').prev().andSelf())
				.fadeIn(500);
				
				jQuery('#upload-hazel_header_image_shop').closest('.option').fadeIn(500);
				
				jQuery('#hazel_header_color_shop').closest('.option').add(jQuery('#hazel_header_opacity_shop').closest('.option'))
					.add(jQuery('#hazel_header_pattern_shop').closest('.option'))
					.add(jQuery('#upload-hazel_header_custom_pattern_shop').closest('.option'))
					.add(jQuery('#hazel_banner_slider_shop').closest('.option'))
				.fadeOut(500);
				
				jQuery('#hazel_pagetitle_image_parallax_shop').closest('.option').add(jQuery('#hazel_pagetitle_image_overlay_shop').closest('.option')).fadeIn(500);
				jQuery('#hazel_pagetitle_image_overlay_shop').change();
				
			break;
			case "color":
				jQuery('#hazel_header_text_alignment_shop').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_pagetitle_image_parallax_shop').closest('.option'))
				.fadeIn(500);
				
				jQuery('#hazel_header_color_shop').closest('.option')
					.add(jQuery('#hazel_header_opacity_shop').closest('.option'))
				.fadeIn(500);
				
				jQuery('#upload-hazel_header_image_shop').closest('.option')
					.add(jQuery('#hazel_header_pattern_shop').closest('.option'))
					.add(jQuery('#upload-hazel_header_custom_pattern_shop').closest('.option'))
					.add(jQuery('#hazel_banner_slider_shop').closest('.option'))
				.fadeOut(500);
				
							jQuery('#hazel_pagetitle_image_parallax_shop').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity_shop').closest('.option').next()).fadeOut();
				
			break;
			case "pattern":
				jQuery('#hazel_header_text_alignment_shop').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_pagetitle_image_parallax_shop').closest('.option'))
				.fadeIn(500);
				
				jQuery('#hazel_header_pattern_shop').closest('.option').fadeIn(500);
				
				jQuery('#upload-hazel_header_image_shop').closest('.option')
					.add(jQuery('#hazel_header_color_shop').closest('.option')).add(jQuery('#hazel_header_opacity_shop').closest('.option'))
					.add(jQuery('#upload-hazel_header_custom_pattern_shop').closest('.option'))
					.add(jQuery('#hazel_banner_slider_shop').closest('.option'))
				.fadeOut(500);
				
							jQuery('#hazel_pagetitle_image_parallax_shop').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity_shop').closest('.option').next()).fadeOut();
				
			break;
			case "custom_pattern":
				jQuery('#hazel_header_text_alignment_shop').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_pagetitle_image_parallax_shop').closest('.option'))
				.fadeIn(500);
				
				jQuery('#upload-hazel_header_custom_pattern_shop').closest('.option').fadeIn(500);
				
				jQuery('#upload-hazel_header_image_shop').closest('.option')
					.add(jQuery('#hazel_header_color_shop').closest('.option')).add(jQuery('#hazel_header_opacity_shop').closest('.option'))
					.add(jQuery('#hazel_header_pattern_shop').closest('.option'))
					.add(jQuery('#hazel_banner_slider_shop').closest('.option'))
				.fadeOut(500);
				
							jQuery('#hazel_pagetitle_image_parallax_shop').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity_shop').closest('.option').next()).fadeOut();
				
			break;
			case "banner":
			
				jQuery('#hazel_header_text_alignment_shop').closest('.option').prev().andSelf()
					.add(jQuery('#hazel_hide_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_breadcrumbs_shop').closest('.option').prev().andSelf())
					.add(jQuery('#hazel_pagetitle_image_parallax_shop').closest('.option'))
				.fadeIn(500);
				
				jQuery('#hazel_banner_slider_shop').closest('.option').fadeIn(500);
				
				jQuery('#upload-hazel_header_image_shop').closest('.option')
					.add(jQuery('#hazel_header_color_shop').closest('.option')).add(jQuery('#hazel_header_opacity_shop').closest('.option'))
					.add(jQuery('#hazel_header_pattern_shop').closest('.option'))
					.add(jQuery('#upload-hazel_header_custom_pattern_shop').closest('.option'))
				.fadeOut(500);
				
							jQuery('#hazel_pagetitle_image_parallax_shop').closest('.option').nextUntil(jQuery('#hazel_pagetitle_overlay_opacity_shop').closest('.option').next()).fadeOut();
				
			break;
		}
		if (_default_header_bkg_shop == "border" || _default_header_bkg_shop == "image" || _default_header_bkg_shop == "pattern" || _default_header_bkg_shop == "custom_pattern" || _default_header_bkg_shop == "banner" || _default_header_bkg_shop == "color"){
			jQuery('#hazel_header_height_shop').closest('.option').fadeIn(500);
			jQuery('#hazel_header_text_alignment_shop').closest('.option').fadeIn(500);
			jQuery('#hazel_hide_pagetitle_shop').add(jQuery('#hazel_hide_sec_pagetitle_shop')).add(jQuery('#hazel_breadcrumbs_shop')).trigger('change');
		}
	}).trigger('change');
	
	
	var _default_seo_options = jQuery('#hazel_enable_theme_seo').val();
	if (_default_seo_options === "on"){
		jQuery('#hazel_enable_theme_seo').closest('.option').siblings().not(jQuery('#hazel_enable_theme_seo').closest('.option').prev()).fadeIn(500);
	} else {
		jQuery('#hazel_enable_theme_seo').closest('.option').siblings().not(jQuery('#hazel_enable_theme_seo').closest('.option').prev()).fadeOut(500);
	}
	jQuery('#hazel_enable_theme_seo').change(function(e){
		if (_default_seo_options === "on"){
			jQuery('#hazel_enable_theme_seo').closest('.option').siblings().not(jQuery('#hazel_enable_theme_seo').closest('.option').prev()).fadeIn(500);
		} else {
			jQuery('#hazel_enable_theme_seo').closest('.option').siblings().not(jQuery('#hazel_enable_theme_seo').closest('.option').prev()).fadeOut(500);
		}
	});
	
	//google fonts
	var _default_google_fonts = jQuery('#hazel_enable_google_fonts').val();
	if (_default_google_fonts === "on"){
		jQuery('#hazel_enable_google_fonts').closest('.option').next().fadeIn(500);
	} else {
		jQuery('#hazel_enable_google_fonts').closest('.option').next().fadeOut(500);
	}
	jQuery('#hazel_enable_google_fonts').change(function(){
		if (_default_google_fonts === "on"){
			jQuery('#hazel_enable_google_fonts').closest('.option').next().fadeIn(500);
		} else {
			jQuery('#hazel_enable_google_fonts').closest('.option').next().fadeOut(500);
		}		
	});
	
	//General > Projects > Enlarge pics
	var _default_proj_layout = jQuery('#hazel_single_layout').val(); 
	if (_default_proj_layout === "fullwidth_slider"){
		jQuery('#hazel_projects_enlarge_images').parent('.option').fadeOut(500);
	} else {
		jQuery('#hazel_projects_enlarge_images').parent('.option').fadeIn(500);
	}
	jQuery('#hazel_single_layout').change(function(e){
		if (_default_proj_layout === "fullwidth_slider"){
			jQuery('#hazel_projects_enlarge_images').parent('.option').fadeOut(500);
		} else {
			jQuery('#hazel_projects_enlarge_images').parent('.option').fadeIn(500);
		}
	});
	
	
	// social shares on projects
	var _default_project_single_social = jQuery('#hazel_project_single_social_shares').val();
	if (_default_project_single_social == "on") jQuery('#hazel_project_single_socials').closest('.option').fadeIn(500);
	else jQuery('#hazel_project_single_socials').closest('.option').fadeOut(500);
	jQuery('#hazel_project_single_social_shares').change(function(){
		if (jQuery(this).val() == "on")
			jQuery('#hazel_project_single_socials').closest('.option').fadeIn(500);
		else jQuery('#hazel_project_single_socials').closest('.option').fadeOut(500);
	});
	
	// social shares on posts
	var _default_post_single_social = jQuery('#hazel_post_single_social_shares').val();
	if (_default_post_single_social == "on") jQuery('#hazel_post_single_socials').closest('.option').fadeIn(500);
	else jQuery('#hazel_post_single_socials').closest('.option').fadeOut(500);
	jQuery('#hazel_post_single_social_shares').change(function(){
		if (jQuery(this).val() == "on")
			jQuery('#hazel_post_single_socials').closest('.option').fadeIn(500);
		else jQuery('#hazel_post_single_socials').closest('.option').fadeOut(500);
	});
	
	//General > Projects > Open|Close Cats
	var _default_enable_open_close_categories = jQuery('#hazel_enable_open_close_categories').val();
	if (_default_enable_open_close_categories === "on"){
		jQuery('#hazel_categories_initial_state').closest('.option').fadeIn(500).removeClass('optoff');
	} else {
		jQuery('#hazel_categories_initial_state').closest('.option').fadeOut(500).addClass('optoff');
	}
	jQuery('#hazel_enable_open_close_categories').change(function(e){
		var _default_enable_open_close_categories = jQuery('#hazel_enable_open_close_categories').val();
		if (_default_enable_open_close_categories === "on"){
			jQuery('#hazel_categories_initial_state').closest('.option').fadeIn(500).removeClass('optoff');
		} else {
			jQuery('#hazel_categories_initial_state').closest('.option').fadeOut(500).addClass('optoff');
		}	
	});
	
	//FOOTER RIGHT CONTENT OPTIONS
	var _default_footer_right = jQuery('#hazel_footer_right_content').val();
	if (_default_footer_right === "text"){
		jQuery('#hazel_footer_right_text').parent('.option').fadeIn(500);
	} else {
		jQuery('#hazel_footer_right_text').parent('.option').fadeOut(500);
	}
	jQuery('#hazel_footer_right_content').change(function(e){
		if (_default_footer_right === "text"){
			jQuery('#hazel_footer_right_text').parent('.option').fadeIn(500);
		} else {
			jQuery('#hazel_footer_right_text').parent('.option').fadeOut(500);
		}	
	});
	
	var tp_cols_default = jQuery('#hazel_toppanel_number_cols').val();	  
 	if(tp_cols_default == "three"){
 		jQuery("#hazel_toppanel_columns_order").closest('.option').fadeIn(500);
 		jQuery("#hazel_toppanel_columns_order_four").closest('.option').fadeOut(500);
 	} else if (tp_cols_default == "four"){
 		jQuery("#hazel_toppanel_columns_order_four").closest('.option').fadeIn(500);
 		jQuery("#hazel_toppanel_columns_order").closest('.option').fadeOut(500);
 	} else {
 		jQuery("#hazel_toppanel_columns_order").closest('.option').fadeOut(500);
 		jQuery("#hazel_toppanel_columns_order_four").closest('.option').fadeOut(500);
 	}
 	
	jQuery('#hazel_toppanel_number_cols').change(function(e){
		if(tp_cols_default == "three"){
	 		jQuery("#hazel_toppanel_columns_order").closest('.option').fadeIn(500);
	 		jQuery("#hazel_toppanel_columns_order_four").closest('.option').fadeOut(500);
	 	} else if (tp_cols_default == "four"){
	 		jQuery("#hazel_toppanel_columns_order_four").closest('.option').fadeIn(500);
	 		jQuery("#hazel_toppanel_columns_order").closest('.option').fadeOut(500);
	 	} else {
	 		jQuery("#hazel_toppanel_columns_order").closest('.option').fadeOut(500);
	 		jQuery("#hazel_toppanel_columns_order_four").closest('.option').fadeOut(500);
	 	}
 	});
 	
 	//WIDGETS AREA
	var _default_widgets_area = jQuery('#hazel_enable_widgets_area').val();
	var indexWidget = parseInt(jQuery('#hazel_enable_widgets_area').parents('.option').index(),10);
	if (_default_widgets_area === "on"){
		for (var i=1; i<4; i++){
			jQuery('#hazel_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeIn(500);	
		}
		jQuery('#hazel_toppanel_number_cols').change();
	} else {
		for (var i=1; i<4; i++){
			jQuery('#hazel_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeOut(500);	
		}
	}
	jQuery('#hazel_enable_widgets_area').change(function(e){
		if (_default_widgets_area === "on"){
			for (var i=1; i<4; i++){
				jQuery('#hazel_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeIn(500);	
			}
			jQuery('#hazel_toppanel_number_cols').change();
		} else {
			for (var i=1; i<4; i++){
				jQuery('#hazel_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeOut(500);	
			}
		}
	});
	
	//breadcrumbs
	var _default_breadcrumbs = jQuery('#hazel_breadcrumbs').val();
	if (_default_breadcrumbs === "on"){
		jQuery('#hazel_breadcrumbs').closest('.option').nextAll().fadeIn(500);
	} else {
		jQuery('#hazel_breadcrumbs').closest('.option').nextAll().fadeOut(500);
	}
	jQuery('#hazel_breadcrumbs').change(function(e){
		if (_default_breadcrumbs === "on"){
			jQuery('#hazel_breadcrumbs').closest('.option').nextAll().fadeIn(500);
		} else {
			jQuery('#hazel_breadcrumbs').closest('.option').nextAll().fadeOut(500);
		}
	});
	
	//pagetitle
	var _default_hide_pagetitle = jQuery('#hazel_hide_pagetitle').val();
	if (_default_hide_pagetitle === "on"){
		jQuery('#hazel_hide_pagetitle').closest('.option').nextUntil(jQuery('#hazel_hide_pagetitle').closest('.option').next().next().next().next().next()).fadeIn(500);
	} else {
		jQuery('#hazel_hide_pagetitle').closest('.option').nextUntil(jQuery('#hazel_hide_pagetitle').closest('.option').next().next().next().next().next()).fadeOut(500);
	}
	jQuery('#hazel_hide_pagetitle').change(function(e){
		if (_default_hide_pagetitle === "on"){
			jQuery('#hazel_hide_pagetitle').closest('.option').nextUntil(jQuery('#hazel_hide_pagetitle').closest('.option').next().next().next().next().next()).fadeIn(500);
		} else {
			jQuery('#hazel_hide_pagetitle').closest('.option').nextUntil(jQuery('#hazel_hide_pagetitle').closest('.option').next().next().next().next().next()).fadeOut(500);
		}		
	});
	
	//secondary title 
	var _default_hide_sec_pagetitle = jQuery('#hazel_hide_sec_pagetitle').val();
	if (_default_hide_sec_pagetitle === "on"){
		jQuery('#hazel_hide_sec_pagetitle').closest('.option').nextUntil(jQuery('#hazel_hide_sec_pagetitle').closest('.option').next().next().next().next().next()).fadeIn(500);
	} else {
		jQuery('#hazel_hide_sec_pagetitle').closest('.option').nextUntil(jQuery('#hazel_hide_sec_pagetitle').closest('.option').next().next().next().next().next()).fadeOut(500);
	}
	jQuery('#hazel_hide_sec_pagetitle').change(function(e){
		if (_default_hide_sec_pagetitle === "on"){
			jQuery('#hazel_hide_sec_pagetitle').closest('.option').nextUntil(jQuery('#hazel_hide_sec_pagetitle').closest('.option').next().next().next().next().next()).fadeIn(500);
		} else {
			jQuery('#hazel_hide_sec_pagetitle').closest('.option').nextUntil(jQuery('#hazel_hide_sec_pagetitle').closest('.option').next().next().next().next().next()).fadeOut(500);
		}		
	});
	
	
	
	//breadcrumbs
	var _default_breadcrumbs_shop = jQuery('#hazel_breadcrumbs_shop').val();
	if (_default_breadcrumbs_shop === "on"){
		jQuery('#hazel_breadcrumbs_shop').closest('.option').nextAll().fadeIn(500);
	} else {
		jQuery('#hazel_breadcrumbs_shop').closest('.option').nextAll().fadeOut(500);
	}
	jQuery('#hazel_breadcrumbs_shop').change(function(e){
		if (_default_breadcrumbs_shop === "on"){
			jQuery('#hazel_breadcrumbs_shop').closest('.option').nextAll().fadeIn(500);
		} else {
			jQuery('#hazel_breadcrumbs_shop').closest('.option').nextAll().fadeOut(500);
		}
	});
	
	//pagetitle
	var _default_hide_pagetitle_shop = jQuery('#hazel_hide_pagetitle_shop').val();
	if (_default_hide_pagetitle_shop === "on"){
		jQuery('#hazel_hide_pagetitle_shop').closest('.option').nextUntil(jQuery('#hazel_hide_pagetitle_shop').closest('.option').next().next().next().next().next()).fadeIn(500);
	} else {
		jQuery('#hazel_hide_pagetitle_shop').closest('.option').nextUntil(jQuery('#hazel_hide_pagetitle_shop').closest('.option').next().next().next().next().next()).fadeOut(500);
	}
	jQuery('#hazel_hide_pagetitle_shop').change(function(e){
		if (_default_hide_pagetitle_shop === "on"){
			jQuery('#hazel_hide_pagetitle_shop').closest('.option').nextUntil(jQuery('#hazel_hide_pagetitle_shop').closest('.option').next().next().next().next().next()).fadeIn(500);
		} else {
			jQuery('#hazel_hide_pagetitle_shop').closest('.option').nextUntil(jQuery('#hazel_hide_pagetitle_shop').closest('.option').next().next().next().next().next()).fadeOut(500);
		}		
	});
	
	//secondary title 
	var _default_hide_sec_pagetitle_shop = jQuery('#hazel_hide_sec_pagetitle_shop').val();
	if (_default_hide_sec_pagetitle_shop === "on"){
		jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').nextUntil(jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').next().next().next().next().next()).fadeIn(500);
	} else {
		jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').nextUntil(jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').next().next().next().next().next()).fadeOut(500);
	}
	jQuery('#hazel_hide_sec_pagetitle_shop').change(function(e){
		if (_default_hide_sec_pagetitle_shop === "on"){
			jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').nextUntil(jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').next().next().next().next().next()).fadeIn(500);
		} else {
			jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').nextUntil(jQuery('#hazel_hide_sec_pagetitle_shop').closest('.option').next().next().next().next().next()).fadeOut(500);
		}		
	});
	
	
	
	//pagetitle shadow
	var _default_page_title_shadow = jQuery('#hazel_page_title_shadow').val();
	if (_default_page_title_shadow === "on"){
		jQuery('#hazel_page_title_shadow').closest('.option').next().fadeIn(500);
	} else {
		jQuery('#hazel_page_title_shadow').closest('.option').next().fadeOut(500);
	}
	jQuery('#hazel_page_title_shadow').change(function(e){
		if (_default_page_title_shadow === "on"){
			jQuery('#hazel_page_title_shadow').closest('.option').next().fadeIn(500);
		} else {
			jQuery('#hazel_page_title_shadow').closest('.option').next().fadeOut(500);
		}
	});
	
  	//SOCIAL ICONS 
  	var _default_enable_socials = jQuery('#hazel_enable_socials').val();
  	if (_default_enable_socials === "on"){
		jQuery('#hazel_enable_socials').parents('.option').find('~ .option').each(function(){
			jQuery(this).fadeIn(500);
		});
  	} else {
	  	jQuery('#hazel_enable_socials').parents('.option').find('~ .option').each(function(){
			jQuery(this).fadeOut(500);
		});
  	}
	jQuery('#hazel_enable_socials').change(function(e){
		var _default_enable_socials = jQuery('#hazel_enable_socials').val();
	  	if (_default_enable_socials === "on"){
			jQuery('#hazel_enable_socials').parents('.option').find('~ .option').each(function(){
				jQuery(this).fadeIn(500);
			});
	  	} else {
		  	jQuery('#hazel_enable_socials').parents('.option').find('~ .option').each(function(){
				jQuery(this).fadeOut(500);
			});
	  	}
	});

	// TOP PANEL & SOCIAL BAR MAMBO JAMBO
	var _default_top_panel = jQuery('#hazel_enable_top_panel').val();
	if (_default_top_panel === "on"){
		for (var i=jQuery('#hazel_enable_top_panel').closest('.option').index()+1; i< jQuery('#hazel_toppanel_headingscolor').closest('.option').index()+1; i++){
			if (!jQuery('#tab_navigation-1-header').children().eq(i).hasClass('optoff')) jQuery('#tab_navigation-2-header').children().eq(i).fadeIn(500);
		}
	} else {
		for (var i=jQuery('#hazel_enable_top_panel').closest('.option').index()+1; i< jQuery('#hazel_toppanel_headingscolor').closest('.option').index()+1; i++){
			jQuery('#tab_navigation-1-header').children().eq(i).fadeOut(500);
		}
  	}
	jQuery('#hazel_enable_top_panel').change(function(e){
	  	if (_default_top_panel === "on"){
			for (var i=jQuery('#hazel_enable_top_panel').closest('.option').index()+1; i< jQuery('#hazel_toppanel_headingscolor').closest('.option').index()+1; i++){
				if (!jQuery('#tab_navigation-1-header').children().eq(i).hasClass('optoff')) jQuery('#tab_navigation-1-header').children().eq(i).fadeIn(500);
			}
		} else {
			for (var i=jQuery('#hazel_enable_top_panel').closest('.option').index()+1; i< jQuery('#hazel_toppanel_headingscolor').closest('.option').index()+1; i++){
				jQuery('#tab_navigation-1-header').children().eq(i).fadeOut(500);
			}
	  	}
	});
	
	
	//suggested colors
	jQuery('#tab_navigation-1-general a.style-box').each(function(){
		jQuery(this).click(function(){
			jQuery('#hazel_style_color')
				.attr('value',jQuery(this).attr('title'))
				.siblings('.color-preview').css('background-color', '#'+jQuery(this).attr('title'));
		});
	});
	
	jQuery('.styles-holder a.style-box[title='+jQuery('#hazel_style_color').val()+']').closest('.option').addClass('selected-style');
	
  	// 404
	var def_notfound = jQuery('#hazel_404_error_image').val();
	if (def_notfound == "off")	
		jQuery('#hazel_404_error_image_url').closest('.option').fadeOut(500);
	else
		jQuery('#hazel_404_error_image_url').closest('.option').fadeIn(500);

	jQuery('#hazel_404_error_image').change(function(e){
		if (def_notfound == "off")	
			jQuery('#hazel_404_error_image_url').closest('.option').fadeOut(500);
		else
			jQuery('#hazel_404_error_image_url').closest('.option').fadeIn(500);
 	});
 	
 	//HOMEPAGE LAYOUT
 	jQuery("#hazel_homepage_static_image_url").closest('.option').fadeOut(500);
 	
 	
 	//FOOTER
 	var cols_default  = jQuery('#hazel_footer_number_cols').val();
	switch(cols_default){
		case "one": case "two":
	 		jQuery("#hazel_footer_columns_order").closest('.option').fadeOut(500);
	 		jQuery("#hazel_footer_columns_order_four").closest('.option').fadeOut(500);				
		break;
		case "three":
			jQuery("#hazel_footer_columns_order").closest('.option').fadeIn(500);
			jQuery("#hazel_footer_columns_order_four").closest('.option').fadeOut(500);
		break;
		case "four":
			jQuery("#hazel_footer_columns_order_four").closest('.option').fadeIn(500);
			jQuery("#hazel_footer_columns_order").closest('.option').fadeOut(500);	
		break;
	}
	 	
	jQuery('#hazel_footer_number_cols').change(function(e){
		switch(cols_default){
			case "one": case "two":
		 		jQuery("#hazel_footer_columns_order").closest('.option').fadeOut(500);
		 		jQuery("#hazel_footer_columns_order_four").closest('.option').fadeOut(500);				
			break;
			case "three":
				jQuery("#hazel_footer_columns_order").closest('.option').fadeIn(500);
				jQuery("#hazel_footer_columns_order_four").closest('.option').fadeOut(500);
			break;
			case "four":
				jQuery("#hazel_footer_columns_order_four").closest('.option').fadeIn(500);
				jQuery("#hazel_footer_columns_order").closest('.option').fadeOut(500);	
			break;
		}
 	});
  

	
  var _default_after_scroll_header = jQuery('#hazel_header_after_scroll').val();
  if (_default_after_scroll_header == 'on'){
	  jQuery('#hazel_header_shrink_effect').closest('.option').prev().andSelf()
	  	.add(jQuery('#hazel_header_after_scroll_style_light_dark').closest('.option'))
	  .fadeIn(500);
  } else {
	  jQuery('#hazel_header_shrink_effect').closest('.option').prev().andSelf()
	  	.add(jQuery('#hazel_header_after_scroll_style_light_dark').closest('.option'))
	  .fadeOut(500);
  }
  jQuery('#hazel_header_after_scroll').change(function(){
	  if (_default_after_scroll_header == 'on'){
		  jQuery('#hazel_header_shrink_effect').closest('.option').prev().andSelf()
		  	.add(jQuery('#hazel_header_after_scroll_style_light_dark').closest('.option'))
		  .fadeIn(500);
	  } else {
		  jQuery('#hazel_header_shrink_effect').closest('.option').prev().andSelf()
		  	.add(jQuery('#hazel_header_after_scroll_style_light_dark').closest('.option'))
		  .fadeOut(500);
	  }
  });
  
  
  var _default_fixed_menu = jQuery('#hazel_fixed_menu').val();
  if (_default_fixed_menu == 'on'){
	  jQuery('#hazel_header_after_scroll').trigger('change').closest('.option').prev().andSelf()
  	  	.add(jQuery('#hazel_header_hide_on_start').closest('.option'))
	  	.add(jQuery('#hazel_content_to_the_top').closest('.option'))
	  	.add(jQuery('#hazel_header_after_scroll_style_light_dark').closest('.option'))
	  .fadeIn(500);
  } else {
	  jQuery('#hazel_header_after_scroll').closest('.option').prev().andSelf()
	  	.add(jQuery('#hazel_header_shrink_effect').closest('.option').prev().andSelf())
	  	.add(jQuery('#hazel_header_hide_on_start').closest('.option'))
	  	.add(jQuery('#hazel_content_to_the_top').closest('.option'))
	  	.add(jQuery('#hazel_header_after_scroll_style_light_dark').closest('.option'))
	  .fadeOut(500);  
  }
  jQuery('#hazel_fixed_menu').change(function(){
	  if (_default_fixed_menu == 'on'){
		  jQuery('#hazel_header_after_scroll').trigger('change').closest('.option').prev().andSelf()
		  	.add(jQuery('#hazel_header_hide_on_start').closest('.option'))
		  	.add(jQuery('#hazel_content_to_the_top').closest('.option'))
		  	.add(jQuery('#hazel_header_after_scroll_style_light_dark').closest('.option'))
		  .fadeIn(500);
	  } else {
		  jQuery('#hazel_header_after_scroll').closest('.option').prev().andSelf()
		  	.add(jQuery('#hazel_header_shrink_effect').closest('.option').prev().andSelf())
		  	.add(jQuery('#hazel_header_hide_on_start').closest('.option'))
		  	.add(jQuery('#hazel_content_to_the_top').closest('.option'))
		  	.add(jQuery('#hazel_header_after_scroll_style_light_dark').closest('.option'))
		  .fadeOut(500);  
	  }	  
  });
  
  //show primary footer options
	var _default_show_primary_footer = jQuery('#hazel_show_primary_footer').val();
	jQuery('#hazel_show_primary_footer').change(function(){
		if (_default_show_primary_footer === "on"){
			jQuery('#hazel_show_primary_footer').closest('.option').nextUntil(jQuery('#hazel_footerbg_headingscolor').closest('.option').next()).fadeIn(500);
			jQuery('#hazel_footerbg_type').trigger('change');
		} else {
			jQuery('#hazel_show_primary_footer').closest('.option').nextUntil(jQuery('#hazel_footerbg_headingscolor').closest('.option').next()).fadeOut(500);
		}
	}).trigger('change');
	
	//show secondary footer options
	var _default_show_secondary_footer = jQuery('#hazel_show_sec_footer').val();
	jQuery('#hazel_show_sec_footer').change(function(){
		if (_default_show_secondary_footer === "on"){
			jQuery('#hazel_show_sec_footer').closest('.option').nextAll().fadeIn(500);
			jQuery('#hazel_sec_footerbg_type').trigger('change');
		} else {
			jQuery('#hazel_show_sec_footer').closest('.option').nextAll().fadeOut(500);
		}
	}).trigger('change');
  
  // continuous check for changed value
  setInterval(function () {
	  
	  //custom css
	  if (jQuery('#enable_custom_css').val() != _default_custom_css){
		  _default_custom_css = jQuery('#enable_custom_css').val();
		  jQuery('#enable_custom_css').change();
	  }
	  
	if (jQuery('#hazel_menu_add_border').val() != _default_menu_add_border){
		_default_menu_add_border = jQuery('#hazel_menu_add_border').val();
		jQuery('#hazel_menu_add_border').change();
	}

  	if (jQuery('#hazel_footer_display_logo').val() != _default_footer_display_logo){
		_default_footer_display_logo = jQuery('#hazel_footer_display_logo').val();
		jQuery('#hazel_footer_display_logo').change();
	}
	
	if (jQuery('#hazel_footer_display_social_icons').val() != _default_footer_display_social_icons){
		_default_footer_display_social_icons = jQuery('#hazel_footer_display_social_icons').val();
		jQuery('#hazel_footer_display_social_icons').change();
	}
	if (jQuery('#hazel_footer_display_custom_text').val() != _default_footer_display_custom_text){
		_default_footer_display_custom_text = jQuery('#hazel_footer_display_custom_text').val();
		jQuery('#hazel_footer_display_custom_text').change();
	}
	  
	if (jQuery('#hazel_enable_theme_seo').val() != _default_seo_options){
		_default_seo_options = jQuery('#hazel_enable_theme_seo').val();
		jQuery('#hazel_enable_theme_seo').change();
	}
  

	//fixed menu
	if (jQuery('#hazel_fixed_menu').val() != _default_fixed_menu){
	  	_default_fixed_menu = jQuery('#hazel_fixed_menu').val();
	  	jQuery('#hazel_fixed_menu').change();
  	}
  	
  	//after scroll menu
  	if (jQuery('#hazel_header_after_scroll').val() != _default_after_scroll_header){
	  	_default_after_scroll_header = jQuery('#hazel_header_after_scroll').val();
	  	jQuery('#hazel_header_after_scroll').trigger('change');
  	}


	//breadcrumbs
	if (jQuery('#hazel_breadcrumbs').val() != _default_breadcrumbs){
		_default_breadcrumbs = jQuery('#hazel_breadcrumbs').val();
		jQuery('#hazel_breadcrumbs').change();
	}

	//display secondary page title
	if (jQuery('#hazel_hide_sec_pagetitle').val() != _default_hide_sec_pagetitle){
		_default_hide_sec_pagetitle = jQuery('#hazel_hide_sec_pagetitle').val();
		jQuery('#hazel_hide_sec_pagetitle').change();
	}
	
	//display page title
	if (jQuery('#hazel_hide_pagetitle').val() != _default_hide_pagetitle){
		_default_hide_pagetitle = jQuery('#hazel_hide_pagetitle').val();
		jQuery('#hazel_hide_pagetitle').change();
	}
	
	
	//breadcrumbs_shop
	if (jQuery('#hazel_breadcrumbs_shop').val() != _default_breadcrumbs_shop){
		_default_breadcrumbs_shop = jQuery('#hazel_breadcrumbs_shop').val();
		jQuery('#hazel_breadcrumbs_shop').change();
	}

	//display secondary page title
	if (jQuery('#hazel_hide_sec_pagetitle_shop').val() != _default_hide_sec_pagetitle_shop){
		_default_hide_sec_pagetitle_shop = jQuery('#hazel_hide_sec_pagetitle_shop').val();
		jQuery('#hazel_hide_sec_pagetitle_shop').change();
	}
	
	//display page title
	if (jQuery('#hazel_hide_pagetitle_shop').val() != _default_hide_pagetitle_shop){
		_default_hide_pagetitle_shop = jQuery('#hazel_hide_pagetitle_shop').val();
		jQuery('#hazel_hide_pagetitle_shop').change();
	}

	//pagetitle shadow
	if (jQuery('#hazel_page_title_shadow').val() != _default_page_title_shadow){
		_default_page_title_shadow = jQuery('#hazel_page_title_shadow').val();
		jQuery('#hazel_page_title_shadow').change();
	}

	//show secondary footer options
  	if (jQuery('#hazel_show_sec_footer').val() != _default_show_secondary_footer){
	  	_default_show_secondary_footer = jQuery('#hazel_show_sec_footer').val();
	  	jQuery('#hazel_show_sec_footer').change();
  	}
	
	//show primary footer options
  	if (jQuery('#hazel_show_primary_footer').val() != _default_show_primary_footer){
	  	_default_show_primary_footer = jQuery('#hazel_show_primary_footer').val();
	  	jQuery('#hazel_show_primary_footer').change();
  	}
  
  	
  	
  	// header type light
  	if (jQuery('#hazel_headerbg_type_light').val() != _default_headerbg_type_light){
	  	_default_headerbg_type_light = jQuery('#hazel_headerbg_type_light').val();
	  	jQuery('#hazel_headerbg_type_light').change();
  	}
  	
  	// header type dark
  	if (jQuery('#hazel_headerbg_type_dark').val() != _default_headerbg_type_dark){
	  	_default_headerbg_type_dark = jQuery('#hazel_headerbg_type_dark').val();
	  	jQuery('#hazel_headerbg_type_dark').change();
  	}
  	
  	// header after scroll type light
  	if (jQuery('#hazel_headerbg_after_scroll_type_light').val() != _default_headerbg_after_scroll_type_light){
	  	_default_headerbg_after_scroll_type_light = jQuery('#hazel_headerbg_after_scroll_type_light').val();
	  	jQuery('#hazel_headerbg_after_scroll_type_light').change();
  	}
  	
  	// header after scroll type dark
  	if (jQuery('#hazel_headerbg_after_scroll_type_dark').val() != _default_headerbg_after_scroll_type_dark){
	  	_default_headerbg_after_scroll_type_dark = jQuery('#hazel_headerbg_after_scroll_type_dark').val();
	  	jQuery('#hazel_headerbg_after_scroll_type_dark').change();
  	}

  	// show header & top contents type
  	if (jQuery('#hazel_toppanelbg_type').val() != _default_toppanelbg_type){
	  	_default_toppanelbg_type = jQuery('#hazel_toppanelbg_type').val();
	  	jQuery('#hazel_toppanelbg_type').change();
  	}
  	
  	// secondary footer type opts
  	if (jQuery('#hazel_sec_footerbg_type').val() != _default_sec_footerbg_type){
	  	_default_sec_footerbg_type = jQuery('#hazel_sec_footerbg_type').val();
	  	jQuery('#hazel_sec_footerbg_type').change();
  	}
  	
  	// primary footer type opts
  	if (jQuery('#hazel_footerbg_type').val() != _default_footerbg_type){
	  	_default_footerbg_type = jQuery('#hazel_footerbg_type').val();
	  	jQuery('#hazel_footerbg_type').change();
  	}
  	
  	
  	
  	// thumbails animate
  	if (jQuery('#hazel_animate_thumbnails').val() != _default_animate_thumbnails){
	  	_default_animate_thumbnails = jQuery('#hazel_animate_thumbnails').val();
	  	jQuery('#hazel_animate_thumbnails').change();
  	}
  	
  	//body shadow
  	if (jQuery('#hazel_body_shadow').val() != _default_body_shadow){
	  	_default_body_shadow = jQuery('#hazel_body_shadow').val();
	  	jQuery('#hazel_body_shadow').change();
  	}
  
  	//body background type
  	if (jQuery('#hazel_body_type').val() != _default_body_background){
	  	_default_body_background = jQuery('#hazel_body_type').val();
	  	jQuery('#hazel_body_type').change();
  	}
  
  	//body layout page
  	if (jQuery('#hazel_body_layout_type').val() != _default_body_layout_type){
	  	_default_body_layout_type = jQuery('#hazel_body_layout_type').val();
	  	jQuery('#hazel_body_layout_type').change();
  	}
  
  	//header background type
  	if (jQuery('#hazel_header_type').val() != _default_header_bkg){
	  	_default_header_bkg = jQuery('#hazel_header_type').val();
	  	jQuery('#hazel_header_type').change();
  	}
  	
  	//header background type _shop
  	if (jQuery('#hazel_header_type_shop').val() != _default_header_bkg_shop){
	  	_default_header_bkg_shop = jQuery('#hazel_header_type_shop').val();
	  	jQuery('#hazel_header_type_shop').change();
  	}
  
  	//google fonts
  	if (jQuery('#hazel_enable_google_fonts').val() != _default_google_fonts){
	  	_default_google_fonts = jQuery('#hazel_enable_google_fonts').val();
	  	jQuery('#hazel_enable_google_fonts').change();
  	}
  
  	//projects enlarge pics
  	if (jQuery('#hazel_single_layout').val() != _default_proj_layout){
	 	_default_proj_layout = jQuery('#hazel_single_layout').val();
	 	jQuery('#hazel_single_layout').change();
  	}
  	
  	//projects open|close
  	if (jQuery('#hazel_enable_open_close_categories').val() != _default_enable_open_close_categories){
	 	_default_enable_open_close_categories = jQuery('#hazel_enable_open_close_categories').val();
	 	jQuery('#hazel_enable_open_close_categories').change();
  	}
  
  	//FOOTER RIGHT CONTENT
    if (jQuery('#hazel_footer_right_content').val() != _default_footer_right){
	    _default_footer_right = jQuery('#hazel_footer_right_content').val();
	    jQuery('#hazel_footer_right_content').change();
    }
    
    //TOPPANEL
    if ( jQuery('#hazel_enable_top_panel').val() != _default_top_panel ) {
    	_default_top_panel = jQuery('#hazel_enable_top_panel').val();
		jQuery('#hazel_enable_top_panel').change();    
    }
    
    //WIDGETS AREA
    if (jQuery('#hazel_enable_widgets_area').val() != _default_widgets_area){
	    _default_widgets_area = jQuery('#hazel_enable_widgets_area').val();
	    jQuery('#hazel_enable_widgets_area').change();
    }
    
    //SOCIAL ICONS
    if (jQuery('#hazel_enable_socials').val() != _default_enable_socials){
	    _default_enable_socials = jQuery('#hazel_enable_socials').val();
	    jQuery('#hazel_enable_socials').change();
    }
    
    //404
    if (jQuery('#hazel_404_error_image').val() != def_notfound){
		def_notfound = jQuery('#hazel_404_error_image').val();
		jQuery('#hazel_404_error_image').change();
    }
    
    //SIDEBAR
    if (jQuery('#sidebar_name_list').html() != def_sidebars){
	    var sidebars = "";
	    jQuery('#sidebar_name_list li').each(function(){
		    sidebars += jQuery(this).children('span').html()+"|*|";
	    });
	    jQuery('input#hazel_sidebar_name_names').val(sidebars);
	    def_sidebars = jQuery('#sidebar_name_list').html();
    }
    
    //FOOTER
    if ( jQuery('#hazel_footer_number_cols').val() != cols_default ) {
    	cols_default  = jQuery('#hazel_footer_number_cols').val();
		jQuery('#hazel_footer_number_cols').change();    
    }
    
    //TOP PANEL
    if ( jQuery('#hazel_toppanel_number_cols').val() != tp_cols_default ) {
    	tp_cols_default  = jQuery('#hazel_toppanel_number_cols').val();
		jQuery('#hazel_toppanel_number_cols').change();  
    }
    
    if (jQuery('#hazel_enable_ajax_search').val() != _default_ajax_search){
	    _default_ajax_search = jQuery('#hazel_enable_ajax_search').val();
	    jQuery('#hazel_enable_ajax_search').change();
    }
    
    if (jQuery('#hazel_enable_search').val() != _default_search){
	 	_default_search = jQuery('#hazel_enable_search').val();
	 	jQuery('#hazel_enable_search').change();
    }
   
    
    if (jQuery('#hazel_pagetitle_image_overlay').val() != _default_overlay_enable){
	    _default_overlay_enable = jQuery('#hazel_pagetitle_image_overlay').val();
	    jQuery('#hazel_pagetitle_image_overlay').change();
    }
    
    if (jQuery('#hazel_pagetitle_image_overlay_shop').val() != _default_overlay_enable_shop){
	    _default_overlay_enable_shop = jQuery('#hazel_pagetitle_image_overlay_shop').val();
	    jQuery('#hazel_pagetitle_image_overlay_shop').change();
    }
        
    if (jQuery('#hazel_pagetitle_overlay_type').val() != _default_overlay_type){
	    _default_overlay_type = jQuery('#hazel_pagetitle_overlay_type').val();
	    jQuery('#hazel_pagetitle_overlay_type').change();
    }
    
    if (jQuery('#hazel_pagetitle_overlay_type_shop').val() != _default_overlay_type_shop){
	    _default_overlay_type_shop = jQuery('#hazel_pagetitle_overlay_type_shop').val();
	    jQuery('#hazel_pagetitle_overlay_type_shop').change();
    }
    
    //project single socials
	if (jQuery('#hazel_project_single_social_shares').val() != _default_project_single_social){
		_default_project_single_social = jQuery('#hazel_project_single_social_shares').val();
		jQuery('#hazel_project_single_social_shares').change();
	}
	
	//post single socials
	if (jQuery('#hazel_post_single_social_shares').val() != _default_post_single_social){
		_default_post_single_social = jQuery('#hazel_post_single_social_shares').val();
		jQuery('#hazel_post_single_social_shares').change();
	}
    
  }, 1000);

});
