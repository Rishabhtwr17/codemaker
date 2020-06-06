<?php

namespace ACFFrontendForm\Module\Classes;

use  ACFFrontendForm\Plugin ;
use  ACFFrontendForm\Module\ACFEF_Module ;
use  ACFFrontendForm\Module\Widgets ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}

class FormSubmit
{
    public function __construct()
    {
        add_action( 'the_content', [ $this, 'form_message' ] );
        add_action( 'acf/validate_save_post', [ $this, 'validate_save_post' ], 1 );
        add_filter(
            'acf/pre_save_post',
            [ $this, 'on_submit' ],
            10,
            1
        );
        add_action(
            'acf/save_post',
            [ $this, 'after_save' ],
            20,
            1
        );
    }
    
    public function form_message( $content )
    {
        $message = '';
        
        if ( isset( $_GET['updated'] ) ) {
            $widget = $this->get_the_widget();
            if ( !$widget ) {
                return $content;
            }
            $acfef = explode( '_', $_GET['updated'] );
            $widget_id = $acfef[0];
            $post_id = $acfef[1];
            $settings = $widget->get_settings_for_display();
            $message = '<div id="acfef-message" class="elementor-' . $post_id . '">
						<div class="elementor-element elementor-element-' . $widget_id . '">
							<div class="acf-notice -success acf-success-message -dismiss"><p class="success-msg">' . $settings['update_message'] . '</p><a href="#" onClick="closeMsg()" class="close-msg acf-notice-dismiss acf-icon -cancel"></a></div>
						</div>
						</div>';
        }
        
        return $message . $content;
    }
    
    public function validate_save_post()
    {
        if ( !isset( $_POST['acfef_widget_id'] ) ) {
            return;
        }
        $widget = $this->get_the_widget();
        $settings = $widget->get_settings_for_display();
        $module = ACFEF_Module::instance();
        
        if ( isset( get_option( 'stripe_settings_option_name' )['acfef_stripe_active'] ) ) {
            $stripe_action = $module->get_pay_actions( 'stripe' );
            if ( isset( $_POST['pay_action'] ) && $_POST['pay_action'] == 'stripe' ) {
                $stripe_action->pay();
            }
        }
        
        $post_action = $module->get_main_actions( 'post' );
        $post_action->default_fields( $settings, $_POST['acfef_widget_id'] );
        $user_action = $module->get_main_actions( 'user' );
        $user_action->default_fields( $settings, $_POST['acfef_widget_id'] );
    }
    
    public function on_submit( $post_id )
    {
        
        if ( isset( $_POST['prev_step'] ) ) {
            wp_safe_redirect( $_POST['prev_step_link'] );
            exit;
        }
        
        if ( !isset( $_POST['acfef_widget_id'] ) ) {
            return $post_id;
        }
        $widget = $this->get_the_widget();
        $settings = $widget->get_settings_for_display();
        $module = ACFEF_Module::instance();
        $actions = $module->get_main_actions();
        $step_index = $step_count = '';
        
        if ( isset( $_POST['acfef_step_index'] ) ) {
            $step_index = $_POST['acfef_step_index'];
            $steps = $settings['form_steps'];
            $settings = $steps[$step_index];
            $step_index++;
            $step_count = count( $steps );
            
            if ( $settings['main_action'] == 'continue' ) {
                do_action( 'acfef/on_submit', $settings, $widget->get_id() );
                return $post_id;
            }
        
        }
        
        $main_action = explode( '_', $settings['main_action'] );
        foreach ( $actions as $action ) {
            if ( $action->get_name() == $main_action['1'] ) {
                $post_id = $action->run(
                    $post_id,
                    $settings,
                    $step_index,
                    $step_count
                );
            }
        }
        do_action( 'acfef/on_submit', $settings, $widget->get_id() );
        return $post_id;
    }
    
    public function after_save( $post_id )
    {
        if ( !isset( $_POST['acfef_widget_id'] ) ) {
            return $post_id;
        }
        $widget = $this->get_the_widget();
        $settings = $widget->get_settings_for_display();
        $module = ACFEF_Module::instance();
        do_action( 'acfef/after_save', $settings, $widget->get_id() );
    }
    
    public function next_step( $post_id, $step_index, $steps )
    {
        $query_args = [
            'step' => ++$step_index,
        ];
        if ( $_POST['acfef_step_action'] == 'new_post' ) {
            $query_args['post_id'] = $post_id;
        }
        if ( $_POST['acfef_step_action'] == 'new_user' && strpos( $post_id, 'user' ) !== false ) {
            $query_args['user_id'] = explode( '_', $post_id )[1];
        }
        if ( isset( $_POST['acfef_modal_id'] ) ) {
            $query_args['modal'] = $_POST['acfef_modal_id'];
        }
        if ( isset( $_POST['acfef_widget_id'] ) ) {
            $query_args['form_id'] = $_POST['acfef_widget_id'];
        }
        // Redirect user back to the form page, with proper new $_GET parameters.
        $redirect_url = add_query_arg( $query_args, wp_get_referer() );
        wp_safe_redirect( $redirect_url );
        exit;
    }
    
    protected function get_the_widget()
    {
        
        if ( isset( $_POST['acfef_widget_id'] ) ) {
            $widget_id = $_POST['acfef_widget_id'];
            $post_id = $_POST['acfef_post_id'];
        } elseif ( isset( $_GET['updated'] ) ) {
            $acfef = explode( '_', $_GET['updated'] );
            $widget_id = $acfef[0];
            $post_id = $acfef[1];
        } else {
            return false;
        }
        
        $elementor = Plugin::instance()->elementor();
        $document = $elementor->documents->get( $post_id );
        $module = ACFEF_Module::instance();
        if ( $document ) {
            $form = $module->find_element_recursive( $document->get_elements_data(), $widget_id );
        }
        
        if ( !empty($form['templateID']) ) {
            $template = $elementor->documents->get( $form['templateID'] );
            
            if ( $template ) {
                $global_meta = $template->get_elements_data();
                $form = $global_meta[0];
            }
        
        }
        
        if ( !$form ) {
            return false;
        }
        $widget = $elementor->elements_manager->create_element_instance( $form );
        return $widget;
    }

}
new FormSubmit();