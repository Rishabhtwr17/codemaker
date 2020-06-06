<?php
namespace ACFFrontendForm\Module\Actions;

use ACFFrontendForm\Plugin;
use ACFFrontendForm\Module\ACFEF_Module;
use ACFFrontendForm\Module\Classes\ActionBase;
use ACFFrontendForm\Module\Widgets;
use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module as Query_Module;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EditPost extends ActionBase {
	
	public function get_name() {
		return 'post';
	}

	public function get_label() {
		return __( 'Post', 'acf-frontend-form-element' );
	}
	
	public function register_fields_settings( $widget ){
		
		
		$widget->add_control(
			'post_fields',
			[
				'label' => __( 'Post Fields', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		
		
		$widget->add_control(
			'show_title',
			[
				'label' => __( 'Post Title Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default Post Title Field', 'acf-frontend-form-element' ),
					'structure'  => __( 'Custom Structure', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$widget->add_control(
			'title_structure',
			[
				'label' => __( 'Title Structure', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Post Title', 'acf-frontend-form-element' ),
				'description' => __( 'Structure the title field. You can use shortcodes for text fields. Foe example: [acf name="text"]', 'acf-frontend-form-element' ),
				'default' => __( 'Post Title', 'acf-frontend-form-element' ),
				'condition' => [
					'show_title' => 'structure',
				],
			]
		);	
	
		$widget->add_control(
			'title_slug',
			[
				'label' => __( 'Set as Slug', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
				'condition' => [
					'show_title' => 'default'
				]
			]
		);	
		$this->add_field_options( $widget, 'title', __( 'Post Title', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		

		
		$widget->add_control(
			'show_content',
			[
				'label' => __( 'Post Content Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Post Content Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$this->add_field_options( $widget, 'content', __( 'Post Content', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );		

		
		$widget->add_control(
			'show_featured_image',
			[
				'label' => __( 'Post Featured Image Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Featured Image Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
				
		$this->add_field_options( $widget, 'featured_image', __( 'Featured Image', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );

		
		$widget->add_control(
			'show_excerpt',
			[
				'label' => __( 'Post Excerpt Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Post Excerpt Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$this->add_field_options( $widget, 'excerpt', __( 'Post Excerpt', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		
		$widget->add_control(
			'show_categories',
			[
				'label' => __( 'Post Categories Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Categories Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$this->add_field_options( $widget, 'categories', __( 'Categories', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
	
		
		$widget->add_control(
			'show_tags',
			[
				'label' => __( 'Post Tags Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Tags Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		$this->add_field_options( $widget, 'tags', __( 'Tags', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );

		
		do_action( 'acfef/post_fields', $widget );
		

	}

	public function register_settings_section( $widget ) {
		
						
		$widget->start_controls_section(
			'section_edit_post',
			[
				'label' => $this->get_label(),
				'tab' => Controls_Manager::TAB_CONTENT,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'main_action',
							'operator' => 'in',
							'value' => [ 'new_post', 'edit_post' ],
						],	
						[
							'name' => 'multi',
							'operator' => '==',
							'value' => '',
						],
					],
				],
			]
		);
				
		$widget->add_control(
			'post_settings',
			[
				'label' => __( 'Post Settings', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		
		$widget->add_control(
			'new_post_status',
			[
				'label' => __( 'Post Status', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => 'publish',
				'options' => [
					'draft' => __( 'Draft', 'acf-frontend-form-element' ),
					'private' => __( 'Private', 'acf-frontend-form-element' ),
					'pending' => __( 'Pending Review', 'acf-frontend-form-element' ),
					'publish'  => __( 'Published', 'acf-frontend-form-element' ),
				],
			]
		);

		$this->edit_post_settings( $widget );
		$this->new_post_settings( $widget );	
		

		
		$widget->add_control(
			'show_delete_button',
			[
				'label' => __( 'Delete Post Option', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
				'condition' => [
					'main_action' => 'edit_post',
				],
			]
		);
		
		$widget->add_control(
			'delete_button_text',
			[
				'label' => __( 'Delete Button Text', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Delete', 'acf-frontend-form-element' ),
				'placeholder' => __( 'Delete', 'acf-frontend-form-element' ),
				'condition' => [
					'main_action' => 'edit_post',
					'show_delete_button' => 'true',
				],
			]
		);
		$widget->add_control(
			'confirm_delete_message',
			[
				'label' => __( 'Confirm Delete Message', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'The post will be deleted. Are you sure?', 'acf-frontend-form-element' ),
				'placeholder' => __( 'The post will be deleted. Are you sure?', 'acf-frontend-form-element' ),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'main_action',
							'operator' => '==',
							'value' => 'edit_post',
						],
						[
							'name' => 'show_delete_button',
							'operator' => '==',
							'value' => 'true',
						],
					],
				],
			]
		);

			
		$widget->add_control(
			'post_settings_end',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->register_fields_settings( $widget );
		
		$widget->end_controls_section();
	}
	
	public function edit_post_settings( $widget ){
		$widget->add_control(
			'post_to_edit',
			[
				'label' => __( 'Post To Edit', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'current_post',
				'options' => [
					'current_post'  => __( 'Current Post', 'acf-frontend-form-element' ),
					'url_query' => __( 'Url Query', 'acf-frontend-form-element' ),
					'select_post' => __( 'Select Post', 'acf-frontend-form-element' ),
				],
				'condition' => [
					'main_action' => 'edit_post',
				],
			]
		);
		$widget->add_control(
			'url_query_post',
			[
				'label' => __( 'URL Query', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'post_id', 'acf-frontend-form-element' ),
				'default' => __( 'post_id', 'acf-frontend-form-element' ),
				'description' => __( 'Enter the URL query parameter containing the id of the post you want to edit', 'acf-frontend-form-element' ),
				'condition' => [
					'main_action' => 'edit_post',
					'post_to_edit' => 'url_query',
				],
			]
		);	
		if( ! class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ){
			$widget->add_control(
				'post_select',
				[
					'label' => __( 'Post', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( '18', 'acf-frontend-form-element' ),
					'description' => __( 'Enter the post ID', 'acf-frontend-form-element' ),
					'condition' => [
						'main_action' => 'edit_post',
						'post_to_edit' => 'select_post',
					],
				]
			);		
		}else{
			$widget->add_control(
				'post_select',
				[
					'label' => __( 'Post', 'acf-frontend-form-element' ),
					'type' => Query_Module::QUERY_CONTROL_ID,
					'options' => [
						'' => 0,
					],
					'label_block' => true,
					'autocomplete' => [
						'object' => Query_Module::QUERY_OBJECT_POST,
						'display' => 'detailed',
						'query' => [
							'post_type' => 'any',
							'post_status' => 'any',
						],
					],
					'default' => 0,
					'condition' => [
						'main_action' => 'edit_post',
						'post_to_edit' => 'select_post',
					],
				]
			);
		}
	}
	
	public function new_post_settings( $widget ){
		$post_type_choices = acfef_get_post_type_choices();    
		
		$widget->add_control(
			'new_post_type',
			[
				'label' => __( 'New Post Type', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => 'post',
				'options' => $post_type_choices,
				'condition' => [
					'main_action' => 'new_post',
				],
			]
		);
		$widget->add_control(
			'new_post_terms',
			[
				'label' => __( 'New Post Terms', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => 'post',
				'options' => [
					'current_term'  => __( 'Current Term', 'acf-frontend-form-element' ),
					'select_terms' => __( 'Select Term', 'acf-frontend-form-element' ),
				],
				'condition' => [
					'main_action' => 'new_post',
				],
			]
		);
		if( ! class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ){
			$widget->add_control(
				'new_terms_select',
				[
					'label' => __( 'Terms', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( '18, 12, 11', 'acf-frontend-form-element' ),
					'description' => __( 'Enter the a comma-seperated list of term ids', 'acf-frontend-form-element' ),
					'condition' => [
						'main_action' => 'new_post',
						'new_post_terms' => 'select_terms',
					],
				]
			);		
		}else{		
			$widget->add_control(
				'new_terms_select',
				[
					'label' => __( 'Terms', 'acf-frontend-form-element' ),
					'type' => Query_Module::QUERY_CONTROL_ID,
					'label_block' => true,
					'autocomplete' => [
						'object' => Query_Module::QUERY_OBJECT_TAX,
						'display' => 'detailed',
					],		
					'multiple' => true,
					'condition' => [
						'main_action' => 'new_post',
						'new_post_terms' => 'select_terms',
					],
				]
			);
		}
		
		$widget->add_control(
			'drafts_start',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$widget->add_control(
			'saved_drafts',
			[
				'label' => __( 'Show Saved Drafts Selection', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
				'condition' => [
					'main_action' => 'new_post',
				],
			]
		);
		$widget->add_control(
			'saved_drafts_label',
			[
				'label' => __( 'Edit Draft Text', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Edit a draft', 'acf-frontend-form-element' ),
				'placeholder' => __( 'Edit a draft', 'acf-frontend-form-element' ),
				'condition' => [
					'main_action' => 'new_post',
					'saved_drafts' => 'true',
				],
			]
		);		
		$widget->add_control(
			'saved_drafts_new',
			[
				'label' => __( 'New Draft Text', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '&mdash; New Post &mdash;', 'acf-frontend-form-element' ),
				'placeholder' => __( '&mdash; New Post &mdash;', 'acf-frontend-form-element' ),
				'condition' => [
					'main_action' => 'new_post',
					'saved_drafts' => 'true',
				],
			]
		);
		$widget->add_control(
			'save_progress_button',
			[
				'label' => __( 'Save As Draft Option', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
				'condition' => [
					'main_action' => 'new_post',
					'new_post_status' => [ 'publish', 'pending' ],
				],
			]
		);
		$widget->add_control(
			'saved_draft_text',
			[
				'label' => __( 'Save Draft Text', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Save as Draft', 'acf-frontend-form-element' ),
				'placeholder' => __( 'save as Draft', 'acf-frontend-form-element' ),
				'dynamic' => [
					'active' => true,
				],				
				'condition' => [
					'main_action' => 'new_post',
					'new_post_status' => [ 'publish', 'pending' ],
					'save_progress_button' => 'true',
				],
			]
		);
		$widget->add_control(
			'saved_draft_desc',
			[
				'label' => __( 'Save Draft Description', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Want to finish later?', 'acf-frontend-form-element' ),
				'dynamic' => [
					'active' => true,
				],				
				'condition' => [
					'main_action' => 'new_post',
					'new_post_status' => [ 'publish', 'pending' ],
					'save_progress_button' => 'true',
					'multi!' => 'true',
				],
			]
		);

		

	}
	
	
	public function render_form( $settings, $wg_id ){
		$post_data[ 'fields' ] = $this->default_fields( $settings, $wg_id );
		
		$post_data = apply_filters( 'acfef/post_fields_render', $post_data, $settings );
		
		return $post_data;
	}
	
	public function default_fields( $settings, $wg_id ){
		$default_fields = [];
		
		$title = $settings[ 'show_title' ];
		$content = $settings[ 'show_content' ];		
		$image = $settings[ 'show_featured_image' ];
		$excerpt = $settings[ 'show_excerpt' ];
		$cats = $settings[ 'show_categories' ];
		$tags = $settings[ 'show_tags' ];

		if( $title == 'default' ){
			$field = 'title';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_post_title',
				'key'		=> $wg_id . '_post_title',
				'label'		=> $settings[ $field . '_text' ],
				'type'		=> 'text',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ],
				'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'custom_title' => true,
				'custom_slug' => $settings[ 'title_slug' ]
			) );
			$default_fields[] = $wg_id . '_post_title';
		}
		if( $content == 'default' ){
			$field = 'content';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_post_content',
				'key'		=> $wg_id . '_post_content',
				'label'		=> $settings[ $field . '_text' ],
				'type'		=> 'wysiwyg',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 
				'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'custom_content' => true
			) );
			$default_fields[] = $wg_id . '_post_content';
		}
		if( $image == 'default' ){
			$field = 'featured_image';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_post_featured_image',
				'key'		=> $wg_id . '_post_featured_image',
				'label'		=> $settings[ $field . '_text' ],
				'type'		=> 'image',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 
				'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'return_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'custom_feature_image' => 1,
			) );
			$default_fields[] = $wg_id . '_post_featured_image';
		}
		if( $excerpt == 'default' ){
			$field = 'excerpt';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_post_excerpt',
				'key'		=> $wg_id . '_post_excerpt',
				'label'		=> $settings[ $field . '_text' ],
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ],
				'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'type'		=> 'textarea',
				'required'	=> false,
				'custom_excerpt' => true
			) );
			$default_fields[] = $wg_id . '_post_excerpt';
		}
		if( $cats == 'default' ){
			$field = 'categories';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_post_categories',
				'key'		=> $wg_id . '_post_categories',
				'label'		=> $settings[ $field . '_text' ],
				'type' 		=> 'taxonomy',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 
				'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'taxonomy' 	=> 'category',
				'field_type' => 'checkbox',
				'allow_null' => 0,
				'add_term' => 0,
				'save_terms' => 1,
				'load_terms' => 1,
				'return_format' => 'id',
			) );
			$default_fields[] = $wg_id . '_post_categories';
		}
		if( $tags == 'default' ){
			$field = 'tags';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> '_post_tags',
				'key'		=> $wg_id . '_post_tags',
				'label'		=> $settings[ $field . '_text' ],
				'type' 		=> 'taxonomy',
				'instructions' => $settings[ $field . '_instruction' ],
				'required' => $settings[ $field . '_required' ], 
				'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'taxonomy' 	=> 'post_tag',
				'field_type' => 'checkbox',
				'allow_null' => 0,
				'add_term' => 0,
				'save_terms' => 1,
				'load_terms' => 1,
				'return_format' => 'id',
			) );
			$default_fields[] = $wg_id . '_post_tags';
		}	
		return $default_fields;
	} 
	
	
	public function run( $post_id, $settings, $step_index = false, $steps = 0 ){			
		$module = ACFEF_Module::instance();
		
		$form_submit = $module->get_components( 'form_submit' );	
				
		$post_to_edit = array(
		  'ID' => $post_id,
		);

		$post_to_edit[ 'post_status' ] = $settings[ 'new_post_status' ];
		
		if( $settings[ 'save_progress_button' ] && isset( $_POST[ 'acfef_save_draft' ] ) ){
			$post_to_edit[ 'post_status' ] = 'draft';
		}
		
		remove_filter('acf/pre_save_post', array( $form_submit, 'on_submit' ), 10);

		$post_id = wp_update_post( $post_to_edit );
		
		if( isset( $_POST[ 'acfef_widget_id' ] ) ){
			update_post_meta( $post_id, 'acfef_form_source', $_POST[ 'acfef_widget_id' ] );
		}
		
		if( $settings[ 'new_post_terms' ] ){
			if( $settings[ 'new_post_terms' ] == 'select_terms' ){
				$first = false;
				$new_terms = $settings[ 'new_terms_select' ];
				if( is_string( $new_terms ) ){
					$new_terms = explode( ',', $settings[ 'new_terms_select' ] );
				}
				if( is_array( $new_terms ) ){
					foreach( $new_terms as $term_id ){
						$term = get_term( $term_id );
						if( $term ){
							wp_set_object_terms( $post_id, $term->term_id, $term->taxonomy, $first );
						}
						$first = true;
					}
				}
			}
			if( $settings[ 'new_post_terms' ] == 'current_term' ){
				$term = get_queried_object();
				if( $term ){
					wp_set_object_terms( $post_id, $term->term_id, $term->taxonomy );
				}
			} 
		}

		add_filter('acf/pre_save_post', array( $form_submit, 'on_submit' ), 10);
		
		return $post_id;
	}
	
}
