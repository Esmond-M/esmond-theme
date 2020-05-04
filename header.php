<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div>

			<!-- header -->
			<header class="header clear" role="banner">

     <?php       

     $custom_logo_id = get_theme_mod( 'custom_logo' );
     $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
     if ( has_custom_logo() ) {
           $custom_logo_image = esc_url( $logo[0] );
     } else {
            $custom_logo_image = get_template_directory_uri() . '/img/logo.png';
     }
     ?>
					
					<!-- /logo -->

					<!-- nav -->
					<nav id="site-navigation" class="nav nav-desktop" role="navigation">
						<div class="logo">
						<a href="<?php  echo home_url(); ?>"> 
							<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
						<img src="<?php echo  $custom_logo_image; ?>" alt="Logo" class="logo-img">
						</a>
					</div>  
						<?php esmondblankboilerplatetheme_nav(); ?>
					</nav>
					<nav class="nav-mobile" role="navigation">
                        <a class="toggle-nav" href="#">&#9776;</a>
						<?php esmondblankboilerplatetheme_nav_hamburger(); ?>                  
					</nav>
					<!-- /nav -->

			</header>
			<!-- /header -->
