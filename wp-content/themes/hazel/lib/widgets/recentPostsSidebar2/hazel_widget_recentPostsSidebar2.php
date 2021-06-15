<?php

class Hazel_RecentPostsSidebar2_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'recentPostsSidebar2_widget', 'description' => esc_html__('Show your recent blog posts on your site.', 'hazel'));
		parent::__construct(false, 'TW _ Recent Posts 2', $widget_ops);
	}

	function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";
		
		if (isset($instance['nposts'])){
			$nposts = esc_attr($instance['nposts']);	
		} else $nposts = "";
		
		if (isset($instance['categories'])){
			$categories = esc_attr($instance['categories']);  
		} else $categories = "";
		
		if (isset($instance['orderby'])){
			$orderby = esc_attr($instance['orderby']);	
		} else $orderby = "";
		
		if (isset($instance['order'])){
			$order = esc_attr($instance['order']);  	
		} else $order = "";
        
        ?>
        
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">&#8212; <?php esc_html_e('Title','hazel'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" ></label></p> 
        <p><label for="<?php echo esc_attr($this->get_field_id('nposts')); ?>">&#8212; <?php esc_html_e('Number Posts to show','hazel'); ?> &#8212;<input class="widefat" id="<?php echo esc_attr($this->get_field_id('nposts')); ?>" name="<?php echo esc_attr($this->get_field_name('nposts')); ?>" type="text" value="<?php echo esc_attr($nposts); ?>" ><br><span class="flickr-stuff">If 0 will show all posts.</span></label></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('categories')); ?>">&#8212; <?php esc_html_e('Categories','hazel'); ?> &#8212;<input style="display:none;" class="widefat" type="text" value="<?php echo esc_attr($categories); ?>" ></label></p>
       <div class="widget-recent-posts-categories">
       <?php
	    $args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		$selected_cats = explode(",", $categories);
		$categories = get_categories( $args );
		if (count($categories) > 0){
			foreach($categories as $cats){
				?>
				<label><input <?php if (in_array($cats->slug, $selected_cats)) echo 'checked="checked" '; ?>onchange="var checked_inputs = []; jQuery(this).closest('.widget-recent-posts-categories').find('input:checked').each(function(){ checked_inputs.push(jQuery(this).val()); }); jQuery(this).closest('.widget-recent-posts-categories').find('.widget-posts-categories').val( checked_inputs.join(',') );" type="checkbox" name="<?php echo esc_attr($cats->slug); ?>" value="<?php echo esc_attr($cats->slug); ?>"><?php echo esc_html($cats->cat_name); ?></label>
				<?php
			}
			?>
			<input style="display:none;" type="text" id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widget-posts-categories" value="<?php echo esc_attr($instance['categories']); ?>"  />
			<?php
		}
		else { ?> <i style="position:relative;top:-8px;margin-left:15px;"> <?php esc_html_e("No Categories defined.", "hazel"); ?></i> <?php }
	       
       ?>
       </div>
       
	    <p><label>&#8212; <?php esc_html_e('Order by','hazel'); ?> &#8212;</label><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" value="title" <?php if($orderby == 'title') echo 'checked'; ?>> <?php esc_html_e('Title','hazel'); ?><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" value="date" <?php if($orderby == 'date') echo 'checked'; ?>> <?php esc_html_e('Date','hazel'); ?><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" value="author" <?php if($orderby == 'author') echo 'checked'; ?>> <?php esc_html_e('Author','hazel'); ?><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" value="comment_count" <?php if($orderby == 'comment_count') echo 'checked'; ?>> <?php esc_html_e('Number Comments','hazel'); ?><br>
	    </p>
	    <p><label>&#8212; <?php esc_html_e('Order','hazel'); ?> &#8212;</label><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('order')); ?>" value="asc" <?php if($order == 'asc') echo 'checked'; ?>> <?php esc_html_e('Ascending','hazel'); ?><br>
	    		<input type="radio" name="<?php echo esc_attr($this->get_field_name('order')); ?>" value="desc" <?php if($order == 'desc') echo 'checked'; ?>> <?php esc_html_e('Descending','hazel'); ?><br>
	    </p>
	    
		<?php
	}
	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    $instance['nposts'] = $new_instance['nposts'];
	    $instance['categories'] = $new_instance['categories'];
	    $instance['orderby'] = $new_instance['orderby'];
	    $instance['order'] = $new_instance['order'];
		return $instance;
	}
	
	function widget($args, $instance) {
		$hazel_inline_script = '';
		extract($instance);
	    $nposts = ($instance['nposts'] != "" && intval($instance['nposts']) > 0) ? intval($instance['nposts']) : -1;
	    $categories = $instance['categories'];
	    $orderby = $instance['orderby'];
	    $order = $instance['order'];
	   	global $post, $wp_query;

	   	if ($categories != ""){
		   	$categories = explode(",", $categories);
		   	$catsids = array();
		   	foreach ($categories as $cats){
			   	$aux = get_term_by('slug', $cats, 'category', OBJECT);
			   	if (isset($aux) && isset($aux->term_id)) $catsids[] = $aux->term_id;
		   	}
		   	$args = array(
				'showposts' => $nposts,
				'orderby' => $orderby,
				'order' => $order,
				'post_status' => 'publish',
				'tax_query' => array(
			        array(
			            'taxonomy' => 'category',
			            'field'    => 'term_slug',
			            'terms'    => $catsids
			        )
			    )
			);
		} else {
			$args = array(
				'showposts' => $nposts,
				'orderby' => $orderby,
				'order' => $order,
				'post_status' => 'publish'
			);
		}
		$losposts = get_posts($args);
		
		if ($losposts){ ?>
	
		<div class="recent_posts_widget_2 recentcomments_widget widget">
		
			<?php if ( !empty( $title ) ) { echo wp_kses_post('<h4 class="widget_title_span">' . $title . '</h4>'); } ?>
		
			<ul class="recentcomments_listing">
			
			<?php 
				
				
				foreach($losposts as $post) :
					
					$image = get_the_post_thumbnail( $post->ID, 'hazel_mini' );
					
					$current_link = get_the_permalink( $post->ID );
										
					if (function_exists('icl_t')){
						echo('<li ><div class="contents-left"><a class="the_title" href="'.$current_link.'">'.$image.'</a></div><div class="contents-right"><a class="the_title" href="'.$current_link.'">'.get_the_title($post->ID) . '</a><br><div class="content-left-author"><span class="blog-i">'. sprintf(esc_html__("%s", "hazel"), icl_t( 'hazel', 'by', get_option('hazel_by_text'))). ':&nbsp;</span><a class="the_author" href="' . esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )) . '">'. get_the_author_meta( 'nicename', $post->post_author ) .'</a></div></div></li>');
					} else {
						echo('<li ><div class="contents-left"><a class="the_title" href="'.$current_link.'">'.$image.'</a></div><div class="contents-right"><a class="the_title" href="'.$current_link.'">'.get_the_title($post->ID) . '</a><br><div class="content-left-author"><span class="blog-i">'. sprintf(esc_html__("%s", "hazel"), get_option("hazel_by_text")). ':&nbsp;</span><a class="the_author" href="' . esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )) . '">' . get_the_author_meta( 'nicename', $post->post_author ) . '</a></div></div></li>');
					}
					
				
				endforeach;
			
			?>
			
			</ul>
		</div>
		<?php 
		wp_reset_query();
		}
		
	}
}
register_widget('Hazel_RecentPostsSidebar2_Widget');

?>
