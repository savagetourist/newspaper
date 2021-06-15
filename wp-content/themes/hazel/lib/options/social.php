<?php
	
	$hazel_general_options= array( array(
		"name" => "Social Icons",
		"type" => "title",
		"img" => HAZEL_IMAGES_URL."icon_general.png"
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"social", "name"=>"Social Icons"), array("id"=>"instagram", "name" => "Instagram"))
	),
	
	
	/* ------------------------------------------------------------------------*
	 * Top Panel
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'social'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Social Icons</h3>"
	),
	
	array(
		"name" => "Houzz Icon",
		"id" => "hazel_icon-houzz",
		"type" => "text",
		"std" => ""
	),
	
	array(
		"name" => "Facebook Icon",
		"id" => "hazel_icon-facebook",
		"type" => "text",
		"desc" => "Enter full url   ex: http://facebook.com/treethemes",
		"std" => ""
	),
	array(
		"name" => "Twitter Icon",
		"id" => "hazel_icon-twitter",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Tumblr Icon",
		"id" => "hazel_icon-tumblr",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Stumble Upon Icon",
		"id" => "hazel_icon-stumbleupon",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Flickr Icon",
		"id" => "hazel_icon-flickr",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "LinkedIn Icon",
		"id" => "hazel_icon-linkedin",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Delicious Icon",
		"id" => "hazel_icon-delicious",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Skype Icon",
		"id" => "hazel_icon-skype",
		"type" => "text",
		"desc" => "For a directly call to your Skype, add the following code.  skype:username?call",
		"std" => ""
	),
	array(
		"name" => "Digg Icon",
		"id" => "hazel_icon-digg",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Google Icon",
		"id" => "hazel_icon-google-plus",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Vimeo Icon",
		"id" => "hazel_icon-vimeo-square",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "DeviantArt Icon",
		"id" => "hazel_icon-deviantart",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Behance Icon",
		"id" => "hazel_icon-behance",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Instagram Icon",
		"id" => "hazel_icon-instagram",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Blogger Icon",
		"id" => "hazel_icon-blogger",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Wordpress Icon",
		"id" => "hazel_icon-wordpress",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Youtube Icon",
		"id" => "hazel_icon-youtube",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Reddit Icon",
		"id" => "hazel_icon-reddit",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "RSS Icon",
		"id" => "hazel_icon-rss",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "SoundCloud Icon",
		"id" => "hazel_icon-soundcloud",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Pinterest Icon",
		"id" => "hazel_icon-pinterest",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Dribbble Icon",
		"id" => "hazel_icon-dribbble",
		"type" => "text",
		"std" => ""
	),

	/* New vs 2.6*/
	array(
		"name" => "Line Icon",
		"id" => "hazel_icon-line",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "WeChat Icon",
		"id" => "hazel_icon-weixin",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Tripadvisor Icon",
		"id" => "hazel_icon-tripadvisor",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Email Icon",
		"id" => "hazel_icon-envelope",
		"type" => "text",
		"std" => ""
	),
	
	
	array(
		"name" => "VK Icon",
		"id" => "hazel_icon-vk",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Twitch Icon",
		"id" => "hazel_icon-twitch",
		"type" => "text",
		"std" => ""
	),
	
	array(
		"name" => "Foursquare Icon",
		"id" => "hazel_icon-foursquare",
		"type" => "text",
		"std" => ""
	),
	
	array(
		"name" => "Slack Icon",
		"id" => "hazel_icon-slack",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Whatsapp Icon",
		"id" => "hazel_icon-whatsapp",
		"type" => "text",
		"std" => ""
	),
	
	

	array(
		"type" => "close"
	),
	
	array(
		"type" => "subtitle",
		"id"=>'instagram'
	),
	
	array(
		"name" => "Display Instagram on Footer?",
		"id" => "hazel_display_instagram_footer",
		"type" => "checkbox",
		"std" => 'off',
		"desc" => "Displays your latest Instagram photos on the footer."
	),
	
	array(
		"Authorize Instagram",
		"id" => "hazel_authorize_instagram",
		"type" => "hazel_insta_authorize",
	),
	
	array(
		"name" => "Title",
		"id" => "hazel_instagram_title",
		"type" => "text",
		"std" => "INSTAGRAM @TREETHEMES"
	),
	
	array(
		"name" => "Number of photos",
		"id" => "hazel_instagram_limit",
		"type" => "text",
		"std" => "12"
	),
	
	array(
		"name" => "Open Links in:",
		"id" => "hazel_instagram_target",
		"type" => "select",
		"options" => array(array('id'=>'_self', 'name'=>'Current Window (self)'), array('id'=>'_blank','name'=>'New Window (blank)')),
		"std" => '_self'
	),

	array(
		"name" => "Link text",
		"id" => "hazel_instagram_link",
		"type" => "text",
		"std" => "Follow me!"
	),
	
	array(
		"type" => "close"
	),
	
		
	/*close array*/
	
	array(
		"type" => "close"
	));
	
	hazel_add_options($hazel_general_options);
	
?>