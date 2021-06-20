<?php

$sides = get_option('hazel_sidebar_name_names');
if (is_string($sides)) $sides = explode(HAZEL_SEPARATOR, $sides);
$outputsidebars = array(array("id"=>"defaultblogsidebar", "name" => "Blog Sidebar"));
if (!empty($sides)){
	foreach ($sides as $s){
		if ($s != ""){
			array_push($outputsidebars, array("id"=>$s, "name"=>$s));
		}
	}	
}

$hazel_info_options= array( array(
"name" => "Header Layout",
"type" => "title",
"img" => HAZEL_IMAGES_URL."icon_home.png"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"header_layout_styles", "name"=>"Header Styles"),array("id"=>"header_layout", "name"=>"Header Options"), array("id"=>"logotype", "name" =>"Logotype"), array("id"=>"top_panel", "name"=>"Top Bar"), array("id"=>"search", "name"=>"Search"))
),

array(
"type" => "subtitle",
"id"=>'header_layout_styles'
),
array(
"type" => "documentation",
"text" => '<h3>Header Layout Style</h3>'
),

array(
	"type" => "documentation",
	"text" => '<p><b>Note:</b> After choose the header style, go to the next tab <b>Top Bar</b> and add your contents.</p>'
),



array(
	"name" => "Header Style Type",
	"id" => "hazel_header_style_type",
	"type" => "select",
	"options" => array(array('id'=>'style1', 'name'=>'Style 1'),array('id'=>'style2', 'name'=>'Style 2')),
	"std" => 'style1'
),

array(
	"type" => "close"
),



array(
"type" => "subtitle",
"id"=>'header_layout'
),


array(
	"type" => "documentation",
	"text" => '<h3>Header Style</h3>'
),

array(
	"name" => "Header Style",
	"id" => "hazel_header_style_light_dark",
	"type" => "select",
	"options" => array(array("id"=>"light","name"=>"Light (for Dark logos)"), array("id"=>"dark","name"=>"Dark (for Light logos)")),
	"desc" => "If you choose the <strong>Light Style</strong> the theme will apply the <strong>Dark</strong> logo and menu settings.<br/> If you choose the <strong>Dark Style</strong> the theme will apply the <strong>Light</strong> logo and menu settings. ",
	"std" => "light"
),

array(
	"name" => "Full width header ?",
	"id" => "hazel_header_full_width",
	"type" => "checkbox",
	"std" => "on",
	"desc" => "If set to <strong>ON</strong> the header will occupy the entire width of the browser's window."
),

array(
	"name" => "Menu Hover Line?",
	"id" => "hazel_header_hover_line",
	"type" => "checkbox",
	"std" => "off",
	"desc" => "If set to <strong>ON</strong> a line will appear on hover."
),

array(
"type" => "documentation",
"text" => '<h3>Fixed Header</h3>'
),

array(
"name" => "Fixed Header?",
"id" => "hazel_fixed_menu",
"type" => "checkbox",
"std" => "on",
"desc" => "If set to <strong>ON</strong> the header will be always visible, not only at the top of the page."
),

array(
"name" => "Hide on Start?",
"id" => "hazel_header_hide_on_start",
"type" => "checkbox",
"std" => "off",
"desc" => "If set to <strong>ON</strong> the header will appear from the top of the page after scrolling."
),

array(
	"name" => "Page Content (on multipage templates)",
	"id" => "hazel_content_to_the_top",
	"type" => "select",
	"options" => array(array("id"=>"off","name"=>"Content starts after the header"), array("id"=>"on","name"=>"Content behind the header")),
	"std" => "off"
),

array(
"type" => "documentation",
"text" => '<h3>Header After Scroll</h3>'
),

array(
"name" => "Header After Scroll?",
"id" => "hazel_header_after_scroll",
"type" => "checkbox",
"std" => "on",
"desc" => "If set to <strong>ON</strong> you will have options to style a second header to display different from the one appearing in the top of the page."
),

array(
	"name" => "Header After Scroll Style",
	"id" => "hazel_header_after_scroll_style_light_dark",
	"type" => "select",
	"options" => array(array("id"=>"light","name"=>"Light (for Dark logos)"), array("id"=>"dark","name"=>"Dark (for Light logos)")),
	"desc" => "If you choose the <strong>Light Style</strong> the theme will apply the <strong>Dark</strong> logo and menu settings.<br/> If you choose the <strong>Dark Style</strong> the theme will apply the <strong>Light</strong> logo and menu settings. ",
	"std" => "light"
),

array(
"type" => "documentation",
"text" => '<h3>Header Shrink Effect</h3>'
),

array(
"name" => "Header Shrink Effect?",
"id" => "hazel_header_shrink_effect",
"type" => "checkbox",
"std" => "on",
"desc" => "If set to <strong>ON</strong> you will be able to change the sizes of the contents (header included)."
),

array(
	"type" => "documentation",
	"text" => "<h3>Enable / Disable Woocommerce Cart</h3>"
),

array(
	"name" => "Woocommerce Cart",
	"id" => "hazel_woocommerce_cart",
	"type" => "checkbox",
	"std" => 'off',
	"desc" => "Displays the Woocommerce Cart."
),

array(
	"type" => "documentation",
	"text" => "<h3>Enable / Disable Right Panel (Sidebar)</h3>"
),

array(
	"name" => "Sliding Panel",
	"id" => "hazel_sliding_panel",
	"type" => "checkbox",
	"std" => 'off',
	"desc" => "Displays the Icon to open right Panel  icons."
),

array(
	"type" => "documentation",
	"text" => "<h3>Enable / Disable Social Icons</h3>"
),

array(
	"name" => "Social Icons",
	"id" => "hazel_social_icons_menu",
	"type" => "checkbox",
	"std" => 'off',
	"desc" => "Displays the social icons."
),

array(
	"type" => "close"
),


/* logotype new place */
array(
"type" => "subtitle",
"id"=>'logotype'
),

array(
	'type' => 'goto',
	'name' => 'logotype',
	'desc' => 'Style this Element'
),

array(
	"type" => "documentation",
	"text" => "<h3>Logo</h3>"
),

array(
	"name" => "Logo <strong>Light</strong> URL",
	"id" => "hazel_logo_image_url_light",
	"type" => "upload_from_media",
	"desc" => "Upload your logo image - with png/jpg/gif extension.",
	"std" => "http://treethemes.net/themes/hazel/demo1/wp-content/uploads/sites/2/2017/10/logo_light.png"
),

array(
	"name" => "Logo <strong>Light</strong> Retina URL",
	"id" => "hazel_logo_retina_image_url_light",
	"type" => "upload_from_media",
	"desc" => "Upload your logo image - with png/jpg/gif extension.",
	"std" => "http://treethemes.net/themes/hazel/demo1/wp-content/uploads/sites/2/2017/10/logo_light@2x.png"
),

array(
	"name" => "Logo <strong>Dark</strong> URL",
	"id" => "hazel_logo_image_url_dark",
	"type" => "upload_from_media",
	"desc" => "Upload your logo image - with png/jpg/gif extension.",
	"std" => "http://treethemes.net/themes/hazel/demo1/wp-content/uploads/sites/2/2017/10/logo_dark-2.png"
),

array(
	"name" => "Logo <strong>Dark</strong> Retina URL",
	"id" => "hazel_logo_retina_image_url_dark",
	"type" => "upload_from_media",
	"desc" => "Upload your logo image - with png/jpg/gif extension.",
	"std" => "http://treethemes.net/themes/hazel/demo1/wp-content/uploads/sites/2/2017/10/logo_dark@2x.png"
),

array(
	"type" => "documentation",
	"text" => "<h3>Logo Loading Intro</h3>"
),

array(
	"name" => "Logo URL",
	"id" => "hazel_logo_intro_image_url",
	"type" => "upload_from_media",
	"desc" => "Upload your logo image - with png/jpg/gif extension.",
	"std" => "http://treethemes.net/themes/hazel/demo1/wp-content/uploads/sites/2/2017/10/logo_dark-2.png"
),

array(
	"name" => "Logo Retina URL",
	"id" => "hazel_logo_intro_retina_image_url",
	"type" => "upload_from_media",
	"desc" => "Upload your logo image - with png/jpg/gif extension.",
	"std" => "http://treethemes.net/themes/hazel/demo1/wp-content/uploads/sites/2/2017/10/logo_dark@2x.png"
),


array(
	"type" => "close"
),


/* ------------------------------------------------------------------------*
 * Top Contents
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'top_panel'
),

	array(
		"type" => "documentation",
		"text" => "<h3>Top Bar Contents</h3>"
	),
	
	array(
		"name" => "Enable Top Info Bar",
		"id" => "hazel_info_above_menu",
		"type" => "checkbox",
		"std" => 'off',
		"desc" => "Displays an above menu information container."
	),
	
	array(
		"name" => "WPML Widget",
		"id" => "hazel_wpml_menu_widget",
		"type" => "checkbox",
		"std" => 'off',
		"desc" => "Displays the WPML widget if available."
	),
	
	array(
		"name" => "Display Top Bar Menu",
		"id" => "hazel_top_bar_menu",
		"type" => "checkbox",
		"std" => 'off',
		"desc" => "Displays the Top Bar Menu. You need to assign a Menu to the Top Bar Location in <strong>Appearance > Menus</strong>."
	),
	
	array(
		"name" => "Telephone",
		"id" => "hazel_telephone_menu",
		"type" => "text",
		"desc" => "Insert number to display above the menu. <br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Email",
		"id" => "hazel_email_menu",
		"type" => "text",
		"desc" => "Insert email to display above the menu.<br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Address",
		"id" => "hazel_address_menu",
		"type" => "text",
		"desc" => "Insert address to display above the menu.<br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Text Field",
		"id" => "hazel_text_field_menu",
		"type" => "text",
		"desc" => "Insert a custom text line.<br/>NOTE: If you add links, span or class <b>do not use quotes or double quotes</b>.<br/> ex: < span class=text_color >",
		"std" => ""
	),
	
	array(
		"name" => "Enable Social Icons",
		"id" => "hazel_enable_socials",
		"type" => "checkbox",
		"std" => 'off'
	),
	
	array(
		"type" => "close"
	),
	
	array(
		"type" => "subtitle",
		"id"=>'search'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Search Options</h3>"
	),
	
	array(
		"name" => "Enable Search",
		"id" => "hazel_enable_search",
		"type" => "checkbox",
		"std" => 'on'
	),
	
	array(
		"name" => "Enable Ajax Search",
		"id" => "hazel_enable_ajax_search",
		"type" => "checkbox",
		"std" => 'off',
		"desc" => "If enabled, displays search results on typing."
	),
	
	array(
		"name" => "Search all contents ?",
		"id" => "hazel_enable_search_everything",
		"type" => "checkbox",
		"std" => 'on',
		"desc" => "If enabled the search will go through not only posts and pages, but all of the website's content."
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Search Page Results</h3>"
	),
	
	array(
		"name" => "Secondary Title",
		"id" => "hazel_search_secondary_title",
		"type" => "text",
		"desc" => "If set, will display this as a secondary title."
	),
	
	array(
		"name" => "Sidebar ?",
		"id" => "hazel_search_archive_sidebar",
		"type" => "select",
		"options" => array(array("id"=>"none", "name"=>"None"), array("id"=>"left", "name"=>"Left"), array("id"=>"right", "name"=>"Right")),
		"std"=>"right"
	),
	
	array(
		"name" => "Choose your Sidebar",
		"id" => "hazel_search_sidebars_available",
		"type" => "select",
		"options" => $outputsidebars
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Search Results Ajax Details</h3>"
	),
	
	array(
		"name" => "Show Author ?",
		"id" => "hazel_search_show_author",
		"type" => "checkbox",
		"std" => 'on'
	),
	
	array(
		"name" => "Show Date ?",
		"id" => "hazel_search_show_date",
		"type" => "checkbox",
		"std" => 'on'
	),
	
	array(
		"name" => "Show Tags ?",
		"id" => "hazel_search_show_tags",
		"type" => "checkbox",
		"std" => 'off'
	),
	
	array(
		"name" => "Show Categories ?",
		"id" => "hazel_search_show_categories",
		"type" => "checkbox",
		"std" => 'off'
	),

	array(
		"type" => "close"
	),	
	
	
	array(
	"type" => "close"));

hazel_add_options($hazel_info_options);