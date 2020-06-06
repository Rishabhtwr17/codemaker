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

class EditUser extends ActionBase {
	
	public function get_name() {
		return 'user';
	}

	public function get_label() {
		return __( 'User', 'acf-frontend-form-element' );
	}
	
	public function register_fields_settings( $widget ){
		
		$widget->add_control(
			'user_fields',
			[
				'label' => __( 'User Fields', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		
		$widget->add_control(
			'show_username',
			[
				'label' => __( 'Username Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default Username Field', 'acf-frontend-form-element' ),
					'custom' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		$this->add_field_options( $widget, 'username', __( 'Username', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		
		$widget->add_control(
			'usernamefield_end',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);		
	

		$widget->add_control(
			'show_password',
			[
				'label' => __( 'Password Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default Password Field', 'acf-frontend-form-element' ),
					'custom' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		
		$this->add_field_options( $widget, 'password', __( 'Password', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		
		$widget->add_control(
			'confirm_password',
			[
				'label' => __( 'Confirm and Force Strong', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
				'condition' => [
					'show_password' => 'default'
				]
			]
		);
		$this->add_field_options( $widget, 'confirm_password', __( 'Confirm Password', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'width' ] );

		$widget->add_control(
			'password_strength',
			[
				'label' => __( 'Password Strength', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => '3',
				'options' => [
					'1'  => __( 'Very Weak', 'acf-frontend-form-element' ),
					'2' => __( 'Weak', 'acf-frontend-form-element' ),
					'3' => __( 'Medium', 'acf-frontend-form-element' ),
					'4' => __( 'Strong', 'acf-frontend-form-element' ),
				],
				'condition' => [
					'show_password' => 'default',
					'confirm_password' => 'true',
				],
			]
		);
		
		$widget->add_control(
			'passwordfield_end',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);		
		
		$widget->add_control(
			'show_email',
			[
				'label' => __( 'Email Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default Email Field', 'acf-frontend-form-element' ),
					'custom' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		$this->add_field_options( $widget, 'email', __( 'Email', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		
		$widget->add_control(
			'emailfield_end',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);		
		
		$widget->add_control(
			'show_first_name',
			[
				'label' => __( 'First Name Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default First Name Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		$this->add_field_options( $widget, 'first_name', __( 'First Name', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );

		$widget->add_control(
			'firstname_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);		
		
		$widget->add_control(
			'show_last_name',
			[
				'label' => __( 'Last Name Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Last Name Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		$this->add_field_options( $widget, 'last_name', __( 'Last Name', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		
		$widget->add_control(
			'lastname_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);		
		
		$widget->add_control(
			'show_bio',
			[
				'label' => __( 'Biographical Info Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'false',
				'options' => [
					'default'  => __( 'Default Bio Field', 'acf-frontend-form-element' ),
					'false' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		$this->add_field_options( $widget, 'bio', __( 'Bio', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		$widget->add_control(
			'bio_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);		
		
		
		$widget->add_control(
			'show_role',
			[
				'label' => __( 'Role Field', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'description' => 'Let your users choose their role. Note: this will override the "new user role" setting',
				'options' => [
					'default'  => __( 'Default Role Field', 'acf-frontend-form-element' ),
					'custom' => __( 'None/Custom', 'acf-frontend-form-element' ),
				],
			]
		);
		$this->add_field_options( $widget, 'role', __( 'Role', 'acf-frontend-form-element' ), [ 'text', 'instruction', 'required', 'width' ] );
		$widget->add_control(
			'role_field_options',
			[
				'label' => __( 'Roles to choose From', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'default' => [
					'subscriber',
				],
				'options' => acfef_get_user_roles(), 
				'condition' => [
					'show_role' => 'default',
				],
			]
		);
		$widget->add_control(
			'default_role_option',
			[
				'label' => __( 'Default Role Option', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => [
					'subscriber',
				],
				'options' => acfef_get_user_roles(), 
				'condition' => [
					'show_role' => 'default',
				],
			]
		);

		$widget->add_control(
			'role_end',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		
		do_action( 'acfef/user_fields', $widget );
		
	}

	public function register_settings_section( $widget ) {
		
					
		$widget->start_controls_section(
			'section_edit_user',
			[
				'label' => $this->get_label(),
				'tab' => Controls_Manager::TAB_CONTENT,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'main_action',
							'operator' => 'in',
							'value' => [ 'new_user', 'edit_user' ],
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
			'user_settings',
			[
				'label' => __( 'User Settings', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->edit_user_settings( $widget );
		$this->new_user_settings( $widget );
				
		$this->register_fields_settings( $widget );

		$widget->end_controls_section();
	}
	
	
	public function edit_user_settings( $widget ){
		$widget->add_control(
			'user_to_edit',
			[
				'label' => __( 'User To Edit', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'current_user',
				'options' => [
					'current_user'  => __( 'Current User', 'acf-frontend-form-element' ),
					'url_query' => __( 'URL Query', 'acf-frontend-form-element' ),
					'select_user' => __( 'Select User', 'acf-frontend-form-element' ),
				],
				'condition' => [
					'main_action' => 'edit_user',
				],
			]
		);
		$widget->add_control(
			'url_query_user',
			[
				'label' => __( 'URL Query', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'user_id', 'acf-frontend-form-element' ),
				'default' => __( 'user_id', 'acf-frontend-form-element' ),
				'description' => __( 'Enter the URL query parameter containing the id of the user you want to edit', 'acf-frontend-form-element' ),
				'condition' => [
					'main_action' => 'edit_user',
					'user_to_edit' => 'url_query',
				],
			]
		);	
		if( ! class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ){		
			$widget->add_control(
				'user_select',
				[
					'label' => __( 'User', 'acf-frontend-form-element' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( '18', 'acf-frontend-form-element' ),
					'default' => get_current_user_id(),
					'description' => __( 'Enter user id', 'acf-frontend-form-element' ),
					'condition' => [
						'main_action' => 'edit_user',
						'user_to_edit' => 'select_user',
					],
				]
			);		
		}else{			
			$widget->add_control(
				'user_select',
				[
					'label' => __( 'User', 'acf-frontend-form-element' ),
					'label_block' => true,
					'type' => Query_Module::QUERY_CONTROL_ID,
					'autocomplete' => [
						'object' => Query_Module::QUERY_OBJECT_AUTHOR,
						'display' => 'detailed',
					],				
					'default' => get_current_user_id(),
					'condition' => [
						'main_action' => 'edit_user',
						'user_to_edit' => 'select_user',
					],
				]
			);
		}
	}
	
	public function new_user_settings( $widget ){
		$widget->add_control(
			'new_user_role',
			[
				'label' => __( 'New User Role', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => 'subscriber',
				'options' => acfef_get_user_roles(),
				'condition' => [
					'main_action' => 'new_user',
				],
			]
		);
		
		$widget->add_control(
			'hide_admin_bar',
			[
				'label' => __( 'Hide WordPress Admin Area?', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'acf-frontend-form-element' ),
				'label_off' => __( 'Show','acf-frontend-form-element' ),
				'return_value' => 'true',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'main_action',
							'operator' => '==',
							'value' => 'new_user',
						],
						[
							'name' => 'new_user_role',
							'operator' => '!=',
							'value' => 'administrator',
						],	
					],
				],
			]
		);
		
		$widget->add_control(
			'login_user',
			[
				'label' => __( 'Log in as new user?', 'acf-frontend-form-element' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'acf-frontend-form-element' ),
				'label_off' => __( 'No','acf-frontend-form-element' ),
				'return_value' => 'true',
				'condition' => [
					'main_action' => 'new_user',
				],			
			]
		);			
		
		$widget->add_control(
			'user_manager',
			[
				'label' => __( 'Managing User', 'acf-frontend-form-element' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => acfef_get_user_id_fields(),
				'description' => __( 'Who will be in charge of editing this user\'s data? Options include current post author or a custom field name. ', 'acf-frontend-form-element' ),
				'condition' => [
					'main_action' => 'new_user',
				],
			]
		);

		
	}
	
	
	public function render_form( $settings, $wg_id ){		
		$user_data[ 'fields' ] = $this->default_fields( $settings, $wg_id );
			
		$user_data = apply_filters( 'acfef/user_fields_render', $user_data, $settings );
		
		return $user_data;
	}
	
	public function default_fields( $settings, $wg_id ){		
		$default_fields = [];
		
		$name = $settings[ 'show_username' ];
		$pass = $settings[ 'show_password' ];
		$confirm_pass = $settings[ 'confirm_password' ];
		$email = $settings[ 'show_email' ];
		$first_name = $settings[ 'show_first_name' ];
		$last_name = $settings[ 'show_last_name' ];
		$bio = $settings[ 'show_bio' ];
		
		if ( $name == 'default' ) {
			$field = 'username';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> 'username',
				'key'		=> $wg_id . '_username',
				'label'		=> $settings[ $field . '_text' ],
				'instructions' => $settings[ $field . '_instruction' ],
				'type'		=> 'text',
				'required'	=> $settings[ $field . '_required' ],
				'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'disabled'	=> ( $settings[ 'main_action' ] == 'edit_user' || isset( $_GET[ 'user_id' ] ) ) ? 1 : 0,
				'custom_username' => 1,
			) );
			$default_fields[] = $wg_id . '_username';
		}

		if( $pass == 'default' ){
			$field = 'password';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> 'user_password',
				'key'		=> $wg_id . '_user_password',
				'label'		=> $settings[ $field . '_text' ],
				'instructions' => $settings[ $field . '_instruction' ],
				'type'		=> 'password',
				'required'	=> $settings[ $field . '_required' ], 'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'custom_password' => 1,
			) );
			$default_fields[] = $wg_id . '_user_password';	
		}
		if( $confirm_pass == 'true' ){
			$field = 'confirm_password';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> 'user_password_confirm',
				'key'		=> $wg_id . '_user_password_confirm',
				'label'		=> $settings[ $field . '_text' ],
				'instructions' => $settings[ $field . '_instruction' ],
				'type'		=> 'password',
				'required'	=> $settings[ 'password_required' ],
				'wrapper' => [
					'width' => $settings[ $field . '_width' ],
					'class' => 'acfef_password_confirm',
				],
				'custom_password_confirm' => 1,
			) );
			$default_fields[] = $wg_id . '_user_password_confirm';
		}
		if( $email == 'default' ){
			$field = 'email';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> 'user_email',
				'key'		=> $wg_id . '_user_email',
				'label'		=> $settings[ $field . '_text' ],
				'instructions' => $settings[ $field . '_instruction' ],
				'type'		=> 'email',
				'required' => $settings[ $field . '_required' ], 'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'custom_email' => 1,
			) );
			$default_fields[] = $wg_id . '_user_email';
		}
		if( $first_name == 'default' ){
			$field = 'first_name';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> 'first_name',
				'key'		=> $wg_id . '_first_name',
				'label'		=> $settings[ $field . '_text' ],
				'instructions' => $settings[ $field . '_instruction' ],
				'type'		=> 'text',
				'required' => $settings[ $field . '_required' ], 'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'custom_first_name' => 1,
			) );
			$default_fields[] = $wg_id . '_first_name';
		}		
		if( $last_name == 'default' ){
			$field = 'last_name';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> 'last_name',
				'key'		=> $wg_id . '_last_name',
				'label'		=> $settings[ $field . '_text' ],
				'instructions' => $settings[ $field . '_instruction' ],
				'type'		=> 'text',
				'required' => $settings[ $field . '_required' ], 'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'custom_last_name' => 1,
			) );
			$default_fields[] = $wg_id . '_last_name';
		}		
		if( $bio == 'default' ){
			$field = 'bio';
			acf_add_local_field( array(
				'prefix'	=> 'acf',
				'name'		=> 'description',
				'key'		=> $wg_id . '_user_bio',
				'label'		=> $settings[ $field . '_text' ],
				'instructions' => $settings[ $field . '_instruction' ],
				'type'		=> 'textarea',
				'rows' => '3',
				'required' => $settings[ $field . '_required' ], 'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
				'custom_user_bio' => 1,
			) );
			$default_fields[] = $wg_id . '_user_bio';
		}
		
			$role = $settings[ 'show_role' ];

			if( $role == 'default' ){
				$roles = [];
				if( $settings[ 'role_field_options' ] ){
					foreach( $settings[ 'role_field_options' ] as $role_option ){
						$roles[ $role_option ] = ucwords( $role_option );
					}
				}
				$field = 'role';
				acf_add_local_field( array(
					'prefix'	=> 'acf',
					'name'		=> '_user_role',
					'key'		=> $wg_id . '_user_role',
					'label'		=> $settings[ $field . '_text' ],
					'instructions' => $settings[ $field . '_instruction' ],
					'type'		=> 'select',
					'required' => $settings[ $field . '_required' ], 'wrapper' => [  'width' => $settings[ $field . '_width' ]  ],
					'choices' => $roles,
					'default_value' => $settings[ 'default_role_option' ],
					'return_format' => 'value',	
					'custom_role_select' => 1,
			) );
				$default_fields[] = $wg_id . '_user_role';
			}
			
		return $default_fields;

	}
	
	public function run( $post_id, $settings, $step_index = false, $steps = 0 ){
		if( 'edit_user' == $settings[ 'main_action' ] ) return $post_id; 
		
		$user_to_insert = [];								 
		
		if( 'new_user' == $settings[ 'main_action' ] ){
			
			if( isset( $_POST[ 'custom_username' ] ) ){ 
				$user_to_insert[ 'user_login' ] = $_POST[ 'acf' ][ $_POST[ 'custom_username' ] ];			
			}else{
				$user_to_insert[ 'user_login' ] = $this->acfef_generate_username();
			}

			if( isset( $_POST[ 'custom_password' ] ) ){ 
				$user_to_insert[ 'user_pass' ] = $_POST[ 'acf' ][ $_POST[ 'custom_password' ] ];
			}else{
				$user_to_insert[ 'user_pass' ] = wp_generate_password();
			}	
			
			if( isset( $_POST[ 'custom_email' ] ) ){ 
				$user_to_insert[ 'user_email' ] = $_POST[ 'acf' ][ $_POST[ 'custom_email' ] ];	
			}	
			
			$user_to_insert[ 'role' ] = $settings[ 'new_user_role' ];
			$user_to_insert[ 'show_admin_bar_front' ] = $settings[ 'hide_admin_bar' ];
			
			if( isset( $_POST[ 'custom_role_select' ] ) ){ 
				$user_to_insert[ 'role' ] = $_POST[ 'acf' ][ $_POST[ 'custom_role_select' ] ];			
			}
			
			$user_to_insert = apply_filters( 'acfef/user_fields_save', $user_to_insert, $settings );
			
			$user_id = wp_insert_user( $user_to_insert );  

			if ( ! is_wp_error( $user_id ) ) {
				update_user_meta( $user_id, 'hide_admin_area', $settings[ 'hide_admin_bar' ] );
				if( $settings[ 'user_manager' ] ){
					global $post;
     				$post_author = $post->post_author;
					$manager = $post_author;
					if( $settings[ 'user_manager' ] != '[author]' ){
						$manager = get_field( $settings[ 'user_manager' ] );
					}
					update_user_meta( $user_id, 'author', $manager );
				}
				if( isset( $_POST[ 'acfef_widget_id' ] ) ){
					update_user_meta( $user_id, 'acfef_form_source', $_POST[ 'acfef_widget_id' ] );
				}
				if( $settings[ 'login_user' ] ){
					$user_login = $user_to_insert[ 'user_login' ];
					wp_set_current_user( $user_id, $user_login );
					wp_set_auth_cookie( $user_id );
				}
				return 'user_' . $user_id;
			}else{	
				return '-1';
			}
		}
	}  
	
	public function acfef_generate_username() {

		$username = sanitize_title( 'user' );

		static $i;
		if ( null === $i ) {
			$i = 1;
		} else {
			$i ++;
		}
		if ( ! username_exists( $username ) ) {
			return $username;
		}
		$new_username = sprintf( '%s-%s', $username, $i );
		if ( ! username_exists( $new_username ) ) {
			return $new_username;
		} else {
			return $this->acfef_generate_username();
		}
	}
	
}
