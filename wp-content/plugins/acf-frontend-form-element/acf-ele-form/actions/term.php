<?php
namespace ACFFrontendForm\Module\Actions;

use ACFFrontendForm\Plugin;
use ACFFrontendForm\Module;
use ACFFrontendForm\Module\Classes\ActionBase;
use ACFFrontendForm\Module\Widgets;
use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module as Query_Module;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EditTerm extends ActionBase {
	
	public function get_name() {
		return 'term';
	}

	public function get_label() {
		return __( 'Term', 'acf-frontend-form-element' );
	}

	public function register_settings_section( $widget ) {
						
		$widget->start_controls_section(
			'section_edit_term',
			[
				'label' => $this->get_label(),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'main_action' => 'edit_term',
					'multi' => '',
				],
			]
		);
		
		$widget->add_control(
			'show_term_name',
			[
				'label' => __( 'Term Name Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default Term Name Field', 'acf-frontend-form-element' ),
					'custom' => __( 'Custom ACF Field', 'acf-frontend-form-element' ),
					'false' => __( 'None', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$widget->add_control(
			'term_name_field',
			[
				'label' => __( 'Term Name Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'options' => [],
				'condition' => [
					'show_term_name' => 'custom',
				],
			]
		);
		
		$widget->add_control(
			'term_to_edit',
			[
				'label' => __( 'Term To Edit', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'current_term',
				'options' => [
					'current_term'  => __( 'Current Term', 'acf-frontend-form-element' ),
					'select_term' => __( 'Select Term', 'acf-frontend-form-element' ),
				],
				'condition' => [
					'main_action' => 'edit_term',
				],
			]
		);
		if( ! class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ){		
			$widget->add_control(
				'term_select',
				[
					'label' => __( 'Term', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( '18', 'acf-frontend-form-element' ),
					'description' => __( 'Enter term id', 'acf-frontend-form-element' ),
					'condition' => [
						'term_to_edit' => 'select_term',
						'main_action' => 'edit_term',
					],
				]
			);		
		}else{			
			$widget->add_control(
				'term_select',
				[
					'label' => __( 'Term', 'acf-frontend-form-element' ),
					'label_block' => true,
					'type' => Query_Module::QUERY_CONTROL_ID,
					'autocomplete' => [
						'object' => Query_Module::QUERY_OBJECT_CPT_TAX,
						'display' => 'detailed',
					],				
					'condition' => [
						'term_to_edit' => 'select_term',
						'main_action' => 'edit_term',
					],
				]
			);
		}
		$widget->end_controls_section();
	}
	
	public function render_form( $settings, $term_name = null ){
		$term_name_html = '';

		if( $settings[ 'show_term_name' ] == 'default' ){
				$term_name_html = '<div class="acf-field acf-field-text acf-field--term-name is-required" data-name="_term_name" data-type="text" data-key="_term_name" data-required="0">
					<div class="acf-label">
						<label for="acf-_term_name">Term Name</label></div>
					<div class="acf-input">
					<div class="acf-input-wrap"><input type="text" id="acf-_term_name" name="acf[_term_name]" value="' . $term_name . '"></div></div>
				</div>';
			}
		
		return $term_name_html;
	}
	
	public function run( $post_id, $settings, $step_index = false, $steps = 0 ){	
		
		if( $settings[ 'show_term_name' ] == 'default' ){
			$term_name = $_POST['acf'][ '_term_name' ];
		}elseif( $settings[ 'show_term_name' ] == 'custom' && ! empty( $settings[ 'term_name_field' ] ) ){
			$term_name = $_POST['acf'][ $settings[ 'term_name_field' ] ];
		}else{
			return $post_id;
		}
		
		$term_id = explode( '_', $post_id );
		
		$term = get_term( $term_id );
		
		$tax = $term->taxonomy;
		
		$post_id = wp_update_term( $term_id, $tax, array(
			'name' => $term_name
		) );
		
		if( isset( $_POST[ 'acfef_widget_id' ] ) ){
			update_term_meta( $post_id, 'acfef_form_source', $_POST[ 'acfef_widget_id' ] );
		}
		
		return $post_id;
	}
}
