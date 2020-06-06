<?php

namespace ACFFrontendForm\Module;

use  ACFFrontendForm\Plugin ;
use  Elementor\Core\Base\Module ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly
}

class ACFEF_Module extends Module
{
    protected static  $acf_form_header = false ;
    protected static  $acf_enqueue_uploader = false ;
    public  $load_scripts = false ;
    public  $main_actions = array() ;
    public  $submit_actions = array() ;
    public  $pay_actions = array() ;
    public function get_name()
    {
        return 'acf_frontend_form';
    }
    
    public function get_widgets()
    {
        return [ 'ACF Frontend Form' ];
    }
    
    public static function find_element_recursive( $elements, $widget_id )
    {
        foreach ( $elements as $element ) {
            if ( $widget_id == $element['id'] ) {
                return $element;
            }
            
            if ( !empty($element['elements']) ) {
                $element = self::find_element_recursive( $element['elements'], $widget_id );
                if ( $element ) {
                    return $element;
                }
            }
        
        }
        return false;
    }
    
    public function add_main_action( $id, $instance )
    {
        $this->main_actions[$id] = $instance;
    }
    
    public function get_main_actions( $id = null )
    {
        
        if ( $id ) {
            if ( !isset( $this->main_actions[$id] ) ) {
                return null;
            }
            return $this->main_actions[$id];
        }
        
        return $this->main_actions;
    }
    
    public function add_submit_action( $id, $instance )
    {
        $this->submit_actions[$id] = $instance;
    }
    
    public function get_submit_actions( $id = null )
    {
        
        if ( $id ) {
            if ( !isset( $this->submit_actions[$id] ) ) {
                return null;
            }
            return $this->submit_actions[$id];
        }
        
        return $this->submit_actions;
    }
    
    public function add_pay_action( $id, $instance )
    {
        $this->pay_actions[$id] = $instance;
    }
    
    public function get_pay_actions( $id = null )
    {
        
        if ( $id ) {
            if ( !isset( $this->pay_actions[$id] ) ) {
                return null;
            }
            return $this->pay_actions[$id];
        }
        
        return $this->pay_actions;
    }
    
    public function init_widgets()
    {
        // Include Widget files
        require_once __DIR__ . '/widgets/acf-ele-form.php';
        require_once __DIR__ . '/widgets/delete-post.php';
        // Register widget
        $elementor = Plugin::instance()->elementor();
        $elementor->widgets_manager->register_widget_type( new Widgets\ACF_Elementor_Form_Widget() );
        $elementor->widgets_manager->register_widget_type( new Widgets\Delete_Post_Widget() );
    }
    
    public function acf_form_head()
    {
        
        if ( !self::$acf_form_header ) {
            acf()->form_front->check_submit_form();
            self::$acf_form_header = true;
        }
    
    }
    
    public function acfef_elementor_preview()
    {
        if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            echo  '<style>.hide-if-no-js{display:none}</style>' ;
        }
    }
    
    public function acfef_enqueue_scripts()
    {
        wp_register_style(
            'acfef-frontend',
            ACFEF_URL . 'acf-ele-form/assets/css/frontend.min.css',
            array(),
            '5.5.37'
        );
        wp_register_script(
            'acfef-frontend',
            ACFEF_URL . 'acf-ele-form/assets/js/frontend.js',
            array( 'jquery' ),
            '5.5.27',
            true
        );
        wp_register_script(
            'acfef-password-strength',
            ACFEF_URL . 'acf-ele-form/assets/js/password-strength.js',
            array( 'jquery', 'password-strength-meter' ),
            '5.5.26',
            true
        );
        acf_enqueue_scripts();
        wp_enqueue_style( 'acfef-frontend' );
        wp_enqueue_style( 'acfef-card' );
        $widget_scripts = [
            'jquery',
            'password-strength-meter',
            'acfef-password-strength',
            'acfef-card',
            'stripe',
            'acfef-stripe-handler',
            'acfef-frontend'
        ];
        foreach ( $widget_scripts as $script ) {
            wp_enqueue_script( $script );
        }
    }
    
    public function __construct()
    {
        require_once __DIR__ . '/classes/action_base.php';
        //actions
        require_once __DIR__ . '/actions/term.php';
        require_once __DIR__ . '/actions/user.php';
        require_once __DIR__ . '/actions/post.php';
        $this->add_main_action( 'user', new Actions\EditUser() );
        $this->add_main_action( 'post', new Actions\EditPost() );
        $this->add_main_action( 'term', new Actions\EditTerm() );
        require_once __DIR__ . '/classes/form_submit.php';
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        add_action( 'wp', [ $this, 'acf_form_head' ] );
        add_action( 'wp_footer', [ $this, 'acfef_elementor_preview' ] );
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'acfef_enqueue_scripts' ] );
    }

}