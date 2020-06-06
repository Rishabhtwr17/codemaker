<?php

namespace ACFFrontendForm\Module;

use  Elementor\Core\Base\Module ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly
}

class ACFEFS_Module extends Module
{
    private  $components = array() ;
    public function get_name()
    {
        return 'acfef_settings';
    }
    
    public function get_widgets()
    {
        return [ 'ACF Frontend Settings' ];
    }
    
    public function acfef_plugin_page()
    {
        global  $acfef_settings ;
        $acfef_settings = add_menu_page(
            'ACF Frontend',
            'ACF Frontend',
            'manage_options',
            'acfef-settings',
            [ $this, 'acfef_admin_settings_page' ],
            'dashicons-feedback',
            '87.87778'
        );
    }
    
    function acfef_admin_settings_page()
    {
        global  $acfef_active_tab ;
        $acfef_active_tab = ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'welcome' );
        ?>

		<h2 class="nav-tab-wrapper">
		<?php 
        do_action( 'acfef_settings_tabs' );
        ?>
		</h2>
		<?php 
        do_action( 'acfef_settings_content' );
    }
    
    public function add_tabs()
    {
        add_action( 'acfef_settings_tabs', [ $this, 'acfef_settings_tabs' ], 1 );
        add_action( 'acfef_settings_content', [ $this, 'acfef_settings_render_options_page' ] );
    }
    
    public function acfef_settings_tabs()
    {
        global  $acfef_active_tab ;
        ?>
		<a class="nav-tab <?php 
        echo  ( $acfef_active_tab == 'welcome' || '' ? 'nav-tab-active' : '' ) ;
        ?>" href="<?php 
        echo  admin_url( '?page=acfef-settings&tab=welcome' ) ;
        ?>"><?php 
        _e( 'Welcome', 'acfef' );
        ?> </a>
		<?php 
    }
    
    public function acfef_settings_render_options_page()
    {
        global  $acfef_active_tab ;
        
        if ( '' || 'welcome' == $acfef_active_tab ) {
            ?>
		<style>p.acfef-text{font-size:20px}</style>
		<h3><?php 
            _e( 'Hello and welcome', 'acfef' );
            ?></h3>
		<p class="acfef-text"><?php 
            _e( 'If this is your first time using ACF Frontend, we recommend you watch Paul Charlton from WPTuts beautifully explain how to use it.', 'acf-frontend-form-element' );
            ?></p>
		<iframe width="560" height="315" src="https://www.youtube.com/embed/iHx7krTqRN0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br><p class="acfef-text"><?php 
            _e( 'Here is a video where our lead developer and head of support, explains the basic usage of ACF Frontend.', 'acf-frontend-form-element' );
            ?></p>
		<iframe width="560" height="315" src="https://www.youtube.com/embed/lMkZzOVVra8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
		<p class="acfef-text"><?php 
            _e( 'If you have any questions at all please feel welcome to email shabti at', 'acf-frontend-form-element' );
            ?> <a href="mailto:shabti@frontendform.com">shabti@frontendform.com</a> <?php 
            _e( 'or on whatsapp', 'acf-frontend-form-element' );
            ?> <a href="https://api.whatsapp.com/send?phone=972584526441">+972-58-452-6441</a></p>
		<?php 
        }
    
    }
    
    /** Enqueue Stylesheets **/
    public function acfef_admin_scripts( $hook )
    {
        global  $acfef_settings ;
        if ( !in_array( $hook, array( $acfef_settings ) ) ) {
            return;
        }
    }
    
    public function acfef_settings_sections()
    {
    }
    
    public function __construct()
    {
        add_action( 'admin_menu', [ $this, 'acfef_plugin_page' ] );
        add_action( 'admin_init', [ $this, 'acfef_settings_sections' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'acfef_admin_scripts' ] );
        $this->add_tabs();
    }

}