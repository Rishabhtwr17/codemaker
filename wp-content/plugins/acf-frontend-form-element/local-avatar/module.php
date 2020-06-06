<?php
namespace ACFFrontendForm\Module;

use ACFFrontendForm\Plugin;
use Elementor\Core\Base\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Local_Avatar_Module extends Module {
	
	public function get_name() {
		return 'local_avatar';
	}

	public function local_avatar_field( $args ) {
		$fields = acfef_get_field_data( 'image' );

		echo '<select name="local_avatar" id="local_avatar">';
		
			$default = ( get_option( 'local_avatar' ) == 'none' ) ? ' selected="selected"' : '';
		    echo '<option value="none"' . $default .  '>None</option>';
		
			$selected = get_option( 'local_avatar' );
			foreach( $fields as $key => $value ){
				$select = '';
				if( $key == $selected ){
					$select = ' selected="selected"';
				}
				
				echo '<option value="' . $key . '"' . $select . '>' . $value . '</option>';
			}
		echo '</select>';
	}
	
	
	public function local_avatar(){	
		register_setting( 'general', 'local_avatar' );
		add_settings_section(
			'acfefp_local_avatar',
			__( 'Local Gravatar', 'acf-frontend-form-element' ),
			'',
			'general'
		);
		add_settings_field(
			'local_avatar', 
			'Replace Gravatar with Local Avatar',
			[ $this, 'local_avatar_field' ],
			'general',
			'acfefp_local_avatar', 
			[
				'label_for' => 'local_avatar'
			] 
		);
	}
	
	function get_local_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
		$user = '';

		// Get user by id or email
		if ( is_numeric( $id_or_email ) ) {
			$id   = (int) $id_or_email;
			$user = get_user_by( 'id' , $id );
		} elseif ( is_object( $id_or_email ) ) {
			if ( ! empty( $id_or_email->user_id ) ) {
				$id   = (int) $id_or_email->user_id;
				$user = get_user_by( 'id' , $id );
			}
		} else {
			$user = get_user_by( 'email', $id_or_email );
		}
		if ( ! $user ) {
			return $avatar;
		}
		// Get the user id
		$user_id = $user->ID;
		
		$img_field_key = get_option( 'local_avatar' );
		
		if( $img_field_key == 'none' ){
			return $avatar;
		}
		
		// Get the file id
		$image_id = get_field( $img_field_key, 'user_' . $user_id ); 
		
		if ( ! $image_id ) {
			return $avatar;
		}
		
		if( is_array( $image_id ) ) {
			$image_id = $image_id[ 'ID' ];
		}
		
	   if( filter_var( $image_id, FILTER_VALIDATE_URL ) ) { 
            $avatar_url = $image_id;
       }else{
			$image_url  = wp_get_attachment_image_src( $image_id, 'thumbnail' );
			$avatar_url = $image_url[0];
	   }
		
		// Get the img markup
		$avatar = '<img alt="' . $alt . '" src="' . $avatar_url . '" class="avatar avatar-' . $size . '" height="' . $size . '" width="' . $size . '"/>';
		
		// Return our new avatar
		return $avatar;
	}
	
	
	public function __construct() {
		add_action( 'admin_init', [ $this, 'local_avatar' ] );
		add_filter( 'get_avatar', [ $this, 'get_local_avatar' ], 10, 5 );
	}
	
}

Local_Avatar_Module::instance();