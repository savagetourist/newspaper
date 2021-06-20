<?php
/**
 * @package WordPress
 * @subpackage Hazel
 */

get_header(); hazel_print_menu(); ?>
	
	<?php 
		if (have_posts()) {
			the_post(); 
			$hazel_type = get_post_type();
			$hazel_portfolio_permalink = get_option("hazel_portfolio_permalink");
			switch ($hazel_type){
				case "post":
					get_template_part('post-single', 'single');
				break;
				case $hazel_portfolio_permalink:
					get_template_part('proj-single', 'single');
				break;
				default:
					the_content();
				break;
			}
		}
	?>
	
<?php get_footer(); ?>