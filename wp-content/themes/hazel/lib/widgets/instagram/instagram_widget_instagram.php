<?php

class Hazel_Instagram_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'instagram_widget', 'description' => esc_html__('Displays your latest Instagram photos.', 'hazel'));
		parent::__construct(false, 'TW _ Instagram', $widget_ops);
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Instagram', 'hazel' ), 'username' => '', 'link' => __( 'Follow Me!', 'hazel' ), 'number' => 9, 'target' => '_self' ) );
		$title = $instance['title'];
		//$username = $instance['username'];
		$number = absint( $instance['number'] );
		$target = $instance['target'];
		$link = $instance['link'];
		
		if (!get_option('hazel_insta_token') || get_option('hazel_insta_token') == ""){
			echo '<p>Please go to Appearance > Hazel Options > Social Networks > Instagram and click on Authorize Instagram to grant access to your feed.</p>';
		}
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'hazel' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos', 'hazel' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /></label></p>
		
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open links in', 'hazel' ); ?>:</label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" class="widefat">
				<option value="_self" <?php selected( '_self', $target ) ?>><?php esc_html_e( 'Current window (_self)', 'hazel' ); ?></option>
				<option value="_blank" <?php selected( '_blank', $target ) ?>><?php esc_html_e( 'New window (_blank)', 'hazel' ); ?></option>
			</select>
		</p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link text', 'hazel' ); ?>: <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" /></label></p>
		<?php
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = ! absint( $new_instance['number'] ) ? 9 : $new_instance['number'];
		$instance['target'] = ( ( $new_instance['target'] == '_self' || $new_instance['target'] == '_blank' ) ? $new_instance['target'] : '_self' );
		$instance['link'] = strip_tags( $new_instance['link'] );
		return $instance;
	}
		
	function widget($args, $instance) {
		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		//$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$limit = empty( $instance['number'] ) ? 9 : $instance['number'];
		$target = empty( $instance['target'] ) ? '_self' : $instance['target'];
		$link = empty( $instance['link'] ) ? '' : $instance['link'];

		echo '<div class="widget instagram_widget">' . wp_kses_post($args['before_widget']);

		if ( ! empty( $title ) ) { echo wp_kses_post( '<h4 class="widget_title_span">' . $title . '</h4>' ); };

		do_action( 'treethemes_insta_before_widget', $instance );

		$this->treethemes_scrape_instagram($instance);
		
		do_action( 'treethemes_insta_after_widget', $instance );
		echo wp_kses_post($args['after_widget']) . '</div>';
	}
	
	function treethemes_scrape_instagram($instance) {
		
		$title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		$username = empty( $instance['username'] ) ? '' : $instance['username'];
		$limit = empty( $instance['number'] ) ? 9 : $instance['number'];
		$target = empty( $instance['target'] ) ? '_self' : $instance['target'];
		$link = empty( $instance['link'] ) ? '' : $instance['link'];
		
		$access_token = get_option('hazel_insta_token', false);
		
		if (!$access_token){
			echo 'Please authorize Instagram on Appearance > Hazel Options > Social Networks > Instagram and clicking on Authorize Instagram.';
			return;
		}
		
		$url = "https://ap" . "i.ins" . "tagr" . "am.com/v1/users/self";
		$args = array(
			'access_token' => $access_token
		);
		$response = $this->remote_get($url, $args, "_scraper");
		
		$shards = explode(".",$access_token);

		if (empty($response)) {
			return false;
		}

		if (isset($response['meta']['code']) && ($response['meta']['code'] != 200) && isset($response['meta']['error_message'])) {
			$this->message = $response['meta']['error_message'];
			return false;
		}

		if (isset($response['data'])){
			
			$feedinger = $this->get_user_items($access_token, null, $limit);
			
			if (isset($feedinger['data'])){
				$images = $feedinger['data'];
				
				$ulclass = apply_filters( 'treethemes_insta_list_class', 'instagram-pics' );
				$liclass = apply_filters( 'treethemes_insta_item_class', '' );
				$aclass = apply_filters( 'treethemes_insta_a_class', '' );
				$imgclass = apply_filters( 'treethemes_insta_img_class', '' );
				if (get_option('hazel_enable_instagram_grayscale') == "on") $imgclass .= ' hazel_grayscale ';
				echo '<ul class="'.esc_attr( $ulclass ).'">';
				foreach ($images as $image){
					echo '<li style="width:'. (100/$limit) .'%;" class="'. esc_attr( $liclass ) .'"><a href="'. esc_url( $image['link'] ) .'" target="'. esc_attr( $target ) .'"  class="'. esc_attr( $aclass ) .'"><img src="'. esc_url( $image['images']['thumbnail']['url'] ) .'"  alt="'. esc_attr( $image['caption']['text'] ) .'" title="'. esc_attr( $image['caption']['text'] ).'"  class="'. esc_attr( $imgclass ) .'"/></a></li>';
				}
				echo '</ul>';
			}
			
			$linkclass = apply_filters( 'treethemes_insta_link_class', 'clear' );
			if ( $link != '' ) {
				?><p class="<?php echo esc_attr( $linkclass ); ?>"><a href="<?php echo trailingslashit( '//instagram.com/' . esc_attr( trim( $response['data']['username'] ) ) ); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>"><?php echo wp_kses_post( $link ); ?></a></p><?php
			}
			
		} else {
			echo 'Something went wrong. Please re-authorize Instagram on Appearance > Hazel Options > Social Networks > Instagram and clicking on Authorize Instagram.';
			return;
		}
	}
	
	function get_user_items($access_token, $max_id = null, $limit = 12) {
		$args = array(
			'access_token' => $access_token,
			'max_id' => $max_id,
			'count' => $limit
		);

		$url = "https://ap" . "i.ins" . "tagr" . "am.com/v1/users/self/media/recent/";

		$response = $this->remote_get($url, $args, "_user_items");

		if (empty($response)){
			return false;
		}

		if (isset($response['meta']['code']) && ($response['meta']['code'] != 200) && isset($response['meta']['error_message'])) {
			$this->message = $response['meta']['error_message'];
			return false;
		}

		if (!isset($response['data'])) {
			return false;
		}

		return $response;
	}
	
	function hazel_get_user_items($user_id = null, $limit = 12, $next_max_id = null, $max_id = null) {
		
		$access_token = get_option('hazel_insta_token');
		$shards = explode(".",$access_token);
		
		$response = $this->get_user_items($shards[0], $max_id);

		if (!isset($response['data'])) {
			return;
		}

		if (count($instagram_feeds = $this->setup_user_item($response['data'], $next_max_id, $max_id)) >= $limit) {
			return $instagram_feeds;
		}

		if (!$next_max_id) {
			return $instagram_feeds;
		}

		if (!isset($response['pagination']['next_max_id'])) {
			return $instagram_feeds;
		}

		$max_id = $response['pagination']['next_max_id'];

		return array_merge($instagram_feeds, $this->hazel_get_user_items($user_id, $limit, $next_max_id, $max_id));
	}
	
	function setup_user_item($data, $next_max_id = null) {

		static $load = false;
		static $i = 1;

		if (!$next_max_id) {
			$load = true;
		}

		$instagram_items = array();

		if (is_array($data) && !empty($data)) {
			foreach ($data as $item) {
				if ($load) {
					preg_match_all("/#(\\w+)/", @$item['caption']['text'], $hashtags);
					$instagram_items[] = array(
						'i' => $i,
						'id' => str_replace("_{$item['user']['id']}", '', $item['id']),
						'images' => array(
							'standard' => @$item['images']['standard_resolution']['url'],
							'medium' => @$item['images']['low_resolution']['url'],
							'small' => @$item['images']['thumbnail']['url'],
						),
						'videos' => array(
							'standard' => @$item['videos']['standard_resolution']['url'],
							'medium' => @$item['videos']['low_resolution']['url'],
							'small' => @$item['videos']['thumbnail']['url'],
						),
						'likes' => @$item['likes']['count'],
						'comments' => @$item['comments']['count'],
						'caption' => preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', "<a href=\"https://www.in"."stag"."ram.com/explore/tags/$1\">#$1</a>", htmlspecialchars(@$item['caption']['text'])),
						'hashtags' => @$hashtags[1],
						'link' => @$item['link'],
						'type' => @$item['type'],
						'user_id' => @$item['user']['id'],
						'date' => date_i18n('j F, Y', strtotime(@$item['created_time']))
					);
				}
				if ($next_max_id && ($next_max_id == $i)) {
					$i = $next_max_id;
					$load = true;
				}
				$i++;
			}
		}
		return $instagram_items;
	}
	
	function remote_get($url = null, $args = array(), $culprit = "") {
		if (!get_transient( 'hazel_insta_transient'.$culprit )){
			$url = add_query_arg($args, trailingslashit($url));
			$response = $this->validate_response(wp_remote_get($url, array('timeout' => 29)));
			if (!isset($reponse['error'])) set_transient( 'hazel_insta_transient'.$culprit, $response, 3600 );
		} else $response = get_transient( 'hazel_insta_transient'.$culprit );
		return $response;
	}

	function validate_response($json = null) {

		if (!($response = json_decode(wp_remote_retrieve_body($json), true)) || 200 !== wp_remote_retrieve_response_code($json)) {
			if (isset($response['meta']['error_message'])) {
				$this->message = $response['meta']['error_message'];
				return array(
					'error' => 1,
					'message' => $this->message
				);
			}

			if (isset($response['error_message'])) {
				$this->message = $response['error_message'];
				return array(
					'error' => 1,
					'message' => $this->message
				);
			}

			if (is_wp_error($json)) {
				$response = array(
					'error' => 1,
					'message' => $json->get_error_message()
				);
			} else {
				$response = array(
					'error' => 1,
					'message' => esc_html__('Unknow error occurred, please try again', 'hazel')
				);
			}
		}
		return $response;
	}
	
	function treethemes_images_only( $media_item ) {
		if ( $media_item['type'] == 'image' )
			return true;
		return false;
	}
	
}
register_widget('Hazel_Instagram_Widget');

?>
