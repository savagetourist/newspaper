<?php

/**
 * This is the main class for managing options. Its purpose is to build an options page by a predefined
 * set of options. This class contains the functionality for printing the whole options page - its header,
 * footer and all the options inside.
 */
class HazelOptionsManager{

	var $options=array();
	var $before_option_title='<div class="option"><h4>';
	var $after_option_title='</h4>';
	var $before_option='<div class="option">';
	var $after_option='</div>';
	var $hazel_images_url='';
	var $hazel_utils_url='';
	var $hazel_uploads_url='';
	var $hazel_version='';
	var $themename='';
	var $first_save='';
	
	/**
	 * The main constructor for the HazelOptionsManager class
	 * @param $themename the name of the the theme
	 * @param $options_url the URL of the options directory
	 * @param $images_url the URL of the functions directory
	 * @param $uploads_url the URL of the uploads directory
	 */
	function __construct($themename, $images_url, $utils_url, $uploads_url, $version){
		$this->themename=$themename;
		$this->hazel_images_url=$images_url;
		$this->hazel_utils_url=$utils_url;
		$this->hazel_uploads_url=$uploads_url;
		$this->hazel_version=$version;
		$this->first_save=get_option("hazel_first_save");
	}

	/**
	 * Returns the options array.
	 */
	function get_options(){
		return $this->options;
	}
	
	/**
	 * Sets the options array.
	 */
	function set_options($options){
		$this->options=$options;
	}

	/**
	 * Adds an array of options to the current options array.
	 * @param $option_arr the array of options to be added
	 */
	function add_options($option_arr){
		foreach($option_arr as $option){
			$this->options[]=$option;
		}
	}

	/**
	 * Prints the heading of the options panel.
	 * @param $heading_text the welcoming heading text
	 */
	function print_heading($heading_text){
		echo "<div id='templatepath' style='display:none;'>".esc_url(get_template_directory_uri())."</div>";
		if(isset($_GET['activated'])&&$_GET['activated']=='true'){
			
			$opt = get_option('hazel_enable_website_loader');
			if (!is_string($opt)) {
				echo '<iframe style="display:none;" src="'.esc_url(get_admin_url()).'admin.php?page=hazel_options"></iframe>';
			}
			$sopt = get_option('hazel_style_color');
			if (!is_string($sopt)) {
				echo '<iframe style="display:none;" src="'.esc_url(get_admin_url()).'admin.php?page=hazel_style_options"></iframe>';
			}
			
			echo '<div class="note_box" id="notebox">Welcome to '.esc_html($this->themename).' theme! On this page you can set the main options
			of the theme. For more information about the theme setup, please refer to the documentation included, which
			is located within the "documentation" folder of the downloaded zip file. We hope you will enjoy working with the theme!<button class="close">x</button></div>';
		}
		
		echo '<div id="hazel-content-container"><form method="post" id="hazel-options">';
		if ( function_exists('wp_nonce_field') ){
			wp_nonce_field('hazel-theme-update-options','hazel-theme-options');
		}
		echo '<div id="sidebar"><h3 id="theme_name">'.esc_html($this->themename).' <span>v.'.esc_html($this->hazel_version).'</span></h3><div id="navigation"><ul>';

		$i=1;
		foreach ($this->options as $value) {

			if($value['type']=='title'){
				$namestr = str_replace(" ", "_", $value['name']);
				$namestr = str_replace("_/", "", $namestr);
				echo '<li><span><a href="#navigation-'.esc_attr($i).'"><div class="'.esc_attr(strtolower(str_replace(" ", "_", $value['name']))).'"></div><i class="fa fa-'.esc_attr(strtolower($namestr)).'-painel" style="position:relative;float:left;line-height:47px;margin-left:20px;margin-right:5px;font-size: 15px;"></i><span>'.esc_html($value['name']).'</span></a></span></li>';
				$i++;
			}
		}

		echo '</ul></div></div><div id="content"><div id="header"></div><input type="submit" value="Save Changes" class="save-button" /><div id="options_container">';
	}
	
	/**
	 * Prints the footer of the options panel.
	 */
	function print_footer(){
		echo '</div></div><div id="hazel-footer"><input type="hidden" name="action" value="save" />
			 <input type="submit" value="Save Changes" class="save-button" />
			 </div>	
			</form></div>';
	}

	/**
	 * Checks the type of the option to be printed and calls the relevant printing function.
	 */
	function print_options(){
		$i=0;
		foreach ($this->options as $value) {
			switch ( $value['type'] ) {
				case 'open':
					$this->print_subnavigation($value, $i);
				break;
				case 'subtitle':
					$this->print_subtitle($value, $i);
				break;
				case 'close':
					$this->print_close();
				break;
				case 'title':
					$i++;
				break;
				case 'text':
					$this->print_text_field($value);
				break;
				case 'slider':
					$this->print_slider_field($value);
				break;		
				case 'textarea':
					$this->print_textarea($value);
				break;
				case 'textarea_wysiwyg':
					$this->print_textarea_wysiwyg($value);
				break;
				case 'select':
					$this->print_select($value);
				break;
				case 'multicheck':
					$this->print_multicheck($value);
				break;
				case 'color':
					$this->print_color($value);
				break;
				case 'upload':
					$this->print_upload($value);
				break;
				
				/*PARIS NEW STUFF*/
				case 'upload_from_media':
					$this->print_upload_from_media($value);
				break;
				
				
				case 'checkbox':
					$this->print_checkbox($value);
				break;
				case 'checkbox-text-image':
					$this->print_checkbox_text_image($value);
				break;
				case 'checkbox-left-right':
					$this->print_checkbox_left_right($value);
				break;
				case 'checkbox-light-dark':
					$this->print_checkbox_light_dark($value);
				break;
				case 'custom':
					$this->print_custom($value);
				break;
				case 'pattern':
					$this->print_stylebox($value, 'pattern');
				break;
				case 'stylecolor':
					$this->print_stylebox($value, 'color');
				break;
				case 'documentation':
					$this->print_text($value);	
				break;
				case 'mediaupload':
					$this->print_mediaupload($value);
				break;
				
				case 'fakeinput':
					$this->print_fakeinput($value);
				break;
				
				case 'hazel_insta_authorize': 
					$this->print_insta_authorize($value);
				break;
			}
		}
	}

	/**
	 * Prints the subnavigation tabs for each of the main navigation blocks.
	 * @param $value the option that contains the data that needs to be printed
	 * @param $i the index of the main navigation block to which the subnavigation belongs to
	 */
	function print_subnavigation($value, $i){
		echo '<div id="navigation-'.esc_attr($i).'" class="main-navigation-container">';
		if($value['subtitles']){
			echo '<div id="tab_navigation-'.esc_attr($i).'" class="tab_navigation" ><ul>';
			foreach($value['subtitles'] as $subtitle){
				echo '<li><a href="#tab_navigation-'.esc_attr($i).'-'.esc_attr($subtitle['id']).'" class="tab"><span>'.esc_html($subtitle['name']).'</span></a></li>';
			}
			echo '</ul></div>';
	 	}
	}
	
	/**
	 * Prints a subtitle - a single tab title
	 * @param $value the option array that contains the data to be printed
	 * @param $i the index of the content block that will be opened when the tab is clicked
	 */
	function print_subtitle($value, $i){
		echo '<div id="tab_navigation-'.esc_attr($i).'-'.esc_attr($value['id']).'" class="sub-navigation-container">';
	}
	
	/**
	 * Prints a closing div tag.
	 */
	function print_close(){
		echo '</div>';
	}
	
	/**
	 * Prints the code that goes after each option.
	 * @param $value the array that contains all the data for the option
	 */
	function close_option($value){
		if(isset($value['desc'])){
			echo '<a href="" class="help-button"><div class="help-dialog" title="'.esc_attr(esc_html($value['name'])).'"><p>'.wp_kses_post($value['desc']).'</p></div></a>';
		}
		echo wp_kses_post($this->after_option);
	}

	/**
	 * Prints a standart text field.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Text Field Title",
	 *	"id" => $shortname."_test_textfield",
	 *	"type" => "text"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_text_field($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo '<input class="option-input" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="'.esc_attr($value['type']).'" value="'.esc_attr($input_value).'" />';
		$this->close_option($value);
	}
	
	
	/* new trick shot. fu ultimate! */
	function print_fakeinput($value){

		if (isset($value['el_class']) && $value['el_class'] == 'show_on_front') $std = get_option('page_on_front');
		else $std = get_option('ultimate_selected_google_fonts');
		$input_value = $this->get_field_value($value['id'], $std);

		if (isset($value['el_class']) && $value['el_class'] == 'show_on_front'){
			if ($input_value != $std) $input_value = $std;
		} else {
			if ($input_value != $std) $input_value = ($std) ? stripslashes(serialize($std)) : "";	
		}

		echo "<textarea style='display:none;' id='".esc_attr($value['id'])."' name='".esc_attr($value['id'])."' value='".esc_attr($input_value)."' class='option-textarea' cols='' rows=''>";
		echo wp_kses_post($input_value);
		echo "</textarea>";
	}
	
	
	function print_slider_field($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="slider" title="'.esc_attr($value['id']).'"></div><input class="option-input slider-input" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="text" value="'.esc_attr($input_value).'" style="text-align: center; border: 0; background: none; color: #314572; width: 201px; padding: 5px 0 0 0; margin: 0; font-style: italic;" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a textarea.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Textarea Name",
	 *	"id" => $shortname."_test_textarea",
	 *	"type" => "textarea")
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_textarea($value){
		global $allowedtags;
		if (isset($value['name'])) echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		if (isset($value['params']) && $value['params'] == 'hazel_rich_editor'){
			echo '<div class="option" style="height: 500px;"> <div style="position:absolute;top:0;bottom:0;left:0;right:0;" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" class="option-textarea" cols="" rows="">'.wp_kses($input_value, $allowedtags).'</div><textarea style="display:none;" name="'.esc_attr($value['id']).'" class="option-textarea" cols="" rows="">'.wp_kses($input_value, $allowedtags).'</textarea></div>';
			?>
			<script type="text/javascript">
				"use strict";
				var editor = ace.edit("<?php echo esc_attr($value['id']); ?>");
				    editor.setTheme("ace/theme/xcode");
				    editor.getSession().setMode("ace/mode/css")
				    editor.getSession().setUseWrapMode(true);
				    editor.getSession().on('change', function(e) {
					    jQuery('textarea[name="<?php echo esc_js(esc_attr($value['id'])); ?>"]').html( editor.getValue() );
					});
					
					jQuery(document).ready(function() {
				    jQuery('.note_box .close').on('click', function(e) { 
				        jQuery('#notebox').remove(); 
				    });
				});
				
			</script>
			<?php
		} else {
			echo ' <textarea name="'.esc_attr($value['id']).'" class="option-textarea" cols="" rows="">'.wp_kses($input_value, $allowedtags).'</textarea>';
		}
		?> 
		
		<?php
		
		$this->close_option($value);
	}
	
	function print_textarea_wysiwyg($value){
		if (isset($value['name']))
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo ' <div class="textarea_wysiwyg_container"><textarea style="display:none;" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" class="option-textarea" cols="" rows="">'.wp_kses_post($input_value).'</textarea>';
		wp_editor( $input_value, $value['id']."_editor", $settings = array() );
		submit_button( 'Save content' );
		echo '</div>';
		
		$hazel_admin_inline_script = (isset($hazel_admin_inline_script)) ? $hazel_admin_inline_script : "";
		$hazel_admin_inline_script .= '
			jQuery(document).ready(function(){
				jQuery("#wp-'.esc_js($value['id']).'_editor-wrap").siblings("p.submit").children("#submit").click(function(e){ 
					e.stopPropagation();e.preventDefault();
jQuery("#'.esc_js($value['id']).'").html( jQuery("iframe#'.esc_js($value['id']).'_editor_ifr").contents().find("#tinymce.'.esc_js($value['id']).'_editor" ).html() ) });
			});
		';
		wp_add_inline_script('hazel-admin', $hazel_admin_inline_script, 'after');
		
		$this->close_option($value);
	}
	
	/**
	 * Prints a select drop down menu.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Featured Category",
	 *	"id" => $shortname."_featured_cat",
	 *	"type" => "select",
	 *	"options" => array(array("name"=>"Option one", "id"=>1), array("name"=>"Option two", "id"=>2))
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_select($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
			
		echo '<select class="option-select" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'">';
		
		foreach ($value['options'] as $option) {
			$attr='';
			if (isset($option['id'])){
				 if ( get_option( $value['id'] ) == $option['id']) {
					$attr = ' selected="selected"';
				 }
			 	 if ( $option['id'] == 'disabled') {
					$attr.= ' disabled="disabled"';
				 }
				 if (isset($option['class'])){
					$attr.=' class="'.esc_attr($option['class']).'"';			 	
				 }
				echo '<option '.$attr.' value="'.esc_attr($option['id']).'">'.esc_html($option['name']).'</option>';	
			} 
		} 
	
		echo '</select>';
		$this->close_option($value);
	}	
	
	
	/**
	 * Prints a multicheck widget.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Exclude categories",
	 *	"id" => $shortname."_exclude_cat",
	 *	"type" => "multicheck",
	 *  "class" => "exclude", //exclude|include
	 *	"options" => array(array("name"=>"Option one", "id"=>1), array("name"=>"Option two", "id"=>2))
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_multicheck($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		
		$checked_class=$value['class']==''?'include':$value['class'];
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" class="hidden-value" /><div class="option-check '.esc_attr($checked_class).'">';
		
		$input_array=explode(',',$input_value);
		foreach ($value['options'] as $option) {
			$class='';	
			 if (in_array($option['id'], $input_array)) {
				$class = ' selected-check';
			 }
			echo '<div class="check-holder"><a href="" class="check'.esc_attr($class).'" title="'.esc_attr($option['id']).'"></a><span class="check-value">'.esc_html($option['name']).'</span></div>'; 
		} 
		echo '</div>';
	
		$this->close_option($value);
	}
	
	/**
	 * Prints a text field with a color picker option.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Headings color",
	 *	"id" => $shortname."_heading_color",
	 *	"type" => "color"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_color($value){
		
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		
		if ($input_value == '__USE_THEME_MAIN_COLOR__'){
			$is_checked = ' style=\'margin-left: 49px;\' ';
			$firstvalue = "on";
			$otherelements = ' style=display:none; ';
			$lastone = 'display:none;';
		} else {
			$is_checked = ' style=\'margin-left: 2px;\' ';
			$firstvalue = "off";
			$lastone = $otherelements = '';
		}
		$params=isset($value['params'])?$value['params']:'';
		
		if ($params!="no-main-color"){
			echo '<div class=\'color_with_main_color_checker\'><h4>Use Theme Main Color ? </h4><div class=\'main_color_theme_helper on-off\' onclick=\' if (jQuery(this).siblings(".use_main_theme_color_helper").val()=="off"){ jQuery(this).siblings().not("h4").fadeOut(); jQuery(this).siblings("input.option-input").val("__USE_THEME_MAIN_COLOR__"); } else { jQuery(this).siblings("input.option-input").val(""); jQuery(this).siblings().not("h4").fadeIn(); } \' ><span '.$is_checked.'></span></div><input name=\'use_main_theme_color_helper\' class=\'use_main_theme_color_helper\' type=\'hidden\' value=\''.$firstvalue.'\'><div class=\'clear\'></div>';
		}
		echo '<span class=\'numbersign\' '.esc_html($otherelements).'>&#35;</span><input '.esc_html($otherelements).' class=\'option-input color\' name=\''.esc_attr($value['id']).'\' id=\''.esc_attr($value["id"]).'\' type=\'text\' value=\''.esc_attr($input_value).'\' />';
		echo '<div class=\'color-preview\' style=\'background-color:#'.esc_html($input_value).';'.esc_html($lastone).'\'></div>';
		
		if ($params!="no-main-color") echo '</div>';
		
		$this->close_option($value);
	}
	
	/**
	 * Prints a text field with an upload button.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Logo image",
	 *	"id" => $shortname."_logo_image",
	 *	"type" => "upload"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_upload($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo '<input class="option-input upload" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="text" value="'.esc_attr($input_value).'" />';
		echo '<div id="'.esc_attr($value['id']).'_button" class="upload-button upload-logo" ><a class="hazel-button alignright"><span class="upload-panel">Upload</span></a></div><br/>';
		$hazel_admin_inline_script = (isset($hazel_admin_inline_script)) ? $hazel_admin_inline_script : "";
		$hazel_admin_inline_script .= '
			jQuery(document).ready(function(){
				hazelOptions.loadUploader(jQuery("div#'.esc_js($value['id']).'_button"), "'.esc_js($this->hazel_utils_url).'upload-handler.php", "'.esc_js($this->hazel_uploads_url).'");
			});
		';
		wp_add_inline_script('hazel-admin', $hazel_admin_inline_script, 'after');
		
		$this->close_option($value);
	}
	
	
	
	/* PARIS NEW STUFF */
	
	/**
	 * Prints a text field with an upload button.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Logo image",
	 *	"id" => $shortname."_logo_image",
	 *	"type" => "uploadFromMedia"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_upload_from_media($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		?>
		
		<div class="uploader" id="upload-<?php echo esc_attr($value['id']); ?>">
		  <?php echo '<input class="option-input upload" name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="text" value="'.esc_attr($input_value).'" style="display:none;"/>'; ?>
		  <textarea type="textarea" style="display:none;"><?php echo wp_kses_post($input_value); ?></textarea>
		  <input class="button buttonUploader" name="<?php echo esc_attr($value['id']); ?>_button" id="<?php echo esc_attr($value['id']); ?>_button" value="Select Media" style="width:auto;text-align:center;"/>
		  <img class="previewimg" src="<?php echo esc_url($input_value); ?>" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;"/>
		</div>
		
		<?php
		$hazel_admin_inline_script = (isset($hazel_admin_inline_script)) ? $hazel_admin_inline_script : "";
		$hazel_admin_inline_script .= '
			jQuery(document).ready(function(){
				var uploadbox = "#upload-'.esc_js($value["id"]).'";
				var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
				var thumbs = jQuery(uploadbox + " .option-input").val();
				for (var i = 0; i < thumbs.length; i++){
					if (thumbs != ""){
						var url = thumbs;
						jQuery(uploadbox + " .previewimg").attr("src",url).css("display","block");
					}
				}

				jQuery(uploadbox + " .buttonUploader").click(function(e) {
					var button = jQuery(this);
					var id = button.attr("id").replace("upload-", "").replace("_button","");
					var custom_uploader = wp.media({
						title: "Select Media",
						button: {
							text: "Select Media"
						},
						multiple: false
					})
					.on("select", function() {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						if (attachment){
							jQuery(uploadbox + " .previewimg").attr("src",attachment.url).css("display","block");
						}
						jQuery("#"+id).val(attachment.url);
					})
					.open(button);
					return false;
				});
			});
		';
		wp_add_inline_script('hazel-admin', $hazel_admin_inline_script, 'after');
		
		$this->close_option($value);
	}
	
	
	
	/**
	 * Prints a checkbox - this is the ON/OFF widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "checkbox",
	 *	"std" => "off"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_checkbox($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std']))
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="on-off"><span></span></div>';
		if(isset($input_value) && $input_value=='true'){
			$input_value='on';
		}
		if(isset($input_value) && $input_value=='false'){
			$input_value='off';
		}
		if (isset($input_value))
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a checkbox - this is the TEXT/IMAGE widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "checkbox-text-image",
	 *	"std" => "text"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_checkbox_text_image($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="text-image"><span></span></div>';
		if($input_value=='true'){
			$input_value='text';
		}
		if($input_value=='false'){
			$input_value='image';
		}
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a checkbox - this is the LEFT/RIGHT widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "checkbox-left-right",
	 *	"std" => "text"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_checkbox_left_right($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="left-right"><span></span></div>';
		if($input_value=='true'){
			$input_value='right';
		}
		if($input_value=='false'){
			$input_value='left';
		}
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a checkbox with images - this is the LIGHT/DARK widget with an animation.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 *	array(
	 *	"name" => "Checkbox Title",
	 *	"id" => $shortname."_test_check",
	 *	"type" => "images",
	 *	"std" => "light"
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_checkbox_light_dark($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		$input_value = $this->get_field_value($value['id'], $value['std']);
		echo '<div class="light-dark"><span></span></div>';
		if($input_value=='true'){
			$input_value='light';
		}
		if($input_value=='false'){
			$input_value='dark';
		}
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" />';
		$this->close_option($value);
	}
	
	/**
	 * Prints a widget for selecting styles for the theme. Generally it prints different buttons with
	 * different styles set to them so that the user can select one of them. It can be mostly used for 
	 * selecting a color or a pattern from a given range.
	 * 
	 * EXAMPLE USAGE OF PATTERNS:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 *	"name" => "Theme Pattern",
	 *	"id" => $shortname."_pattern",
	 *	"type" => "pattern",
	 *	"options" => $patterns
	 *	)
	 * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 * @param $type the type of the buttons, so far the supported values are "color" and "pattern"
	 */
	function print_stylebox($value, $type){
		
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo '<div class="styles-holder '.$type.'">';
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" /><ul>';
		
		$counter=0;
		foreach ($value['options'] as $option) {
			//set a style the option if this is an option for selecting a color or pattern 
			if($type=='pattern') {
				//this is a pattern, set a background image to it
				if($option != "none")
					$style='background-image:url('.HAZEL_PATTERNS_URL.$option.');';
				else
					$style='background-image:none;';
			}elseif($type=='color'){
				//this is a color, set background color to it
				$style='background-color:#'.$option.';';
			}
			$class=$option==$input_value?'selected-style':'';
			
			echo '<li onclick="jQuery(this).parents(\'#tab_navigation-2-general\').find(\'#'."hazel".'_style_color\').attr(\'value\',\''.esc_js($option).'\'); jQuery(this).parents(\'#tab_navigation-2-general\').find(\'.color-preview\').css(\'background-color\',\'#'.esc_js($option).'\');" style="'.esc_attr($style).'" class="'.esc_attr($class).'"><a class="style-box" title="'.esc_attr($option).'" href=""></a></li>';
		} 
		echo '</ul></div>';
		$this->close_option($value);
	}
	
	/* new print website loaders */
/*
	function print_website_loaders($value){
		
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title);
		if (isset($value['std'])) $std = $value['std']; 
		else $std = "";
		$input_value = $this->get_field_value($value['id'], $std);
		echo '<div class="loaders-styles-holder">';
		echo '<input  name="'.esc_attr($value['id']).'" id="'.esc_attr($value['id']).'" type="hidden" value="'.esc_attr($input_value).'" /><div class="loaders-container">';
		
		$counter=0;
		foreach ($value['options'] as $option) {
			$divs = $selected = "";
			if ($option['id'] == $input_value) $selected = "selected";
			//set a style the option if this is an option for selecting a color or pattern 
			$class=$option['id'];
			//$class=$option==$input_value?'selected-style':'';
			$howMany = 0;
			switch($class){
				case "ball-clip-rotate": case "square-spin": case "ball-rotate": case "ball-scale": case "ball-scale-ripple":
					$howMany = 1;
				break;
				case "ball-clip-rotate-pulse": case "ball-clip-rotate-multiple": case "cube-transition": case "ball-zig-zag":
					$howMany = 2;
				break;
				case "ball-pulse": case "ball-triangle-path": case "ball-scale-multiple": case "ball-pulse-sync": case "ball-beat": case "ball-scale-ripple-multiple":
					$howMany = 3;
				break;
				case "line-scale-party":
					$howMany = 4;
				break;
				case "ball-pulse-rise": case "line-scale": case "line-scale-pulse-out": case "line-scale-pulse-out-rapid": case "pacman":
					$howMany = 5;
				break;
				case "ball-spin-fade-loader": case "line-spin-fade-loader":
					$howMany = 8;
				break;
				case "ball-grid-pulse":
					$howMany = 9;
				break;
			}
			
			for ($i=0; $i<$howMany; $i++) $divs .= "<div class='loader_build_helper-{$i}'></div>";
			
			if ($class == "load2" || $class == "load3" || $class == "load6"){
				echo '<div onclick="jQuery(this).closest(\'.loaders-styles-holder\').find(\'#'."hazel".'_website_loader\').attr(\'value\',\''.esc_js($option['id']).'\'); jQuery(this).addClass(\'selected\').siblings().removeClass(\'selected\');" class="loader-item '.esc_attr($selected).'"><div class="loaders-style-box '.esc_attr($class).'"><div class="loader"></div></div></div>';
			} else {
				echo '<div onclick="jQuery(this).closest(\'.loaders-styles-holder\').find(\'#'."hazel".'_website_loader\').attr(\'value\',\''.esc_js($option['id']).'\'); jQuery(this).addClass(\'selected\').siblings().removeClass(\'selected\');" class="loader-item '.esc_attr($selected).'"><div class="loaders-style-box loader-inner '.esc_attr($class).'">'.wp_kses_post($divs).'</div></div>';
			}
			
			
		} 
		echo '</div></div>';
		$this->close_option($value);
	}
*/
	
	/**
	 * Prints a custom set of fields with an Add button - this field will be mostly used when 
	 * several items that share the same data structure needs to be added. For example, this can be very
	 * useful for adding images to the slider with different options- title, link, etc.
	 * So far the fields that are supported by this function are text field, text field with upload button and a 
	 * textarea.
	 * 
	 * EXAMPLE USAGE:
	 * ------------------------------------------------------------------------------------------
	 * array(
	 *	"name"=>"Add Slider Image",
	 *	"id"=>'thumbnail_slider',
	 *	"type"=>"custom",
	 *	"button_text"=>'Add image',
	 *	"preview"=>"thumbnail_image_name",
	 *		"fields"=>array(
	 *			array('id'=>'thumbnail_image_name', 'type'=>'upload', 'name'=>'Image URL'),
	 *			array('id'=>'thumbnail_image_title', 'type'=>'text', 'name'=>'Image Title'),
	 *			array('id'=>'thumbnail_image_desc', 'type'=>'textarea', 'name'=>'Image Description')
	 *		)
	 *	)
     * ------------------------------------------------------------------------------------------
	 * @param $value the array that contains all the data for the option
	 */
	function print_custom($value){
		echo wp_kses_post($this->before_option_title.$value['name'].$this->after_option_title.'<br/><br/><br/>');
		
		$field_ids=array();
		$field_names=array();
		$is_textarea=array();
		
		foreach($value['fields'] as $field){
			echo '<div class="custom-option"><span class="custom-heading">'.esc_html($field['name']).'</span>';
			switch($field['type']){
				case 'text':
					//print a standart text field
					echo '<input type="text" id="'.esc_attr($field['id']).'" name="'.esc_attr($field['id']).'"/>';
					$is_textarea[]="false";
				break;
				case 'upload':
					//print a field with an upload button
					echo '<input class="option-input upload" name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'" type="text" />';
					echo '<div id="'.esc_attr($field['id']).'_button" class="upload-button upload-logo" ><a class="hazel-button alignright"><span>Upload</span></a></div><br/>';
					echo '<script type="text/javascript">jQuery(document).ready(function($){ "use strict";
								hazelOptions.loadUploader(jQuery("div#'.esc_js($field['id']).'_button"), "'.esc_js($this->hazel_utils_url).'upload-handler.php", "'.esc_js($this->hazel_uploads_url).'");
						});</script>';
					$preview=$field['id'];
					$is_textarea[]="false";
				break;
				case 'textarea':
					//print a textarea
					echo '<textarea id="'.esc_attr($field['id']).'" name="'.esc_attr($field['id']).'"></textarea>';
					$is_textarea[]="true";
				break;
				case 'select':
					if (isset($value['std'])) $std = $field['std']; 
					else $std = "";
					$input_value = $this->get_field_value($field['id'], $std);
					
					echo '<select class="option-select" name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'">';

					foreach ($field['options'] as $option) {
						$attr='';	
						 if ( get_option( $field['id'] ) == $option['id']) {
							$attr = ' selected="selected"';
						 }
					 	 if ( $field['id'] == 'disabled') {
							$attr.= ' disabled="disabled"';
						 }
						 if($option['class']){
							$attr.=' class="'.esc_attr($option['class']).'"';			 	
						 }
						echo '<option '.$attr.' value="http://fonts.googleapis.com/css?family='.$option['id'].'">'.$option['name'].'</option>'; 
					} 

					echo '</select><div>';
					$this->close_option($value);
					$is_textarea[]="true";
				break;
				
				//drag & drop block manager
				case 'sorter':
				
					$sortlists = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : $value['std'];
					
					$output .= '<div id="'.esc_attr($value['id']).'" class="sorter">';
					
					
					if ($sortlists) {
					
						foreach ($sortlists as $group=>$sortlist) {
						
							$output .= '<ul id="'.esc_attr($value['id']).'_'.$group.'" class="sortlist_'.esc_attr($value['id']).'">';
							$output .= '<h3>'.wp_kses_post($group).'</h3>';
							
							foreach ($sortlist as $key => $list) {
							
								$output .= '<input class="sorter-placebo" type="hidden" name="'.esc_attr($value['id']).'['.esc_attr($group).'][placebo]" value="placebo">';
									
								if ($key != "placebo") {
								
									$output .= '<li id="'.esc_attr($key).'" class="sortee">';
									$output .= '<input class="position" type="hidden" name="'.esc_attr($value['id']).'['.esc_attr($group).']['.esc_attr($key).']" value="'.esc_attr($list).'">';
									$output .= $list;
									$output .= '</li>';
									
								}
								
							}
							
							$output .= '</ul>';
						}
					}
					
					$output .= '</div>';
				break;
			}
			if (isset($value['std'])) $std = $value['std']; 
			else $std = "";
			$saved_value=$this->get_field_value( $field['id'].'s',$std );
						
			$saved_value=stripslashes($saved_value);
			echo '<input type="hidden" name="'.esc_attr($field['id']).'s" id="'.esc_attr($field['id']).'s" value="'.esc_attr($saved_value).'" />';
			echo '<textarea style="display:none;" name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'">'.wp_kses_post($saved_value).'</textarea></div>';
			$field_ids[]=$field['id'];
			$field_names[]=$field['name'];
			
			if ($field['id'] == "hazel_google_fonts_name"){
				$fonts = explode("|*|",$saved_value);
				if (count($fonts) > 1){
					echo '<script type="text/javascript">
					jQuery(document).ready(function(){ "use strict"; ';
					foreach($fonts as $f){
						if ($f != "")
							echo 'jQuery(\'#add_google_font_list\').append(\'<li><b>Font URL: </b><span class="hazel_google_fonts_name_span">'.$f.'</span><br><div class="editButton hover"></div><div class="deleteButton hover"></div></li>\');';
					}
					echo '});
					</script>';	
				}
			}
			
			
			if ($field['id'] == "hazel_sidebar_name_name"){
				$sidebars = explode("|*|",$saved_value);
				
				if (count($sidebars) > 0){
					echo '<script type="text/javascript">
					jQuery(document).ready(function(){';
						"use strict";
					foreach($sidebars as $s){
						if ($s != ""){
							echo 'jQuery(\'#sidebar_name_list\').append(\'<li><b>Name: </b><span class="hazel_sidebar_name_span">'.$s.'</span><br><div class="editButton hover"></div><div class="deleteButton hover"></div></li>\');';	
						}
					}
					echo '});
					</script>';	
				}
			}
		}
		
		//print the add button
		echo '<a class="hazel-button custom-option-button" id="'.esc_attr($value['id']).'_button"><span>'.wp_kses_post($value['button_text']).'</span></a>';
		
		//print the list that will contain the added items
		//if ($value['id'] != 'hazel_reset_options_button')
		echo '<ul id="'.esc_attr($value['id']).'_list" class="sortable"></ul>';
		
		$idsString=implode('","', $field_ids);
		$namesString=implode('","', $field_names);
		$textareaString=implode(',', $is_textarea);
		
		if (isset($value['preview'])) $prv = $value['preview']; 
		else $prv = "";
		
		//call the script that enables the functionality for adding custom fields
		$updir = wp_upload_dir();
		$optsxml = $updir['baseurl']."/options.xml";
		$urlassign = get_template_directory_uri()."/lib/functions/getXML.php?url=".esc_url(get_home_path());
		
		echo '<script type="text/javascript">
			jQuery(document).ready(function($){
				"use strict";
				hazelOptions.setCustomFieldsFunc("'.esc_js($value['id']).'", ["'.esc_js($idsString).'"], ["'.esc_js($namesString).'"], ['.esc_js($textareaString).'] , "'.esc_js($prv).'",  "");
				jQuery(\'#hazel_export_options_button\').css({\'position\':\'relative\',\'float\':\'left\'}).attr(\'target\',\'_blank\').unbind().click(function(){
					window.open("'.esc_js($urlassign).'");
				});
			});
		</script>';
		
		$this->close_option($value);
	}
	
	
	/* style this element button. can only be used for linking the panel to the style panel. for now. */
	
	
	
	
	/**
	 * Gets the saved value for a field
	 * @param $id the ID of the field
	 * @param $std the default value for the field
	 * @return string if there is a saved value, it returns the saved value,
	 * if not - it returns the default value
	 */
	function get_field_value($id, $std){
		
		if ( get_option( $id ) != "" || $this->first_save) {
			if (is_array(get_option($id)))
				return "";
			else 
				return stripslashes((string)get_option($id)); 
		} else {
			return stripslashes($std); 
		}
	}
	
	function print_text($value){
		echo wp_kses_post($this->before_option);
		echo wp_kses_post($value['text']);
		$this->close_option($value);
	}
	
	/**
	 * Prints the message that is displayed when the options have been saved
	 */
	function print_saved_message(){
		echo '<div class="note_box" id="saved_box">'.esc_html($this->themename).' settings saved.</div>';	
	}
	
	/**
	 * Prints the message that is displayed when the options have been reset
	 */
	function print_reset_message(){
		echo '<div><p>'.esc_html($this->themename).' settings reset.</p></div>';	
	}
	
	function print_mediauploader($value){
		$modal_update_href = esc_url( add_query_arg( array(
		    'page' => 'hazel_gallery',
		    '_wpnonce' => wp_create_nonce('hazel_gallery_options'),
		), admin_url('upload.php') ) );

		echo esc_url($modal_update_href);
	}
	
	/* new insta authorize */
	function print_insta_authorize($value){
	
		echo '<div class="option">';
	
		$admin_url = admin_url('themes.php?page=hazel_options');
		$theme = "hazel";
		$treethemes_client_id = "db5f04fc9ced476799f435dce970aabc";
		$redirect_url = "http://docs.treethemes.net/instagram-api/index.php";
		$authorize_url = "https://www.ins" . "tagr" . "am.com/oauth/authorize/?client_id=".$treethemes_client_id."&redirect_uri=".$redirect_url."?return_uri={$admin_url}&response_type=token&scope=basic&state={$theme}|||{$admin_url}" ;
	
		echo '<a class="button insta_buttons" target="_self" href="'.esc_url( $authorize_url ).'">Authorize Instagram</a>';
	
		echo '<a class="button" target="_self" href="'.esc_url( $admin_url . "&deauthorize_insta=1" ).'">Deauthorize Instagram</a>';
		
		if (isset($_GET['deauthorize_insta']) && $_GET['deauthorize_insta'] != false){
			update_option( 'hazel_insta_token', "" );
			echo '<div class="insta_authorization_message">Successfully deauthorized.</div>';
		} else {
			$input_value = get_option('hazel_insta_token');
	
			if (isset($_GET['access_token']) || $input_value != ""){
				echo '<div class="insta_authorization_message">Successfully authorized.</div>';
			
				if (isset($_GET['access_token'])){
					$input_value = $_GET['access_token'];
					update_option( 'hazel_insta_token', $input_value );
				}
			
			}
		
			if ($input_value != ""){
				$shards = explode(".", $input_value );
			
				$ig_info = $this->get_iguser_profile($input_value);
			
				echo '<div class="ig-image ig-label">Image</div><div class="ig-image ig-value">'. (isset($ig_info['profile_picture']) ? '<img src="'.esc_url($ig_info['profile_picture']).'" />' : '') .'</div>';
				echo '<div class="ig-id ig-label">ID</div><div class="id-id ig-value">'.esc_html($shards[0]).'</div>';
				echo '<div class="ig-user ig-label">User</div><div class="ig-user ig-value">@'.esc_html($ig_info['username']).'</div>';
				echo '<div class="ig-name ig-label">Name</div><div class="ig-name ig-value">'.esc_html($ig_info['full_name']).'</div>';
				echo '<div class="ig-token ig-label">Token</div><div class="ig-token ig-value">'.esc_html($input_value).'</div>';
			}
		
		}
	
		echo '</div>';
			
	}

	function get_iguser_profile($at) {
		$args = array(
			'access_token' => $at
		);
		$url = "https://ap" . "i.ins" . "tagr" . "am.com/v1/users/self";
		$response = $this->remote_get($url, $args);
	
		/* outs */
		if (empty($response)) {
			return false;
		}

		if (isset($response['meta']['code']) && ($response['meta']['code'] != 200) && isset($response['meta']['error_message'])) {
			$this->message = $response['meta']['error_message'];
			return false;
		}

		return isset($response['data']) ? $response['data'] : false;
	}

	function remote_get($url = null, $args = array()) {
		$url = add_query_arg($args, trailingslashit($url));
		$response = $this->validate_response(wp_remote_get($url, array('timeout' => 29)));
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
					'message' => esc_html__('Unknown error occurred, please try again', 'hazel')
				);
			}
		}
		return $response;
	}
	
	
}