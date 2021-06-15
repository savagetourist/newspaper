<?php
	
	$hazel_fonts_array = hazel_fonts_array_builder();
	
	$hazel_style_general_options= array( array(
		"name" => "Menus",
		"type" => "title",
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"light-top-menu", "name"=>"Top Menu Items Light"), array("id"=>"dark-top-menu", "name"=>"Top Menu Items Dark"), array("id"=>"sub-items", "name"=>"Sub Menu Items"))
	),
	
	/* ------------------------------------------------------------------------*
	 * MENU OPTIONS
	 * ------------------------------------------------------------------------*/
	
	
	
	array(
		"type" => "subtitle",
		"id"=>'light-top-menu'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h3>Top Menu Items Light</h3>'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h5>PRE-SCROLL</h5>'
	),
	
	array(
		"name" => "Font",
		"id" => "hazel_menu_font_pre_light",
		"type" => "select",
		"options" => $hazel_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "hazel_menu_color_pre_light",
		"type" => "color",
		"std" => "808080"
	),
	
	array(
		"name" => "Font Color Hover",
		"id" => "hazel_menu_color_hover_pre_light",
		"type" => "color",
		"std" => "a5a5a5"
	),
	
	array(
		"name" => "Font Size",
		"id" => "hazel_menu_font_size_pre_light",
		"type" => "slider",
		"std" => "11px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "hazel_menu_uppercase_pre_light",
		"type" => "checkbox",
		"std" => "on"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "hazel_menu_letter_spacing_pre_light",
		"type" => "text",
		"std" => "3px"
	),
	
	array(
		"name" => "Add Border ?",
		"id" => "hazel_menu_add_border_pre_light",
		"type" =>"checkbox",
		"std" => "off"
	),
	
	array(
		"name"=>"Border Color",
		"id" => "hazel_menu_border_color_pre_light",
		"type" => "color",
		"std" => "000000"
	),
	
	array(
		"name" => "Menu Side Margin",
		"id" => "hazel_menu_side_margin_pre_light",
		"type" => "slider",
		"std" => "20px"
	),
	
	array(
		"name" => "Menu Margin Top",
		"id" => "hazel_menu_margin_top_pre_light",
		"type" => "text",
		"std" => "25px"
	),
	
	
	array(
		"name" => "Menu Padding Bottom",
		"id" => "hazel_menu_padding_bottom_pre_light",
		"type" => "text",
		"std" => "25px"
	),
	
	array(
		"type" => "documentation",
		"text" => '<h5>AFTER-SCROLL</h5>'
	),
	
	array(
		"name" => "Font",
		"id" => "hazel_menu_font_after_light",
		"type" => "select",
		"options" => $hazel_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "hazel_menu_color_after_light",
		"type" => "color",
		"std" => "808080"
	),
	
	array(
		"name" => "Font Color Hover",
		"id" => "hazel_menu_color_hover_after_light",
		"type" => "color",
		"std" => "a5a5a5"
	),
	
	array(
		"name" => "Font Size",
		"id" => "hazel_menu_font_size_after_light",
		"type" => "slider",
		"std" => "11px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "hazel_menu_uppercase_after_light",
		"type" => "checkbox",
		"std" => "on"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "hazel_menu_letter_spacing_after_light",
		"type" => "text",
		"std" => "3px"
	),
	
	array(
		"name" => "Add Border ?",
		"id" => "hazel_menu_add_border_after_light",
		"type" =>"checkbox",
		"std" => "off"
	),
	
	array(
		"name"=>"Border Color",
		"id" => "hazel_menu_border_color_after_light",
		"type" => "color",
		"std" => "000000"
	),
	
	array(
		"name" => "Menu Side Margin",
		"id" => "hazel_menu_side_margin_after_light",
		"type" => "slider",
		"std" => "20px"
	),
	
	array(
		"name" => "Menu Margin Top",
		"id" => "hazel_menu_margin_top_after_light",
		"type" => "text",
		"std" => "15px"
	),
	
	
	array(
		"name" => "Menu Padding Bottom",
		"id" => "hazel_menu_padding_bottom_after_light",
		"type" => "text",
		"std" => "15px"
	),

	array("type"=>"close"),
	
	array(
		"type" => "subtitle",
		"id"=>'dark-top-menu'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h3>Top Menu Items Dark</h3>'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h5>PRE-SCROLL</h5>'
	),
	
	array(
		"name" => "Font",
		"id" => "hazel_menu_font_pre_dark",
		"type" => "select",
		"options" => $hazel_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "hazel_menu_color_pre_dark",
		"type" => "color",
		"std" => "444444"
	),
	
	array(
		"name" => "Font Color Hover",
		"id" => "hazel_menu_color_hover_pre_dark",
		"type" => "color",
		"std" => "a5a5a5"
	),
	
	array(
		"name" => "Font Size",
		"id" => "hazel_menu_font_size_pre_dark",
		"type" => "slider",
		"std" => "11px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "hazel_menu_uppercase_pre_dark",
		"type" => "checkbox",
		"std" => "on"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "hazel_menu_letter_spacing_pre_dark",
		"type" => "text",
		"std" => "3px"
	),
	
	array(
		"name" => "Add Border ?",
		"id" => "hazel_menu_add_border_pre_dark",
		"type" =>"checkbox",
		"std" => "off"
	),
	
	array(
		"name"=>"Border Color",
		"id" => "hazel_menu_border_color_pre_dark",
		"type" => "color",
		"std" => "000000"
	),
	
	array(
		"name" => "Menu Side Margin",
		"id" => "hazel_menu_side_margin_pre_dark",
		"type" => "slider",
		"std" => "20px"
	),
	
	array(
		"name" => "Menu Margin Top",
		"id" => "hazel_menu_margin_top_pre_dark",
		"type" => "text",
		"std" => "25px"
	),
	
	
	array(
		"name" => "Menu Padding Bottom",
		"id" => "hazel_menu_padding_bottom_pre_dark",
		"type" => "text",
		"std" => "25px"
	),
	
	array(
		"type" => "documentation",
		"text" => '<h5>AFTER-SCROLL</h5>'
	),
	
	array(
		"name" => "Font",
		"id" => "hazel_menu_font_after_dark",
		"type" => "select",
		"options" => $hazel_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "hazel_menu_color_after_dark",
		"type" => "color",
		"std" => "444444"
	),
	
	array(
		"name" => "Font Color Hover",
		"id" => "hazel_menu_color_hover_after_dark",
		"type" => "color",
		"std" => "a5a5a5"
	),
	
	array(
		"name" => "Font Size",
		"id" => "hazel_menu_font_size_after_dark",
		"type" => "slider",
		"std" => "11px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "hazel_menu_uppercase_after_dark",
		"type" => "checkbox",
		"std" => "on"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "hazel_menu_letter_spacing_after_dark",
		"type" => "text",
		"std" => "3px"
	),
	
	array(
		"name" => "Add Border ?",
		"id" => "hazel_menu_add_border_after_dark",
		"type" =>"checkbox",
		"std" => "off"
	),
	
	array(
		"name"=>"Border Color",
		"id" => "hazel_menu_border_color_after_dark",
		"type" => "color",
		"std" => "000000"
	),
	
	array(
		"name" => "Menu Side Margin",
		"id" => "hazel_menu_side_margin_after_dark",
		"type" => "slider",
		"std" => "20px"
	),
	
	array(
		"name" => "Menu Margin Top",
		"id" => "hazel_menu_margin_top_after_dark",
		"type" => "text",
		"std" => "15px"
	),
	
	
	array(
		"name" => "Menu Padding Bottom",
		"id" => "hazel_menu_padding_bottom_after_dark",
		"type" => "text",
		"std" => "15px"
	),
	
	array("type"=>"close"),
	
	array(
		"type" => "subtitle",
		"id"=>'sub-items'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h3>Sub Menu Items</h3>'
	),
		
	array(
		"name" => "Font",
		"id" => "hazel_sub_menu_font",
		"type" => "select",
		"options" => $hazel_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "hazel_sub_menu_color",
		"type" => "color",
		"std" => "333333"
	),
	
	array(
		"name" => "Font Color Hover",
		"id" => "hazel_sub_menu_color_hover",
		"type" => "color",
		"std" => "212121"
	),
	
	array(
		"name" => "Font Size",
		"id" => "hazel_sub_menu_font_size",
		"type" => "slider",
		"std" => "12px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "hazel_sub_menu_uppercase",
		"type" => "checkbox",
		"std" => "off"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "hazel_sub_menu_letter_spacing",
		"type" => "text",
		"std" => "0px"
	),
	
	
	array(
		"name" => "Background Color",
		"id" => "hazel_sub_menu_bg_color",
		"type" => "color",
		"std" => "f2f2f2"
	),
	
	array(
		"name" => "Background Opacity",
		"id" => "hazel_sub_menu_bg_opacity",
		"type" => "opacity_slider",
		"std" => "100"
	),
	
	array(
		"name" => "Background Color Hover",
		"id" => "hazel_sub_menu_bg_color_hover",
		"type" => "color",
		"std" => "ffffff"
	),
	
	array(
		"name"=>"Border Color",
		"id" => "hazel_sub_menu_border_color",
		"type" => "color",
		"std" => "ededed"
	),
	
	
	array(
		"type" => "documentation",
		"text" => '<h3>Just Label (Without Link)</h3>'
	),
	
	array(
		"name" => "Font",
		"id" => "hazel_label_menu_font",
		"type" => "select",
		"options" => $hazel_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Font Color",
		"id" => "hazel_label_menu_color",
		"type" => "color",
		"std" => "f2f2f2"
	),
	
	array(
		"name" => "Font Size",
		"id" => "hazel_label_menu_font_size",
		"type" => "slider",
		"std" => "11px",
		"desc" => "Change the size of your menu font."
	),
	
	array(
		"name" => "Text Uppercase",
		"id" => "hazel_label_menu_uppercase",
		"type" => "checkbox",
		"std" => "on"
	),
	
	array(
		"name" => "Letter Spacing",
		"id" => "hazel_label_menu_letter_spacing",
		"type" => "text",
		"std" => "3px"
	),
	
	array("type"=>"close"),

	/*close array*/
	
	array(
		"type" => "close"
	));
	
	hazel_add_style_options($hazel_style_general_options);
	
?>