<?php

function hazel_print_woocommerce_button(){
	global $woocommerce;
	if (isset($woocommerce) && get_option("hazel_woocommerce_cart") == "on"){ ?>
		<div class="hazel_dynamic_shopping_bag">
			<div class="hazel_little_shopping_bag_wrapper">
				<div class="hazel_little_shopping_bag">
					<div class="title">
						<i class="ion-ios-cart-outline"></i>
					</div>
					<div class="overview">
						<span class="minicart_items"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'hazel'), $woocommerce->cart->cart_contents_count); ?></span>
					</div>
				</div>
				<div class="hazel_minicart_wrapper">
					<div class="hazel_minicart">
					<?php
						if (sizeof($woocommerce->cart->cart_contents)>0){
							echo '<ul class="cart_list">';
							foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item){
								$_product = $cart_item['data'];
								if ($_product->exists() && $cart_item['quantity']>0){
									echo '<li class="cart_list_product">';
										echo '<a class="cart_list_product_img" href="'.esc_url(get_permalink($cart_item['product_id'])).'">' . $_product->get_image().'</a>';
										echo '<div class="cart_list_product_title">';
											$hazel_product_title = $_product->get_title();
											$hazel_short_product_title = (strlen($hazel_product_title) > 28) ? substr($hazel_product_title, 0, 25) . '...' : $hazel_product_title;
											echo '<a href="'.esc_url(get_permalink($cart_item['product_id'])).'">' . apply_filters('woocommerce_cart_widget_product_title', $hazel_short_product_title, $_product) . '</a>';
											echo '<div class="cart_list_product_quantity">'.$cart_item['quantity'].'x</div>';
										echo '</div>';
										echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">x</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'hazel') ), $cart_item_key );
										echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
										echo '<div class="clr"></div>';
									echo '</li>';
								}
							}
							echo '</ul>';
							?>
							<div class="minicart_total_checkout">
							<?php esc_html_e('Cart subtotal', 'hazel'); ?><span><?php echo wp_kses_post($woocommerce->cart->get_cart_total()); ?></span>
							</div>
							<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button hazel_minicart_cart_but"><?php esc_html_e('View Bag', 'hazel'); ?></a>
							<a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button hazel_minicart_checkout_but"><?php esc_html_e('Checkout', 'hazel'); ?></a>
							<?php
						} else {
							echo '<ul class="cart_list"><li class="empty">'.esc_html__('No products in the cart.','hazel').'</li></ul>';
						}
						?>
					</div>
				</div>
			</div>
			<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="hazel_little_shopping_bag_wrapper_mobiles"><span><?php echo wp_kses_post($woocommerce->cart->cart_contents_count); ?></span></a>
		</div>
	<?php
	}
}

function hazel_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	if (isset($woocommerce) && get_option("hazel_woocommerce_cart") == "on"){
		$hazel_woo_output = '
		<div class="hazel_dynamic_shopping_bag" style="display:table-cell;">
			<div class="hazel_little_shopping_bag_wrapper">
				<div class="hazel_little_shopping_bag">
					<div class="title">
						<i class="ion-ios-cart-outline"></i>
					</div>
					<div class="overview">
						<span class="minicart_items">'.sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'hazel'), $woocommerce->cart->cart_contents_count).'</span>
					</div>
				</div>
				<div class="hazel_minicart_wrapper">
					<div class="hazel_minicart">';
						if (sizeof($woocommerce->cart->cart_contents)>0){
							$hazel_woo_output .= '<ul class="cart_list">';
							foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item){
								$_product = $cart_item['data'];
								if ($_product->exists() && $cart_item['quantity']>0){
									$hazel_woo_output .= '<li class="cart_list_product">';
										$hazel_woo_output .= '<a class="cart_list_product_img" href="'.esc_url(get_permalink($cart_item['product_id'])).'">' . $_product->get_image().'</a>';
										$hazel_woo_output .= '<div class="cart_list_product_title">';
											$hazel_product_title = $_product->get_title();
											$hazel_short_product_title = (strlen($hazel_product_title) > 28) ? substr($hazel_product_title, 0, 25) . '...' : $hazel_product_title;
											$hazel_woo_output .= '<a href="'.esc_url(get_permalink($cart_item['product_id'])).'">' . apply_filters('woocommerce_cart_widget_product_title', $hazel_short_product_title, $_product) . '</a>';
											$hazel_woo_output .= '<div class="cart_list_product_quantity">'.$cart_item['quantity'].'x</div>';
										$hazel_woo_output .= '</div>';
										$hazel_woo_output .= apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">x</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'hazel') ), $cart_item_key );
										$hazel_woo_output .= '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
										$hazel_woo_output .= '<div class="clr"></div>';
									$hazel_woo_output .= '</li>';
								}
							}
							$hazel_woo_output .= '</ul>';
							$hazel_woo_output .= '
							<div class="minicart_total_checkout">
								'.esc_html__('Cart subtotal', 'hazel').'<span>'.wp_kses_post($woocommerce->cart->get_cart_total()).'</span>
						</div>
						<a href="'.esc_url( $woocommerce->cart->get_cart_url() ).'" class="button hazel_minicart_cart_but">'.esc_html__('View Bag', 'hazel').'</a>
						<a href="'.esc_url( $woocommerce->cart->get_checkout_url() ).'" class="button hazel_minicart_checkout_but">'. esc_html__('Checkout', 'hazel').'</a>';
						} else {
							$hazel_woo_output .= '<ul class="cart_list"><li class="empty">'.esc_html__('No products in the cart.','hazel').'</li></ul>';
						}
						$hazel_woo_output .= '
					</div>
				</div>
			</div>
			<a href="'.esc_url( $woocommerce->cart->get_cart_url() ).'" class="hazel_little_shopping_bag_wrapper_mobiles"><span>'. wp_kses_post($woocommerce->cart->cart_contents_count).'</span></a>
		</div>';
		$fragments['div.hazel_dynamic_shopping_bag'] = $hazel_woo_output;
		return $fragments;
	} else return "";
}

?>