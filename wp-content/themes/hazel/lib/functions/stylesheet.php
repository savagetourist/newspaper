<?php
function hazel_styles(){

	 if (!is_admin()){
		
		wp_enqueue_style('hazel-blog', HAZEL_CSS_PATH .'blog.css'); 
	 	wp_enqueue_style('hazel-bootstrap', HAZEL_CSS_PATH .'bootstrap.css');
		wp_enqueue_style('hazel-icons', HAZEL_CSS_PATH .'icons-font.css');
		wp_enqueue_style('hazel-component', HAZEL_CSS_PATH .'component.css');
		
		wp_enqueue_style('hazel-IE', HAZEL_CSS_PATH .'IE.css');	
		wp_style_add_data('hazel-IE','conditional','lt IE 9');
		
		wp_enqueue_style('hazel-editor', get_template_directory_uri().'/editor-style.css');
		wp_enqueue_style('hazel-woo-layout', HAZEL_CSS_PATH .'hazel-woo-layout.css');
		wp_enqueue_style('hazel-woo', HAZEL_CSS_PATH .'hazel-woocommerce.css');
		wp_enqueue_style('hazel-ytp', HAZEL_CSS_PATH .'mb.YTPlayer.css');
		wp_enqueue_style('hazel-retina', HAZEL_CSS_PATH .'retina.css');
		
	}
}
add_action('wp_enqueue_scripts', 'hazel_styles', 1);

?>