<?php

		?>
			<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
			    <div><label class="screen-reader-texts" for="s"><?php esc_html_e('Search for:', 'hazel') ?></label>
			        <input type="text" value="" placeholder="<?php
				        if (function_exists('icl_t')){
					        echo sprintf(esc_attr__("%s", "hazel"), icl_t( 'hazel', 'Type your search and hit enter...', get_option('hazel_search_box_text')));
				        } else {
					        echo sprintf(esc_attr__("%s", "hazel"), get_option("hazel_search_box_text"));
				        }
			        ?>" onfocus="if (jQuery(this).val() === '<?php echo sprintf(esc_attr__("%s", "hazel"), get_option("hazel_search_box_text")); ?>') jQuery(this).val('');" onblur="if (jQuery(this).val() === '') jQuery(this).val('<?php echo sprintf(esc_attr__("%s", "hazel"), get_option("hazel_search_box_text")); ?>');" name="s" id="s" />
			        <input type="submit" id="searchsubmit" value="<?php echo esc_attr('Search','hazel'); ?>" />
			    </div>
			</form>
		<?php

?>