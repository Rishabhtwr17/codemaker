<?php
namespace ACFFrontendForm\Module\Classes;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

abstract class ActionBase {

	abstract public function get_name();

	abstract public function get_label();

	public function run( $post_id, $settings, $step_index = false, $steps = 0 ){
		return $post_id;
	}
	
	public function add_field_options( $widget, $field, $label, $options ){
		if( in_array( 'text', $options ) ){
			$widget->add_control(
				$field . '_text',
				[
					'label' => __( 'Label', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => $label,
					'default' => $label,
					'condition' => [
						'show_' . $field => 'default',
					],
				]
			);
		}		
		if( in_array( 'instruction', $options ) ){
			$widget->add_control(
				$field . '_instruction',
				[
					'label' => __( 'Title Instructions', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'show_' . $field => 'default'
					]
				]
			);
		}
		if( in_array( 'required', $options ) ){
			$widget->add_control(
				$field . '_required',
				[
					'label' => __( 'Required', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
					'label_off' => __( 'No','acf-frontend-form-element' ),
					'return_value' => 'true',
					'condition' => [
						'show_' . $field => 'default'
					]
				]
			);		
		}		
		if( in_array( 'width', $options ) ){
			$widget->add_responsive_control(
				$field . '_width',
				[
					'label' => __( 'Width', 'acf-frontend-form-element' ) . ' (%)',
					'type' => Controls_Manager::NUMBER,
					'min' => 30,
					'max' => 100,
					'default' => 100,
					'required' => true,
					'device_args' => [
						Controls_Stack::RESPONSIVE_TABLET => [
							'max' => 100,
							'required' => false,
						],
						Controls_Stack::RESPONSIVE_MOBILE => [
							'default' => 100,
							'required' => false,
						],
					],
					'min_affected_device' => [
						Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
						Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
					],
					'condition' => [
						'show_' . $field => 'default'
					]
				]
			);		
		}
		
		$widget->add_control(
			$field . '_field_end',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
	}

	/**
	 * @param Widget_Base $widget
	 */
	abstract public function register_settings_section( $widget );

}