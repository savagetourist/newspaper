(function ($) {

    var Shortcodes = vc.shortcodes;

	window.VcTestimonialsView = vc.shortcode_view.extend({
	    firstCallback: true,
	    ready:function (e) {
	        window.VcTestimonialsView.__super__.ready.call(this, e);
			var el = this;

			if (this.use_default_content){
				updateTestimonialsOpts(this);
			}
			jQuery(el.$el).children('.vc_controls').find('.vc_control-btn-edit').click(function(){ 
				updateTestimonialsOpts(el);
			});

	    }
	});
	
	if (jQuery('body').is('.wp-admin.vc_inline-shortcode-edit-form')){
		var frontendTestimonialsInterval = setInterval(function(){ updateTestimonialsOpts(el=null, 300); }, 1000);
	}
	
	function updateTestimonialsOpts(el){
		clearInterval(testimonialsInterval);
		var testimonialsInterval = setInterval(function(){
			if (jQuery('#vc_ui-panel-edit-element div[data-vc-ui-element="panel-edit-element-tab"]').children().length){
				if (jQuery('select[name=des_testimonials_flex_slideshow]').val() === 'yes'){
					jQuery('input[name=des_testimonials_flex_slideshow_speed]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('input[name=des_testimonials_flex_slideshow_speed]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_testimonials_flex_slideshow]').change(function(){
					if (jQuery('select[name=des_testimonials_flex_slideshow]').val() === 'yes'){
						jQuery('input[name=des_testimonials_flex_slideshow_speed]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('input[name=des_testimonials_flex_slideshow_speed]').closest('.vc_shortcode-param').css('display','none');
					}
				});
				
				if (jQuery('select[name=des_testimonials_flex_direction_nav]').val() === 'yes'){
					jQuery('select[name=des_testimonials_flex_nav_style]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('select[name=des_testimonials_flex_nav_style]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_testimonials_flex_direction_nav]').change(function(){
					if (jQuery('select[name=des_testimonials_flex_direction_nav]').val() === 'yes'){
						jQuery('select[name=des_testimonials_flex_nav_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_testimonials_flex_nav_style]').closest('.vc_shortcode-param').css('display','none');
					}
				});

				if (jQuery('select[name=des_testimonials_flex_control_nav]').val() === 'yes'){
					jQuery('select[name=des_testimonials_flex_control_nav_style]').closest('.vc_shortcode-param').css('display','block');
				} else {
					jQuery('select[name=des_testimonials_flex_control_nav_style]').closest('.vc_shortcode-param').css('display','none');
				}
				jQuery('select[name=des_testimonials_flex_control_nav]').change(function(){
					if (jQuery('select[name=des_testimonials_flex_control_nav]').val() === 'yes'){
						jQuery('select[name=des_testimonials_flex_control_nav_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_testimonials_flex_control_nav_style]').closest('.vc_shortcode-param').css('display','none');
					}
				});
				
				if (jQuery('select[name=style_testimonials]').val() === "style2" || jQuery('select[name=style_testimonials]').val() === "style3"){
					
					//style 2
					if (jQuery('select[name=style_testimonials]').val() === "style2")
						jQuery('select.style_testimonials').closest('.vc_shortcode-param').nextUntil(jQuery('.wpb_el_type_testimonials_cats')).css('display','block');

					// style 3
					if (jQuery('select[name=style_testimonials]').val() === "style3"){
						jQuery('select.des_testimonials_flex_direction_nav').closest('.vc_shortcode-param').nextUntil(jQuery('.wpb_el_type_testimonials_cats')).css('display','block');							
						jQuery('.des_testimonials_flex_items_desktop').closest('.vc_shortcode-param').nextUntil(jQuery('.des_testimonials_flex_direction_nav').closest('.vc_shortcode-param')).andSelf().css('display','none');
					}
					
					if (jQuery('select[name=des_testimonials_flex_slideshow]').val() === 'yes'){
						jQuery('input[name=des_testimonials_flex_slideshow_speed]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('input[name=des_testimonials_flex_slideshow_speed]').closest('.vc_shortcode-param').css('display','none');
					}
					
					if (jQuery('select[name=des_testimonials_flex_direction_nav]').val() === 'yes'){
						jQuery('select[name=des_testimonials_flex_nav_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_testimonials_flex_nav_style]').closest('.vc_shortcode-param').css('display','none');
					}
					
					if (jQuery('select[name=des_testimonials_flex_control_nav]').val() === 'yes'){
						jQuery('select[name=des_testimonials_flex_control_nav_style]').closest('.vc_shortcode-param').css('display','block');
					} else {
						jQuery('select[name=des_testimonials_flex_control_nav_style]').closest('.vc_shortcode-param').css('display','none');
					}

				} else {
					jQuery('select.style_testimonials').closest('.vc_shortcode-param').nextUntil(jQuery('.wpb_el_type_testimonials_cats')).css('display','none');
				}
				
				jQuery('select[name=style_testimonials]').change(function(){
					if (jQuery('select[name=style_testimonials]').val() === "style2" ||  jQuery('select[name=style_testimonials]').val() === "style3"){

						//style 2
						if (jQuery('select[name=style_testimonials]').val() === "style2")
							jQuery('select.style_testimonials').closest('.vc_shortcode-param').nextUntil(jQuery('.wpb_el_type_testimonials_cats')).css('display','block');

						// style 3
						if (jQuery('select[name=style_testimonials]').val() === "style3"){
							jQuery('select.des_testimonials_flex_direction_nav').closest('.vc_shortcode-param').nextUntil(jQuery('.wpb_el_type_testimonials_cats')).css('display','block');							
							jQuery('.des_testimonials_flex_items_desktop').closest('.vc_shortcode-param').nextUntil(jQuery('.des_testimonials_flex_direction_nav').closest('.vc_shortcode-param')).andSelf().css('display','none');
						}
						
						
						if (jQuery('select[name=des_testimonials_flex_slideshow]').val() === 'yes'){
							jQuery('input[name=des_testimonials_flex_slideshow_speed]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('input[name=des_testimonials_flex_slideshow_speed]').closest('.vc_shortcode-param').css('display','none');
						}
						
						if (jQuery('select[name=des_testimonials_flex_direction_nav]').val() === 'yes'){
							jQuery('select[name=des_testimonials_flex_nav_style]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('select[name=des_testimonials_flex_nav_style]').closest('.vc_shortcode-param').css('display','none');
						}
						
						if (jQuery('select[name=des_testimonials_flex_control_nav]').val() === 'yes'){
							jQuery('select[name=des_testimonials_flex_control_nav_style]').closest('.vc_shortcode-param').css('display','block');
						} else {
							jQuery('select[name=des_testimonials_flex_control_nav_style]').closest('.vc_shortcode-param').css('display','none');
						}

					} else {
						jQuery('select.style_testimonials').closest('.vc_shortcode-param').nextUntil(jQuery('.wpb_el_type_testimonials_cats')).css('display','none');
					}
				});
				
				//the categories mambo jambo
				if (jQuery('.testimonials_cats_field').val() == -1 || jQuery('.testimonials_cats_field').val() == "" || jQuery('.testimonials_cats_field').val() == "0"){
					jQuery('.vc_wrapper-param-type-testimonials_cats .testimonial_categories input').attr('checked','checked');
				}
				
				
				clearInterval(testimonialsInterval);
			}
		},300);
	}
})(window.jQuery);