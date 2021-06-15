<?php
	
	$hazel_fonts_array = hazel_fonts_array_builder();
	
	$hazel_style_general_options= array( array(
		"name" => "Website Loading",
		"type" => "title"
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"website_loading", "name"=>"Website Loading"))
	),
	
	/* ------------------------------------------------------------------------*
	 * WEBSITE LOADING
	 * ------------------------------------------------------------------------*/
	array(
		"type" => "subtitle",
		"id" => 'website_loading'
	),
	
	array(
		"type" => "documentation",
		"text" => '<h3>Website Loading</h3>'
	),
	
	array(
		"name" => "Background Color",
		"id" => "hazel_loader_background",
		"type" => "color",
		"std" => "ffffff"
	),
	
	array(
		"name" => "Loader Color",
		"id" => "hazel_loader_color",
		"type" => "color",
		"std" => "d8d8d8"
	),
	
	array(
		"name" => "Percentage Font",
		"id" => "hazel_loader_percentage_font",
		"type" => "select",
		"options" => $hazel_fonts_array,
		"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).',
		"std" => "Helvetica Neue"
	),
	
	array(
		"name" => "Percentage Font Size",
		"id" => "hazel_loader_percentage_font_size",
		"type" => "slider",
		"std" => "13px",
	),
	
	array(
		"name" => "Percentage Font Color",
		"id" => "hazel_loader_percentage_font_color",
		"type" => "color",
		"std" => "d8d8d8"
	),
	
	array(
		"type" => "close"
	),
	
	array(
		"type" => "close"
	));
	
	hazel_add_style_options($hazel_style_general_options);
	
?>