<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function acfef_get_field_data( $type = null ){
	$field_types = [];
	$acf_field_groups = acf_get_field_groups();
	// loop through array and add to field 'choices'
	if( is_array( $acf_field_groups ) ) {        
		foreach( $acf_field_groups as $field_group ) {
			$field_group_fields = acfef_get_group_fields( $field_group );
			
			if( is_array( $field_group_fields ) ) { 
				foreach( $field_group_fields as $acf_field ) {					
					$field_object = get_field_object( $acf_field->post_name );
					
					if( isset( $type ) ){
						if( $field_object[ 'type' ] == $type ){
							$field_types[ $acf_field->post_name] = $field_object[ 'label' ]; 
						}
					}else{
						$field_types[ $acf_field->post_name][ 'type' ] = $field_object[ 'type' ]; 
						$field_types[ $acf_field->post_name][ 'label' ] = $field_object[ 'label' ];  
						$field_types[ $acf_field->post_name][ 'name' ] = $field_object[ 'name' ];  
					}
				}
			} 
		}
	}
	return $field_types;
}	

function acfef_get_group_fields( $field_group ){
	if( is_array( $field_group ) && $field_group[ 'key' ] == 'acfef_hidden' ){
		return false;
	}
	
	if( ! is_array( $field_group ) ){
		$field_group = acf_get_field_group( $field_group );
	}
	//get options for "fields select" field
		$fields = get_posts( array(
		'posts_per_page'   => -1,
		'post_type'        => 'acf-field',
		'orderby'          => 'menu_order',
		'order'            => 'ASC',
		'suppress_filters' => true, // DO NOT allow WPML to modify the query
		'post_parent'      => $field_group['ID'],
		'post_status'      => 'any',
		'update_post_meta_cache' => false
	  ) );
	return $fields;
}

function acfef_get_group_field_keys( $field_group ){
	$fields = acfef_get_group_fields( $field_group );
	$keys = [];
	if( is_array( $fields ) ){
		foreach( $fields as $field ){
			$keys[] = $field->post_name;
		}
	}
	return $keys;
}

function acfef_get_grouped_fields(){
	$acfef_field_groups = [];
	$field_groups = acf_get_field_groups();
	foreach($field_groups as $field_group){
		$fields = acfef_get_group_field_keys( $field_group );
		$acfef_field_groups[$field_group['key']] = $fields;
	}
	return $acfef_field_groups;
}

function acfef_get_user_id_fields(){
	$fields = acfef_get_acf_field_choices( false, 'user' );
	$keys = array_merge( [ '[author]' => __( 'Post Author', 'acf-frontend-form-element' ) ],  $fields );
	return $keys;
}

function acfef_get_default_groups( $post_id ){
	$groups = [];
	global $post;
	$post_id = ( $_GET[ 'post' ] ) ? $post_id = $_GET[ 'post' ] : $post->ID;
	$post_groups = acf_get_field_groups( array( 'post_id' => $post_id ) );
	foreach($post_groups as $group){
		$groups[] = $group['key'];
	}
	return $groups;
}


function acfef_get_user_roles( $exceptions = [] ){
	$user_roles = [];
	global $wp_roles;
	// loop through array and add to field 'choices'
		foreach( $wp_roles->roles as $role => $settings ) {
			if( ! in_array( strtolower( $role ), $exceptions ) ){
				$user_roles[ $role ] = $settings[ 'name' ]; 
			}
		}
	return $user_roles;
}


function acfef_get_labeled_fields( $fields ){
	$field_choices = [];
	foreach( $fields as $field ){
		$field_object = get_field_object( $field );			
		$parent_group = get_post( $field_object[ 'parent' ] );
		$field_choices[ $field_object[ 'type' ] ][ $field ] = $field_object[ 'label' ] . ' (' . $parent_group->post_title . ')';
	}
	return $field_choices;
}

function acfef_get_acf_field_group_choices(){
	$field_group_choices = [];
	$acf_field_groups = acf_get_field_groups();
	// loop through array and add to field 'choices'
	if( is_array( $acf_field_groups ) ) {        
		foreach( $acf_field_groups as $field_group ) {
			if( is_array( $field_group ) && $field_group[ 'key' ] != 'acfef_hidden' ){
				$field_group_choices[ $field_group[ 'key' ] ] = $field_group[ 'title' ]; 
			}
		}
	}
	return $field_group_choices;
}	

function acfef_get_acf_field_choices( $groups = false, $type = false ){
	$user_fields = $all_fields = []; 
	if( $groups ){
		$acf_field_groups = $groups;
	}else{
		$acf_field_groups = acf_get_field_groups();
	}
	
	if( is_array( $acf_field_groups ) ) {        
		foreach( $acf_field_groups as $field_group ) {
			$field_group_fields = acfef_get_group_fields( $field_group );
			
			if( is_array( $field_group_fields ) ) { 
				foreach( $field_group_fields as $acf_field ) {
					$field_obj = get_field_object( $acf_field->post_name );
					$field_group = acf_get_field_group( $acf_field->post_parent );
					if( $type == 'user' && $field_obj[ 'type' ] == 'user' ){
						if( $field_obj[ 'multiple' ] == 0 && $field_obj[ 'return_format' ] == 'id' ){
							$user_fields[ $field_obj[ 'name' ] ] = $field_obj[ 'label' ];
						}
					}else{
						if( $groups ){
							$all_fields[] = $acf_field->post_name;
						}else{
							$all_fields[ $acf_field->post_name ] = $acf_field->post_title . ' (' . $field_group[ 'title' ] . ')'; 
						}
					}
				}
			} 
		}
	}
	if( $type == 'user' ){
		return $user_fields;
	}else{
		return $all_fields;
	}
	
}	

function acfef_get_post_type_choices(){
	$post_type_choices = [];
	$args = array(
		'public'   => true,
	);
	$output = 'names'; // names or objects, note names is the default
	$operator = 'and'; // 'and' or 'or'
	$post_types = get_post_types( $args, $output, $operator ); 
	// loop through array and add to field 'choices'
	if( is_array( $post_types ) ) {        
		foreach( $post_types as $post_type ) {
			$post_type_choices[ $post_type ] = str_replace( '_', ' ', ucfirst( $post_type ) ); 
		}
	}
	return $post_type_choices;
}

function acfef_get_image_folders(){
	$folders = [ 'all' => __( 'All Folders', 'acf-frontend-form-element' ) ];
	$taxonomies = get_terms( array(
		'taxonomy' => 'happyfiles_category',
		'hide_empty' => false
	) );

	if ( empty($taxonomies) ) {
		return $folders;
	}
	
	foreach( $taxonomies as $category ) {
		$folders[ $category->name ] = ucfirst( esc_html( $category->name ) );	
	}

	return $folders;
}


function acfef_get_client_ip() {
	$server_ip_keys = [
		'HTTP_CLIENT_IP',
		'HTTP_X_FORWARDED_FOR',
		'HTTP_X_FORWARDED',
		'HTTP_X_CLUSTER_CLIENT_IP',
		'HTTP_FORWARDED_FOR',
		'HTTP_FORWARDED',
		'REMOTE_ADDR',
	];

	foreach ( $server_ip_keys as $key ) {
		if ( isset( $_SERVER[ $key ] ) && filter_var( $_SERVER[ $key ], FILTER_VALIDATE_IP ) ) {
			return $_SERVER[ $key ];
		}
	}

	// Fallback local ip.
	return '127.0.0.1';
}

function acfef_get_site_domain() {
	return str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
}
