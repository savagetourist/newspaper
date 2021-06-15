<?php
	
	/**
	 * Load the patterns into arrays.
	 */
	$patterns=array();
	$patterns[0]='none';
	for($i=1; $i<=10; $i++){
		$patterns[]='pattern'.$i.'.jpg';
	}
	
	$hazel_fonts_array = hazel_fonts_array_builder();
	
	$hazel_style_general_options= array( array(
		"name" => "Footer",
		"type" => "title",
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"style-footer", "name"=>"Footer"))
	),
	
	/* ------------------------------------------------------------------------*
	 * FOOTER
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id" => 'style-footer'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h3>Primary Footer</h3>'
	),
	
	array(
		"name" => "Show Primary Footer?",
		"id" => "hazel_show_primary_footer",
		"type" => "checkbox",
		"std" => 'off'
	),
	
	array(
		"name" => "Background Type",
		"id" => "hazel_footerbg_type",
		"type" => "select",
		"options" => array(array('id'=>'color','name'=>'Color'), array('id'=>'image','name'=>'Image'), array('id'=>'pattern','name'=>'Pattern'), array('id'=>'custom_pattern','name'=>'Custom Pattern')),
		"std" => 'color'
	),
	
	array(
		"name" => "Image",
		"id" => "hazel_footerbg_image",
		"type" => "upload_from_media",
		"desc" => 'Here you can choose the image for your footer.'
	),
	
	array(
		"name" => "Color",
		"id" => "hazel_footerbg_color",
		"type" => "color",
		"std" => '191919'
	),
	
	array(
		"name" => "Background Opacity",
		"id" => "hazel_footerbg_color_opacity",
		"type" => "opacity_slider",
		"std" => "100"
	),
	
	array(
		"name" => "Pattern",
		"id" => "hazel_footerbg_pattern",
		"type" => "pattern",
		"options" => $patterns,
		"desc" => 'Here you can choose the pattern for your footer.'
	),
	
	array(
		"name" => "Custom Pattern",
		"id" => "hazel_footerbg_custom_pattern",
		"type" => "upload_from_media",
		"desc" => 'Here you can choose the custom pattern for your footer. It will replace the pattern you choose above.'
	),
	
	array(
		"name" => "Borders Color",
		"id" => "hazel_footerbg_borderscolor",
		"type" => "color",
		"std" => '191919'
	),
	
	array(
		"name" => "Padding Top",
		"id" => "hazel_primary_footer_padding_top",
		"type" => "text",
		"std" => "80px"
	),
	
	array(
		"name" => "Padding Bottom",
		"id" => "hazel_primary_footer_padding_bottom",
		"type" => "text",
		"std" => "80px"
	),
	
	array(
		"type" => "documentation",
		"text" => '<h3>Primary Footer - Text Colors</h3>'
	),
	
	array(
		"name" => "Links Color",
		"id" => "hazel_footerbg_linkscolor",
		"type" => "color",
		"std" => 'ACACAD'
	),
	
	array(
		"name" => "Paragraphs Color",
		"id" => "hazel_footerbg_paragraphscolor",
		"type" => "color",
		"std" => '999999'
	),
	
	array(
		"name" => "Headings Color",
		"id" => "hazel_footerbg_headingscolor",
		"type" => "color",
		"std" => 'ffffff'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h3>Secondary Footer</h3>'
	),
	
	array(
		"name" => "Show Secondary Footer?",
		"id" => "hazel_show_sec_footer",
		"type" => "checkbox",
		"std" => 'on'
	),
	
	array(
		"name" => "Background Type",
		"id" => "hazel_sec_footerbg_type",
		"type" => "select",
		"options" => array(array('id'=>'color','name'=>'Color'), array('id'=>'image','name'=>'Image'), array('id'=>'pattern','name'=>'Pattern'), array('id'=>'custom_pattern','name'=>'Custom Pattern')),
		"std" => 'color'
	),
	
	array(
		"name" => "Image",
		"id" => "hazel_sec_footerbg_image",
		"type" => "upload_from_media",
		"desc" => 'Here you can choose the image for your footer.'
	),
	
	array(
		"name" => "Color",
		"id" => "hazel_sec_footerbg_color",
		"type" => "color",
		"std" => '101010'
	),
	
	array(
		"name" => "Background Opacity",
		"id" => "hazel_sec_footerbg_color_opacity",
		"type" => "opacity_slider",
		"std" => "100"
	),
	
	array(
		"name" => "Pattern",
		"id" => "hazel_sec_footerbg_pattern",
		"type" => "pattern",
		"options" => $patterns,
		"desc" => 'Here you can choose the pattern for your footer.'
	),
	
	array(
		"name" => "Custom Pattern",
		"id" => "hazel_sec_footerbg_custom_pattern",
		"type" => "upload_from_media",
		"desc" => 'Here you can choose the custom pattern for your footer. It will replace the pattern you choose above.'
	),
	
	array(
		"name" => "Padding Top",
		"id" => "hazel_secondary_footer_padding_top",
		"type" => "text",
		"std" => "80px"
	),
	
	array(
		"name" => "Padding Bottom",
		"id" => "hazel_secondary_footer_padding_bottom",
		"type" => "text",
		"std" => "80px"
	),
	
	array(
		"name" => "Social Icons Size",
		"id" => "hazel_sec_footer_social_icons_size",
		"type" => "text",
		"std" => "20px"
	),
	
	array(
		"name" => "Social Icons Color",
		"id" => "hazel_sec_footer_social_icons_color",
		"type" => "color",
		"std" => "333333"
	),
	
	array(
		"name" => "Social Icons Hover Color",
		"id" => "hazel_sec_footer_social_icons_hover_color",
		"type" => "color",
		"std" => "d8d8d8"
	),
	
	array(
		"type" => "close"
	),

	
	/*close array*/
	
	array(
		"type" => "close"
	));
	
	hazel_add_style_options($hazel_style_general_options);
	
?>
