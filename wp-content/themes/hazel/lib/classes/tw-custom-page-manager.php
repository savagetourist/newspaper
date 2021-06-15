<?php

/**
 * Custom page manager - this class contains the main functionality for building custom pages -
 * creating their main structure.
 *
 */
Class HazelCustomPageManager{

	var $custom_page=null;
	var $id_prefix='';
	var $templater=null;
	var $taxonomy='';
	var $suffix='';
	var $default='';
	var $nonce='';

	/**
	 * Main constructor
	 * @param $custom_page a custom page object whose data will be used to build the page
	 * @param $id_prefix a prefix for the custom page field data
	 * @param $suffix the custom term suffix 
	 * @param $default the default term name for the custom post type category
	 * @param $nonce the name of the nonce to be generated
	 */
	function __construct($custom_page, $id_prefix, $suffix, $default, $nonce){
		$this->custom_page=$custom_page;
		$this->id_prefix=$id_prefix;
		$this->suffix=$suffix;
		$this->default=$default;
		$this->nonce=$nonce;
	}

	/**
	 * Builds a page - calls the main functionality for creating the main structure of the
	 * custom page.
	 */
	function build_page(){
		$title='Default '.$this->custom_page->page_name;
		$category = get_term_by('name', $this->default, $this->custom_page->post_type.$this->suffix)->term_id;
		$this->templater=new HazelTemplater();
		$this->taxonomy=$this->custom_page->post_type.$this->suffix;
		$terms=get_terms($this->taxonomy, array('hide_empty'=>false, 'orderby'=>'id', 'order'=>'desc'));
		
		echo '<div class="custom-page-wrapper">';
		$this->_print_heading();

		//display all the instances of the page
		foreach($terms as $term){
			echo wp_kses_post($this->templater->get_before_custom_section($term->name));
			$this->_print_custom_section($term->name, $term->term_id);
			echo wp_kses_post($this->templater->get_after_custom_section());
		}

		echo wp_kses_post('<input type="hidden" value="'.esc_attr($this->taxonomy).'" id="taxnonomy_id" />
			  <input type="hidden" value="'.esc_attr($this->custom_page->post_type).'" id="post_type" />
			  <input type="hidden" value="'.esc_attr(wp_create_nonce(HAZEL_NONCE)).'" id="hazel_nonce" />
		      </div>');
	}

	/**
	 * Prints the heading of the custom page- the main title and an "Add instance" button.
	 */
	function _print_heading(){
		$html='';
		$html.='<h1>'.wp_kses_post($this->custom_page->page_name).'</h1>';

		//if the page allows multiple instances, add an "Add instance" button
		if($this->custom_page->allow_multiinstance){
			$html.='<a class="button new-instance-button">Add New '.esc_html($this->custom_page->page_name).'</a>';
		}

		echo wp_kses_post($html);
	}

	/**
	 * Prints the section that contains the form for adding new items
	 * @param $title the title of the section
	 * @param $category the custom category ID that corresponds to the custom section
	 */
	function _print_custom_section($title, $category){

		//build the section template
		echo wp_kses_post($this->templater->get_custom_page_form_template($title, $category, $this->custom_page, $this->id_prefix));
		$this->_print_items($category);

	}

	/**
	 * Prints the already added items to a section
	 * @param $category the custom category ID that corresponds to the custom section
	 */
	function _print_items($category){
		$args=array('numberposts' => -1, 
					'post_type' => $this->custom_page->post_type, 
					$this->taxonomy=>get_term($category, $this->taxonomy)->slug);
		$posts = get_posts( $args );
		
		$ordered_posts=hazel_get_ordered_post_list($posts, $category,$this->custom_page->post_type);

		$html='<ul class="sortable">';
		foreach($ordered_posts as $post){
			$html.=$this->templater->get_custom_page_list_template($post, $this->custom_page, $this->id_prefix);
		}

		$html.='</ul>';
		echo wp_kses_post($html);
	}

}