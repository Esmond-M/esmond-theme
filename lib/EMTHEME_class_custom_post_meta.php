<?php
declare(strict_types=1);
namespace inc\EMTHEME_class_custom_post_meta;

if (!class_exists('EMTHEME_theme_custom_post_meta_Class')) {

    class EMTHEME_theme_custom_post_meta_Class
    {

        /** Declaring constructor
         */
        public function __construct()
        {

			add_action( 'init', [$this, 'em_services_register_meta' ]  );

        }


	public static function em_services_register_meta() {
		register_meta(
			'post',
			'em_services_icon_class',
			array(
				'show_in_rest'   => true,
				'single'         => true,
				'type'           => 'string',
				'object_subtype' => 'esmond-services',
				'default'        => '',
				'label'          => 'Icon Class',
			)
		);

	}


	} // Closing bracket for classes

}

use inc\EMTHEME_class_custom_post_meta;
new EMTHEME_theme_custom_post_meta_Class;