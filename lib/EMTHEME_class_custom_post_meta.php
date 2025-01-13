<?php
declare(strict_types=1);
namespace inc\EMTHEME_class_custom_post_meta;

if (!class_exists('EMTHEME_theme_custom_post_meta_Class')) {

    class EMTHEME_theme_custom_post_meta_Class
    {

   /**
      Declaring constructor
         */
        public function __construct()
        {

            add_action(
                'add_meta_boxes',
                [$this, 'emCustomThemePostTitleHideMetabox']
            );
            add_action(
                'save_post',
                [$this, 'emCustomThemePostTitleHiddenSaveMetaboxes']
            );
    
        }


        /**
         Adding meta box for post

        @return void
         */
        public function emCustomThemePostTitleHideMetabox()
        {
            $screens = ['post', 'page'];
            foreach ($screens as $screen) {
                add_meta_box(
                    'em_metaboxbox_id',    // Unique ID
                    'Icon class text',  // Box title
                    array($this, 'emCustomThemePostTitleHideHtml'),
                    $screen,                  // Post type
                    'normal',
                    'high'
                );
            }
        }
        /**
        Styles for custom metabox on backend

        @param $post callback

        @return callable
         */
        public function emCustomThemePostTitleHideHtml($post)
        {
            $meta = get_post_meta($post->ID, 'services_post_icon_class_value', true);
            wp_nonce_field(
                'post_title_hidden_control_meta_box',
                'post_title_hidden_control_meta_box_nonce'
            ); // adding nonce to meta box.
            ?>
            <div class="post_meta_extras">
                <p>
				<label>Icon Class <input
                               type="text"
                               name="services_post_icon_class_value"
                               value="<?php 
							   if (is_string($meta) ) {
                             	echo $meta;
                               }?>"
                            />

                    </label>
                </p>
            </div>
            <?php
        }
    
        /**
        Save meta box value to database

        @param $post_id of wordpress post

        @return integer
         */
        public function emCustomThemePostTitleHiddenSaveMetaboxes($post_id)
        {
            /*
            * We need to verify this came from the
            *  our screen and with proper authorization,
            * because save_post can be triggered at
            *  other times. Add as many nonces, as you
            * have metaboxes.
               */
            if (!isset($_POST['post_title_hidden_control_meta_box_nonce'])
                || !wp_verify_nonce(
                    sanitize_key(
                        $_POST['post_title_hidden_control_meta_box_nonce']
                    ),
                    'post_title_hidden_control_meta_box'
                )
            ) { // Input var okay.
                return $post_id;
            }

            // Check the user's permissions.
            if (isset($_POST['post_type'])
                && 'page' === $_POST['post_type']
            ) { // Input var okay.
                if (!current_user_can(
                    'edit_page', $post_id
                )
                ) {
                    return $post_id;
                }
            } else {
                if (!current_user_can('edit_post', $post_id)) {
                    return $post_id;
                }
            }

            /*
               * If this is an autosave, our form has not been submitted,
               * so we don't want to do anything.
               */
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return $post_id;
            }

            /* Ok to save */

            $services_post_icon_class_value = $_POST['services_post_icon_class_value']; // Input var okay.
            update_post_meta(
                $post_id,
                'services_post_icon_class_value',
                esc_attr($services_post_icon_class_value)
            );
        }






    }// Closing bracket for classes
}

use inc\EMTHEME_class_custom_post_meta;
new EMTHEME_theme_custom_post_meta_Class;