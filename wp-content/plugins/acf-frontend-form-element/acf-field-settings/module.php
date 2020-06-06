<?php

namespace ACFFrontendForm\Module;

use  Elementor\Core\Base\Module ;

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly
}

class ACFS_Module extends Module
{
    private  $components = array() ;
    public function get_name()
    {
        return 'acf_field_settings';
    }
    
    public function get_widgets()
    {
        return [ 'ACF Field Settings' ];
    }
    
    public function acfef_render_frontend( $field )
    {
        // bail early if no 'admin_only' setting
        if ( empty($field['only_front']) && empty($field['custom_username']) && empty($field['custom_email']) && empty($field['custom_password']) ) {
            return $field;
        }
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            return $field;
        }
        // return false if is admin (removes field)
        if ( is_admin() ) {
            return false;
        }
        // return
        return $field;
    }
    
    public function acfef_render_readonly( $field )
    {
        // bail early if no 'admin_only' setting
        if ( empty($field['only_read']) ) {
            return $field;
        }
        $field['disabled'] = 1;
        // return
        return $field;
    }
    
    public function acfef_frontend_setting( $field )
    {
        acf_render_field_setting( $field, array(
            'label'        => __( 'Show only on frontend' ),
            'instructions' => 'Lets you hide the field on the backend to avoid duplicate fields.',
            'name'         => 'only_front',
            'type'         => 'true_false',
            'ui'           => 1,
        ), true );
    }
    
    public function acfef_custom_price_field( $field )
    {
        acf_render_field_setting( $field, array(
            'label'        => __( 'Set as product price' ),
            'instructions' => 'Save value as product price.',
            'name'         => 'custom_price',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
        acf_render_field_setting( $field, array(
            'label'        => __( 'Set as sale price' ),
            'instructions' => 'Save value as product price.',
            'name'         => 'custom_sale_price',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
    }
    
    public function acfef_custom_title_field( $field )
    {
        acf_render_field_setting( $field, array(
            'label'        => __( 'Set as post title' ),
            'instructions' => 'Save value as post title.',
            'name'         => 'custom_title',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
        acf_render_field_setting( $field, array(
            'label'        => __( 'Set as post slug' ),
            'instructions' => 'Save value as post slug.',
            'name'         => 'custom_slug',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
        acf_render_field_setting( $field, array(
            'label'        => __( 'Set as username' ),
            'instructions' => 'Only for the frontend. Save value as user login name.',
            'name'         => 'custom_username',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
        acf_render_field_setting( $field, array(
            'label'        => __( 'Read only' ),
            'instructions' => 'Prevent users from changing the data.',
            'name'         => 'only_read',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
    }
    
    public function acfef_custom_password_field( $field )
    {
        acf_render_field_setting( $field, array(
            'label'        => __( 'Set as user password' ),
            'instructions' => 'Only for the frontend. Save value as user login password.',
            'name'         => 'custom_password',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
        acf_render_field_setting( $field, array(
            'label'        => __( 'Set as password confirm' ),
            'instructions' => 'Only for the frontend. Save value as user login password.',
            'name'         => 'custom_password_confirm',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
    }
    
    public function acfef_custom_email_field( $field )
    {
        acf_render_field_setting( $field, array(
            'label'        => __( 'Set as user email' ),
            'instructions' => 'Only for the frontend. Save value as user email.',
            'name'         => 'custom_email',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
        acf_render_field_setting( $field, array(
            'label'        => __( 'Read only' ),
            'instructions' => 'Prevent users from changing the data.',
            'name'         => 'only_read',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
    }
    
    public function acfef_custom_content_field( $field )
    {
        acf_render_field_setting( $field, array(
            'label'        => __( 'Set as post content' ),
            'instructions' => 'Save value as post content.',
            'name'         => 'custom_content',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
    }
    
    public function acfef_custom_excerpt_field( $field )
    {
        acf_render_field_setting( $field, array(
            'label'        => __( 'Set as post excerpt' ),
            'instructions' => 'Save value as post excerpt.',
            'name'         => 'custom_excerpt',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
        acf_render_field_setting( $field, array(
            'label'        => __( 'Read only' ),
            'instructions' => 'Prevent users from changing the data.',
            'name'         => 'only_read',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
    }
    
    public function acfef_file_folders_setting( $field )
    {
        acf_render_field_setting( $field, array(
            'label'         => __( 'Happy Files Folder', 'acf' ),
            'instructions'  => __( 'Limit the media library choice to specific Happy Files Categories', 'acf' ),
            'type'          => 'radio',
            'name'          => 'happy_files_folder',
            'layout'        => 'horizontal',
            'default_value' => 'all',
            'choices'       => acfef_get_image_folders(),
        ) );
    }
    
    public function acfef_custom_gallery_field( $field )
    {
        acf_render_field_setting( $field, array(
            'label' => __( 'Set as product gallery' ),
            'name'  => 'custom_product_gallery',
            'type'  => 'true_false',
            'ui'    => 1,
        ) );
    }
    
    public function acfef_custom_image_field( $field )
    {
        acf_render_field_setting( $field, array(
            'label'        => __( 'Set as post image' ),
            'instructions' => 'Save value as post featured image.',
            'name'         => 'custom_feature_image',
            'type'         => 'true_false',
            'ui'           => 1,
        ) );
    }
    
    public function acfef_load_value( $value, $post_id, $field )
    {
        
        if ( $post_id ) {
            $edit_post = get_post( $post_id );
            
            if ( $edit_post ) {
                if ( isset( $field['custom_title'] ) && $field['custom_title'] == 1 ) {
                    $value = $edit_post->post_title;
                }
                if ( isset( $field['custom_content'] ) && $field['custom_content'] == 1 ) {
                    $value = $edit_post->post_content;
                }
                if ( isset( $field['custom_excerpt'] ) && $field['custom_excerpt'] == 1 ) {
                    $value = $edit_post->post_excerpt;
                }
                if ( isset( $field['custom_feature_image'] ) && $field['custom_feature_image'] == 1 ) {
                    $value = get_post_meta( $post_id, '_thumbnail_id', true );
                }
                if ( isset( $field['custom_price'] ) && $field['custom_price'] == 1 ) {
                    $value = get_post_meta( $post_id, '_regular_price', true );
                }
                if ( isset( $field['custom_sale_price'] ) && $field['custom_sale_price'] == 1 ) {
                    $value = get_post_meta( $post_id, '_sale_price', true );
                }
                if ( isset( $field['custom_product_gallery'] ) && $field['custom_product_gallery'] == 1 ) {
                    $value = explode( ',', get_post_meta( $post_id, '_product_image_gallery', true ) );
                }
            } elseif ( strpos( $post_id, 'user' ) !== false ) {
                $user_id = explode( '_', $post_id )[1];
                $edit_user = get_user_by( 'ID', $user_id );
                
                if ( $edit_user ) {
                    if ( isset( $field['custom_username'] ) && $field['custom_username'] == 1 ) {
                        $value = $edit_user->user_login;
                    }
                    if ( isset( $field['custom_password'] ) && $field['custom_password'] == 1 || isset( $field['custom_password_confirm'] ) && $field['custom_password_confirm'] == 1 ) {
                        $value = '';
                    }
                    if ( isset( $field['custom_email'] ) && $field['custom_email'] == 1 ) {
                        $value = $edit_user->user_email;
                    }
                }
            
            } elseif ( $post_id == 'options' ) {
                if ( isset( $field['custom_site_title'] ) && $field['custom_site_title'] == 1 ) {
                    $value = get_option( 'blogname' );
                }
                if ( isset( $field['custom_site_desc'] ) && $field['custom_site_desc'] == 1 ) {
                    $value = get_option( 'blogdescription' );
                }
                if ( isset( $field['custom_site_logo'] ) && $field['custom_site_logo'] == 1 ) {
                    $value = get_theme_mod( 'custom_logo' );
                }
            }
        
        }
        
        return $value;
    }
    
    public function acfef_save_value( $post_id )
    {
        
        if ( isset( $_POST['acf'] ) ) {
            $values = $_POST['acf'];
        } else {
            return $post_id;
        }
        
        $form = false;
        $edit_post = get_post( $post_id );
        
        if ( $edit_post ) {
            $post_to_edit = [
                'ID' => $post_id,
            ];
            $product_gallery = '';
            
            if ( isset( $_POST['_acf_form'] ) ) {
                // Load registered form using id.
                $form = acf()->form_front->get_form( $_POST['_acf_form'] );
                // Fallback to encrypted JSON.
                if ( !$form ) {
                    $form = json_decode( acf_decrypt( $_POST['_acf_form'] ), true );
                }
            }
            
            
            if ( isset( $_POST['custom_title'] ) ) {
                $post_to_edit['post_title'] = $_POST['acf'][$_POST['custom_title']];
                if ( isset( $_POST['_acf_post_id'] ) && $_POST['_acf_post_id'] == 'new_post' ) {
                    $post_to_edit['post_name'] = sanitize_title( $_POST['acf'][$_POST['custom_title']] );
                }
            }
            
            
            if ( $form && !empty($form['title_structure']) ) {
                $title_structure = $this->replace_setting_shortcodes( $form['title_structure'], $post_id );
                $post_to_edit['post_title'] = $title_structure;
                if ( isset( $_POST['_acf_post_id'] ) && $_POST['_acf_post_id'] == 'new_post' ) {
                    $post_to_edit['post_name'] = sanitize_title( $title_structure );
                }
            }
            
            if ( isset( $_POST['custom_slug'] ) ) {
                $post_to_edit['post_name'] = $_POST['acf'][$_POST['custom_slug']];
            }
            if ( isset( $_POST['custom_price'] ) ) {
                update_post_meta( $post_id, '_regular_price', $_POST['acf'][$_POST['custom_price']] );
            }
            if ( isset( $_POST['custom_sale_price'] ) ) {
                update_post_meta( $post_id, '_sale_price', $_POST['acf'][$_POST['custom_sale_price']] );
            }
            if ( isset( $_POST['custom_content'] ) ) {
                $post_to_edit['post_content'] = $_POST['acf'][$_POST['custom_content']];
            }
            if ( isset( $_POST['custom_excerpt'] ) ) {
                $post_to_edit['post_excerpt'] = $_POST['acf'][$_POST['custom_excerpt']];
            }
            
            if ( isset( $_POST['custom_featured_image'] ) ) {
                $post_image = $_POST['acf'][$_POST['custom_featured_image']];
                update_post_meta( $post_id, '_thumbnail_id', $post_image );
            }
            
            
            if ( isset( $_POST['custom_product_gallery'] ) ) {
                $product_images = $_POST['acf'][$_POST['custom_product_gallery']];
                if ( is_array( $product_images ) ) {
                    $product_images = implode( ',', $product_images );
                }
                update_post_meta( $post_id, '_product_image_gallery', $product_images );
            }
            
            remove_action(
                'acf/save_post',
                [ $this, 'acfef_save_value' ],
                10,
                1
            );
            $post_id = wp_update_post( $post_to_edit );
            add_action(
                'acf/save_post',
                [ $this, 'acfef_save_value' ],
                10,
                1
            );
            return $post_id;
        }
        
        
        if ( strpos( $post_id, 'user_' ) !== false ) {
            $user_id = explode( '_', $post_id )[1];
            $user_to_edit = [
                'ID' => $user_id,
            ];
            if ( isset( $_POST['custom_email'] ) ) {
                $user_to_edit['user_email'] = $_POST['acf'][$_POST['custom_email']];
            }
            if ( isset( $_POST['custom_password'] ) && isset( $_POST['acfef_main_action'] ) && $_POST['acfef_main_action'] == 'edit_user' ) {
                if ( !empty($_POST['acf'][$_POST['custom_password']]) ) {
                    $user_to_edit['user_pass'] = $_POST['acf'][$_POST['custom_password']];
                }
            }
            if ( isset( $_POST['custom_first_name'] ) ) {
                $user_to_edit['first_name'] = $_POST['acf'][$_POST['custom_first_name']];
            }
            if ( isset( $_POST['custom_last_name'] ) ) {
                $user_to_edit['last_name'] = $_POST['acf'][$_POST['custom_last_name']];
            }
            if ( isset( $_POST['custom_user_bio'] ) ) {
                $user_to_edit['description'] = $_POST['acf'][$_POST['custom_user_bio']];
            }
            if ( isset( $_POST['custom_role_select'] ) ) {
                $user_to_edit['role'] = $_POST['acf'][$_POST['custom_role_select']];
            }
            wp_update_user( $user_to_edit );
            return 'user_' . $user_id;
        }
        
        
        if ( $post_id == 'options' ) {
            if ( isset( $_POST['custom_site_title'] ) ) {
                update_option( 'blogname', $_POST['acf'][$_POST['custom_site_title']] );
            }
            if ( isset( $_POST['custom_site_desc'] ) ) {
                update_option( 'blogdescription', $_POST['acf'][$_POST['custom_site_desc']] );
            }
            if ( isset( $_POST['custom_site_logo'] ) ) {
                set_theme_mod( 'custom_logo', $_POST['acf'][$_POST['custom_site_logo']] );
            }
            return $post_id;
        }
        
        return $post_id;
    }
    
    public function replace_setting_shortcodes( $structure, $post_id )
    {
        return preg_replace_callback( '/(\\[acf[^]]*name="(\\w+)"[^]]*\\])/', function ( $matches ) use( $post_id ) {
            $value = '';
            $field = get_field_object( $matches[2], $post_id );
            
            if ( $field ) {
                $field_key = $field['key'];
                if ( $_POST['acf'][$field_key] ) {
                    $value = $_POST['acf'][$field_key];
                }
            }
            
            return $value;
        }, $structure );
    }
    
    public function acfef_exclude_groups( $field_group )
    {
        
        if ( isset( $field_group['key'] ) && strpos( $field_group['key'], 'group_acfef' ) === false ) {
            return $field_group;
        } else {
            $field_group['key'] = 'acfef_hidden';
            return $field_group;
        }
    
    }
    
    public function acfef_render_number_field( $field )
    {
        if ( isset( $field['custom_price'] ) && $field['custom_price'] == 1 ) {
            echo  '<input type="hidden" name="custom_price" value="' . $field['key'] . '"/>' ;
        }
        if ( isset( $field['custom_sale_price'] ) && $field['custom_sale_price'] == 1 ) {
            echo  '<input type="hidden" name="custom_sale_price" value="' . $field['key'] . '"/>' ;
        }
    }
    
    public function acfef_render_text_field( $field )
    {
        if ( isset( $field['custom_title'] ) && $field['custom_title'] == 1 ) {
            echo  '<input type="hidden" name="custom_title" value="' . $field['key'] . '"/>' ;
        }
        if ( isset( $field['custom_slug'] ) && $field['custom_slug'] == 1 ) {
            echo  '<input type="hidden" name="custom_slug" value="' . $field['key'] . '"/>' ;
        }
        if ( isset( $field['custom_site_title'] ) && $field['custom_site_title'] == 1 ) {
            echo  '<input type="hidden" name="custom_site_title" value="' . $field['key'] . '"/>' ;
        }
        if ( isset( $field['custom_site_desc'] ) && $field['custom_site_desc'] == 1 ) {
            echo  '<input type="hidden" name="custom_site_desc" value="' . $field['key'] . '"/>' ;
        }
        if ( isset( $field['custom_username'] ) && $field['custom_username'] == 1 ) {
            echo  '<input type="hidden" name="custom_username" value="' . $field['key'] . '"/>' ;
        }
        if ( isset( $field['custom_first_name'] ) && $field['custom_first_name'] == 1 ) {
            echo  '<input type="hidden" name="custom_first_name" value="' . $field['key'] . '"/>' ;
        }
        if ( isset( $field['custom_last_name'] ) && $field['custom_last_name'] == 1 ) {
            echo  '<input type="hidden" name="custom_last_name" value="' . $field['key'] . '"/>' ;
        }
    }
    
    public function acfef_render_textarea_field( $field )
    {
        if ( isset( $field['custom_content'] ) && $field['custom_content'] == 1 ) {
            echo  '<input type="hidden" name="custom_content" value="' . $field['key'] . '"/>' ;
        }
        if ( isset( $field['custom_excerpt'] ) && $field['custom_excerpt'] == 1 ) {
            echo  '<input type="hidden" name="custom_excerpt" value="' . $field['key'] . '"/>' ;
        }
        if ( isset( $field['custom_user_bio'] ) && $field['custom_user_bio'] == 1 ) {
            echo  '<input type="hidden" name="custom_user_bio" value="' . $field['key'] . '"/>' ;
        }
    }
    
    public function acfef_render_wysiwyg_field( $field )
    {
        if ( isset( $field['custom_content'] ) && $field['custom_content'] == 1 ) {
            echo  '<input type="hidden" name="custom_content" value="' . $field['key'] . '"/>' ;
        }
    }
    
    public function acfef_render_image_field( $field )
    {
        if ( isset( $field['custom_feature_image'] ) && $field['custom_feature_image'] == 1 ) {
            echo  '</div></div><div><div><input type="hidden" name="custom_featured_image" value="' . $field['key'] . '"/>' ;
        }
        if ( isset( $field['custom_site_logo'] ) && $field['custom_site_logo'] == 1 ) {
            echo  '</div></div><div><div><input type="hidden" name="custom_site_logo" value="' . $field['key'] . '"/>' ;
        }
    }
    
    public function acfef_render_gallery_field( $field )
    {
        if ( isset( $field['custom_product_gallery'] ) && $field['custom_product_gallery'] == 1 ) {
            echo  '</div></div><div><div><input type="hidden" name="custom_product_gallery" value="' . $field['key'] . '"/>' ;
        }
    }
    
    public function acfef_render_password_field( $field )
    {
        if ( isset( $field['custom_password'] ) && $field['custom_password'] == 1 ) {
            echo  '<input type="hidden" name="custom_password" value="' . $field['key'] . '"/>' ;
        }
        
        if ( isset( $field['custom_password_confirm'] ) && $field['custom_password_confirm'] == 1 ) {
            echo  '<span id="password-strength"></span>' ;
            echo  '<input type="hidden" name="custom_password_confirm" value="' . $field['key'] . '"/>' ;
        }
    
    }
    
    public function acfef_render_email_field( $field )
    {
        if ( isset( $field['custom_email'] ) && $field['custom_email'] == 1 ) {
            echo  '<input type="hidden" name="custom_email" value="' . $field['key'] . '"/>' ;
        }
    }
    
    public function acfef_render_select_field( $field )
    {
        if ( isset( $field['custom_role_select'] ) && $field['custom_role_select'] == 1 ) {
            echo  '<input type="hidden" name="custom_role_select" value="' . $field['key'] . '"/>' ;
        }
    }
    
    public function acfef_validate_save_post()
    {
        if ( isset( $_POST['custom_username'] ) ) {
            acf_add_local_field( array(
                'prefix'          => 'acf',
                'key'             => $_POST['custom_username'],
                'type'            => 'text',
                'custom_username' => 1,
            ) );
        }
        if ( isset( $_POST['custom_email'] ) ) {
            acf_add_local_field( array(
                'prefix'       => 'acf',
                'key'          => $_POST['custom_email'],
                'type'         => 'email',
                'custom_email' => 1,
            ) );
        }
        if ( isset( $_POST['custom_password'] ) ) {
            acf_add_local_field( array(
                'prefix'          => 'acf',
                'key'             => $_POST['custom_password'],
                'type'            => 'password',
                'custom_password' => 1,
            ) );
        }
        if ( isset( $_POST['custom_password_confirm'] ) ) {
            acf_add_local_field( array(
                'prefix'                  => 'acf',
                'key'                     => $_POST['custom_password_confirm'],
                'type'                    => 'password',
                'custom_password_confirm' => 1,
            ) );
        }
    }
    
    public function acfef_validate_save_draft()
    {
        if ( isset( $_POST['acfef_save_draft'] ) ) {
            acf_reset_validation_errors();
        }
    }
    
    public function acfef_validate_useremail(
        $is_valid,
        $value,
        $field,
        $input
    )
    {
        if ( !isset( $_POST['_acf_post_id'] ) || strpos( $_POST['_acf_post_id'], 'user' ) === false ) {
            return true;
        }
        if ( $field['required'] == 0 && $value == '' ) {
            return true;
        }
        $user_id = explode( '_', $_POST['_acf_post_id'] )[1];
        $user_to_edit = get_user_by( 'ID', $user_id );
        
        if ( isset( $field['custom_email'] ) && $field['custom_email'] == 1 ) {
            if ( strpos( $value, '.' ) === false && !empty($value) ) {
                return __( 'The email address ' . $value . ' must contain a "."', 'acf-frontend-form-element' );
            }
            
            if ( email_exists( $value ) ) {
                if ( $user_to_edit ) {
                    if ( $user_to_edit->user_email == $value ) {
                        return true;
                    }
                }
                return __( 'The email address ' . $value . ' is already registered. Please log in or use a different email address', 'acf-frontend-form-element' );
            }
        
        }
        
        return true;
    }
    
    public function acfef_validate_username(
        $is_valid,
        $value,
        $field,
        $input
    )
    {
        if ( !isset( $_POST['_acf_post_id'] ) || strpos( $_POST['_acf_post_id'], 'user' ) === false ) {
            return true;
        }
        if ( isset( $_POST['acfef_main_action'] ) && $_POST['acfef_main_action'] == 'edit_user' && $field['required'] == 0 && $value == '' ) {
            return true;
        }
        $user_id = explode( '_', $_POST['_acf_post_id'] )[1];
        $user_to_edit = get_user_by( 'ID', $user_id );
        
        if ( isset( $field['custom_username'] ) && $field['custom_username'] == 1 ) {
            
            if ( username_exists( $value ) ) {
                if ( $user_to_edit ) {
                    if ( $user_to_edit->user_login == $value ) {
                        return true;
                    }
                }
                return __( 'The username ' . $value . ' is taken. Please try a different username', 'acf-frontend-form-element' );
            }
            
            if ( !validate_username( $value ) ) {
                return __( 'The username contains illegal characters. Please enter only latin letters, numbers, @, -, . and _', 'acf-frontend-form-element' );
            }
        }
        
        return true;
    }
    
    public function acfef_validate_password(
        $is_valid,
        $value,
        $field,
        $input
    )
    {
        if ( !isset( $_POST['_acf_post_id'] ) || strpos( $_POST['_acf_post_id'], 'user' ) === false ) {
            return true;
        }
        if ( isset( $field['custom_password_confirm'] ) && $field['custom_password_confirm'] == 1 ) {
            if ( $_POST['acf'][$_POST['custom_password']] != $value ) {
                return __( 'The passwords do not match', 'acf-frontend-form-element' );
            }
        }
        if ( isset( $field['custom_password'] ) && $field['custom_password'] == 1 && isset( $_POST['custom_password_confirm'] ) ) {
            if ( $_POST['acf'][$_POST['custom_password_confirm']] != $value ) {
                return __( 'The passwords do not match', 'acf-frontend-form-element' );
            }
        }
        return true;
    }
    
    function happy_files_folder( $query )
    {
        if ( empty($_POST['query']['_acfuploader']) ) {
            return $query;
        }
        // load field
        $field = acf_get_field( $_POST['query']['_acfuploader'] );
        if ( !$field ) {
            return $query;
        }
        if ( !isset( $field['happy_files_folder'] ) || $field['happy_files_folder'] == 'all' ) {
            return $query;
        }
        
        if ( isset( $query['tax_query'] ) ) {
            $tax_query = $query['tax_query'];
        } else {
            $tax_query = [];
        }
        
        $tax_query[] = array(
            'taxonomy' => 'happyfiles_category',
            'field'    => 'name',
            'terms'    => $field['happy_files_folder'],
        );
        $query['tax_query'] = $tax_query;
        return $query;
    }
    
    public function __construct()
    {
        add_filter( 'acf/prepare_field', [ $this, 'acfef_render_frontend' ] );
        add_filter( 'acf/prepare_field', [ $this, 'acfef_render_readonly' ] );
        add_action( 'acf/render_field_settings', [ $this, 'acfef_frontend_setting' ] );
        add_action( 'acf/render_field_settings/type=text', [ $this, 'acfef_custom_title_field' ] );
        
        if ( class_exists( 'woocommerce' ) ) {
            add_action( 'acf/render_field_settings/type=number', [ $this, 'acfef_custom_price_field' ] );
            add_action( 'acf/render_field_settings/type=gallery', [ $this, 'acfef_custom_gallery_field' ] );
            add_action( 'acf/render_field/type=number', [ $this, 'acfef_render_number_field' ] );
            add_action( 'acf/render_field/type=gallery', [ $this, 'acfef_render_gallery_field' ] );
        }
        
        add_action( 'acf/render_field_settings/type=email', [ $this, 'acfef_custom_email_field' ] );
        add_action( 'acf/render_field_settings/type=password', [ $this, 'acfef_custom_password_field' ] );
        add_action( 'acf/render_field_settings/type=textarea', [ $this, 'acfef_custom_content_field' ] );
        add_action( 'acf/render_field_settings/type=wysiwyg', [ $this, 'acfef_custom_content_field' ] );
        add_action( 'acf/render_field_settings/type=textarea', [ $this, 'acfef_custom_excerpt_field' ] );
        add_action( 'acf/render_field_settings/type=image', [ $this, 'acfef_custom_image_field' ] );
        
        if ( defined( 'HAPPYFILES_VERSION' ) ) {
            add_action( 'acf/render_field_settings/type=image', [ $this, 'acfef_file_folders_setting' ] );
            add_action( 'acf/render_field_settings/type=file', [ $this, 'acfef_file_folders_setting' ] );
            add_action( 'acf/render_field_settings/type=gallery', [ $this, 'acfef_file_folders_setting' ] );
        }
        
        add_filter(
            'acf/load_value',
            [ $this, 'acfef_load_value' ],
            10,
            3
        );
        add_action(
            'acf/save_post',
            [ $this, 'acfef_save_value' ],
            10,
            1
        );
        add_action(
            'acfef/save_step',
            [ $this, 'acfef_save_value' ],
            10,
            1
        );
        add_filter( 'acf/load_field_group', [ $this, 'acfef_exclude_groups' ] );
        add_action( 'acf/render_field/type=text', [ $this, 'acfef_render_text_field' ] );
        add_action( 'acf/render_field/type=textarea', [ $this, 'acfef_render_textarea_field' ] );
        add_action( 'acf/render_field/type=wysiwyg', [ $this, 'acfef_render_wysiwyg_field' ] );
        add_action( 'acf/render_field/type=image', [ $this, 'acfef_render_image_field' ] );
        add_action( 'acf/render_field/type=password', [ $this, 'acfef_render_password_field' ] );
        add_action( 'acf/render_field/type=email', [ $this, 'acfef_render_email_field' ] );
        add_action( 'acf/render_field/type=select', [ $this, 'acfef_render_select_field' ] );
        //add_action( 'acf/validate_save_post', [ $this, 'acfef_validate_save_draft' ] );
        add_filter(
            'acf/validate_value/type=email',
            [ $this, 'acfef_validate_useremail' ],
            10,
            4
        );
        add_filter(
            'acf/validate_value/type=text',
            [ $this, 'acfef_validate_username' ],
            10,
            4
        );
        add_filter(
            'acf/validate_value/type=password',
            [ $this, 'acfef_validate_password' ],
            10,
            4
        );
        if ( defined( 'HAPPYFILES_VERSION' ) ) {
            add_filter( 'ajax_query_attachments_args', [ $this, 'happy_files_folder' ] );
        }
    }

}