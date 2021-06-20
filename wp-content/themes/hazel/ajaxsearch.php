<?php
	
	require_once(
		$_POST['thepath']."wp-" 
		. "loa". "d.p" ."hp");
	
	$results = "";
	
	if ($_POST['se'] == "on"){
		$args = array(
			'showposts' => -1,
			'post_status' => 'publish',
			's' => $_POST['query']
		);
	} else {
		$args = array(
			'showposts' => -1,
			'post_status' => 'publish',
			'post_type' => 'post',
			's' => $_POST['query']
		);
	}
    
    $hazel_the_query = new WP_Query( $args );
    
	if ( $hazel_the_query->have_posts() ) {
		$first = true;
		$selected = "";
		while ( $hazel_the_query->have_posts() ) {
			$hazel_the_query->the_post();

			if ($first)	{
				$first = false;
				$selected = "selected";
			} else {
				$selected = "";
			}
			$results .= "<li class='".esc_attr($selected)."'><a href='".esc_url(get_permalink())."'><strong>".wp_kses_post(get_the_title())."</strong><span>";
			if (get_option("hazel_search_show_author") == "on") {
				if (function_exists('icl_t')){
					$results .=", ".sprintf(esc_html__("%s","hazel"), icl_t( 'hazel', 'by', get_option('hazel_by_text')))." ".get_the_author();
				} else {
					$results .=", ".sprintf(esc_html__("%s","hazel"), get_option("hazel_by_text"))." ".get_the_author();
				}
			}
			if (get_option("hazel_search_show_date") == "on")
			$results .= ", ".get_the_date("M")." ".get_the_date("d").", ".get_the_date("Y");
			if (get_option("hazel_search_show_categories") == "on"){
				$categories = get_the_category();
				$firstcat = true;
				if ($categories){
					foreach($categories as $category) {
						if ($category->term_id != 1){
							if ($firstcat){
								if (function_exists('icl_t')){
									$results .= ", ".sprintf(esc_html__("%s","hazel"), icl_t( 'hazel', 'in', get_option('hazel_in_text')))." <i>";
								} else {
									$results .= ", ".sprintf(esc_html__("%s","hazel"), get_option("hazel_in_text"))." <i>";
								}
								$firstcat = false;
								$results .= $category->cat_name;
							} else {
								$results .= ", ".$category->cat_name;
							}	
						}
					}
				}
				if (!$firstcat) $results .= "</i>";
			}
			if (get_option("hazel_search_show_tags") == "on"){
				$tags = get_the_tags();
				$firsttag = true;
				if ($tags){
					foreach($tags as $tag) {
						if ($firsttag){
							$results .= ", ".sprintf(esc_html__("%s","hazel"), get_option("hazel_in_text"))." <i>";
							$firsttag = false;
							$results .= $tag->name;
						} else {
							$results .= ", ".$tag->name;
						}
					}
				}
				if (!$firsttag) $results .= "</i>";
			}
			$results .= "</span></a></li>";
		}
	} else {
		$results .= "<li><a>".sprintf(esc_html__("%s","hazel"), icl_t( 'hazel', 'No results found.', get_option('hazel_no_results_text')))."</a></li>";
		} else {
			$results .= "<li><a>".sprintf(esc_html__("%s","hazel"), get_option("hazel_no_results_text"))."</a></li>";
		}
	}
	
	echo wp_kses_post($results);

?>