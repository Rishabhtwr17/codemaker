<?php
namespace ACFFrontendForm\Module;

use Elementor\Core\Base\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class UP_Module extends Module {
	
	public function get_name() {
		return 'uploads_privacy';
	}

	public function get_widgets() {
		return [
			'Uploads Privacy'
		];
	}
	
	public function media_uploads_privacy(){	
		register_setting( 'media', 'filter_media_author' );
		add_settings_section(
			'acfef_private_media',
			__( 'Media Uploads Privacy', 'acf-frontend-form-element' ),
			'',
			'media'
		);
		add_settings_field(
			'filter_media_author', 
			'Filter Media by Author',
			[ $this, 'filter_by_author_field' ],
			'media',
			'acfef_private_media', 
			[
				'label_for' => 'filter_media_author'
			] 
		);
	}
	
	function filter_by_author_field($args) {
		$value = ( get_option( 'filter_media_author' ) == 1 ) ? $value  = ' checked' : '';
    	echo '<input type="checkbox" id="filter_media_author" name="filter_media_author" value="1"' . $value . '/>';
	}
	
	function filter_media_author( $query ){
    	if ( get_option( 'filter_media_author' ) == '1' ) {
			$user_id = get_current_user_id();
			if ( $user_id && ! current_user_can( 'activate_plugins' ) ) {
				$query[ 'author' ] = $user_id;
			}
		}
		return $query;
	}
	
	public function __construct() {	
		
		add_action( 'admin_init', [ $this, 'media_uploads_privacy' ] );
		  
		add_filter( 'ajax_query_attachments_args', [ $this, 'filter_media_author' ] );
		
	}
	
}

